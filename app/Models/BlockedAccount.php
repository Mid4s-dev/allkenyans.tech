<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlockedAccount extends Model
{
    protected $fillable = [
        'user_id',
        'twitter_account_id',
        'username',
        'category',
        'reason',
    ];

    protected $casts = [
        'category' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
