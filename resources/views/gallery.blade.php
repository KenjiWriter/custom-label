<x-layouts.app title="Galeria - Custom Labels">
    @push('styles')
        <style>
            .label-card {
                transition: all 0.3s ease;
            }
            .label-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
            .label-image {
                background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
                border: 2px dashed #d1d5db;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #6b7280;
                font-size: 14px;
                text-align: center;
                position: relative;
                overflow: hidden;
            }
            .label-image::before {
                content: '';
                position: absolute;
                top: 10px;
                left: 10px;
                right: 10px;
                bottom: 10px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-6">
                🏷️ Galeria Etykiet
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
                <div class="label-card bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-orange-600 mb-2">500+</div>
                    <div class="text-gray-600">Etykiet</div>
                </div>
                <div class="label-card bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-blue-600 mb-2">200+</div>
                    <div class="text-gray-600">Zadowolonych Klientów</div>
                </div>
                <div class="label-card bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-green-600 mb-2">50+</div>
                    <div class="text-gray-600">Branż</div>
                </div>
                <div class="label-card bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-purple-600 mb-2">4.9/5</div>
                    <div class="text-gray-600">Ocena Klientów</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Buttons -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-4">
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
        </div>
    </section>

    <!-- Labels Gallery -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Nasze Etykiety</h2>
                <p class="text-xl text-gray-600">Każda etykieta to dowód na naszą jakość i kreatywność</p>
            </div>

            <!-- Labels Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Label 1 - Kosmetyki -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-pink-100 to-pink-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">💄</div>
                            <div class="text-pink-600 font-bold text-lg">BELLA ROSA</div>
                            <div class="text-pink-500 text-sm">Premium Lipstick</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta na szminkę Bella Rosa</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Folia biała</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Soft Touch</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">40x25mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">1000 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm">Kosmetyki</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Premium</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Warszawa</span>
                            <span>📅 Październik 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 2 - Żywność -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-green-100 to-green-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🍯</div>
                            <div class="text-green-700 font-bold text-lg">MIÓD GÓRSKI</div>
                            <div class="text-green-600 text-sm">100% Naturalny</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta na słoik miodu</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Papier kraft</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Brak</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">80x60mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">500 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">Żywność</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Eko</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Zakopane</span>
                            <span>📅 Wrzesień 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 3 - Napoje -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-blue-100 to-blue-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🍺</div>
                            <div class="text-blue-700 font-bold text-lg">CRAFT BEER</div>
                            <div class="text-blue-600 text-sm">IPA Premium</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta na piwo rzemieślnicze</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Folia biała</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Wodoodporny</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">90x120mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">2000 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">Napoje</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Craft</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Kraków</span>
                            <span>📅 Sierpień 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 4 - Przemysł -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-gray-100 to-gray-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">⚙️</div>
                            <div class="text-gray-700 font-bold text-lg">TECH PARTS</div>
                            <div class="text-gray-600 text-sm">Model: TP-2024</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta przemysłowa</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Folia srebrna</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Odporny na ścieranie</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">50x20mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">5000 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Przemysł</span>
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">Trwałe</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Gdańsk</span>
                            <span>📅 Lipiec 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 5 - Kosmetyki -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-purple-100 to-purple-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🧴</div>
                            <div class="text-purple-700 font-bold text-lg">LAVENDER SPA</div>
                            <div class="text-purple-600 text-sm">Relaxing Oil</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta na olejek aromatyczny</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Folia transparentna</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Matowy</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">60x40mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">800 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm">Kosmetyki</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">SPA</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Wrocław</span>
                            <span>📅 Czerwiec 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 6 - Żywność -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-red-100 to-red-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🍅</div>
                            <div class="text-red-700 font-bold text-lg">PASSATA</div>
                            <div class="text-red-600 text-sm">100% Pomidory</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta na passatę pomidorową</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Papier biały</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Błyszczący</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">100x70mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">3000 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">Żywność</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Bio</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Poznań</span>
                            <span>📅 Maj 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 7 - Napoje -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-yellow-100 to-yellow-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🍋</div>
                            <div class="text-yellow-700 font-bold text-lg">LEMON FRESH</div>
                            <div class="text-yellow-600 text-sm">Lemoniada</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta na lemoniadę</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Folia biała</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Wodoodporny</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">70x100mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">1500 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-sm">Napoje</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Fresh</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Lublin</span>
                            <span>📅 Kwiecień 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 8 - Przemysł -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-orange-100 to-orange-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🔧</div>
                            <div class="text-orange-700 font-bold text-lg">SAFETY FIRST</div>
                            <div class="text-orange-600 text-sm">Ostrzeżenie</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta ostrzegawcza</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Folia żółta</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">UV-resistant</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">100x50mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">10000 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm">Przemysł</span>
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">Bezpieczeństwo</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Katowice</span>
                            <span>📅 Marzec 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Label 9 - Kosmetyki -->
                <div class="label-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="label-image h-64 bg-gradient-to-br from-teal-100 to-teal-200">
                        <div class="text-center">
                            <div class="text-4xl mb-2">🧴</div>
                            <div class="text-teal-700 font-bold text-lg">OCEAN BREEZE</div>
                            <div class="text-teal-600 text-sm">Shower Gel</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Etykieta na żel pod prysznic</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Materiał:</span>
                                <span class="font-medium">Folia biała</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Laminate:</span>
                                <span class="font-medium">Wodoodporny</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rozmiar:</span>
                                <span class="font-medium">80x120mm</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Nakład:</span>
                                <span class="font-medium">2500 szt</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-teal-100 text-teal-600 rounded-full text-sm">Kosmetyki</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">Higiena</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>📍 Szczecin</span>
                            <span>📅 Luty 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-full font-medium text-lg transition-colors transform hover:scale-105">
                    Załaduj więcej etykiet
                </button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-orange-500 to-orange-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Stwórz swoją etykietę!</h2>
            <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                Dołącz do grona zadowolonych klientów i stwórz etykiety, które wyróżnią Twój produkt!
            </p>
            <a href="{{ route('label.creator') }}" class="inline-block bg-white text-orange-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors transform hover:scale-105">
                🚀 Rozpocznij projekt
            </a>
        </div>
    </section>
</x-layouts.app>