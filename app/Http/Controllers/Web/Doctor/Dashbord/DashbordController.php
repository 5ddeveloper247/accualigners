<?php

namespace App\Http\Controllers\Web\Doctor\Dashbord;

use App\Http\Controllers\Controller;
use App\Models\CaseModel;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index_new(Request $request){
        $doctor_id = $request->user()->id;
        $total_patients = Patient::whereRelation('clinic_doctor', 'doctor_id', $doctor_id)->count();
        $total_active_cases = CaseModel::where('doctor_id', $doctor_id)->count();
        
        $processing_fee_paid = CaseModel::where('processing_fee_paid','1')->where('doctor_id', $doctor_id)->count();
        $active_cases = CaseModel::where('doctor_id', $doctor_id)->limit(4)->orderBy('id','desc')->get();
        $sliders = Slider::orderBy('sort_order')->get();
        return view('doctor.container.home', compact('total_patients','total_active_cases', 'active_cases','processing_fee_paid','sliders'));

    }
    public function index(Request $request){
      
         $doctor_id = $request->user()->id;

         $total_patients = Patient::whereRelation('clinic_doctor', 'doctor_id', $doctor_id)->count();

         //  $patient_id = CaseModel::where('doctor_id',$doctor_id)->pluck('patient_id')->toArray();
         //  dd($patient_id);
         $total_active_cases = CaseModel::where('doctor_id', $doctor_id)->count();   

         $total_patients= $total_active_cases;
         $processing_fee_paid = CaseModel::where('processing_fee_paid','1')->where('doctor_id', $doctor_id)->count();
         
         $active_cases = CaseModel::where('doctor_id', $doctor_id)->limit(4);
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
         return view('doctor.container.home_new', compact('total_patients','total_active_cases', 'active_cases','processing_fee_paid','sliders'));
    }
    public function agreement($id){
        $agreement_status = User::where('id',$id)->first();
        return view('doctor.container.agreement',compact('agreement_status'));
      }

    //save agreement
    public function save_agreement(Request $request){
        
        $set_val = ['agreement_status' => 1];
        if(User::where('id',$request->id)->update($set_val))
        {
            $data['done'] = true;
        }else{
            $data['done'] = false;
        }
        return response()->json($data);
      }
    }
