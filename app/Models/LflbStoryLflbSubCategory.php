<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class LflbStoryLflbSubCategory
 *
 * @property int $id
 * @property int|null $lflb_sub_category_id
 * @property int|null $lflb_story_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property LflbStory|null $lflb_story
 * @property LflbSubCategory|null $lflb_sub_category
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory whereLflbStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory whereLflbSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStoryLflbSubCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LflbStoryLflbSubCategory extends Pivot
{
    // protected $connection = 'lflb_exhibits_db';
    
    protected $table = 'lflbsign_production.lflb_story_lflb_sub_category';

    public $timestamps = false;

    protected $casts = [
        'lflb_sub_category_id' => 'int',
        'lflb_story_id' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'lflb_sub_category_id',
        'lflb_story_id',
        'created_at',
        'updated_at'
    ];

    public function exhibits_story()
    {
        return $this->belongsTo(LflbStory::class);
    }

    public function exhibits_sub_category()
    {
        return $this->belongsTo(LflbSubCategory::class);
    }

    // Folio-compatible alias for `exhibits_story`
    public function exhibitsStory()
    {
        return $this->exhibits_story();
    }

    // Folio-compatible alias for `exhibits_sub_category`
    public function exhibitsSubCategory()
    {
        return $this->exhibits_sub_category();
    }

}
