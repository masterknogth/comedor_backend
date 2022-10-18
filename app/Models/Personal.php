<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table = 'personals';
    protected $fillable = [
        'id',
        'cedula',
        'numero',
        'apellidos',
        'nombres',
        'exonerado',
        'inactivo',
        'departamento',
        'tipo'
    ];
    public function departament(){
        return $this->belongsTo(Departament::class,'departamento', 'code');
    }
}
