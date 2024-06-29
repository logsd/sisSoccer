<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaguePhase extends Model
{
    use HasFactory;

    public function leagueGroups(){
        return $this->hasMany(LeagueGroups::class);
    }

    public function leagueDates(){
        return $this->hasMany(LeagueDates::class);
    }

    public function championship(){
        return $this->belongsTo(Championship::class);
    }
}
