<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxpayerType extends Model
{
    use HasFactory;

    public function generalParameters(){
        return $this->hasMany(GeneralParameter::class);
    }

    public function leagues(){
        return $this->hasMany(League::class);
    }

    protected $fillable = ['name','description','a_cont', 'state'];

}
