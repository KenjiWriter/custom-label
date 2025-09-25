<x-layouts.app title="Podgląd 3D etykiety - {{ $project->uuid }}">

    <div class="py-8">
        <!-- Header -->
        <div class="mb-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-gray-700" wire:navigate>Kreator</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span>Podgląd 3D</span>
            </nav>

            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Podgląd Twojej etykiety
            </h1>
            <p class="text-gray-600">
                Sprawdź jak będzie wyglądać Twoja etykieta przed zamówieniem. Możesz ją obracać i powiększać.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- 3D Preview -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            Podgląd 3D
                        </h2>
                        <p class="text-gray-600 text-sm">
                            Użyj myszki aby obracać etykietę. Kółko myszy do powiększania/pomniejszania.
                        </p>
                        <button id="toggleRotationBtn"
                            style="
    background-color: #FF6600;
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    box-shadow: 0 2px 8px rgba(255,106,0,0.1);
    cursor: pointer;
    margin-top: 18px;
    transition: background-color 0.2s;
">
                            Zatrzymaj obrót
                        </button>

                    </div>

                    <!-- 3D Canvas Container -->
                    <div class="relative bg-gradient-to-br from-gray-50 to-gray-100" style="height: 500px;">
                        <div id="label-3d-preview" class="w-full h-full"></div>

                        <!-- Loading State -->
                        <div id="preview-loading" class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div
                                    class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-600 mx-auto mb-4">
                                </div>
                                <p class="text-gray-600">Ładowanie podglądu 3D...</p>
                            </div>
                        </div>

                        <!-- 2D FALLBACK - ZAWSZE GOTOWY -->
                        <div id="preview-error" class="absolute inset-0 items-center justify-center hidden">
                            <div class="text-center p-8">
                                <div
                                    class="bg-yellow-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Podgląd 3D niedostępny</h3>
                                <p class="text-gray-600 mb-4">Wyświetlamy podgląd 2D Twojej etykiety</p>

                                <!-- 2D Fallback Preview -->
                                <div
                                    class="bg-white border-2 border-dashed border-orange-300 rounded-xl p-8 max-w-md mx-auto">
                                    <div class="text-center">
                                        @php
                                            $dimensions = $project->getActualDimensions();

                                            // WIĘKSZY ROZMIAR PREVIEW
                                            $baseSize = 200; // ZWIĘKSZONE z 150 do 200px
                                            $ratio = $dimensions['width'] / $dimensions['height'];

                                            if ($ratio > 1) {
                                                // Szerszy niż wyższy
                                                $previewWidth = min($baseSize * 2.5, 350);
                                                $previewHeight = $previewWidth / $ratio;
                                            } else {
                                                // Wyższy niż szerszy lub kwadrat
                                                $previewHeight = min($baseSize * 2, 280);
                                                $previewWidth = $previewHeight * $ratio;
                                            }

                                            // Jeszcze więcej zwiększamy dla dużych wymiarów
                                            if ($dimensions['width'] > 100 || $dimensions['height'] > 100) {
                                                $previewWidth *= 1.5;
                                                $previewHeight *= 1.5;
                                            }

                                            // NAPRAWIONE KOLORY MATERIAŁÓW - DOPASOWANE DO SLUG
                                            $materialColors = [
                                                'paper-white-matte' => 'from-white to-gray-50 border-gray-300',
                                                'paper-white-glossy' => 'from-white to-blue-50 border-blue-300',
                                                'paper-cream' => 'from-amber-50 to-amber-100 border-amber-400',
                                                'foil-silver' => 'from-gray-300 to-gray-500 border-gray-600',
                                                'foil-gold' => 'from-yellow-400 to-yellow-600 border-yellow-700', // ZŁOTA FOLIA!
                                                'paper-waterproof' => 'from-blue-50 to-blue-100 border-blue-400',
                                                // Fallbacks dla starych slug-ów
                                                'folia-zlota' => 'from-yellow-400 to-yellow-600 border-yellow-700',
                                                'folia-srebrna' => 'from-gray-300 to-gray-500 border-gray-600',
                                            ];

                                            $materialSlug = $project->labelMaterial->slug ?? 'paper-white-matte';
                                            $materialColor =
                                                $materialColors[$materialSlug] ??
                                                'from-gray-100 to-gray-200 border-gray-300';

                                            // MOCNIEJSZE efekty dla różnych materiałów
                                            $materialEffects = 'shadow-2xl';
                                            if (
                                                str_contains($materialSlug, 'glossy') ||
                                                str_contains($materialSlug, 'foil')
                                            ) {
                                                $materialEffects .=
                                                    ' transform hover:scale-110 transition-all duration-500';
                                            }
                                            if (
                                                str_contains($materialSlug, 'gold') ||
                                                str_contains($materialSlug, 'zlota')
                                            ) {
                                                $materialEffects .= ' animate-pulse';
                                            }

                                            // Border radius dla kształtów
                                            $shapeClass = '';
                                            $shape = $project->labelShape->slug ?? 'rectangle';

                                            switch ($shape) {
                                                case 'circle':
                                                    $shapeClass = 'rounded-full';
                                                    $size = max($previewWidth, $previewHeight);
                                                    $previewWidth = $size;
                                                    $previewHeight = $size;
                                                    break;
                                                case 'oval':
                                                    $shapeClass = 'rounded-full';
                                                    break;
                                                case 'square':
                                                    $shapeClass = 'rounded-2xl';
                                                    $size = max($previewWidth, $previewHeight);
                                                    $previewWidth = $size;
                                                    $previewHeight = $size;
                                                    break;
                                                case 'rectangle':
                                                    $shapeClass = 'rounded-2xl';
                                                    break;
                                                case 'star':
                                                    $shapeClass = 'rounded-2xl relative overflow-hidden';
                                                    break;
                                                default:
                                                    $shapeClass = 'rounded-2xl';
                                            }
                                        @endphp


                                        <!-- DUŻA ZŁOTA OWALNA ETYKIETA -->
                                        <div class="relative mx-auto {{ $materialEffects }}"
                                            style="width: {{ $previewWidth }}px; height: {{ $previewHeight }}px;">

                                            <!-- Główna etykieta -->
                                            <div class="w-full h-full bg-gradient-to-br {{ $materialColor }} border-8 {{ $shapeClass }} flex items-center justify-center relative overflow-hidden"
                                                style="box-shadow: 0 30px 60px rgba(0,0,0,0.3);">

                                                <!-- MOCNY efekt błyszczący dla folii -->
                                                @if (str_contains($materialSlug, 'foil') ||
                                                        str_contains($materialSlug, 'glossy') ||
                                                        str_contains($materialSlug, 'folia'))
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-tr from-transparent via-white to-transparent opacity-50 transform -skew-x-12">
                                                    </div>
                                                    <div
                                                        class="absolute top-6 left-6 w-16 h-16 bg-white rounded-full opacity-70 blur-lg">
                                                    </div>
                                                    <div
                                                        class="absolute bottom-8 right-8 w-10 h-10 bg-white rounded-full opacity-50 blur-md">
                                                    </div>
                                                @endif

                                                <!-- MOCNY efekt metaliczny dla złotej/srebrnej folii -->
                                                @if (str_contains($materialSlug, 'gold') ||
                                                        str_contains($materialSlug, 'silver') ||
                                                        str_contains($materialSlug, 'zlota') ||
                                                        str_contains($materialSlug, 'srebrna'))
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-br from-white to-transparent opacity-40">
                                                    </div>
                                                    <div
                                                        class="absolute top-8 right-8 w-12 h-12 bg-white rounded-full opacity-60 blur-xl">
                                                    </div>
                                                    <div
                                                        class="absolute bottom-6 left-6 w-8 h-8 bg-white rounded-full opacity-50 blur-lg">
                                                    </div>
                                                    <!-- DODATKOWE ZŁOTE REFLEKSY -->
                                                    <div
                                                        class="absolute top-1/3 left-1/4 w-6 h-6 bg-yellow-200 rounded-full opacity-40 blur-md">
                                                    </div>
                                                    <div
                                                        class="absolute bottom-1/3 right-1/4 w-4 h-4 bg-yellow-300 rounded-full opacity-30 blur-sm">
                                                    </div>
                                                @endif

                                                <!-- Gwiazda SVG dla kształtu gwiazdy -->
                                                @if ($shape === 'star')
                                                    <svg class="absolute inset-0 w-full h-full text-current opacity-25"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                    </svg>
                                                @endif

                                                <!-- WIĘKSZY tekst -->
                                                <div class="text-center z-10 p-6">
                                                    <div class="text-xl font-bold text-gray-800 opacity-90 mb-3">
                                                        {{ $project->labelMaterial->name }}
                                                    </div>
                                                    <div class="text-lg text-gray-700 opacity-70">
                                                        {{ $project->labelShape->name }}
                                                    </div>
                                                    <div class="text-md text-gray-600 opacity-70 mt-2">
                                                        {{ $dimensions['width'] }}×{{ $dimensions['height'] }}mm
                                                    </div>
                                                </div>

                                                <!-- Tekstura dla papieru -->
                                                @if (str_contains($materialSlug, 'paper'))
                                                    <div class="absolute inset-0 opacity-20">
                                                        <div class="w-full h-full"
                                                            style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%228%22 height=%228%22 viewBox=%220 0 8 8%22><path fill=%22%23000%22 fill-opacity=%22.4%22 d=%22M1 7h1v1H1V7zm4-4h1v1H5V3z%22></path></svg>');">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- MOCNIEJSZY efekt laminatu -->
                                            @if ($project->laminateOption)
                                                <div
                                                    class="absolute inset-0 {{ $shapeClass }} border-6 border-blue-500 bg-gradient-to-br from-blue-200 to-transparent opacity-60 pointer-events-none">
                                                    <!-- WIĘKSZE refleksy laminatu -->
                                                    <div
                                                        class="absolute top-6 left-6 w-16 h-16 bg-white rounded-full opacity-80 blur-xl">
                                                    </div>
                                                    <div
                                                        class="absolute bottom-8 right-8 w-12 h-12 bg-white rounded-full opacity-60 blur-lg">
                                                    </div>
                                                    <div
                                                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-white rounded-full opacity-50 blur-md">
                                                    </div>
                                                </div>

                                                <!-- WIĘKSZA etykieta laminatu -->
                                                <div
                                                    class="absolute -top-6 -right-6 bg-blue-600 text-white text-lg px-6 py-3 rounded-full font-bold shadow-2xl z-20">
                                                    LAMINAT
                                                </div>
                                            @endif

                                            <!-- WIĘKSZA ikona materiału -->
                                            <div
                                                class="absolute bottom-4 left-4 w-12 h-12 rounded-full bg-black bg-opacity-30 flex items-center justify-center text-2xl">
                                                @if (str_contains($materialSlug, 'paper'))
                                                    📄
                                                @elseif(str_contains($materialSlug, 'foil') || str_contains($materialSlug, 'folia'))
                                                    ✨
                                                @else
                                                    📋
                                                @endif
                                            </div>

                                            <!-- WIĘKSZA informacja o ilości -->
                                            <div
                                                class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-lg px-6 py-3 rounded-full whitespace-nowrap shadow-xl">
                                                {{ number_format($project->quantity) }} szt.
                                            </div>
                                        </div>

                                        <!-- WIĘKSZE informacje dodatkowe -->
                                        <div class="mt-20 text-lg text-gray-600 space-y-4">
                                            <div class="font-bold text-gray-900 text-3xl">
                                                {{ $project->labelShape->name }}</div>
                                            <div class="flex flex-wrap justify-center gap-4 mt-8">
                                                <span class="bg-gray-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    📐 {{ $dimensions['width'] }}×{{ $dimensions['height'] }}mm
                                                </span>
                                                <span class="bg-yellow-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    🎨 {{ $project->labelMaterial->name }}
                                                </span>
                                                @if ($project->laminateOption)
                                                    <span
                                                        class="bg-blue-100 px-6 py-3 rounded-full text-lg font-medium">
                                                        🛡️ {{ $project->laminateOption->name }}
                                                    </span>
                                                @endif
                                                <span class="bg-orange-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    📦 {{ number_format($project->quantity) }} szt.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontener 2D do pozycjonowania -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pozycjonowanie obrazka</h3>
                    
                        <!-- Profesjonalny kontener 2D do przeciągania -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200 overflow-hidden flex items-center justify-center shadow-lg transform transition-all duration-300 hover:shadow-xl hover:scale-[1.02] relative h-[320px] mb-6">
                            <div class="relative w-full h-full min-h-[220px] flex items-center justify-center">
                                <div id="positioning-container" class="absolute inset-0 bg-checkerboard flex items-center justify-center cursor-move rounded-lg">
                                    <!-- Kształt etykiety do pozycjonowania -->
                                    <div id="label-preview-2d" class="relative">
                                        <!-- Domyślny kształt prostokąta -->
                                        <div class="shadow-xl border-2 border-gray-300 bg-white rounded-xl transition-all duration-300 hover:shadow-2xl" 
                                             style="width: 150px; height: 100px;">
                                        </div>
                                    </div>
                                    
                                    <!-- Obrazek do pozycjonowania -->
                                    <img id="positioning-image" src="" alt="Obrazek do pozycjonowania" 
                                         class="absolute transform-gpu transition-all duration-300 opacity-95 hover:opacity-100 cursor-move"
                                         style="display: none; left: 50%; top: 50%; transform: translate(-50%, -50%); object-fit: contain; max-width: 90%; max-height: 90%;"
                                         onerror="this.onerror=null; this.src='/images/placeholder-image.png';">
                                </div>
                            </div>
                        </div>
                    
                    <!-- Profesjonalny panel kontrolny -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                    </svg>
                                    Pozycja X: <span id="posX-display" class="text-blue-600 font-bold">50%</span>
                                </label>
                                <input type="range" id="posX-slider" min="0" max="100" step="0.1" value="50" 
                                       class="w-full h-3 bg-gradient-to-r from-blue-100 to-blue-200 rounded-full appearance-none cursor-pointer hover:from-blue-200 hover:to-blue-300 transition-all duration-200">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                    </svg>
                                    Pozycja Y: <span id="posY-display" class="text-green-600 font-bold">50%</span>
                                </label>
                                <input type="range" id="posY-slider" min="0" max="100" step="0.1" value="50" 
                                       class="w-full h-3 bg-gradient-to-r from-green-100 to-green-200 rounded-full appearance-none cursor-pointer hover:from-green-200 hover:to-green-300 transition-all duration-200">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                    </svg>
                                    Skala: <span id="scale-display" class="text-purple-600 font-bold">100%</span>
                                </label>
                                <input type="range" id="scale-slider" min="20" max="200" step="1" value="100" 
                                       class="w-full h-3 bg-gradient-to-r from-purple-100 to-purple-200 rounded-full appearance-none cursor-pointer hover:from-purple-200 hover:to-purple-300 transition-all duration-200">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Obrót: <span id="rotation-display" class="text-orange-600 font-bold">0°</span>
                                </label>
                                <input type="range" id="rotation-slider" min="0" max="360" step="1" value="0" 
                                       class="w-full h-3 bg-gradient-to-r from-orange-100 to-orange-200 rounded-full appearance-none cursor-pointer hover:from-orange-200 hover:to-orange-300 transition-all duration-200">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <button id="reset-position-btn" class="px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset
                            </button>
                            <button id="center-position-btn" class="px-4 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                                Środek
                            </button>
                            <button id="fit-image-btn" class="px-4 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg>
                                Fit
                            </button>
                            <button id="fill-image-btn" class="px-4 py-3 bg-purple-500 text-white rounded-xl hover:bg-purple-600 transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                                </svg>
                                Wypełnij
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Details -->
            <div class="space-y-6">
                <!-- Configuration -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Konfiguracja</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kształt:</span>
                            <span class="font-medium">{{ $project->labelShape->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Materiał:</span>
                            <span class="font-medium">{{ $project->labelMaterial->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Wymiary:</span>
                            <span
                                class="font-medium">{{ $project->getActualDimensions()['width'] }}×{{ $project->getActualDimensions()['height'] }}mm</span>
                        </div>
                        @if ($project->laminateOption)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Laminat:</span>
                                <span class="font-medium">{{ $project->laminateOption->name }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ilość:</span>
                            <span class="font-medium">{{ number_format($project->quantity) }} szt.</span>
                        </div>
                    </div>
                </div>

                <!-- Price -->
                <div
                    class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl shadow-lg p-6 border border-orange-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Cena</h3>
                    <div class="text-3xl font-bold text-orange-600">
                        {{ number_format($project->calculated_price, 2) }} zł
                    </div>
                    <p class="text-sm text-gray-600 mt-1">z VAT</p>
                </div>

                <!-- Actions -->
                <div class="space-y-3">

                    <button id="goToCheckoutBtn"
                        class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105">
                        Przejdź do płatności
                    </button>

                    <!-- Przycisk do odświeżania obrazka -->
                    <button onclick="window.reloadArtwork()"
                        class="w-full bg-blue-100 hover:bg-blue-200 text-blue-700 py-3 rounded-xl font-medium text-center transition-colors mb-3">
                        Odśwież obrazek
                    </button>

                    <!-- Zamieniony link na button z ID dla lepszej obsługi JavaScript -->
                    <button id="backToCreator"
                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-medium text-center transition-colors">
                        Wróć do kreatora
                    </button>
                </div>

                <!-- Trust Indicators -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center space-x-2 mb-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.40A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        <span class="font-medium text-gray-900">Bezpieczna płatność</span>
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <div>✓ Szyfrowana transmisja danych</div>
                        <div>✓ Gwarancja jakości</div>
                        <div>✓ Możliwość zwrotu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            const toggleRotationBtn = document.getElementById('toggleRotationBtn');
            toggleRotationBtn.addEventListener('click', () => {
                rotationEnabled = !rotationEnabled;
                toggleRotationBtn.textContent = rotationEnabled ? "Zatrzymaj obrót" : "Wznów obrót";
                toggleRotationBtn.style.backgroundColor = rotationEnabled ? "#FF6600" : "#888888";
            });

            // Rozszerzona obsługa powrotu do kreatora z podglądu 3D
            document.addEventListener('DOMContentLoaded', function() {
                // 1. Zapisz dane projektu w localStorage
                const projectId = '{{ $project->id }}';
                localStorage.setItem('saved_project_id', projectId);
                localStorage.setItem('saved_step', '4');
                localStorage.setItem('saved_shape', '{{ $project->label_shape_id }}');
                localStorage.setItem('saved_material', '{{ $project->label_material_id }}');
                localStorage.setItem('saved_quantity', '{{ $project->quantity }}');

                // Zapisz wymiary
                @if ($project->predefined_size_id)
                    localStorage.setItem('saved_size_type', 'predefined');
                    localStorage.setItem('saved_predefined_size', '{{ $project->predefined_size_id }}');
                @else
                    localStorage.setItem('saved_size_type', 'custom');
                    localStorage.setItem('saved_width', '{{ $dimensions['width'] }}');
                    localStorage.setItem('saved_height', '{{ $dimensions['height'] }}');
                @endif

                // Zapisz laminat jeśli istnieje
                @if ($project->laminateOption)
                    localStorage.setItem('saved_laminate', '{{ $project->laminate_option_id }}');
                @else
                    localStorage.removeItem('saved_laminate');
                @endif

                // Zapisz dane pozycjonowania obrazu jeśli istnieją
                @if (isset($project->image_position_x))
                    localStorage.setItem('saved_image_position_x', '{{ $project->image_position_x }}');
                    localStorage.setItem('saved_image_position_y', '{{ $project->image_position_y }}');
                    localStorage.setItem('saved_image_scale', '{{ $project->image_scale }}');
                    localStorage.setItem('saved_image_rotation', '{{ $project->image_rotation }}');
                @endif

                // 2. Obsługa przycisku powrotu do kreatora
                document.getElementById('backToCreator').addEventListener('click', function(e) {
                    e.preventDefault();
                    goBackToCreator();
                });

                // 3. Zabezpieczenie przed utratą danych przy użyciu przycisku wstecz przeglądarki
                window.history.pushState({
                    page: 'preview',
                    projectId: projectId
                }, '', window.location.href);

                window.addEventListener('popstate', function(event) {
                    // Przekieruj na kreator z zachowaniem parametrów
                    goBackToCreator();
                    // Zapobiegaj standardowej nawigacji
                    history.pushState(null, '', window.location.href);
                });

                // Event listener dla synchronizacji z 2D kreatorem
                window.addEventListener('storage', (event) => {
                    if (event.key === 'imagePosition' && event.newValue) {
                        try {
                            const newPos = JSON.parse(event.newValue);
                            if (newPos) {
                                projectConfig.imagePosition = newPos;
                                if (scene && faceMesh) {
                                    scene.remove(faceMesh);
                                    const shape = createLabelShape(projectConfig.shape, projectConfig.dimensions
                                        .width, projectConfig.dimensions.height);
                                    addArtworkToLabel(shape, 2);
                                    console.log('✔ Zaktualizowano obraz 3D z nową pozycją (storage event)');
                                }
                            }
                        } catch (e) {
                            console.error('Błąd parsowania imagePosition:', e);
                        }
                    }
                });

                // NOWY: Event listener dla bezpośredniej synchronizacji w czasie rzeczywistym
                window.addEventListener('imagePositionChanged', (event) => {
                    console.log('🔔 OTRZYMANO EVENT imagePositionChanged:', event);
                    try {
                        const newPos = event.detail;
                        console.log('📊 Szczegóły eventu:', {detail: newPos, type: event.type});
                        if (newPos) {
                            projectConfig.imagePosition = newPos;
                            console.log('🔄 Otrzymano nową pozycję:', newPos);
                            
                            if (scene && faceMesh) {
                                scene.remove(faceMesh);
                                const shape = createLabelShape(projectConfig.shape, projectConfig.dimensions
                                    .width, projectConfig.dimensions.height);
                                addArtworkToLabel(shape, 2);
                                console.log('✅ Zaktualizowano obraz 3D w czasie rzeczywistym:', newPos);
                            } else {
                                console.warn('⚠️ Scena lub faceMesh nie istnieje, nie można zaktualizować');
                                console.log('🔍 Stan sceny:', {scene: !!scene, faceMesh: !!faceMesh});
                            }
                        } else {
                            console.warn('⚠️ Brak danych w event.detail');
                        }
                    } catch (e) {
                        console.error('❌ Błąd synchronizacji imagePositionChanged:', e);
                    }
                });

                try {
                    const localPos = localStorage.getItem('imagePosition');
                    if (localPos) {
                        const pos = JSON.parse(localPos);
                        if (pos) {
                            projectConfig.imagePosition = pos;
                            console.log('💡 Załadowano imagePosition z localStorage na starcie:', pos);
                        }
                    }
                } catch (e) {
                    console.error('Nie można sparsować imagePosition z localStorage', e);
                }

                // 4. Inicjalizacja podglądu 3D
                initializePreview();
            });

            // Funkcja pomocnicza do powrotu do kreatora
            function goBackToCreator() {
                // Dodajemy fragment URL (#label-creator), aby skierować bezpośrednio do sekcji kreatora
                window.location.href =
                    '{{ route('home') }}?project={{ $project->id }}&step=4&fromPreview=true&returnToCreator=true#label-creator';
            }

            // Zmienne globalne
            let scene, camera, renderer, controls, labelMesh;
            let isAnimating = false;
            let libraries3DLoaded = false;
            let faceMesh; // Zmienna globalna dla referencji do siatki twarzy etykiety
            let initializationAttempts = 0;
            const MAX_INITIALIZATION_ATTEMPTS = 3;

            // Project configuration from backend
            const projectConfig = {
                shape: '{{ $project->labelShape->slug }}',
                material: '{{ $project->labelMaterial->slug }}',
                dimensions: {
                    width: {{ $dimensions['width'] }},
                    height: {{ $dimensions['height'] }}
                },
                textureUrl: '{{ $project->labelMaterial->texture_image_path ? asset($project->labelMaterial->texture_image_path) : '' }}',
                artworkUrl: '{{ $project->artwork_file_path ? (Str::startsWith($project->artwork_file_path, 'http') ? $project->artwork_file_path : asset('storage/' . $project->artwork_file_path)) : '' }}',
                hasLaminate: {{ $project->laminateOption ? 'true' : 'false' }},
                laminateType: '{{ $project->laminateOption->slug ?? '' }}',
                // MODIFIED: Explicitly add all image positioning parameters with exact values from database
                imagePosition: {
                    x: {{ $project->image_position_x ?? 50 }},
                    y: {{ $project->image_position_y ?? 50 }},
                    scale: {{ $project->image_scale ?? 100 }},
                    rotation: {{ $project->image_rotation ?? 0 }}
                },
                debug: {
                    // Keep existing debug properties
                    hasArtwork: {{ $project->artwork_file_path ? 'true' : 'false' }},
                    artworkPath: '{{ $project->artwork_file_path ?? 'brak' }}',
                }
            };

            // Add debug logging to verify values are correctly loaded
            console.log('📐 Pozycja obrazka z bazy danych:', {
                x: {{ $project->image_position_x ?? 50 }},
                y: {{ $project->image_position_y ?? 50 }},
                scale: {{ $project->image_scale ?? 100 }},
                rotation: {{ $project->image_rotation ?? 0 }}
            });

            // Główna funkcja inicjalizująca podgląd
            function initializePreview() {
                console.log('🚀 Inicjalizacja podglądu 3D...');

                // Generuj alternatywne ścieżki do obrazka
                const timestamp = Date.now();
                const directStorageUrl = '/storage/{{ $project->artwork_file_path }}?t=' + timestamp;

                console.log('Dane obrazka:', {
                    url: projectConfig.artworkUrl,
                    directUrl: directStorageUrl,
                    hasArtwork: projectConfig.debug.hasArtwork,
                    path: projectConfig.debug.artworkPath
                });

                // Załaduj biblioteki 3D
                loadLibraries();
            }

            // Funkcja ładująca biblioteki 3D
            function loadLibraries() {
                console.log('📚 Ładowanie bibliotek 3D...');

                // Sprawdź, czy THREE już istnieje w globalnym obiekcie window
                if (typeof window.THREE !== 'undefined') {
                    console.log('THREE.js już załadowany, przechodzę do inicjalizacji');
                    libraries3DLoaded = true;
                    initThreeJsScene();
                    return;
                }

                // Ładuj Three.js
                const threeScript = document.createElement('script');
                threeScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';

                threeScript.onload = function() {
                    console.log('✅ THREE.js załadowany');

                    // Ładuj OrbitControls
                    const controlsScript = document.createElement('script');
                    controlsScript.src = 'https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js';

                    controlsScript.onload = function() {
                        console.log('✅ OrbitControls załadowany');
                        libraries3DLoaded = true;
                        setTimeout(() => {
                            initThreeJsScene();
                        }, 200); // Małe opóźnienie dla pewności
                    };

                    controlsScript.onerror = function(error) {
                        console.error('❌ Błąd ładowania OrbitControls:', error);
                        retryInitialization('Nie można załadować kontrolera kamery');
                    };

                    document.head.appendChild(controlsScript);
                };

                threeScript.onerror = function(error) {
                    console.error('❌ Błąd ładowania THREE.js:', error);
                    retryInitialization('Nie można załadować biblioteki THREE.js');
                };

                document.head.appendChild(threeScript);
            }



            // Funkcja inicjalizująca scenę Three.js
            function initThreeJsScene() {
                try {
                    console.log('🏗️ Inicjalizacja sceny 3D...');
                    const container = document.getElementById('label-3d-preview');

                    if (!container) {
                        throw new Error('Nie znaleziono kontenera podglądu 3D');
                    }

                    if (typeof THREE === 'undefined') {
                        throw new Error('THREE.js nie jest załadowany');
                    }

                    // 1. Inicjalizacja sceny
                    scene = new THREE.Scene();
                    scene.background = new THREE.Color(0xf8fafc);

                    labelGroup = new THREE.Group();
                    rulersGroup = new THREE.Group();
                    scene.add(labelGroup);
                    scene.add(rulersGroup);

                    // 2. Kamera
                    camera = new THREE.PerspectiveCamera(75, container.offsetWidth / container.offsetHeight, 0.1, 1000);
                    camera.position.set(0, 0, 200);

                    // 3. Renderer
                    renderer = new THREE.WebGLRenderer({
                        antialias: true,
                        alpha: true,
                        powerPreference: "high-performance"
                    });
                    renderer.setSize(container.offsetWidth, container.offsetHeight);
                    renderer.shadowMap.enabled = true;
                    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
                    renderer.toneMapping = THREE.ACESFilmicToneMapping;
                    renderer.toneMappingExposure = 0.8;
                    renderer.outputEncoding = THREE.sRGBEncoding;
                    container.appendChild(renderer.domElement);

                    // 4. Kontroler kamery
                    controls = new THREE.OrbitControls(camera, renderer.domElement);
                    controls.enableDamping = true;
                    controls.dampingFactor = 0.05;
                    controls.enableZoom = true;
                    controls.enablePan = true;
                    controls.enableRotate = true;
                    controls.autoRotate = false;
                    controls.maxDistance = 800;
                    controls.minDistance = 50;
                    controls.target.copy(labelGroup.position);
                    controls.update();

                    controls.addEventListener('start', () => {
                        rotationEnabled = false;
                    });

                    controls.addEventListener('end', () => {
                        rotationEnabled = true;
                    });


                    renderer.domElement.addEventListener('pointerdown', (event) => {
                        if (event.button === 0) { // Lewy przycisk myszy
                            rotationEnabled = false; // Zatrzymaj automatyczny obrót
                        }
                    });

                    renderer.domElement.addEventListener('pointerup', (event) => {
                        if (event.button === 0) { // Lewy przycisk myszy
                            rotationEnabled = true; // Wznów automatyczny obrót
                        }
                    });

                    // Dla bezpieczeństwa gdy kursor wyjdzie z obszaru
                    renderer.domElement.addEventListener('pointerleave', () => {
                        rotationEnabled = true;
                    });


                    // 5. Oświetlenie
                    addLighting(scene);

                    // 6. Stwórz etykietę 3D
                    createLabel();

                    // 7. Ukryj spinner ładowania
                    document.getElementById('preview-loading').style.display = 'none';

                    // 8. Rozpocznij animację
                    isAnimating = true;
                    animate();

                    console.log('✅ Podgląd 3D zainicjalizowany pomyślnie');

                } catch (error) {
                    console.error('❌ Błąd inicjalizacji sceny 3D:', error);
                    retryInitialization(error.message);
                }
            }



            function addLighting(scene) {
                // Ambient light for base illumination
                const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
                scene.add(ambientLight);

                // Main directional light
                const mainLight = new THREE.DirectionalLight(0xffffff, 0.8);
                mainLight.position.set(50, 50, 100);
                mainLight.castShadow = true;
                scene.add(mainLight);

                // Additional point lights for better reflections on metallic surfaces
                const pointLight1 = new THREE.PointLight(0xffffff, 0.6);
                pointLight1.position.set(200, 200, 200);
                scene.add(pointLight1);

                const pointLight2 = new THREE.PointLight(0xffaa88, 0.5); // Warm light
                pointLight2.position.set(-150, 50, 100);
                scene.add(pointLight2);

                // Subtle blue backlight for dimension
                const backLight = new THREE.PointLight(0xaaddff, 0.4);
                backLight.position.set(0, 0, -200);
                scene.add(backLight);
            }


            function createLabel() {
                console.log('🏷️ Tworzenie etykiety 3D...');

                const width = projectConfig.dimensions.width;
                const height = projectConfig.dimensions.height;
                const labelDepth = 0.2; // grubość etykiety - zostawiam realistycznie małą

                let shape = createLabelShape(projectConfig.shape, width, height);

                const extrudeSettings = {
                    steps: 1,
                    depth: labelDepth,
                    bevelEnabled: true,
                    bevelThickness: 0.01,
                    bevelSize: 0.01,
                    bevelOffset: 0,
                    bevelSegments: 1
                };

                const geometry = new THREE.ExtrudeGeometry(shape, extrudeSettings);

                const labelMaterial = createLabelMaterial(projectConfig.material);

                labelMesh = new THREE.Mesh(geometry, labelMaterial);
                labelMesh.castShadow = true;
                labelMesh.receiveShadow = true;
                labelGroup.add(labelMesh);

                // Dodaj tylną stronę etykiety
                createBackSide(shape, labelDepth);

                function createBackSide(shape, labelDepth) {
                    console.log('🏷️ Implementacja tylnej strony z subtelnym tekstem');

                    // 1. Tworzymy nieprzezroczyste ciemne tło
                    const backGeometry = new THREE.ShapeGeometry(shape);
                    const backMaterial = new THREE.MeshBasicMaterial({
                        color: 0x242424, // Ciemny szary/czarny
                        side: THREE.BackSide,
                        transparent: false,
                        depthTest: true,
                        depthWrite: true
                    });

                    const backMesh = new THREE.Mesh(backGeometry, backMaterial);
                    backMesh.position.z = -labelDepth / 2;
                    backMesh.renderOrder = 5000; // Bardzo wysoki priorytet renderowania
                    labelGroup.add(backMesh);

                    // 2. Tworzymy cały tekst jako jedną teksturę zamiast osobnych sprite'ów
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = 1024;
                    canvas.height = 1024;

                    // KLUCZOWA ZMIANA: Odbicie lustrzane podczas rysowania tekstu
                    ctx.save();
                    ctx.scale(-1, 1); // Odbicie lustrzane w poziomie
                    ctx.translate(-canvas.width, 0); // Przesunięcie z powrotem

                    // ZMIENIONY KOLOR - tylko nieznacznie jaśniejszy od tła
                    ctx.fillStyle = '#353535'; // Tylko delikatnie jaśniejszy od #242424
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    // Usunięte cienie dla bardziej subtelnego efektu

                    // TYŁ - bardzo duży tekst
                    ctx.font = 'bold 300px Arial';
                    ctx.fillText('TYŁ', canvas.width / 2, canvas.height / 2 - 200);

                    // BACK - też duży tekst
                    ctx.font = 'bold 250px Arial';
                    ctx.fillText('BACK', canvas.width / 2, canvas.height / 2 + 150);

                    // Custom Labels - jeszcze bardziej subtelne
                    ctx.fillStyle = '#303030'; // Jeszcze mniej widoczne
                    ctx.font = 'bold italic 120px Arial';
                    ctx.fillText('Custom Labels', canvas.width / 2, canvas.height - 150);

                    // Przywróć normalny kontekst
                    ctx.restore();

                    // Stwórz teksturę z całego canvasa
                    const texture = new THREE.CanvasTexture(canvas);
                    texture.needsUpdate = true;

                    // Zastosuj teksturę na tylnej stronie
                    const textGeometry = new THREE.PlaneGeometry(
                        projectConfig.dimensions.width * 0.9,
                        projectConfig.dimensions.height * 0.9
                    );

                    const textMaterial = new THREE.MeshBasicMaterial({
                        map: texture,
                        transparent: true,
                        depthTest: true,
                        depthWrite: false,
                        side: THREE.BackSide
                    });

                    const textMesh = new THREE.Mesh(textGeometry, textMaterial);
                    textMesh.position.z = -labelDepth / 2 - 0.05; // Tuż za tylną ścianką
                    textMesh.renderOrder = 5001; // Jeszcze wyższy priorytet

                    labelGroup.add(textMesh);
                    console.log('✅ Dodano subtelne napisy na tylnej stronie');
                }
                // Dodaj ścianki boczne etykiety
                createSideWalls(shape, labelDepth);

                function createSideWalls(shape, labelDepth) {
                    const sideColor = 0xe5e5e5; // Jaśniejszy szary kolor dla ścianek bocznych

                    const sideMaterial = new THREE.MeshStandardMaterial({
                        color: sideColor,
                        roughness: 0.7,
                        metalness: 0.05,
                        side: THREE.DoubleSide
                    });

                    // Pobierz punkty kształtu etykiety
                    const points = shape.getPoints();
                    const vertices = [];

                    // Tworzymy ścianki boczne
                    for (let i = 0; i < points.length; i++) {
                        const current = points[i];
                        const next = points[(i + 1) % points.length];

                        // Dodajemy wierzchołki dla ścianki (dwa trójkąty)
                        vertices.push(
                            // Pierwszy trójkąt
                            current.x, current.y, 0,
                            next.x, next.y, 0,
                            current.x, current.y, -labelDepth,

                            // Drugi trójkąt
                            next.x, next.y, 0,
                            next.x, next.y, -labelDepth,
                            current.x, current.y, -labelDepth
                        );
                    }

                    // Tworzymy geometrię
                    const sideGeometry = new THREE.BufferGeometry();
                    sideGeometry.setAttribute('position', new THREE.Float32BufferAttribute(vertices, 3));
                    sideGeometry.computeVertexNormals();

                    // Tworzymy siatkę
                    const sideMesh = new THREE.Mesh(sideGeometry, sideMaterial);
                    sideMesh.renderOrder = 0;
                    labelGroup.add(sideMesh);
                }
                if (projectConfig.debug.hasArtwork) {
                    // KLUCZOWA ZMIANA: Inicjalizujemy faceMesh jako null, bezpośrednio ładujemy obrazek
                    faceMesh = null;
                    loadArtworkDirectly(shape, labelDepth);
                }

                if (projectConfig.hasLaminate) {
                    addLaminateLayer(geometry, labelDepth);
                }

                addRulers(scene, width, height, labelDepth);
            }

            // NOWA FUNKCJA: Bezpośrednie ładowanie obrazka bez złotego placeholdera
            function loadArtworkDirectly(shape, labelDepth) {
                console.log('🖼️ Bezpośrednie ładowanie obrazka bez złotego placeholdera...');

                // Remove any existing face mesh first
                if (faceMesh && scene.children.includes(faceMesh)) {
                    scene.remove(faceMesh);
                }

                // Ładowanie tekstury bezpośrednio
                const textureLoader = new THREE.TextureLoader();
                textureLoader.crossOrigin = 'Anonymous';

                const timestamp = new Date().getTime();
                const imageUrls = [
                    projectConfig.artworkUrl,
                    '/storage/' + projectConfig.debug.artworkPath,
                    window.location.origin + '/storage/' + projectConfig.debug.artworkPath,
                    `/storage/${projectConfig.debug.artworkPath}?t=${timestamp}`,
                    `/storage/temp/artworks/${projectConfig.debug.artworkPath.split('/').pop()}?t=${timestamp}`,
                    `/storage/artwork/${projectConfig.debug.artworkPath.split('/').pop()}?t=${timestamp}`
                ].filter(url => url && url !== '/storage/' && url !== '/storage/brak');

                console.log('📋 Dostępne URL do obrazka:', imageUrls);
                tryLoadTexture(textureLoader, imageUrls, 0);
            }

            function createLabelShape(shapeType, width, height) {
                const shape = new THREE.Shape();

                if (shapeType === 'circle') {
                    const radius = Math.max(width, height) / 2;
                    shape.absarc(0, 0, radius, 0, Math.PI * 2, false);
                } else if (shapeType === 'oval') {
                    const rx = width / 2;
                    const ry = height / 2;
                    const segments = 32;
                    for (let i = 0; i <= segments; i++) {
                        const theta = (i / segments) * Math.PI * 2;
                        const x = rx * Math.cos(theta);
                        const y = ry * Math.sin(theta);
                        if (i === 0) shape.moveTo(x, y);
                        else shape.lineTo(x, y);
                    }
                } else if (shapeType === 'star') {
                    const outerRadius = Math.min(width, height) / 2;
                    const innerRadius = outerRadius * 0.4;
                    const points = 5;
                    for (let i = 0; i < points * 2; i++) {
                        const angle = (i * Math.PI) / points;
                        const radius = i % 2 === 0 ? outerRadius : innerRadius;
                        const x = radius * Math.cos(angle);
                        const y = radius * Math.sin(angle);
                        if (i === 0) shape.moveTo(x, y);
                        else shape.lineTo(x, y);
                    }
                } else {
                    const halfWidth = width / 2;
                    const halfHeight = height / 2;
                    shape.moveTo(-halfWidth, -halfHeight);
                    shape.lineTo(halfWidth, -halfHeight);
                    shape.lineTo(halfWidth, halfHeight);
                    shape.lineTo(-halfWidth, halfHeight);
                }

                shape.closePath();
                return shape;
            }


            function createLabelMaterial(materialType) {
                console.log('🎨 Tworzenie materiału:', materialType);

                // Base configuration
                let materialColor;
                let roughness = 0.7;
                let metalness = 0.1;
                let envMapIntensity = 1.0;
                let clearcoat = 0;
                let clearcoatRoughness = 0;

                // Gold foil
                if (materialType.includes('gold') || materialType.includes('zlota')) {
                    materialColor = 0xd4af37; // More realistic gold color
                    roughness = 0.15;
                    metalness = 0.95;
                    envMapIntensity = 2.0;
                    clearcoat = 0.5; // Add clearcoat for extra shine
                    clearcoatRoughness = 0.1;
                }
                // Silver foil
                else if (materialType.includes('silver') || materialType.includes('srebrna')) {
                    materialColor = 0xe8e8e8; // More realistic silver color
                    roughness = 0.1;
                    metalness = 0.95;
                    envMapIntensity = 2.0;
                    clearcoat = 0.3;
                    clearcoatRoughness = 0.05;
                }
                // Rest of the existing material types...
                else if (materialType.includes('glossy') || materialType.includes('blysk')) {
                    materialColor = 0xffffff;
                    roughness = 0.2;
                    metalness = 0.1;
                } else if (materialType.includes('cream')) {
                    materialColor = 0xf5f0e0;
                    roughness = 0.8;
                    metalness = 0.0;
                } else if (materialType.includes('waterproof') || materialType.includes('wodoodporn')) {
                    materialColor = 0xf8f8ff;
                    roughness = 0.4;
                    metalness = 0.2;
                } else {
                    materialColor = 0xffffff;
                    roughness = 0.9;
                    metalness = 0.0;
                }



                // Use MeshPhysicalMaterial instead of MeshStandardMaterial for metallic options
                let material;
                if (metalness > 0.5) {
                    material = new THREE.MeshPhysicalMaterial({
                        color: materialColor,
                        roughness: roughness,
                        metalness: metalness,
                        side: THREE.DoubleSide,
                        envMapIntensity: envMapIntensity,
                        clearcoat: clearcoat,
                        clearcoatRoughness: clearcoatRoughness,
                        reflectivity: 1.0
                    });
                } else {
                    material = new THREE.MeshStandardMaterial({
                        color: materialColor,
                        roughness: roughness,
                        metalness: metalness,
                        side: THREE.DoubleSide,
                        envMapIntensity: envMapIntensity
                    });
                }

                // Add environment map for metallic materials
                if (metalness > 0.3) {
                    createEnhancedEnvMap(material);
                }

                return material;
            }

            function createEnhancedEnvMap(material) {
                // HDR environment map for more realistic reflections
                const pmremGenerator = new THREE.PMREMGenerator(renderer);
                pmremGenerator.compileEquirectangularShader();

                // Try to load a high quality HDR map first
                new THREE.CubeTextureLoader()
                    .setPath('https://threejs.org/examples/textures/cube/skyboxsun25deg/')
                    .load(
                        ['px.jpg', 'nx.jpg', 'py.jpg', 'ny.jpg', 'pz.jpg', 'nz.jpg'],
                        function(cubeTexture) {
                            cubeTexture.encoding = THREE.sRGBEncoding;
                            material.envMap = cubeTexture;
                            material.needsUpdate = true;

                            // For physical materials, add more complex reflection mapping
                            if (material.type === 'MeshPhysicalMaterial') {
                                const envMap = pmremGenerator.fromCubemap(cubeTexture).texture;
                                material.envMap = envMap;
                                material.needsUpdate = true;
                            }

                            pmremGenerator.dispose();
                        }
                    );
            }

            // Prosta mapa środowiska dla metalicznych materiałów
            function createSimpleEnvMap(material) {
                try {
                    // Set a timeout to prevent infinite loading
                    const loadingTimeout = setTimeout(() => {
                        console.warn('⚠️ Environment map loading timed out');
                        material.needsUpdate = true;
                    }, 5000);

                    // Simple environment map with error handling
                    const loader = new THREE.CubeTextureLoader();
                    loader.setPath('https://threejs.org/examples/textures/cube/skyboxsun25deg/');
                    loader.load([
                        'px.jpg', 'nx.jpg', 'py.jpg', 'ny.jpg', 'pz.jpg', 'nz.jpg'
                    ], function(envMap) {
                        clearTimeout(loadingTimeout);
                        material.envMap = envMap;
                        material.envMapIntensity = 1.5;
                        material.needsUpdate = true;
                    }, undefined, function(error) {
                        clearTimeout(loadingTimeout);
                        console.error('Failed to load environment map:', error);
                    });
                } catch (error) {
                    console.error('Error in createSimpleEnvMap:', error);
                }
            }

            // Dodawanie obrazka do etykiety
            function addArtworkToLabel(shape, labelDepth) {
                console.log('🖼️ Dodawanie obrazka do etykiety...');

                faceMesh = null;

                // Ładowanie tekstury
                const textureLoader = new THREE.TextureLoader();
                textureLoader.crossOrigin = 'Anonymous';

                // PRZYWRÓCONE RZECZYWISTE ADRESY URL
                const timestamp = new Date().getTime();
                const imageUrls = [
                    projectConfig.artworkUrl,
                    '/storage/' + projectConfig.debug.artworkPath,
                    window.location.origin + '/storage/' + projectConfig.debug.artworkPath,
                    `/storage/${projectConfig.debug.artworkPath}?t=${timestamp}`,
                    `/storage/temp/artworks/${projectConfig.debug.artworkPath.split('/').pop()}?t=${timestamp}`,
                    `/storage/artwork/${projectConfig.debug.artworkPath.split('/').pop()}?t=${timestamp}`
                ].filter(url => url && url !== '/storage/' && url !== '/storage/brak');

                console.log('📋 Dostępne URL do obrazka:', imageUrls);
                tryLoadTexture(textureLoader, imageUrls, 0);
            }

            // Funkcja próbująca załadować teksturę
            function tryLoadTexture(loader, urls, urlIndex) {
                if (urlIndex >= urls.length) {
                    console.warn('⚠️ Nie udało się załadować obrazka z żadnego URL');
                    createFallbackTexture();
                    return;
                }

                const url = urls[urlIndex] + (urls[urlIndex].includes('?') ? '&' : '?') + 'cache=' + new Date().getTime();
                console.log(`🔄 Próba ${urlIndex + 1}/${urls.length}: ${url}`);

                loader.load(
                    url,
                    // Sukces
                    function(texture) {
                        console.log('✅ Załadowano obrazek pomyślnie!');
                        applyTextureToFace(texture);
                    },
                    // Postęp
                    function(xhr) {
                        console.log(`${url}: ${Math.round((xhr.loaded / xhr.total) * 100)}% załadowano`);
                    },
                    // Błąd
                    function(error) {
                        console.warn(`❌ Błąd ładowania z URL ${url}:`, error);
                        // Próbuj następny URL
                        setTimeout(() => tryLoadTexture(loader, urls, urlIndex + 1), 100);
                    }
                );
            }

            // Tworzenie tekstury awaryjnej
            function createFallbackTexture() {
                console.log('⚠️ Tworzenie tekstury zastępczej...');

                const canvas = document.createElement('canvas');
                canvas.width = 512;
                canvas.height = 512;
                const ctx = canvas.getContext('2d');

                // Tło
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, 512, 512);

                // Ramka
                ctx.strokeStyle = 'black';
                ctx.lineWidth = 10;
                ctx.strokeRect(20, 20, 472, 472);

                // Tekst
                ctx.fillStyle = 'black';
                ctx.font = '24px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('Przykładowa etykieta', 256, 256);
                ctx.fillText('(nie udało się załadować obrazka)', 256, 300);

                // Zastosuj teksturę
                const texture = new THREE.CanvasTexture(canvas);
                applyTextureToFace(texture);
            }

            function applyTextureToFace(texture) {
                console.log('🎨 Naprawianie pozycjonowania obrazka...');
                console.log('🔍 Aktualny projectConfig.imagePosition:', projectConfig.imagePosition);
                console.log('🔍 Czy projectConfig.imagePosition się zmienia?', JSON.stringify(projectConfig.imagePosition));

                // Get image dimensions and aspect ratios
                const imgWidth = texture.image.width;
                const imgHeight = texture.image.height;
                const labelHeight = projectConfig.dimensions.height;
                const labelWidth = projectConfig.dimensions.width;
                const imgAspect = imgWidth / imgHeight;
                const labelAspect = labelWidth / labelHeight;

                // Position values from creator
                const userScale = (projectConfig.imagePosition.scale || 100) / 100;
                const rotationDeg = projectConfig.imagePosition.rotation || 0;
                const rotationRad = rotationDeg * Math.PI / 180;

                // Position X and Y as percentage (0-100) from center
                const posX = projectConfig.imagePosition.x || 50;
                const posY = projectConfig.imagePosition.y || 50;

                console.log('📊 Wartości z kreatora:', {
                    posX,
                    posY,
                    userScale,
                    rotationDeg,
                    imgSize: `${imgWidth}x${imgHeight}`,
                    labelSize: `${labelWidth}x${labelHeight}`,
                    fullImagePosition: projectConfig.imagePosition
                });

                const shape = createLabelShape(
                    projectConfig.shape,
                    projectConfig.dimensions.width,
                    projectConfig.dimensions.height
                );

                // Remove existing mesh from scene and labelGroup
                if (faceMesh) {
                    if (scene.children.includes(faceMesh)) {
                        scene.remove(faceMesh);
                    }
                    if (labelGroup.children.includes(faceMesh)) {
                        labelGroup.remove(faceMesh);
                    }
                    // Dispose of the mesh to prevent memory leaks
                    if (faceMesh.geometry) faceMesh.geometry.dispose();
                    if (faceMesh.material) faceMesh.material.dispose();
                }

                // Create a new texture from the image
                const newTexture = new THREE.Texture(texture.image);
                newTexture.needsUpdate = true;
                newTexture.encoding = THREE.sRGBEncoding;
                newTexture.anisotropy = renderer.capabilities.getMaxAnisotropy();

                // Dodaj flip Y na teksturze...
                newTexture.flipY = false; // To wymusza 'naturalne' mapowanie bez odbicia w three.js.

                // Create geometry
                const imageGeometry = new THREE.ShapeGeometry(shape);

                // CAŁKOWICIE NOWE PODEJŚCIE DO MAPOWANIA UV:
                const positions = imageGeometry.attributes.position;
                const uvs = new Float32Array(positions.count * 2);

                for (let i = 0; i < positions.count; i++) {
                    const x = positions.getX(i);
                    const y = positions.getY(i);

                    const u = (x + labelWidth / 2) / labelWidth;
                    const v = 1 - (y + labelHeight / 2) / labelHeight;

                    uvs[i * 2] = u;
                    uvs[i * 2 + 1] = v;
                }

                imageGeometry.setAttribute('uv', new THREE.BufferAttribute(uvs, 2));

                // 2. Tworzymy materiał z teksturą i przekazujemy mu transformacje
                let imageMaterial;

                // Wybór materiału w zależności od typu etykiety
                if (projectConfig.material.includes('gold') || projectConfig.material.includes('zlota')) {
                    imageMaterial = new THREE.MeshPhysicalMaterial({
                        map: newTexture,
                        color: 0xffd700,
                        metalness: 0.85,
                        roughness: 0.15,
                        reflectivity: 0.8,
                        clearcoat: 0.6,
                        clearcoatRoughness: 0.05,
                        emissive: 0x996515,
                        emissiveIntensity: 0.15,
                        transparent: true,
                        side: THREE.FrontSide
                    });

                    createSimpleEnvMap(imageMaterial);
                } else if (projectConfig.material.includes('silver') || projectConfig.material.includes('srebr')) {
                    imageMaterial = new THREE.MeshPhysicalMaterial({
                        map: newTexture,
                        color: 0xe0e0e0,
                        metalness: 0.4,
                        roughness: 0.2,
                        reflectivity: 0.85,
                        clearcoat: 0.7,
                        clearcoatRoughness: 0.03,
                        emissive: 0xb0b0b0,
                        emissiveIntensity: 0.36,
                        transparent: true,
                        side: THREE.FrontSide
                    });

                    createSimpleEnvMap(imageMaterial);
                    imageMaterial.onBeforeCompile = shader => {
                        shader.fragmentShader = shader.fragmentShader.replace(
                            '#include <map_fragment>',
                            `
                #ifdef USE_MAP
                    vec4 texelColor = texture2D( map, vUv );
                    vec3 silverTint = vec3(0.74, 0.87, 0.72);
                    texelColor.rgb = texelColor.rgb * 0.43;
                    texelColor.rgb = mix(texelColor.rgb, silverTint, 0.11);
                    diffuseColor.rgb *= texelColor.rgb;
                #endif
                `
                        );
                    };
                } else if (projectConfig.material.includes('white-matte') || projectConfig.material.includes('bialy-matowy')) {
                    imageMaterial = new THREE.MeshStandardMaterial({
                        map: newTexture,
                        color: 0xf4f4f0,
                        metalness: 0.8,
                        roughness: 1,
                        transparent: false,
                        side: THREE.FrontSide
                    });
                } else if (projectConfig.material.includes('white-glossy') || projectConfig.material.includes('bialy-blysk')) {
                    imageMaterial = new THREE.MeshPhysicalMaterial({
                        map: newTexture,
                        color: 0xffffff,
                        metalness: 0.04,
                        roughness: 0.18,
                        clearcoat: 0.5,
                        clearcoatRoughness: 0.08,
                        reflectivity: 0.5,
                        transparent: false,
                        side: THREE.FrontSide
                    });
                } else if (projectConfig.material.includes('cream') || projectConfig.material.includes('kremowy')) {
                    imageMaterial = new THREE.MeshStandardMaterial({
                        map: newTexture,
                        color: 0xf5ecd7,
                        metalness: 0.0,
                        roughness: 0.85,
                        transparent: false,
                        side: THREE.FrontSide
                    });
                } else if (projectConfig.material.includes('kraft')) {
                    imageMaterial = new THREE.MeshStandardMaterial({
                        map: newTexture,
                        color: 0xa67c52,
                        metalness: 0.0,
                        roughness: 0.92,
                        transparent: false,
                        side: THREE.FrontSide
                    });
                } else if (projectConfig.material.includes('waterproof') || projectConfig.material.includes('wodoodporn')) {
                    imageMaterial = new THREE.MeshStandardMaterial({
                        map: newTexture,
                        color: 0xf7fbfd,
                        metalness: 0.08,
                        roughness: 0.38,
                        transparent: false,
                        side: THREE.FrontSide
                    });
                } else {
                    imageMaterial = new THREE.MeshStandardMaterial({
                        map: newTexture,
                        color: 0xfafafa,
                        metalness: 0.0,
                        roughness: 0.9,
                        transparent: false,
                        side: THREE.FrontSide
                    });
                }

                // Transformacje tekstury
                newTexture.center.set(0.5, 0.5);
                // Match CSS clockwise rotation: invert sign for Three.js texture rotation
                newTexture.rotation = -rotationRad;

                // WRACAM DO WERSJI Z WYCHODZENIEM POZA ETYKIETĘ: repeat=1,1, skalowanie przez geometrię
                // Ustawiamy repeat na 1,1 żeby obrazek się nie rozciągał
                newTexture.repeat.set(1, 1);
                
                // Obliczamy skalę na podstawie proporcji obrazka i etykiety
                let scaleX, scaleY;
                
                if (imgAspect > labelAspect) {
                    // Obrazek jest szerszy - skalujemy po wysokości
                    scaleY = userScale;
                    scaleX = userScale * (labelAspect / imgAspect);
                } else {
                    // Obrazek jest wyższy - skalujemy po szerokości
                    scaleX = userScale;
                    scaleY = userScale * (imgAspect / labelAspect);
                }

                const percentX = posX / 100;
                const percentY = posY / 100;

                // NAPRAWIONE MAPOWANIE 2D do 3D:
                // W 2D: 50%, 50% = środek kontenera = środek etykiety
                // W 3D UV: 0.5, 0.5 = środek tekstury
                
                // Proste mapowanie: 0-100% w 2D -> 0-1 w 3D UV
                const offsetX = percentX - 0.5;
                const offsetY = percentY - 0.5;
                
                // Tylko offset do pozycjonowania - NIE używamy repeat do skalowania!
                newTexture.offset.set(offsetX, offsetY);

                console.log('🎯 Mapowanie pozycji i skali (wychodzi poza etykietę, bez rozciągania):', {
                    '2D posX': posX,
                    '2D posY': posY,
                    'percentX': percentX,
                    'percentY': percentY,
                    'offsetX': offsetX,
                    'offsetY': offsetY,
                    'userScale': userScale,
                    'scaleX': scaleX,
                    'scaleY': scaleY,
                    'repeat': '1,1 (bez rozciągania)',
                    'geometryScale': `${scaleX}, ${scaleY}, 1 (może wychodzić poza etykietę)`
                });

                faceMesh = new THREE.Mesh(imageGeometry, imageMaterial);
                faceMesh.position.z = 0.6;
                faceMesh.renderOrder = 10000;
                
                // OGRANICZENIE SKALI: Nie pozwól żeby obrazek wychodził poza etykietę
                const maxScaleX = 1.0; // Maksymalnie 100% szerokości etykiety
                const maxScaleY = 1.0; // Maksymalnie 100% wysokości etykiety
                
                const limitedScaleX = Math.min(scaleX, maxScaleX);
                const limitedScaleY = Math.min(scaleY, maxScaleY);
                
                // Zastosuj ograniczone skalowanie
                faceMesh.scale.set(limitedScaleX, limitedScaleY, 1);
                
                console.log('🔒 Obrazek ograniczony do wymiarów etykiety:', {
                    'oryginalne skale': { x: scaleX, y: scaleY },
                    'ograniczone skale': { x: limitedScaleX, y: limitedScaleY },
                    'maksymalne skale': { x: maxScaleX, y: maxScaleY }
                });
                
                labelGroup.add(faceMesh);

                console.log('✅ Pozycjonowanie obrazka naprawione (bez klonowania):', {
                    offset: {
                        x: offsetX,
                        y: offsetY
                    },
                    scale: {
                        x: scaleX,
                        y: scaleY
                    },
                    rotation: rotationRad,
                    meshCount: labelGroup.children.length,
                    sceneCount: scene.children.length
                });
            }

            // NOWA FUNKCJA: Tworzenie materiału z efektem bezpośrednio na teksturze
            function createEffectMaterial(texture, materialType) {
                // Bazowe parametry materiału
                let color = 0xffffff;
                let metalness = 0.0;
                let roughness = 0.9;
                let envMapIntensity = 1.0;

                // Dostosowanie parametrów w zależności od typu materiału
                if (materialType.includes('gold') || materialType.includes('zlota')) {
                    color = 0xffd700; // Złoty
                    metalness = 0.8;
                    roughness = 0.2;
                    envMapIntensity = 1.8;
                } else if (materialType.includes('silver') || materialType.includes('srebrna')) {
                    color = 0xf0f0f0; // Srebrny
                    metalness = 0.8;
                    roughness = 0.15;
                    envMapIntensity = 1.6;
                } else if (materialType.includes('glossy') || materialType.includes('blysk')) {
                    metalness = 0.1;
                    roughness = 0.2;
                    envMapIntensity = 1.2;
                } else if (materialType.includes('cream')) {
                    color = 0xf5f0e0; // Kremowy
                    metalness = 0.0;
                    roughness = 0.8;
                } else if (materialType.includes('waterproof')) {
                    metalness = 0.1;
                    roughness = 0.4;
                }

                // Tworzenie materiału z efektem
                const material = new THREE.MeshStandardMaterial({
                    map: texture,
                    color: color,
                    metalness: metalness,
                    roughness: roughness,
                    envMapIntensity: envMapIntensity,
                    transparent: true,
                    side: THREE.DoubleSide
                });

                // Dla metalizowanych materiałów dodaj mapę środowiskową
                if (metalness > 0.3) {
                    createEnvMapForMaterial(material);
                }

                return material;
            }

            // Funkcja dodająca mapę środowiskową do materiału
            function createEnvMapForMaterial(material) {
                try {
                    // Próba załadowania cubemapy dla lepszych odbić
                    const cubeTexture = new THREE.CubeTextureLoader().load([
                        'https://threejs.org/examples/textures/cube/skyboxsun25deg/px.jpg',
                        'https://threejs.org/examples/textures/cube/skyboxsun25deg/nx.jpg',
                        'https://threejs.org/examples/textures/cube/skyboxsun25deg/py.jpg',
                        'https://threejs.org/examples/textures/cube/skyboxsun25deg/ny.jpg',
                        'https://threejs.org/examples/textures/cube/skyboxsun25deg/pz.jpg',
                        'https://threejs.org/examples/textures/cube/skyboxsun25deg/nz.jpg'
                    ], function() {
                        material.envMap = cubeTexture;
                        material.needsUpdate = true;
                    });
                } catch (error) {
                    console.warn('Nie można załadować mapy środowiskowej:', error);
                }
            }

            // Nowa funkcja do tworzenia powiększonego kształtu (bez zmian)
            function createExpandedShape(originalShape, scaleFactor) {
                // Dla prostych kształtów używamy oryginalnej funkcji tworzenia, ale ze zwiększonymi wymiarami
                const shape = projectConfig.shape;
                const width = projectConfig.dimensions.width * scaleFactor;
                const height = projectConfig.dimensions.height * scaleFactor;

                return createLabelShape(shape, width, height);
            }

            // Funkcja awaryjna (bez zmian)
            function createEmergencyTexture() {
                console.log('🚨 Tworzenie awaryjnej tekstury testowej...');

                const canvas = document.createElement('canvas');
                canvas.width = 512;
                canvas.height = 512;
                const ctx = canvas.getContext('2d');

                // Wypełnienie kolorami dla łatwiejszej diagnostyki
                ctx.fillStyle = '#ff0000'; // Czerwony kwadrat
                ctx.fillRect(0, 0, 256, 256);
                ctx.fillStyle = '#00ff00'; // Zielony kwadrat
                ctx.fillRect(256, 0, 256, 256);
                ctx.fillStyle = '#0000ff'; // Niebieski kwadrat
                ctx.fillRect(0, 256, 256, 256);
                ctx.fillStyle = '#ffff00'; // Żółty kwadrat
                ctx.fillRect(256, 256, 256, 256);

                // Dodaj wyraźny tekst
                ctx.fillStyle = 'white';
                ctx.font = 'bold 48px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('TEST', 256, 256);
                ctx.font = '24px Arial';
                ctx.fillText('(Obrazek awaryjny)', 256, 300);

                // Zastosuj teksturę
                const texture = new THREE.CanvasTexture(canvas);

                // Specjalna funkcja dla awaryjnej tekstury
                applyEmergencyTexture(texture);
            }

            // Funkcja awaryjna (bez zmian)
            function applyEmergencyTexture(texture) {
                const shape = createLabelShape(
                    projectConfig.shape,
                    projectConfig.dimensions.width,
                    projectConfig.dimensions.height
                );

                const labelDepth = 0;

                texture.needsUpdate = true;

                // Najprostszy możliwy materiał
                const texturedMaterial = new THREE.MeshBasicMaterial({
                    map: texture,
                    transparent: false,
                    depthTest: false,
                    side: THREE.DoubleSide
                });

                const shapeGeometry = new THREE.ShapeGeometry(shape);
                const artworkMesh = new THREE.Mesh(shapeGeometry, texturedMaterial);
                artworkMesh.renderOrder = 10000;
                artworkMesh.position.z = labelDepth / 2 + 0; // Minimalne przesunięcie

                scene.remove(faceMesh);
                scene.add(artworkMesh);
                faceMesh = artworkMesh;

                if (renderer && scene && camera) {
                    renderer.render(scene, camera);
                }
            }

            // Odświeżanie obrazka (bez zmian)
            window.reloadArtwork = function() {
                console.log('🔄 Odświeżanie obrazka...');

                if (!scene || !projectConfig.debug.hasArtwork) {
                    console.warn('⚠️ Nie można odświeżyć obrazka - scena nie istnieje lub brak obrazka');
                    return;
                }

                // Usuń stary mesh obrazka z labelGroup (nie ze sceny)
                if (faceMesh && labelGroup.children.includes(faceMesh)) {
                    labelGroup.remove(faceMesh);
                    faceMesh = null;
                }

                // Stwórz kształt etykiety
                const shape = createLabelShape(
                    projectConfig.shape,
                    projectConfig.dimensions.width,
                    projectConfig.dimensions.height
                );

                // Dodaj nowy obrazek
                addArtworkToLabel(shape, 2);
            };

            // ULEPSZONA funkcja dodawania warstwy laminatu
            function addLaminateLayer(geometry, labelDepth) {
                console.log('🔍 Dodawanie laminatu z uwzględnieniem materiału:', projectConfig.laminateType);

                // Klonuj geometrię etykiety, ale delikatnie większą
                const laminateGeometry = geometry.clone();
                laminateGeometry.scale(1.01, 1.01, 1);

                let opacity = 0.15;
                let shininess = 100;
                let blending = THREE.NormalBlending;
                let specular = 0x111111;

                // Laminat matowy
                if (projectConfig.laminateType?.includes('matte')) {
                    opacity = 0.12;
                    shininess = 10;
                    specular = 0x050505;
                    blending = THREE.NormalBlending;
                }
                // Laminat błyszczący
                else if (projectConfig.laminateType?.includes('glossy')) {
                    opacity = 0.25;
                    shininess = 150;
                    specular = 0x222222;
                    blending = THREE.AdditiveBlending;
                }
                // Laminat soft-touch
                else if (projectConfig.laminateType?.includes('soft')) {
                    opacity = 0.15;
                    shininess = 5;
                    specular = 0x010101;
                    blending = THREE.MultiplyBlending;
                }

                // Użyj MeshPhongMaterial dla lepszego efektu połysku
                const laminateMaterial = new THREE.MeshPhongMaterial({
                    color: 0xffffff,
                    specular: specular,
                    shininess: shininess,
                    transparent: true,
                    opacity: opacity,
                    side: THREE.DoubleSide,
                    depthWrite: false,
                    blending: blending
                });

                const laminateMesh = new THREE.Mesh(laminateGeometry, laminateMaterial);
                laminateMesh.position.z = 0.5;
                laminateMesh.renderOrder = 2500; // Wyższy renderOrder - nad wszystkim
                labelGroup.add(laminateMesh);

                // Dla błyszczącego laminatu dodaj wyraźniejszy efekt "blasku"
                if (projectConfig.laminateType?.includes('glossy')) {
                    addEnhancedGlossEffect(laminateGeometry);
                }

                // Dla soft-touch dodaj efekt miękkości
                if (projectConfig.laminateType?.includes('soft')) {
                    addSoftTouchEffect(laminateGeometry);
                }
            }

            // NOWOŚĆ: Ulepszona funkcja efektu połysku
            function addEnhancedGlossEffect(geometry) {
                // Główna warstwa blasku
                const glossMaterial = new THREE.MeshBasicMaterial({
                    color: 0xffffff,
                    transparent: true,
                    opacity: 0.1,
                    side: THREE.FrontSide,
                    blending: THREE.AdditiveBlending,
                    depthWrite: false
                });

                const glossMesh = new THREE.Mesh(geometry.clone(), glossMaterial);
                glossMesh.position.z = 0.55;
                glossMesh.renderOrder = 3000;
                labelGroup.add(glossMesh);

                // Dodatkowa warstwa z efektem lustrzanym
                const specularMaterial = new THREE.MeshPhongMaterial({
                    color: 0xffffff,
                    specular: 0x444444,
                    shininess: 200,
                    transparent: true,
                    opacity: 0.1,
                    side: THREE.FrontSide,
                    blending: THREE.AdditiveBlending,
                    depthWrite: false
                });

                const specularMesh = new THREE.Mesh(geometry.clone(), specularMaterial);
                specularMesh.position.z = 0.56;
                specularMesh.renderOrder = 3001;
                labelGroup.add(specularMesh);
            }

            // NOWOŚĆ: Funkcja dla efektu soft-touch
            function addSoftTouchEffect(geometry) {
                // Efekt delikatnego zmatowienia
                const softMaterial = new THREE.MeshStandardMaterial({
                    color: 0x222222,
                    roughness: 0.95,
                    metalness: 0.01,
                    transparent: true,
                    opacity: 0.05,
                    side: THREE.FrontSide,
                    blending: THREE.MultiplyBlending,
                    depthWrite: false
                });

                const softMesh = new THREE.Mesh(geometry.clone(), softMaterial);
                softMesh.position.z = 0.55;
                softMesh.renderOrder = 3000;
                scene.add(softMesh);
            }

            // Dodawanie miarek wymiarów (bez zmian)
            function addRulers(scene, width, height, depth) {
                const rulerColor = 0x333333;
                const rulerWidth = 0.5;
                const labelOffset = 15;

                // Miarka szerokości
                const widthGeometry = new THREE.BoxGeometry(width, rulerWidth, rulerWidth);
                const widthMaterial = new THREE.MeshBasicMaterial({
                    color: rulerColor
                });
                const widthRuler = new THREE.Mesh(widthGeometry, widthMaterial);
                widthRuler.position.set(0, -height / 2 - labelOffset, 0);
                rulersGroup.add(widthRuler);
                // Miarka wysokości
                const heightGeometry = new THREE.BoxGeometry(rulerWidth, height, rulerWidth);
                const heightRuler = new THREE.Mesh(heightGeometry, widthMaterial);
                heightRuler.position.set(-width / 2 - labelOffset, 0, 0);
                rulersGroup.add(heightRuler);

                // Dodaj tekst z wymiarami
                addTextLabel(scene, `${width}mm`, 0, -height / 2 - labelOffset - 10, 0, 1.5);
                addTextLabel(scene, `${height}mm`, -width / 2 - labelOffset - 15, 0, 0, 1.5, true);
            }

            // Funkcja pomocnicza do dodawania etykiet tekstowych (bez zmian)
            function addTextLabel(scene, text, x, y, z, size = 1, rotated = false) {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.width = 100;
                canvas.height = 50;

                context.fillStyle = '#000000';
                context.font = `${16 * size}px Arial`;
                context.textAlign = 'center';
                context.textBaseline = 'middle';
                context.fillText(text, canvas.width / 2, canvas.height / 2);

                const texture = new THREE.CanvasTexture(canvas);
                const material = new THREE.SpriteMaterial({
                    map: texture,
                    transparent: true
                });
                const sprite = new THREE.Sprite(material);

                sprite.scale.set(10 * size, 5 * size, 1);
                sprite.position.set(x, y, z);

                if (rotated) {
                    sprite.material.rotation = Math.PI / 2;
                }

                scene.add(sprite);
                return sprite;
            }

            // Funkcja renderująca scenę
            function animate() {
                if (!isAnimating) return;

                requestAnimationFrame(animate);

                if (controls) controls.update();
                if (renderer && scene && camera) renderer.render(scene, camera);
            }

            // Obsługa zmiany rozmiaru okna
            window.addEventListener('resize', function() {
                if (camera && renderer) {
                    const container = document.getElementById('label-3d-preview');
                    camera.aspect = container.offsetWidth / container.offsetHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(container.offsetWidth, container.offsetHeight);
                }
            });



            // Flaga sterująca automatycznym obrotem
            let rotationEnabled = true;

            // Obsługa OrbitControls: zatrzymaj obrót jak użytkownik trzyma lewy przycisk myszy
            if (renderer && renderer.domElement) {
                renderer.domElement.addEventListener('mousedown', (event) => {
                    if (event.button === 0) { // Lewy przycisk myszy
                        rotationEnabled = false;
                    }
                });

                // Wznów automatyczny obrót po puszczeniu lewego przycisku myszy
                renderer.domElement.addEventListener('mouseup', (event) => {
                    if (event.button === 0) {
                        rotationEnabled = true;
                    }
                });

                // Opcjonalnie można dodać też obsługę wyjścia kursora (mouseleave) aby wznowić obrót, na wypadek gubienia eventów
                renderer.domElement.addEventListener('mouseleave', () => {
                    rotationEnabled = true;
                });
            }


            function animate() {
                requestAnimationFrame(animate);
                if (rotationEnabled && labelGroup) {
                    labelGroup.rotation.y += 0.003;
                }
                renderer.render(scene, camera);
            }



            // Funkcja do ponownej próby inicjalizacji
            function retryInitialization(errorMessage) {
                initializationAttempts++;
                console.warn(
                    `⚠️ Próba inicjalizacji ${initializationAttempts}/${MAX_INITIALIZATION_ATTEMPTS} nie powiodła się: ${errorMessage}`
                );

                if (initializationAttempts < MAX_INITIALIZATION_ATTEMPTS) {
                    console.log(`🔄 Ponowna próba inicjalizacji za 1 sekundę...`);
                    setTimeout(initializePreview, 1000);
                } else {
                    console.error('❌ Osiągnięto maksymalną liczbę prób inicjalizacji.');
                    const loadingEl = document.getElementById('preview-loading');
                    if (loadingEl) {
                        loadingEl.innerHTML = `
                    <div class="text-center">
                        <div class="bg-red-100 p-4 rounded-lg mb-4">
                            <svg class="w-12 h-12 text-red-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <p class="text-red-700 font-semibold text-lg">Nie udało się załadować podglądu 3D</p>
                        </div>
                        <button onclick="window.location.reload()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Odśwież stronę
                        </button>
                    </div>
                `;
                    }
                }
            }

            // Funkcja do odświeżania obrazka
            window.reloadArtwork = function() {
                console.log('🔄 Odświeżanie obrazka...');

                if (!scene || !projectConfig.debug.hasArtwork) {
                    console.warn('⚠️ Nie można odświeżyć obrazka - scena nie istnieje lub brak obrazka');
                    return;
                }

                // Usuń stary mesh obrazka z labelGroup (nie ze sceny)
                if (faceMesh && labelGroup.children.includes(faceMesh)) {
                    labelGroup.remove(faceMesh);
                    faceMesh = null;
                }

                // Stwórz kształt etykiety
                const shape = createLabelShape(
                    projectConfig.shape,
                    projectConfig.dimensions.width,
                    projectConfig.dimensions.height
                );

                // Dodaj nowy obrazek
                addArtworkToLabel(shape, 2);
            };

            // NOWA FUNKCJA: Ręczna synchronizacja pozycji obrazka
            window.syncImagePosition = function(positionData) {
                console.log('🔄 Ręczna synchronizacja pozycji obrazka:', positionData);
                
                if (positionData) {
                    projectConfig.imagePosition = positionData;
                    
                    // Zapisz do localStorage
                    localStorage.setItem('imagePosition', JSON.stringify(positionData));
                    
                    if (scene && faceMesh) {
                        scene.remove(faceMesh);
                        const shape = createLabelShape(
                            projectConfig.shape,
                            projectConfig.dimensions.width,
                            projectConfig.dimensions.height
                        );
                        addArtworkToLabel(shape, 2);
                        console.log('✅ Pozycja obrazka zsynchronizowana');
                    }
                }
            };
            
            // FUNKCJA DEBUGOWANIA: Pokaż aktualny stan synchronizacji
            window.debugSync = function() {
                console.log('🔍 DEBUG SYNCHRONIZACJI:');
                console.log('📊 projectConfig.imagePosition:', projectConfig.imagePosition);
                console.log('💾 localStorage imagePosition:', localStorage.getItem('imagePosition'));
                console.log('🎭 scene istnieje:', !!scene);
                console.log('🖼️ faceMesh istnieje:', !!faceMesh);
                console.log('📐 wymiary etykiety:', projectConfig.dimensions);
                console.log('🖼️ URL obrazka:', projectConfig.artworkUrl);
            };
            
            // FUNKCJA TESTOWA: Test pozycjonowania w różnych miejscach
            window.testPositions = function() {
                const positions = [
                    {x: 0, y: 0, name: 'Lewy górny róg'},
                    {x: 100, y: 0, name: 'Prawy górny róg'},
                    {x: 0, y: 100, name: 'Lewy dolny róg'},
                    {x: 100, y: 100, name: 'Prawy dolny róg'},
                    {x: 50, y: 50, name: 'Środek'},
                    {x: 20, y: 50, name: 'Lewa strona'},
                    {x: 80, y: 50, name: 'Prawa strona'}
                ];
                
                let index = 0;
                const testNext = () => {
                    if (index < positions.length) {
                        const pos = positions[index];
                        console.log(`🧪 Test ${index + 1}: ${pos.name} (${pos.x}%, ${pos.y}%)`);
                        window.syncImagePosition({x: pos.x, y: pos.y, scale: 50, rotation: 0});
                        index++;
                        setTimeout(testNext, 2000);
                    }
                };
                testNext();
            };
            
            // FUNKCJA TESTOWA: Test idealnej synchronizacji
            window.testPerfectSync = function() {
                console.log('🎯 TEST IDEALNEJ SYNCHRONIZACJI');
                console.log('1. Ustaw obrazek po lewej stronie w 2D kreatorze');
                console.log('2. Sprawdź czy jest po lewej stronie w 3D podglądzie');
                console.log('3. Ustaw obrazek po prawej stronie w 2D kreatorze');
                console.log('4. Sprawdź czy jest po prawej stronie w 3D podglądzie');
                
                // Test lewej strony
                console.log('🧪 Test: Lewa strona (20%, 50%)');
                window.syncImagePosition({x: 20, y: 50, scale: 40, rotation: 0});
                
                setTimeout(() => {
                    console.log('🧪 Test: Prawa strona (80%, 50%)');
                    window.syncImagePosition({x: 80, y: 50, scale: 40, rotation: 0});
                }, 3000);
            };
            
            // FUNKCJA TESTOWA: Test mapowania kierunków
            window.testDirections = function() {
                console.log('🧭 TEST KIERUNKÓW');
                const tests = [
                    {x: 10, y: 10, name: 'Lewy górny róg'},
                    {x: 90, y: 10, name: 'Prawy górny róg'},
                    {x: 10, y: 90, name: 'Lewy dolny róg'},
                    {x: 90, y: 90, name: 'Prawy dolny róg'},
                    {x: 50, y: 50, name: 'Środek'}
                ];
                
                let index = 0;
                const testNext = () => {
                    if (index < tests.length) {
                        const test = tests[index];
                        console.log(`🧪 Test ${index + 1}: ${test.name} (${test.x}%, ${test.y}%)`);
                        window.syncImagePosition({x: test.x, y: test.y, scale: 30, rotation: 0});
                        index++;
                        setTimeout(testNext, 2000);
                    }
                };
                testNext();
            };
            
            // FUNKCJA TESTOWA: Test lewej i prawej strony
            window.testLeftRight = function() {
                console.log('🔄 TEST LEWA vs PRAWA STRONA');
                
                // Test lewej strony
                console.log('🧪 Lewa strona (20%, 50%)');
                window.syncImagePosition({x: 20, y: 50, scale: 40, rotation: 0});
                
                setTimeout(() => {
                    console.log('🧪 Prawa strona (80%, 50%)');
                    window.syncImagePosition({x: 80, y: 50, scale: 40, rotation: 0});
                }, 3000);
                
                setTimeout(() => {
                    console.log('🧪 Środek (50%, 50%)');
                    window.syncImagePosition({x: 50, y: 50, scale: 40, rotation: 0});
                }, 6000);
            };
            
            // FUNKCJA TESTOWA: Test synchronizacji z 2D kreatora
            window.testSyncFromCreator = function() {
                console.log('🧪 TEST SYNCHRONIZACJI Z 2D KREATORA');
                
                // Symuluj event z 2D kreatora
                const testData = {x: 30, y: 70, scale: 60, rotation: 15};
                console.log('📤 Wysyłam testowy event:', testData);
                
                window.dispatchEvent(new CustomEvent('imagePositionChanged', {
                    detail: testData
                }));
                
                setTimeout(() => {
                    const testData2 = {x: 70, y: 30, scale: 80, rotation: 45};
                    console.log('📤 Wysyłam drugi testowy event:', testData2);
                    window.dispatchEvent(new CustomEvent('imagePositionChanged', {
                        detail: testData2
                    }));
                }, 2000);
            };
            
            // FUNKCJA TESTOWA: Test mapowania lewa/prawa strona
            window.testLeftRightMapping = function() {
                console.log('🧭 TEST MAPOWANIA LEWA/PRAWA STRONA');
                
                // Test lewej strony (powinna być po lewej w 3D)
                console.log('🧪 Lewa strona (20%, 50%) - powinna być po LEWEJ w 3D');
                window.syncImagePosition({x: 20, y: 50, scale: 50, rotation: 0});
                
                setTimeout(() => {
                    // Test prawej strony (powinna być po prawej w 3D)
                    console.log('🧪 Prawa strona (80%, 50%) - powinna być po PRAWEJ w 3D');
                    window.syncImagePosition({x: 80, y: 50, scale: 50, rotation: 0});
                }, 3000);
                
                setTimeout(() => {
                    // Test środka (powinien być po środku w 3D)
                    console.log('🧪 Środek (50%, 50%) - powinien być po ŚRODKU w 3D');
                    window.syncImagePosition({x: 50, y: 50, scale: 50, rotation: 0});
                }, 6000);
            };
            
            // FUNKCJA TESTOWA: Test różnych mapowań
            window.testMapping = function() {
                console.log('🧪 TEST RÓŻNYCH MAPOWAŃ');
                
                const tests = [
                    {x: 10, y: 50, name: 'Bardzo lewa strona'},
                    {x: 25, y: 50, name: 'Lewa strona'},
                    {x: 50, y: 50, name: 'Środek'},
                    {x: 75, y: 50, name: 'Prawa strona'},
                    {x: 90, y: 50, name: 'Bardzo prawa strona'}
                ];
                
                let index = 0;
                const testNext = () => {
                    if (index < tests.length) {
                        const test = tests[index];
                        console.log(`🧪 Test ${index + 1}: ${test.name} (${test.x}%, ${test.y}%)`);
                        window.syncImagePosition({x: test.x, y: test.y, scale: 40, rotation: 0});
                        index++;
                        setTimeout(testNext, 2000);
                    }
                };
                testNext();
            };
            
            // FUNKCJA TESTOWA: Test lewej strony z różnymi mapowaniami
            window.testLeftSide = function() {
                console.log('🧪 TEST LEWEJ STRONY - różne mapowania');
                
                // Test z pozycją 20% (lewa strona w 2D)
                console.log('🎯 Pozycja 20% w 2D - sprawdź gdzie jest w 3D');
                window.syncImagePosition({x: 20, y: 50, scale: 60, rotation: 0});
                
                setTimeout(() => {
                    console.log('🎯 Pozycja 80% w 2D - sprawdź gdzie jest w 3D');
                    window.syncImagePosition({x: 80, y: 50, scale: 60, rotation: 0});
                }, 3000);
            };
            
            // NOWA FUNKCJA: Interaktywne pozycjonowanie 2D w preview
            let isDragging2D = false;
            let dragStart2D = { x: 0, y: 0 };
            let currentPosition2D = { x: 50, y: 50, scale: 100, rotation: 0 };
            
            // Inicjalizuj pozycję z localStorage
            const savedPosition = localStorage.getItem('imagePosition');
            if (savedPosition) {
                try {
                    currentPosition2D = JSON.parse(savedPosition);
                    projectConfig.imagePosition = currentPosition2D;
                } catch (e) {
                    console.warn('⚠️ Błąd parsowania zapisanej pozycji:', e);
                }
            }
            
            // Funkcja inicjalizacji kontenera 2D
            function init2DPositioning() {
                console.log('🚀 INICJALIZACJA KONTENERA 2D');
                
                const container = document.getElementById('positioning-container');
                const labelPreview = document.getElementById('label-preview-2d');
                const image = document.getElementById('positioning-image');
                
                console.log('🔍 Elementy:', {
                    container: !!container,
                    labelPreview: !!labelPreview,
                    image: !!image
                });
                
                if (!container || !labelPreview || !image) {
                    console.warn('⚠️ Nie znaleziono elementów kontenera 2D');
                    console.log('🔍 Sprawdzam dostępne elementy:');
                    console.log('positioning-container:', document.getElementById('positioning-container'));
                    console.log('label-preview-2d:', document.getElementById('label-preview-2d'));
                    console.log('positioning-image:', document.getElementById('positioning-image'));
                    return;
                }
                
                console.log('✅ Wszystkie elementy znalezione, inicjalizuję...');
                
                // Utwórz kształt etykiety w kontenerze 2D
                create2DLabelShape();
                
                // Załaduj obrazek jeśli istnieje
                load2DImage();
                
                // Spróbuj załadować obrazek z localStorage
                setTimeout(() => {
                    loadImageFromStorage();
                }, 500);
                
                // Dodaj event listenery
                add2DDragListeners();
                add2DControlListeners();
                
                // Zaktualizuj wyświetlane wartości
                update2DDisplay();
                
                console.log('✅ Inicjalizacja kontenera 2D zakończona');
            }
            
            // Utwórz kształt etykiety w kontenerze 2D
            function create2DLabelShape() {
                console.log('🎨 TWORZENIE KSZTAŁTU ETYKIETY 2D');
                
                const labelPreview = document.getElementById('label-preview-2d');
                if (!labelPreview) {
                    console.warn('⚠️ Nie znaleziono labelPreview');
                    return;
                }
                
                // Pobierz dane z projectConfig
                const shape = projectConfig.shape || 'rectangle';
                const width = projectConfig.dimensions?.width || 50;
                const height = projectConfig.dimensions?.height || 50;
                const material = projectConfig.material || 'white-matte';
                
                console.log('📐 Dane etykiety:', { shape, width, height, material });
                
                // Skalowanie do kontenera
                const containerSize = 200;
                const scale = Math.min(containerSize / width, containerSize / height);
                const displayWidth = width * scale;
                const displayHeight = height * scale;
                
                console.log('📏 Wymiary wyświetlane:', { displayWidth, displayHeight, scale });
                
                // Klasa materiału
                let materialClass = 'bg-white';
                if (material.includes('gold')) {
                    materialClass = 'bg-gradient-to-br from-yellow-300 via-yellow-500 to-amber-600';
                } else if (material.includes('silver')) {
                    materialClass = 'bg-gradient-to-br from-gray-200 via-gray-400 to-gray-500';
                } else if (material.includes('kraft')) {
                    materialClass = 'bg-amber-100';
                }
                
                // Klasa kształtu
                let shapeClass = 'rounded-lg';
                if (shape === 'circle') {
                    shapeClass = 'rounded-full';
                } else if (shape === 'oval') {
                    shapeClass = 'rounded-full';
                } else if (shape === 'square') {
                    shapeClass = 'rounded-lg';
                } else if (shape === 'star') {
                    shapeClass = 'rounded-lg';
                }
                
                console.log('🎨 Klasy CSS:', { materialClass, shapeClass });
                
                // Utwórz element etykiety
                const labelHTML = `
                    <div class="shadow-lg border border-gray-200 ${materialClass} ${shapeClass}" 
                         style="width: ${displayWidth}px; height: ${displayHeight}px; ${shape === 'star' ? 'clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);' : ''}">
                    </div>
                `;
                
                labelPreview.innerHTML = labelHTML;
                console.log('✅ Kształt etykiety utworzony:', labelHTML);
            }
            
            // Załaduj obrazek do kontenera 2D
            function load2DImage() {
                const image = document.getElementById('positioning-image');
                if (!image) return;
                
                console.log('🖼️ Ładowanie obrazka do kontenera 2D...');
                console.log('🔍 projectConfig.artworkUrl:', projectConfig.artworkUrl);
                console.log('🔍 projectConfig.artwork:', projectConfig.artwork);
                
                let imageUrl = null;
                
                // Spróbuj z projectConfig.artworkUrl (główny sposób)
                if (projectConfig.artworkUrl && projectConfig.artworkUrl !== '') {
                    imageUrl = projectConfig.artworkUrl;
                    console.log('✅ Znaleziono obrazek w projectConfig.artworkUrl:', imageUrl);
                }
                // Spróbuj z projectConfig.artwork
                else if (projectConfig.artwork && projectConfig.artwork.length > 0) {
                    imageUrl = `/storage/${projectConfig.artwork[0]}`;
                    console.log('✅ Znaleziono obrazek w projectConfig.artwork:', imageUrl);
                }
                // Spróbuj z localStorage
                else {
                    const savedArtwork = localStorage.getItem('selectedArtwork');
                    console.log('🔍 savedArtwork z localStorage:', savedArtwork);
                    
                    if (savedArtwork) {
                        try {
                            const artworkData = JSON.parse(savedArtwork);
                            if (artworkData.path) {
                                imageUrl = `/storage/${artworkData.path}`;
                                console.log('✅ Znaleziono obrazek w localStorage:', imageUrl);
                            }
                        } catch (e) {
                            console.warn('⚠️ Błąd parsowania savedArtwork:', e);
                        }
                    }
                }
                
                if (imageUrl) {
                    image.src = imageUrl;
                    image.style.display = 'block';
                    console.log('✅ Obrazek załadowany:', image.src);
                    
                    // Automatyczne dopasowanie po załadowaniu obrazka
                    image.onload = function() {
                        console.log('🖼️ Obrazek załadowany, automatyczne dopasowanie...');
                        currentPosition2D.x = 50;
                        currentPosition2D.y = 50;
                        currentPosition2D.scale = calculateFitScale();
                        currentPosition2D.rotation = 0;
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    };
                    
                    update2DImagePosition();
                } else {
                    console.warn('⚠️ Nie znaleziono obrazka do załadowania w load2DImage');
                    // NIE ukrywaj obrazka - może być załadowany przez inne funkcje
                    console.log('ℹ️ Obrazek pozostaje widoczny - może być załadowany przez inne funkcje');
                }
            }
            
            // Zaktualizuj pozycję obrazka w kontenerze 2D
            function update2DImagePosition() {
                const image = document.getElementById('positioning-image');
                if (!image) return;
                
                const { x, y, scale, rotation } = currentPosition2D;
                
                image.style.left = `${x}%`;
                image.style.top = `${y}%`;
                image.style.transform = `translate(-50%, -50%) scale(${scale/100}) rotate(${rotation}deg)`;
            }
            
            // Dodaj event listenery do przeciągania 2D
            function add2DDragListeners() {
                const container = document.getElementById('positioning-container');
                if (!container) return;
                
                container.addEventListener('mousedown', (e) => {
                    if (e.target.tagName === 'IMG') {
                        isDragging2D = true;
                        dragStart2D = { x: e.clientX, y: e.clientY };
                        container.style.cursor = 'grabbing';
                        e.preventDefault();
                    }
                });
                
                container.addEventListener('mousemove', (e) => {
                    if (isDragging2D) {
                        const deltaX = e.clientX - dragStart2D.x;
                        const deltaY = e.clientY - dragStart2D.y;
                        
                        // Przelicz deltę na procenty
                        const sensitivity = 0.5;
                        const newX = Math.max(0, Math.min(100, currentPosition2D.x + (deltaX * sensitivity)));
                        const newY = Math.max(0, Math.min(100, currentPosition2D.y + (deltaY * sensitivity)));
                        
                        currentPosition2D.x = newX;
                        currentPosition2D.y = newY;
                        
                        // Zaktualizuj wyświetlanie
                        update2DImagePosition();
                        update2DDisplay();
                        
                        // Synchronizuj z 3D
                        sync2DTo3D();
                        
                        // Zaktualizuj punkt startowy
                        dragStart2D = { x: e.clientX, y: e.clientY };
                    }
                });
                
                container.addEventListener('mouseup', () => {
                    if (isDragging2D) {
                        isDragging2D = false;
                        container.style.cursor = 'move';
                    }
                });
                
                container.addEventListener('mouseleave', () => {
                    if (isDragging2D) {
                        isDragging2D = false;
                        container.style.cursor = 'move';
                    }
                });
            }
            
            // Dodaj event listenery do kontrolek 2D
            function add2DControlListeners() {
                const posXSlider = document.getElementById('posX-slider');
                const posYSlider = document.getElementById('posY-slider');
                const scaleSlider = document.getElementById('scale-slider');
                const rotationSlider = document.getElementById('rotation-slider');
                const resetBtn = document.getElementById('reset-position-btn');
                const centerBtn = document.getElementById('center-position-btn');
                
                if (posXSlider) {
                    posXSlider.addEventListener('input', (e) => {
                        currentPosition2D.x = parseFloat(e.target.value);
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
                
                if (posYSlider) {
                    posYSlider.addEventListener('input', (e) => {
                        currentPosition2D.y = parseFloat(e.target.value);
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
                
                if (scaleSlider) {
                    scaleSlider.addEventListener('input', (e) => {
                        currentPosition2D.scale = parseInt(e.target.value);
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
                
                if (rotationSlider) {
                    rotationSlider.addEventListener('input', (e) => {
                        currentPosition2D.rotation = parseInt(e.target.value);
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
                
                if (resetBtn) {
                    resetBtn.addEventListener('click', () => {
                        currentPosition2D = { x: 50, y: 50, scale: 100, rotation: 0 };
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
                
                if (centerBtn) {
                    centerBtn.addEventListener('click', () => {
                        currentPosition2D.x = 50;
                        currentPosition2D.y = 50;
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
                
                const fitBtn = document.getElementById('fit-image-btn');
                const fillBtn = document.getElementById('fill-image-btn');
                
                if (fitBtn) {
                    fitBtn.addEventListener('click', () => {
                        console.log('🎯 FIT - dopasuj obrazek do etykiety');
                        currentPosition2D.x = 50;
                        currentPosition2D.y = 50;
                        currentPosition2D.scale = calculateFitScale(); // Inteligentne obliczenie skali
                        currentPosition2D.rotation = 0;
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
                
                if (fillBtn) {
                    fillBtn.addEventListener('click', () => {
                        console.log('🎯 WYPEŁNIJ - rozciągnij obrazek na całą etykietę');
                        currentPosition2D.x = 50;
                        currentPosition2D.y = 50;
                        currentPosition2D.scale = calculateFillScale(); // Inteligentne obliczenie skali
                        currentPosition2D.rotation = 0;
                        update2DImagePosition();
                        update2DDisplay();
                        sync2DTo3D();
                    });
                }
            }
            
            // Zaktualizuj wyświetlane wartości w kontenerze 2D
            function update2DDisplay() {
                const posXDisplay = document.getElementById('posX-display');
                const posYDisplay = document.getElementById('posY-display');
                const scaleDisplay = document.getElementById('scale-display');
                const rotationDisplay = document.getElementById('rotation-display');
                
                const posXSlider = document.getElementById('posX-slider');
                const posYSlider = document.getElementById('posY-slider');
                const scaleSlider = document.getElementById('scale-slider');
                const rotationSlider = document.getElementById('rotation-slider');
                
                // Zaktualizuj wyświetlane wartości
                if (posXDisplay) posXDisplay.textContent = currentPosition2D.x.toFixed(1) + '%';
                if (posYDisplay) posYDisplay.textContent = currentPosition2D.y.toFixed(1) + '%';
                if (scaleDisplay) scaleDisplay.textContent = currentPosition2D.scale + '%';
                if (rotationDisplay) rotationDisplay.textContent = currentPosition2D.rotation + '°';
                
                // Zaktualizuj wartości suwaków
                if (posXSlider) posXSlider.value = currentPosition2D.x;
                if (posYSlider) posYSlider.value = currentPosition2D.y;
                if (scaleSlider) scaleSlider.value = currentPosition2D.scale;
                if (rotationSlider) rotationSlider.value = currentPosition2D.rotation;
                
                console.log('🔄 Zaktualizowano wyświetlanie 2D:', currentPosition2D);
            }
            
            // Synchronizuj pozycję 2D z 3D
            function sync2DTo3D() {
                console.log('🔄 SYNCHRONIZACJA 2D → 3D:', currentPosition2D);
                
                // Zaktualizuj projectConfig
                projectConfig.imagePosition = currentPosition2D;
                
                // Zapisz do localStorage
                localStorage.setItem('imagePosition', JSON.stringify(currentPosition2D));
                
                // Wymuś aktualizację 3D
                if (typeof updateImagePosition === 'function') {
                    updateImagePosition();
                    console.log('✅ Etykieta 3D zaktualizowana');
                } else {
                    console.warn('⚠️ Funkcja updateImagePosition nie istnieje');
                }
            }
            
            // Funkcja do ręcznego załadowania obrazka
            function loadImageFromStorage() {
                console.log('🔄 Próba załadowania obrazka z localStorage...');
                
                // Sprawdź różne klucze w localStorage
                const keys = ['selectedArtwork', 'artwork', 'tempArtworkPath', 'imagePath'];
                let artworkPath = null;
                
                for (const key of keys) {
                    const value = localStorage.getItem(key);
                    console.log(`🔍 Sprawdzam klucz "${key}":`, value);
                    
                    if (value) {
                        try {
                            const parsed = JSON.parse(value);
                            if (parsed.path) {
                                artworkPath = parsed.path;
                                break;
                            } else if (typeof parsed === 'string') {
                                artworkPath = parsed;
                                break;
                            }
                        } catch (e) {
                            // Jeśli nie można sparsować jako JSON, użyj jako string
                            if (typeof value === 'string' && value.includes('.')) {
                                artworkPath = value;
                                break;
                            }
                        }
                    }
                }
                
                if (artworkPath) {
                    console.log('✅ Znaleziono ścieżkę obrazka:', artworkPath);
                    const image = document.getElementById('positioning-image');
                    if (image) {
                        image.src = `/storage/${artworkPath}`;
                        image.style.display = 'block';
                        update2DImagePosition();
                    }
                } else {
                    console.warn('⚠️ Nie znaleziono obrazka w localStorage');
                }
            }
            
            // Funkcja do debugowania localStorage
            window.debugLocalStorage = function() {
                console.log('🔍 DEBUG LOCALSTORAGE:');
                for (let i = 0; i < localStorage.length; i++) {
                    const key = localStorage.key(i);
                    const value = localStorage.getItem(key);
                    console.log(`${key}:`, value);
                }
            };
            
            // Funkcja do ręcznego załadowania obrazka
            window.loadImage = function() {
                loadImageFromStorage();
            };
            
            // Funkcja do załadowania prawdziwego obrazka
            window.loadRealImage = function() {
                console.log('🖼️ ŁADOWANIE PRAWDZIWEGO OBRAZKA');
                load2DImage();
            };
            
            // Funkcja do debugowania obrazka
            window.debugImage = function() {
                console.log('🔍 DEBUG OBRAZKA');
                console.log('projectConfig:', projectConfig);
                console.log('projectConfig.artworkUrl:', projectConfig.artworkUrl);
                console.log('projectConfig.artwork:', projectConfig.artwork);
                
                const image = document.getElementById('positioning-image');
                console.log('Obrazek element:', image);
                if (image) {
                    console.log('Obrazek src:', image.src);
                    console.log('Obrazek display:', image.style.display);
                    console.log('Obrazek naturalWidth:', image.naturalWidth);
                    console.log('Obrazek naturalHeight:', image.naturalHeight);
                    console.log('Obrazek complete:', image.complete);
                    console.log('Obrazek readyState:', image.readyState);
                }
                
                // Sprawdź localStorage
                const savedArtwork = localStorage.getItem('selectedArtwork');
                console.log('savedArtwork:', savedArtwork);
                
                // Sprawdź wszystkie klucze localStorage
                console.log('Wszystkie klucze localStorage:');
                for (let i = 0; i < localStorage.length; i++) {
                    const key = localStorage.key(i);
                    console.log(`${key}:`, localStorage.getItem(key));
                }
            };
            
            // Funkcja do monitorowania znikającego obrazka
            window.monitorImage = function() {
                const image = document.getElementById('positioning-image');
                if (!image) return;
                
                console.log('👁️ MONITOROWANIE OBRAZKA');
                
                // Monitoruj zmiany display
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                            console.log('🔄 Zmiana style:', image.style.display);
                            if (image.style.display === 'none') {
                                console.warn('⚠️ OBRAZEK ZNIKA! Przyczyna:', new Error().stack);
                            }
                        }
                    });
                });
                
                observer.observe(image, { attributes: true, attributeFilter: ['style'] });
                
                // Monitoruj zmiany src
                const srcObserver = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'src') {
                            console.log('🔄 Zmiana src:', image.src);
                        }
                    });
                });
                
                srcObserver.observe(image, { attributes: true, attributeFilter: ['src'] });
                
                console.log('✅ Monitoring włączony');
            };
            
            // Funkcja do debugowania klonowania
            window.debugCloning = function() {
                console.log('🔍 DEBUG KLONOWANIA');
                console.log('labelGroup.children.length:', labelGroup.children.length);
                console.log('scene.children.length:', scene.children.length);
                
                // Sprawdź wszystkie meshe w labelGroup
                labelGroup.children.forEach((child, index) => {
                    console.log(`Mesh ${index}:`, {
                        type: child.type,
                        position: child.position,
                        scale: child.scale,
                        visible: child.visible
                    });
                });
                
                // Sprawdź czy faceMesh istnieje
                console.log('faceMesh:', faceMesh);
                if (faceMesh) {
                    console.log('faceMesh.parent:', faceMesh.parent);
                    console.log('faceMesh.scale:', faceMesh.scale);
                }
            };
            
            // Funkcja do debugowania znikającego obrazka
            window.debugImageDisappearing = function() {
                console.log('🔍 DEBUG ZNIKAJĄCEGO OBRAZKA');
                console.log('faceMesh:', faceMesh);
                console.log('faceMesh.visible:', faceMesh ? faceMesh.visible : 'undefined');
                console.log('faceMesh.scale:', faceMesh ? faceMesh.scale : 'undefined');
                console.log('faceMesh.position:', faceMesh ? faceMesh.position : 'undefined');
                console.log('faceMesh.material:', faceMesh ? faceMesh.material : 'undefined');
                
                if (faceMesh && faceMesh.material) {
                    console.log('faceMesh.material.visible:', faceMesh.material.visible);
                    console.log('faceMesh.material.opacity:', faceMesh.material.opacity);
                    console.log('faceMesh.material.transparent:', faceMesh.material.transparent);
                }
                
                console.log('labelGroup.children.length:', labelGroup.children.length);
                console.log('scene.children.length:', scene.children.length);
            };
            
            // Funkcja do przywrócenia obrazka
            window.restoreImage = function() {
                console.log('🔄 PRZYWRACANIE OBRAZKA');
                
                if (faceMesh) {
                    // Przywróć widoczność
                    faceMesh.visible = true;
                    
                    // Przywróć domyślną skalę
                    faceMesh.scale.set(1, 1, 1);
                    
                    // Przywróć domyślną pozycję
                    faceMesh.position.set(0, 0, 0.6);
                    
                    // Przywróć domyślny offset tekstury
                    if (faceMesh.material && faceMesh.material.map) {
                        faceMesh.material.map.offset.set(0, 0);
                        faceMesh.material.map.rotation = 0;
                    }
                    
                    console.log('✅ Obrazek przywrócony');
                } else {
                    console.warn('⚠️ Brak faceMesh - nie można przywrócić');
                }
            };
            
            // Funkcja do wymuszenia ponownego załadowania obrazka
            window.forceReloadImage = function() {
                console.log('🔄 WYMUSZENIE PONOWNEGO ZAŁADOWANIA OBRAZKA');
                
                // Wywołaj addArtworkToLabel ponownie
                if (typeof addArtworkToLabel === 'function') {
                    addArtworkToLabel();
                    console.log('✅ Obrazek ponownie załadowany');
                } else {
                    console.warn('⚠️ Funkcja addArtworkToLabel nie istnieje');
                }
            };
            
            // Funkcja do debugowania bezpiecznego ograniczenia
            window.debugSafeBounds = function() {
                console.log('🔍 DEBUG BEZPIECZNEGO OGRANICZENIA');
                const { maxScaleX, maxScaleY } = calculateMaxScaleSafe();
                console.log('Maksymalne skale:', { maxScaleX, maxScaleY });
                
                if (faceMesh) {
                    console.log('Aktualna skala faceMesh:', faceMesh.scale);
                    console.log('faceMesh.visible:', faceMesh.visible);
                }
                
                console.log('projectConfig.dimensions:', projectConfig.dimensions);
            };
            
            // Funkcja do testowania ograniczeń wymiarów
            window.testBounds = function() {
                console.log('🧪 TEST OGRANICZEŃ WYMIARÓW');
                
                // Test z różnymi skalami
                const testScales = [0.5, 1.0, 1.5, 2.0, 3.0];
                
                testScales.forEach(scale => {
                    const { maxScaleX, maxScaleY } = calculateMaxScaleSafe();
                    const limitedX = Math.min(scale, maxScaleX);
                    const limitedY = Math.min(scale, maxScaleY);
                    
                    console.log(`Skala ${scale}:`, {
                        'maxScaleX': maxScaleX,
                        'maxScaleY': maxScaleY,
                        'limitedX': limitedX,
                        'limitedY': limitedY,
                        'ograniczone': limitedX < scale || limitedY < scale
                    });
                });
            };
            
            // Funkcja do testowania rzeczywistych wymiarów obrazka
            window.testRealImageBounds = function() {
                console.log('🧪 TEST RZECZYWISTYCH WYMIARÓW OBRAZKA');
                
                // Test z obrazkiem 2D
                const image = document.getElementById('positioning-image');
                if (image) {
                    console.log('Obrazek 2D:', {
                        'naturalWidth': image.naturalWidth,
                        'naturalHeight': image.naturalHeight,
                        'aspect': image.naturalWidth / image.naturalHeight
                    });
                }
                
                // Test z teksturą 3D
                if (faceMesh && faceMesh.material && faceMesh.material.map && faceMesh.material.map.image) {
                    const img = faceMesh.material.map.image;
                    console.log('Obrazek 3D:', {
                        'width': img.width,
                        'height': img.height,
                        'naturalWidth': img.naturalWidth,
                        'naturalHeight': img.naturalHeight,
                        'aspect': (img.width || img.naturalWidth) / (img.height || img.naturalHeight)
                    });
                }
                
                // Test calculateMaxScaleSafe
                const bounds = calculateMaxScaleSafe();
                console.log('Maksymalne skale:', bounds);
            };
            
            // Funkcja do testowania skalowania
            window.testScaling = function() {
                console.log('🧪 TEST SKALOWANIA');
                
                if (!faceMesh) {
                    console.warn('⚠️ Brak faceMesh - nie można testować skalowania');
                    return;
                }
                
                console.log('Aktualna skala faceMesh:', faceMesh.scale);
                console.log('Aktualna pozycja faceMesh:', faceMesh.position);
                
                // Test z różnymi skalami
                const testScales = [0.5, 1.0, 1.5, 2.0];
                
                testScales.forEach(scale => {
                    console.log(`\n--- TEST SKALI ${scale} ---`);
                    
                    // Symuluj obliczenia jak w updateImagePosition
                    const userScale = scale;
                    const imgAspect = 1; // Domyślna proporcja
                    const labelAspect = projectConfig.dimensions.width / projectConfig.dimensions.height;
                    
                    let scaleX, scaleY;
                    if (imgAspect > labelAspect) {
                        scaleY = userScale;
                        scaleX = userScale * (labelAspect / imgAspect);
                    } else {
                        scaleX = userScale;
                        scaleY = userScale * (imgAspect / labelAspect);
                    }
                    
                    const { maxScaleX, maxScaleY } = calculateMaxScaleSafe();
                    const limitedScaleX = Math.min(scaleX, maxScaleX);
                    const limitedScaleY = Math.min(scaleY, maxScaleY);
                    
                    console.log(`Skala ${scale}:`, {
                        'scaleX': scaleX,
                        'scaleY': scaleY,
                        'maxScaleX': maxScaleX,
                        'maxScaleY': maxScaleY,
                        'limitedScaleX': limitedScaleX,
                        'limitedScaleY': limitedScaleY,
                        'ograniczone': limitedScaleX < scaleX || limitedScaleY < scaleY
                    });
                });
            };
            
            // Funkcja do sprawdzenia stanu faceMesh
            window.checkFaceMesh = function() {
                console.log('🔍 SPRAWDZANIE STANU FACE MESH');
                console.log('faceMesh:', faceMesh);
                console.log('faceMesh type:', typeof faceMesh);
                console.log('faceMesh === null:', faceMesh === null);
                console.log('faceMesh === undefined:', faceMesh === undefined);
                
                if (faceMesh) {
                    console.log('faceMesh.scale:', faceMesh.scale);
                    console.log('faceMesh.position:', faceMesh.position);
                    console.log('faceMesh.visible:', faceMesh.visible);
                    console.log('faceMesh.parent:', faceMesh.parent);
                    console.log('faceMesh.material:', faceMesh.material);
                    
                    if (faceMesh.material && faceMesh.material.map) {
                        console.log('faceMesh.material.map:', faceMesh.material.map);
                        console.log('faceMesh.material.map.offset:', faceMesh.material.map.offset);
                        console.log('faceMesh.material.map.rotation:', faceMesh.material.map.rotation);
                    }
                } else {
                    console.warn('⚠️ faceMesh nie istnieje!');
                    
                    // Sprawdź czy istnieje w scene
                    if (scene) {
                        console.log('scene.children.length:', scene.children.length);
                        console.log('scene.children:', scene.children);
                    }
                    
                    // Sprawdź czy istnieje w labelGroup
                    if (labelGroup) {
                        console.log('labelGroup.children.length:', labelGroup.children.length);
                        console.log('labelGroup.children:', labelGroup.children);
                    }
                }
            };
            
            // Funkcja do testowania proporcji
            window.testAspectRatio = function() {
                console.log('🧪 TEST PROPORCJI OBRAZKA');
                
                if (!faceMesh) {
                    console.warn('⚠️ Brak faceMesh - nie można testować proporcji');
                    return;
                }
                
                // Test z tekstury 3D
                if (faceMesh.material && faceMesh.material.map && faceMesh.material.map.image) {
                    const img = faceMesh.material.map.image;
                    const imgWidth = img.width || img.naturalWidth || 1;
                    const imgHeight = img.height || img.naturalHeight || 1;
                    const imgAspect = imgWidth / imgHeight;
                    
                    console.log('Obrazek 3D:', {
                        'img.width': img.width,
                        'img.naturalWidth': img.naturalWidth,
                        'img.height': img.height,
                        'img.naturalHeight': img.naturalHeight,
                        'imgWidth': imgWidth,
                        'imgHeight': imgHeight,
                        'imgAspect': imgAspect
                    });
                }
                
                // Test z obrazka 2D
                const image = document.getElementById('positioning-image');
                if (image) {
                    const imgWidth = image.naturalWidth || 1;
                    const imgHeight = image.naturalHeight || 1;
                    const imgAspect = imgWidth / imgHeight;
                    
                    console.log('Obrazek 2D:', {
                        'naturalWidth': image.naturalWidth,
                        'naturalHeight': image.naturalHeight,
                        'imgAspect': imgAspect
                    });
                }
                
                // Test etykiety
                if (projectConfig && projectConfig.dimensions) {
                    const labelAspect = projectConfig.dimensions.width / projectConfig.dimensions.height;
                    console.log('Etykieta:', {
                        'width': projectConfig.dimensions.width,
                        'height': projectConfig.dimensions.height,
                        'labelAspect': labelAspect
                    });
                }
            };
            
            // Funkcja do testowania przycisków Fit i Wypełnij
            window.testFitFillButtons = function() {
                console.log('🧪 TEST PRZYCISKÓW FIT I WYPEŁNIJ');
                
                // Test Fit
                const fitScale = calculateFitScale();
                console.log('Fit scale:', fitScale);
                
                // Test Wypełnij
                const fillScale = calculateFillScale();
                console.log('Fill scale:', fillScale);
                
                // Test z różnymi skalami
                console.log('Test z różnymi skalami:');
                console.log('Fit 50%:', calculateFitScale() * 0.5);
                console.log('Fit 100%:', calculateFitScale());
                console.log('Fill 50%:', calculateFillScale() * 0.5);
                console.log('Fill 100%:', calculateFillScale());
            };
            
            // Funkcja do testowania clipping
            window.testClipping = function() {
                console.log('✂️ TEST CLIPPING');
                
                if (faceMesh && faceMesh.material) {
                    console.log('faceMesh.material.clippingPlanes:', faceMesh.material.clippingPlanes);
                    console.log('faceMesh.material.clipShadows:', faceMesh.material.clipShadows);
                    console.log('renderer.localClippingEnabled:', renderer.localClippingEnabled);
                } else {
                    console.log('❌ Brak faceMesh lub materiału');
                }
            };
            
            // Funkcja do wymuszenia skalowania
            window.forceScale = function(scale) {
                console.log(`🔄 WYMUSZENIE SKALI ${scale}`);
                
                if (!faceMesh) {
                    console.warn('⚠️ Brak faceMesh - nie można skalować');
                    return;
                }
                
                // Ustaw skalę bezpośrednio
                faceMesh.scale.set(scale, scale, 1);
                
                console.log('✅ Skala ustawiona:', faceMesh.scale);
            };
            
            // Profesjonalna funkcja do ładowania obrazka z różnych źródeł
            window.forceLoadImage = function() {
                console.log('🔄 PROFESJONALNE ŁADOWANIE OBRAZKA');
                const image = document.getElementById('positioning-image');
                if (!image) {
                    console.warn('❌ Nie znaleziono elementu obrazka');
                    return;
                }
                
                // Sprawdź czy obrazek jest już załadowany
                if (image.src && image.src !== '' && image.complete && image.naturalWidth > 0) {
                    console.log('✅ Obrazek już załadowany:', image.src);
                    image.style.display = 'block';
                    return;
                }
                
                // Tylko prawdziwe źródła obrazków (bez testowych)
                const sources = [
                    projectConfig.artworkUrl,
                    projectConfig.artwork && projectConfig.artwork.length > 0 ? `/storage/${projectConfig.artwork[0]}` : null,
                    '/images/placeholder-image.png'
                ].filter(src => src); // Usuń puste wartości
                
                if (sources.length === 0) {
                    console.warn('⚠️ Brak dostępnych źródeł obrazka w forceLoadImage');
                    // NIE ukrywaj obrazka - może być już załadowany
                    console.log('ℹ️ Obrazek pozostaje widoczny - może być już załadowany');
                    return;
                }
                
                let loaded = false;
                sources.forEach((src, index) => {
                    if (!loaded) {
                        console.log(`🔄 Próba ${index + 1}: ${src}`);
                        image.src = src;
                        image.style.display = 'block';
                        image.onload = function() {
                            console.log(`✅ Obrazek załadowany z źródła ${index + 1}: ${src}`);
                            loaded = true;
                            
                            // Automatyczne dopasowanie
                            currentPosition2D.x = 50;
                            currentPosition2D.y = 50;
                            currentPosition2D.scale = calculateFitScale();
                            currentPosition2D.rotation = 0;
                            update2DImagePosition();
                            update2DDisplay();
                            sync2DTo3D();
                        };
                        image.onerror = function() {
                            console.warn(`❌ Błąd ładowania z źródła ${index + 1}: ${src}`);
                            if (index === sources.length - 1) {
                                // Ostatnie źródło - ale NIE ukrywaj obrazka
                                console.warn('⚠️ Wszystkie źródła obrazka nieudane, ale obrazek pozostaje widoczny');
                                // Sprawdź czy obrazek ma już src
                                if (!image.src || image.src === '') {
                                    console.log('ℹ️ Obrazek nie ma src - ukrywamy');
                                    image.style.display = 'none';
                                } else {
                                    console.log('ℹ️ Obrazek ma src - pozostaje widoczny');
                                }
                            }
                        };
                    }
                });
            };
            
            // Funkcja do inteligentnego dopasowania obrazka (Fit - mieści cały obrazek)
            function calculateFitScale() {
                if (!projectConfig || !projectConfig.dimensions) return 80;
                
                // Pobierz proporcje etykiety 3D
                const labelAspect = projectConfig.dimensions.width / projectConfig.dimensions.height;
                
                // Pobierz proporcje obrazka z obrazka 2D
                const image = document.getElementById('positioning-image');
                if (!image || !image.complete) return 80;
                
                const imageWidth = image.naturalWidth;
                const imageHeight = image.naturalHeight;
                
                if (!imageWidth || !imageHeight) return 80;
                
                const imageAspect = imageWidth / imageHeight;
                
                // FIT: Oblicz skalę żeby zmieścić cały obrazek w etykiecie (rog do rogu)
                // W Three.js wszystko jest w jednostkach względnych
                let fitScale;
                
                if (imageAspect > labelAspect) {
                    // Obrazek jest szerszy - ogranicz do szerokości etykiety
                    fitScale = 100; // 100% szerokości etykiety
                } else {
                    // Obrazek jest wyższy - ogranicz do wysokości etykiety
                    fitScale = 100; // 100% wysokości etykiety
                }
                
                console.log('📐 Obliczenia Fit (rog do rogu na etykiecie 3D):', {
                    imageWidth,
                    imageHeight,
                    imageAspect,
                    labelAspect,
                    fitScale
                });
                
                return Math.min(Math.max(fitScale, 20), 200);
            }
            
            // Funkcja do inteligentnego wypełnienia obrazka (Wypełnij - wypełnij całą etykietę)
            function calculateFillScale() {
                if (!projectConfig || !projectConfig.dimensions) return 120;
                
                // Pobierz proporcje etykiety 3D
                const labelAspect = projectConfig.dimensions.width / projectConfig.dimensions.height;
                
                // Pobierz proporcje obrazka z obrazka 2D
                const image = document.getElementById('positioning-image');
                if (!image || !image.complete) return 120;
                
                const imageWidth = image.naturalWidth;
                const imageHeight = image.naturalHeight;
                
                if (!imageWidth || !imageHeight) return 120;
                
                const imageAspect = imageWidth / imageHeight;
                
                // WYPEŁNIJ: Oblicz skalę żeby wypełnić całą etykietę
                // W Three.js wszystko jest w jednostkach względnych
                let fillScale;
                
                if (imageAspect > labelAspect) {
                    // Obrazek jest szerszy - wypełnij wysokość etykiety
                    fillScale = 150; // 150% żeby wypełnić całą wysokość
                } else {
                    // Obrazek jest wyższy - wypełnij szerokość etykiety
                    fillScale = 150; // 150% żeby wypełnić całą szerokość
                }
                
                console.log('📐 Obliczenia Fill (wypełnij całą etykietę 3D):', {
                    imageWidth,
                    imageHeight,
                    imageAspect,
                    labelAspect,
                    fillScale
                });
                
                return Math.min(Math.max(fillScale, 50), 300);
            }
            
            // Funkcja do debugowania całego systemu
            window.debugSystem = function() {
                console.log('🔍 DEBUG CAŁEGO SYSTEMU');
                console.log('projectConfig:', projectConfig);
                console.log('projectConfig.artworkUrl:', projectConfig.artworkUrl);
                console.log('projectConfig.artwork:', projectConfig.artwork);
                console.log('projectConfig.imagePosition:', projectConfig.imagePosition);
                
                const image = document.getElementById('positioning-image');
                console.log('Obrazek element:', image);
                if (image) {
                    console.log('Obrazek src:', image.src);
                    console.log('Obrazek display:', image.style.display);
                }
                
                const container = document.getElementById('positioning-container');
                console.log('Kontener:', container);
                
                const sliders = document.querySelectorAll('input[type="range"]');
                console.log('Suwaki:', sliders.length);
            };
            
            // Funkcja do debugowania pozycjonowania
            window.debugPositioning = function() {
                console.log('🔍 DEBUG POZYCJONOWANIA:');
                console.log('currentPosition2D:', currentPosition2D);
                console.log('projectConfig.imagePosition:', projectConfig.imagePosition);
                
                const image = document.getElementById('positioning-image');
                if (image) {
                    console.log('Obrazek:', {
                        src: image.src,
                        display: image.style.display,
                        left: image.style.left,
                        top: image.style.top,
                        transform: image.style.transform
                    });
                }
                
                const container = document.getElementById('positioning-container');
                if (container) {
                    console.log('Kontener:', {
                        exists: !!container,
                        children: container.children.length
                    });
                }
            };
            
            // Funkcja do testowania pozycjonowania
            window.testPositioning = function() {
                console.log('🧪 TEST POZYCJONOWANIA');
                currentPosition2D = { x: 20, y: 30, scale: 80, rotation: 45 };
                update2DImagePosition();
                update2DDisplay();
                sync2DTo3D();
            };
            
            // Profesjonalna funkcja do testowania obrazka
            window.testImage = function() {
                console.log('🧪 PROFESJONALNY TEST OBRAZKA');
                const image = document.getElementById('positioning-image');
                if (image) {
                    // Spróbuj załadować prawdziwy obrazek
                    window.forceLoadImage();
                } else {
                    console.warn('❌ Nie znaleziono elementu obrazka');
                }
            };
            
            // Funkcja do ręcznej inicjalizacji
            window.init2D = function() {
                console.log('🔄 RĘCZNA INICJALIZACJA 2D');
                init2DPositioning();
            };
            
            // Funkcja do testowania suwaków
            window.testSliders = function() {
                console.log('🧪 TEST SUWAKÓW');
                const sliders = ['posX-slider', 'posY-slider', 'scale-slider', 'rotation-slider'];
                sliders.forEach(id => {
                    const slider = document.getElementById(id);
                    if (slider) {
                        console.log(`✅ Suwak ${id} znaleziony`);
                    } else {
                        console.warn(`❌ Suwak ${id} NIE znaleziony`);
                    }
                });
            };
            
            // Prosta funkcja testowa - nie zależy od projectConfig
            // Profesjonalna funkcja testowa
            window.simpleTest = function() {
                console.log('🧪 PROFESJONALNY TEST');
                
                // Sprawdź elementy
                const container = document.getElementById('positioning-container');
                const image = document.getElementById('positioning-image');
                const sliders = document.querySelectorAll('input[type="range"]');
                
                console.log('Elementy:', {
                    container: !!container,
                    image: !!image,
                    sliders: sliders.length
                });
                
                // Spróbuj załadować prawdziwy obrazek
                if (image) {
                    window.forceLoadImage();
                    console.log('✅ Próba załadowania prawdziwego obrazka');
                }
                
                console.log('✅ Test zakończony');
            };
            
            
            // Funkcja aktualizacji pozycji obrazka
            function updateImagePosition() {
                if (scene && faceMesh) {
                    // NIE usuwaj mesh - tylko zaktualizuj jego właściwości
                    const { x, y, scale, rotation } = projectConfig.imagePosition;
                    
                    // Oblicz pozycję w 3D
                    const percentX = x / 100;
                    const percentY = y / 100;
                    const offsetX = percentX - 0.5;
                    const offsetY = percentY - 0.5;
                    
                    // Aktualizuj offset tekstury
                    if (faceMesh.material && faceMesh.material.map) {
                        faceMesh.material.map.offset.set(offsetX, offsetY);
                    }
                    
                    // Aktualizuj skalę mesh - BEZ ograniczeń (jak było wcześniej)
                    const userScale = scale / 100;
                    const imgAspect = 1; // Domyślna proporcja
                    const labelAspect = projectConfig.dimensions.width / projectConfig.dimensions.height;
                    
                    let scaleX, scaleY;
                    if (imgAspect > labelAspect) {
                        scaleY = userScale;
                        scaleX = userScale * (labelAspect / imgAspect);
                    } else {
                        scaleX = userScale;
                        scaleY = userScale * (imgAspect / labelAspect);
                    }
                    
                    faceMesh.scale.set(scaleX, scaleY, 1);
                    
                    // Aktualizuj obrót
                    const rotationRad = (rotation * Math.PI) / 180;
                    if (faceMesh.material && faceMesh.material.map) {
                        faceMesh.material.map.rotation = -rotationRad;
                    }
                    
                    console.log('✅ Pozycjonowanie obrazka zaktualizowane (bez klonowania):', {
                        offset: { x: offsetX, y: offsetY },
                        scale: { x: scaleX, y: scaleY },
                        rotation: rotationRad,
                        meshCount: labelGroup.children.length
                    });
                } else {
                    console.warn('⚠️ Nie można zaktualizować pozycji - brak sceny lub mesh');
                }
            }
            
            
            // FUNKCJA TESTOWA: Wymuś aktualizację pozycji
            window.forceUpdatePosition = function(x, y, scale, rotation) {
                const newPos = {
                    x: x || 20,
                    y: y || 50,
                    scale: scale || 60,
                    rotation: rotation || 0
                };
                
                console.log('🔄 WYMUSZAM AKTUALIZACJĘ POZYCJI:', newPos);
                
                // Zaktualizuj projectConfig
                projectConfig.imagePosition = newPos;
                console.log('✅ projectConfig.imagePosition zaktualizowany:', projectConfig.imagePosition);
                
                // Zapisz do localStorage
                localStorage.setItem('imagePosition', JSON.stringify(newPos));
                
                // Wymuś ponowne renderowanie
                if (scene && faceMesh) {
                    console.log('🔄 Usuwam stary faceMesh...');
                    scene.remove(faceMesh);
                    
                    console.log('🔄 Tworzę nowy kształt...');
                    const shape = createLabelShape(
                        projectConfig.shape,
                        projectConfig.dimensions.width,
                        projectConfig.dimensions.height
                    );
                    
                    console.log('🔄 Dodaję nowy obrazek...');
                    addArtworkToLabel(shape, 2);
                    
                    console.log('✅ Pozycja wymuszona!');
                } else {
                    console.warn('⚠️ Scena lub faceMesh nie istnieje!');
                }
            };

            // Czyszczenie zasobów przy opuszczaniu strony
            window.addEventListener('beforeunload', function() {
                isAnimating = false;

                // Zwolnij zasoby
                if (renderer) {
                    renderer.dispose();
                    renderer.forceContextLoss();
                }

                if (scene) {
                    while (scene.children.length > 0) {
                        const object = scene.children[0];
                        scene.remove(object);
                    }
                }
            });
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('goToCheckoutBtn');
                if (btn) {
                    btn.addEventListener('click', function() {
                        window.location.href = "{{ route('checkout') }}";
                    });
                }
                
                // Dodaj interaktywne pozycjonowanie po załadowaniu sceny
                setTimeout(() => {
                    console.log('⏰ Wywołuję inicjalizację 2D po 1 sekundzie');
                    console.log('🔍 projectConfig przed inicjalizacją:', projectConfig);
                    if (typeof init2DPositioning === 'function') {
                        init2DPositioning();
                    } else {
                        console.warn('⚠️ Funkcja init2DPositioning nie istnieje');
                    }
                }, 1000);
                
                // Dodatkowa inicjalizacja po 3 sekundach na wypadek problemów
                setTimeout(() => {
                    console.log('⏰ Dodatkowa inicjalizacja 2D po 3 sekundach');
                    init2DPositioning();
                }, 3000);
                
        // Profesjonalna inicjalizacja po 2 sekundach
        setTimeout(() => {
            console.log('⏰ Profesjonalna inicjalizacja po 2 sekundach');
            if (typeof window.forceLoadImage === 'function') {
                window.forceLoadImage();
            }
            if (typeof window.monitorImage === 'function') {
                window.monitorImage();
            }
        }, 2000);
                
        // Profesjonalna inicjalizacja kontenera 2D po 3 sekundach
        setTimeout(() => {
            console.log('⏰ Profesjonalna inicjalizacja kontenera 2D po 3 sekundach');
            const container = document.getElementById('positioning-container');
            const image = document.getElementById('positioning-image');
            
            if (container && image) {
                console.log('✅ Elementy kontenera 2D znalezione');
                
                // Zawsze próbuj załadować prawdziwy obrazek
                if (typeof window.forceLoadImage === 'function') {
                    window.forceLoadImage();
                } else {
                    console.warn('⚠️ Funkcja forceLoadImage nie jest dostępna');
                }
            } else {
                console.warn('⚠️ Nie znaleziono elementów kontenera 2D');
            }
        }, 3000);
                
                // Debug systemu po 4 sekundach
                setTimeout(() => {
                    console.log('⏰ Debug systemu po 4 sekundach');
                    window.debugSystem();
                }, 4000);
                
                // Test obrazka po 5 sekundach
                setTimeout(() => {
                    console.log('⏰ Test obrazka po 5 sekundach');
                    window.testImage();
                }, 5000);
            });
        </script>
    @endpush
</x-layouts.app>
