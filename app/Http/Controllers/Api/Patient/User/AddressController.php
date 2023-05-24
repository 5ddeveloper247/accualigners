<?php

namespace App\Http\Controllers\Api\Patient\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\User\Address\AddAddressRequest;
use App\Http\Requests\Api\Patient\User\Address\DeleteAddressRequest;
use App\Http\Requests\Api\Patient\User\Address\UpdateAddressRequest;
use App\Http\Resources\Api\Patient\User\AddressResource;
use App\Models\PatientAddress;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            return successJsonResponse_h('', AddressResource::collection(PatientAddress::where('patient_id', $request->user()->id)->orderBy('default', 'DESC')->get()));
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddAddressRequest $request)
    {
        try{
            $patient_id = $request->user()->id;
            $request->request->add(['patient_id'=>$patient_id]);
            
            if($request->default)
                PatientAddress::where('patient_id', $patient_id)->update(['default' => 0]);
                
            $PatientAddress = PatientAddress::create($request->all());

            return successJsonResponse_h('Added successfully', new AddressResource($PatientAddress));
            
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try{
            $address = PatientAddress::where('patient_id', $request->user()->id)->where('id', $id)->first();
            return successJsonResponse_h('', new AddressResource($address));
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        try{
            if($request->default)
                PatientAddress::where('patient_id', $request->user()->id)->update(['default' => 0]);

            $PatientAddress = PatientAddress::find($id);
            $PatientAddress->fill($request->all());
            $PatientAddress->save();
            return successJsonResponse_h('Updated Successfully', new AddressResource($PatientAddress));
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAddressRequest $request, $id)
    {
        try{
            PatientAddress::where('id', $id)->delete();
            return successJsonResponse_h('Deleted successfully');
        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
