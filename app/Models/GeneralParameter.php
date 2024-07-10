<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralParameter extends Model
{
    use HasFactory;

    public function civilStatus(){
        return $this->belongsTo(CivilStatus::class);
    }

    public function stateParameter(){
        return $this->belongsTo(StateParameter::class);
    }
    
    public function phoneOperator(){
        return $this->belongsTo(PhoneOperator::class);
    }

    public function taxpayerType(){
        return $this->belongsTo(TaxpayerType::class);
    }
    public function typeParameter(){
        return $this->belongsTo(TypeParameter::class);
    }
    public function typeSanction(){
        return $this->belongsTo(TypeSanction::class);
    }
    protected $guarded = ['id'];
}