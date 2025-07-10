<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Lumen\Auth\Authorizable;

class FeedbacksModel extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'feedbacks';
    protected $primaryKey = 'feedback_id';
    protected $fillable = ['user_id', 'event_id', 'rating', 'comment', 'created_at', 'updated_at'];

    public function users(): BelongsTo {
        return $this->belongsTo(UsersModel::class, 'user_id', 'user_id');
    }

    public function events(): BelongsTo {
        return $this->belongsTo(EventsModel::class, 'event_id', 'event_id');
    }
}