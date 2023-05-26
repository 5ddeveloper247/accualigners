<?php

namespace App\Http\Controllers\Web\Admin\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Clinic\ClinicEditRequest;
use App\Http\Requests\Web\Admin\Clinic\ClinicStoreRequest;
use App\Http\Requests\Web\Admin\Clinic\ClinicUpdateRequest;
use App\Http\Requests\Web\Admin\ClinicDoctor\ClinicDoctorEditRequest;
use App\Http\Requests\Web\Admin\ClinicDoctor\ClinicDoctorStoreRequest;
use App\Http\Requests\Web\Admin\ClinicDoctor\ClinicDoctorUpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Clinic;
use App\Models\ClinicDoctor;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;

class ClinicController extends Controller
{

    public function index_old(Request $request)
    {
        try{

             $clinics = Clinic::with('address')->select('*');
         if($request->has('filter') && !empty($request->filter)){
                 $filter = $request->filter;
                 $clinics = $clinics->where(function ($query) use($filter){
                    $query->where('name', 'like', "%".$filter."%")
                        ->orWhere('id', $filter);
                });
            }

            $clinics = $clinics->paginate(15);

            return view('originator.container.clinic.clinic-view', compact('clinics'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    //new index
    public function index(Request $request)
    {
        try{

            $clinics = Clinic::with(['address','clinicDoctors'])->orderByDesc('updated_at')->select('*');
            // dd($clinics->get()[0]->doctors[0]->pivot);
            $countries = Country::orderBy('name')->get();
            $doctors = User::where('user_type', 'doctor')->get();
            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $clinics = $clinics->where(function ($query) use($filter){
                    $query->where('name', 'like', "%".$filter."%")
                        ->orWhere('id', $filter);
                });
            }

            $clinics = $clinics->paginate(15);
            $i=0;
            // foreach($clinics as $rec){
            //  $docId[$i] =  ClinicDoctor::select('doctor_id')->where('clinic_id',$rec->id)->get();
            //  if(count($docId[$i])!=0){
            //     $clinics[$i]['associated_doctor'] = User::select('name')->where('id',$docId[$i][0]['doctor_id'])->first();
            //  }
            //  $i++;
            // }
            return view('originator.container.clinic.clinic-view-new', compact('clinics','countries','doctors'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function create()
    {
        try{
            $data['countries'] = Country::orderBy('name')->get();
            $data['states'] = [];
            $data['cities'] = [];
            return view('originator.container.clinic.clinic-form',$data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
        //new create
    public function new_create()
    {
        // try{
        //     $data['countries'] = Country::orderBy('name')->get();
        //     $data['doctors'] = User::where('user_type', 'doctor')->get();
        //     // $data['states'] = [];
        //     // $data['cities'] = [];
        //     return response()->json($data);
        // }catch(Exception $e){
        //     return redirect()->back()->withErrors($e->getMessage());
        // }
    }

    public function store(ClinicStoreRequest $request)
    {
        try{
            $inputs = $request->except('_method', '_token');
            $inputs['created_by'] = auth()->user()->id;
            dd($request->all());
            $address = Address::firstOrCreate(
                ['value' => $inputs['address']],
                $inputs
            );
            $inputs['address_id'] = $address->id;
            Clinic::create($inputs);
            return redirect()->back()->with(['successMessage' => 'Clinic created successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
        //new adding clinic
    public function new_store(ClinicStoreRequest $request)
     {
        try{
                $inputs = $request->except('_method', '_token');
                $inputs['created_by'] = auth()->user()->id;
                $address = Address::firstOrCreate(
                    ['value' => $inputs['address']],
                    $inputs
                );
                $inputs['address_id'] = $address->id;
                if($id = Clinic::create($inputs)->id){
                    $arrRes['done'] = true;
                    $arrRes['msg'] = 'Clinic added successfully';
                    $request['id'] = $id;
                    return response()->json($arrRes);
                }else{
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Error in adding clinic';
                    return response()->json($arrRes);
                }

        }catch(Exception $e){
            $arrRes['done'] = false;
            $arrRes['msg'] = 'SomeThing went wrong while adding clinic'.$e;
            return response()->json($arrRes);
        }
    }


    public function show($id)
    {

    }

    public function edit(ClinicEditRequest $request, $id)
    {
        try{
            $clinic = Clinic::with('address')->find($id);
            // dd($clinic);
            $data['edit_values'] = $clinic;
            $data['countries'] = Country::orderBy('name')->get();
            if(isset($clinic->address)){
                $data['states'] = State::where('country_id', $clinic->address->country_id)->get();
                $data['cities'] = City::where('state_id', $clinic->address->state_id)->get();
            }
            else{
                $data['states'] = [];
                $data['cities'] = [];
            }
            // dd($data);
            return view('originator.container.clinic.clinic-form', $data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
        //new edit
    public static function new_edit($id)
    {
        try{
            $clinic = Clinic::with('address')->find($id);
            $data['edit_values'] = $clinic;
            $data['countries'] = Country::orderBy('name')->get();
            if(isset($clinic->address)){
                $data['states'] = State::where('country_id', $clinic->address->country_id)->get();
                $data['cities'] = City::where('state_id', $clinic->address->state_id)->get();
            }
            else{
                $data['states'] = [];
                $data['cities'] = [];
            }
            return response()->json($data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function update(ClinicUpdateRequest $request, $id)
    {
        try{
            $inputs = $request->except('_method', '_token');
            $clinic = Clinic::findOrFail($id);

            $inputs['created_by'] = auth()->user()->id;
            $address = Address::firstOrCreate(
                ['value' => $inputs['address']],
                $inputs
            );
            $inputs['address_id'] = $address->id;
            $clinic->update($inputs);
            return redirect()->back()->with(['successMessage' => 'Clinic updated successfully']);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
        //new update
    public function update_new(ClinicUpdateRequest $request)
    {
        $id = $request['ElementId'];
        try{
            $inputs = $request->except('_method', '_token');
            $clinic = Clinic::findOrFail($id);

            $inputs['created_by'] = auth()->user()->id;
            $address = Address::updateOrCreate(
                ['value' => $inputs['address']],
                $inputs
            );
            $inputs['address_id'] = $address->id;
            if($clinic->update($inputs))
            {
                $arrRes['msg']  = "Data updated successfully";
                $arrRes['done'] = true;
            }else{
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Error in updating Data';
            }
        return response()->json($arrRes);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy(ClinicEditRequest $request,$id)
    {
        $recordIds = explode(",",$id);
        try{
            foreach($recordIds as $id)
            {
            $clinic = Clinic::find($id);
            if($clinic->forceDelete())
            {
                $arrRes['msg']  = "Data Deleted successfully";
                $arrRes['done'] = true;
            }else{
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Error in Deleting Data';
            }
            }
            return response()->json($arrRes);
        }catch(Exception $e){
            $arrRes['done'] = false;
            $arrRes['msg'] = 'some error';
            return response()->json($arrRes);
        }
    }
    //prev destroy
    // public function destroy(ClinicEditRequest $request,$id)
    // {
    //     try{
    //         $clinic = Clinic::find($id);
    //         $clinic->forceDelete();

    //         return successJsonResponse_h('Clinic deleted successfully');
    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }
}
