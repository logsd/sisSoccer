<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    public function player(){
        return $this->belongsTo(Player::class);
    }

    public function Championship(){
        return $this->belongsTo(Championship::class);
    }
    protected $guarded = ['id'];
}
