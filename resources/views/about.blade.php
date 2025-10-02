<x-layouts.app title="O nas - Custom Labels">
    @push('styles')
        <style>
            .timeline-container {
                position: relative;
                max-width: 1200px;
                margin: 0 auto;
            }
            .timeline-item {
                position: relative;
                margin-bottom: 80px;
                display: flex;
                align-items: center;
            }
            .timeline-item:nth-child(odd) {
                flex-direction: row;
            }
            .timeline-item:nth-child(even) {
                flex-direction: row-reverse;
            }
            .timeline-content {
                flex: 1;
                max-width: 45%;
                padding: 30px;
                background: white;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                position: relative;
            }
            .timeline-item:nth-child(odd) .timeline-content::after {
                content: '';
                position: absolute;
                right: -20px;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 0;
                border-left: 20px solid white;
                border-top: 15px solid transparent;
                border-bottom: 15px solid transparent;
            }
            .timeline-item:nth-child(even) .timeline-content::after {
                content: '';
                position: absolute;
                left: -20px;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 0;
                border-right: 20px solid white;
                border-top: 15px solid transparent;
                border-bottom: 15px solid transparent;
            }
            .timeline-center {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                background: linear-gradient(135deg, #f97316, #ea580c);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 18px;
                box-shadow: 0 0 0 8px white, 0 0 0 12px #f97316;
                z-index: 10;
                position: relative;
            }
            .timeline-photo {
                flex: 1;
                max-width: 45%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .photo-placeholder {
                width: 200px;
                height: 200px;
                border-radius: 20px;
                background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
                display: flex;
                align-items: center;
                justify-content: center;
                border: 3px dashed #d1d5db;
                color: #9ca3af;
                font-size: 14px;
                text-align: center;
                padding: 20px;
                transition: all 0.3s ease;
            }
            .photo-placeholder:hover {
                transform: scale(1.05);
                border-color: #f97316;
                color: #f97316;
                background: linear-gradient(135deg, #fed7aa, #fdba74);
            }
            .timeline-line {
                position: absolute;
                left: 50%;
                top: 0;
                bottom: 0;
                width: 4px;
                background: linear-gradient(to bottom, #f97316, #ea580c);
                transform: translateX(-50%);
                z-index: 1;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl font-bold mb-4">
                🗺️ Nasza Historia
            </h1>
            <p class="text-base text-orange-100 max-w-2xl mx-auto">
                Odkryj naszą drogę do sukcesu
            </p>
        </div>
    </section>

    <!-- Timeline - Mapa Skarbów -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="timeline-container">
                <div class="timeline-line"></div>
                
                <!-- 2020 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Początek przygody</h3>
                        <p class="text-gray-600 text-lg">
                            Custom Labels zostało założone przez zespół pasjonatów technologii i designu. Pierwsza drukarnia, pierwsi klienci, pierwsze sukcesy. Wszystko zaczęło się od prostego pomysłu - demokratyzacji procesu tworzenia etykiet.
                        </p>
                    </div>
                    <div class="timeline-center">2020</div>
                    <div class="timeline-photo">
                        <div class="photo-placeholder">
                            📸<br><br>
                            <strong>Zdjęcie założycieli</strong><br>
                            przy pierwszej drukarce<br><br>
                            <em>Michał & Anna<br>
                            w garażu w Warszawie</em>
                        </div>
                    </div>
                </div>

                <!-- 2021 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Pierwszy kreator online</h3>
                        <p class="text-gray-600 text-lg">
                            Uruchomiliśmy pierwszą wersję naszego kreatora online. Klienci mogli już projektować etykiety w przeglądarce! To był przełom - żadna inna firma w Polsce nie oferowała takiego rozwiązania.
                        </p>
                    </div>
                    <div class="timeline-center">2021</div>
                    <div class="timeline-photo">
                        <div class="photo-placeholder">
                            💻<br><br>
                            <strong>Screenshot</strong><br>
                            pierwszego kreatora online<br><br>
                            <em>Piotr przy komputerze<br>
                            kodujący interfejs</em>
                        </div>
                    </div>
                </div>

                <!-- 2022 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Rozszerzenie oferty</h3>
                        <p class="text-gray-600 text-lg">
                            Dodaliśmy nowe materiały: papier kraft, folie specjalne, laminaty premium. Nasz zespół urósł do 10 osób. Rozpoczęliśmy współpracę z największymi markami w Polsce.
                        </p>
                    </div>
                    <div class="timeline-center">2022</div>
                    <div class="timeline-photo">
                        <div class="photo-placeholder">
                            🏭<br><br>
                            <strong>Zdjęcie nowej drukarni</strong><br>
                            i całego zespołu<br><br>
                            <em>10 osób przed<br>
                            nowymi maszynami</em>
                        </div>
                    </div>
                </div>

                <!-- 2023 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Innowacje technologiczne</h3>
                        <p class="text-gray-600 text-lg">
                            Wprowadziliśmy zaawansowane technologie druku, AR preview i automatyzację procesów. Nasz kreator stał się najbardziej zaawansowanym narzędziem w branży.
                        </p>
                    </div>
                    <div class="timeline-center">2023</div>
                    <div class="timeline-photo">
                        <div class="photo-placeholder">
                            🚀<br><br>
                            <strong>Zdjęcie nowych</strong><br>
                            maszyn drukarskich<br><br>
                            <em>Kamil testujący<br>
                            AR preview</em>
                        </div>
                    </div>
                </div>

                <!-- 2024 -->
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">AI i przyszłość</h3>
                        <p class="text-gray-600 text-lg">
                            Wprowadziliśmy asystenta AI, który pomaga klientom w projektowaniu. Planujemy ekspansję międzynarodową i dalsze innowacje w obszarze personalizacji etykiet.
                        </p>
                    </div>
                    <div class="timeline-center">2024</div>
                    <div class="timeline-photo">
                        <div class="photo-placeholder">
                            🤖<br><br>
                            <strong>Zdjęcie zespołu</strong><br>
                            z AI asystentem<br><br>
                            <em>Magdalena & Tomasz<br>
                            testujący GROQ AI</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-orange-500 to-orange-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Dołącz do naszej historii sukcesu</h2>
            <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                Stwórzmy razem etykiety, które wyróżnią Twój produkt na rynku!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('label.creator') }}" class="inline-block bg-white text-orange-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors transform hover:scale-105">
                    🚀 Rozpocznij projekt
                </a>
                <a href="{{ route('contact') }}" class="inline-block border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-orange-600 transition-colors transform hover:scale-105">
                    📞 Skontaktuj się z nami
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>