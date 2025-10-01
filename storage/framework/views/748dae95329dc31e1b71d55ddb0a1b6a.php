<!-- Navigation -->
<nav class="bg-white shadow-sm border-b border-orange-200 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-3" wire:navigate>
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
                   class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors <?php echo e(request()->routeIs('home') ? 'text-orange-600 border-b-2 border-orange-600' : ''); ?>">
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
                <?php if(auth()->guard()->check()): ?>
                    <div x-data="{ open: false }" class="relative">
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
                             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-orange-200 py-2">

                            <!-- User Info -->
                            <div class="px-4 py-2 border-b border-orange-100">
                                <p class="text-sm font-medium text-gray-900"><?php echo e(auth()->user()->name ?? 'User'); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e(auth()->user()->email ?? 'user@example.com'); ?></p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <a href="<?php echo e(route('dashboard')); ?>"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors" wire:navigate>
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                    </svg>
                                    Dashboard
                                </a>

                                <a href="#"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Ustawienia
                                </a>

                                <a href="#"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Historia
                                </a>

                                <a href="#"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Moje projekty
                                </a>

                                <a href="#"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pomoc
                                </a>
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
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/components/layouts/header.blade.php ENDPATH**/ ?>