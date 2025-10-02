<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Custom Labels - Twórz własne etykiety w kilka krokach']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Custom Labels - Twórz własne etykiety w kilka krokach']); ?>
    <?php $__env->startPush('styles'); ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/home.css']); ?>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/home.js']); ?>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/home.js']); ?>
        <script>
            // Initialize theme system on home page
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize theme system
                if (window.ThemeManager) {
                    window.ThemeManager.init();
                }
            });
            
            // Also initialize when Livewire navigates
            document.addEventListener('livewire:navigated', function() {
                if (window.ThemeManager) {
                    window.ThemeManager.init();
                }
            });
            
            // Enhanced smooth scrolling with offset for fixed header
            document.addEventListener('DOMContentLoaded', function() {
                const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');

                smoothScrollLinks.forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();

                        const targetId = this.getAttribute('href');
                        if (targetId === '#') return;

                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            // Calculate header height for offset
                            const headerHeight = document.querySelector('header')?.offsetHeight || 0;
                            const targetPosition = targetElement.getBoundingClientRect().top + window
                                .pageYOffset - headerHeight - 20;

                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });

                            // Update URL without scroll
                            history.pushState(null, null, targetId);
                        }
                    });
                });
            });
        </script>
    <?php $__env->stopPush(); ?>



    <!-- Enhanced Hero Section with animated gradient -->
    <div
        class="bg-gradient-to-r from-orange-500 via-orange-400 to-orange-600 py-20 px-4 relative overflow-hidden animate-gradient-x">
        <!-- Improved animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute w-64 h-64 bg-orange-400 opacity-20 rounded-full -top-12 -left-12 animate-pulse"></div>
            <div class="absolute w-96 h-96 bg-orange-300 opacity-20 rounded-full top-1/2 -right-20 animate-pulse"
                style="animation-delay: 1s"></div>
            <div class="absolute w-48 h-48 bg-yellow-300 opacity-20 rounded-full bottom-10 left-1/4 animate-pulse"
                style="animation-delay: 2s"></div>
            <!-- Nowe elementy dekoracyjne -->
            <div class="absolute w-24 h-24 bg-white opacity-10 rounded-full top-1/3 left-2/3 animate-ping"
                style="animation-duration: 4s; animation-delay: 0.5s"></div>
            <div class="absolute w-32 h-32 bg-yellow-200 opacity-20 rounded-full top-1/4 right-1/3 animate-ping"
                style="animation-duration: 6s; animation-delay: 1.5s"></div>
            <div class="absolute w-16 h-16 bg-orange-200 opacity-30 rounded-full bottom-1/3 right-1/4 animate-bounce"
                style="animation-duration: 3s;"></div>
            <div class="absolute w-64 h-64 bg-gradient-to-r from-red-300 to-orange-300 opacity-10 rounded-full -bottom-32 -right-20 animate-pulse"
                style="animation-duration: 8s;"></div>
            <!-- Dodatkowe nowe efekty -->
            <div class="absolute w-32 h-32 bg-yellow-200 opacity-20 rounded-full top-1/4 right-1/3 animate-ping"
                style="animation-duration: 6s; animation-delay: 1.5s"></div>
            <div class="absolute w-40 h-40 bg-red-200 opacity-10 rounded-full top-1/2 left-1/3 floating-effect"
                style="animation-delay: 0.8s"></div>
            <div class="absolute w-28 h-28 bg-gradient-to-br from-yellow-300 to-orange-300 opacity-15 rounded-full bottom-1/4 left-1/2 animate-pulse"
                style="animation-duration: 10s;"></div>
        </div>

        <div class="max-w-5xl mx-auto text-center text-white relative z-10">
            <!-- Enhanced heading with text shadow -->
            <h1 class="text-4xl md:text-6xl font-bold mb-8 leading-tight drop-shadow-lg">
                Zaprojektuj <span
                    class="text-orange-600 inline-block transform hover:scale-105 transition-transform duration-300">Wymarzoną
                    Etykietę</span><br>w Kilka Minut!
            </h1>
            <p class="text-xl md:text-2xl mb-12 max-w-2xl mx-auto font-light">
                Dołącz do ponad <span class="font-semibold">50,000+ firm</span>, które zaufały naszej platformie do
                tworzenia profesjonalnych etykiet
            </p>

            <!-- Enhanced buttons with improved hover effects -->
            <div class="flex flex-wrap justify-center gap-6 mb-14">
                <a href="#label-creator"
                    class="bg-white text-orange-600 px-8 py-4 rounded-lg font-medium flex items-center transform transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-orange-700/30">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                        </path>
                    </svg>
                    Rozpocznij Projektowanie
                </a>
                <a href="#"
                    class="bg-white text-orange-600 px-8 py-4 rounded-lg font-medium flex items-center transform transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-orange-700/30">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                    Porozmawiaj z ekspertem
                </a>
            </div>

            <!-- Enhanced trust indicators z efektem backdrop -->
            <div class="flex justify-center gap-8 mt-6 text-sm opacity-90">
                <div
                    class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm hover:bg-white/20 transition-all duration-300">
                    <svg class="w-4 h-4 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                        </path>
                    </svg>
                    Darmowe szablony
                </div>
                <div
                    class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm hover:bg-white/20 transition-all duration-300">
                    <svg class="w-4 h-4 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Wsparcie 24/7
                </div>
                <div
                    class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm hover:bg-white/20 transition-all duration-300">
                    <svg class="w-4 h-4 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                    Gwarancja Zwrotu
                </div>
            </div>
        </div>
    </div>

    <!-- Section Separator -->
    <div class="h-1 bg-gradient-to-r from-transparent via-orange-200 to-transparent my-16"></div>

    <!-- Enhanced Label Creator Section with animated elements and improved visual design -->


        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-14">
                <!-- Badge like other sections -->
                <span
                    class="inline-block px-4 py-1 rounded-full bg-orange-100 text-orange-600 text-sm font-medium mb-4 animate-pulse-slow">ZAPROJEKTUJ
                    TERAZ</span>

                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-5">
                    Kreator Etykiet <span
                        class="text-3xl md:text-4xl font-bold text-orange-600 to text-orange-700  mb-5">CustomLabels</span>
                </h2>

                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Skonfiguruj swoją etykietę krok po kroku.
                    Każda zmiana natychmiast wpływa na cenę i podgląd.
                    <span class="block mt-2 text-orange-500 font-medium">Rozpocznij poniżej!</span>
                </p>
            </div>

            <!-- Visual divider -->
            <div class="flex items-center justify-center mb-10">
                <div class="h-1 w-16 bg-gradient-to-r from-orange-300 to-orange-500 rounded-full"></div>
                <div class="mx-4">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                        </path>
                    </svg>
                </div>
                <div class="h-1 w-16 bg-gradient-to-r from-orange-500 to-orange-300 rounded-full"></div>
            </div>

            <!-- Creator container with enhanced styling -->
    
                <!-- Creator component -->
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('label-creator');

$__html = app('livewire')->mount($__name, $__params, 'lw-235481482-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                <!-- Trust indicators -->
                <div class="mt-10 pt-6 border-t border-gray-100">
                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                            Bezpieczne płatności
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Gwarancja satysfakcji
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Szybka realizacja zamówień
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Wsparcie 24/7
                        </div>
                    </div>
        </div>
    </div>

    <!-- Section Separator -->
    <div class="h-1 bg-gradient-to-r from-transparent via-orange-200 to-transparent my-16"></div>

            <!-- Enhanced Templates Section with more visual flair -->
             
            <div class="py-16 px-4 bg-gray-50">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-16">
                        <span
                            class="inline-block px-4 py-1 rounded-full bg-orange-100 text-orange-600 text-sm font-medium mb-3">GOTOWE KONFIGURACJE</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Wybierz gotową konfigurację</h2>
                        <p class="text-gray-600 text-lg max-w-3xl mx-auto">Kliknij na jedną z konfiguracji, a automatycznie ustawimy wszystko w kreatorze i przeniesiemy Cię do finalizacji</p>
                    </div>

                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Konfiguracja 1 - Fresh Organic -->
                        <div
                            class="parallax-card template-card bg-gradient-to-br from-red-900 to-red-900 text-white p-8 rounded-xl text-center shadow-xl transform transition-all duration-300 hover:scale-105 hover:-rotate-1 hover:shadow-2xl group cursor-pointer"
                            onclick="selectConfiguration('fresh-organic')">
                            <div class="font-bold text-lg mb-4 tracking-wide">FRESH ORGANIC</div>
                            <div class="text-5xl mb-6 ">✓</div>
                            <div class="text-sm opacity-90 font-medium">Food & Beverage</div>
                            <div class="text-xs opacity-75 mt-1">Perfect for natural products</div>
                            <div
                                class="mt-6 pt-4 border-t border-white/20 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div
                                    class="px-4 py-2 bg-white/20 rounded-lg text-sm hover:bg-white/30 transition-colors">
                                    Wybierz konfigurację
                                </div>
                            </div>
                        </div>

                        <!-- Konfiguracja 2 - Express Shipping -->
                        <div
                            class="parallax-card template-card bg-gradient-to-br from-blue-900 to-blue-900 text-white p-8 rounded-xl text-center shadow-xl transform transition-all duration-300 hover:scale-105 hover:-rotate-1 hover:shadow-2xl group cursor-pointer"
                            onclick="selectConfiguration('express-shipping')">
                            <div class="font-bold text-lg mb-4 tracking-wide">EXPRESS SHIPPING</div>
                            <div class="text-5xl mb-6 ">⛟</div>
                            <div class="text-sm opacity-90 font-medium">Shipping Labels</div>
                            <div class="text-xs opacity-75 mt-1">Waterproof & tear-resistant</div>
                            <div
                                class="mt-6 pt-4 border-t border-white/20 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div
                                    class="px-4 py-2 bg-white/20 rounded-lg text-sm hover:bg-white/30 transition-colors">
                                    Wybierz konfigurację
                                </div>
                            </div>
                        </div>

                        <!-- Konfiguracja 3 - Premium Quality -->
                        <div
                            class="parallax-card template-card bg-gradient-to-br from-purple-900 to-purple-900 text-white p-8 rounded-xl text-center shadow-xl transform transition-all duration-300 hover:scale-105 hover:-rotate-1 hover:shadow-2xl group cursor-pointer"
                            onclick="selectConfiguration('premium-quality')">
                            <div class="font-bold text-lg mb-4 tracking-wide">PREMIUM QUALITY</div>
                            <div class="text-xl mb-6 ">★★★★★</div>
                            <div class="text-sm opacity-90 font-medium">Luxury Brands</div>
                            <div class="text-xs opacity-75 mt-1">High-end metallic finish</div>
                            <div
                                class="mt-6 pt-4 border-t border-white/20 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div
                                    class="px-4 py-2 bg-white/20 rounded-lg text-sm hover:bg-white/30 transition-colors">
                                    Wybierz konfigurację
                                </div>
                            </div>
                        </div>

                        <!-- Konfiguracja 4 - Eco Friendly -->
                        <div
                            class="parallax-card template-card bg-gradient-to-br from-green-900 to-green-900 text-white p-8 rounded-xl text-center shadow-xl transform transition-all duration-300 hover:scale-105 hover:-rotate-1 hover:shadow-2xl group cursor-pointer"
                            onclick="selectConfiguration('eco-friendly')">
                            <div class="font-bold text-lg mb-4 tracking-wide">ECO FRIENDLY</div>
                            <div class="text-5xl mb-6 ">♼</div>
                            <div class="text-sm opacity-90 font-medium">Sustainable</div>
                            <div class="text-xs opacity-75 mt-1">Biodegradable materials</div>
                            <div
                                class="mt-6 pt-4 border-t border-white/20 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div
                                    class="px-4 py-2 bg-white/20 rounded-lg text-sm hover:bg-white/30 transition-colors">
                                    Wybierz konfigurację
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-14">
                        <p class="text-gray-600 text-sm">Kliknij na jedną z konfiguracji powyżej, aby automatycznie ustawić kreator i przejść do finalizacji</p>
                    </div>
                </div>
            </div>

    <!-- Section Separator -->
    <div class="h-1 bg-gradient-to-r from-transparent via-orange-200 to-transparent my-4"></div>

            <!-- Enhanced Why Choose Us Section with more visual appeal -->
            <div class="py-32 px-4 bg-white relative overflow-hidden" id="why-choose-us">
               

                <div class="max-w-6xl mx-auto relative z-10">
                    <div class="text-center mb-16">
                        <span
                            class="inline-block px-5 py-2 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mb-4">Dlaczego
                            My?</span>
                        <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-3">Dlaczego warto wybrać CustomLabels</h2>
                        <p class="text-gray-600 text-lg max-w-3xl mx-auto">Profesjonalne rozwiązania do tworzenia
                            etykiet z najlepszymi funkcjami w branży</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Enhanced Feature 1 with improved hover effect -->
                        <div
                            class="bg-white p-10 rounded-2xl shadow-xl border border-orange-600 text-center transform transition-all duration-500 hover:translate-y-[-8px] hover:shadow-2xl group">
                            <div
                                class="icon-wrapper bg-transparent w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:rotate-6 transition-transform duration-300">
                                <svg class="w-10 h-10 text-orange-500 transform transition-transform group-hover:scale-110 group-hover:rotate-3"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-2xl text-gray-800 mb-4">Projektowanie AI</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">Nasz zaawansowany silnik AI tworzy lepsze
                                etykiety w oparciu o Twoją branżę i preferencje, zwiększając skuteczność marketingową.
                            </p>
                            <a href="#"
                                class="text-orange-500 hover:text-orange-600 inline-flex items-center font-medium group-hover:underline">
                                Dowiedz się więcej
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Feature 2 -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg border border-orange-600 text-center transform transition hover:translate-y-[-5px] hover:shadow-xl">
                            <div
                                class="icon-wrapper bg-orange-100 w-16 h-16 rounded-lg flex items-center justify-center mx-auto mb-5">
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a1 1 0 01-1-1V9a1 1 0 011-1h1a2 2 0 100-4H4a1 1 0 01-1-1V4a1 1 0 011-1h3a1 1 0 011 1v1z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800 mb-3">Pełna Personalizacja</h3>
                            <p class="text-gray-600 mb-4">Pełna kontrola nad wymiarami, kolorami, materiałami i
                                czcionkami. Stwórz dokładnie to, co sobie wymarzyłeś.</p>
                            <a href="#"
                                class="nav-link text-orange-500 hover:text-orange-600 inline-flex items-center font-medium">
                                Wypróbuj edytor
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Feature 3 -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg border border-orange-600 text-center transform transition hover:translate-y-[-5px] hover:shadow-xl">
                            <div
                                class="icon-wrapper bg-orange-100 w-16 h-16 rounded-lg flex items-center justify-center mx-auto mb-5">
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800 mb-3">Błyskawiczna Dostawa</h3>
                            <p class="text-gray-600 mb-4">Otrzymaj swoje etykiety wydrukowane i dostarczone nawet w 24
                                godziny. Dostępna usługa ekspresowa.</p>
                            <a href="#"
                                class="nav-link text-orange-500 hover:text-orange-600 inline-flex items-center font-medium">
                                Informacje o wysyłce
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Second Row Features -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                        <!-- Feature 4 -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg border border-orange-600 text-center transform transition hover:translate-y-[-5px] hover:shadow-xl">
                            <div
                                class="icon-wrapper bg-orange-100 w-16 h-16 rounded-lg flex items-center justify-center mx-auto mb-5">
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800 mb-3">Najwyższa Jakość</h3>
                            <p class="text-gray-600 mb-4">Materiały i druk klasy przemysłowej zapewniają, że Twoje
                                etykiety wytrzymają trudne warunki.</p>
                            <a href="#"
                                class="nav-link text-orange-500 hover:text-orange-600 inline-flex items-center font-medium">
                                Dowiedz się więcej
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Feature 5 -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg border border-orange-600 text-center transform transition hover:translate-y-[-5px] hover:shadow-xl">
                            <div
                                class="icon-wrapper bg-orange-100 w-16 h-16 rounded-lg flex items-center justify-center mx-auto mb-5">
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800 mb-3">Eksperckie Wsparcie</h3>
                            <p class="text-gray-600 mb-4">Nasi eksperci są dostępni 24/7, aby pomóc Ci z Twoimi
                                projektami. Darmowe konsultacje projektowe.</p>
                            <a href="#"
                                class="nav-link text-orange-500 hover:text-orange-600 inline-flex items-center font-medium">
                                Kontakt ze wsparciem
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Feature 6 -->
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg border border-orange-600 text-center transform transition hover:translate-y-[-5px] hover:shadow-xl">
                            <div
                                class="icon-wrapper bg-orange-100 w-16 h-16 rounded-lg flex items-center justify-center mx-auto mb-5">
                                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800 mb-3">Analityka Biznesowa</h3>
                            <p class="text-gray-600 mb-4">Śledź wydajność etykiet, monitoruj zwroty i optymalizuj swoją
                                strategię etykietowania dzięki danym.</p>
                            <a href="#"
                                class="nav-link text-orange-500 hover:text-orange-600 inline-flex items-center font-medium">
                                Zobacz analizę
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
        </div>
    </div>

    <!-- Section Separator -->
    <div class="h-1 bg-gradient-to-r from-transparent via-orange-200 to-transparent my-8"></div>

            <!-- Pricing Section with dynamic background -->
            <div class="py-24 px-4 bg-gray-50 relative" id="pricing">
                
                <div class="max-w-5xl mx-auto relative z-10">
                    <div class="text-center mb-12">
                        <span
                            class="bg-orange-100 text-orange-600 text-sm font-medium px-4 py-2 rounded-full">Cennik</span>
                        <h2 class="text-3xl font-bold text-gray-900 mt-4 mb-2">Prosto i przejrzyste ceny</h2>
                        <p class="text-gray-600 text-lg">Bez ukrytych opłat, bez kosztów konfiguracji. Płacisz tylko za
                            wartość zamówienia z automatycznie naliczanymi rabatami ilościowymi.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Starter Plan - Ulepszony design z animowaną ceną -->
                        <div
                            class="bg-white rounded-xl shadow-lg border border-orange-600 overflow-hidden transform transition duration-300 hover:shadow-xl hover:scale-105">
                            <div class="p-6 text-center">
                                <div
                                    class="bg-gray-50 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 icon-wrapper">
                                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Starter</h3>
                                <p class="text-sm text-gray-500 mb-4">Idealny do małych projektów</p>

                                <div class="mb-6 price-counter">
                                    <span class="text-4xl font-bold text-gray-900"
                                        data-target-price="0.25">$0.25</span>
                                    <span class="text-sm text-gray-500">za etykietę</span>
                                </div>

                                <ul class="text-left space-y-3 mb-8">
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Do 100 etykiet
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Podstawowe materiały
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Standardowa wysyłka
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Wsparcie mailowe
                                    </li>
                                </ul>

                                <button
                                    class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition-colors">
                                    Rozpocznij
                                </button>
                            </div>
                        </div>

                        <!-- Professional Plan (Highlighted) - Jeszcze lepiej wyróżniony -->
                        <div
class="bg-white rounded-xl shadow-lg border border-orange-600 overflow-hidden transform transition duration-300 hover:shadow-xl hover:scale-105"                            <!-- Badge with animation -->
                            <div class="absolute top-0 right-0">
                                <div
                                    class="bg-orange-500 text-white text-xs font-bold py-1 px-4 rounded-bl-lg animate-pulse">
                                    NAJPOPULARNIEJSZY
                                </div>
                            </div>

                            <div class="p-8 text-center">
                                <div
                                    class="bg-orange-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 icon-wrapper">
                                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Professional</h3>
                                <p class="text-sm text-gray-500 mb-4">Najlepsza wartość dla firm</p>

                                <div class="mb-6 price-counter">
                                    <span class="text-4xl font-bold text-orange-500"
                                        data-target-price="0.18">$0.18</span>
                                    <span class="text-sm text-gray-500">za etykietę</span>
                                </div>

                                <ul class="text-left space-y-3 mb-8">
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Do 5,000 etykiet
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Premium materiały
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Ekspresowa wysyłka
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Priorytetowe wsparcie
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Podgląd 3D
                                    </li>
                                </ul>

                                <button
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-lg transition-colors shadow-lg hover:shadow-xl">
                                    Rozpocznij darmowy okres próbny
                                </button>
                            </div>
                        </div>

                        <!-- Enterprise Plan - Ulepszony design -->
                        <div
                            class="bg-white rounded-xl shadow-lg border border-orange-600 overflow-hidden transform transition duration-300 hover:shadow-xl hover:scale-105">
                            <div class="p-6 text-center">
                                <div
                                    class="bg-black-50 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 icon-wrapper">
                                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1">Enterprise</h3>
                                <p class="text-sm text-gray-500 mb-4">Dla dużych wolumenów</p>

                                <div class="mb-6 price-counter">
                                    <span class="text-4xl font-bold text-gray-900"
                                        data-target-price="0.12">$0.12</span>
                                    <span class="text-sm text-gray-500">za etykietę</span>
                                </div>

                                <ul class="text-left space-y-3 mb-8">
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Nielimitowane etykiety
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Wszystkie materiały
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Wysyłka tego samego dnia
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Dedykowany manager
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Dostęp do API
                                    </li>
                                </ul>

                                <button
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                    Kontakt z działem sprzedaży
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="text-center text-gray-500 mt-8">
                        Wszystkie plany zawierają darmowe wsparcie projektowe i nieograniczone poprawki
                    </div>

                    <div class="text-center mt-6">
                        <a href="#"
                            class="nav-link text-orange-500 hover:text-orange-600 inline-flex items-center font-medium">
                            Zobacz szczegółowy cennik
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
        </div>
    </div>

    <!-- Section Separator -->
    <div class="h-1 bg-gradient-to-r from-transparent via-orange-200 to-transparent my-8"></div>

            <!-- Testimonials Section with improved animations -->
            <div class="py-24 px-4 bg-white">
                <div class="max-w-5xl mx-auto">
                    <div class="text-center mb-12">
                        <span class="bg-yellow-100 text-yellow-600 text-sm font-medium px-4 py-2 rounded-full">Opinie
                            klientów</span>
                        <h2 class="text-3xl font-bold text-gray-900 mt-4 mb-2">Zaufało nam ponad 50,000+ firm</h2>
                        <p class="text-gray-600 text-lg">Zobacz, co mówią o nas nasi klienci</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Enhanced Testimonial 1 -->
                        <div
                            class="testimonial-card bg-white rounded-xl shadow-lg p-8 relative border border-gray-100">
                            <!-- Quotation mark -->
                            <div
                                class="absolute top-4 right-4 text-orange-100 text-5xl font-serif quote-mark transition-all duration-300">
                                "
                            </div>

                            <div class="flex text-yellow-400 mb-4">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>

                            <p class="text-gray-700 mb-8 relative z-10">"Niesamowite! Jakość naszych etykiet
                                produktowych całkowicie zmieniła sposób, w jaki klienci postrzegają naszą markę. Czas
                                realizacji jest imponujący. Nasze produkty wyglądają premium i obserwujemy wzrost
                                sprzedaży."</p>

                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-green-600 mr-4 flex items-center justify-center text-white font-bold">
                                    SC
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Sarah Chen</p>
                                    <p class="text-sm text-gray-500">CEO, Green Botanicals</p>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Testimonial 2 -->
                        <div
                            class="testimonial-card bg-white rounded-xl shadow-lg p-8 relative border border-gray-100">
                            <!-- Quotation mark -->
                            <div
                                class="absolute top-4 right-4 text-orange-100 text-5xl font-serif quote-mark transition-all duration-300">
                                "
                            </div>

                            <div class="flex text-yellow-400 mb-4">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>

                            <p class="text-gray-700 mb-8 relative z-10">"Współpraca z CustomLabels to czysta
                                przyjemność. Zamawialiśmy etykiety dla całej naszej linii produktów i rezultat przeszedł
                                nasze oczekiwania. Proces projektowania był intuicyjny, a zespół wsparcia zawsze gotowy
                                do pomocy."</p>

                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 mr-4 flex items-center justify-center text-white font-bold animate-pulse-slow">
                                    JN
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Jan Nowak</p>
                                    <p class="text-sm text-gray-500">Dyrektor Marketingu, Tech Solutions</p>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Testimonial 3 - Nowy z efektem glow -->
                        <div
                            class="testimonial-card bg-white rounded-xl shadow-lg p-8 relative border border-gray-100 hover:border-orange-200 transition-colors">
                            <!-- Quotation mark z animacją -->
                            <div
                                class="absolute top-4 right-4 text-orange-100 text-5xl font-serif quote-mark transition-all duration-300">
                                "
                            </div>

                            <!-- Subtle glow effect on hover -->
                            <div
                                class="absolute inset-0 bg-gradient-to-tr from-orange-100 to-yellow-50 opacity-0 group-hover:opacity-20 rounded-xl transition-opacity duration-700">
                            </div>

                            <div class="flex text-yellow-400 mb-4">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>

                            <p class="text-gray-700 mb-8 relative z-10">"Od kiedy zaczęliśmy używać profesjonalnych
                                etykiet od CustomLabels, zauważyliśmy 40% wzrost zainteresowania naszymi produktami na
                                targach. Klienci często komentują profesjonalny wygląd naszych opakowań."</p>

                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-500 mr-4 flex items-center justify-center text-white font-bold shadow-lg">
                                    AK
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Anna Kowalska</p>
                                    <p class="text-sm text-gray-500">Właściciel, Naturalne Kosmetyki</p>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
            <!-- Call To Action Section z dynamicznym tłem i ulepszonymi animacjami -->
            <div
                class="py-24 px-4 relative overflow-hidden bg-gradient-to-r from-orange-500 via-orange-400 to-orange-600 animate-gradient-x">
                <!-- Animated particles background -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute w-20 h-20 rounded-full bg-white opacity-10 animate-float"
                        style="top: 10%; left: 20%; animation-delay: 0s;"></div>
                    <div class="absolute w-16 h-16 rounded-full bg-white opacity-10 animate-float"
                        style="top: 50%; left: 10%; animation-delay: 0.5s;"></div>
                    <div class="absolute w-24 h-24 rounded-full bg-white opacity-10 animate-float"
                        style="top: 30%; left: 85%; animation-delay: 1s;"></div>
                    <div class="absolute w-12 h-12 rounded-full bg-white opacity-10 animate-float"
                        style="top: 80%; left: 70%; animation-delay: 1.5s;"></div>
                    <div class="absolute w-16 h-16 rounded-full bg-white opacity-10 animate-float"
                        style="top: 70%; left: 30%; animation-delay: 2s;"></div>
                    <div class="absolute w-20 h-20 rounded-full bg-white opacity-10 animate-float"
                        style="top: 20%; left: 55%; animation-delay: 2.5s;"></div>
                </div>

                <div class="max-w-5xl mx-auto text-center relative z-10">
                    <h2 class="text-4xl font-bold text-white mb-8 drop-shadow-lg">Gotowy na profesjonalne etykiety?
                    </h2>

                    <p class="text-xl text-white/90 mb-12 max-w-2xl mx-auto leading-relaxed">
                        Dołącz do tysięcy zadowolonych klientów i zamów swoje własne,
                        spersonalizowane etykiety już dziś. Pierwsza próbka <span
                            class="font-extrabold text-orange-700 text-3xl md:text-6xl mb-6">gratis!</span>
                    </p>

                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="#label-creator"
                            class="bg-white text-orange-600 px-10 py-4 rounded-xl font-medium text-lg flex items-center transform transition-all duration-300 hover:scale-105 hover:bg-yellow-50 hover:shadow-xl group">
                            <svg class="w-6 h-6 mr-3 transition-transform group-hover:scale-110" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            Zaprojektuj etykietę
                            <div
                                class="absolute inset-0 bg-white rounded-xl -z-10 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                            </div>
                        </a>

                        <a href="#contact"
                            class="bg-white text-orange-600 px-10 py-4 rounded-xl font-medium text-lg flex items-center transition-all duration-300 hover:bg-white/10 hover:scale-105 hover:shadow-lg">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            Kontakt z doradcą
                        </a>
                    </div>
        </div>
    </div>

    <!-- Section Separator -->
    <div class="h-1 bg-gradient-to-r from-transparent via-orange-200 to-transparent my-16"></div>

            <!-- FAQ Section z animowanymi pytaniami i odpowiedziami -->
            <div class="py-24 px-4 bg-gray-50">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-16">
                        <span
                            class="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-medium mb-3">FAQ</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Najczęściej zadawane pytania</h2>
                        <p class="text-gray-600 text-lg">Znalazłeś odpowiedź na swoje pytanie? Jeśli nie, skontaktuj
                            się z nami.</p>
                    </div>

                    <div class="space-y-4" x-data="{ selected: null }">
                        <!-- FAQ Item 1 -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <button @click="selected !== 1 ? selected = 1 : selected = null"
                                class="flex justify-between items-center w-full p-5 text-left transition-all duration-300 hover:bg-gray-50"
                                :class="{ 'bg-gradient-to-r from-orange-50 to-yellow-50': selected === 1 }">
                                <span class="text-lg font-medium text-gray-900 flex items-center">
                                    <span
                                        class="inline-block w-8 h-8 rounded-full bg-orange-100 text-orange-500 mr-3 flex items-center justify-center transition-all duration-300"
                                        :class="{ 'bg-orange-500 text-white transform rotate-360': selected === 1 }">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01"></path>
                                        </svg>
                                    </span>
                                    Jak długo trwa realizacja zamówienia?
                                </span>
                                <svg class="w-5 h-5 text-orange-500 transition-transform duration-300"
                                    :class="{ 'rotate-180': selected === 1 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="selected === 1" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="p-5 border-t border-gray-100">
                                <p class="text-gray-600">Standardowo realizacja zamówienia trwa od 3 do 5 dni
                                    roboczych. Oferujemy również usługę ekspresową, która umożliwia otrzymanie etykiet
                                    nawet w 24 godziny od zatwierdzenia projektu.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <button @click="selected !== 2 ? selected = 2 : selected = null"
                                class="flex justify-between items-center w-full p-5 text-left transition-all duration-300 hover:bg-gray-50"
                                :class="{ 'bg-gradient-to-r from-orange-50 to-yellow-50': selected === 2 }">
                                <span class="text-lg font-medium text-gray-900 flex items-center">
                                    <span
                                        class="inline-block w-8 h-8 rounded-full bg-orange-100 text-orange-500 mr-3 flex items-center justify-center transition-all duration-300"
                                        :class="{ 'bg-orange-500 text-white transform rotate-360': selected === 2 }">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01"></path>
                                        </svg>
                                    </span>
                                    Czy mogę zamówić próbkę przed pełnym zamówieniem?
                                </span>
                                <svg class="w-5 h-5 text-orange-500 transition-transform duration-300"
                                    :class="{ 'rotate-180': selected === 2 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="selected === 2" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="p-5 border-t border-gray-100">
                                <p class="text-gray-600">Tak, oferujemy możliwość zamówienia próbki w celu weryfikacji
                                    jakości druku i materiału. Koszt próbki jest odliczany od wartości pełnego
                                    zamówienia.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <button @click="selected !== 3 ? selected = 3 : selected = null"
                                class="flex justify-between items-center w-full p-5 text-left transition-all duration-300 hover:bg-gray-50"
                                :class="{ 'bg-gradient-to-r from-orange-50 to-yellow-50': selected === 3 }">
                                <span class="text-lg font-medium text-gray-900 flex items-center">
                                    <span
                                        class="inline-block w-8 h-8 rounded-full bg-orange-100 text-orange-500 mr-3 flex items-center justify-center transition-all duration-300"
                                        :class="{ 'bg-orange-500 text-white transform rotate-360': selected === 3 }">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01"></path>
                                        </svg>
                                    </span>
                                    Jakie formaty plików są akceptowane?
                                </span>
                                <svg class="w-5 h-5 text-orange-500 transition-transform duration-300"
                                    :class="{ 'rotate-180': selected === 3 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="selected === 3" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="p-5 border-t border-gray-100">
                                <p class="text-gray-600">Akceptujemy pliki w formatach: PDF, AI, PSD, JPG i PNG. Dla
                                    najlepszej jakości druku zalecamy dostarczenie plików wektorowych (PDF, AI) z
                                    rozdzielczością minimum 300 DPI.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <button @click="selected !== 4 ? selected = 4 : selected = null"
                                class="flex justify-between items-center w-full p-5 text-left transition-all duration-300 hover:bg-gray-50"
                                :class="{ 'bg-gradient-to-r from-orange-50 to-yellow-50': selected === 4 }">
                                <span class="text-lg font-medium text-gray-900 flex items-center">
                                    <span
                                        class="inline-block w-8 h-8 rounded-full bg-orange-100 text-orange-500 mr-3 flex items-center justify-center transition-all duration-300"
                                        :class="{ 'bg-orange-500 text-white transform rotate-360': selected === 4 }">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01"></path>
                                        </svg>
                                    </span>
                                    Czy etykiety są odporne na wodę?
                                </span>
                                <svg class="w-5 h-5 text-orange-500 transition-transform duration-300"
                                    :class="{ 'rotate-180': selected === 4 }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="selected === 4" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="p-5 border-t border-gray-100">
                                <p class="text-gray-600">Oferujemy szeroki wybór materiałów, w tym wodoodporne i
                                    odporne na warunki atmosferyczne. Dla produktów narażonych na kontakt z wodą lub
                                    wilgocią polecamy materiały winylowe lub polietylenowe z dodatkowym laminatem
                                    ochronnym.</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-12">
                        <a href="#contact"
                            class="inline-flex items-center text-orange-500 hover:text-orange-600 font-medium text-lg group">
                            Masz inne pytanie? Skontaktuj się z nami
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
        </div>
    </div>


            <!-- Newsletter Section z gradientem i animacją -->
            <div class="py-24 px-4 bg-gradient-to-br from-blue-900 to-blue-800 text-white relative overflow-hidden"
                id="newsletter">
                <!-- Animated elements -->
                <div class="absolute inset-0 pointer-events-none">
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-80 h-80 bg-white opacity-5 rounded-full translate-y-1/2 -translate-x-1/2">
                    </div>
                    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-400 opacity-20 rounded-full animate-pulse">
                    </div>
                    <div class="absolute top-1/3 right-1/3 w-24 h-24 bg-blue-300 opacity-10 rounded-full animate-ping"
                        style="animation-duration: 5s;"></div>
                </div>

                <div class="max-w-4xl mx-auto relative z-10">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold mb-4">Bądź na bieżąco</h2>
                        <p class="text-blue-100 text-lg max-w-2xl mx-auto">Zapisz się do naszego newslettera, aby
                            otrzymywać informacje o nowościach, promocjach i poradach dotyczących etykiet.</p>
                    </div>

                    <div class="max-w-xl mx-auto">
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('newsletter-subscription');

$__html = app('livewire')->mount($__name, $__params, 'lw-235481482-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        <p class="text-sm text-blue-200 text-center mt-4">Zero spamu. Tylko wartościowe informacje.
                            Możesz zrezygnować w każdej chwili.</p>
                    </div>
                </div>
            </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>

<script>
function selectConfiguration(configType) {
    // Konfiguracje dla różnych typów etykiet
    const configurations = {
        'fresh-organic': {
            shape: 'oval',
            material: 'paper-kraft',
            size: '50x30',
            laminate: 'laminate-matte',
            description: 'Konfiguracja dla produktów organicznych - owalny kształt, papier kraft, laminat matowy'
        },
        'express-shipping': {
            shape: 'rectangle',
            material: 'foil-white',
            size: '80x50',
            laminate: 'laminate-glossy',
            description: 'Konfiguracja dla etykiet wysyłkowych - prostokątny kształt, biała folia, laminat błyszczący'
        },
        'premium-quality': {
            shape: 'square',
            material: 'foil-gold',
            size: '40x40',
            laminate: 'laminate-soft-touch',
            description: 'Konfiguracja premium - kwadratowy kształt, złota folia, laminat soft-touch'
        },
        'eco-friendly': {
            shape: 'circle',
            material: 'paper-waterproof',
            size: '50x50',
            laminate: 'laminate-matte',
            description: 'Konfiguracja ekologiczna - okrągły kształt, wodoodporny papier, laminat matowy'
        }
    };

    const config = configurations[configType];
    if (!config) return;

    // Pokaż loading
    showLoading('Konfiguruję kreator...');

    // Symuluj ustawienie konfiguracji w kreatorze
    setTimeout(() => {
        // Tutaj można dodać logikę ustawiania wartości w Livewire
        // Na razie tylko pokazujemy komunikat i przekierowujemy
        hideLoading();
        
        // Przekieruj do kreatora z parametrami
        const url = new URL(window.location.origin + '/#label-creator');
        url.searchParams.set('config', configType);
        url.searchParams.set('shape', config.shape);
        url.searchParams.set('material', config.material);
        url.searchParams.set('size', config.size);
        url.searchParams.set('laminate', config.laminate);
        
        window.location.href = url.toString();
    }, 1500);
}

function showLoading(message) {
    // Utwórz overlay loading
    const overlay = document.createElement('div');
    overlay.id = 'config-loading';
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        color: white;
        font-size: 18px;
        font-weight: 500;
    `;
    overlay.innerHTML = `
        <div style="text-align: center;">
            <div style="width: 50px; height: 50px; border: 3px solid #f97316; border-top: 3px solid transparent; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 20px;"></div>
            <div>${message}</div>
        </div>
    `;
    
    // Dodaj CSS dla animacji
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
    
    document.body.appendChild(overlay);
}

function hideLoading() {
    const overlay = document.getElementById('config-loading');
    if (overlay) {
        overlay.remove();
    }
}

// Obsługa parametrów URL
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const config = urlParams.get('config');
    
    if (config) {
        // Tutaj można dodać logikę automatycznego ustawienia kreatora
        console.log('Konfiguracja:', config);
    }
});
</script>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/home.blade.php ENDPATH**/ ?>