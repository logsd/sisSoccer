<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function players(){
        return $this->hasMany(Player::class);
    }

    public function calendars(){
        return $this->hasMany(Calendar::class);
    }

    public function periods(){
        return $this->hasMany(Period::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function championship(){
        return $this->belongsTo(Championship::class);
    }

    public function club(){
        return $this->belongsTo(Club::class);
    }

    protected $guarded = ['id'];    
}
