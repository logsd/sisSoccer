<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateClub extends Model
{
    use HasFactory;

    public function clubs(){
        return $this->belongsTo(Club::class);
    }
}
