<?php

namespace App\Http\Controllers\Web\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Order\OrderEditRequest;
use App\Http\Requests\Web\Admin\Order\OrderUpdateRequest;
use App\Models\CaseModel;
use App\Models\Doctor;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use App\Traits\EmailTrait;

class OrderController extends Controller
{
    use EmailTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_old(Request $request)
    {


        try{
            $product =  null;
            if($request->has('product')){
                if($request->product == 'aligner'){
                    $product =  'ALIGNER';
                }elseif($request->product == 'impression-kit'){
                    $product =  'IMPRESSION KIT';
                }
            }
            $orders = Order::select('*');

            if(!empty($product)){
                $orders = $orders->where('product', $product);
            }

            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $orders = $orders->where(function ($query) use($filter){
                    $query->where('id', 'like', "%".$filter."%")
                        ->orWhere('name', 'like', "%".$filter."%")
                        ->orWhere('phone_no', 'like', "%".$filter."%")
                        ->orWhere('email', 'like', "%".$filter."%");
                });
            }

            $orders = $orders->orderBy('id', 'desc')->paginate(15);
            return view('originator.container.order.order-view', compact('orders'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function index(Request $request)
    {

        try{
            $product =  null;
            if($request->has('product')){
                if($request->product == 'aligner'){
                    $product =  'ALIGNER';
                }elseif($request->product == 'impression-kit'){
                    $product =  'IMPRESSION KIT';
                }
            }
            $orders = Order::select('*');

            if(!empty($product)){
                $orders = $orders->where('product', $product);
            }

            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $orders = $orders->where(function ($query) use($filter){
                    $query->where('id', 'like', "%".$filter."%")
                        ->orWhere('name', 'like', "%".$filter."%")
                        ->orWhere('phone_no', 'like', "%".$filter."%")
                        ->orWhere('email', 'like', "%".$filter."%");
                });
            }

            $orders = $orders->orderBy('id', 'desc')->paginate(15);
            // dd($orders);
            return view('originator.container.order.order-view-new', compact('orders'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderEditRequest $request, $id)
    {

        try{
              $order = Order::find($id);

              $case = CaseModel::find($order->case_id);
              $data['edit_values'] = $order;
            if($case!=null){

              $data['case'] = $case;
              $data['doctor'] = $case->doctor()->first();

             }

             return view('originator.container.order.order-form', $data);
        }catch(Exception $e){
             return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function order_edit($id){
             try{
                $order= Order::find($id);
            // dd($order->country->name);
             $country=$order->country->name;
             $state=$order->state->name;
             $city=$order->city->name;
                $case =CaseModel::find($order->case_id);
                $data['country']=$country;
                $data['state']=$state;
                $data['city']=$city;

                $data['edit_values']= $order;
                if($case!=null){
                    $data['case'] = $case;
                    $data['doctor']=$case->doctor()->first();
                }
                return response()->json(['data' => $data]);
             }catch(Exception $e){
                return response()->json(['data' => 'error']);
             }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, $id)
    {
         try{
            $inputs = $request->only(['status', 'order_url']);
            $order = Order::find($id);
            $order->update($inputs);
            $CaseModel = CaseModel::with('doctor')->find($order->case_id);
            $username = $CaseModel->doctor->name;
            $to = $CaseModel->doctor->email;
            $subject = "Order Status Update";
            $data['case_id'] = $CaseModel->id;
            $data['doctor_name'] = $username;
         if($order->order_url != null){
                 $data['order_url'] = $order->order_url;
         }

         if($inputs['status'] === "DISPATCHED"){
                $CaseModel->update(['status' => 'CLOSED']);
            }

            $data['body'] = 'The delivery status for the Accualigners Trays has been ' .$order->status. ' for case ID '.$CaseModel->id.', belonging to '. $CaseModel->name .', can be found in the link provided';
             $data['subject'] =$subject;
             $data['email'] =$to;
             $this->sendMail($data, 'emails.orderStatus');

            return redirect()->back()->with(['successMessage' => 'Order status updated successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function order_update(Request  $request){
        // dd($request->all());
        try{
            $inputs = $request->only(['status', 'order_url']);
            $order = Order::find($request->id);
            $order->status=$request->status;
            $order->order_url=$request->order_url;
            $order->save();
            // $order->update($inputs);
            $CaseModel = CaseModel::with('doctor')->find($order->case_id);
            $username = $CaseModel->doctor->name;
            $to = $CaseModel->doctor->email;
            $subject = "Order Status Update";
            $data['case_id'] = $CaseModel->id;
            $data['doctor_name'] = $username;
            if($order->order_url != null){
                 $data['order_url'] = $order->order_url;
            }

            if($request->status === "DISPATCHED"){
                $CaseModel->update(['status' => 'CLOSED']);
            }

            $data['body'] = 'The delivery status for the Accualigners Trays has been ' .$order->status. ' for case ID '.$CaseModel->id.', belonging to '. $CaseModel->name .', can be found in the link provided';
            $data['subject'] =$subject;
            $data['email'] =$to;
            $this->sendMail($data, 'emails.orderStatus');


            //Admin
            $to = "info@accualigners.com";
            $data['subject'] =$subject;
            $data['email'] =$to;
            $this->sendMail($data, 'emails.orderStatusAdmin');


            return response()->json(['successMessage' => 'success']);

        }catch(Exception $e){
            return response()->json(['successMessage' => 'error']);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $order = Order::find($id);
            $order->forceDelete();
            return successJsonResponse_h('Order deleted successfully');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function delete(Request $request){

          try{
            // return response()->json(['message'=>'success']);
            $order = Order::find(intval($request->id));
            $order->forceDelete();
            return response()->json(['message'=>'success']);
        }catch(Exception $e){
            return response()->json(['message' => 'error']);
         }
    }
}
