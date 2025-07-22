<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountReport extends Model
{
    protected $fillable = [
        'twitter_account_id',
        'reporter_id',
        'category',
        'evidence',
        'description',
        'action_taken',
        'resolved_at',
        'resolved_by'
    ];

    protected $casts = [
        'evidence' => 'json',
        'resolved_at' => 'datetime',
    ];

    public function twitterAccount(): BelongsTo
    {
        return $this->belongsTo(TwitterAccount::class);
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function resolver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    // Scopes
    public function scopeUnresolved($query)
    {
        return $query->whereNull('resolved_at');
    }

    public function scopeResolved($query)
    {
        return $query->whereNotNull('resolved_at');
    }

    // Methods
    public function resolve(User $user, string $action)
    {
        $this->update([
            'resolved_at' => now(),
            'resolved_by' => $user->id,
            'action_taken' => $action
        ]);
    }
}
