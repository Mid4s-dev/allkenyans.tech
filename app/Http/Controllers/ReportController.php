<?php

namespace App\Http\Controllers;

use App\Models\ReportedAccount;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $this->authorize('viewReports');
        
        $reports = ReportedAccount::with('reporter')
            ->latest()
            ->paginate(15);
            
        return view('report.index', compact('reports'));
    }

    public function create()
    {
        return view('report.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'twitter_account_id' => 'required|string',
            'username' => 'required|string|max:255',
            'category' => 'required|in:porn,hate_speech,propaganda,scam,other',
            'details' => 'required|string|max:1000',
        ]);

        $report = new ReportedAccount($validated);
        $report->reporter_id = auth()->id();
        $report->save();

        return redirect()->route('dashboard.blocked')
            ->with('success', 'Report submitted successfully.');
    }
}
