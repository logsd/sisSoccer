<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueGroups extends Model
{
    use HasFactory;

    public function leaguePhase(){
        return $this->belongsTo(LeaguePhase::class);
    }
    public function championship(){
        return $this->belongsTo(Championship::class);
    }
}
