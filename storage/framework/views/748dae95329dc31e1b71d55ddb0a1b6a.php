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
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>"
                       class="text-gray-700 hover:text-orange-600 px-3 py-2 text-sm font-medium transition-colors">
                        Zaloguj się
                    </a>
                    <a href="<?php echo e(route('register')); ?>"
                       class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
                        Zarejestruj się
                    </a>
                <?php endif; ?>

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
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-orange-200 py-1">

                            <a href="<?php echo e(route('dashboard')); ?>"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 rounded-lg mx-1" wire:navigate>
                                Panel użytkownika
                            </a>

                            <hr class="my-1 border-orange-200">

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="block w-full text-left px-4 py-2 mx-1 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                                    Wyloguj się
                                </button>
                            </form>
                        </div>
                    </div>
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
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/components/layouts/header.blade.php ENDPATH**/ ?>