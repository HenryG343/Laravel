<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCursos extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'curso_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curso()
    {
        return $this->belongsTo(Cursos::class);
    }
}
