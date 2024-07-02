<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    public function teams(){
        return $this->hasMany(Team::class);
    }

    
    public function dateClubs(){
        return $this->hasMany(DateClub::class);
    }
    
    public function directClubs(){
        return $this->hasMany(DirectClub::class);
    }
    protected $fillable = [
        'name',
        'trade_name',
        'reason_social',
        'ruc',
        'direction',
        'email',
        'date_constion',
        'direction_web',
        'slogan',
        'logo',
        'description',
        'parish',
         'state'];

         public function hanbleUploadImage($image){
            $file = $image;
            $name = time() . $file -> getClientOriginalName();
            //$file->move(public_path().'/img/clubs/',$name);
            Storage::putFileAs('/public/clubs/',$file,$name,'public');
            return $name;
         }
}
