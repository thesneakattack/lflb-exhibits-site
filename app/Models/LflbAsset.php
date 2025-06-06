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
 * Class LflbAsset
 *
 * @property int $id
 * @property string|null $_oldid
 * @property string|null $orgId
 * @property string|null $link
 * @property string|null $originalImage
 * @property string $type
 * @property string|null $text
 * @property string|null $cleanText
 * @property string|null $name
 * @property string|null $caption
 * @property string|null $tags
 * @property string|null $thumbnail
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection|LflbStory[] $lflb_stories
 * @property-read int|null $lflb_stories_count
 * @property-read Collection<int, \App\Models\LflbAssetLflbStory> $lflb_story_parts
 * @property-read int|null $lflb_story_parts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereCleanText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereOrgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereOriginalImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbAsset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LflbAsset extends Model
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_assets';

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
        'orgId',
        'link',
        'originalImage',
        'type',
        'text',
        'cleanText',
        'name',
        'caption',
        'tags',
        'thumbnail',
        'created_at',
        'updated_at',
    ];

    public function lflb_story_parts()
    {
        return $this->hasMany(LflbAssetLflbStory::class, 'asset_id');
    }

    public function lflb_stories()
    {
        return $this->belongsToMany(LflbStory::class, 'lflb_asset_lflb_story', 'asset_id', 'story_id')
            ->withPivot('id', '_oldid', 'caption', 'position', 'annotations')
            ->withTimestamps();
    }

    public function get_date_for_humans_attribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function file_url()
    {
        return $this->link
            ? Storage::disk('lflbassets')->url($this->link)
            : false;
    }
}
