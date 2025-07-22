<x-app-layout>
    @section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-semibold mb-6">Overall Top Offenders</h1>
            
            <div class="bg-gray-50 rounded-lg p-4 mb-8">
                <div class="space-y-2">
                    @forelse($overallTopOffenders as $account)
                        <div class="flex justify-between items-center p-2 hover:bg-gray-100 rounded">
                            <span class="text-gray-700 font-medium">{{ $account->username }}</span>
                            <span class="text-sm bg-red-100 text-red-800 px-2 py-1 rounded">{{ $account->block_count }} blocks</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">No blocked accounts found</p>
                    @endforelse
                </div>
            </div>

            <h1 class="text-2xl font-semibold mb-6">Top Offenders by Category</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach(['porn', 'hate_speech', 'propaganda', 'scam', 'other'] as $category)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-3 capitalize">{{ str_replace('_', ' ', $category) }}</h2>
                        <div class="space-y-2">
                            @forelse($topOffenders[$category] as $account)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">{{ $account->username }}</span>
                                    <span class="text-sm text-gray-500">{{ $account->block_count }} blocks</span>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">No blocked accounts in this category</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Category Distribution</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex h-4 mb-2">
                        @foreach($categoryStats as $category => $percentage)
                            <div
                                class="h-full {{ $loop->first ? 'rounded-l' : '' }} {{ $loop->last ? 'rounded-r' : '' }}"
                                style="width: {{ $percentage }}%; background-color: {{ ['porn' => '#EF4444', 'hate_speech' => '#F59E0B', 'propaganda' => '#3B82F6', 'scam' => '#10B981', 'other' => '#6B7280'][$category] }}"
                            ></div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-sm">
                        @foreach($categoryStats as $category => $percentage)
                            <div class="flex items-center">
                                <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ ['porn' => '#EF4444', 'hate_speech' => '#F59E0B', 'propaganda' => '#3B82F6', 'scam' => '#10B981', 'other' => '#6B7280'][$category] }}"></span>
                                <span class="capitalize">{{ str_replace('_', ' ', $category) }}: {{ $percentage }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Block an Account</h2>
                <form action="{{ route('block.store') }}" method="POST" class="space-y-4 max-w-md">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="twitter_account_id" class="block text-sm font-medium text-gray-700">Twitter Account ID</label>
                        <input type="text" name="twitter_account_id" id="twitter_account_id" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" id="category" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select a category</option>
                            <option value="porn">Porn</option>
                            <option value="hate_speech">Hate Speech</option>
                            <option value="propaganda">Propaganda</option>
                            <option value="scam">Scam</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                        <textarea name="reason" id="reason" rows="3" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Block Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
