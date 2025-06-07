<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

/**
 * Class LflbSubCategory
 *
 * @property int $id
 * @property string|null $_oldid
 * @property int|null $category_id
 * @property string $title
 * @property string|null $stories
 * @property string|null $stories_old
 * @property string|null $subTitle
 * @property string|null $mainImage
 * @property int|null $position
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property LflbCategory|null $lflb_category
 * @property Collection|LflbStory[] $lflb_stories
 * @property-read int|null $lflb_stories_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereStories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereStoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbSubCategory whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class LflbSubCategory extends Model
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_sub_categories';

    public $timestamps = false;

    protected $casts = [
        'category_id' => 'int',
        'position' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        '_oldid',
        'category_id',
        'title',
        'stories',
        'stories_old',
        'subTitle',
        'mainImage',
        'position',
        'created_at',
        'updated_at',
    ];

    public function exhibits_category(): BelongsTo
    {
        return $this->belongsTo(LflbCategory::class, 'category_id');
    }

    public function exhibits_stories(): BelongsToMany
    {
        return $this->belongsToMany(
            LflbStory::class,
            'lflb_story_lflb_sub_category',
            'lflb_sub_category_id',
            'lflb_story_id'
        )
            ->using(LflbStoryLflbSubCategory::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    public function get_created_date_for_humans_attribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function get_updated_date_for_humans_attribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    // Custom code David F.
    // public function story_ids()
    // {
    //     return explode(',', $this->stories);
    // }

    public function main_image_url()
    {
        return $this->mainImage
            ? Storage::disk('lflbassets')->url($this->mainImage)
            : false;
    }
}
