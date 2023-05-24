<?php

namespace App\Http\Controllers\Api\Patient\CaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\CaseRequest\CaseCheckInRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseCheckOutRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseDestroyRequest;
use App\Http\Resources\Api\Patient\CaseRes\CaseTimeLogResource;
use App\Models\CaseTimeLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseTimeLogController extends Controller
{
    
    public function timelogs(CaseDestroyRequest $request, $id){
        try{
            $CaseTimeLogs = CaseTimeLog::where('case_id', $id)->get();
            
            return successJsonResponse_h('', CaseTimeLogResource::collection($CaseTimeLogs));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
    
    public function checkIn(CaseCheckInRequest $request, $id){
        try{
            $inputs = $request->only('tray_no', 'day');
            $inputs['case_id'] = $id;
            $inputs['check_in'] = time();
            $CaseTimeLog = CaseTimeLog::create($inputs);
            
            return successJsonResponse_h('Created successfully', new CaseTimeLogResource($CaseTimeLog));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
    
    public function checkOut(CaseCheckOutRequest $request, $id){
        try{
            dd(time());
            $CaseTimeLog = CaseTimeLog::find($id);
            $CaseTimeLog->check_out = time();
            $CaseTimeLog->save();

            return successJsonResponse_h('Updated successfully', new CaseTimeLogResource($CaseTimeLog));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
    
    public function timelogUpdateCheckoutCron(){
        try{

            CaseTimeLog::where(function($q){
                $q->whereNull('check_out')->orWhere('check_out', '');
            })->update([
                'check_out' => DB::raw("unix_timestamp(concat(from_unixtime(`check_in`, '%Y-%m-%d'), ' 23:59:59'))")
            ]);
            
            return successJsonResponse_h('Updated successfully');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

}
