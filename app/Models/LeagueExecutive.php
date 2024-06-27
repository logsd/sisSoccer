<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueExecutive extends Model
{
    use HasFactory;

    public function genTelephone(){
        return $this->hasMany(GenTelephone::class);
    }
    public function genState(){
        return $this->hasMany(GenState::class);
    }

    protected $fillable = [
        'dni',
        'name',
        'lastname',
        'address',
        'email',
        'img_path',
        'state'];

        public function hanbleUploadImage($image){
            $file = $image;
            $name = time() . $file -> getClientOriginalName();
            //$file->move(public_path().'/img/clubs/',$name);
            Storage::putFileAs('/public/ejecutivos/',$file,$name,'public');
            return $name;
         }
}
