<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'password' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }//
            
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'last_workout_check' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
            

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete_account($userId){
        $user = new User();
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        else{
            $user->delete();
            return response()->json(['user' => 'User deleted succesfully'], 200);
        }
        
    }

    public function authorize(Request $request)
    {   
        
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['name', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Name & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('name', $request->name)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
       
    }
    
