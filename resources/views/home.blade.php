<x-app-layout>
    <div class="relative bg-white">
        <!-- Hero section -->
        <div class="py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">All Kenyans Tech</span>
                        <span class="block text-indigo-600">X Account Safety Database</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Helping keep the Kenyan X community safe by tracking and reporting harmful accounts. Join our effort to create a safer social media environment.
                    </p>
                    @guest
                        <div class="mt-5 max-w-md mx-auto flex justify-center md:mt-8">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:text-lg">
                                Join the Community
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
            
        <!-- Stats section -->
        <div class="bg-gray-50 pt-12 sm:pt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Community Impact Statistics
                    </h2>
                    <p class="mt-3 text-xl text-gray-500 sm:text-2xl">
                        Together we're making a difference
                    </p>
                </div>
            </div>
            <div class="mt-10 pb-12 sm:pb-16">
                <div class="relative">
                    <div class="absolute inset-0 h-1/2 bg-gray-50"></div>
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-4xl mx-auto">
                            <div class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                                <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                        Accounts Blocked
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                        {{ $stats['total_blocked'] ?? 0 }}
                                    </dd>
                                </div>
                                <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                        Total Reports
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                        {{ $stats['total_reports'] ?? 0 }}
                                    </dd>
                                </div>
                                <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                        Active Reports
                                    </dt>
                                    <dd class="order-1 text-5xl font-extrabold text-indigo-600">
                                        {{ $stats['active_reports'] ?? 0 }}
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent blocks section -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Recent Blocked Accounts
                    </h2>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        Latest accounts blocked for violating community guidelines
                    </p>
                </div>

                <div class="mt-10">
                    <div class="space-y-4">
                        @forelse($recentlyBlocked ?? [] as $account)
                            <div class="bg-gray-50 rounded-lg p-4 shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            {{ $account->username }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Blocked {{ $account->last_blocked_at?->diffForHumans() ?? 'recently' }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        {{ $account->current_report_category }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">No recently blocked accounts</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Management section -->
        @auth
            <div class="py-12 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Category Distribution -->
                    <div class="mb-12">
                        <h2 class="text-xl font-semibold mb-4 text-gray-900">Category Distribution</h2>
                        <div class="bg-white rounded-lg p-4 shadow">
                            <div class="flex h-4 mb-2">
                                @foreach($categoryStats ?? [] as $category => $percentage)
                                    <div
                                        class="h-full {{ $loop->first ? 'rounded-l' : '' }} {{ $loop->last ? 'rounded-r' : '' }}"
                                        style="width: {{ $percentage }}%; background-color: {{ ['porn' => '#EF4444', 'hate_speech' => '#F59E0B', 'propaganda' => '#3B82F6', 'scam' => '#10B981', 'other' => '#6B7280'][$category] }}"
                                    ></div>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-2 text-sm">
                                @foreach($categoryStats ?? [] as $category => $percentage)
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 rounded-full mr-2" style="background-color: {{ ['porn' => '#EF4444', 'hate_speech' => '#F59E0B', 'propaganda' => '#3B82F6', 'scam' => '#10B981', 'other' => '#6B7280'][$category] }}"></span>
                                        <span class="capitalize text-gray-700">{{ str_replace('_', ' ', $category) }}: {{ $percentage }}%</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Block Account Form -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4 text-gray-900">Block an Account</h2>
                        <form action="{{ route('block.store') }}" method="POST" class="space-y-4 max-w-md bg-white rounded-lg p-6 shadow">
                            @csrf
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="username" id="username" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="x_account_id" class="block text-sm font-medium text-gray-700">X Account ID</label>
                                <input type="text" name="x_account_id" id="x_account_id" required
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
        @endauth

        <!-- CTA section -->
        @guest
            <div class="bg-indigo-50">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        <span class="block">Ready to join our mission?</span>
                        <span class="block text-indigo-600">Help us keep the community safe.</span>
                    </h2>
                    <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Get started
                            </a>
                        </div>
                        <div class="ml-3 inline-flex rounded-md shadow">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                                Sign in
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</x-app-layout>
