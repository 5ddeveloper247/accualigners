<?php

namespace App\Http\Controllers\Api\Patient\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Order\OrderAlignerKitAddToCartRequest;
use App\Http\Requests\Api\Patient\Order\OrderImpressionKitAddToCartRequest;
use App\Http\Resources\Api\Patient\Order\OrderResource;
use App\Models\CaseModel;
use App\Models\Order;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderAlignerKitController extends Controller
{

    public function index(Request $request){

        try{

            $order = Order::where('patient_id', $request->user()->id)->where('product', 'ALIGNER')->get();

            return successJsonResponse_h('', OrderResource::collection($order));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }


    public function create(OrderAlignerKitAddToCartRequest $request){

        try{
            DB::beginTransaction();
            $setting = Setting::first();
            $user_id = $request->user()->id;
            $unit_amout = $setting->aligner_kit_price;
            $CaseModel = CaseModel::find($request->case_id);
            $inputs = $request->only('name', 'email', 'phone_no');

            $inputs['patient_id'] = $user_id;
            $inputs['product'] = 'ALIGNER';
            $inputs['unit_amout'] = $unit_amout;
            $inputs['quantity'] = $CaseModel->no_of_trays;
            $inputs['total_amount'] = $unit_amout * $CaseModel->no_of_trays;
            $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
            if($order){
                $CaseModel->aligner_kit_order_id = $order->id;
                $CaseModel->save();
                
                DB::commit();
                return successJsonResponse_h('Created successfully', new OrderResource($order));
            }
            
            DB::rollBack();
            return errorJsonResponse_h('Something went wrong');
            
        }catch(Exception $e){
            DB::rollBack();
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
