<?php

use App\Http\Controllers\CursosController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCursosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('pdfDiploma', [PdfController::class, 'pdfDiploma']);

Route::middleware(['auth:sanctum', 'role:administrador'])->group(function () {
    Orion::resource('user', UserController::class)->only('index', 'show', 'search', 'store', 'update', 'restore')->withSoftDeletes();
    Route::post('asignarrol',[UserController::class,'asignarRol']);
});

Route::middleware(['auth:sanctum', 'role:profesor'])->group(function () {
    Route::get("usuariosinscritos",[CursosController::class,"userCourses"]);
});

Route::middleware(['auth:sanctum','role:usuario'])->group(function () {
    Orion::resource('cursos', CursosController::class)->only('index', 'show', 'search')->withSoftDeletes();
    Orion::resource('usercursos',UserCursosController::class)->only('index','show','search','store','destroy')->withSoftDeletes();
});

Route::middleware(['auth:sanctum', 'role:profesor|administrador'])->group(function () {
    Orion::resource('cursos', CursosController::class)->only('index', 'show', 'search', 'store', 'update', 'destroy', 'restore')->withSoftDeletes();
});

Route::middleware(['auth:sanctum', 'role:profesor|usuario'])->group(function () {
    Route::get('miscursos',[UserController::class,'miscursos']);
});

