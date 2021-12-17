<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $primaryKey = 'id';
    protected $fillable = ['image','user_id'];

    public function profile()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
