<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    protected $table = 'event_user';
    protected $fillable = [
        'event_id',
        'user_id',
    ];

    public function event() :BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
