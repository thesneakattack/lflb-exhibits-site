<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Pivots\PivotCategory;
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
 */
class LflbCategory extends Model
{
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

    public function lflb_sub_categories()
    {
        return $this->hasMany(LflbSubCategory::class, 'category_id');
    }

    public function lflb_categories()
    {
        return $this->belongsToMany(LflbStory::class)->using(PivotCategory::class);
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
}
