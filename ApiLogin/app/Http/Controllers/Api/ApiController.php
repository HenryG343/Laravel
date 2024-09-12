<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //
    public function register(Request $request){
        try{
            $validationUser = Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
                'type'=>'required|in:1,2,3',
                'birthdate'=>'required'
            ]);
            if($validationUser->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validationUser->errors()
                ],401);
            }
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'type'=>$request->type,
                'birthdate'=>$request->birthdate
            ]);
            if($request->type==1){
                return response()->json([
                    'status'=>true,
                    'message'=>'User created successfully',
                    'admin_token'=>$user->createToken("admin-token",['create','update','delete'])->plainTextToken
                ],200);
            }else if($request->type==2){
                return response()->json([
                    'status'=>true,
                    'message'=>'User created successfully',
                    'teacher_token'=>$user->createToken("teacher-token",['create','update','delete'])->plainTextToken
                ],200);
            }else if($request->type==3){
                return response()->json([
                    'status'=>true,
                    'message'=>'User created successfully',
                    'user_token'=>$user->createToken("user-token",['create','update','delete'])->plainTextToken
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }
    public function login(Request $request){
        try{
            $validationUser = Validator::make($request->all(),[
                'email'=>'required|email',
                'password'=>'required'
            ]);
            if($validationUser->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validationUser->errors()
                ],401);
            }
            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status'=>false,
                    'message'=>'Correo y contraseña no coinciden',
                ],401);
            }
            $user=User::where('email',$request->email)->first();
            if($user->type==1){
                return response()->json([
                    'status'=>true,
                    'message'=>'Inicio de sesión exitoso',
                    'admin_token'=>$user->createToken("admin-token",['create','update','delete'])->plainTextToken
                ],200);
            }else if($user->type==2){
                return response()->json([
                    'status'=>true,
                    'message'=>'Inicio de sesión exitoso',
                    'teacher_token'=>$user->createToken("teacher-token",['create','update','delete'])->plainTextToken
                ],200);
            }else if($user->type==3){
                return response()->json([
                    'status'=>true,
                    'message'=>'Inicio de sesión exitoso',
                    'user_token'=>$user->createToken("user-token",['create','update','delete'])->plainTextToken
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }
    public function profile(){
        $userData = auth()->user();
        return response()->json([
            'status'=>true,
            'message'=>'Info',
            'data'=>$userData,
            'id'=>auth()->user()->id
        ],200);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Sesion cerrada',
            'data'=>[]
        ]);
    }
}
