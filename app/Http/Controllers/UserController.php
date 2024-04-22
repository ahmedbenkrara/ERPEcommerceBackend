<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Traits\HttpResponses;

class UserController extends Controller
{
    use HttpResponses;

    public function index(){
        return UserResource::collection(User::all());
    }

    public function show($id){
        $user = User::find($id);
        if($user){
            return $this->success(new UserResource($user));
        }else{
            return $this->error(null, 'User Not Found', 404);
        }
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if($user){
            $user->update($request->all());
            return $this->success(new UserResource($user), "Updated successfully", 200);
        }else{
            return $this->error(null, 'User Not Found', 404);
        }
    }

    public function userCount(){
        $count = User::count();
        return $this->success($count, '', 200);
    }
}
