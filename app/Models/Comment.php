<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['content','user_id','article_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function article()
    {
        return $this->belongsTo(Article::class)->withDefault();
    }
}
