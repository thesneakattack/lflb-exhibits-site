<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LflbStoryLflbSubCategory
 *
 * @property int $id
 * @property int|null $lflb_sub_category_id
 * @property int|null $lflb_story_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property LflbStory|null $lflb_story
 * @property LflbSubCategory|null $lflb_sub_category
 */
class LflbStoryLflbSubCategory extends Model
{
    protected $connection = 'lflb_exhibits_db';

    protected $table = 'lflb_story_lflb_sub_category';

    protected $casts = [
        'lflb_sub_category_id' => 'int',
        'lflb_story_id' => 'int',
    ];

    protected $fillable = [
        'lflb_sub_category_id',
        'lflb_story_id',
    ];

    public function lflb_story()
    {
        return $this->belongsTo(LflbStory::class);
    }

    public function lflb_sub_category()
    {
        return $this->belongsTo(LflbSubCategory::class);
    }
}
