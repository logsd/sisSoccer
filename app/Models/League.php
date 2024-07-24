<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    public function players(){
        return $this->hasMany(Player::class);
    }

    public function taxpayer(){
        return $this->belongsTo(TaxpayerType::class);
    }

    protected $guarded = ['id'];

    public function hanbleUploadImage($image){
        $file = $image;
        $name = time() . $file -> getClientOriginalName();
        //$file->move(public_path().'/img/clubs/',$name);
        Storage::putFileAs('/public/ligas/',$file,$name,'public');
        return $name;
     }
}
