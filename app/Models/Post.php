<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//    protected $fillable = [
//        'id', 'title', 'short_description'
//    ];
    protected $guarded = [];

    public function getAuthor(){
       return $this->hasOne(User::class, 'id', 'author');
    }

    public function photos(){
        return $this->hasMany(PostHasPhoto::class, 'post_id', 'id');
    }
}
