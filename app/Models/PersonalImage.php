<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalImage extends Model
{
    use HasFactory;

    public function personal(){
        return $this->belongsTo(Personal::class,'cedula', 'cedula');
    }
}
