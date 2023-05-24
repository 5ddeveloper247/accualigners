<?php

namespace App\Http\Controllers\Api\Patient\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Order\OrderImpressionKitAddToCartRequest;
use App\Http\Resources\Api\Patient\Order\OrderResource;
use App\Models\Order;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class OrderImpressionKitController extends Controller
{

    public function index(Request $request){
        try{

            $order = Order::where('patient_id', $request->user()->id)->where('product', 'IMPRESSION KIT')->get();

            return successJsonResponse_h('', OrderResource::collection($order));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }


    public function create(OrderImpressionKitAddToCartRequest $request){

        try{
            $setting = Setting::first();
            $user_id = $request->user()->id;

            $inputs = $request->only('name', 'email', 'phone_no');

            $inputs['patient_id'] = $user_id;
            $inputs['product'] = 'IMPRESSION KIT';
            $inputs['unit_amout'] = $setting->impression_kit_price;
            $inputs['quantity'] = 1;
            $inputs['total_amount'] = $setting->impression_kit_price;
            $inputs['created_by'] = $user_id;

            $order = Order::create($inputs);
            
            return successJsonResponse_h('', new OrderResource($order));
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
