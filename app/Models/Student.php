<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tipo',
        'cedula',
        'apellidos',
        'nombres',
        'sexo',
        'departamento',
        'a_cursar',
        'inactivo',
        'fecha_rdoc',
        'fecha_ret',
        'mensaje',
        'exonerado'
        
        
    ];

    public function departament(){
        return $this->belongsTo(Departament::class,'departamento', 'code');
    }
}

