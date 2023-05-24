<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\User\UserEditRequest;
use App\Http\Requests\Web\Admin\User\UserStoreRequest;
use App\Http\Requests\Web\Admin\User\UserUpdateRequest;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index(Request $request){
        try{
            $users = User::where('id','!=' , auth()->user()->id)->with(['role'])
                ->whereHas('role', function($q) {
                  $q->where('type', 'employee');
            });
            if($request->has('filter') && !empty($request->filter)){
                $filter = $request->filter;
                $users = $users->where(function ($query) use($filter){
                    $query->where('name', 'like', "%".$filter."%")
                        ->orWhere('id', $filter)
                        ->orWhere('email','like','%'.$filter.'%');
                });
            }
            // getting roles
            $roles = Role::where('type' , 'employee')->where('slug' , '!=', 'admin')->get(); 

            $users = $users->paginate(15);
        return view('originator.container.user.user-view-new', compact('users','roles'));
         }
    catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function create()
    {
        try{
        $data['roles'] = Role::where('type' , 'employee')->where('slug' , '!=', 'admin')->get();    
        return view('originator.container.user.user-form', $data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store(UserStoreRequest $request)
    {

        try{
            $inputs = $request->only(['name', 'email', 'password', 'role_id']);
            if ($request->hasFile('picture')) {
                $media = $request->file('picture');
                $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
                Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
                $inputs['picture'] = 'users/'.$ImageName;
            }
            $inputs['user_type'] = 'admin';         
            if(User::create($inputs))         
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

    public function show($id)
    {
        
    }

    public function edit(UserEditRequest $request,$id)
    {
        
        try{
            $user = User::find($id);
            $data['edit_values'] = $user;
            $data['roles'] = Role::where('type' , 'employee')->where('slug' , '!=', 'admin')->get(); 
            return response()->json($data);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update_new(Request $request)
    {
        $id = $request['ElementId'];
        try{
            $inputs = $request->only(['name', 'email', 'password', 'role_id']);
            if ($request->hasFile('picture')) {
                $media = $request->file('picture');
                $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
                Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
                $inputs['picture'] = 'users/'.$ImageName;
            }

            if(empty($inputs['password']))
                unset($inputs['password']);

            $user = User::find($id);
            
            if($user->update($inputs))         
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

    public function destroy(UserEditRequest $request,$id)
    {
        $recordIds = explode(",",$id);
        try{
            foreach($recordIds as $id)
            {
                    if($id == 57)
                {
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'This user cannot be deleted';
                    return response()->json($arrRes);
                }else{
                    $user = User::find($id);
                    if($user->forceDelete())         
                    {
                        $arrRes['msg']  = "Data Deleted successfully";
                        $arrRes['done'] = true;
                    }else{
                            $arrRes['done'] = false;
                            $arrRes['msg'] = 'Error in Deleting Data';
                    }
                }
            }
            return response()->json($arrRes);
        }catch(Exception $e){
            $arrRes['done'] = false;
            $arrRes['msg'] = 'some error';
            return response()->json($arrRes);
        }
    }

/*___________________previous  functions_____________________*/

                            /*index*/
        // public function index(Request $request)
        // {
        //     try{
        //         $users = User::where('id','!=' , auth()->user()->id)->with(['role'])
        //             ->whereHas('role', function($q) {
        //             $q->where('type', 'employee');
        //         });
        //         if($request->has('filter') && !empty($request->filter)){
        //             $filter = $request->filter;
        //             $users = $users->where(function ($query) use($filter){
        //                 $query->where('name', 'like', "%".$filter."%")
        //                     ->orWhere('id', $filter)
        //                     ->orWhere('email','like','%'.$filter.'%');
        //             });
        //         }
        //         $users = $users->paginate(15);
        //         return view('originator.container.user.user-view', compact('users'));
        //     }catch(Exception $e){
        //         return redirect()->back()->withErrors($e->getMessage());
        //     }
        // }
        
                            /*destroy*/
        // public function destroy(UserEditRequest $request,$id)
        // {   
        //     try{
        //         if($id == 57)
        //             return errorJsonResponse_h('This user can not be delete');
        //         $user = User::find($id);
        //         $user->forceDelete();
        //         return successJsonResponse_h('User deleted successfully');
        //     }catch(Exception $e){
        //         return errorJsonResponse_h($e->getMessage());
        //     }
        // }

                                /*update*/
        // public function update(UserUpdateRequest $request, $id)
        // {
        //     try{
        //         $inputs = $request->only(['name', 'email', 'password', 'role_id']);
        //         if ($request->hasFile('picture')) {
        //             $media = $request->file('picture');
        //             $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
        //             Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
        //             $inputs['picture'] = 'users/'.$ImageName;
        //         }
        //         if(empty($inputs['password']))
        //             unset($inputs['password']);
        //         $user = User::find($id);
        //         $user->update($inputs);
        //         return redirect()->back()->with(['successMessage' => 'User updated successfully']);
        //     }catch(Exception $e){
        //         return redirect()->back()->withErrors($e->getMessage());
        //     }
        // }

                            /*edit*/
        // public function edit(UserEditRequest $request, $id)
        // {
        //     try{
        //         $user = User::find($id);
        //         $data['edit_values'] = $user;
        //         $data['roles'] = Role::where('type' , 'employee')->where('slug' , '!=', 'admin')->get(); 
        //         return view('originator.container.user.user-form', $data);
        //     }catch(Exception $e){
        //         return redirect()->back()->withErrors($e->getMessage());
        //     }
        // }

                            /*store*/
        // public function store(UserStoreRequest $request)
        // {
        //     try{
        //         $inputs = $request->only(['name', 'email', 'password', 'role_id']);
        //         if ($request->hasFile('picture')) {
        //             $media = $request->file('picture');
        //             $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
        //             Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
        //             $inputs['picture'] = 'users/'.$ImageName;
        //         }
        //         $inputs['user_type'] = 'admin';         
        //         User::create($inputs);    
        //         return redirect()->back()->with(['successMessage' => 'User created successfully']);

        //     }catch(Exception $e){
        //      return redirect()->back()->withErrors($e->getMessage());
        //     }
        // }
}
