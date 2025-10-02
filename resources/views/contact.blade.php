<x-layouts.app title="Kontakt - Custom Labels">
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
    <section class="bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-6">
                📞 Skontaktuj się z nami
            </h1>
            <p class="text-xl text-orange-100 max-w-3xl mx-auto">
                Masz pytania? Potrzebujesz pomocy? Nasz zespół jest gotowy, aby Ci pomóc w realizacji Twojego projektu!
            </p>
        </div>
    </section>

    <!-- Contact Info Cards -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <!-- Phone -->
                <div class="contact-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Telefon</h3>
                    <p class="text-gray-600 mb-4">Zadzwoń do nas w godzinach pracy</p>
                    <a href="tel:+48123456789" class="text-green-600 font-bold text-lg hover:text-green-700 transition-colors">
                        +48 123 456 789
                    </a>
                    <p class="text-sm text-gray-500 mt-2">Pn-Pt: 8:00-18:00</p>
                </div>

                <!-- Email -->
                <div class="contact-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Email</h3>
                    <p class="text-gray-600 mb-4">Napisz do nas w każdej chwili</p>
                    <a href="mailto:CustomLabelHelp@gmail.com" class="text-blue-600 font-bold text-lg hover:text-blue-700 transition-colors">
                        CustomLabelHelp@gmail.com
                    </a>
                    <p class="text-sm text-gray-500 mt-2">Odpowiadamy w 24h</p>
                </div>

                <!-- Address -->
                <div class="contact-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Adres</h3>
                    <p class="text-gray-600 mb-4">Nasze biuro i drukarnia</p>
                    <address class="text-purple-600 font-bold text-lg not-italic">
                        ul. Etykietowa 15<br>
                        00-001 Warszawa
                    </address>
                    <p class="text-sm text-gray-500 mt-2">Wizyta po umówieniu</p>
                </div>

                <!-- Working Hours -->
                <div class="contact-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Godziny pracy</h3>
                    <div class="text-gray-600 space-y-2">
                        <div class="flex justify-between">
                            <span>Poniedziałek - Piątek:</span>
                            <span class="font-bold text-orange-600">8:00 - 18:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sobota:</span>
                            <span class="font-bold text-orange-600">9:00 - 15:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Niedziela:</span>
                            <span class="text-gray-400">Zamknięte</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Map -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Wyślij wiadomość</h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Masz konkretne pytanie? Wypełnij formularz, a skontaktujemy się z Tobą w ciągu 24 godzin.
                    </p>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Imię *</label>
                                <input type="text" id="first_name" name="first_name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nazwisko *</label>
                                <input type="text" id="last_name" name="last_name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                        </div>

                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Firma</label>
                            <input type="text" id="company" name="company"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Temat *</label>
                            <select id="subject" name="subject" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                                <option value="">Wybierz temat</option>
                                <option value="quote">Wycena projektu</option>
                                <option value="technical">Pytanie techniczne</option>
                                <option value="materials">Materiały i opcje</option>
                                <option value="delivery">Dostawa i realizacja</option>
                                <option value="partnership">Współpraca biznesowa</option>
                                <option value="other">Inne</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Wiadomość *</label>
                            <textarea id="message" name="message" rows="6" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors resize-none"
                                      placeholder="Opisz swój projekt lub zadaj pytanie..."></textarea>
                        </div>

                        <div class="flex items-start">
                            <input type="checkbox" id="privacy" name="privacy" required
                                   class="mt-1 h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                            <label for="privacy" class="ml-3 text-sm text-gray-600">
                                Wyrażam zgodę na przetwarzanie moich danych osobowych zgodnie z 
                                <a href="#" class="text-orange-600 hover:text-orange-700 underline">polityką prywatności</a> *
                            </label>
                        </div>

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            📧 Wyślij wiadomość
                        </button>
                    </form>
                </div>

                <!-- Map & Additional Info -->
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Znajdź nas</h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Nasze biuro znajduje się w centrum Warszawy. Zapraszamy na wizytę po wcześniejszym umówieniu.
                    </p>

                    <!-- Google Maps -->
                    <div class="map-container mb-8 h-80 bg-gray-200 rounded-2xl overflow-hidden shadow-lg">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2443.4746834447043!2d21.01223431570486!3d52.22967797975687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecc669a869f01%3A0x72f0be2a65674de2!2sPalace%20of%20Culture%20and%20Science!5e0!3m2!1sen!2spl!4v1635789012345!5m2!1sen!2spl"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="rounded-2xl">
                        </iframe>
                        <div class="map-overlay">
                            <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 text-center">
                                <p class="text-gray-800 font-medium">Kliknij, aby otworzyć w Google Maps</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Contact -->
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Szybki kontakt</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Telefon</p>
                                    <a href="tel:+48123456789" class="text-orange-600 hover:text-orange-700">+48 123 456 789</a>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Email</p>
                                    <a href="mailto:CustomLabelHelp@gmail.com" class="text-orange-600 hover:text-orange-700">CustomLabelHelp@gmail.com</a>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Adres</p>
                                    <p class="text-orange-600">ul. Etykietowa 15, 00-001 Warszawa</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-orange-200">
                            <p class="text-sm text-gray-600 mb-4">
                                <strong>Pilny projekt?</strong> Zadzwoń bezpośrednio - jesteśmy dostępni również poza godzinami pracy dla ważnych projektów.
                            </p>
                            <div class="flex space-x-4">
                                <a href="tel:+48123456789" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-3 px-4 rounded-xl font-medium transition-colors">
                                    📞 Zadzwoń teraz
                                </a>
                                <a href="mailto:CustomLabelHelp@gmail.com" class="flex-1 bg-white border-2 border-orange-500 text-orange-600 hover:bg-orange-50 text-center py-3 px-4 rounded-xl font-medium transition-colors">
                                    ✉️ Napisz email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Często zadawane pytania</h2>
                <p class="text-xl text-gray-600">Znajdź odpowiedzi na najczęstsze pytania</p>
            </div>

            <div class="max-w-4xl mx-auto space-y-6">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition-colors">
                        <span class="text-lg font-medium text-gray-800">Jaki jest minimalny nakład zamówienia?</span>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-8 pb-6 text-gray-600">
                        Minimalny nakład to 50 sztuk etykiet. Dla większych nakładów oferujemy atrakcyjne rabaty.
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition-colors">
                        <span class="text-lg font-medium text-gray-800">Ile trwa realizacja zamówienia?</span>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-8 pb-6 text-gray-600">
                        Standardowa realizacja to 3-5 dni roboczych. Dla pilnych zamówień oferujemy ekspresową realizację w 24-48h.
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition-colors">
                        <span class="text-lg font-medium text-gray-800">Jakie materiały są dostępne?</span>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-8 pb-6 text-gray-600">
                        Oferujemy papier kraft, białą folię, folie specjalne oraz różne rodzaje laminatów (matowy, błyszczący, soft-touch).
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-gray-50 transition-colors">
                        <span class="text-lg font-medium text-gray-800">Czy mogę otrzymać próbki materiałów?</span>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-8 pb-6 text-gray-600">
                        Tak! Wysyłamy bezpłatne próbki materiałów. Skontaktuj się z nami, a prześlemy Ci katalog próbek.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-orange-500 to-orange-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Gotowy na współpracę?</h2>
            <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                Skontaktuj się z nami już dziś i rozpocznij swój projekt etykiet!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('creator') }}" class="inline-block bg-white text-orange-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors transform hover:scale-105">
                    🚀 Rozpocznij projekt
                </a>
                <a href="tel:+48123456789" class="inline-block border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-orange-600 transition-colors transform hover:scale-105">
                    📞 Zadzwoń teraz
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
