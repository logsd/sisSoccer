<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateClub extends Model
{
    use HasFactory;

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    protected $fillable = [
        'phone',
        'operator',
        'description',
        'state',
        'club_id'
    ];
}
