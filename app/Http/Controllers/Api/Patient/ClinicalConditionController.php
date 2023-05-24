<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Models\ClinicalCondition;
use Exception;
use Illuminate\Http\Request;

class ClinicalConditionController extends Controller
{
    public function index(){
        try{

            return successJsonResponse_h('', ClinicalCondition::select('id', 'name')->get());

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
