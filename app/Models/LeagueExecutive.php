<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueExecutive extends Model
{
    use HasFactory;

    public function genTelephone(){
        return $this->hasMany(GenTelephone::class);
    }
    public function genState(){
        return $this->hasMany(GenState::class);
    }
}
