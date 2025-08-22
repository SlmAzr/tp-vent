<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'creator_id',
    ];

    public function creator():BelongsTo{
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function participants():HasMany{
        return $this->hasMany(Participant::class);
    }
}
