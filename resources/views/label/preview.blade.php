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
                    <button onclick="proceedToPayment()"
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105">
                        Przejdź do płatności
                    </button>

                    <a href="{{ route('home') }}"
                       class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-medium text-center transition-colors" wire:navigate>
                        Wróć do kreatora
                    </a>
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
        let scene, camera, renderer, controls, labelMesh;
        let isAnimating = false;
        let libraries3DLoaded = false;

        // Project configuration from backend
        const projectConfig = {
            shape: '{{ $project->labelShape->slug }}',
            material: '{{ $project->labelMaterial->slug }}',
            dimensions: {
                width: {{ $dimensions['width'] }},
                height: {{ $dimensions['height'] }}
            },
            textureUrl: '{{ $project->labelMaterial->texture_image_path ? asset($project->labelMaterial->texture_image_path) : "" }}',
            // NAPRAWIONE: obsługa obu formatów ścieżki
            artworkUrl: '{{ $project->artwork_file_path ? (Str::startsWith($project->artwork_file_path, "http") ? $project->artwork_file_path : Storage::url($project->artwork_file_path)) : "" }}',
            hasLaminate: {{ $project->laminateOption ? 'true' : 'false' }},
            debug: {
                hasArtwork: {{ $project->artwork_file_path ? 'true' : 'false' }},
                artworkPath: '{{ $project->artwork_file_path ?: "brak" }}'
            }
        };

        // Dodaj bezpośrednio po definicji projectConfig
        // Wygeneruj alternatywny URL na wypadek problemów
        const directStorageUrl = '/storage/{{ $project->artwork_file_path }}';
        console.log('Config główny URL:', projectConfig.artworkUrl);
        console.log('Alternatywny URL:', directStorageUrl);

        // Funkcja testująca dostępność zasobu
        function testImageURL(url) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => resolve(true);
                img.onerror = () => reject(new Error(`Nie można załadować obrazu: ${url}`));
                img.src = url;
            });
        }

        // AUTOMATYCZNIE POKAZUJ 2D FALLBACK PO 2 SEKUNDACH
        setTimeout(function() {
            if (document.getElementById('preview-loading').style.display !== 'none') {
                show2DFallback();
            }
        }, 2000);

        // Try to load 3D libraries
        function load3DLibraries() {
            if (libraries3DLoaded) {
                init3DPreview();
                return;
            }

            // Load Three.js
            const threeScript = document.createElement('script');
            threeScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
            threeScript.onload = function() {
                // Load OrbitControls
                const controlsScript = document.createElement('script');
                controlsScript.src = 'https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js';
                controlsScript.onload = function() {
                    libraries3DLoaded = true;
                    init3DPreview();
                };
                controlsScript.onerror = function() {
                    show2DFallback();
                };
                document.head.appendChild(controlsScript);
            };
            threeScript.onerror = function() {
                show2DFallback();
            };
            document.head.appendChild(threeScript);
        }

        function init3DPreview() {
            try {
                const container = document.getElementById('label-3d-preview');
                if (!container || !window.THREE) {
                    show2DFallback();
                    return;
                }

                // Scene setup
                scene = new THREE.Scene();
                scene.background = new THREE.Color(0xf8fafc);

                // Camera
                camera = new THREE.PerspectiveCamera(75, container.offsetWidth / container.offsetHeight, 0.1, 1000);
                camera.position.set(0, 0, 200);

                // Renderer
                renderer = new THREE.WebGLRenderer({ antialias: true });
                renderer.setSize(container.offsetWidth, container.offsetHeight);
                renderer.shadowMap.enabled = true;
                renderer.shadowMap.type = THREE.PCFSoftShadowMap;
                container.appendChild(renderer.domElement);

                // Controls - KLUCZOWE DLA OBRACANIA!
                controls = new THREE.OrbitControls(camera, renderer.domElement);
                controls.enableDamping = true;
                controls.dampingFactor = 0.05;
                controls.enableZoom = true;
                controls.enablePan = true;
                controls.enableRotate = true;
                controls.autoRotate = false;
                controls.maxDistance = 500;
                controls.minDistance = 50;

                // UPROSZCZONE OŚWIETLENIE - BEZ NADMIERNEGO ŚWIECENIA
                // Umiarkowane światło otoczenia
                const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
                scene.add(ambientLight);

                // Główne światło kierunkowe z przodu
                const frontLight = new THREE.DirectionalLight(0xffffff, 0.6);
                frontLight.position.set(0, 0, 100);
                scene.add(frontLight);

                // Delikatne światło z tyłu dla lepszej widoczności krawędzi
                const backLight = new THREE.DirectionalLight(0xffffff, 0.2);
                backLight.position.set(0, 0, -100);
                scene.add(backLight);

                // Create label geometry based on shape and real dimensions
                const labelGeometry = createLabelGeometry(
                    projectConfig.shape,
                    projectConfig.dimensions.width,
                    projectConfig.dimensions.height
                );

                // ULEPSZONA FUNKCJA TWORZENIA MATERIAŁU
                const labelMaterial = createLabelMaterial(projectConfig.material);

                // Najpierw tworzenie mesha z bazowym materiałem
                labelMesh = new THREE.Mesh(labelGeometry, labelMaterial);
                labelMesh.castShadow = true;
                labelMesh.receiveShadow = true;
                scene.add(labelMesh);

                // Zastąp istniejącą obsługę artwork tym kodem
                if (projectConfig.artworkUrl) {
                    console.log('Próbuję załadować grafikę z URL:', projectConfig.artworkUrl);

                    const textureLoader = new THREE.TextureLoader();
                    textureLoader.crossOrigin = 'anonymous';

                    // NOWA FUNKCJA: próbuje załadować teksturę z różnych URL-i, dopóki nie zadziała
                    function tryLoadTexture(urls, index = 0) {
                        if (index >= urls.length) {
                            console.error('❌ Wszystkie próby ładowania tekstury nie powiodły się');
                            return;
                        }

                        const currentUrl = urls[index] + '?cb=' + new Date().getTime();
                        console.log(`Próba ${index+1}/${urls.length}: ${currentUrl}`);

                        textureLoader.load(
                            currentUrl,
                            // Success
                            function(texture) {
                                console.log('✅ Tekstura załadowana pomyślnie!');

                                // Zastosuj teksturę do materiału
                                labelMaterial.map = texture;
                                labelMaterial.transparent = true;

                                // Dostosuj mapowanie UV w zależności od kształtu
                                if (projectConfig.shape === 'circle' || projectConfig.shape === 'oval') {
                                    texture.center.set(0.5, 0.5);
                                    texture.repeat.set(1, 1);
                                } else {
                                    texture.wrapS = THREE.ClampToEdgeWrapping;
                                    texture.wrapT = THREE.ClampToEdgeWrapping;
                                }

                                texture.needsUpdate = true;
                                labelMaterial.needsUpdate = true;

                                // Wymuś ponowne renderowanie sceny
                                labelMesh.material = labelMaterial;
                                renderer.render(scene, camera);

                                console.log('Rendering z teksturą zakończony');
                            },
                            // Progress
                            function(xhr) {
                                const percent = xhr.loaded / xhr.total * 100;
                                console.log(`Ładowanie: ${percent.toFixed(1)}%`);
                            },
                            // Error - próbuj następny URL
                            function(error) {
                                console.warn(`❌ Błąd ładowania ${currentUrl}:`, error);
                                tryLoadTexture(urls, index + 1);
                            }
                        );
                    }

                    // Przygotuj listę alternatywnych URL-i do wypróbowania
                    const urlsToTry = [
                        projectConfig.artworkUrl,
                        directStorageUrl,
                        '/storage/' + projectConfig.debug.artworkPath,
                    ];

                    // Rozpocznij próby ładowania
                    tryLoadTexture(urlsToTry);

                } else {
                    console.log('Brak URL do grafiki użytkownika');
                }

                // Add laminate layer if selected
                if (projectConfig.hasLaminate) {
                    const laminateGeometry = labelGeometry.clone();
                    laminateGeometry.scale(1.01, 1.01, 1); // Mniejsza różnica

                    // PRZEZROCZYSTY LAMINAT MATOWY
                    const laminateMaterial = new THREE.MeshLambertMaterial({
                        color: 0xffffff,         // Biały zamiast niebieskiego
                        transparent: true,
                        opacity: 0.15,           // Bardzo przezroczysty
                        side: THREE.DoubleSide
                    });

                    const laminateMesh = new THREE.Mesh(laminateGeometry, laminateMaterial);
                    laminateMesh.position.z = 0.5; // Bliżej etykiety
                    scene.add(laminateMesh);
                }

                // Na końcu funkcji init3DPreview()
                // Dodaj weryfikację po inicjalizacji
                if (projectConfig.artworkUrl) {
                    console.log('==== WERYFIKACJA ARTWORK ====');
                    console.log('URL artwork:', projectConfig.artworkUrl);
                    console.log('Czy material ma mapę?', labelMaterial.map !== null);

                    // Test ładowania obrazka przez standardowy Image API
                    const testImg = new Image();
                    testImg.onload = () => console.log('✅ Test IMG: Obraz załadowany pomyślnie');
                    testImg.onerror = () => console.log('❌ Test IMG: Błąd ładowania obrazu');
                    testImg.src = projectConfig.artworkUrl;
                }

                // Hide loading, start render loop
                document.getElementById('preview-loading').style.display = 'none';
                isAnimating = true;
                animate();

            } catch (error) {
                console.error('3D initialization error:', error);
                show2DFallback();
            }
        }

        function createLabelGeometry(shape, width, height) {
            let geometry;

            switch(shape) {
                case 'circle':
                    geometry = new THREE.CircleGeometry(Math.max(width, height) / 2, 32);
                    break;

                case 'square':
                    const size = Math.max(width, height);
                    geometry = new THREE.PlaneGeometry(size, size);
                    break;

                case 'rectangle':
                    geometry = new THREE.PlaneGeometry(width, height);
                    break;

                case 'oval':
                    geometry = new THREE.CircleGeometry(1, 32);
                    geometry.scale(width/2, height/2, 1);
                    break;

                case 'star':
                    geometry = createStarGeometry();
                    geometry.scale(width/100, height/100, 1);
                    break;

                default:
                    geometry = new THREE.PlaneGeometry(width, height);
            }

            return geometry;
        }

        // FUNKCJA TWORZENIA MATERIAŁU - BEZ EMISJI ŚWIATŁA
        function createLabelMaterial(materialSlug) {
            console.log('Tworzenie materiału dla:', materialSlug);

            // Podstawowa konfiguracja materiału - BEZ EMISJI
            let materialConfig = {
                side: THREE.DoubleSide,
                transparent: true,
                alphaTest: 0.1,
                map: null
                // Usunięto właściwości emissive i emissiveIntensity
            };

            let material;

            // Wybór typu materiału w zależności od slug
            switch(materialSlug) {
                case 'paper-white-matte':
                    material = new THREE.MeshStandardMaterial({
                        ...materialConfig,
                        color: 0xffffff,
                        roughness: 0.7,  // Średnia chropowatość
                        metalness: 0.0   // Brak metaliczności dla papieru
                    });
                    break;

                case 'paper-white-glossy':
                    material = new THREE.MeshPhongMaterial({
                        ...materialConfig,
                        color: 0xffffff,
                        shininess: 70,
                        specular: 0x222222
                    });
                    break;

                case 'paper-cream':
                    material = new THREE.MeshStandardMaterial({
                        ...materialConfig,
                        color: 0xfff8e1,
                        roughness: 0.7,
                        metalness: 0.0
                    });
                    break;

                case 'foil-gold':
                    const size = 64;
                    const data = new Uint8Array(size * size * 3);
                    for (let i = 0; i < size * size * 3; i++) {
                        data[i] = 180 + Math.random() * 75;
                    }

                    const bumpTexture = new THREE.DataTexture(data, size, size, THREE.RGBFormat);
                    bumpTexture.needsUpdate = true;
                    bumpTexture.wrapS = bumpTexture.wrapT = THREE.RepeatWrapping;
                    bumpTexture.repeat.set(4, 4);

                    material = new THREE.MeshPhysicalMaterial({
                        ...materialConfig,
                        color: new THREE.Color(1.0, 0.84, 0.0),
                        metalness: 0.8,
                        roughness: 0.2,
                        bumpMap: bumpTexture,
                        bumpScale: 0.01,
                        clearcoat: 0.6,
                        clearcoatRoughness: 0.2,
                        reflectivity: 0.7
                        // Usunięto emisję światła
                    });
                    break;

                case 'foil-silver':
                    material = new THREE.MeshStandardMaterial({
                        ...materialConfig,
                        color: 0xdddddd,
                        metalness: 0.7,
                        roughness: 0.1
                        // Usunięto emisję światła
                    });
                    break;

                default:
                    material = new THREE.MeshLambertMaterial({
                        ...materialConfig,
                        color: 0xffffff
                    });
            }

            return material;
        }

        function createStarGeometry() {
            const shape = new THREE.Shape();
            const outerRadius = 50;
            const innerRadius = 25;
            const points = 5;

            for (let i = 0; i < points * 2; i++) {
                const angle = (i * Math.PI) / points;
                const radius = i % 2 === 0 ? outerRadius : innerRadius;
                const x = Math.cos(angle) * radius;
                const y = Math.sin(angle) * radius;

                if (i === 0) {
                    shape.moveTo(x, y);
                } else {
                    shape.lineTo(x, y);
                }
            }

            shape.closePath();
            return new THREE.ShapeGeometry(shape);
        }

        function animate() {
            if (!isAnimating) return;

            requestAnimationFrame(animate);
            controls.update();
            renderer.render(scene, camera);
        }

        function show2DFallback() {
            document.getElementById('preview-loading').style.display = 'none';
            document.getElementById('preview-error').style.display = 'flex';
        }

        function proceedToPayment() {
            alert('Funkcja płatności będzie dostępna wkrótce!');
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (camera && renderer) {
                const container = document.getElementById('label-3d-preview');
                camera.aspect = container.offsetWidth / container.offsetHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.offsetWidth, container.offsetHeight);
            }
        });

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', async function() {
            if (projectConfig.artworkUrl) {
                try {
                    const result = await testImageURL(projectConfig.artworkUrl);
                    console.log('Test URL obrazka: SUKCES');
                } catch (error) {
                    console.error('Test URL obrazka: BŁĄD', error);
                    // Spróbuj inne podejście
                    console.log('Próba alternatywnego URL:', '/storage/' + projectConfig.debug.artworkPath);
                }
            }

            isAnimating = true;
            load3DLibraries();
        });

        // Cleanup when leaving page
        window.addEventListener('beforeunload', function() {
            isAnimating = false;
        });
    </script>
    @endpush
</x-layouts.app>
