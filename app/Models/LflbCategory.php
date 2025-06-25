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
 * Class LflbCategory
 *
 * @property int $id
 * @property string|null $_oldid
 * @property string $title
 * @property string|null $description
 * @property string|null $coverPhoto
 * @property string|null $sub_categories_old
 * @property string|null $sub_categories
 * @property string $featured
 * @property string|null $introText
 * @property string|null $bodyText
 * @property string|null $mainImage
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection|LflbSubCategory[] $lflb_sub_categories
 * @property-read \App\Models\PivotLflbStoryLflbSubCategory|null $pivot
 * @property-read Collection<int, \App\Models\LflbStory> $lflb_categories
 * @property-read int|null $lflb_categories_count
 * @property-read int|null $lflb_sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereBodyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereCoverPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereIntroText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereSubCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereSubCategoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LflbCategory extends Model
{
    // protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflbsign_production.lflb_categories';

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        '_oldid',
        'title',
        'description',
        'coverPhoto',
        'sub_categories_old',
        'sub_categories',
        'featured',
        'introText',
        'bodyText',
        'mainImage',
        'created_at',
        'updated_at',
    ];

    public function lflb_sub_categories()
    {
        return $this->hasMany(LflbSubCategory::class, 'category_id');
    }

    /**
     * Get all stories attached to this category via its sub-categories.
     *
     * @return \Illuminate\Support\Collection  A collection of LflbStory models
     */
    public function lflb_stories()
    {
        return $this->lflb_sub_categories()             // 1️⃣ get the hasMany sub-categories
            ->with('lflb_stories')                     // 2️⃣ eager-load each sub-category’s stories
            ->get()                               // 3️⃣ fetch the sub-categories
            ->pluck('lflb_stories')                    // 4️⃣ pull out each sub-category’s stories (Collection of Collections)
            ->flatten()                           // 5️⃣ merge into one big Collection of LflbStory
            ->unique('id')                        // 6️⃣ remove duplicates (in case multiple sub-cats share a story)
            ->values();                           // 7️⃣ re-index the collection
    }

    /**
     * Return all stories attached to this category, grouped by sub-category title.
     *
     * @return \Illuminate\Support\Collection
     *     A collection keyed by sub-category title, each value a Collection of LflbStory.
     */
    public function lflb_stories_by_sub_category()
    {
        return $this->lflb_sub_categories()                                   // 1️⃣  Get the sub-category models
            ->with(['lflb_stories' => function($q) {                          // 2️⃣  Eager-load stories on each
                $q->orderBy('lflb_story_lflb_sub_category.updated_at');    //     optionally order by pivot.updated_at
            }])
            ->get()                                                      // 3️⃣  Fetch the sub-categories
            ->mapWithKeys(function($subCat) {                           // 4️⃣  Re-key the collection
                return [ $subCat->title => $subCat->lflb_stories ];
            });
    }

    // custom code David F.
    const STATUSES = [
        'TRUE' => 'Yes',
        'FALSE' => 'No',
    ];

    public function get_status_color_attribute()
    {
        return [
            'TRUE' => 'green',
            'FALSE' => 'red',
        ][$this->featured] ?? 'cool-gray';
    }

    public function get_date_for_humans_attribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function main_image_url()
    {
        return $this->mainImage
            ? Storage::disk('lflbassets')->url($this->mainImage)
            : false;
    }

    // Folio-compatible alias for `lflb_sub_categories`
    public function lflbSubCategories()
    {
        return $this->lflb_sub_categories();
    }

    // Folio-compatible alias for `lflb_stories`
    public function lflbStories()
    {
        return $this->lflb_stories();
    }

    // Folio-compatible alias for `lflb_stories_by_sub_category`
    public function lflbStoriesBySubCategory()
    {
        return $this->lflb_stories_by_sub_category();
    }

    // Folio-compatible alias for `get_status_color_attribute`
    public function getStatusColorAttribute()
    {
        return $this->get_status_color_attribute();
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

}
