<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LflbStory;
use App\Models\LflbSubCategory;

class Tag extends Model
{
    protected $connection = 'mysql';

    protected $fillable = ['name', 'slug', 'description'];

    public function stories()
    {
        return $this->morphedByMany(\App\Models\LflbStory::class, 'taggable');
    }

    public function subcategories()
    {
        return $this->morphedByMany(\App\Models\LflbSubCategory::class, 'taggable');
    }
}
