<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function departament(){
        return $this->belongsTo(Departament::class,'departamento', 'code');
    }
}

