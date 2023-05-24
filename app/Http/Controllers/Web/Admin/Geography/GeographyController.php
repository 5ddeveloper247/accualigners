<?php

namespace App\Http\Controllers\Web\Admin\Geography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Patient\Shipping\ShippingChargesResource;
use App\Models\City;
use App\Models\ShippingCompanyCharge;
use App\Models\State;
use Exception;
use Illuminate\Http\Request;

class GeographyController extends Controller
{
    public function getStateByCountry(Request $request){
        try{
            return successJsonResponse_h('', State::where('country_id', $request->country_id)->get());
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
    
    public function getCityByState(Request $request){
        try{
            return successJsonResponse_h('', City::where('state_id', $request->state_id)->get());
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
    
    public function getShippingByCity(Request $request){
        try{
            $country_id = $request->country_id;
            $state_id = $request->state_id;
            $city_id = $request->city_id;

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
}
