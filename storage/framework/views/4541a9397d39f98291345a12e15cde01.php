<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Podgląd 3D etykiety - '.e($project->uuid).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Podgląd 3D etykiety - '.e($project->uuid).'']); ?>

    <div class="py-8">
        <!-- Header -->
        <div class="mb-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-gray-700" wire:navigate>Kreator</a>
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
                                        <?php
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
                                        ?>

                                        <!-- DUŻA ZŁOTA OWALNA ETYKIETA -->
                                        <div class="relative mx-auto <?php echo e($materialEffects); ?>"
                                             style="width: <?php echo e($previewWidth); ?>px; height: <?php echo e($previewHeight); ?>px;">

                                            <!-- Główna etykieta -->
                                            <div class="w-full h-full bg-gradient-to-br <?php echo e($materialColor); ?> border-8 <?php echo e($shapeClass); ?> flex items-center justify-center relative overflow-hidden"
                                                 style="box-shadow: 0 30px 60px rgba(0,0,0,0.3);">

                                                <!-- MOCNY efekt błyszczący dla folii -->
                                                <?php if(str_contains($materialSlug, 'foil') || str_contains($materialSlug, 'glossy') || str_contains($materialSlug, 'folia')): ?>
                                                    <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white to-transparent opacity-50 transform -skew-x-12"></div>
                                                    <div class="absolute top-6 left-6 w-16 h-16 bg-white rounded-full opacity-70 blur-lg"></div>
                                                    <div class="absolute bottom-8 right-8 w-10 h-10 bg-white rounded-full opacity-50 blur-md"></div>
                                                <?php endif; ?>

                                                <!-- MOCNY efekt metaliczny dla złotej/srebrnej folii -->
                                                <?php if(str_contains($materialSlug, 'gold') || str_contains($materialSlug, 'silver') || str_contains($materialSlug, 'zlota') || str_contains($materialSlug, 'srebrna')): ?>
                                                    <div class="absolute inset-0 bg-gradient-to-br from-white to-transparent opacity-40"></div>
                                                    <div class="absolute top-8 right-8 w-12 h-12 bg-white rounded-full opacity-60 blur-xl"></div>
                                                    <div class="absolute bottom-6 left-6 w-8 h-8 bg-white rounded-full opacity-50 blur-lg"></div>
                                                    <!-- DODATKOWE ZŁOTE REFLEKSY -->
                                                    <div class="absolute top-1/3 left-1/4 w-6 h-6 bg-yellow-200 rounded-full opacity-40 blur-md"></div>
                                                    <div class="absolute bottom-1/3 right-1/4 w-4 h-4 bg-yellow-300 rounded-full opacity-30 blur-sm"></div>
                                                <?php endif; ?>

                                                <!-- Gwiazda SVG dla kształtu gwiazdy -->
                                                <?php if($shape === 'star'): ?>
                                                    <svg class="absolute inset-0 w-full h-full text-current opacity-25" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                    </svg>
                                                <?php endif; ?>

                                                <!-- WIĘKSZY tekst -->
                                                <div class="text-center z-10 p-6">
                                                    <div class="text-xl font-bold text-gray-800 opacity-90 mb-3">
                                                        <?php echo e($project->labelMaterial->name); ?>

                                                    </div>
                                                    <div class="text-lg text-gray-700 opacity-70">
                                                        <?php echo e($project->labelShape->name); ?>

                                                    </div>
                                                    <div class="text-md text-gray-600 opacity-70 mt-2">
                                                        <?php echo e($dimensions['width']); ?>×<?php echo e($dimensions['height']); ?>mm
                                                    </div>
                                                </div>

                                                <!-- Tekstura dla papieru -->
                                                <?php if(str_contains($materialSlug, 'paper')): ?>
                                                    <div class="absolute inset-0 opacity-20">
                                                        <div class="w-full h-full" style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%228%22 height=%228%22 viewBox=%220 0 8 8%22><path fill=%22%23000%22 fill-opacity=%22.4%22 d=%22M1 7h1v1H1V7zm4-4h1v1H5V3z%22></path></svg>');"></div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- MOCNIEJSZY efekt laminatu -->
                                            <?php if($project->laminateOption): ?>
                                                <div class="absolute inset-0 <?php echo e($shapeClass); ?> border-6 border-blue-500 bg-gradient-to-br from-blue-200 to-transparent opacity-60 pointer-events-none">
                                                    <!-- WIĘKSZE refleksy laminatu -->
                                                    <div class="absolute top-6 left-6 w-16 h-16 bg-white rounded-full opacity-80 blur-xl"></div>
                                                    <div class="absolute bottom-8 right-8 w-12 h-12 bg-white rounded-full opacity-60 blur-lg"></div>
                                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-white rounded-full opacity-50 blur-md"></div>
                                                </div>

                                                <!-- WIĘKSZA etykieta laminatu -->
                                                <div class="absolute -top-6 -right-6 bg-blue-600 text-white text-lg px-6 py-3 rounded-full font-bold shadow-2xl z-20">
                                                    LAMINAT
                                                </div>
                                            <?php endif; ?>

                                            <!-- WIĘKSZA ikona materiału -->
                                            <div class="absolute bottom-4 left-4 w-12 h-12 rounded-full bg-black bg-opacity-30 flex items-center justify-center text-2xl">
                                                <?php if(str_contains($materialSlug, 'paper')): ?>
                                                    📄
                                                <?php elseif(str_contains($materialSlug, 'foil') || str_contains($materialSlug, 'folia')): ?>
                                                    ✨
                                                <?php else: ?>
                                                    📋
                                                <?php endif; ?>
                                            </div>

                                            <!-- WIĘKSZA informacja o ilości -->
                                            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white text-lg px-6 py-3 rounded-full whitespace-nowrap shadow-xl">
                                                <?php echo e(number_format($project->quantity)); ?> szt.
                                            </div>
                                        </div>

                                        <!-- WIĘKSZE informacje dodatkowe -->
                                        <div class="mt-20 text-lg text-gray-600 space-y-4">
                                            <div class="font-bold text-gray-900 text-3xl"><?php echo e($project->labelShape->name); ?></div>
                                            <div class="flex flex-wrap justify-center gap-4 mt-8">
                                                <span class="bg-gray-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    📐 <?php echo e($dimensions['width']); ?>×<?php echo e($dimensions['height']); ?>mm
                                                </span>
                                                <span class="bg-yellow-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    🎨 <?php echo e($project->labelMaterial->name); ?>

                                                </span>
                                                <?php if($project->laminateOption): ?>
                                                    <span class="bg-blue-100 px-6 py-3 rounded-full text-lg font-medium">
                                                        🛡️ <?php echo e($project->laminateOption->name); ?>

                                                    </span>
                                                <?php endif; ?>
                                                <span class="bg-orange-100 px-6 py-3 rounded-full text-lg font-medium">
                                                    📦 <?php echo e(number_format($project->quantity)); ?> szt.
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
                            <span class="font-medium"><?php echo e($project->labelShape->name); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Materiał:</span>
                            <span class="font-medium"><?php echo e($project->labelMaterial->name); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Wymiary:</span>
                            <span class="font-medium"><?php echo e($project->getActualDimensions()['width']); ?>×<?php echo e($project->getActualDimensions()['height']); ?>mm</span>
                        </div>
                        <?php if($project->laminateOption): ?>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Laminat:</span>
                            <span class="font-medium"><?php echo e($project->laminateOption->name); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ilość:</span>
                            <span class="font-medium"><?php echo e(number_format($project->quantity)); ?> szt.</span>
                        </div>
                    </div>
                </div>

                <!-- Price -->
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl shadow-lg p-6 border border-orange-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Cena</h3>
                    <div class="text-3xl font-bold text-orange-600">
                        <?php echo e(number_format($project->calculated_price, 2)); ?> zł
                    </div>
                    <p class="text-sm text-gray-600 mt-1">z VAT</p>
                </div>

                <!-- Actions -->
                <div class="space-y-3">
                    <button onclick="proceedToPayment()"
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105">
                        Przejdź do płatności
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

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Rozszerzona obsługa powrotu do kreatora z podglądu 3D
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Zapisz dane projektu w localStorage
            const projectId = '<?php echo e($project->id); ?>';
            localStorage.setItem('saved_project_id', projectId);
            localStorage.setItem('saved_step', '4');
            localStorage.setItem('saved_shape', '<?php echo e($project->label_shape_id); ?>');
            localStorage.setItem('saved_material', '<?php echo e($project->label_material_id); ?>');
            localStorage.setItem('saved_quantity', '<?php echo e($project->quantity); ?>');

            // Zapisz wymiary
            <?php if($project->predefined_size_id): ?>
                localStorage.setItem('saved_size_type', 'predefined');
                localStorage.setItem('saved_predefined_size', '<?php echo e($project->predefined_size_id); ?>');
            <?php else: ?>
                localStorage.setItem('saved_size_type', 'custom');
                localStorage.setItem('saved_width', '<?php echo e($dimensions["width"]); ?>');
                localStorage.setItem('saved_height', '<?php echo e($dimensions["height"]); ?>');
            <?php endif; ?>

            // Zapisz laminat jeśli istnieje
            <?php if($project->laminateOption): ?>
                localStorage.setItem('saved_laminate', '<?php echo e($project->laminate_option_id); ?>');
            <?php else: ?>
                localStorage.removeItem('saved_laminate');
            <?php endif; ?>

            // Zapisz dane pozycjonowania obrazu jeśli istnieją
            <?php if(isset($project->image_position_x)): ?>
                localStorage.setItem('saved_image_position_x', '<?php echo e($project->image_position_x); ?>');
                localStorage.setItem('saved_image_position_y', '<?php echo e($project->image_position_y); ?>');
                localStorage.setItem('saved_image_scale', '<?php echo e($project->image_scale); ?>');
                localStorage.setItem('saved_image_rotation', '<?php echo e($project->image_rotation); ?>');
            <?php endif; ?>

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
        });

        // Funkcja pomocnicza do powrotu do kreatora
        function goBackToCreator() {
            // Przekieruj na stronę główną z parametrami
            window.location.href = '<?php echo e(route("home")); ?>?project=<?php echo e($project->id); ?>&step=4&fromPreview=true';
        }

        let scene, camera, renderer, controls, labelMesh;
        let isAnimating = false;
        let libraries3DLoaded = false;

        // Project configuration from backend
        const projectConfig = {
            shape: '<?php echo e($project->labelShape->slug); ?>',
            material: '<?php echo e($project->labelMaterial->slug); ?>',
            dimensions: {
                width: <?php echo e($dimensions['width']); ?>,
                height: <?php echo e($dimensions['height']); ?>

            },
            textureUrl: '<?php echo e($project->labelMaterial->texture_image_path ? asset($project->labelMaterial->texture_image_path) : ""); ?>',
            artworkUrl: '<?php echo e($project->artwork_file_path ? (Str::startsWith($project->artwork_file_path, "http") ? $project->artwork_file_path : Storage::url($project->artwork_file_path)) : ""); ?>',
            hasLaminate: <?php echo e($project->laminateOption ? 'true' : 'false'); ?>,
            // Dodajemy dane pozycjonowania obrazu
            imagePosition: {
                x: <?php echo e($project->image_position_x ?? 50); ?>,
                y: <?php echo e($project->image_position_y ?? 50); ?>,
                scale: <?php echo e($project->image_scale ?? 100); ?>,
                rotation: <?php echo e($project->image_rotation ?? 0); ?>

            },
            debug: {
                hasArtwork: <?php echo e($project->artwork_file_path ? 'true' : 'false'); ?>,
                artworkPath: '<?php echo e($project->artwork_file_path ?: "brak"); ?>'
            }
        };

        // Dodaj bezpośrednio po definicji projectConfig
        // Wygeneruj alternatywny URL na wypadek problemów
        const directStorageUrl = '/storage/<?php echo e($project->artwork_file_path); ?>';
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

        // AUTOMATYCZNIE POKAZUJ 2D FALLBACK PO 5 SEKUNDACH (ZWIĘKSZONY CZAS)
        setTimeout(function() {
            if (document.getElementById('preview-loading').style.display !== 'none') {
                show2DFallback();
            }
        }, 5000);

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

                // Zmodyfikowany renderer
                renderer = new THREE.WebGLRenderer({
                    antialias: true,
                    alpha: true,
                    powerPreference: "high-performance"
                });
                renderer.setSize(container.offsetWidth, container.offsetHeight);
                renderer.shadowMap.enabled = true;
                renderer.shadowMap.type = THREE.PCFSoftShadowMap;
                // NOWE: dodaj korekcję tonalną i ustawienia gammy
                renderer.toneMapping = THREE.ACESFilmicToneMapping;
                renderer.toneMappingExposure = 0.8; // zmniejsz ekspozycję
                renderer.outputEncoding = THREE.sRGBEncoding;
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

                // ZMIENIONE OŚWIETLENIE - ŁAGODNIEJSZE BEZ EFEKTU ŚWIECENIA
                // Łagodniejsze światło otoczenia
                const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
                scene.add(ambientLight);

                // Delikatne światło kierunkowe z przodu
                const frontLight = new THREE.DirectionalLight(0xffffff, 0.4);
                frontLight.position.set(0, 0, 100);
                scene.add(frontLight);

                // Bardzo słabe światło z tyłu
                const backLight = new THREE.DirectionalLight(0xffffff, 0.1);
                backLight.position.set(0, 0, -100);
                scene.add(backLight);

                // Nowe światło pomocnicze z góry
                const topLight = new THREE.DirectionalLight(0xffffff, 0.2);
                topLight.position.set(0, 100, 0);
                scene.add(topLight);

                // CAŁKOWICIE NOWY KOD TWORZENIA ETYKIETY 3D
                const width = projectConfig.dimensions.width;
                const height = projectConfig.dimensions.height;
                const labelDepth = 2; // ZMIENIONE Z 8 NA 2 - realistyczna grubość etykiety

                // Tworzenie podstawowego kształtu 2D
                let shape = new THREE.Shape();
                if (projectConfig.shape === 'circle') {
                    const radius = Math.max(width, height) / 2;
                    shape.absarc(0, 0, radius, 0, Math.PI * 2, false);
                } else if (projectConfig.shape === 'oval') {
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
                } else if (projectConfig.shape === 'star') {
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
                    // Prostokąt/kwadrat
                    const halfWidth = width / 2;
                    const halfHeight = height / 2;
                    shape.moveTo(-halfWidth, -halfHeight);
                    shape.lineTo(halfWidth, -halfHeight);
                    shape.lineTo(halfWidth, halfHeight);
                    shape.lineTo(-halfWidth, halfHeight);
                }
                shape.closePath();

                // Ustawienia ekstrudowania - kluczowe dla dobrego wyglądu
                const extrudeSettings = {
                    steps: 1,
                    depth: labelDepth,
                    bevelEnabled: true,
                    bevelThickness: 0.8,
                    bevelSize: 0.7,
                    bevelOffset: 0,
                    bevelSegments: 3
                };

                // Stwórz geometrię 3D
                const geometry = new THREE.ExtrudeGeometry(shape, extrudeSettings);

                // Kolor materiału zależny od wybranego typu
                let materialColor;
                if (projectConfig.material.includes('gold') || projectConfig.material.includes('zlota')) {
                    materialColor = 0xffd700; // Złoty
                } else if (projectConfig.material.includes('silver') || projectConfig.material.includes('srebrna')) {
                    materialColor = 0xe0e0e0; // Srebrny
                } else {
                    materialColor = 0xffffff; // Biały
                }

                // Parametry materiału zależne od typu
                const roughness = projectConfig.material.includes('glossy') ? 0.1 : 0.7;
                const metalness = projectConfig.material.includes('foil') ||
                                 projectConfig.material.includes('folia') ? 0.8 : 0.1;

                // Tworzenie jednolitego materiału dla całej etykiety
                const labelMaterial = new THREE.MeshStandardMaterial({
                    color: materialColor,
                    roughness: roughness,
                    metalness: metalness,
                    side: THREE.DoubleSide
                });

                // Tworzenie siatki
                labelMesh = new THREE.Mesh(geometry, labelMaterial);
                labelMesh.castShadow = true;
                labelMesh.receiveShadow = true;
                scene.add(labelMesh);

                // NAPRAWIONY KOD ŁADOWANIA I APLIKOWANIA TEKSTUR
                if (projectConfig.artworkUrl || projectConfig.debug.artworkPath) {
                    console.log('Ładowanie tekstury użytkownika...');

                    // Tworzymy listę URLi do spróbowania (bez filtrowania)
                    const urls = [
                        projectConfig.artworkUrl,
                        '/storage/' + projectConfig.debug.artworkPath,
                        window.location.origin + '/storage/' + projectConfig.debug.artworkPath,
                        '/storage/app/public/' + projectConfig.debug.artworkPath,
                        window.location.origin + '/storage/app/public/' + projectConfig.debug.artworkPath
                    ];

                    console.log('Dostępne URLe:', urls);

                    // Konfiguracja loadera tekstur
                    const textureLoader = new THREE.TextureLoader();
                    textureLoader.crossOrigin = 'anonymous';

                    // Flaga czy załadowaliśmy już obrazek pomyślnie
                    let textureLoaded = false;

                    // Funkcja do mapowania tekstury na materiał
                    function applyTextureToMaterial(texture) {
                        console.log('Aplikowanie tekstury do materiału:', texture);

                        // Ustawienia podstawowe tekstury
                        texture.encoding = THREE.sRGBEncoding;
                        texture.needsUpdate = true;

                        // Ustaw mapowanie tekstury na współrzędne UV
                        texture.center.set(0.5, 0.5);
                        texture.offset.x = ((projectConfig.imagePosition.x || 50) - 50) / 100;
                        texture.offset.y = ((projectConfig.imagePosition.y || 50) - 50) / -100;
                        texture.rotation = (projectConfig.imagePosition.rotation || 0) * Math.PI / 180;

                        const scale = projectConfig.imagePosition.scale || 100;
                        texture.repeat.set(100/scale, 100/scale);

                        // Zapobiegnij powtarzaniu
                        texture.wrapS = texture.wrapT = THREE.ClampToEdgeWrapping;

                        // Zastosuj teksturę jako mapę koloru materiału
                        labelMaterial.map = texture;
                        labelMaterial.needsUpdate = true;

                        // Wymuś ponowne renderowanie
                        renderer.render(scene, camera);
                    }

                    // Próbujemy każdy URL po kolei
                    for (let i = 0; i < urls.length && !textureLoaded; i++) {
                        const url = urls[i];
                        if (!url) continue;

                        console.log(`Próba ${i+1}/${urls.length}: ${url}`);

                        // Dodaj timestamp aby uniknąć cache'owania
                        const urlWithTimestamp = url + '?t=' + new Date().getTime();

                        // Bezpośrednie ładowanie tekstury
                        textureLoader.load(
                            urlWithTimestamp,
                            // Sukces
                            function(texture) {
                                if (textureLoaded) return; // Unikamy wielokrotnego ładowania

                                console.log('Tekstura załadowana pomyślnie z:', urlWithTimestamp);
                                textureLoaded = true;
                                applyTextureToMaterial(texture);
                            },
                            // Postęp - nie używamy, ale można dodać wskaźnik ładowania
                            undefined,
                            // Błąd - idziemy do następnego URL
                            function(error) {
                                console.warn(`Błąd ładowania tekstury z ${urlWithTimestamp}:`, error);
                            }
                        );
                    }

                    // Dodatkowy fallback, jeśli żaden z URLów nie zadziała
                    setTimeout(() => {
                        if (!textureLoaded && projectConfig.debug.artworkPath) {
                            console.log('Próba bezpośredniego ładowania przez IMG tag...');

                            // Tworzymy element IMG do sprawdzenia czy obrazek faktycznie istnieje
                            const img = new Image();
                            img.crossOrigin = "Anonymous";
                            img.onload = function() {
                                console.log('Obrazek załadowany przez IMG tag, tworzę teksturę...');
                                const texture = new THREE.Texture(img);
                                texture.needsUpdate = true;
                                applyTextureToMaterial(texture);
                            };
                            img.src = '/storage/' + projectConfig.debug.artworkPath + '?t=' + new Date().getTime();
                        }
                    }, 2000);
                }

                // Add laminate layer if selected
                if (projectConfig.hasLaminate) {
                    const laminateGeometry = geometry.clone();
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

                // Dodajemy miarki pokazujące wymiary
                addRulers(scene, projectConfig.dimensions.width, projectConfig.dimensions.height, labelDepth);

                // Dodaj funkcję do debugowania tekstur - można wywołać z konsoli
                window.debugTextureLoading = function() {
                    console.log('=== DIAGNOSTYKA ŁADOWANIA TEKSTUR ===');
                    console.log('projectConfig:', projectConfig);

                    if (projectConfig.artworkUrl) {
                        fetch(projectConfig.artworkUrl)
                            .then(response => {
                                console.log('Fetch artworkUrl:',
                                    response.ok ? 'SUKCES' : 'BŁĄD',
                                    response.status,
                                    response.statusText);
                                return response.blob();
                            })
                            .then(blob => console.log('Rozmiar pliku:', blob.size, 'typ:', blob.type))
                            .catch(err => console.error('Błąd fetch:', err));
                    }

                    if (projectConfig.debug.artworkPath) {
                        const url = '/storage/' + projectConfig.debug.artworkPath;
                        fetch(url)
                            .then(response => {
                                console.log('Fetch storage path:',
                                    response.ok ? 'SUKCES' : 'BŁĄD',
                                    response.status,
                                    response.statusText);
                                return response.blob();
                            })
                            .then(blob => console.log('Rozmiar pliku:', blob.size, 'typ:', blob.type))
                            .catch(err => console.error('Błąd fetch:', err));
                    }

                    if (labelMaterial) {
                        console.log('Status materiału:', labelMaterial);
                        console.log('Mapa tekstury:', labelMaterial.map);
                    }
                };

                // Wywołaj automatycznie po załadowaniu
                setTimeout(window.debugTextureLoading, 3000);

                // Dodaj informacje debugowe
                console.log('Inicjalizacja 3D zakończona');
                console.log('Geometria:', geometry);
                console.log('Materiał:', labelMaterial);

                // Hide loading, start render loop
                document.getElementById('preview-loading').style.display = 'none';
                isAnimating = true;
                animate();

            } catch (error) {
                console.error('3D initialization error:', error);
                show2DFallback();
            }
        }

        // Funkcja dodająca miarki pokazujące wymiary
        function addRulers(scene, width, height, depth) {
            const rulerColor = 0x333333;
            const rulerWidth = 0.5;
            const labelOffset = 15; // Odległość miarki od etykiety

            // Miarka szerokości (pozioma)
            const widthGeometry = new THREE.BoxGeometry(width, rulerWidth, rulerWidth);
            const widthMaterial = new THREE.MeshBasicMaterial({ color: rulerColor });
            const widthRuler = new THREE.Mesh(widthGeometry, widthMaterial);
            widthRuler.position.set(0, -height/2 - labelOffset, 0);
            scene.add(widthRuler);

            // Znaczniki i liczby szerokości
            const tickSize = 2;
            const tickSpacing = 10; // 10mm między znacznikami
            const numTicks = Math.floor(width / tickSpacing);

            for (let i = 0; i <= numTicks; i++) {
                // Pomijamy środkowy znacznik aby uniknąć nakładania się z miarką wysokości
                if (i === Math.floor(numTicks / 2) && i * tickSpacing === width / 2) continue;

                const tickPos = -width/2 + i * tickSpacing;
                const tickGeometry = new THREE.BoxGeometry(rulerWidth, tickSize, rulerWidth);
                const tick = new THREE.Mesh(tickGeometry, widthMaterial);
                tick.position.set(tickPos, -height/2 - labelOffset, 0);
                scene.add(tick);

                // Dodaj tekst z wymiarami
                if (i % 2 === 0) { // Dodaj liczby co drugi znacznik dla czytelności
                    addTextLabel(scene, `${i * tickSpacing}`,
                        tickPos, -height/2 - labelOffset - tickSize - 3, 0);
                }
            }

            // Tekst z wymiarami szerokości
            addTextLabel(scene, `${width}mm`, 0, -height/2 - labelOffset - 10, 0, 1.5);

            // Miarka wysokości (pionowa)
            const heightGeometry = new THREE.BoxGeometry(rulerWidth, height, rulerWidth);
            const heightMaterial = new THREE.MeshBasicMaterial({ color: rulerColor });
            const heightRuler = new THREE.Mesh(heightGeometry, heightMaterial);
            heightRuler.position.set(-width/2 - labelOffset, 0, 0);
            scene.add(heightRuler);

            // Znaczniki i liczby wysokości
            const heightTicks = Math.floor(height / tickSpacing);

            for (let i = 0; i <= heightTicks; i++) {
                const tickPos = -height/2 + i * tickSpacing;
                const tickGeometry = new THREE.BoxGeometry(tickSize, rulerWidth, rulerWidth);
                const tick = new THREE.Mesh(tickGeometry, heightMaterial);
                tick.position.set(-width/2 - labelOffset, tickPos, 0);
                scene.add(tick);

                // Dodaj tekst z wymiarami
                if (i % 2 === 0) { // Dodaj liczby co drugi znacznik
                    addTextLabel(scene, `${i * tickSpacing}`,
                        -width/2 - labelOffset - tickSize - 3, tickPos, 0);
                }
            }

            // Tekst z wymiarami wysokości
            addTextLabel(scene, `${height}mm`, -width/2 - labelOffset - 15, 0, 0, 1.5, true);
        }

        // Funkcja pomocnicza do dodawania etykiet tekstowych
        function addTextLabel(scene, text, x, y, z, size = 1, rotated = false) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = 100;
            canvas.height = 50;

            // Ustaw właściwości tekstu
            context.fillStyle = '#000000';
            context.font = `${16 * size}px Arial`;
            context.textAlign = 'center';
            context.textBaseline = 'middle';
            context.fillText(text, canvas.width/2, canvas.height/2);

            // Stwórz teksturę
            const texture = new THREE.CanvasTexture(canvas);
            const material = new THREE.SpriteMaterial({ map: texture, transparent: true });
            const sprite = new THREE.Sprite(material);

            // Skaluj i pozycjonuj
            sprite.scale.set(10 * size, 5 * size, 1);
            sprite.position.set(x, y, z);

            // Obróć tekst jeśli potrzeba (dla pionowych pomiarów)
            if (rotated) {
                sprite.material.rotation = Math.PI / 2;
            }

            scene.add(sprite);
            return sprite;
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

        function createStarGeometry(extrude = false, depth = 0) {
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

            if (extrude) {
                const extrudeSettings = {
                    steps: 1,
                    depth: depth,
                    bevelEnabled: true,
                    bevelThickness: 0.5,
                    bevelSize: 0.5,
                    bevelOffset: 0,
                    bevelSegments: 3
                };

                return new THREE.ExtrudeGeometry(shape, extrudeSettings);
            } else {
                return new THREE.ShapeGeometry(shape);
            }
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
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/label/preview.blade.php ENDPATH**/ ?>