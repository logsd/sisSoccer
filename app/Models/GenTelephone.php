<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenTelephone extends Model
{
    use HasFactory;

    public function leagueExecutive(){
        return $this->belongsTo(LeagueExecutive::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    protected $guarded = ['id'];
}
