<?php
namespace App\Http\Controllers\api;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller 
{
    public function createUser(Request $request)
    {
      try {
        $validatedUser = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required | unique:users,email',
            'password'=> 'required|min:8 |max:25',
        ]);
        if($validatedUser->fails()){
            return response()->json([
               'errors'=>$validatedUser->errors(),
               'status'=>401,
               'message'=>'validation errors' 
            ],401);   
        }
         $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
      $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
               'status'=>201,
               'message'=>'User created successfully',
               'token' => $token
        ],201);
      } catch (\Throwable $th) {
        return response()->json([
            'status'=>500,
            'message'=> $th->getMessage()
        ],500);
      }
    }
    public function loginUser(Request $request)
    {
        try {
            $validatedUser = Validator::make($request->all(), 
            [
                'email' => 'required',
                'password' => 'required'
            ]);
            if($validatedUser->fails()){
                return response()->json([
                    'status'=>401,
                    'message' => 'Validation Errors',
                    'error'=>$validatedUser->errors(),
                ],401);
            
            }
            if(!Auth::attempt($request->only('email','password'))){
                return response()->json([
                    'status'=>401,
                    'message' =>'email and password are not Valid',
                ],401);
            }
            $user = User::where('email',$request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status'=>200,
                'message' =>'success Login Successfully',
                'data'=>$user,
                'token' =>$token,
                'token_type'=>'Bearer',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>500,
                'error'=>$th.getMessage()

            ],500);
        }
       
    }
    public function logout()
    {
     Auth::user()->tokens()->delete();     
     return response()->json(['meesage'=>'anda Berhasil Logout']); 
    }
}