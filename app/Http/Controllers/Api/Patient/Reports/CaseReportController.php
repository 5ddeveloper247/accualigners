<?php

namespace App\Http\Controllers\Api\Patient\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\Reports\ReportByDateRequest;
use App\Http\Requests\Api\Patient\Reports\ReportByDayRequest;
use App\Models\CaseTimeLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseReportController extends Controller
{

    public function reportByDate(ReportByDateRequest $request, $case_id){
        try{

            $date_from = date('Y-m-d', strtotime($request->date_from));
            $date_to = date('Y-m-d', strtotime($request->date_to));
            $report_by = $request->report_by;

            $title = [
                'date' => 'DATE_FORMAT(`created_at`,"%Y/%m/%e")',
                'week' => 'CONCAT(WEEKOFYEAR(`created_at`))',
                // 'week' => 'CONCAT(WEEKOFYEAR(`created_at`), "/", MO÷NTH(`created_at`))',
                // 'week' => 'STR_TO_DATE(CONCAT(YEAR(`created_at`)," ", WEEKOFYEAR(`created_at`), " ", DAYNAME(`created_at`)), "%X %V %W")',
                // 'week' => 'DATE_FORMAT(DATE_ADD(`created_at`, INTERVAL 1 WEEK),"%Y/%m/%e")',
                'month' => 'MONTHNAME(`created_at`)',
            ];
            // dd($date);
            $CaseTimeLog = CaseTimeLog::selectRaw('
                ROUND(AVG((`check_out`-`check_in`)/60)) AS average_minuts,'
            .$title[$report_by] .' AS title'   
            )
            ->where('case_id', $case_id)->where('check_out','!=','')
            ->whereNotNull('check_out')

            ->whereDate('created_at', '>=', $date_from)
            ->whereDate('created_at', '<=', $date_to)
            ->groupBy('title')
            ->get();
            // $avgMins = round($CaseTimeLog/60);
            return successJsonResponse_h('',$CaseTimeLog);

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
    
    public function reportByDay(ReportByDayRequest $request, $case_id){
        try{

            $date = date('Y-m-d', strtotime($request->date));

            $CaseTimeLog = CaseTimeLog::select(
                DB::raw('ROUND(AVG((`check_out`-`check_in`)/60)) AS average_minuts'),
                'case_time_logs.id',   
                'case_time_logs.case_id',   
                'case_time_logs.tray_no',   
                'case_time_logs.day',
                DB::raw("from_unixtime(`check_in`, '%d-%m-%Y %H:%i:%s') as check_in"),
                DB::raw("from_unixtime(`check_out`, '%d-%m-%Y %H:%i:%s') as check_out"),
                'case_time_logs.created_at'
            )
            ->where('case_id', $case_id)
            ->where('check_out','!=','')
            ->whereNotNull('check_out')

            ->whereDate('created_at', $date)
            ->groupBy('created_at')
            ->get();
            // $avgMins = round($CaseTimeLog/60);
            return successJsonResponse_h('',$CaseTimeLog);

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
