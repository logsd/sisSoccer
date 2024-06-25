<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenTelephone extends Model
{
    use HasFactory;

    public function leagueExecutives(){
        return $this->belongsTo(LeagueExecutive::class);
    }

    public function employees(){
        return $this->belongsTo(Employee::class);
    }
}
