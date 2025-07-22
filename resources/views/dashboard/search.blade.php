<x-app-layout>
    @section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-900">Search Results</h2>
                <a href="{{ route('dashboard.home') }}" class="text-indigo-600 hover:text-indigo-900">Back to Dashboard</a>
            </div>

            <!-- Search Box -->
            <div class="mt-6">
                <form action="{{ route('dashboard.search') }}" method="GET" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="q" value="{{ $query }}" placeholder="Search for X accounts..." 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Search
                    </button>
                </form>
            </div>

            <!-- Results -->
            <div class="mt-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        @forelse($results as $result)
                        <li class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">@{{ $result->username }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Category: {{ ucfirst($result->category) }}
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">
                                        Blocked {{ $result->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <form action="{{ route('dashboard.unblock', $result->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                            Unblock
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="px-4 py-4 sm:px-6">
                            <p class="text-sm text-gray-500">No results found for "{{ $query }}"</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
