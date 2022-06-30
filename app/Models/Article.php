<?php

namespace App\Models;

use File;
use Response;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model implements Feedable
{
    use HasFactory, Sluggable;
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $dates = ['published_at']; 
    protected $fillable = ['title','image','caption','content','description','keywords','total_views','is_published','user_id','category_id','slug','published_at','published_by'];
    const EXCERPT_LENGTH = 100;
    protected $appends = ['published_date','published_time','published_on'];
    protected $casts = ['user_id'=>'int','category_id'=>'int','is_published'=>'boolean','total_views'=>'int'];
    protected $with = ['user','category','tags','comments','category:id,name,description,keywords'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id(env('APP_URL').'/article/'.$this->slug)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link(route('article.details',$this->slug))
            ->author($this->user->name);
    }

    public static function getFeedItems()
    {
        return Article::published()->latest()->limit(50)->get();
    }

    public static function booted()
    {
        static::creating(function($article){
            //delete comments
            //delete images
        });

        static::updating(function($article){
            //update comments
            //update images
        });
    }


    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'article_tag')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'article_id','id')->with('user','article');
    }

    public function excerpt()
    {
        return Str::limit(strip_tags($this->content),Article::EXCERPT_LENGTH);
    }

    public function scopeEagerLoaded($query)
    {
        return $query->with('user','category','tags','comments')->withCount('comments');
    }

    public function path()
    {
        return route('article.details', $this->slug);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOneWeek($query)
    {	
    	$date = Carbon::now()->subDays(7);
        
        return $query->where('created_at', '<', $date);
    } 

    /**
    * Set the title attribute and automatically the slug
    * 
    * @param string $value
    */
    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = ucwords($value);

        if (! $this->exists){ 
            $this->setUniqueSlug($value, '');
        } 
    }

    /**
    * Recursive routine to set a unique slug
    *
    * @param string $title
    * @param mixed $extra
    */
    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title.'-'.$extra);
        if (static::whereSlug($slug)->exists()){
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }
        $this->attributes['slug'] = $slug;
    } 

    public function setDescriptionAttribute($value)
    {
        return $this->attributes['description'] = ucwords($value);
    }

    public function setCaptionAttribute($value)
    {
        return $this->attributes['caption'] = ucwords($value);
    }

    public function imageUrl()
    {
        return url('/storage/storage/'.$this->image);
    }

    /**
    * Return the date portion of published_date
    */
    public function getPublishedDateAttribute($value)
    { 
        return $this->published_at->format('M-j-Y');
    } 

    /**
    * Return the date portion of published_time
    */
    public function getPublishedTimeAttribute($value)
    { 
        return Carbon::parse($this->published_at)->format('g:i A');
    } 

    /**
    * Return the date portion of published_time
    */
    public function getPublishedOnAttribute($value)
    { 
        $published_on = new Carbon($this->published_date.' '.$this->published_time); 

        return $published_on;
    } 

    /**
    * Return the date portion of published_time
    */
    public function createdDate()
    { 
        return Carbon::parse($this->created_at)->format('M d, Y');
    } 
}
