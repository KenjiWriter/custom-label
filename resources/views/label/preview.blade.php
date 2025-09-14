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
                    </div>

                    <!-- 3D Canvas Container -->
                    <div class="relative bg-gradient-to-br from-gray-50 to-gray-100" style="height: 500px;">
                        <div id="label-3d-preview" class="w-full h-full"></div>

                        <!-- Loading State -->
                        <div id="preview-loading" class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-600 mx-auto mb-4"></div>
                                <p class="text-gray-600">Ładowanie podglądu 3D...</p>
                            </div>
                        </div>

                        <!-- 2D FALLBACK - ZAWSZE GOTOWY -->
                        <div id="preview-error" class="absolute inset-0 items-center justify-center hidden">
                            <div class="text-center p-8">
                                <div class="bg-yellow-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Podgląd 3D niedostępny</h3>
                                <p class="text-gray-600 mb-4">Wyświetlamy podgląd 2D Twojej etykiety</p>

                                <!-- 2D Fallback Preview -->
                                <div class="bg-white border-2 border-dashed border-orange-300 rounded-xl p-8 max-w-md mx-auto">
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
                                            $materialColor = $materialColors[$materialSlug] ?? 'from-gray-100 to-gray-200 border-gray-300';

                                            // MOCNIEJSZE efekty dla różnych materiałów
                                            $materialEffects = 'shadow-2xl';
                                            if (str_contains($materialSlug, 'glossy') || str_contains($materialSlug, 'foil')) {
                                                $materialEffects .= ' transform hover:scale-110 transition-all duration-500';
                                            }
                                            if (str_contains($materialSlug, 'gold') || str_contains($materialSlug, 'zlota')) {
                                                $materialEffects .= ' animate-pulse';
                                            }

                                            // Border radius dla kształtów
                                            $shapeClass = '';
                                            $shape = $project->labelShape->slug ?? 'rectangle';

                                            switch($shape) {
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
                                                @if(str_contains($materialSlug, 'foil') || str_contains($materialSlug, 'glossy') || str_contains($materialSlug, 'folia'))
                                                    <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white to-transparent opacity-50 transform -skew-x-12"></div>
                                                    <div class="absolute top-6 left-6 w-16 h-16 bg-white rounded-full opacity-70 blur-lg"></div>
                                                    <div class="absolute bottom-8 right-8 w-10 h-10 bg-white rounded-full opacity-50 blur-md"></div>
                                                @endif

                                                <!-- MOCNY efekt metaliczny dla złotej/srebrnej folii -->
                                                @if(str_contains($materialSlug, 'gold') || str_contains($materialSlug, 'silver') || str_contains($materialSlug, 'zlota') || str_contains($materialSlug, 'srebrna'))
                                                    <div class="absolute inset-0 bg-gradient-to-br from-white to-transparent opacity-40"></div>
                                                    <div class="absolute top-8 right-8 w-12 h-12 bg-white rounded-full opacity-60 blur-xl"></div>
                                                    <div class="absolute bottom-6 left-6 w-8 h-8 bg-white rounded-full opacity-50 blur-lg"></div>
                                                    <!-- DODATKOWE ZŁOTE REFLEKSY -->
                                                    <div class="absolute top-1/3 left-1/4 w-6 h-6 bg-yellow-200 rounded-full opacity-40 blur-md"></div>
                                                    <div class="absolute bottom-1/3 right-1/4 w-4 h-4 bg-yellow-300 rounded-full opacity-30 blur-sm"></div>
                                                @endif

                                                <!-- Gwiazda SVG dla kształtu gwiazdy -->
                                                @if($shape === 'star')
                                                    <svg class="absolute inset-0 w-full h-full text-current opacity-25" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
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
                                                @if(str_contains($materialSlug, 'paper'))
                                                    <div class="absolute inset-0 opacity-20">
                                                        <div class="w-full h-full" style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%228%22 height=%228%22 viewBox=%220 0 8 8%22><path fill=%22%23000%22 fill-opacity=%22.4%22 d=%22M1 7h1v1H1V7zm4-4h1v1H5V3z%22></path></svg>');"></div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- MOCNIEJSZY efekt laminatu -->
                                            @if($project->laminateOption)
                                                <div class="absolute inset-0 {{ $shapeClass }} border-6 border-blue-500 bg-gradient-to-br from-blue-200 to-transparent opacity-60 pointer-events-none">
                                                    <!-- WIĘKSZE refleksy laminatu -->
                                                    <div class="absolute top-6 left-6 w-16 h-16 bg-white rounded-full opacity-80 blur-xl"></div>
                                                    <div class="absolute bottom-8 right-8 w-12 h-12 bg-white rounded-full opacity-60 blur-lg"></div>
                                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-white rounded-full opacity-50 blur-md"></div>
                                                </div>

                                                <!-- WIĘKSZA etykieta laminatu -->
                                                <div class="absolute -top-6 -right-6 bg-blue-600 text-white text-lg px-6 py-3 rounded-full font-bold shadow-2xl z-20">
                                                    LAMINAT
                                                </div>
                                            @endif

                                            <!-- WIĘKSZA ikona materiału -->
                                            <div class="absolute bottom-4 left-4 w-12 h-12 rounded-full bg-black bg-opacity-30 flex items-center justify-center text-2xl">
                                                @if(str_contains($materialSlug, 'paper'))
                                                    📄
                                                @elseif(str_contains($materialSlug, 'foil') || str_contains($materialSlug, 'folia'))
                                                    ✨
                                                @else
                                                    📋
                                                @endif
                                            </div>

                                            <!-- WIĘKSZA informacja o ilości -->
                                            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-lg px-6 py-3 rounded-full whitespace-nowrap shadow-xl">
                                                {{ number_format($project->quantity) }} szt.
                                            </div>
                                        </div>

                                        <!-- WIĘKSZE informacje dodatkowe -->
                                        <div class="mt-20 text-lg text-gray-600 space-y-4">
                                            <div class="font-bold text-gray-900 text-3xl">{{ $project->labelShape->name }}</div>
                                            <div class="flex flex-wrap justify-center gap-4 mt-8">
                                                <span class="bg-gray-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    📐 {{ $dimensions['width'] }}×{{ $dimensions['height'] }}mm
                                                </span>
                                                <span class="bg-yellow-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    🎨 {{ $project->labelMaterial->name }}
                                                </span>
                                                @if($project->laminateOption)
                                                    <span class="bg-blue-100 px-6 py-3 rounded-full text-lg font-medium">
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
                            <span class="font-medium">{{ $project->getActualDimensions()['width'] }}×{{ $project->getActualDimensions()['height'] }}mm</span>
                        </div>
                        @if($project->laminateOption)
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
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl shadow-lg p-6 border border-orange-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Cena</h3>
                    <div class="text-3xl font-bold text-orange-600">
                        {{ number_format($project->calculated_price, 2) }} zł
                    </div>
                    <p class="text-sm text-gray-600 mt-1">z VAT</p>
                </div>

                <!-- Actions -->
                <div class="space-y-3">

                    <button id="goToCheckoutBtn" class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105">
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
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.40A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
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
        @if($project->predefined_size_id)
            localStorage.setItem('saved_size_type', 'predefined');
            localStorage.setItem('saved_predefined_size', '{{ $project->predefined_size_id }}');
        @else
            localStorage.setItem('saved_size_type', 'custom');
            localStorage.setItem('saved_width', '{{ $dimensions["width"] }}');
            localStorage.setItem('saved_height', '{{ $dimensions["height"] }}');
        @endif

        // Zapisz laminat jeśli istnieje
        @if($project->laminateOption)
            localStorage.setItem('saved_laminate', '{{ $project->laminate_option_id }}');
        @else
            localStorage.removeItem('saved_laminate');
        @endif

        // Zapisz dane pozycjonowania obrazu jeśli istnieją
        @if(isset($project->image_position_x))
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
        window.history.pushState({page: 'preview', projectId: projectId}, '', window.location.href);

        window.addEventListener('popstate', function(event) {
            // Przekieruj na kreator z zachowaniem parametrów
            goBackToCreator();
            // Zapobiegaj standardowej nawigacji
            history.pushState(null, '', window.location.href);
        });

        window.addEventListener('storage', (event) => {
    if (event.key === 'imagePosition' && event.newValue) {
        try {
            const newPos = JSON.parse(event.newValue);
            if (newPos) {
                projectConfig.imagePosition = newPos;
                if (scene && faceMesh) {
                    scene.remove(faceMesh);
                    const shape = createLabelShape(projectConfig.shape, projectConfig.dimensions.width, projectConfig.dimensions.height);
                    addArtworkToLabel(shape, 2);
                    console.log('✔ Zaktualizowano obraz 3D z nową pozycją');
                }
            }
        } catch(e) {
            console.error('Błąd parsowania imagePosition:', e);
        }
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
} catch(e) {
    console.error('Nie można sparsować imagePosition z localStorage', e);
}

        // 4. Inicjalizacja podglądu 3D
        initializePreview();
    });

    // Funkcja pomocnicza do powrotu do kreatora
    function goBackToCreator() {
        // Dodajemy fragment URL (#label-creator), aby skierować bezpośrednio do sekcji kreatora
        window.location.href = '{{ route("home") }}?project={{ $project->id }}&step=4&fromPreview=true&returnToCreator=true#label-creator';
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
    textureUrl: '{{ $project->labelMaterial->texture_image_path ? asset($project->labelMaterial->texture_image_path) : "" }}',
    artworkUrl: '{{ $project->artwork_file_path ? (Str::startsWith($project->artwork_file_path, "http") ? $project->artwork_file_path : asset("storage/".$project->artwork_file_path)) : "" }}',
    hasLaminate: {{ $project->laminateOption ? 'true' : 'false' }},
    laminateType: '{{ $project->laminateOption->slug ?? "" }}',
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
        artworkPath: '{{ $project->artwork_file_path ?? "brak" }}',
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
            controls.maxDistance = 500;
            controls.minDistance = 50;

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
    scene.add(labelMesh);

    // Dodaj tylną stronę etykiety
    createBackSide(shape, labelDepth);
    function createBackSide(shape, labelDepth) {
    console.log('🏷️ Implementacja tylnej strony z subtelnym tekstem');

    // 1. Tworzymy nieprzezroczyste ciemne tło
    const backGeometry = new THREE.ShapeGeometry(shape);
    const backMaterial = new THREE.MeshBasicMaterial({
        color: 0x242424,  // Ciemny szary/czarny
        side: THREE.BackSide,
        transparent: false,
        depthTest: true,
        depthWrite: true
    });

    const backMesh = new THREE.Mesh(backGeometry, backMaterial);
    backMesh.position.z = -labelDepth/2;
    backMesh.renderOrder = 5000; // Bardzo wysoki priorytet renderowania
    scene.add(backMesh);

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
    ctx.fillStyle = '#353535';  // Tylko delikatnie jaśniejszy od #242424
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';

    // Usunięte cienie dla bardziej subtelnego efektu

    // TYŁ - bardzo duży tekst
    ctx.font = 'bold 300px Arial';
    ctx.fillText('TYŁ', canvas.width/2, canvas.height/2 - 200);

    // BACK - też duży tekst
    ctx.font = 'bold 250px Arial';
    ctx.fillText('BACK', canvas.width/2, canvas.height/2 + 150);

    // Custom Labels - jeszcze bardziej subtelne
    ctx.fillStyle = '#303030';  // Jeszcze mniej widoczne
    ctx.font = 'bold italic 120px Arial';
    ctx.fillText('Custom Labels', canvas.width/2, canvas.height - 150);

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
    textMesh.position.z = -labelDepth/2 - 0.05; // Tuż za tylną ścianką
    textMesh.renderOrder = 5001; // Jeszcze wyższy priorytet

    scene.add(textMesh);
    console.log('✅ Dodano subtelne napisy na tylnej stronie');
}
    // Dodaj ścianki boczne etykiety
    createSideWalls(shape, labelDepth);
function createSideWalls(shape, labelDepth) {
    const sideColor = 0xe5e5e5;  // Jaśniejszy szary kolor dla ścianek bocznych

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
    scene.add(sideMesh);
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
    }
    else if (shapeType === 'oval') {
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
    }
    else if (shapeType === 'star') {
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
    }
    else {
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
    }
    else if (materialType.includes('cream')) {
        materialColor = 0xf5f0e0;
        roughness = 0.8;
        metalness = 0.0;
    }
    else if (materialType.includes('waterproof') || materialType.includes('wodoodporn')) {
        materialColor = 0xf8f8ff;
        roughness = 0.4;
        metalness = 0.2;
    }
    else {
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
    } catch(error) {
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

    // Get image dimensions and aspect ratios
    const imgWidth = texture.image.width;
    const imgHeight = texture.image.height;
    const imgAspect = imgWidth / imgHeight;
    const labelWidth = projectConfig.dimensions.width;
    const labelHeight = projectConfig.dimensions.height;
    const labelAspect = labelWidth / labelHeight;

    // Position values from creator
    const userScale = (projectConfig.imagePosition.scale || 100) / 100;
    const rotationDeg = projectConfig.imagePosition.rotation || 0;
    const rotationRad = rotationDeg * Math.PI / 180;

    // Position X and Y as percentage (0-100) from center
    const posX = projectConfig.imagePosition.x || 50;
    const posY = projectConfig.imagePosition.y || 50;

    console.log('📊 Wartości z kreatora:', {
        posX, posY, userScale, rotationDeg,
        imgSize: `${imgWidth}x${imgHeight}`,
        labelSize: `${labelWidth}x${labelHeight}`
    });

    const shape = createLabelShape(
        projectConfig.shape,
        projectConfig.dimensions.width,
        projectConfig.dimensions.height
    );

    // Remove existing mesh
    if (faceMesh && scene.children.includes(faceMesh)) {
        scene.remove(faceMesh);
    }

    // Create a new texture from the image
    const newTexture = new THREE.Texture(texture.image);
    newTexture.needsUpdate = true;
    newTexture.encoding = THREE.sRGBEncoding;
    newTexture.anisotropy = renderer.capabilities.getMaxAnisotropy();

    // Dodaj flip Y na teksturze...
newTexture.flipY = false; // To wymusza ‘naturalne’ mapowanie bez odbicia w three.js.


    // Create geometry
    const imageGeometry = new THREE.ShapeGeometry(shape);

    // CAŁKOWICIE NOWE PODEJŚCIE DO MAPOWANIA UV:
    // 1. Najpierw tworzymy standardowe mapowanie UV (0-1)
    const positions = imageGeometry.attributes.position;
    const uvs = new Float32Array(positions.count * 2);

    for (let i = 0; i < positions.count; i++) {
        // Get vertex position
        const x = positions.getX(i);
        const y = positions.getY(i);

        // Standard mapping (0-1 across the label)
        const u = (x + labelWidth/2) / labelWidth;
        const v = 1 - (y + labelHeight/2) / labelHeight;

        // Store basic UVs
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
    }
  else if (projectConfig.material.includes('silver') || projectConfig.material.includes('srebr')) {
    imageMaterial = new THREE.MeshPhysicalMaterial({
        map: newTexture,
        color: 0xe0e0e0, // bardziej jasny srebrny
        metalness: 0.4,
        roughness: 0.2,
        reflectivity: 0.85,
        clearcoat: 0.7,
        clearcoatRoughness: 0.03,
        emissive: 0xb0b0b0, // jasny szary akcent
        emissiveIntensity: 0.36,
        transparent: true,
        side: THREE.FrontSide
    });

    createSimpleEnvMap(imageMaterial);
// DODAJ: shader tylko lekko "przesrebrzający", nie wybielający!
    imageMaterial.onBeforeCompile = shader => {
    shader.fragmentShader = shader.fragmentShader.replace(
        '#include <map_fragment>',
        `
        #ifdef USE_MAP
            vec4 texelColor = texture2D( map, vUv );
            // PRZYCIEMNIENIE I METALICZNY AKCENT: subtelnie dodaj chłodną tonację bez wybielania
            vec3 silverTint = vec3(0.74, 0.87, 0.72); // bardziej szary, mniej jasny
            // Najpierw lekko przyciemnij oryginał
            texelColor.rgb = texelColor.rgb * 0.43;
            // Dodaj bardzo subtelną, metaliczną „domieszkę” srebra
            texelColor.rgb = mix(texelColor.rgb, silverTint, 0.11);
            diffuseColor.rgb *= texelColor.rgb;
        #endif
        `
    );
};

   }
else if (projectConfig.material.includes('white-matte') || projectConfig.material.includes('bialy-matowy')) {
    imageMaterial = new THREE.MeshStandardMaterial({
        map: newTexture,
        color: 0xf4f4f0, // naturalny, lekko szary odcień białego papieru
        metalness: 0.8,
        roughness: 1,
        transparent: false,
        side: THREE.FrontSide
    });
}
else if (projectConfig.material.includes('white-glossy') || projectConfig.material.includes('bialy-blysk')) {
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
}
else if (projectConfig.material.includes('cream') || projectConfig.material.includes('kremowy')) {
    imageMaterial = new THREE.MeshStandardMaterial({
        map: newTexture,
        color: 0xf5ecd7, // ciepły kremowy
        metalness: 0.0,
        roughness: 0.85,
        transparent: false,
        side: THREE.FrontSide
    });
}
else if (projectConfig.material.includes('kraft')) {
    imageMaterial = new THREE.MeshStandardMaterial({
        map: newTexture,
        color: 0xa67c52, // kraftowy brąz
        metalness: 0.0,
        roughness: 0.92,
        transparent: false,
        side: THREE.FrontSide
    });
}
else if (projectConfig.material.includes('waterproof') || projectConfig.material.includes('wodoodporn')) {
    imageMaterial = new THREE.MeshStandardMaterial({
        map: newTexture,
        color: 0xf7fbfd, // lekko niebieskawy biały, "czysty"
        metalness: 0.08,
        roughness: 0.38,
        transparent: false,
        side: THREE.FrontSide
    });
}
else {
    imageMaterial = new THREE.MeshStandardMaterial({
        map: newTexture,
        color: 0xfafafa, // neutralny jasny
        metalness: 0.0,
        roughness: 0.9,
        transparent: false,
        side: THREE.FrontSide
    });
}

    // 3. NAJWAŻNIEJSZE: Transformacje tekstury dokładnie jak w kreatorze

    // Centrujemy teksturę
    newTexture.center.set(0.5, 0.5);

    // Stosujemy rotację
    newTexture.rotation = rotationRad;

    // Obliczamy skalę zachowując proporcje obrazka
    let scaleX, scaleY;

    if (imgAspect > labelAspect) {
        // Obraz szerszy niż etykieta
        scaleY = 1 / userScale;
        scaleX = (labelAspect / imgAspect) / userScale;
    } else {
        // Obraz wyższy niż etykieta
        scaleX = 1 / userScale;
        scaleY = (imgAspect / labelAspect) / userScale;
    }

    // Stosujemy skalę
    newTexture.repeat.set(scaleX, scaleY);

    // Obliczamy offset (przesunięcie) na podstawie pozycji procentowej
    const offsetX = (posX - 50) / 100;
    const offsetY = (50 - posY) / 100;  // Odwracamy Y, bo w THREE.js Y rośnie w górę

    // Stosujemy offset
    newTexture.offset.set(offsetX, offsetY);

    // Tworzymy siatkę i dodajemy do sceny
    faceMesh = new THREE.Mesh(imageGeometry, imageMaterial);
    faceMesh.position.z = 0.6;
    faceMesh.renderOrder = 10000;
    scene.add(faceMesh);

    console.log('✅ Pozycjonowanie obrazka naprawione', {
        offset: { x: offsetX, y: offsetY },
        scale: { x: scaleX, y: scaleY },
        rotation: rotationRad
    });
}

// Funkcja pomocnicza do mapowania UV
function applyUVMapping(geometry, width, height) {
    const positions = geometry.attributes.position;
    const uvs = new Float32Array(positions.count * 2);

    for (let i = 0; i < positions.count; i++) {
        const x = positions.getX(i);
        const y = positions.getY(i);

        const u = (x + width/2) / width;
        const v = (y + height/2) / height;

        uvs[i * 2] = u;
        uvs[i * 2 + 1] = v;
    }

    geometry.setAttribute('uv', new THREE.BufferAttribute(uvs, 2));
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
    }
    else if (materialType.includes('silver') || materialType.includes('srebrna')) {
        color = 0xf0f0f0; // Srebrny
        metalness = 0.8;
        roughness = 0.15;
        envMapIntensity = 1.6;
    }
    else if (materialType.includes('glossy') || materialType.includes('blysk')) {
        metalness = 0.1;
        roughness = 0.2;
        envMapIntensity = 1.2;
    }
    else if (materialType.includes('cream')) {
        color = 0xf5f0e0; // Kremowy
        metalness = 0.0;
        roughness = 0.8;
    }
    else if (materialType.includes('waterproof')) {
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
    } catch(error) {
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
    ctx.fillStyle = '#ff0000';  // Czerwony kwadrat
    ctx.fillRect(0, 0, 256, 256);
    ctx.fillStyle = '#00ff00';  // Zielony kwadrat
    ctx.fillRect(256, 0, 256, 256);
    ctx.fillStyle = '#0000ff';  // Niebieski kwadrat
    ctx.fillRect(0, 256, 256, 256);
    ctx.fillStyle = '#ffff00';  // Żółty kwadrat
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

    if (!scene) {
        console.warn('⚠️ Nie można odświeżyć obrazka - scena nie istnieje');
        return;
    }

    // Usuń stary mesh obrazka
    if (faceMesh && scene.children.includes(faceMesh)) {
        scene.remove(faceMesh);
    }

    // Utwórz obrazek testowy zamiast próbować ładować istniejący
    createEmergencyTexture();

    // Wymuś ponowne renderowanie
    if (renderer && scene && camera) {
        renderer.render(scene, camera);
    }

    console.log('✅ Obrazek testowy zastosowany');
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
    laminateMesh.renderOrder = 2500;  // Wyższy renderOrder - nad wszystkim
    scene.add(laminateMesh);

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
    scene.add(glossMesh);

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
    scene.add(specularMesh);
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
    const widthMaterial = new THREE.MeshBasicMaterial({ color: rulerColor });
    const widthRuler = new THREE.Mesh(widthGeometry, widthMaterial);
    widthRuler.position.set(0, -height/2 - labelOffset, 0);
    scene.add(widthRuler);

    // Miarka wysokości
    const heightGeometry = new THREE.BoxGeometry(rulerWidth, height, rulerWidth);
    const heightRuler = new THREE.Mesh(heightGeometry, widthMaterial);
    heightRuler.position.set(-width/2 - labelOffset, 0, 0);
    scene.add(heightRuler);

    // Dodaj tekst z wymiarami
    addTextLabel(scene, `${width}mm`, 0, -height/2 - labelOffset - 10, 0, 1.5);
    addTextLabel(scene, `${height}mm`, -width/2 - labelOffset - 15, 0, 0, 1.5, true);
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
    context.fillText(text, canvas.width/2, canvas.height/2);

    const texture = new THREE.CanvasTexture(canvas);
    const material = new THREE.SpriteMaterial({ map: texture, transparent: true });
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

    // Funkcja do ponownej próby inicjalizacji
    function retryInitialization(errorMessage) {
        initializationAttempts++;
        console.warn(`⚠️ Próba inicjalizacji ${initializationAttempts}/${MAX_INITIALIZATION_ATTEMPTS} nie powiodła się: ${errorMessage}`);

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

        // Usuń stary mesh obrazka
        if (faceMesh && scene.children.includes(faceMesh)) {
            scene.remove(faceMesh);
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

    // Czyszczenie zasobów przy opuszczaniu strony
    window.addEventListener('beforeunload', function() {
        isAnimating = false;

        // Zwolnij zasoby
        if (renderer) {
            renderer.dispose();
            renderer.forceContextLoss();
        }

        if (scene) {
            while(scene.children.length > 0) {
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
});
</script>
@endpush
</x-layouts.app>
