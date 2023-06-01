<?php

namespace App\Http\Controllers\Web\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Slider\SliderEditRequest;
use App\Http\Requests\Web\Admin\Slider\SliderStoreRequest;
use App\Http\Requests\Web\Admin\Slider\SliderUpdateRequest;
use App\Models\Slider;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    //new index
    public function index(Request $request)
    {
        try{
            $sliders = Slider::query();
            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $sliders = $sliders->where(function ($query) use($filter){
                    $query->where('sort_order', 'like', "%".$filter."%")
                        ->orWhere('id', $filter);
                });
            }
            $sliders = $sliders->paginate(15);
            return view('originator.container.slider.slider-view-new', compact('sliders'));

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    //prev index
    // public function index()
    // {
    //     try{

    //         $sliders = Slider::paginate(15);

    //         return view('originator.container.slider.slider-view', compact('sliders'));

    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }

    public function create()
    {
        try{
            return view('originator.container.slider.slider-form');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store(SliderStoreRequest $request)
    {
        try{
            $inputs = $request->only(['sort_order']);
            if ($request->hasFile('slider_image')) {
                $media = $request->file('slider_image');
                $ImageName = 'slider-' . Carbon::now()->timestamp . '.' . $media->extension();
                Storage::Disk(env('FILE_SYSTEM'))->putFileAs('sliders', $media, $ImageName);
                $inputs['slider_image'] = 'sliders/'.$ImageName;
            }

            if(Slider::create($inputs))
                {
                    $arrRes['msg']  = "Data saved successfully";
                    $arrRes['done'] = true;
                }else{
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Error in saving Data';
                }
            return response()->json($arrRes);

        }catch(Exception $e){
            $arrRes['done'] = false;
            $arrRes['msg'] = 'SomeThing went wrong';
            return response()->json($arrRes);
        }
    }

    //previous function
    // public function store(SliderStoreRequest $request)
    // {
    //     try{
    //         $inputs = $request->only(['sort_order']);
    //         if ($request->hasFile('slider_image')) {
    //             $media = $request->file('slider_image');
    //             $ImageName = 'slider-' . Carbon::now()->timestamp . '.' . $media->extension();
    //             Storage::Disk(env('FILE_SYSTEM'))->putFileAs('sliders', $media, $ImageName);
    //             $inputs['slider_image'] = 'sliders/'.$ImageName;
    //         }

    //         Slider::create($inputs);
    //         return redirect()->back()->with(['successMessage' => 'Slider created successfully']);

    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }

    public function show($id)
    {

    }

    //new edit
    public function edit(SliderEditRequest $request, $id)
    {
        try{
            $edit_values = Slider::find($id);
            $data['edit_values'] = $edit_values;
            return response()->json($data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    // public function edit(SliderEditRequest $request, $id)
    // {
    //     try{
    //         $edit_values = Slider::find($id);
    //         return view('originator.container.slider.slider-form', compact('edit_values'));
    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }

    public function update_new(Request $request)
    {
        $id = $request['ElementId'];
        try{
            $inputs = $request->only(['sort_order']);
            if ($request->hasFile('slider_image')) {
                $media = $request->file('slider_image');
                $ImageName = 'slider-' . Carbon::now()->timestamp . '.' . $media->extension();
                Storage::Disk(env('FILE_SYSTEM'))->putFileAs('sliders', $media, $ImageName);
                $inputs['slider_image'] = 'sliders/'.$ImageName;
            }

            $Slider = Slider::find($id);
            if($Slider->update($inputs))
                {
                    $arrRes['msg']  = "Data updated successfully";
                    $arrRes['done'] = true;
                }else{
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Error in updating Data';
                }
            return response()->json($arrRes);

        }catch(Exception $e){
            $arrRes['error'] = 'something wrong';
            return response()->json($arrRes);
        }
    }

    //prev update
    // public function update(SliderUpdateRequest $request, $id)
    // {
    //     try{
    //         $inputs = $request->only(['sort_order']);
    //         if ($request->hasFile('slider_image')) {
    //             $media = $request->file('slider_image');
    //             $ImageName = 'slider-' . Carbon::now()->timestamp . '.' . $media->extension();
    //             Storage::Disk(env('FILE_SYSTEM'))->putFileAs('sliders', $media, $ImageName);
    //             $inputs['slider_image'] = 'sliders/'.$ImageName;
    //         }

    //         $Slider = Slider::find($id);
    //         $Slider->update($inputs);

    //         return redirect()->back()->with(['successMessage' => 'Slider updated successfully']);

    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }

    public function destroy(SliderEditRequest $request,$id)
    {
        $recordIds = explode(",",$id);
        try{
            foreach($recordIds as $id)
            {
                $slider = Slider::find($id);
                if($slider->forceDelete())
                {
                    $arrRes['msg']  = "Slider Deleted successfully";
                    $arrRes['done'] = true;
                }else{
                        $arrRes['done'] = false;
                        $arrRes['msg'] = 'Error in Deleting Slider';
                }
            }
            return response()->json($arrRes);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

                    //prev destroy
    // public function destroy(SliderEditRequest $request,$id)
    // {
    //     try{
    //         $slider = Slider::find($id);
    //         $slider->forceDelete();

    //         return successJsonResponse_h('Slider deleted successfully');
    //     }catch(Exception $e){
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }
    // }
}
