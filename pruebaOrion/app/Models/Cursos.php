<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion',
        'user_id'
    ];
    public function scopeSearchDuracion($query, $minimo, $maximo){
        return $query->whereBetween('duracion', [$minimo, $maximo]);

    }
    public function userscursos()
    {
        return $this->belongsToMany(User::class, 'user_cursos', 'curso_id', 'user_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
