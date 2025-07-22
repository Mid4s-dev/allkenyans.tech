<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Project Info -->
            <div class="col-span-2">
                <h3 class="text-base font-semibold text-gray-900">About AllKenyans.tech</h3>
                <p class="mt-4 text-sm text-gray-600">
                    A community-driven initiative to make X (formerly Twitter) a safer space for Kenyans by identifying and blocking harmful accounts.
                </p>
                <div class="mt-4">
                    <a href="https://github.com/sponsor/" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        Donate to this Project
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-base font-semibold text-gray-900">Quick Links</h3>
                <ul class="mt-4 flex space-x-6">
                    <li>
                        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Home
                        </a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ route('dashboard.home') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.create') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Report Account
                        </a>
                    </li>
                    @endauth
                    <li>
                        <a href="https://github/allkenyans.tech" class="text-sm text-gray-600 hover:text-gray-900">
                            View on GitHub
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Social Links -->
            <div>
                <h3 class="text-base font-semibold text-gray-900">Connect With Us</h3>
                <ul class="mt-4 flex space-x-6">
                    <li>
                        <a href="https://twitter.com/allkenyans_tech" class="group text-sm text-gray-600 hover:text-gray-900 flex items-center transition-colors duration-150">
                            <span class="inline-flex items-center justify-center w-8 h-8 mr-2 rounded-full bg-gray-50 group-hover:bg-gray-100">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </span>
                            Twitter
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/Mid4s-dev/allkenyans.tech" class="group text-sm text-gray-600 hover:text-gray-900 flex items-center transition-colors duration-150">
                            <span class="inline-flex items-center justify-center w-8 h-8 mr-2 rounded-full bg-gray-50 group-hover:bg-gray-100">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                                </svg>
                            </span>
                            GitHub
                        </a>
                    </li>
                    <li>
                        <a href="mailto:contact@allkenyans.tech" class="group text-sm text-gray-600 hover:text-gray-900 flex items-center transition-colors duration-150">
                            <span class="inline-flex items-center justify-center w-8 h-8 mr-2 rounded-full bg-gray-50 group-hover:bg-gray-100">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-200">
            <p class="text-sm text-gray-400 text-center">
                © {{ date('Y') }} AllKenyans.tech. All rights reserved.
            </p>
        </div>
    </div>
</footer>
