<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request){
        $request->validated();

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return $this->error('','Invalid email or password',401);
        }

        $user = User::where('email',$request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api token of '.$user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request){
        $request->validated();
        $user = User::create([
            'fname' =>$request->fname, 
            'lname' => $request->lname,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);
        event(new Registered($user));
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api token of '.$user->name)->plainTextToken
        ]);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'user logged out successfully'
        ]);
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        
        $this->validate($request, [
            'current' => 'required',
            'newpassword' => 'required|min:8',
        ]);
        
        if (!Hash::check($request->current, $user->password)) {
            return $this->error(null, "Current password is incorrect", 401);
        }
        
        $hashedPassword = Hash::make($request->newpassword);
        
        $user->password = $hashedPassword;
        $user->save();
        
        return response()->json(['message' => 'Password changed successfully']);
        return $this->success(null, "Password changed successfully", 200);
    }

    public function updateuser(Request $request, $id){
        $user = User::find($id);
        if($user != null){
            if(isset($request->email)){
                if($user->email != $request->email){
                    $test = User::where('email', $request->email)->first();
                    if($test == null){
                        //error
                        return $this->error(null, "This email is already in use", 409);
                    }
                }
            }
            //update 
            $user->update($request->all());
            return $this->success(new UserResource(User::find($id)), "Updated successfully", 200);
        }else{
            //error
            return $this->error(null, "User not found", 404);
        }
    }
}
