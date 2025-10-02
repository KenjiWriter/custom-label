<x-layouts.app title="Galeria - Custom Labels">
    @push('styles')
        <style>
            .project-card {
                transition: all 0.3s ease;
            }
            .project-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
            .project-overlay {
                background: linear-gradient(45deg, rgba(255,107,53,0.9), rgba(247,147,30,0.9));
                opacity: 0;
                transition: all 0.3s ease;
            }
            .project-card:hover .project-overlay {
                opacity: 1;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-6">
                🎨 Galeria Projektów
            </h1>
            <p class="text-xl text-orange-100 max-w-3xl mx-auto">
                Odkryj nasze najlepsze realizacje! Każda etykieta to unikalna historia sukcesu naszych klientów.
            </p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="project-card bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-orange-600 mb-2">500+</div>
                    <div class="text-gray-600">Projektów</div>
                </div>
                <div class="project-card bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-blue-600 mb-2">200+</div>
                    <div class="text-gray-600">Zadowolonych Klientów</div>
                </div>
                <div class="project-card bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-green-600 mb-2">50+</div>
                    <div class="text-gray-600">Branż</div>
                </div>
                <div class="project-card bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-purple-600 mb-2">4.9/5</div>
                    <div class="text-gray-600">Ocena Klientów</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Gallery -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Nasze Realizacje</h2>
                <p class="text-xl text-gray-600">Każdy projekt to dowód na naszą jakość i kreatywność</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="px-6 py-3 bg-orange-500 text-white rounded-full font-medium hover:bg-orange-600 transition-colors">
                    Wszystkie
                </button>
                <button class="px-6 py-3 bg-white text-gray-700 rounded-full font-medium hover:bg-orange-50 hover:text-orange-600 transition-colors border">
                    Kosmetyki
                </button>
                <button class="px-6 py-3 bg-white text-gray-700 rounded-full font-medium hover:bg-orange-50 hover:text-orange-600 transition-colors border">
                    Żywność
                </button>
                <button class="px-6 py-3 bg-white text-gray-700 rounded-full font-medium hover:bg-orange-50 hover:text-orange-600 transition-colors border">
                    Napoje
                </button>
                <button class="px-6 py-3 bg-white text-gray-700 rounded-full font-medium hover:bg-orange-50 hover:text-orange-600 transition-colors border">
                    Przemysł
                </button>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <div class="h-64 bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-2xl font-bold mb-2">BELLA ROSA</div>
                                <div class="text-sm">Premium Cosmetics</div>
                            </div>
                        </div>
                        <div class="project-overlay absolute inset-0 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-lg font-bold mb-2">Zobacz szczegóły</div>
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykiety Kosmetyczne Bella Rosa</h3>
                        <p class="text-gray-600 mb-4">Eleganckie etykiety na produkty kosmetyczne premium z laminatem matowym.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm">Kosmetyki</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Laminate Matt</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Warszawa</span>
                            <span>📅 Październik 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <div class="h-64 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-2xl font-bold mb-2">ECO FARM</div>
                                <div class="text-sm">Organic Products</div>
                            </div>
                        </div>
                        <div class="project-overlay absolute inset-0 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-lg font-bold mb-2">Zobacz szczegóły</div>
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykiety Eko Farm</h3>
                        <p class="text-gray-600 mb-4">Naturalne etykiety na produkty ekologiczne z papieru kraft.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">Żywność</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Papier Kraft</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Kraków</span>
                            <span>📅 Wrzesień 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-2xl font-bold mb-2">AQUA PURE</div>
                                <div class="text-sm">Premium Water</div>
                            </div>
                        </div>
                        <div class="project-overlay absolute inset-0 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-lg font-bold mb-2">Zobacz szczegóły</div>
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykiety Aqua Pure</h3>
                        <p class="text-gray-600 mb-4">Wodoodporne etykiety na butelki z wodą mineralną.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">Napoje</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Folia Biała</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Gdańsk</span>
                            <span>📅 Sierpień 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Project 4 -->
                <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <div class="h-64 bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-2xl font-bold mb-2">TECH PRO</div>
                                <div class="text-sm">Electronics</div>
                            </div>
                        </div>
                        <div class="project-overlay absolute inset-0 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-lg font-bold mb-2">Zobacz szczegóły</div>
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykiety Tech Pro</h3>
                        <p class="text-gray-600 mb-4">Profesjonalne etykiety na sprzęt elektroniczny z laminatem błyszczącym.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">Przemysł</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Laminate Glossy</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Wrocław</span>
                            <span>📅 Lipiec 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Project 5 -->
                <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <div class="h-64 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-2xl font-bold mb-2">WINE ROYAL</div>
                                <div class="text-sm">Premium Wine</div>
                            </div>
                        </div>
                        <div class="project-overlay absolute inset-0 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-lg font-bold mb-2">Zobacz szczegóły</div>
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykiety Wine Royal</h3>
                        <p class="text-gray-600 mb-4">Luksusowe etykiety na wina premium z efektem soft-touch.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">Napoje</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Soft Touch</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Poznań</span>
                            <span>📅 Czerwiec 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Project 6 -->
                <div class="project-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <div class="h-64 bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-2xl font-bold mb-2">HONEY BEE</div>
                                <div class="text-sm">Natural Honey</div>
                            </div>
                        </div>
                        <div class="project-overlay absolute inset-0 flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-lg font-bold mb-2">Zobacz szczegóły</div>
                                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykiety Honey Bee</h3>
                        <p class="text-gray-600 mb-4">Naturalne etykiety na miód z ekologicznego papieru kraft.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-sm">Żywność</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Papier Kraft</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Lublin</span>
                            <span>📅 Maj 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-full font-medium text-lg transition-colors transform hover:scale-105">
                    Załaduj więcej projektów
                </button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-orange-500 to-orange-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Gotowy na swój projekt?</h2>
            <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                Dołącz do grona zadowolonych klientów i stwórz etykiety, które wyróżnią Twój produkt!
            </p>
            <a href="{{ route('creator') }}" class="inline-block bg-white text-orange-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors transform hover:scale-105">
                🚀 Rozpocznij projekt
            </a>
        </div>
    </section>
</x-layouts.app>
