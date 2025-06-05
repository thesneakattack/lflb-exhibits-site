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
 * Class LflbStory
 *
 * @property int $id
 * @property string|null $_oldid
 * @property string $title
 * @property int|null $app_id
 * @property string|null $description
 * @property string|null $image
 * @property string|null $imageUrl
 * @property string|null $categories_old
 * @property string|null $categories
 * @property string|null $startDay
 * @property string|null $startMonth
 * @property string|null $startYear
 * @property string|null $endDay
 * @property string|null $endMonth
 * @property string|null $endYear
 * @property string|null $locationName
 * @property string|null $location_lat
 * @property string|null $location_lng
 * @property string|null $metaData
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property LflbApp|null $lflb_app
 * @property Collection|LflbAsset[] $lflb_assets
 * @property Collection|LflbSubCategory[] $lflb_sub_categories
 * @property Collection|LflbTag[] $lflb_tags
 */
class LflbStory extends Model
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_stories';

    public $timestamps = false;

    protected $casts = [
        'app_id' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        '_oldid',
        'title',
        'app_id',
        'description',
        'image',
        'imageUrl',
        'categories_old',
        'categories',
        'startDay',
        'startMonth',
        'startYear',
        'endDay',
        'endMonth',
        'endYear',
        'locationName',
        'location_lat',
        'location_lng',
        'metaData',
        'created_at',
        'updated_at',
    ];

    public function lflb_app()
    {
        return $this->belongsTo(LflbApp::class, 'app_id');
    }

    public function lflb_story_parts()
    {
        return $this->hasMany('App\Models\LflbAssetLflbStory', 'story_id');
    }

    public function lflb_assets()
    {
        return $this->belongsToMany(LflbAsset::class, 'lflb_asset_lflb_story', 'story_id', 'asset_id')
            ->withPivot('id', '_oldid', 'caption', 'position', 'annotations')
            ->withTimestamps();
    }

    public function lflb_sub_categories()
    {
        return $this->belongsToMany(LflbSubCategory::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    public function lflb_tags()
    {
        return $this->hasMany(LflbTag::class, 'story_id');
    }

    public function lflb_categories()
    {
        $collection = $this->lflbSubCategories;
        $grouped = $collection->mapToGroups(function ($item, $key) {
            return [$item->lflbCategory->title => $item];
        });
        // ->map(function ($group) {
        //     return $group->all();
        // })->all();

        return $grouped;
    }

    public function get_date_for_humans_attribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    public function main_image_url()
    {
        return $this->image
            ? Storage::disk('lflbassets')->url($this->image)
            : false;
    }
}
