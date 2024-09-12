<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    use DisableAuthorization;
    protected $model = User::class;

    public function login(Request $request): JsonResponse{
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
            return response()->json([
                'status'=>true,
                'message'=>'Inicio de sesión exitoso',
                'token'=>$user->createToken("token",['create','update','delete'])->plainTextToken
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }

    public function register(Request $request): JsonResponse{
        try{
            $validationUser = Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
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
            ]);
            $user->assignRole('usuario');
            return response()->json([
                'status'=>true,
                'message'=>'User created successfully',
                'token'=>$user->createToken("token")->plainTextToken
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }

    public function miscursos(Request $request): JsonResponse{
        $userData = auth()->user();
        $cursos = User::with('Cursos')->where('id',$userData->id)->get();
        return response()->json($cursos);
    }

    public function asignarRol(Request $request): JsonResponse{
        $user = User::find($request->id_usuario);
        $user->roles()->sync($request->id_rol);
        return response()->json($user);
    }

}
