<?php

namespace App\Http\Controllers\Web\Doctor\CaseCont;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\CaseReq\CaseOrderAlignerIndexRequest;
use App\Http\Requests\Web\Admin\CaseReq\CaseOrderAlignerStoreRequest;
use App\Models\CaseModel;
use App\Models\ClinicDoctor;
use Illuminate\Support\Facades\Mail;
use App\Models\Country;
use App\Models\Order;
use App\Models\Address;
use App\Models\Setting;
use App\Models\ShippingCompanyCharge;
use App\Notifications\CaseNotification\ClearsAlignerNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe;
use App\Traits\EmailTrait;

class OrderAlignerController extends Controller
{
    use EmailTrait;

    public function index(CaseOrderAlignerIndexRequest $request, $id)
    {
        try {
             $case = CaseModel::find($id);
               if (empty($case->no_of_trays) || $case->no_of_trays < 0 || !empty($case->aligner_kit_order_id)) {
                      return redirect()->back()->withErrors('Ordered or no. of trays not found');
            }


              $settings = Setting::first();
               $countries = Country::orderBy('name')->get();
                $ClinicDoctors =  ClinicDoctor::where(['doctor_id' => auth()->user()->id])->get();
                   return view('doctor.container.case.case-order-aligner-form', compact('case', 'settings', 'countries', 'ClinicDoctors'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function index2(Request $request)
    {
        try {
             $case = CaseModel::find($request->id);
               if (empty($case->no_of_trays) || $case->no_of_trays < 0 || !empty($case->aligner_kit_order_id)) {
                      return redirect()->back()->withErrors('Ordered or no. of trays not found');
                      return response()->json(['error' => 'Order or no of trays not found']);
                                                                                                               }
              $settings = Setting::first();
               $countries = Country::orderBy('name')->get();
                $ClinicDoctors =  ClinicDoctor::where(['doctor_id' => auth()->user()->id])->get();
                return response()->json( ['case' => $case , 'settings' => $settings, 'countries' => $countries, 'ClinicDoctors' => $ClinicDoctors] );
                //    return view('doctor.container.case.case-order-aligner-form', compact('case', 'settings', 'countries', 'ClinicDoctors'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }



    public function store(CaseOrderAlignerStoreRequest $request, $id)
    {
        try {

            DB::beginTransaction();

            $case = CaseModel::find($id);

            $caseDoctor = $case->doctor()->first();

            $settings = Setting::first();

            $user_id = $request->user()->id;
            $unit_amout = $settings->aligner_kit_price;
            // $total_amount = ($unit_amout * $case->no_of_trays) + 0;
            $case_fee = $settings->case_fee;
            $complete_treatment_plan = $settings->complete_treatment_plan;
            $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;

             Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
             $stripeRes = Stripe\Charge::create([
                "amount" => $total_amount * 100,
                "currency" => strtolower($settings->currency),
                "source" => $request->stripeToken,
                "description" => "Processing fee payment against case Id " . $id,
             ]);

             $inputs = $request->only('country_id', 'state_id', 'city_id', 'shipping_company_charge_id');
             $address = Address::find($request->address_id);

             $inputs['street1'] = $address->value;
             $inputs['address_id'] = $request->address_id;
             $inputs['country_id'] = $address->country_id;
             $inputs['state_id'] = $address->state_id;
             $inputs['city_id'] = $address->city_id;

             $inputs['case_id'] = $request->case;
            // $inputs['order_url'] = $request->order_url;
             $inputs['patient_id'] = $case->patient_id;
             $inputs['name'] = $case->name;
             $inputs['email'] = $case->email;
             $inputs['phone_no'] = $case->phone_no;
             $inputs['product'] = 'ALIGNER';
             $inputs['unit_amout'] = $unit_amout;
             $inputs['quantity'] = $case->no_of_trays;
             $inputs['shipping_charges'] = 0;
             $inputs['doctor_id'] = $caseDoctor->id;
             $inputs['doctor_name'] = $caseDoctor->name;
             $inputs['total_amount'] = $total_amount;
             $inputs['payment_name'] = 'Stripe';
             $inputs['payment_responses'] = "$stripeRes";
             $inputs['payment_at'] = Carbon::now();
             $inputs['used_in_case'] = $id;
             $inputs['status'] = 'CONFIRMED';
             $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
            if ($order) {
                $case->update([
                    'aligner_kit_order_id' => $order->id,
                    'payment_status' => 'first-installment',
                    'processing_fee_payment_at' => Carbon::now(),
                    'status' => 'CONFIRMED',
                ]);

                DB::commit();

                $username = $case->name;
                // $to = $case->email;
                $to = "info@accualigners.com";
                $subject = "Case Id: " . $case->id . " Aligner's Request";
                $data['case_id'] = $case->id;
                $data['patient_name'] = $username;
                $html = view('emails.orderAlignerNotification', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);

                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors('Something went wrong');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store_new(Request $request)
    {
           $address_id=$request->address_id;
        try {

             $id=$request->id;

             DB::beginTransaction();

             $case = CaseModel::find($id);

             $caseDoctor = $case->doctor()->first();

             $settings = Setting::first();

             $user_id = $request->user()->id;
             $unit_amout = $settings->aligner_kit_price;
             // $total_amount = ($unit_amout * $case->no_of_trays) + 0;
             $case_fee = $settings->case_fee;
             $complete_treatment_plan = $settings->complete_treatment_plan;
             $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;

             Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
             $stripeRes = Stripe\Charge::create([
                "amount" => $total_amount * 100,
                "currency" => strtolower($settings->currency),
                "source" => $request->stripeToken,
                "description" => "Processing fee payment against case Id " . $id,
             ]);

             $inputs = $request->only('country_id', 'state_id', 'city_id', 'shipping_company_charge_id');
             $address = Address::find($address_id);

             $inputs['street1'] = $address->value;
             $inputs['address_id'] = $address_id;
             $inputs['country_id'] = $address->country_id;
             $inputs['state_id'] = $address->state_id;
             $inputs['city_id'] = $address->city_id;

             $inputs['case_id'] = $id;
            // $inputs['order_url'] = $request->order_url;
             $inputs['patient_id'] = $case->patient_id;
             $inputs['name'] = $case->name;
             $inputs['email'] = $case->email;
             $inputs['phone_no'] = $case->phone_no;
             $inputs['product'] = 'ALIGNER';
             $inputs['unit_amout'] = $unit_amout;
             $inputs['quantity'] = $case->no_of_trays;
            $inputs['shipping_charges'] = 0;
            $inputs['doctor_id'] = $caseDoctor->id;
            $inputs['doctor_name'] = $caseDoctor->name;
            $inputs['total_amount'] = $total_amount;
            $inputs['payment_name'] = 'Stripe';
            $inputs['payment_responses'] = "$stripeRes";
            $inputs['payment_at'] = Carbon::now();
            $inputs['used_in_case'] = $id;
            $inputs['status'] = 'CONFIRMED';
            $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
      if ($order) {
                $case->update([
                    'aligner_kit_order_id' => $order->id,
                    'payment_status' => 'first-installment',
                    'processing_fee_payment_at' => Carbon::now(),
                    'status' => 'CONFIRMED',
                ]);

                DB::commit();

                $username = $case->name;
                // $to = $case->email;
                $to = "info@accualigners.com";
                $subject = "Case Id: " . $case->id . " Aligner's Request";
                $data['case_id'] = $case->id;
                $data['patient_name'] = $username;
                $html = view('emails.orderAlignerNotification', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);

                return response()->json(['success' => 'Payment']);
                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors('Something went wrong');
            }
         } catch (Exception $e) {
             DB::rollBack();
             return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function storeInvoice_new(Request $request)
    {
           $id=$request->id;
           $address_id=$request->address_id;

           $invoice_id=rand(9,99999999999999);
         try{

             DB::beginTransaction();

             $case = CaseModel::find($request->id);

             $caseDoctor = $case->doctor()->first();
             $settings = Setting::first();

             $user_id = $request->user()->id;

             $unit_amout = $settings->aligner_kit_price;
            //  $total_amount = ($unit_amout * $case->no_of_trays) + 0;
             $case_fee = $settings->case_fee;
             $complete_treatment_plan = $settings->complete_treatment_plan;
             $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;

             $inputs = $request->only('street1', 'country_id', 'state_id', 'city_id', 'shipping_company_charge_id');
             $address = Address::find($address_id);
             $inputs['street1'] = $address->value;
             $inputs['address_id'] = $address_id;
             $inputs['country_id'] = $address->country_id;
             $inputs['state_id'] = $address->state_id;
             $inputs['city_id'] = $address->city_id;
             $inputs['case_id'] = $id;
             // $inputs['order_url'] = $request->order_url;
             $inputs['patient_id'] = $case->patient_id;
             $inputs['name'] = $case->name;
             $inputs['email'] = $case->email;
             $inputs['phone_no'] = $case->phone_no;
             $inputs['product'] = 'ALIGNER';
             $inputs['unit_amout'] = $unit_amout;
             $inputs['quantity'] = $case->no_of_trays;
             $inputs['shipping_charges'] = 0;
             $inputs['doctor_id'] = $caseDoctor->id;
             $inputs['doctor_name'] = $caseDoctor->name;
             $inputs['total_amount'] = $total_amount;
             $inputs['payment_name'] = 'Invoice';
             $inputs['payment_responses'] = $invoice_id;
             $inputs['payment_at'] = Carbon::now();
             $inputs['used_in_case'] = $id;
             $inputs['status'] = 'CONFIRMED';
             $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
            if ($order) {
                $case->update([
                    'aligner_kit_order_id' => $order->id,
                    'payment_status' => 'first-installment',
                    'processing_fee_payment_at' => Carbon::now(),
                    'status' => 'CONFIRMED',
                ]);

                DB::commit();

                $username = $case->name;
                // $to = $case->email;
                $to = "info@accualigners.com";
                $subject = "Case Id: " . $case->id . " Aligner's Request";

                $data['case_id'] = $case->id;
                $data['doctor_name'] = $case->name;
                $data['patient_name'] = $username;
                $html = view('emails.orderAlignerNotification', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);
                return response()->json(['success' => 'Payment']);
                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            }

            DB::rollBack();
            return redirect()->back()->withErrors('Something went wrong');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function storeInvoice(Request $request)
    {
        try {
            $validated = $request->validate([
                'address_id' => 'required|exists:addresses,id',
                'invoiceId' => 'required',
            ]);

            DB::beginTransaction();

            $case = CaseModel::find($request->case);

            $caseDoctor = $case->doctor()->first();
            $settings = Setting::first();

            $user_id = $request->user()->id;
            $unit_amout = $settings->aligner_kit_price;
            $total_amount = ($unit_amout * $case->no_of_trays) + 0;

            $inputs = $request->only('street1', 'country_id', 'state_id', 'city_id', 'shipping_company_charge_id');
            $address = Address::find($request->address_id);
            $inputs['street1'] = $address->value;
            $inputs['address_id'] = $request->address_id;
            $inputs['country_id'] = $address->country_id;
            $inputs['state_id'] = $address->state_id;
            $inputs['city_id'] = $address->city_id;
            $inputs['case_id'] = $request->case;
            // $inputs['order_url'] = $request->order_url;
            $inputs['patient_id'] = $case->patient_id;
            $inputs['name'] = $case->name;
            $inputs['email'] = $case->email;
            $inputs['phone_no'] = $case->phone_no;
            $inputs['product'] = 'ALIGNER';
            $inputs['unit_amout'] = $unit_amout;
            $inputs['quantity'] = $case->no_of_trays;
            $inputs['shipping_charges'] = 0;
            $inputs['doctor_id'] = $caseDoctor->id;
            $inputs['doctor_name'] = $caseDoctor->name;
            $inputs['total_amount'] = $total_amount;
            $inputs['payment_name'] = 'Invoice';
            $inputs['payment_responses'] = "$request->invoiceId";
            $inputs['payment_at'] = Carbon::now();
            $inputs['used_in_case'] = $request->case;
            $inputs['status'] = 'CONFIRMED';
            $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
            if ($order) {
                $case->update([
                    'aligner_kit_order_id' => $order->id,
                    'payment_status' => 'first-installment',
                    'processing_fee_payment_at' => Carbon::now(),
                    'status' => 'CONFIRMED',
                ]);

                DB::commit();

                $username = $case->name;
                // $to = $case->email;
                $to = "info@accualigners.com";
                $subject = "Case Id: " . $case->id . " Aligner's Request";

                $data['case_id'] = $case->id;
                $data['doctor_name'] = $case->name;
                $data['patient_name'] = $username;
                $html = view('emails.orderAlignerNotification', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);
                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            }

            DB::rollBack();
            return redirect()->back()->withErrors('Something went wrong');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function indexSecondInstallment($id)
    {
         try {
            $case = CaseModel::find($id);
            $settings = Setting::first();
            $countries = Country::orderBy('name')->get();
            $ClinicDoctors =  ClinicDoctor::where(['doctor_id' => auth()->user()->id])->get();
            return view('doctor.container.case.case-order-aligner-remaining-form', compact('case', 'settings', 'countries', 'ClinicDoctors'));
         } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
         }

    }
    public function indexSecondInstallment_new(Request $request)
    {
         try {
            $case = CaseModel::find($request->id);
            $settings = Setting::first();
            $countries = Country::orderBy('name')->get();
            $ClinicDoctors =  ClinicDoctor::where(['doctor_id' => auth()->user()->id])->get();
            return response()->json(['case' => $case, 'settings' => $settings, 'countries' => $countries, 'ClinicDoctors' => $ClinicDoctors ] );
            // return view('doctor.container.case.case-order-aligner-remaining-form', compact('case', 'settings', 'countries', 'ClinicDoctors'));
         } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
         }

    }

    public function storeSecondInstallment_new(Request $request)
    {
        // dd($request->all());
        try {

             DB::beginTransaction();

             $case = CaseModel::find($request->id);
             $caseDoctor = $case->doctor()->first();
             $settings = Setting::first();

             $user_id = $request->user()->id;
             $unit_amout = $settings->aligner_kit_price;
             $case_fee = $settings->case_fee;
             $complete_treatment_plan = $settings->complete_treatment_plan;
             $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;

             Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
             $stripeRes = Stripe\Charge::create([
                "amount" => $total_amount * 100,
                "currency" => strtolower($settings->currency),
                "source" => $request->stripeToken,
                "description" => "Processing fee payment against case Id " . $request->id,
             ]);
            $order = Order::where('case_id', $request->id)->first();
            $total_amount = $total_amount * 2;
            $order->update([
                'total_amount' =>  $total_amount
            ]);
            $case->update([
                'payment_status' => 'second-installment',
                'status' => 'CONFIRMED',
            ]);
            $username = $case->name;
            // $to = $case->email;
            $to = "info@accualigners.com";
            $subject = "Case Id: " . $case->id . " Aligner's Final Payment";
            $data['case_id'] = $case->id;
            $data['name'] = $case->name;
            $data['buttons'] = [
                ['link' => url('admin/case/92'), 'text' => 'View Case']
            ];
            $data['body'] = 'The treatment plan for patient ' . $case->name . ' (case ID ' . $case->id . ') has been approved by Dr. ' . $username . ' Please proceed with printing and production.';
            $html = view('emails.general', $data)->render();
            $check = $this->sendMailViaPostMark($html, $to, $subject);

            DB::commit();
            return response()->json(['success' => 'Payment']);
            return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function storeSecondInstallment(Request $request, $id)
    {
        try {

            DB::beginTransaction();

             $case = CaseModel::find($id);
             $caseDoctor = $case->doctor()->first();
             $settings = Setting::first();

             $user_id = $request->user()->id;
             $unit_amout = $settings->aligner_kit_price;
             $case_fee = $settings->case_fee;
             $complete_treatment_plan = $settings->complete_treatment_plan;
             $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;

             Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
             $stripeRes = Stripe\Charge::create([
                "amount" => $total_amount * 100,
                "currency" => strtolower($settings->currency),
                "source" => $request->stripeToken,
                "description" => "Processing fee payment against case Id " . $id,
             ]);
            $order = Order::where('case_id', $id)->first();
            $total_amount = $total_amount * 2;
            $order->update([
                'total_amount' =>  $total_amount
            ]);
            $case->update([
                'payment_status' => 'second-installment',
                'status' => 'CONFIRMED',
            ]);

            $username = $case->name;
            // $to = $case->email;
            $to = "info@accualigners.com";
            $subject = "Case Id: " . $case->id . " Aligner's Final Payment";
            $data['case_id'] = $case->id;
            $data['name'] = $case->name;
            $data['buttons'] = [
                ['link' => url('admin/case/92'), 'text' => 'View Case']
            ];
            $data['body'] = 'The treatment plan for patient ' . $case->name . ' (case ID ' . $case->id . ') has been approved by Dr. ' . $username . ' Please proceed with printing and production.';
            $html = view('emails.general', $data)->render();
            $check = $this->sendMailViaPostMark($html, $to, $subject);

            DB::commit();
            return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function storeInvoiceSecondInstallment(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'invoiceId' => 'required',
            ]);

            DB::beginTransaction();

            $case = CaseModel::find($request->case);
            $caseDoctor = $case->doctor()->first();
            $settings = Setting::first();

            $user_id = $request->user()->id;
            $unit_amout = $settings->aligner_kit_price;
            $total_amount = ($unit_amout * $case->no_of_trays) + 0;

            $order = Order::where('case_id', $id)->first();
            $total_amount = $total_amount * 2;
            $order->update([
                'total_amount' =>  $total_amount
            ]);
            $case->update([
                'payment_status' => 'second-installment',
                'status' => 'CONFIRMED',
            ]);

            $username = $case->name;
            // $to = $case->email;
            $to = "info@accualigners.com";
            $subject = "Case Id: " . $case->id . " Aligner's Final Payment";
            $data['case_id'] = $case->id;
            $data['name'] = $case->name;
            $data['buttons'] = [
                ['link' => url('admin/case/92'), 'text' => 'View Case']
            ];
            $data['body'] = 'The treatment plan for patient ' . $case->name . ' (case ID ' . $case->id . ') has been approved by Dr. ' . $username . ' Please proceed with printing and production.';
            $html = view('emails.general', $data)->render();
            $check = $this->sendMailViaPostMark($html, $to, $subject);

            DB::commit();
            return redirect('doctor/case')->with(['successMessage' => 'Invoice successfully processed']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function storeInvoiceSecondInstallment_new(Request $request)
    {
        try {
            // $validated = $request->validate([
            //     'invoiceId' => 'required',
            // ]);

            DB::beginTransaction();

            $case = CaseModel::find($request->id);
            $caseDoctor = $case->doctor()->first();
            $settings = Setting::first();

            $user_id = $request->user()->id;
            $unit_amout = $settings->aligner_kit_price;
            // $total_amount = ($unit_amout * $case->no_of_trays) + 0;
            $case_fee = $settings->case_fee;
            $complete_treatment_plan = $settings->complete_treatment_plan;
            $total_amount = ((int) $complete_treatment_plan - (int) $case_fee) / 2;

            $order = Order::where('case_id', $request->id)->first();
            $total_amount = $total_amount * 2;
            $order->update([
                'total_amount' =>  $total_amount
            ]);
            $case->update([
                'payment_status' => 'second-installment',
                'status' => 'CONFIRMED',
            ]);

             $username = $case->name;
             // $to = $case->email;
             $to = "info@accualigners.com";
             $subject = "Case Id: " . $case->id . " Aligner's Final Payment";
             $data['case_id'] = $case->id;
             $data['name'] = $case->name;
             $data['buttons'] = [
                ['link' => url('admin/case/92'), 'text' => 'View Case']
             ];
             $data['body'] = 'The treatment plan for patient ' . $case->name . ' (case ID ' . $case->id . ') has been approved by Dr. ' . $username . ' Please proceed with printing and production.';
             $html = view('emails.general', $data)->render();
             $check = $this->sendMailViaPostMark($html, $to, $subject);

             DB::commit();
             return response()->json(['success' => 'Payment']);
             return redirect('doctor/case')->with(['successMessage' => 'Invoice successfully processed']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function missingTrayIndex($id)
    {
        try {
            $case = CaseModel::find($id);
            $settings = Setting::first();
            $countries = Country::orderBy('name')->get();
            $ClinicDoctors =  ClinicDoctor::where(['doctor_id' => auth()->user()->id])->get();
            return view('doctor.container.case.case-order-missing-tray-form', compact('case', 'settings', 'countries', 'ClinicDoctors'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function missingTrayIndex_new(Request $request)
    {
        try {
             $case = CaseModel::find($request->id);
             $settings = Setting::first();
             $countries = Country::orderBy('name')->get();
             $ClinicDoctors =  ClinicDoctor::where(['doctor_id' => auth()->user()->id])->get();
             return response()->json(['case' => $case, 'settings' => $settings, 'countries' => $countries, 'ClinicDoctors' => $ClinicDoctors ] );
             return view('doctor.container.case.case-order-missing-tray-form', compact('case', 'settings', 'countries', 'ClinicDoctors'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function missingTrayStoreStripe(Request $request)
    {
        $validated = $request->validate([
            'stripeToken' => 'required',
            'order_type' => 'required',
        ]);
        if ($request->order_type == "missing-tray") {
            $validated = $request->validate([
                'tray_number' => 'required',
            ]);
        } else {
            $validated = $request->validate([
                'no_of_trays' => 'required',
            ]);
        }
        try {

            DB::beginTransaction();

            $case = CaseModel::find($request->case);
            $order = Order::where('case_id', $request->case)->first();

            $caseDoctor = $case->doctor()->first();
            $settings = Setting::first();

            $user_id = $request->user()->id;
            $total_amount = $request->total_amount;
            $unit_amout = $settings->aligner_kit_price;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripeRes = Stripe\Charge::create([
                "amount" => $total_amount * 100,
                "currency" => strtolower($settings->currency),
                "source" => $request->stripeToken,
                "description" => "Processing fee payment against case Id " . $case->id,
            ]);

            $inputs = [];
            $inputs['street1'] = $order->street1;
            $inputs['address_id'] = $order->address_id;
            $inputs['country_id'] = $order->country_id;
            $inputs['state_id'] = $order->state_id;
            $inputs['city_id'] = $order->city_id;
            $inputs['case_id'] = $request->case;
            $inputs['patient_id'] = $order->patient_id;
            $inputs['name'] = $order->name;
            $inputs['email'] = $order->email;
            $inputs['phone_no'] = $order->phone_no;
            $inputs['product'] = 'ALIGNER';
            $inputs['unit_amout'] = $unit_amout;
            $inputs['quantity'] = $request->no_of_trays;
            $inputs['shipping_charges'] = 0;
            $inputs['doctor_id'] = $order->doctor_id;
            $inputs['doctor_name'] = $order->doctor_name;
            $inputs['total_amount'] = $total_amount;
            $inputs['payment_name'] = 'Stripe';
            $inputs['payment_responses'] = "$stripeRes";
            $inputs['payment_at'] = Carbon::now();
            $inputs['used_in_case'] = $request->case;
            $inputs['status'] = 'CONFIRMED';
            $inputs['created_by'] = $user_id;

            $newOrder = Order::create($inputs);
            if ($newOrder) {
                DB::commit();
                $to = "info@accualigners.com";
                $data['case_id'] = $case->id;
                $data['name'] = "Dentist";
                $data['buttons'] = [
                    ['link' => url('admin/case/92'), 'text' => 'View Case']
                ];
                if ($request->order_type == "missing-tray") {
                    $subject = "Case Id: " . $case->id . " Missing Tray Request";
                    $data['body'] = 'I am writing to request an missing tray number #' . $request->tray_number . '  for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                } else {
                    $subject = "Case Id: " . $case->id . " Additional Tray Request";
                    $data['body'] = 'I am writing to request an ' . $request->no_of_trays . ' additional tray for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                }
                $html = view('emails.general', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);
                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors('Something went wrong');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function missingTrayStoreStripe_new(Request $request)
    {
        // $validated = $request->validate([
        //     'stripeToken' => 'required',
        //     'order_type' => 'required',
        // ]);
        // if ($request->order_type == "missing-tray") {
        //     $validated = $request->validate([
        //         'tray_number' => 'required',
        //     ]);
        // } else {
        //     $validated = $request->validate([
        //         'no_of_trays' => 'required',
        //     ]);
        // }


        try {

            DB::beginTransaction();

            $case = CaseModel::find($request->id);
            $order = Order::where('case_id', $request->id)->first();

            $caseDoctor = $case->doctor()->first();
            $settings = Setting::first();

            $user_id = $request->user()->id;
            $total_amount = $request->total_amount;
            $unit_amout = $settings->aligner_kit_price;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripeRes = Stripe\Charge::create([
                "amount" => $total_amount * 100,
                "currency" => strtolower($settings->currency),
                "source" => $request->stripeToken,
                "description" => "Processing fee payment against case Id " . $case->id,
            ]);

            $inputs = [];
            $inputs['street1'] = $order->street1;
            $inputs['address_id'] = $order->address_id;
            $inputs['country_id'] = $order->country_id;
            $inputs['state_id'] = $order->state_id;
            $inputs['city_id'] = $order->city_id;
            $inputs['case_id'] = $request->id;
            $inputs['patient_id'] = $order->patient_id;
            $inputs['name'] = $order->name;
            $inputs['email'] = $order->email;
            $inputs['phone_no'] = $order->phone_no;
            $inputs['product'] = 'ALIGNER';
            $inputs['unit_amout'] = $unit_amout;
            $inputs['quantity'] = $request->no_of_trays;
            $inputs['shipping_charges'] = 0;
            $inputs['doctor_id'] = $order->doctor_id;
            $inputs['doctor_name'] = $order->doctor_name;
            $inputs['total_amount'] = $total_amount;
            $inputs['payment_name'] = 'Stripe';
            $inputs['payment_responses'] = "$stripeRes";
            $inputs['payment_at'] = Carbon::now();
            $inputs['used_in_case'] = $request->id;
            $inputs['status'] = 'CONFIRMED';
            $inputs['created_by'] = $user_id;

            $newOrder = Order::create($inputs);
            if ($newOrder) {
                DB::commit();
                $to = "info@accualigners.com";
                $data['case_id'] = $case->id;
                $data['name'] = "Dentist";
                $data['buttons'] = [
                    ['link' => url('admin/case/92'), 'text' => 'View Case']
                ];
                // if ($request->order_type == "missing-tray") {
                    $subject = "Case Id: " . $case->id . " Missing Tray Request";
                    $data['body'] = 'I am writing to request an missing tray number #' . $request->no_of_trays . '  for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                // }
                //  else {
                //     $subject = "Case Id: " . $case->id . " Additional Tray Request";
                //     $data['body'] = 'I am writing to request an ' . $request->no_of_trays . ' additional tray for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                // }
                $html = view('emails.general', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);
                  /* updating no of missing trays */
                  $case_amount=CaseModel::where('id',$request->id)->first();
                $trays_amount=  ($case_amount->missing_trays_amount == NULL) ? 0 : $case_amount->missing_trays_amount ;
                $total_amount_actual= $request->total_amount + $trays_amount;

           if(CaseModel::where('id',$request->id)->update(['no_of_missing_trays' => NULL, 'missing_trays_amount' =>   $total_amount_actual ])){
            return response()->json(['success' => 'Payment']);
        }else{
                DB::rollBack();
                return resposne()->json(['success' => 'error']);
            }
                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors('Something went wrong');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function missingTrayStoreInvoice(Request $request)
    {
        $validated = $request->validate([
            'invoiceId' => 'required',
            'order_type' => 'required',
        ]);
        if ($request->order_type == "missing-tray") {
            $validated = $request->validate([
                'tray_number' => 'required',
            ]);
        } else {
            $validated = $request->validate([
                'no_of_trays' => 'required',
            ]);
        }
        try {

            DB::beginTransaction();

            $case = CaseModel::find($request->case);
            $order = Order::where('case_id', $request->case)->first();

            $caseDoctor = $case->doctor()->first();
            $settings = Setting::first();

            $user_id = $request->user()->id;
            $total_amount = $request->total_amount;
            $unit_amout = $settings->aligner_kit_price;

            $inputs = [];
            $inputs['street1'] = $order->street1;
            $inputs['address_id'] = $order->address_id;
            $inputs['country_id'] = $order->country_id;
            $inputs['state_id'] = $order->state_id;
            $inputs['city_id'] = $order->city_id;
            $inputs['case_id'] = $request->case;
            $inputs['patient_id'] = $order->patient_id;
            $inputs['name'] = $order->name;
            $inputs['email'] = $order->email;
            $inputs['phone_no'] = $order->phone_no;
            $inputs['product'] = 'ALIGNER';
            $inputs['unit_amout'] = $unit_amout;
            $inputs['quantity'] = $request->no_of_trays;
            $inputs['shipping_charges'] = 0;
            $inputs['doctor_id'] = $order->doctor_id;
            $inputs['doctor_name'] = $order->doctor_name;
            $inputs['total_amount'] = $total_amount;
            $inputs['payment_name'] = 'Invoice';
            $inputs['payment_responses'] = "$request->invoiceId";
            $inputs['payment_at'] = Carbon::now();
            $inputs['used_in_case'] = $request->case;
            $inputs['status'] = 'CONFIRMED';
            $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
            if ($order) {
                DB::commit();
                $to = "info@accualigners.com";
                $data['case_id'] = $case->id;
                $data['name'] = "Dentist";
                $data['buttons'] = [
                    ['link' => url('admin/case/92'), 'text' => 'View Case']
                ];
                if ($request->order_type == "missing-tray") {
                    $subject = "Case Id: " . $case->id . " Missing Tray Request";
                    $data['body'] = 'I am writing to request an missing tray number #' . $request->tray_number . '  for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                } else {
                    $subject = "Case Id: " . $case->id . " Additional Tray Request";
                    $data['body'] = 'I am writing to request an ' . $request->no_of_trays . ' additional tray for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                }
                $html = view('emails.general', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);
                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            }

            DB::rollBack();
            return redirect()->back()->withErrors('Something went wrong');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function missingTrayStoreInvoice_new(Request $request)
    {
        // $validated = $request->validate([
        //     'invoiceId' => 'required',
        //     'order_type' => 'required',
        // ]);
        // if ($request->order_type == "missing-tray") {
        //     $validated = $request->validate([
        //         'tray_number' => 'required',
        //     ]);
        // } else {
        //     $validated = $request->validate([
        //         'no_of_trays' => 'required',
        //     ]);
        // }

        try {

            DB::beginTransaction();

            $case = CaseModel::find($request->id);
            $order = Order::where('case_id', $request->id)->first();

            $caseDoctor = $case->doctor()->first();
            $settings = Setting::first();
            $invoice_id=rand(9,99999999999999);

            $user_id = $request->user()->id;
            $total_amount = $request->total_amount;
            $unit_amout = $settings->aligner_kit_price;

            $inputs = [];
            $inputs['street1'] = $order->street1;
            $inputs['address_id'] = $order->address_id;
            $inputs['country_id'] = $order->country_id;
            $inputs['state_id'] = $order->state_id;
            $inputs['city_id'] = $order->city_id;
            $inputs['case_id'] = $request->id;
            $inputs['patient_id'] = $order->patient_id;
            $inputs['name'] = $order->name;
            $inputs['email'] = $order->email;
            $inputs['phone_no'] = $order->phone_no;
            $inputs['product'] = 'ALIGNER';
            $inputs['unit_amout'] = $unit_amout;
            $inputs['quantity'] = $request->no_of_trays;
            $inputs['shipping_charges'] = 0;
            $inputs['doctor_id'] = $order->doctor_id;
            $inputs['doctor_name'] = $order->doctor_name;
            $inputs['total_amount'] = $total_amount;
            $inputs['payment_name'] = 'Invoice';
            $inputs['payment_responses'] = $invoice_id;
            $inputs['payment_at'] = Carbon::now();
            $inputs['used_in_case'] = $request->id;
            $inputs['status'] = 'CONFIRMED';
            $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
            if ($order) {
                DB::commit();
                 $to = "info@accualigners.com";
                 $data['case_id'] = $case->id;
                 $data['name'] = "Dentist";
                 $data['buttons'] = [
                    ['link' => url('admin/case/92'), 'text' => 'View Case']
                 ];
                //  if ($request->order_type == "missing-tray") {
                    $subject = "Case Id: " . $case->id . " Missing Tray Request";
                    $data['body'] = 'I am writing to request an missing tray number #' . $request->no_of_trays . '  for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                // } else {
                //     $subject = "Case Id: " . $case->id . " Additional Tray Request";
                //     $data['body'] = 'I am writing to request an ' . $request->no_of_trays . ' additional tray for patient ' . $case->name . ' (case ID ' . $case->id . '). Please let me know if you need any further information or if there are any issues with the order.';
                // }
                $html = view('emails.general', $data)->render();
                $check = $this->sendMailViaPostMark($html, $to, $subject);

                 $case_amount=CaseModel::where('id',$request->id)->first();
                 $trays_amount=  ($case_amount->missing_trays_amount == NULL) ? 0 : $case_amount->missing_trays_amount ;
                 $total_amount_actual= $request->total_amount + $trays_amount;

           if(CaseModel::where('id',$request->id)->update(['no_of_missing_trays' => NULL, 'missing_trays_amount' =>   $total_amount_actual ])){
                      return response()->json(['success' => 'Payment']);
                }else{
                    DB::rollBack();
                    return response()->json(['success' => 'error']);
                }
                return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
            }

            DB::rollBack();

            return response()->json(['success' => 'error']);

            return redirect()->back()->withErrors('Something went wrong');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }




    public function getShippingDetail(Request $request)
    {
        try {
            return successJsonResponse_h('', ShippingCompanyCharge::find($request->shipping_company_charge_id));
        } catch (Exception $e) {
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
