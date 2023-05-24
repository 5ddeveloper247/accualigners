<?php

namespace App\Http\Controllers\Web\Admin\CaseCon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\CaseReq\CasePaymentIndexRequest;
use App\Http\Requests\Web\Admin\CaseReq\CasePaymentStoreRequest;
use App\Http\Requests\Web\Admin\CaseReq\CasePaymentStoreInvoiceRequest;
use App\Models\CaseModel;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CaseNotification\TreatmentPlanNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Stripe;
use App\Traits\EmailTrait;

class PaymentController extends Controller
{
    use EmailTrait;
    
//     public function index(CasePaymentIndexRequest $request, $id){
        
//         try{
//              $case = CaseModel::find($id);
//              $settings = Setting::first();
//              return view('doctor.container.case.case-payment-form', compact('case', 'settings'));
//          }catch(Exception $e){
//              return redirect()->back()->withErrors($e->getMessage());
//          }
//     }
//     public function index_new(Request $request)
//     {
//         try{
//             $case = CaseModel::find($request->id);
//             $settings = Setting::first();

//             return response()->json(['case'=> $case, 'setting' => $settings]);
//             return view('doctor.container.case.case-payment-form', compact('case', 'settings'));
//         }catch(Exception $e){
//             return redirect()->back()->withErrors($e->getMessage());
//         }
//     }

    public function invoice_store(Request $request){
          try{
            $case = CaseModel::find($request->id);
            $settings = Setting::first();
            $case->update([
                'digital_scan_fee' => 1, 
                'digital_scan_amount' => 1000, 
                'payment_status' => 'digital_scan'
           ]);
           
           $username = $case->name;
           $to = "info@accualigners.com";
           $subject = "Case Id: ". $case->id ." Digital Scan Paid";
           $data['case_id'] = $case->id;
           $data['name'] = "Admin";
           $data['buttons'] = [
            [ 'link' => url('admin/case/'.$case->id), 'text' => 'View Case']
           ];
           $data['body'] = 'Please review the files sent by Dr. '.auth()->user()->name.' for digital scan of the patient '. $case->name .' (case ID '.$case->id.'), including scans of the upper and lower jaw and a profile picture.';
           $html = view('emails.general', $data)->render();
               $check = $this->sendMailViaPostMark($html, $to, $subject);
            
           return response()->json(['data' => 'success']);

           return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
       }catch(Exception $e){
           return redirect()->back()->withErrors($e->getMessage());
       }

 }
    
//     public function storeInvoice(Request $request){
        
//         try{

//              $case = CaseModel::find($request->case);
             
//              $settings = Setting::first();
//              $case->update([
//                 'processing_fee_paid' => 1, 
//                 'processing_fee_payment_name' => 'Invoice', 
//                 'processing_fee_payment_responses' => "Payment Processed",
//                 'processing_fee_payment_at' => Carbon::now(),
//                 'payment_status' => 'treatment-plan'
//             ]);

//             /// Doctor
//             // $username = auth()->user()->name;
//             // $to = auth()->user()->email;
//             // $subject = "Treatment Plan Process";
            
//             // $data['case_id'] =  $case->id;
//             // $data['doctor_name'] = auth()->user()->name;
//             // $html = view('emails.general',$data)->render();
//             // $check = $this->sendMailViaPostMark($html, $to, $subject);
            
//             $username = $case->name;
//             $to = "info@accualigners.com";
//             $subject = "Case Id: ". $case->id ." Treatment Plan Process";
//             $data['case_id'] = $case->id;
//             $data['name'] = "Dentist";
//             $data['buttons'] = [
//              [ 'link' => url('admin/case/92'), 'text' => 'View Case']
//             ];
//             $data['body'] = 'Please review the files sent by Dr. '.auth()->user()->name.' for treatment planning of patient '. $case->name .' (case ID '.$case->id.'), including scans of the upper and lower jaw and a profile picture.';
//             $html = view('emails.general', $data)->render();
//             $check = $this->sendMailViaPostMark($html, $to, $subject);
            
//             return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
//             // return redirect()->back()->with(['successMessage' => 'Payment successfully processed']);
//         }catch(Exception $e){
//             // dd($e);
//             return redirect()->back()->withErrors($e->getMessage());
//         }
//     }

    public function store_new(Request $request){
             
        try{
            $case = CaseModel::find($request->id);
            $settings = Setting::first();
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripeRes = Stripe\Charge::create ([
                    "amount" => 1000,
                    "currency" => strtolower($settings->currency),
                    "source" => $request->stripeToken,
                    "description" => "Processing fee payment against case Id " . $request->id 
           ]);
            $case->update([
               'digital_scan_fee' => 1, 
               'digital_scan_amount' => 1000, 
               'payment_status' => 'digital_scan'
            ]);
           
           
           $username = $case->name;
           $to = "info@accualigners.com";
           $subject = "Case Id: ". $case->id ." Digital Scan Paid";
           $data['case_id'] = $case->id;
           $data['name'] = "Admin";
           $data['buttons'] = [
            [ 'link' => url('admin/case/'.$case->id), 'text' => 'View Case']
           ];
           $data['body'] = 'Please review the files sent by Dr. '.auth()->user()->name.' for digital scan of the patient '. $case->name .' (case ID '.$case->id.'), including scans of the upper and lower jaw and a profile picture.';
           $html = view('emails.general', $data)->render();
               $check = $this->sendMailViaPostMark($html, $to, $subject);
            
           return response()->json(['data' => 'success']);

           return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
       }catch(Exception $e){
           return redirect()->back()->withErrors($e->getMessage());
       }

    }

    // public function store(CasePaymentStoreRequest $request, $id){
    //     try{
    //          $case = CaseModel::find($id);
    //          $settings = Setting::first();
    //          Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //          $stripeRes = Stripe\Charge::create ([
    //                  "amount" => $case->processing_fee_amount * 100,
    //                  "currency" => strtolower($settings->currency),
    //                  "source" => $request->stripeToken,
    //                  "description" => "Processing fee payment against case Id " . $id 
    //         ]);
    //          $case->update([
    //             'processing_fee_paid' => 1, 
    //             'processing_fee_payment_name' => 'Stripe', 
    //             'processing_fee_payment_responses' => "Payment Processed",
    //             'processing_fee_payment_at' => Carbon::now(),
    //             'payment_status' => 'treatment-plan'
    //          ]);
            
    //         /// Doctor
    //         // $username = auth()->user()->name;
    //         // $to = auth()->user()->email;
    //         // $subject = "Treatment Plan Process";
            
    //         // $data['case_id'] =  $case->id;
    //         // $data['doctor_name'] = auth()->user()->name;
    //         // $html = view('emails.general',$data)->render();
    //         // $check = $this->sendMailViaPostMark($html, $to, $subject);
            
    //         $username = $case->name;
    //         $to = "info@accualigners.com";
    //         $subject = "Case Id: ". $case->id ." Treatment Plan Process";
    //         $data['case_id'] = $case->id;
    //         $data['name'] = "Dentist";
    //         $data['buttons'] = [
    //          [ 'link' => url('admin/case/92'), 'text' => 'View Case']
    //         ];
    //         $data['body'] = 'Please review the files sent by Dr. '.auth()->user()->name.' for treatment planning of patient '. $case->name .' (case ID '.$case->id.'), including scans of the upper and lower jaw and a profile picture.';
    //         $html = view('emails.general', $data)->render();
    //         $check = $this->sendMailViaPostMark($html, $to, $subject);
    //         return redirect('doctor/case')->with(['successMessage' => 'Payment successfully processed']);
    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }
}
