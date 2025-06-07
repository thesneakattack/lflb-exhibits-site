<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

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
 *
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
 *
 * @mixin \Eloquent
 */
class LflbCategory extends Model
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_categories';

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

    /**
     * Sub-categories under this category.
     */
    public function exhibits_sub_categories()
    {
        return $this->hasMany(
            LflbSubCategory::class,
            'category_id',
            'id'
        );
    }

    /**
     * Get all stories attached to this category via its sub-categories.
     *
     * @return \Illuminate\Support\Collection A collection of LflbStory models
     */
    /**
     * Chainable stories relation via pivot->sub-categories.
     */
    public function exhibits_stories(): BelongsToMany
    {
        return $this->belongsToMany(
            LflbStory::class,
            'lflb_story_lflb_sub_category',
            'lflb_sub_category_id',
            'lflb_story_id'
        )
            ->using(LflbStoryLflbSubCategory::class)
            ->join(
                'lflb_sub_categories',
                'lflb_sub_categories.id',
                '=',
                'lflb_story_lflb_sub_category.lflb_sub_category_id'
            )
            ->where('lflb_sub_categories.category_id', $this->id)
            ->select('lflb_stories.*');
    }
    // public function exhibits_stories()
    // {
    //     return $this->exhibits_sub_categories()             // 1️⃣ get the hasMany sub-categories
    //         ->with('exhibits_stories')                     // 2️⃣ eager-load each sub-category’s stories
    //         ->get()                               // 3️⃣ fetch the sub-categories
    //         ->pluck('exhibits_stories')                    // 4️⃣ pull out each sub-category’s stories (Collection of Collections)
    //         ->flatten()                           // 5️⃣ merge into one big Collection of LflbStory
    //         ->unique('id')                        // 6️⃣ remove duplicates (in case multiple sub-cats share a story)
    //         ->values();                           // 7️⃣ re-index the collection
    // }

    /**
     * Return all stories attached to this category, grouped by sub-category title.
     *
     * @return \Illuminate\Support\Collection
     *                                        A collection keyed by sub-category title, each value a Collection of LflbStory.
     */
    /**
     * Group stories by sub-category title, with optional app filter.
     */
    public function exhibits_stories_by_sub_category(?int $appId = null): Collection
    {
        $qb = $this->exhibits_stories();

        if ($appId !== null) {
            $qb->where('app_id', $appId);
        }

        $stories = $qb->with('exhibits_sub_categories')->get();

        return $stories->groupBy(function (LflbStory $story) {
            $sub = $story->exhibits_sub_categories
                ->first(fn ($sc) => $sc->category_id === $this->id);

            return $sub?->title ?? 'Uncategorized';
        });
    }

    // public function exhibits_stories_by_sub_category()
    // {
    //     return $this->exhibits_sub_categories()                                   // 1️⃣  Get the sub-category models
    //         ->with(['exhibits_stories' => function ($q) {                          // 2️⃣  Eager-load stories on each
    //             $q->orderBy('lflb_story_lflb_sub_category.updated_at');    //     optionally order by pivot.updated_at
    //         }])
    //         ->get()                                                      // 3️⃣  Fetch the sub-categories
    //         ->mapWithKeys(function ($subCat) {                           // 4️⃣  Re-key the collection
    //             return [$subCat->title => $subCat->exhibits_stories];
    //         });
    // }

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
}
