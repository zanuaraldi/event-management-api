<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class OrganizersModel extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'organizers';
    protected $primaryKey = 'organizer_id';
    protected $fillable = ['name', 'email', 'password', 'organization', 'phone', 'created_at', 'updated_at'];
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function events(): HasMany {
        return $this->hasMany(EventsModel::class, 'organizer_id', 'organizer_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
