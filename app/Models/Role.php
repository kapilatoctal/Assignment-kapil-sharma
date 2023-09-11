<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];


    // to get the users list who have this role

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // to get the permissions related to this role

    public function permissions() {

        return $this->belongsToMany(Permission::class);

     }
}
