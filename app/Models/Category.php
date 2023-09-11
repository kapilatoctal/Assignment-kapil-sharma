<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['parent_id', 'name'];

    //to get the patent category

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // to get the child category

    public function childs()
    {
    	return $this->hasMany(Category::class, 'parent_id');
    }

    // to get the posts related to this category

    public function posts() {

        return $this->belongsToMany(Post::class);

     }

     // to get only categories

    public function scopeOnlyCategories($query)
    {
        return $query->whereNull('parent_id');
    }

     // to get only subcategories

    public function scopeOnlySubCategories($query)
    {
        return $query->whereNotNull('parent_id');
    }


}
