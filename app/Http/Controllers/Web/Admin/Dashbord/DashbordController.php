<?php

namespace App\Http\Controllers\Web\Admin\Dashbord;

use App\Http\Controllers\Controller;
use App\Models\CaseModel;
use App\Models\Order;
use App\Models\Patient;
use App\Models\User;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index_new(){
        
        $pending_treatment_plans = CaseModel::where('video_embedded',NULL)->count();
        
        $approved_treatment_plans = CaseModel::whereNotNull('aligner_kit_order_id')->count();
        
        $aligners_production = Order::where('status','PENDING')->count();
        
        $ready_for_dispatch = Order::where('status','CONFIRMED')->count();
        
        $total_patients = Patient::count();
        $total_active_cases = CaseModel::where('status','CONFIRMED')->count();
        $total_revenue = Order::whereIn('status',['CONFIRMED', 'DISPATCHED', 'DELIVERED'])->sum('total_amount');
        $total_revenue_this_month = Order::whereMonth('created_at', date('m'))->whereIn('status',['CONFIRMED', 'DISPATCHED', 'DELIVERED'])->sum('total_amount');
        $active_cases = CaseModel::where('status','CONFIRMED')->limit(5)->orderBy('id','desc')->get();
        $sliders = Slider::orderBy('sort_order')->get();
        // dd($total_revenue_this_month);
        
        return view('originator.container.home', compact('pending_treatment_plans','approved_treatment_plans','aligners_production','ready_for_dispatch','total_patients','total_active_cases', 'total_revenue', 'total_revenue_this_month', 'active_cases', 'sliders'));
    }
    public function index(Request   $request){
        
         $pending_treatment_plans = CaseModel::where('video_embedded',NULL)->count();
          
         $approved_treatment_plans = CaseModel::whereNotNull('aligner_kit_order_id')->count();
        
         $aligners_production = Order::where('status','PENDING')->count();
        
         $ready_for_dispatch = Order::where('status','CONFIRMED')->count();
        
         $total_patients = Patient::count();

         $total_active_cases = CaseModel::where('status','CONFIRMED')->count();

         $total_revenue = Order::whereIn('status',['CONFIRMED', 'DISPATCHED', 'DELIVERED'])->sum('total_amount');

         $delivered_orders = Order::where('status',['DELIVERED'])->whereBetween('created_at', [now()->subWeek(), now()])->count();
       
         $total_revenue_this_month = Order::whereMonth('created_at', date('m'))->whereIn('status',['CONFIRMED', 'DISPATCHED', 'DELIVERED'])->sum('total_amount');
       
         $active_cases = CaseModel::where('status','CONFIRMED')->limit(5);
     if ($request->has('filter') && !empty($request->filter)) {
          $filter = $request->filter;
           $active_cases = $active_cases->where(function ($query) use ($filter) {
             $query->where('id', $filter)
                 ->orWhere('name', 'like', "%" . $filter . "%")
                 ->orWhere('phone_no', 'like', "%" . $filter . "%")
                 ->orWhere('gender', $filter)
                 ->orWhere('email', 'like', "%" . $filter . "%");
         });
     }
          $active_cases = $active_cases->orderBy('id','desc')->get();
      
          $sliders = Slider::orderBy('sort_order')->get();
      
          $order_confirmed=Order::where('status','COMPLETED')->count();

          $total_orders=Order::whereBetween('created_at', [now()->subWeek(), now()])->count();
         if($total_orders != 0)
         {
            $percentage=floor( ($delivered_orders/$total_orders)*100);
         }else{
            $percentage = 0;
         }

          $doctors=User::where('role_id','=',2)->latest()->take(4)->get();
         // dd($total_revenue_this_month);
        
         return view('originator.container.home_new', compact('pending_treatment_plans','approved_treatment_plans','aligners_production',
         'ready_for_dispatch','total_patients','total_active_cases', 'total_revenue', 'total_revenue_this_month', 'active_cases',
         'sliders','doctors','delivered_orders','percentage'));
    }
}
