<?php

namespace App\Http\Controllers;

use App\Models\BlockedAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function index()
    {
        $categories = ['porn', 'hate_speech', 'propaganda', 'scam', 'other'];
        
        // Get overall top offenders
        $overallTopOffenders = BlockedAccount::select('username')
            ->selectRaw('count(*) as block_count')
            ->groupBy('username')
            ->orderByDesc('block_count')
            ->limit(10)
            ->get();
        
        // Get top offenders by category
        $topOffenders = [];
        foreach ($categories as $category) {
            $topOffenders[$category] = BlockedAccount::where('category', $category)
                ->select('username')
                ->selectRaw('count(*) as block_count')
                ->groupBy('username')
                ->orderByDesc('block_count')
                ->limit(5)
                ->get();
        }
        
        $totalBlocks = BlockedAccount::count();
        $categoryStats = BlockedAccount::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->get()
            ->mapWithKeys(function ($item) use ($totalBlocks) {
                return [$item->category => $totalBlocks > 0 ? round(($item->count / $totalBlocks) * 100, 1) : 0];
            });
        
        return view('home', compact('overallTopOffenders', 'topOffenders', 'categoryStats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'twitter_account_id' => 'required|string',
            'username' => 'required|string|max:255',
            'category' => 'required|in:porn,hate_speech,propaganda,scam,other',
            'reason' => 'required|string|max:1000',
        ]);

        // In a real app, you would make an API call to Twitter here
        // For now, we'll just store the blocked account in our database
        
        $blocked = BlockedAccount::create([
            'user_id' => Auth::id(), // Nullable for anonymous users
            'twitter_account_id' => $validated['twitter_account_id'],
            'username' => $validated['username'],
            'category' => $validated['category'],
            'reason' => $validated['reason'],
        ]);

        return back()->with('success', 'Account has been blocked successfully.');
    }
}
