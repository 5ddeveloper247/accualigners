<?php

namespace App\Http\Controllers\Api\Doctor\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Patient\User\UpdateUserRequest;
use App\Http\Resources\Api\Patient\User\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getUser(Request $request){
        return successJsonResponse_h('', new UserResource(User::find($request->user()->id)));
    }

    public function UpdateUser(UpdateUserRequest $request){

        if ($request->hasFile('user_picture')) {
            $media = $request->file('user_picture');
            $ImageName = 'User-' . Carbon::now()->timestamp . '.' . $media->extension();
            Storage::Disk(env('FILE_SYSTEM'))->putFileAs('users', $media, $ImageName);
            $request->request->add(['picture' => 'users/'.$ImageName]);
        }
        $fillables = $request->only(['name', 'email', 'password', 'password_confirmation', 'picture']);

        $user = User::find($request->user()->id);
        $user->update($fillables);
        return successJsonResponse_h('Updated successfully', new UserResource(User::find($request->user()->id)));
    }
}
