<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function blockedAccounts()
    {
        $blockedAccounts = auth()->user()->blockedAccounts()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.blocked', compact('blockedAccounts'));
    }

    public function unblock($id)
    {
        $blockedAccount = auth()->user()->blockedAccounts()->findOrFail($id);
        $blockedAccount->delete();

        return back()->with('success', 'Account has been unblocked.');
    }
}