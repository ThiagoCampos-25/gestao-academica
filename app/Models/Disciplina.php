<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nome_disciplina',
        'carga_horaria',
    ];
}
