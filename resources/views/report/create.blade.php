<x-app-layout>
    @section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-semibold mb-6">Report an Account</h1>

            <form action="{{ route('report.store') }}" method="POST" class="space-y-4 max-w-md">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="twitter_account_id" class="block text-sm font-medium text-gray-700">Twitter Account ID</label>
                    <input type="text" name="twitter_account_id" id="twitter_account_id" value="{{ old('twitter_account_id') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select a category</option>
                        <option value="porn" {{ old('category') == 'porn' ? 'selected' : '' }}>Porn</option>
                        <option value="hate_speech" {{ old('category') == 'hate_speech' ? 'selected' : '' }}>Hate Speech</option>
                        <option value="propaganda" {{ old('category') == 'propaganda' ? 'selected' : '' }}>Propaganda</option>
                        <option value="scam" {{ old('category') == 'scam' ? 'selected' : '' }}>Scam</option>
                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div>
                    <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
                    <textarea name="details" id="details" rows="4" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('details') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Please provide specific details about why this account should be reported.</p>
                </div>

                <div>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
