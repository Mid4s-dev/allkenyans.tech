@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-4 mb-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Reports</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_reports'] }}</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Active Reports</dt>
                    <dd class="mt-1 text-3xl font-semibold text-indigo-600">{{ $stats['active_reports'] }}</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Blocked Accounts</dt>
                    <dd class="mt-1 text-3xl font-semibold text-red-600">{{ $stats['blocked_accounts'] }}</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Watching</dt>
                    <dd class="mt-1 text-3xl font-semibold text-yellow-600">{{ $stats['watching_accounts'] }}</dd>
                </div>
            </div>
        </div>

        <!-- Most Reported Accounts -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Most Reported Accounts</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                        @foreach($mostReportedAccounts as $account)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="{{ $account->profile_image_url }}" alt="">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $account->username }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ $account->display_name }}</p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        {{ $account->report_count }} reports
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Reports by Category -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Reports by Category</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($reportsByCategory as $category)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-base font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $category->report_category) }}</h4>
                        <p class="mt-1 text-2xl font-semibold text-indigo-600">{{ $category->total }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Accounts by Category -->
        @foreach($accountsByCategory as $category => $accounts)
            @if($accounts->isNotEmpty())
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $category) }}</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="flow-root">
                        <ul role="list" class="-my-5 divide-y divide-gray-200">
                            @foreach($accounts as $account)
                            <li class="py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="h-8 w-8 rounded-full" src="{{ $account->profile_image_url }}" alt="">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $account->username }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ $account->display_name }}</p>
                                        <p class="text-xs text-gray-400">Last reported: {{ $account->last_reported_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $account->report_count }} reports
                                        </span>
                                        @if($account->status === 'blocked')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Blocked
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
