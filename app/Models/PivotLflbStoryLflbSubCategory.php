<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * 
 *
 * @property int $id
 * @property int|null $lflb_sub_category_id
 * @property int|null $lflb_story_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LflbCategory> $lflb_category
 * @property-read int|null $lflb_category_count
 * @property-read \App\Models\LflbStory|null $lflb_story
 * @property-read \App\Models\LflbSubCategory|null $lflb_sub_category
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory whereLflbStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory whereLflbSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PivotLflbStoryLflbSubCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PivotLflbStoryLflbSubCategory extends Pivot
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_story_lflb_sub_category';

    public function lflb_story()
    {
        return $this->belongsTo('App\Models\LflbStory');
    }

    public function lflb_sub_category()
    {
        return $this->belongsTo('App\Models\LflbSubCategory');
    }

    public function lflb_category()
    {
        return $this->hasManyThrough(
            'App\Models\LflbCategory',
            'App\Models\LflbSubCategory',
            'category_id',
            'category_id'
        );
    }
}
