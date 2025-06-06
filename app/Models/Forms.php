<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property array<array-key, mixed> $fields
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Forms whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Forms extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'fields',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fields' => 'array', // Cast the fields attribute to an array
        'is_active' => 'boolean',
    ];
}
