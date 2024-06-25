<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenOffice extends Model
{
    use HasFactory;

    public function genReport(){
        return $this->belongsTo(GenReport::class);
    }
    public function genCharge(){
        return $this->belongsTo(GenCharge::class);
    }
    public function commissionLeague(){
        return $this->belongsTo(CommissionLeague::class);
    }
}
