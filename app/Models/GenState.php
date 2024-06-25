<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenState extends Model
{
    use HasFactory;

    public function leagueExecutives(){
        return $this->belongsTo(LeagueExecutive::class);
    }
}
