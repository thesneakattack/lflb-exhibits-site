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
