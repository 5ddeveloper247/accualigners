<?php

namespace App\Http\Controllers\Api\Patient\CaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\CaseRequest\CaseAttachmentStoreRequest;
use App\Http\Resources\Api\Patient\CaseRes\CaseAttachmentResource;
use App\Models\CaseAttachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CaseAttachmentController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = config('custom.attachment_path.case');
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CaseAttachmentStoreRequest $request)
    {
        try{

            // dd($this->path,$request->all());
            $user_id = $request->user()->id;
            $file = $request->file('attachment');
            $name = 'case-'.$user_id.'-'.time().'.'.$file->extension();
            Storage::disk(env('FILE_SYSTEM'))->putFileAs($this->path, $file, $name);
            $CaseAttachment = CaseAttachment::create([
                'attachment_type' => $request->attachment_type,
                'name' => $name,
                'sort_order' => $request->sort_order,
                'path' => $this->path,
                'created_by' => $user_id
            ]);
            
            return successJsonResponse_h('Added successfully', new CaseAttachmentResource($CaseAttachment));

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
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $CaseAttachment = CaseAttachment::find($id);
            if($CaseAttachment && isset($CaseAttachment->path)){
                
                $image = $CaseAttachment->path.$CaseAttachment->name;
                
                if($CaseAttachment->delete()){
                    Storage::disk(env('FILE_SYSTEM'))->delete($image);
                    return successJsonResponse_h('Deleted successfully');
                }
                return errorJsonResponse_h('Something went wrong');
            }
            return errorJsonResponse_h('Attachment not found');

        }catch(Exception $e){
            return errorJsonResponse_h($e->getMessage());
        }
    }
}
