<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class CursosRequest extends Request
{
    public function commonRules(): array
    {
        return [
            "nombre" => "string",
            "descripcion"=>"string",
            "duracion"=>"numeric"
        ];
    }
}
