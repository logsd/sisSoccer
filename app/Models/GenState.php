<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenState extends Model
{
    use HasFactory;

    public function leagueExecutive(){
        return $this->belongsTo(LeagueExecutive::class);
    }

    protected $fillable = [
        'name',
        'description',
        'validity',
        'league_executive_id'

    ];
}
