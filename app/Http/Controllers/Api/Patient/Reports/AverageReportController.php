<?php

namespace App\Http\Controllers\Api\Patient\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Reports\AverageReportByDaysRequest;
use App\Models\CaseTimeLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AverageReportController extends Controller
{
    public function averageReportByDays(AverageReportByDaysRequest $request, $case_id){
        try{

            $no_of_days = collect($request->no_of_days)->toArray();
            $avgArray = [];

            foreach($no_of_days as $no_of_day){
                $date = \Carbon\Carbon::today()->subDays($no_of_day)->toDateString();
                // dd($date);
                $CaseTimeLog = CaseTimeLog::where('case_id', $case_id)->whereDate('created_at', '>=', $date)->where('check_out','!=','')->whereNotNull('check_out')->avg(DB::raw('`check_out`-`check_in`'));
                $avgMins = round($CaseTimeLog/60);

                $avgArray[] = ['no_of_days' => $no_of_day, 'average_minuts' => $avgMins];
            }
            
            return successJsonResponse_h('', $avgArray);

        }catch(Exception $e){
            errorJsonResponse_h($e->getMessage());
        }
    }
}
