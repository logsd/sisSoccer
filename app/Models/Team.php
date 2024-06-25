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

    public function periods(){
        return $this->hasMany(Period::class);
    }

    public function categorys(){
        return $this->belongsTo(Category::class);
    }

    public function clubs(){
        return $this->belongsTo(Club::class);
    }
}
