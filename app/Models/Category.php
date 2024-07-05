<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function players(){
        return $this->hasMany(Player::class);
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }

    public function categorys(){
        return $this->hasMany(Category::class);
    }

    protected $fillable = ['name','description', 'state'];
}
