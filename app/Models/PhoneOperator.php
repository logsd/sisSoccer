<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneOperator extends Model
{
    use HasFactory;

    public function generalParameters(){
        return $this->hasMany(GeneralParameter::class);
    }

    protected $fillable = ['name', 'vg'];
}
