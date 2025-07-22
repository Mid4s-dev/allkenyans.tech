<?php

namespace App\Http\Controllers;

use App\Models\XAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get statistics for the public view
        $stats = [
            'total_blocked' => XAccount::where('status', 'blocked')->count(),
            'total_reports' => XAccount::sum('report_count'),
            'active_reports' => XAccount::where('status', 'reported')->count(),
        ];

        // Get recently blocked accounts
        $recentlyBlocked = XAccount::where('status', 'blocked')
            ->orderByDesc('last_blocked_at')
            ->limit(5)
            ->get();

        return view('home', compact('stats', 'recentlyBlocked'));
    }
}
