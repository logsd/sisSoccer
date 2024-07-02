<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function leaguePhases()
    {
        return $this->hasMany(LeaguePhase::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    public function leagueGroups()
    {
        return $this->hasMany(LeagueGroups::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'name',
        'year',
        'start_date',
        'end_date',
        'from',
        'until',
        'description',
        'observation',
        'state',
        'category_id'
    ];
}
