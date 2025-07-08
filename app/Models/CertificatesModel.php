<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Lumen\Auth\Authorizable;

class CertificatesModel extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'certificates';
    protected $primaryKey = 'certificate_id';
    protected $fillable = ['user_id', 'event_id', 'file_url', 'issued_at' ,'created_at', 'updated_at'];

    public function users(): BelongsTo {
        return $this->belongsTo(UsersModel::class, 'user_id', 'user_id');
    }

    public function events(): BelongsTo {
        return $this->belongsTo(EventsModel::class, 'event_id', 'event_id');
    }
}