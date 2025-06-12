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
 * @property-read int|null $lflb_assets_count
 * @property-read Collection<int, \App\Models\LflbAssetLflbStory> $lflb_story_parts
 * @property-read int|null $lflb_story_parts_count
 * @property-read int|null $lflb_sub_categories_count
 * @property-read int|null $lflb_tags_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereCategoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereEndDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereEndMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereEndYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereLocationLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereLocationLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereLocationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereMetaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereStartDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereStartYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbStory whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class LflbStory extends Model
{
    // protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflbsign_development.lflb_stories';

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

    public function lflb_assets()
    {
        return $this->belongsToMany(LflbAsset::class, 'lflbsign_development.lflb_asset_lflb_story', 'story_id', 'asset_id')
            ->using(LflbAssetLflbStory::class)
            ->withPivot('id', '_oldid', 'caption', 'position', 'annotations')->orderByPivot('position', 'asc')
            ->withTimestamps();
    }

    public function lflb_sub_categories()
    {
        return $this->belongsToMany(LflbSubCategory::class, 'lflbsign_development.lflb_story_lflb_sub_category', 'lflb_story_id', 'lflb_sub_category_id')
            ->using(LflbStoryLflbSubCategory::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    // public function tags()
    // {
    //     return $this->hasMany(LflbTag::class, 'story_id');
    // }

    public function tags()
    {
        return $this->morphToMany(\App\Models\Tag::class, 'taggable');
    }

    /**
     * Get the categories for the story.
     *
     * This method groups the subcategories by their associated category title.
     *
     * @return \Illuminate\Support\Collection
     */
    public function grouped_sub_categories_by_parent_title()
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

    public function archive_link()
    {
        return url('/archive/'.$this->category->slug.'/'.$this->slug);
    }

    public function link()
    {
        return url('/stories/'.$this->id);
    }

    // Folio-compatible alias for `lflb_app`
    public function lflbApp()
    {
        return $this->lflb_app();
    }

    // Folio-compatible alias for `lflb_assets`
    public function lflbAssets()
    {
        return $this->lflb_assets();
    }

    // Folio-compatible alias for `lflb_sub_categories`
    public function lflbSubCategories()
    {
        return $this->lflb_sub_categories();
    }

    // Folio-compatible alias for `grouped_sub_categories_by_parent_title`
    public function groupedSubCategoriesByParentTitle()
    {
        return $this->grouped_sub_categories_by_parent_title();
    }

    // Folio-compatible alias for `get_date_for_humans_attribute`
    public function getDateForHumansAttribute()
    {
        return $this->get_date_for_humans_attribute();
    }

    // Folio-compatible alias for `main_image_url`
    public function mainImageUrl()
    {
        return $this->main_image_url();
    }

    // Folio-compatible alias for `archive_link`
    public function archiveLink()
    {
        return $this->archive_link();
    }

}
