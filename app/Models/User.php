<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Role;
use App\Models\Permission;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // to get the roles associated with this user

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // to check if this user has a role assigned

    public function hasRole($role)
    {

        if ($this->roles && $this->roles->contains('slug', $role)) {
            return true;
        }

        return false;
    }

    // to check if user has permission to interact

    public function hasPermission($permission)
    {
        if ($this->roles) {
            foreach ($this->roles as $role) {
                if ($role->permissions->contains('slug', $permission)) {
                    return true;
                }
            }
        }

        return false;
    }

    // to get all posts of this user

    public function posts()
    {
        return $this->hasMany(Post::class,'author_id','id');
    }

    /**
     * Scope a query to not include users who have admin roles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExceptAdmin($query)
    {
        return $query->whereHas('roles', function($q){
            $q->where('slug','!=', 'admin');
        });
    }


}
