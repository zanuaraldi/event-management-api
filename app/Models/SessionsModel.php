<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Lumen\Auth\Authorizable;

class SessionsModel extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'sessions';
    protected $primaryKey = 'session_id';
    protected $fillable = ['event_id', 'title', 'speaker', 'start_time', 'end_time', 'created_at', 'updated_at'];

    public function events(): BelongsTo {
        return $this->belongsTo(EventsModel::class, 'event_id', 'event_id');
    }
}
