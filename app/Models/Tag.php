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
    protected $fillable = ['name','description','keywords'];
    const EXCERPT_LENGTH = 100;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '-',
                'unique' => true,
                'maxLenghKeepWords' => true,
                'onUpdate' => true,
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
}
