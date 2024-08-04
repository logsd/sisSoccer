<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectClub extends Model
{
    use HasFactory;

    
    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function championship(){
        return $this->belongsTo(Championship::class);
    }

    protected $guarded = ['id'];
}
