<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueDates extends Model
{
    use HasFactory;

    public function leaguePhase(){
        return $this->belongsTo(LeaguePhase::class);
    }
}
