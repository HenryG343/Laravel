<?php

namespace App\Http\Controllers;

use App\Models\UserCursos;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCursosController extends Controller
{
    use DisableAuthorization;
    protected $model = UserCursos::class;

    protected function beforeSave(Request $request, $userCursos)
    {
        $userData = auth()->user()->id;
        $verificar = UserCursos::where('user_id',$userData)->where('curso_id',$request->curso_id)->first();
        if($verificar){
            abort(403, 'Ya estas inscrito a este curso.');
        }
        $userCursos->user_id = $userData;
    }
}
