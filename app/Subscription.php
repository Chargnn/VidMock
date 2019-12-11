<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Subscription extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'author_id',
        'user_id'
    ];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function subscribers(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
