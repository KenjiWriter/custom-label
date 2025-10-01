<!-- Navigation -->
<nav class="bg-white shadow-sm border-b border-orange-200 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3" wire:navigate>
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-gray-900">
                        Custom Labels
                    </h1>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-orange-600 border-b-2 border-orange-600' : '' }}">
                    Kreator
                </a>
                <a href="#"
                   class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                    Galeria
                </a>
                <a href="#"
                   class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                    O nas
                </a>
                <a href="#"
                   class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                    Kontakt
                </a>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <div x-data="{ 
                        open: false, 
                        showSettings: false, 
                        showHistory: false, 
                        showProjects: false, 
                        showHelp: false 
                    }" class="relative">
                        <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                <span class="text-orange-600 font-semibold text-xs">
                                    {{ substr(auth()->user()->name ?? 'U', 0, 2) }}
                                </span>
                            </div>
                            <span class="hidden sm:block">{{ auth()->user()->name ?? 'User' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 top-full mt-1 w-56 bg-white rounded-xl shadow-lg border border-orange-200 py-2 z-50">

                            <!-- User Info -->
                            <div class="px-4 py-2 border-b border-orange-100">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <button @click="showSettings = true; open = false"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Ustawienia
                                </button>

                                <button @click="showHistory = true; open = false"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Historia
                                </button>

                                <button @click="showProjects = true; open = false"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Moje projekty
                                </button>

                                <button @click="showHelp = true; open = false"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pomoc
                                </button>
                            </div>

                            <hr class="my-1 border-orange-100">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Wyloguj się
                                </button>
                            </form>
                        </div>

                        <!-- Settings Popup -->
                        <div x-show="showSettings" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" @click="showSettings = false">
                            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4" @click.stop>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Ustawienia</h3>
                                        <button @click="showSettings = false" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-900">Profil</span>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-900">Hasło</span>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-6H4v6zM4 5h6V1H4v4zM15 1h5v6h-5V1z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-900">Wygląd</span>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- History Popup -->
                        <div x-show="showHistory" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" @click="showHistory = false">
                            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4" @click.stop>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Historia</h3>
                                        <button @click="showHistory = false" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">Ostatnie logowanie</p>
                                                <p class="text-xs text-gray-500">Dzisiaj, 14:30</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">Utworzono projekt</p>
                                                <p class="text-xs text-gray-500">Wczoraj, 16:45</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">Zaktualizowano profil</p>
                                                <p class="text-xs text-gray-500">2 dni temu</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Projects Popup -->
                        <div x-show="showProjects" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" @click="showProjects = false">
                            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4" @click.stop>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Moje projekty</h3>
                                        <button @click="showProjects = false" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Etykiety na wino</p>
                                                    <p class="text-xs text-gray-500">Ostatnio edytowane: 2 godziny temu</p>
                                                </div>
                                            </div>
                                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Aktywny</span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Naklejki na słoiki</p>
                                                    <p class="text-xs text-gray-500">Ostatnio edytowane: 1 dzień temu</p>
                                                </div>
                                            </div>
                                            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">W toku</span>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg text-sm font-medium transition-colors">
                                            + Nowy projekt
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Help Popup -->
                        <div x-show="showHelp" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" @click="showHelp = false">
                            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4" @click.stop>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">Pomoc</h3>
                                        <button @click="showHelp = false" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center p-3 bg-orange-50 rounded-lg hover:bg-orange-100 cursor-pointer transition-colors">
                                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">Jak rozpocząć?</span>
                                        </div>
                                        <div class="flex items-center p-3 bg-orange-50 rounded-lg hover:bg-orange-100 cursor-pointer transition-colors">
                                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">Przewodnik użytkownika</span>
                                        </div>
                                        <div class="flex items-center p-3 bg-orange-50 rounded-lg hover:bg-orange-100 cursor-pointer transition-colors">
                                            <svg class="w-5 h-5 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900">Kontakt z pomocą</span>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <div class="text-center">
                                            <p class="text-sm text-gray-600 mb-2">Potrzebujesz pomocy?</p>
                                            <button class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-lg text-sm font-medium transition-colors">
                                                Napisz do nas
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @unless(request()->routeIs('login') || request()->routeIs('register'))
                        <a href="{{ route('login') }}"
                           class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                            Zaloguj się
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
                            Zarejestruj się
                        </a>
                    @endunless
                @endauth

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 rounded-xl text-gray-700 hover:bg-orange-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="md:hidden border-t border-orange-200 bg-white">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}"
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-xl {{ request()->routeIs('home') ? 'text-orange-600 bg-orange-50' : '' }}">
                Kreator
            </a>
            <a href="#"
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-xl">
                Galeria
            </a>
            <a href="#"
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-xl">
                O nas
            </a>
            <a href="#"
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-xl">
                Kontakt
            </a>
            
            @guest
                @unless(request()->routeIs('login') || request()->routeIs('register'))
                    <hr class="my-2 border-orange-200">
                    <a href="{{ route('login') }}"
                       class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-xl">
                        Zaloguj się
                    </a>
                    <a href="{{ route('register') }}"
                       class="block px-3 py-2 text-base font-medium text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-xl">
                        Zarejestruj się
                    </a>
                @endunless
            @endguest
        </div>
    </div>
</nav>
