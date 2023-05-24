<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        // return successJsonResponse_h('', Setting::first());
        return response()->json(["Success" => true],200);
    }
}
