<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueGroups extends Model
{
    use HasFactory;

    public function leaguePhases(){
        return $this->belongsTo(LeaguePhase::class);
    }
    public function championships(){
        return $this->belongsTo(Championship::class);
    }
}
