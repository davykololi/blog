<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','keywords','slug'];
    const EXCERPT_LENGTH = 100;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function articles()
    {
    	return $this->belongsToMany(Article::class,'article_tag')->withTimestamps();
    }

    public function excerpt()
    {
        return Str::limit(strip_tags($this->description),Tag::EXCERPT_LENGTH);
    }

    public function path()
    {
        return route('tag.articles', $this->slug);
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('articles');
    }

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        return $this->attributes['description'] = ucwords($value);
    }
}
