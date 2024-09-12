<?php

namespace App\Http\Controllers;

use App\Models\courses;
use App\Http\Requests\StorecoursesRequest;
use App\Http\Requests\UpdatecoursesRequest;
use App\Http\Resources\CoursesCollection;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return new CoursesCollection(courses::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function actualizar(UpdatecoursesRequest $request){
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecoursesRequest $request)
    {
        //
        try{
            $validateData = Validator($request->all(),[
                'title' => 'required',
                'description' => 'required',
                'duration'=>'required|numeric',
                'price' => 'required|numeric',
                'user_id'=>'required|numeric'
            ]);
            if($validateData->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validateData->errors()
                ],401);
            }
            $course = courses::create([
                'title' => $request->title,
                'description' => $request->description,
                'duration'=>$request->duration,
                'price' =>$request->price,
                'user_id'=>$request->user_id
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Course created successfully',
                'data'=>$course
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
        // courses::create($validateData);
    }

    /**
     * Display the specified resource.
     */
    public function show(courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(courses $courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecoursesRequest $request, courses $courses)
    {
        //
        try{
            $validateData = Validator($request->all(),[
                'title' => 'required',
                'description' => 'required',
                'duration'=>'required|numeric',
                'price' => 'required|numeric',
            ]);
            if($validateData->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validateData->errors()
                ],401);
            }
            $courses->update([
                'title' => $request->title,
                'description' => $request->description,
                'duration'=>$request->duration,
                'price' =>$request->price,
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Course updated successfully',
                'data'=>$courses
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(courses $courses)
    {
        try {
            $courses->delete();

            return response()->json([
                'status' => true,
                'message' => 'Course deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
