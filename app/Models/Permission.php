<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name'];

    // to get the roles whice have this permission

    public function roles() {

        return $this->belongsToMany(Role::class);

     }
}
