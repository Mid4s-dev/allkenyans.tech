<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportedAccount extends Model
{
    protected $fillable = [
        'reporter_id',
        'twitter_account_id',
        'username',
        'category',
        'details',
    ];

    protected $casts = [
        'category' => 'string',
    ];

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
