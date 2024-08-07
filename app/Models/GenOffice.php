<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenOffice extends Model
{
    use HasFactory;

    
    public function commissionLeague(){
        return $this->belongsTo(CommissionLeague::class);
    }
    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function genReport(){
        return $this->belongsTo(GenReport::class);
    }
    public function genCharge(){
        return $this->belongsTo(GenCharge::class);
    }
    protected $guarded = ['id'];
}
