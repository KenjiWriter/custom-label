<!-- Navigation -->
<nav class="bg-white shadow-sm border-b border-orange-200 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }" x-init="mobileMenuOpen = false" x-cloak>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-3" onclick="window.ThemeManager && window.ThemeManager.init()">
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
                <a href="<?php echo e(route('home')); ?>"
                   class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors <?php echo e(request()->routeIs('home') ? 'text-orange-600 border-b-2 border-orange-600' : ''); ?>"
                   onclick="window.ThemeManager && window.ThemeManager.init()">
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

            <!-- Darkness Slider and Language Selector -->
            <div class="flex items-center space-x-3">
                <!-- Language Selector -->
                <div x-data="{ open: false }" x-init="open = false" x-cloak class="relative">
                    <button @click="open = !open" 
                            class="flex items-center space-x-1 text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        <span class="hidden sm:block">PL</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                         class="absolute right-0 top-full mt-1 w-32 bg-white rounded-lg shadow-lg border border-orange-200 py-1 z-50">
                        <button @click="changeLanguage('pl'); open = false" 
                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                            🇵🇱 Polski
                        </button>
                        <button @click="changeLanguage('en'); open = false" 
                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                            🇬🇧 English
                        </button>
                        <button @click="changeLanguage('de'); open = false" 
                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                            🇩🇪 Deutsch
                        </button>
                    </div>
                </div>
                
                <!-- Darkness Slider -->
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                    <input type="range" 
                           id="headerDarknessSlider" 
                           min="0" 
                           max="100" 
                           value="0"
                           class="w-20 h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
                    <span id="headerDarknessValue" class="text-xs text-gray-600 font-medium min-w-[30px]">0%</span>
                </div>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                <?php if(auth()->guard()->check()): ?>
                    <div x-data="{ 
                        open: false, 
                        showHistory: false, 
                        showProjects: false, 
                        showHelp: false 
                    }" 
                    x-init="open = false; showHistory = false; showProjects = false; showHelp = false"
                    x-cloak
                    class="relative">
                        <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                <span class="text-orange-600 font-semibold text-xs">
                                    <?php echo e(substr(auth()->user()->name ?? 'U', 0, 2)); ?>

                                </span>
                            </div>
                            <span class="hidden sm:block"><?php echo e(auth()->user()->name ?? 'User'); ?></span>
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
                                <p class="text-sm font-medium text-gray-900"><?php echo e(auth()->user()->name ?? 'User'); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e(auth()->user()->email ?? 'user@example.com'); ?></p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <a href="<?php echo e(route('settings.profile')); ?>"
                                        class="flex items-center w-full px-4 py-2 text-sm text-orange-600 bg-orange-50 hover:bg-orange-100 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Ustawienia
                                </a>

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

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Wyloguj się
                                </button>
                            </form>
                        </div>


                        <!-- History Popup -->
                        <div x-show="showHistory" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-4" @click="showHistory = false" @close-history.window="showHistory = false">
                            <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden" @click.stop>
                                <div class="p-6">
                                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('history-popup', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-422244409-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                </div>
                            </div>
                        </div>

                        <!-- Projects Popup -->
                        <div x-show="showProjects" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-4" @click="showProjects = false" @close-projects.window="showProjects = false">
                            <div class="bg-white rounded-xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden" @click.stop>
                                <div class="p-6">
                                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('projects-popup', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-422244409-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                </div>
                            </div>
                        </div>

                        <!-- Help Popup -->
                        <div x-show="showHelp" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-4" @click="showHelp = false">
                            <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden" @click.stop>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <h3 class="text-xl font-semibold text-gray-900">Centrum Pomocy</h3>
                                        <button @click="showHelp = false" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Quick Help Section -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                        <a href="https://customlabels.pl/przewodnik" target="_blank" class="bg-white rounded-xl p-4 border border-gray-200 hover:shadow-lg transition-all duration-200 cursor-pointer block">
                                            <div class="flex items-center mb-3">
                                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                </div>
                                                <h4 class="font-semibold text-gray-900">Szybki Start</h4>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-3">Poznaj podstawy tworzenia etykiet w 5 minut</p>
                                            <span class="text-orange-600 hover:text-orange-700 text-sm font-medium">Rozpocznij →</span>
                                        </a>

                                        <a href="https://customlabels.pl/przewodnik" target="_blank" class="bg-white rounded-xl p-4 border border-gray-200 hover:shadow-lg transition-all duration-200 cursor-pointer block">
                                            <div class="flex items-center mb-3">
                                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                <h4 class="font-semibold text-gray-900">Przewodnik</h4>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-3">Kompletny przewodnik użytkownika</p>
                                            <span class="text-blue-600 hover:text-blue-700 text-sm font-medium">Czytaj →</span>
                                        </a>
                                    </div>

                                    <!-- FAQ Section -->
                                    <div class="mb-6" x-data="{ openFAQ: null }">
                                        <h4 class="font-semibold text-gray-900 mb-4">Często zadawane pytania</h4>
                                        <div class="space-y-3 max-h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                                            <div class="bg-gray-50 rounded-lg transition-colors" :class="openFAQ === 1 ? 'bg-gray-100' : 'hover:bg-gray-100'">
                                                <button @click="openFAQ = openFAQ === 1 ? null : 1" class="w-full p-4 text-left">
                                                    <div class="flex items-center justify-between">
                                                        <h5 class="font-medium text-gray-900 text-sm">Jak dodać własne zdjęcie do etykiety?</h5>
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" :class="openFAQ === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <div x-show="openFAQ === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="px-4 pb-4">
                                                    <p class="text-sm text-gray-600">Aby dodać własne zdjęcie do etykiety, kliknij przycisk "Dodaj obraz" w kreatorze, wybierz plik z komputera (JPG, PNG, GIF) i dostosuj rozmiar oraz pozycję na etykiecie.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-gray-50 rounded-lg transition-colors" :class="openFAQ === 2 ? 'bg-gray-100' : 'hover:bg-gray-100'">
                                                <button @click="openFAQ = openFAQ === 2 ? null : 2" class="w-full p-4 text-left">
                                                    <div class="flex items-center justify-between">
                                                        <h5 class="font-medium text-gray-900 text-sm">Jakie formaty plików są obsługiwane?</h5>
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" :class="openFAQ === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <div x-show="openFAQ === 2" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="px-4 pb-4">
                                                    <p class="text-sm text-gray-600">Obsługujemy formaty: JPG, JPEG, PNG, GIF (maksymalnie 2MB). Zalecamy obrazy w wysokiej rozdzielczości dla najlepszej jakości druku.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-gray-50 rounded-lg transition-colors" :class="openFAQ === 3 ? 'bg-gray-100' : 'hover:bg-gray-100'">
                                                <button @click="openFAQ = openFAQ === 3 ? null : 3" class="w-full p-4 text-left">
                                                    <div class="flex items-center justify-between">
                                                        <h5 class="font-medium text-gray-900 text-sm">Jak zapisać projekt i wrócić do niego później?</h5>
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" :class="openFAQ === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <div x-show="openFAQ === 3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="px-4 pb-4">
                                                    <p class="text-sm text-gray-600">Projekty są automatycznie zapisywane podczas pracy. Możesz je znaleźć w sekcji "Moje projekty" w menu użytkownika i kontynuować edycję w dowolnym momencie.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-gray-50 rounded-lg transition-colors" :class="openFAQ === 4 ? 'bg-gray-100' : 'hover:bg-gray-100'">
                                                <button @click="openFAQ = openFAQ === 4 ? null : 4" class="w-full p-4 text-left">
                                                    <div class="flex items-center justify-between">
                                                        <h5 class="font-medium text-gray-900 text-sm">Jak zmienić rozmiar etykiety?</h5>
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" :class="openFAQ === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <div x-show="openFAQ === 4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="px-4 pb-4">
                                                    <p class="text-sm text-gray-600">W kreatorze wybierz "Ustawienia" → "Rozmiar etykiety" i wybierz z gotowych szablonów lub wprowadź własne wymiary w milimetrach.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-gray-50 rounded-lg transition-colors" :class="openFAQ === 5 ? 'bg-gray-100' : 'hover:bg-gray-100'">
                                                <button @click="openFAQ = openFAQ === 5 ? null : 5" class="w-full p-4 text-left">
                                                    <div class="flex items-center justify-between">
                                                        <h5 class="font-medium text-gray-900 text-sm">Jak dodać tekst do etykiety?</h5>
                                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" :class="openFAQ === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </button>
                                                <div x-show="openFAQ === 5" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="px-4 pb-4">
                                                    <p class="text-sm text-gray-600">Kliknij "Dodaj tekst" w kreatorze, wpisz treść, wybierz czcionkę, rozmiar i kolor. Możesz przeciągnąć tekst w dowolne miejsce na etykiecie.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact Section -->
                                    <div class="bg-orange-500 rounded-xl p-6 text-white">
                                        <div class="flex items-center mb-4">
                                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-lg">Potrzebujesz pomocy?</h4>
                                                <p class="text-orange-100">Jesteśmy tutaj, aby Ci pomóc!</p>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-orange-100 mb-2">📧 kontakt@customlabels.pl</p>
                                            <p class="text-orange-100 mb-4">🌐 customlabels.pl/kontakt</p>
                                            <a href="https://customlabels.pl/kontakt" target="_blank" class="bg-white text-orange-600 hover:bg-orange-50 px-6 py-2 rounded-lg font-medium transition-colors inline-block">
                                                Przejdź do strony kontaktowej
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if (! (request()->routeIs('login') || request()->routeIs('register'))): ?>
                        <a href="<?php echo e(route('login')); ?>"
                           class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                            Zaloguj się
                        </a>
                        <a href="<?php echo e(route('register')); ?>"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
                            Zarejestruj się
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

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
            <a href="<?php echo e(route('home')); ?>"
               class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-xl <?php echo e(request()->routeIs('home') ? 'text-orange-600 bg-orange-50' : ''); ?>">
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
            
            <?php if(auth()->guard()->guest()): ?>
                <?php if (! (request()->routeIs('login') || request()->routeIs('register'))): ?>
                    <hr class="my-2 border-orange-200">
                    <a href="<?php echo e(route('login')); ?>"
                       class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50 rounded-xl">
                        Zaloguj się
                    </a>
                    <a href="<?php echo e(route('register')); ?>"
                       class="block px-3 py-2 text-base font-medium text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-xl">
                        Zarejestruj się
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Header Slider Styles -->
<style>
    .slider {
        -webkit-appearance: none;
        appearance: none;
        background: linear-gradient(to right, #ffffff, #000000);
        outline: none;
        border-radius: 5px;
    }
    
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #f97316;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .slider::-moz-range-thumb {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #f97316;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- Header JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Header darkness slider
        const headerSlider = document.getElementById('headerDarknessSlider');
        const headerValue = document.getElementById('headerDarknessValue');
        
        if (headerSlider && headerValue) {
            // Load saved darkness level
            const savedDarkness = localStorage.getItem('darknessLevel') || '0';
            headerSlider.value = savedDarkness;
            headerValue.textContent = savedDarkness + '%';
            
            // Update darkness when slider changes
            headerSlider.addEventListener('input', function() {
                const darkness = this.value;
                document.documentElement.style.setProperty('--darkness-level', darkness);
                headerValue.textContent = darkness + '%';
                localStorage.setItem('darknessLevel', darkness);
            });
        }
        
        // Language change function
        window.changeLanguage = function(language) {
            document.documentElement.lang = language;
            localStorage.setItem('language', language);
            console.log('Język zmieniony na:', language);
        };
        
        // Load saved language
        const savedLanguage = localStorage.getItem('language') || 'pl';
        document.documentElement.lang = savedLanguage;
    });
</script>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/components/layouts/header.blade.php ENDPATH**/ ?>