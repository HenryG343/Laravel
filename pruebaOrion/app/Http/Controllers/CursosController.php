<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursosRequest;
use App\Models\Cursos;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Middleware\PermissionMiddleware;

class CursosController extends Controller
{
    use DisableAuthorization;
    protected $model = Cursos::class;
    protected $request = CursosRequest::class;

    protected function searchableBy(): array
    {
        return ['nombre','descripcion','duracion','users.name'];
    }

    public function exposedScopes(): array
    {
        return ['searchDuracion'];
    }
    
    public function limit() : int
    {
        return 5;
    }

    public function alwaysIncludes(): array
    {
        return  [
            'users'
        ];
    }

    public function sortableBy() : array
    {
         return ['created_at'];
    }

    // public function index(Request $request)
    // {
    //     $post = Cursos::with('users')->get();
    //     return response()->json($post);
    // }

    public function show(Request $request, $post)
    {
        $post = Cursos::with('users')->findOrFail($post);
        return response()->json($post);
    }

    // "search" : {
    //     "value":"38"

    // }

    
    public function userCourses(Request $request): JsonResponse{
        $userData = auth()->user();
        $cursos = Cursos::with('Users')->get();
        return response()->json($cursos);
    }
}
