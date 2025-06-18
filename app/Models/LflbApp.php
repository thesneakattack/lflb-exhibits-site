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
 * @property-read int|null $lflb_stories_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereCategoriesOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereMainColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereMapCenterAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereMapCenterAddressCoordsLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereMapCenterAddressCoordsLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereSecondaryColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbApp whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LflbApp extends Model
{
    // protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflbsign_production.lflb_apps';

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
    public function exhibits_stories()
    {
        return $this->hasMany(LflbStory::class, 'app_id');
    }

    // Folio-compatible alias for `exhibits_stories`
    public function exhibitsStories()
    {
        return $this->exhibits_stories();
    }

}
