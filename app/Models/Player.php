<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    public function provinces(){
        return $this->belongsTo(Province::class);
    }

    public function teams(){
        return $this->belongsTo(Team::class);
    }
    public function leagues(){
        return $this->belongsTo(League::class);
    }

    public function categorys(){
        return $this->belongsTo(Category::class);
    }
    public function loans(){
        return $this->belongsTo(Loan::class);
    }

    public function licenses(){
        return $this->hasMany(License::class);
    }
}
