<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LflbApp
 *
 * @property int $id
 * @property string|null $_oldid
 * @property string $name
 * @property string|null $orgId
 * @property string|null $description
 * @property string|null $image
 * @property string|null $categories
 * @property string|null $categories_old
 * @property string|null $mapCenterAddress
 * @property string|null $mapCenterAddressCoords_lat
 * @property string|null $mapCenterAddressCoords_lng
 * @property string|null $mainColor
 * @property string|null $secondaryColor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|LflbStory[] $lflb_stories
 */
class LflbApp extends Model
{
    protected $table = 'lflb_apps';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        '_oldid',
        'name',
        'orgId',
        'description',
        'image',
        'categories',
        'categories_old',
        'mapCenterAddress',
        'mapCenterAddressCoords_lat',
        'mapCenterAddressCoords_lng',
        'mainColor',
        'secondaryColor',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lflb_stories()
    {
        return $this->hasMany(LflbStory::class, 'app_id');
    }
}
