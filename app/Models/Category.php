<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'categories';
    protected $primaryKey = 'id';
	protected $fillable = ['name','slug','description','keywords'];
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
		return $this->hasMany(Article::class,'category_id','id');
	}

    public function excerpt()
    {
        return Str::limit(strip_tags($this->description),Category::EXCERPT_LENGTH);
    }

    public function path()
    {
        return route('category.articles', $this->slug);
    }

    public function getAll()
    {
    	return static::all();
    }

    public function categoryId($id)
    {
    	return static::findOrFail($id);
    }

    public function deleteCategory($id)
    {
    	return static::destroy($id);
    }

    public function paginated()
    {
    	return static::latest()->paginate(config('blog.articles_per_page'));
    }

    public function categorySlug($slug)
    {
        return static::query()->whereSlug($slug)->first();
    }

    public function categoryWithArticles()
    {
        return static::with('articles')->get();
    }

    public function scopeLaravelCategory($query)
    {
        return $query->whereName('Laravel')->first();
    }

    public function scopeReactJsCategory($query)
    {
        return $query->whereName('React Js')->first();
    }

    public function scopeVueJsCategory($query)
    {
        return $query->whereName('Vue Js')->first();
    }

    public function scopeTailwindCssCategory($query)
    {
        return $query->whereName('Tailwind Css')->first();
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
