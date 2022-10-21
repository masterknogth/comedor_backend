<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public function departament(){
        return $this->belongsTo(Departament::class,'departamento', 'code');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
