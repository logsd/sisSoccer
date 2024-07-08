<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    public function teamHome()
    {
        return $this->belongsTo(Team::class,'team_home_id');
    }

    public function teamAway()
    {
        return $this->belongsTo(Team::class,'team_away_id');
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

    public function leaguePhase()
    {
        return $this->belongsTo(LeaguePhase::class);
    }

    protected $guarded = ['id'];
}
