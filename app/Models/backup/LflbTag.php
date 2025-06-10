<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LflbTag
 *
 * @property int $id
 * @property string $_oldid
 * @property int|null $story_id
 * @property string|null $storyid
 * @property string|null $value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property LflbStory|null $lflb_story
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag whereStoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbTag whereValue($value)
 * @mixin \Eloquent
 */
class LflbTag extends Model
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_tags';

    public $timestamps = false;

    protected $casts = [
        'story_id' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        '_oldid',
        'story_id',
        'storyid',
        'value',
        'created_at',
        'updated_at',
    ];

    public function exhibits_story()
    {
        return $this->belongsTo(LflbStory::class, 'story_id');
    }
}
