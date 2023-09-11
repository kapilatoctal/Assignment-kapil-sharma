<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','content','author_id','slug','category_id'];

    // To get the tags related to this post

    public function tags() {

        return $this->belongsToMany(Tag::class);

     }

     // to get the category related to this post

     public function category() {

        return $this->belongsToMany(Category::class);

     }

     // to get the author of this post

     public function author() {

        return $this->belongsTo(User::class,'id','author_id');

     }
}
