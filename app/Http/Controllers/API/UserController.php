<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'data' => 'Validation error.',
                'message' => $validator->errors()
            ];

            return response()->json($response, 404);
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('Token Name')->accessToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'Registration success.'
            ];

            return response()->json($response, 200);
        }
    }

    public function login(){
        dd(request());
        if(Auth::attempt(['name' => request('name'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] = $user->createToken('Token Name')->accessToken;
            $response = [
                'success' => true,
                'data' => $success
            ];

            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Login failed.'
            ];

            return response()->json($response, 401);
        }
    }
    
}
