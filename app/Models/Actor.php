<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property int $rating
 * @property string $image_path
 * @property string $alternative_name
 */
class Actor extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'rating',
        'image_path',
        'alternative_name',
    ];

    /**
     * @return BelongsToMany
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)->withTimestamps();
    }

    /**
     * @param $value
     * @return void
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $slug = Str::slug(preg_replace("/^(the|a|an)\b */i", "", $this->name));
        // We can't have duplicates, so let's append value to keep them separated
        $slugCnt = self::whereRaw("slug REGEXP '^$slug(-[0-9]+)?$' AND id != '$this->id'")->count();
        // grab the title and slugify it
        $this->attributes['slug'] = ($slugCnt > 0) ? "$slug-$slugCnt" : $slug;
    }
}
