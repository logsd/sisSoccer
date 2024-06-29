<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function league(){
        return $this->belongsTo(League::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function loan(){
        return $this->belongsTo(Loan::class);
    }

    public function licenses(){
        return $this->hasMany(License::class);
    }
}
