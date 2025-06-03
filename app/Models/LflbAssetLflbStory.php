<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LflbAssetLflbStory
 *
 * @property int $id
 * @property string|null $_oldid
 * @property int|null $asset_id
 * @property int|null $story_id
 * @property string|null $caption
 * @property int|null $position
 * @property string|null $annotations
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property LflbAsset|null $lflb_asset
 * @property LflbStory|null $lflb_story
 */
class LflbAssetLflbStory extends Model
{
    protected $table = 'lflb_asset_lflb_story';

    public $timestamps = false;

    protected $casts = [
        'asset_id' => 'int',
        'story_id' => 'int',
        'position' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        '_oldid',
        'asset_id',
        'story_id',
        'caption',
        'position',
        'annotations',
        'created_at',
        'updated_at',
    ];

    public function lflb_asset()
    {
        return $this->belongsTo(LflbAsset::class, 'asset_id');
    }

    public function lflb_story()
    {
        return $this->belongsTo(LflbStory::class, 'story_id');
    }
}
