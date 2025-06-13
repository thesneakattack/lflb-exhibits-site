<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LflbStory;
use App\Models\LflbSubCategory;

class Tag extends Model
{
    protected $connection = 'mysql';

    protected $fillable = ['name', 'slug', 'description', 'type'];

    public function stories()
    {
        return $this->morphedByMany(\App\Models\LflbStory::class, 'taggable');
    }

    public function lflbStories()
    {
        return $this->stories();
    }


    public function subcategories()
    {
        return $this->morphedByMany(\App\Models\LflbSubCategory::class, 'taggable');
    }

    public static function randomHeroStory()
    {
        return static::where('slug', 'hero')->first()?->stories()->inRandomOrder()->first();
    }

    public static function storiesForSection(string $slug, ?int $limit = null)
    {
        $query = static::where('slug', $slug)->first()?->stories()->latest();
        return $limit ? $query?->limit($limit)->get() : $query?->get();
    }    

    public function getLabeledNameAttribute(): string
    {
        return ucfirst($this->type) . ': ' . $this->name; // Used for display in select options
    }    
}
