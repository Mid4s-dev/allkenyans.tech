<x-app-layout>
    @section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-900">Watch List</h2>
                <x-dark-mode-toggle class="ml-4" />
            </div>

            <div class="mt-6">
                <x-watch-list :accounts="$accounts" />
            </div>

            <div class="mt-4">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
