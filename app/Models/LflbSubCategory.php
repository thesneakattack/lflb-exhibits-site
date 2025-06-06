<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Storage;

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

    public function lflb_category()
    {
        return $this->belongsTo(LflbCategory::class, 'category_id');
    }

    public function lflb_stories()
    {
        return $this->belongsToMany(LflbStory::class)
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
    public function story_ids()
    {
        return explode(',', $this->stories);
    }

    public function main_image_url()
    {
        return $this->mainImage
            ? Storage::disk('lflbassets')->url($this->mainImage)
            : false;
    }
}
