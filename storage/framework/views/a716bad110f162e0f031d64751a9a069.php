
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? config('app.name', 'Custom Label Creator')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-3" wire:navigate>
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
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
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors <?php echo e(request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : ''); ?>">
                        Kreator
                    </a>
                    <a href="#" 
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                        Galeria
                    </a>
                    <a href="#" 
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                        O nas
                    </a>
                    <a href="#" 
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                        Kontakt
                    </a>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" 
                           class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                            Zaloguj się
                        </a>
                        <a href="<?php echo e(route('register')); ?>" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Zarejestruj się
                        </a>
                    <?php endif; ?>
                    
                    <?php if(auth()->guard()->check()): ?>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600 font-semibold text-xs">
                                        <?php echo e(substr(auth()->user()->name, 0, 2)); ?>

                                    </span>
                                </div>
                                <span class="hidden sm:block"><?php echo e(auth()->user()->name); ?></span>
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
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1">
                                
                                <a href="<?php echo e(route('dashboard')); ?>" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" wire:navigate>
                                    Panel użytkownika
                                </a>
                                
                                <hr class="my-1">
                                
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                        Wyloguj się
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Mobile menu button -->
                    <button x-data @click="$store.mobileMenu.toggle()" 
                            class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100">
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
             class="md:hidden border-t border-gray-200 bg-white">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="<?php echo e(route('home')); ?>" 
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg <?php echo e(request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : ''); ?>">
                    Kreator
                </a>
                <a href="#" 
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg">
                    Galeria
                </a>
                <a href="#" 
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg">
                    O nas
                </a>
                <a href="#" 
                   class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg">
                    Kontakt
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="<?php echo e($containerClass ?? 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8'); ?>">
        <?php echo e($slot); ?>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
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
                        <a href="#" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.332 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Szybkie linki</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-gray-600 hover:text-gray-900">Kreator etykiet</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Galeria projektów</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Cennik</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">FAQ</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Wsparcie</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Pomoc</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Kontakt</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Regulamin</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-900">Polityka prywatności</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-8 pt-8 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    © <?php echo e(date('Y')); ?> Custom Labels. Wszystkie prawa zastrzeżone.
                </p>
                <div class="mt-4 sm:mt-0 flex space-x-6">
                    <span class="text-gray-500 text-sm">Akceptujemy:</span>
                    <div class="flex space-x-2">
                        <div class="w-8 h-5 bg-blue-600 rounded text-white text-xs flex items-center justify-center font-bold">VISA</div>
                        <div class="w-8 h-5 bg-red-600 rounded text-white text-xs flex items-center justify-center font-bold">MC</div>
                        <div class="w-8 h-5 bg-yellow-500 rounded text-white text-xs flex items-center justify-center font-bold">PP</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    
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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\dev\custom-label\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>