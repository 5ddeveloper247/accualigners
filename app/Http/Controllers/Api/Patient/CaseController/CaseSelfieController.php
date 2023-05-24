<?php

namespace App\Http\Controllers\Api\Patient\CaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\CaseRequest\CaseSelfieIndexRequest;
use App\Http\Requests\Api\Patient\CaseRequest\CaseSelfieStoreRequest;
use App\Http\Resources\Api\Patient\CaseResource\CaseSelfieResource;
use App\Models\CaseSelfie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseSelfieController extends Controller
{

    public function index(CaseSelfieIndexRequest $request, $id){
        try{
            $CaseTimeLog = CaseSelfie::where('case_id', $id)->get();
            
            return successJsonResponse_h('', CaseSelfieResource::collection($CaseTimeLog));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function store(CaseSelfieStoreRequest $request, $id){
        try{
            $inputs = $request->only('tray_no', 'day');
            $inputs['case_id'] = $id;
            
            $path = 'cases/selfie/';
            
            $file = $request->file('image');
            $name = 'case-'.$id.'-'.time().'.'.$file->extension();
            Storage::disk(env('FILE_SYSTEM'))->putFileAs($path, $file, $name);
            $inputs['name'] = $name;
            $inputs['path'] = $path;
            $inputs['created_by'] = $request->user()->id;

            $CaseTimeLog = CaseSelfie::create($inputs);
            
            return successJsonResponse_h('Created successfully', new CaseSelfieResource($CaseTimeLog));

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }

    public function destroy(CaseSelfieIndexRequest $request,$case_id, $id)
    {
        try{
            CaseSelfie::where('id', $id)->delete();
            return successJsonResponse_h('Deleted successfully');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
