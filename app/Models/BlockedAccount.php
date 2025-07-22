<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedAccount extends Model
{
    protected $fillable = [
        'username',
        'twitter_account_id',
        'category',
        'status',
        'reason',
        'profile_image_url'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function reports()
    {
        return $this->hasMany(ReportedAccount::class, 'username', 'username');
    }

    public function getBlockCountAttribute()
    {
        return $this->reports()->count();
    }
}
