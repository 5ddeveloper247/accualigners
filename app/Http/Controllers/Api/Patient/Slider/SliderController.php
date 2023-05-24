<?php

namespace App\Http\Controllers\Api\Patient\Slider;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Patient\Slider\SliderResource;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        try{
            return successJsonResponse_h('', SliderResource::collection(Slider::orderBy('sort_order')->get()));
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
