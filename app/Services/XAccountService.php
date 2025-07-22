<?php

namespace App\Services;

use App\Models\XAccount;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class XAccountService
{
    public function reportAccount(array $data, User $reporter)
    {
        return DB::transaction(function () use ($data, $reporter) {
            // Find or create Twitter account
            $account = TwitterAccount::firstOrCreate(
                ['twitter_id' => $data['twitter_id']],
                [
                    'username' => $data['username'],
                    'display_name' => $data['display_name'] ?? null,
                    'profile_image_url' => $data['profile_image_url'] ?? null,
                    'status' => 'reported',
                    'report_count' => 1,
                    'last_reported_at' => now()
                ]
            );

            if ($account->wasRecentlyCreated) {
                // Create initial status history
                $account->statusHistory()->create([
                    'user_id' => $reporter->id,
                    'new_status' => 'reported',
                    'reason' => 'Initial report'
                ]);
            } else {
                // Update existing account
                $account->increment('report_count');
                $account->update([
                    'last_reported_at' => now(),
                    'status' => 'reported'
                ]);

                // Add status history if status changed
                if ($account->wasChanged('status')) {
                    $account->statusHistory()->create([
                        'user_id' => $reporter->id,
                        'old_status' => $account->getOriginal('status'),
                        'new_status' => 'reported',
                        'reason' => 'New report received'
                    ]);
                }
            }

            // Create the report
            return $account->reports()->create([
                'reporter_id' => $reporter->id,
                'category' => $data['category'],
                'evidence' => $data['evidence'],
                'description' => $data['description']
            ]);
        });
    }

    public function resolveReport(AccountReport $report, User $resolver, string $action)
    {
        return DB::transaction(function () use ($report, $resolver, $action) {
            $report->resolve($resolver, $action);
            
            $account = $report->twitterAccount;
            
            switch ($action) {
                case 'block':
                    $account->block($resolver, "Blocked based on report #{$report->id}");
                    break;
                case 'watch':
                    $account->watch($resolver, "Placed on watch based on report #{$report->id}");
                    break;
                case 'dismiss':
                    // No action needed on the account
                    break;
            }

            return $report;
        });
    }

    public function getReportStatistics()
    {
        return [
            'total_accounts' => TwitterAccount::count(),
            'blocked_accounts' => TwitterAccount::blocked()->count(),
            'watching_accounts' => TwitterAccount::watching()->count(),
            'reported_accounts' => TwitterAccount::reported()->count(),
            'unresolved_reports' => AccountReport::unresolved()->count(),
            'total_reports' => AccountReport::count(),
        ];
    }
}
