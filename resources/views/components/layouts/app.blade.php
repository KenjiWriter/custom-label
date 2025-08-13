<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Custom Label Creator') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased bg-orange-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-orange-200 sticky top-0 z-50">
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
                    @guest
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                            Zaloguj się
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
                            Zarejestruj się
                        </a>
                    @endguest
                    
                    @auth
                        <div x-data="{ open: false }" class="relative">
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
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-orange-200 py-1">
                                
                                <a href="{{ route('dashboard') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg mx-1" wire:navigate>
                                    Panel użytkownika
                                </a>
                                
                                <hr class="my-1 border-orange-200">
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 mx-1 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                                        Wyloguj się
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    <!-- Mobile menu button -->
                    <button x-data @click="$store.mobileMenu.toggle()" 
                            class="md:hidden p-2 rounded-xl text-gray-700 hover:bg-orange-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-data x-show="$store.mobileMenu.isOpen" 
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
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="{{ $containerClass ?? 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8' }}">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-orange-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Custom Labels</h3>
                    </div>
                    <p class="text-gray-600 mb-4 max-w-md">
                        Tworzymy spersonalizowane etykiety najwyższej jakości. 
                        Zaprojektuj swoją idealną etykietę w kilku prostych krokach.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-orange-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Szybkie linki</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-orange-600">Kreator etykiet</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-600">Galeria projektów</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-600">Cennik</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-600">FAQ</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Wsparcie</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-orange-600">Pomoc</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-600">Kontakt</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-600">Regulamin</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-orange-600">Polityka prywatności</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-orange-200 mt-8 pt-8 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} Custom Labels. Wszystkie prawa zastrzeżone.
                </p>
                <div class="mt-4 sm:mt-0 flex space-x-6">
                    <span class="text-gray-500 text-sm">Akceptujemy:</span>
                    <div class="flex space-x-2">
                        <div class="w-8 h-5 bg-orange-600 rounded text-white text-xs flex items-center justify-center font-bold">VISA</div>
                        <div class="w-8 h-5 bg-red-600 rounded text-white text-xs flex items-center justify-center font-bold">MC</div>
                        <div class="w-8 h-5 bg-yellow-500 rounded text-white text-xs flex items-center justify-center font-bold">PP</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
    
    <!-- Alpine.js with store for mobile menu -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('mobileMenu', {
                isOpen: false,
                toggle() {
                    this.isOpen = !this.isOpen;
                },
                close() {
                    this.isOpen = false;
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>