<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    public function players(){
        return $this->belongsTo(Player::class);
    }

    public function Championships(){
        return $this->belongsTo(Championship::class);
    }
}
