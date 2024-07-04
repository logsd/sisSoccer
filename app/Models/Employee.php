<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function civilStatus(){
        return $this->belongsTo(CivilStatus::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function genTelephones(){
        return $this->hasMany(GenTelephone::class);
    }

    protected $guarded = ['id'];

}
