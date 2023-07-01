<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $year
 * @property string $score
 * @property int $rating
 * @property string $genres
 * @property string $image
 */
class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'year',
        'score',
        'rating',
        'genres',
        'image',
    ];

    protected $casts = [
        'genres' => 'array'
    ];

    /**
     * @return BelongsToMany
     */
    public function actor(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class)->withTimestamps();
    }

    /**
     * @param $value
     * @return void
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = $value;
        $slug = Str::slug(preg_replace("/^(the|a|an)\b */i", "", $this->title));
        // We can't have duplicates, so let's append value to keep them separated
        $slugCnt = self::whereRaw("slug REGEXP '^$slug(-[0-9]+)?$' AND id != '$this->id'")->count();
        // grab the title and slugify it
        $this->attributes['slug'] = ($slugCnt > 0) ? "$slug-$slugCnt" : $slug;
    }
}
