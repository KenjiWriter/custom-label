<x-layouts.app title="O nas - Custom Labels">
    @push('styles')
        <style>
            .team-card {
                transition: all 0.3s ease;
            }
            .team-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            }
            .timeline-item {
                position: relative;
            }
            .timeline-item::before {
                content: '';
                position: absolute;
                left: 20px;
                top: 0;
                bottom: 0;
                width: 2px;
                background: linear-gradient(to bottom, #f97316, #ea580c);
            }
            .timeline-dot {
                position: absolute;
                left: 12px;
                top: 24px;
                width: 18px;
                height: 18px;
                background: #f97316;
                border-radius: 50%;
                border: 3px solid white;
                box-shadow: 0 0 0 3px #f97316;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 text-white py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-6">
                        O Custom Labels
                    </h1>
                    <p class="text-xl text-orange-100 mb-8">
                        Jesteśmy polską firmą, która od 2020 roku tworzy najwyższej jakości etykiety dla biznesów z całego kraju. Nasza pasja to łączenie technologii z kreatywnością.
                    </p>
                    <div class="flex flex-wrap gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold">4+</div>
                            <div class="text-orange-200">Lata doświadczenia</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">500+</div>
                            <div class="text-orange-200">Projektów</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">200+</div>
                            <div class="text-orange-200">Klientów</div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/20">
                        <div class="text-6xl mb-4">🏷️</div>
                        <h3 class="text-2xl font-bold mb-4">Nasza Misja</h3>
                        <p class="text-orange-100">
                            Pomagamy markom wyróżnić się na rynku poprzez tworzenie unikalnych, wysokiej jakości etykiet, które opowiadają historię każdego produktu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Story -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Nasza Historia</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Od małego startupu do lidera w branży etykiet - poznaj naszą drogę do sukcesu
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <!-- Timeline -->
                <div class="space-y-12">
                    <!-- 2020 -->
                    <div class="timeline-item pl-16 relative">
                        <div class="timeline-dot"></div>
                        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="bg-orange-500 text-white px-4 py-2 rounded-full font-bold">2020</span>
                                <h3 class="text-2xl font-bold text-gray-800">Początek przygody</h3>
                            </div>
                            <p class="text-gray-600 text-lg">
                                Custom Labels zostało założone przez zespół pasjonatów technologii i designu. Pierwsza drukarnia, pierwsi klienci, pierwsze sukcesy. Wszystko zaczęło się od prostego pomysłu - demokratyzacji procesu tworzenia etykiet.
                            </p>
                        </div>
                    </div>

                    <!-- 2021 -->
                    <div class="timeline-item pl-16 relative">
                        <div class="timeline-dot"></div>
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="bg-blue-500 text-white px-4 py-2 rounded-full font-bold">2021</span>
                                <h3 class="text-2xl font-bold text-gray-800">Pierwszy kreator online</h3>
                            </div>
                            <p class="text-gray-600 text-lg">
                                Uruchomiliśmy pierwszą wersję naszego kreatora online. Klienci mogli już projektować etykiety w przeglądarce! To był przełom - żadna inna firma w Polsce nie oferowała takiego rozwiązania.
                            </p>
                        </div>
                    </div>

                    <!-- 2022 -->
                    <div class="timeline-item pl-16 relative">
                        <div class="timeline-dot"></div>
                        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="bg-green-500 text-white px-4 py-2 rounded-full font-bold">2022</span>
                                <h3 class="text-2xl font-bold text-gray-800">Rozszerzenie oferty</h3>
                            </div>
                            <p class="text-gray-600 text-lg">
                                Dodaliśmy nowe materiały: papier kraft, folie specjalne, laminaty premium. Nasz zespół urósł do 10 osób. Rozpoczęliśmy współpracę z największymi markami w Polsce.
                            </p>
                        </div>
                    </div>

                    <!-- 2023 -->
                    <div class="timeline-item pl-16 relative">
                        <div class="timeline-dot"></div>
                        <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="bg-purple-500 text-white px-4 py-2 rounded-full font-bold">2023</span>
                                <h3 class="text-2xl font-bold text-gray-800">Innowacje technologiczne</h3>
                            </div>
                            <p class="text-gray-600 text-lg">
                                Wprowadziliśmy zaawansowane technologie druku, AR preview i automatyzację procesów. Nasz kreator stał się najbardziej zaawansowanym narzędziem w branży.
                            </p>
                        </div>
                    </div>

                    <!-- 2024 -->
                    <div class="timeline-item pl-16 relative">
                        <div class="timeline-dot"></div>
                        <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-2xl p-8">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="bg-orange-500 text-white px-4 py-2 rounded-full font-bold">2024</span>
                                <h3 class="text-2xl font-bold text-gray-800">AI i przyszłość</h3>
                            </div>
                            <p class="text-gray-600 text-lg">
                                Wprowadziliśmy asystenta AI, który pomaga klientom w projektowaniu. Planujemy ekspansję międzynarodową i dalsze innowacje w obszarze personalizacji etykiet.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Nasz Zespół</h2>
                <p class="text-xl text-gray-600">Poznaj ludzi, którzy tworzą Custom Labels</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- CEO -->
                <div class="team-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        MK
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Michał Kowalski</h3>
                    <p class="text-orange-600 font-medium mb-4">CEO & Założyciel</p>
                    <p class="text-gray-600 mb-6">
                        Wizjoner i lider zespołu. Od 10 lat w branży druku, pasjonat nowych technologii i innowacji.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- CTO -->
                <div class="team-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        AN
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Anna Nowak</h3>
                    <p class="text-blue-600 font-medium mb-4">CTO & Head of Development</p>
                    <p class="text-gray-600 mb-6">
                        Architekt naszych systemów. Ekspert w Laravel, React i technologiach chmurowych. Tworzy kreator etykiet.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Head of Design -->
                <div class="team-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        PW
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Piotr Wiśniewski</h3>
                    <p class="text-green-600 font-medium mb-4">Head of Design</p>
                    <p class="text-gray-600 mb-6">
                        Kreator wizualny naszej marki. Odpowiada za UX/UI kreatora i wszystkie aspekty designu produktów.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-green-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-green-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Lead Developer -->
                <div class="team-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-24 h-24 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        KL
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Kamil Lewandowski</h3>
                    <p class="text-purple-600 font-medium mb-4">Lead Developer</p>
                    <p class="text-gray-600 mb-6">
                        Główny programista aplikacji. Specjalista od Livewire, Alpine.js i optymalizacji wydajności.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-purple-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-purple-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Marketing Manager -->
                <div class="team-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-24 h-24 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        MZ
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Magdalena Zielińska</h3>
                    <p class="text-pink-600 font-medium mb-4">Marketing Manager</p>
                    <p class="text-gray-600 mb-6">
                        Odpowiada za komunikację z klientami, content marketing i rozwój marki Custom Labels.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Customer Success -->
                <div class="team-card bg-white rounded-2xl p-8 text-center shadow-lg">
                    <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        TK
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tomasz Kaczmarek</h3>
                    <p class="text-yellow-600 font-medium mb-4">Customer Success</p>
                    <p class="text-gray-600 mb-6">
                        Dba o zadowolenie klientów, obsługuje wsparcie techniczne i pomaga w realizacji projektów.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-yellow-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="mailto:CustomLabelHelp@gmail.com" class="text-gray-400 hover:text-yellow-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M0 3v18h24v-18h-24zm21.518 2l-9.518 7.713-9.518-7.713h19.036zm-19.518 14v-11.817l10 8.104 10-8.104v11.817h-20z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Nasze Wartości</h2>
                <p class="text-xl text-gray-600">Zasady, którymi kierujemy się każdego dnia</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Jakość</h3>
                    <p class="text-gray-600">
                        Każda etykieta to dzieło sztuki. Używamy najlepszych materiałów i najnowszych technologii.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Szybkość</h3>
                    <p class="text-gray-600">
                        Realizujemy zamówienia w 3-5 dni roboczych. Twój biznes nie może czekać.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Pasja</h3>
                    <p class="text-gray-600">
                        Kochamy to, co robimy. Każdy projekt traktujemy jak własny sukces.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Innowacje</h3>
                    <p class="text-gray-600">
                        Ciągle rozwijamy nasze technologie. AI, automatyzacja, nowe materiały - to nasza przyszłość.
                    </p>
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
                <a href="{{ route('creator') }}" class="inline-block bg-white text-orange-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-colors transform hover:scale-105">
                    🚀 Rozpocznij projekt
                </a>
                <a href="{{ route('contact') }}" class="inline-block border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-orange-600 transition-colors transform hover:scale-105">
                    📞 Skontaktuj się z nami
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
