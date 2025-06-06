<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LflbMetadatum
 *
 * @property int $id
 * @property string $_oldid
 * @property string|null $contributor
 * @property string|null $creator
 * @property string|null $description
 * @property string|null $format
 * @property string|null $identifier
 * @property string|null $language
 * @property string|null $publisher
 * @property string|null $relation
 * @property string|null $rights
 * @property string|null $source
 * @property string|null $subject
 * @property string|null $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereContributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereCreator($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereOldid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LflbMetadatum whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LflbMetadatum extends Model
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_metadata';

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        '_oldid',
        'contributor',
        'creator',
        'description',
        'format',
        'identifier',
        'language',
        'publisher',
        'relation',
        'rights',
        'source',
        'subject',
        'type',
        'created_at',
        'updated_at',
    ];
}
