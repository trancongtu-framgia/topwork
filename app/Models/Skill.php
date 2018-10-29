<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Skill extends Model
{
    protected $table = 'skills';
    use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
    ];
    public function searchableAs()
    {
        return 'skills';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

    public function skillCategory()
    {
        return $this->belongsTo('\App\Models\Category', 'category_id', 'id');
    }

    public function skillJobs()
    {
        return $this->hasMany('\App\Models\JobSkill', 'skill_id', 'id');
    }
}
