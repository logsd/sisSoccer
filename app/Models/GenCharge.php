<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenCharge extends Model
{
    use HasFactory;

    public function genOffices(){
        return $this->hasMany(GenOffice::class);
    }
    protected $guarded = [
        'id'
    ];
}
