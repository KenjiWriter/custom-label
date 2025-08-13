<x-layouts.app title="Stwórz swoją idealną etykietę - Custom Labels">
    
    <!-- Hero Section -->
    <div class="py-12 lg:py-20">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Stwórz swoją <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">idealną</span> etykietę
            </h1>
            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                Zaprojektuj i zamów spersonalizowane etykiety w kilku prostych krokach. 
                Wybierz kształt, materiał i rozmiar, a my zajmiemy się resztą.
            </p>
            
            <!-- Quick Stats -->
            <div class="flex flex-wrap justify-center gap-8 text-center mb-12">
                <div>
                    <div class="text-3xl font-bold text-blue-600">24h</div>
                    <div class="text-sm text-gray-600">Szybka realizacja</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-green-600">1000+</div>
                    <div class="text-sm text-gray-600">Zadowolonych klientów</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-600">50+</div>
                    <div class="text-sm text-gray-600">Typów materiałów</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Label Creator Section -->
    <div class="py-16 bg-white rounded-2xl shadow-xl mb-16">
        <div class="px-6 lg:px-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Kreator etykiet
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Skonfiguruj swoją etykietę krok po kroku. Każda zmiana natychmiast wpływa na cenę i podgląd.
                </p>
            </div>
            
            @livewire('label-creator')
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                Dlaczego warto nas wybrać?
            </h2>
            <p class="text-lg text-gray-600">
                Oferujemy kompleksową usługę od projektu do dostawy
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Quality -->
            <div class="text-center group">
                <div class="bg-gradient-to-br from-blue-100 to-blue-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Najwyższa jakość</h3>
                <p class="text-gray-600 leading-relaxed">
                    Używamy tylko najlepszych materiałów i nowoczesnych technologii druku. 
                    Każda etykieta przechodzi kontrolę jakości.
                </p>
            </div>
            
            <!-- Speed -->
            <div class="text-center group">
                <div class="bg-gradient-to-br from-green-100 to-green-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Ekspresowa realizacja</h3>
                <p class="text-gray-600 leading-relaxed">
                    Standardowy czas realizacji to 24-48 godzin od zatwierdzenia zamówienia. 
                    Pilne zamówienia realizujemy tego samego dnia.
                </p>
            </div>
            
            <!-- Customization -->
            <div class="text-center group">
                <div class="bg-gradient-to-br from-purple-100 to-purple-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a1 1 0 01-1-1V9a1 1 0 011-1h1a2 2 0 100-4H4a1 1 0 01-1-1V4a1 1 0 011-1h3a1 1 0 011 1v1z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Pełna personalizacja</h3>
                <p class="text-gray-600 leading-relaxed">
                    Dostosuj każdy szczegół - od kształtu po materiał i wykończenie. 
                    Podgląd 3D pokazuje dokładnie jak będzie wyglądać Twoja etykieta.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl text-white text-center">
        <h2 class="text-3xl font-bold mb-4">
            Gotowy na stworzenie swojej etykiety?
        </h2>
        <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
            Dołącz do tysięcy zadowolonych klientów, którzy zaufali naszej jakości i profesjonalizmowi.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button onclick="document.querySelector('#label-creator').scrollIntoView({behavior: 'smooth'})" 
                    class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                Rozpocznij teraz
            </button>
            <a href="#" 
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                Zobacz przykłady
            </a>
        </div>
    </div>

    @push('scripts')
    <script>
        // Smooth scrolling to creator
        document.addEventListener('DOMContentLoaded', function() {
            const creatorSection = document.querySelector('[data-creator-section]');
            if (creatorSection) {
                creatorSection.setAttribute('id', 'label-creator');
            }
        });
    </script>
    @endpush
</x-layouts.app>