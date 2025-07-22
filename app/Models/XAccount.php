<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'x_id',
        'username',
        'display_name',
        'profile_image_url',
        'bio',
        'followers_count',
        'following_count',
        'is_verified',
        'is_protected',
        'status',
        'report_count',
        'report_details',
        'last_reported_at',
        'last_blocked_at',
        'reports'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_protected' => 'boolean',
        'report_details' => 'array',
        'reports' => 'array',
        'last_reported_at' => 'datetime',
        'last_blocked_at' => 'datetime'
    ];

    public function reports()
    {
        return $this->hasMany(AccountReport::class, 'x_account_id');
    }

    public function statusHistory()
    {
        return $this->hasMany(AccountStatusHistory::class, 'x_account_id');
    }

    public function blockRecords()
    {
        return $this->hasMany(BlockedAccount::class, 'x_account_id');
    }

    public function scopeWatching($query)
    {
        return $query->where('status', 'watching');
    }

    public function scopeReported($query)
    {
        return $query->where('status', 'reported');
    }

    public function scopeBlocked($query)
    {
        return $query->where('status', 'blocked');
    }
}
