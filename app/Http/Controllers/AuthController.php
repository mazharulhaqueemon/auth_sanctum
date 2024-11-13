<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registration(Request $request){

        // dd($request->all());

       $fields = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ]);

    // // Hash the password
    // $fields['password'] = bcrypt($fields['password']);

    // // Create the user
    $user = User::create($fields);

    // Generate token
    $token = $user->createToken($request->name)->plainTextToken;

    return response([
        'user' => $user,
        'token' => $token
    ]);
    }

    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        $user =User::where('email',$request->email)->first();
        // User is a model ,where for quary or search email is a field and request->email
        // is form forntend .

        if(!$user || !Hash::check($request->password,$user->password ))

        // ------- Hash for #### password ,check()method check the argument , $requenst->password -given password from user end or clint end
        //-------- user->password from database .if request-pa ans user=pa mathc then return user api and token .
            return [
                'message'=> 'The Provided Cridintial is incorrect'
            ];


        $token = $user->createToken($user->name)->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
            ]);
        
    }

    public function logout(Request $request){
        return 'logout';
    }


}
