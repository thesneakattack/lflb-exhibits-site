<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Taggable extends MorphPivot
{
    protected $connection = 'mysql';
    protected $table = 'taggables';
}