<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Lumen\Auth\Authorizable;

class EventsModel extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $fillable = ['organizer_id', 'title', 'description', 'is_private', 'location', 'start_date', 'end_date', 'price', 'created_at', 'updated_at'];

    public function organizers(): BelongsTo {
        return $this->belongsTo(OrganizersModel::class, 'organizer_id', 'organizer_id');
    }

    public function sessions(): HasMany {
        return $this->hasMany(SessionsModel::class, 'event_id', 'event_id');
    }

    public function tickets(): HasMany {
        return $this->hasMany(TicketsModel::class, 'event_id', 'event_id');
    }

    public function certificates(): HasMany {
        return $this->hasMany(CertificatesModel::class, 'event_id', 'event_id');
    }

    public function attendances(): HasMany {
        return $this->hasMany(AttendancesModel::class, 'event_id', 'event_id');
    }

    public function feedbacks(): HasMany {
        return $this->hasMany(FeedbacksModel::class, 'event_id', 'event_id');
    }
}
