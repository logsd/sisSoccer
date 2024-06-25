<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    use HasFactory;

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function generalParameters(){
        return $this->hasMany(GeneralParameter::class);
    }

    
}
