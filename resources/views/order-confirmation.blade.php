<x-layouts.app title="Potwierdzenie zamówienia">
    <div class="min-h-screen bg-gray-50">
        <!-- Progress Bar -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center py-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                        <span class="ml-2 text-sm font-medium text-orange-600">Payment</span>
                    </div>
                    <div class="flex-1 h-1 bg-orange-600 mx-4"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                        <span class="ml-2 text-sm font-medium text-orange-600">Confirmation</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Success Header -->
            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Płatność zakończona pomyślnie!</h1>
                <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                    Dziękujemy za złożenie zamówienia. Oto podsumowanie Twojego zakupu i dalsze kroki.
                </p>
                
                <!-- Security Features -->
                <div class="flex justify-center space-x-8">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Płatność potwierdzona</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Bezpieczne dane</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Szybka realizacja</span>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Podsumowanie zamówienia</h2>
                    <div class="flex items-center px-4 py-2 bg-green-100 rounded-full">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-sm font-semibold text-green-800">Zamówienie potwierdzone</span>
                    </div>
                </div>
                
                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Order Details -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Szczegóły zamówienia
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Numer zamówienia:</span>
                                <span class="font-bold text-gray-900 text-lg">#{{ strtoupper(substr(md5(time()), 0, 8)) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Data zamówienia:</span>
                                <span class="font-semibold text-gray-900">{{ now()->format('d.m.Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Status:</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Opłacone
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Metoda płatności:</span>
                                <span class="font-semibold text-gray-900">Karta kredytowa</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Twój produkt
                        </h3>
                        @if($project)
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                                    @if($project->artwork_file_path)
                                        <img src="{{ asset('storage/' . $project->artwork_file_path) }}" alt="Product" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-orange-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $project->labelMaterial->name ?? 'Custom Label' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $project->labelShape->name ?? 'Custom Shape' }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $project->getActualDimensions()['width'] ?? '50' }}×{{ $project->getActualDimensions()['height'] ?? '50' }}mm
                                    </p>
                                    @if($project->laminateOption)
                                        <p class="text-sm text-blue-600">Laminat: {{ $project->laminateOption->name }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Quantity Display -->
                            <div class="border-t pt-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Ilość</span>
                                    <span class="font-bold text-gray-900 text-lg">{{ $project->quantity ?? 1 }} sztuk</span>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    Cena za sztukę: {{ number_format(($project->calculated_price ?? 0) / ($project->quantity ?? 1), 2) }} zł
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="bg-orange-50 rounded-xl p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Całkowita kwota</h3>
                                <p class="text-sm text-gray-500">zawiera VAT 23%</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-orange-600">{{ number_format($project->calculated_price ?? 0, 2) }} zł</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 mb-8 border border-blue-200">
                <h3 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Co dalej?
                </h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-6 border border-blue-200">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mb-4">
                            <span class="text-white text-lg font-bold">1</span>
                        </div>
                        <h4 class="font-semibold text-blue-900 mb-2">Potwierdzenie e-mail</h4>
                        <p class="text-blue-700 text-sm">Wysłaliśmy potwierdzenie na Twój adres e-mail z numerem zamówienia</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-blue-200">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mb-4">
                            <span class="text-white text-lg font-bold">2</span>
                        </div>
                        <h4 class="font-semibold text-blue-900 mb-2">Przetwarzanie</h4>
                        <p class="text-blue-700 text-sm">Twoje etykiety będą przygotowane w ciągu 2-3 dni roboczych</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-blue-200">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mb-4">
                            <span class="text-white text-lg font-bold">3</span>
                        </div>
                        <h4 class="font-semibold text-blue-900 mb-2">Wysyłka</h4>
                        <p class="text-blue-700 text-sm">Otrzymasz numer śledzenia przesyłki i powiadomienie o wysyłce</p>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
                    </svg>
                    Potrzebujesz pomocy?
                </h3>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Kontakt
                        </h4>
                        <div class="space-y-2">
                            <p class="text-gray-600 text-sm flex items-center">
                                <svg class="w-4 h-4 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                support@custom-label.com
                            </p>
                            <p class="text-gray-600 text-sm flex items-center">
                                <svg class="w-4 h-4 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +48 123 456 789
                            </p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Godziny pracy
                        </h4>
                        <div class="space-y-2">
                            <p class="text-gray-600 text-sm">Poniedziałek - Piątek: 9:00 - 17:00</p>
                            <p class="text-gray-600 text-sm">Sobota: 10:00 - 14:00</p>
                            <p class="text-gray-500 text-xs mt-2">Odpowiadamy w ciągu 24h</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-semibold rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Wróć do strony głównej
                </a>
                <button onclick="window.print()" class="inline-flex items-center justify-center px-8 py-4 border border-gray-300 text-lg font-semibold rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Drukuj potwierdzenie
                </button>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .bg-gray-50 { background: white !important; }
            .shadow-lg { box-shadow: none !important; }
        }
    </style>
</x-layouts.app>
