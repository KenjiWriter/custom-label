<x-layouts.app title="{{ __('messages.nav.contact') }} - Custom Labels">
    @push('styles')
        <style>
            .contact-card {
                transition: all 0.3s ease;
            }
            .contact-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
            .map-container {
                position: relative;
                overflow: hidden;
                border-radius: 1rem;
            }
            .map-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .map-container:hover .map-overlay {
                opacity: 1;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl font-bold mb-3">
                📞 {{ __('messages.contact.title') }}
            </h1>
            <p class="text-base text-orange-100">
                {{ __('messages.contact.subtitle') }}
            </p>
        </div>
    </section>

    <!-- Compact Contact Info Cards -->
    <section class="py-3 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2">
                <!-- Phone -->
                <div class="bg-white rounded-lg shadow p-2 text-center hover:shadow-lg transition-shadow">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center mx-auto mb-1">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-800 mb-1">{{ __('messages.contact.cards.phone') }}</h3>
                    <a href="tel:+48123456789" class="text-green-600 font-semibold text-xs hover:text-green-700">+48 123 456 789</a>
                </div>

                <!-- Email -->
                <div class="bg-white rounded-lg shadow p-2 text-center hover:shadow-lg transition-shadow">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center mx-auto mb-1">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-800 mb-1">{{ __('messages.contact.cards.email') }}</h3>
                    <a href="mailto:CustomLabelHelps@gmail.com" class="text-blue-600 font-semibold text-xs hover:text-blue-700 block">CustomLabelHelps@gmail.com</a>
                </div>

                <!-- Address -->
                <div class="bg-white rounded-lg shadow p-2 text-center hover:shadow-lg transition-shadow">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center mx-auto mb-1">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-800 mb-1">{{ __('messages.contact.cards.address') }}</h3>
                    <p class="text-purple-600 font-semibold text-xs">ul. Etykietowa 15, Warszawa</p>
                </div>

                <!-- Working Hours -->
                <div class="bg-white rounded-lg shadow p-2 text-center hover:shadow-lg transition-shadow">
                    <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center mx-auto mb-1">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-gray-800 mb-1">{{ __('messages.contact.cards.hours') }}</h3>
                    <p class="text-orange-600 font-semibold text-xs">Pn-Pt: 8-18</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Compact Contact Form & Map -->
    <section class="py-6 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Compact Contact Form -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ __('messages.contact.form.title') }}</h2>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ __('messages.contact.form.subtitle') }}
                    </p>

                    @livewire('contact-form')
                </div>

                <!-- Compact Map & Info -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ __('messages.contact.map.title') }}</h2>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ __('messages.contact.map.subtitle') }}
                    </p>

                    <!-- Compact Google Maps -->
                    <div class="h-64 bg-gray-200 rounded-lg overflow-hidden shadow-lg">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2443.4746834447043!2d21.01223431570486!3d52.22967797975687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecc669a869f01%3A0x72f0be2a65674de2!2sPalace%20of%20Culture%20and%20Science!5e0!3m2!1sen!2spl!4v1635789012345!5m2!1sen!2spl"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            class="rounded-lg">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
