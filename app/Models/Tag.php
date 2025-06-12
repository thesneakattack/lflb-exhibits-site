<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $connection = 'mysql';

    protected $fillable = ['name', 'slug', 'description'];

    public function stories()
    {
        return $this->morphedByMany(\App\Models\LflbStory::class, 'taggable', 'taggables')
            ->using(\App\Models\Taggable::class)
            ->withTimestamps();
    }

    public function subcategories()
    {
        return $this->morphedByMany(\App\Models\LflbSubCategory::class, 'taggable', 'taggables')
            ->using(\App\Models\Taggable::class)
            ->withTimestamps();
    }
}
