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

class UsersModel extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['name', 'email', 'password', 'phone', 'photo_url', 'created_at', 'updated_at'];
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function tickets(): HasMany {
        return $this->hasMany(TicketsModel::class, 'user_id', 'user_id');
    }

    public function certificates(): HasMany {
        return $this->hasMany(CertificatesModel::class, 'user_id', 'user_id');
    }

    public function attendances(): HasMany {
        return $this->hasMany(AttendancesModel::class, 'user_id', 'user_id');
    }

    public function feedbacks(): HasMany {
        return $this->hasMany(FeedbacksModel::class, 'user_id', 'user_id');
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
