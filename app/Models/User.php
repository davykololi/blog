<?php

namespace App\Models;

use Cache;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Profile;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Lab404\Impersonate\Models\Impersonate;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements BannableContract
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, Impersonate, Bannable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name','email','role','banned_at','password','provider','provider_id','slug'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEditor()
    {
        return $this->role === 'editor';
    }

    public function isAuthor()
    {
        return $this->role === 'author';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function profile()
    {
        return $this->hasOne(Profile::class,'user_id','id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class,'user_id','id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class,Article::class,'user_id','article_id','id');
    }

    public function path()
    {
        return route('articleBy.articles', $this->slug);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }
}
