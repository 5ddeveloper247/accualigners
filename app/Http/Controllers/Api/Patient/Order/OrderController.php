<?php

namespace App\Http\Controllers\Api\Patient\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Order\OrderAddShippingChargesRequest;
use App\Http\Requests\Api\Patient\Order\OrderCheckoutRequest;
use App\Http\Requests\Api\Patient\Order\OrderGetShippingRequest;
use App\Http\Requests\Api\Patient\Order\OrderImpressionKitAddAddressRequest;
use App\Http\Resources\Api\Patient\Order\OrderResource;
use App\Http\Resources\Api\Patient\Shipping\ShippingChargesResource;
use App\Models\Order;
use App\Models\ShippingCompanyCharge;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addAddress(OrderImpressionKitAddAddressRequest $request, $order_id){
        try{
            $order = Order::find($order_id);
            $order->fill($request->only('street1', 'street2', 'country_id', 'state_id', 'city_id'));
            $order->save();

            return successJsonResponse_h('Added successfully', new OrderResource($order));
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function getShipping(OrderGetShippingRequest $request, $order_id){
        try{
            
            $order = Order::find($order_id);
            $country_id = $order->country_id;
            $state_id = $order->state_id;
            $city_id = $order->city_id;

            $ShippingCompanyCharge = ShippingCompanyCharge::where(function($q) use($country_id, $state_id, $city_id){
                $q
                ->where(function($qs) use($country_id, $state_id, $city_id){$qs->where('country_id', $country_id)->where('state_id', $state_id)->where('city_id', $city_id);})
                ->orWhere(function($qs) use($country_id, $state_id){$qs->where('country_id', $country_id)->where('state_id', $state_id)->whereNull('city_id');})
                ->orWhere(function($qs) use($country_id){$qs->where('country_id', $country_id)->whereNull('state_id')->whereNull('city_id');})
                ;
            })->orderBy('amount')->get();

            return successJsonResponse_h('', ShippingChargesResource::collection($ShippingCompanyCharge));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function addShipping(OrderAddShippingChargesRequest $request, $order_id){

        try{

            $ShippingCompanyCharge = ShippingCompanyCharge::find($request->shipping_company_charge_id);

            $order = Order::find($order_id);

            $total_amount = ($order->unit_amout * $order->quantity) + $ShippingCompanyCharge->amount - $order->discount;
            $order->shipping_company_charge_id = $ShippingCompanyCharge->id;
            $order->shipping_charges = $ShippingCompanyCharge->amount;
            $order->total_amount = $total_amount;
            $order->save();

            return successJsonResponse_h('Added successfully', new OrderResource($order));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }

    }

    public function checkout(OrderCheckoutRequest $request, $order_id){

        try{

            $order = Order::find($order_id);
            $order->payment_name = $request->payment_name;
            $order->status = 'CONFIRMED';
            $order->save();

            return successJsonResponse_h('Order has been confirmed', new OrderResource($order));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }

    }
}
