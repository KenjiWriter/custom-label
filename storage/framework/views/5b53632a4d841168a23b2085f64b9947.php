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
                        
                        <!-- Error State (initially hidden) -->
                        <div id="preview-error" class="absolute inset-0 flex items-center justify-center hidden">
                            <div class="text-center p-8">
                                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Podgląd 3D tymczasowo niedostępny</h3>
                                <p class="text-gray-600 mb-4">Wyświetlamy podgląd 2D Twojej etykiety</p>
                                
                                <!-- 2D Fallback Preview -->
                                <div class="bg-white border-2 border-dashed border-orange-300 rounded-xl p-8 max-w-md mx-auto">
                                    <div class="text-center">
                                        <?php $dimensions = $project->getActualDimensions(); ?>
                                        
                                        <!-- Shape representation -->
                                        <?php if($project->labelShape->slug === 'circle'): ?>
                                            <div class="w-32 h-32 bg-gradient-to-br from-orange-100 to-orange-200 rounded-full mx-auto flex items-center justify-center border-2 border-orange-400">
                                        <?php elseif($project->labelShape->slug === 'square'): ?>
                                            <div class="w-32 h-32 bg-gradient-to-br from-orange-100 to-orange-200 mx-auto flex items-center justify-center border-2 border-orange-400 rounded-lg">
                                        <?php else: ?>
                                            <div class="w-40 h-24 bg-gradient-to-br from-orange-100 to-orange-200 mx-auto flex items-center justify-center border-2 border-orange-400 rounded-lg">
                                        <?php endif; ?>
                                            <div class="text-center">
                                                <div class="text-lg font-bold text-orange-800"><?php echo e($project->labelShape->name); ?></div>
                                                <div class="text-sm text-orange-600"><?php echo e($dimensions['width_mm']); ?>×<?php echo e($dimensions['height_mm']); ?>mm</div>
                                                <div class="text-xs text-orange-500 mt-1"><?php echo e($project->labelMaterial->name); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Controls -->
                        <div class="absolute bottom-4 left-4 flex space-x-2" id="preview-controls" style="display: none;">
                            <button id="reset-camera" 
                                    class="bg-white/80 hover:bg-white text-gray-700 p-2 rounded-lg shadow-sm backdrop-blur-sm transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                            <button id="toggle-animation" 
                                    class="bg-white/80 hover:bg-white text-gray-700 p-2 rounded-lg shadow-sm backdrop-blur-sm transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1M9 16v-2a2 2 0 012-2h2a2 2 0 012 2v2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Material Preview -->
                <?php if($project->labelMaterial->texture_image_path): ?>
                <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Podgląd materiału
                    </h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto mb-2 rounded-lg overflow-hidden">
                                <img src="<?php echo e(asset('storage/' . $project->labelMaterial->texture_image_path)); ?>" 
                                     alt="<?php echo e($project->labelMaterial->name); ?>" 
                                     class="w-full h-full object-cover">
                            </div>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($project->labelMaterial->name); ?></p>
                        </div>
                        
                        <?php if($project->laminateOption): ?>
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto mb-2 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <span class="text-gray-600 text-sm font-medium"><?php echo e(strtoupper(substr($project->laminateOption->finish_type ?? 'L', 0, 1))); ?></span>
                            </div>
                            <p class="text-sm font-medium text-gray-900"><?php echo e($project->laminateOption->name); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Order Summary -->
            <div class="space-y-6">
                <!-- Configuration Summary -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">
                        Podsumowanie konfiguracji
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kształt:</span>
                            <span class="font-medium"><?php echo e($project->labelShape->name); ?></span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Materiał:</span>
                            <span class="font-medium"><?php echo e($project->labelMaterial->name); ?></span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Laminat:</span>
                            <span class="font-medium">
                                <?php echo e($project->laminateOption ? $project->laminateOption->name : 'Bez laminatu'); ?>

                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Rozmiar:</span>
                            <span class="font-medium">
                                <?php $dimensions = $project->getActualDimensions(); ?>
                                <?php echo e($dimensions['width_mm']); ?>mm × <?php echo e($dimensions['height_mm']); ?>mm
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Powierzchnia:</span>
                            <span class="font-medium"><?php echo e(number_format($project->getAreaCm2(), 1)); ?> cm²</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ilość:</span>
                            <span class="font-medium"><?php echo e($project->quantity); ?> szt.</span>
                        </div>
                        
                        <?php if($project->artwork_file_path): ?>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Grafika:</span>
                            <span class="font-medium text-green-600">✓ Przesłana</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-6 border border-orange-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        Cena zamówienia
                    </h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Cena za sztukę:</span>
                            <span><?php echo e(number_format($project->calculated_price / $project->quantity, 2)); ?> PLN</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ilość:</span>
                            <span><?php echo e($project->quantity); ?> szt.</span>
                        </div>
                        
                        <div class="flex justify-between font-medium border-t border-orange-200 pt-3">
                            <span>Suma netto:</span>
                            <span><?php echo e(number_format($project->calculated_price / 1.23, 2)); ?> PLN</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">VAT (23%):</span>
                            <span><?php echo e(number_format($project->calculated_price - ($project->calculated_price / 1.23), 2)); ?> PLN</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-orange-200 mt-4 pt-4">
                        <div class="flex justify-between items-center text-xl font-bold text-orange-900">
                            <span>Razem:</span>
                            <span><?php echo e(number_format($project->calculated_price, 2)); ?> PLN</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <button onclick="proceedToPayment()" 
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105">
                        Przejdź do płatności
                    </button>
                    
                    <a href="<?php echo e(route('home')); ?>" 
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

    <?php $__env->startPush('scripts'); ?>
    <script>
        let scene, camera, renderer, controls, labelMesh;
        let isAnimating = false;
        let libraries3DLoaded = false;

        // Project configuration from backend
        const projectConfig = {
            shape: '<?php echo e($project->labelShape->slug); ?>',
            material: '<?php echo e($project->labelMaterial->slug); ?>',
            dimensions: {
                width: <?php echo e($dimensions['width_mm'] ?? 100); ?>,
                height: <?php echo e($dimensions['height_mm'] ?? 60); ?>

            },
            textureUrl: '<?php echo e($project->labelMaterial->texture_image_path ? asset("storage/" . $project->labelMaterial->texture_image_path) : ""); ?>',
            artworkUrl: '<?php echo e($project->artwork_file_path ? asset("storage/" . $project->artwork_file_path) : ""); ?>'
        };

        // Try to load 3D libraries
        function load3DLibraries() {
            return new Promise((resolve, reject) => {
                // Check if THREE is already loaded
                if (typeof THREE !== 'undefined') {
                    libraries3DLoaded = true;
                    resolve();
                    return;
                }

                // Load Three.js
                const threeScript = document.createElement('script');
                threeScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
                threeScript.onload = function() {
                    console.log('Three.js loaded successfully');
                    
                    // Load OrbitControls
                    const controlsScript = document.createElement('script');
                    controlsScript.src = 'https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js';
                    controlsScript.onload = function() {
                        console.log('OrbitControls loaded successfully');
                        libraries3DLoaded = true;
                        resolve();
                    };
                    controlsScript.onerror = function() {
                        console.warn('Failed to load OrbitControls, trying alternative');
                        // Try alternative CDN
                        const altControlsScript = document.createElement('script');
                        altControlsScript.src = 'https://threejs.org/examples/js/controls/OrbitControls.js';
                        altControlsScript.onload = () => {
                            console.log('OrbitControls loaded from alternative CDN');
                            libraries3DLoaded = true;
                            resolve();
                        };
                        altControlsScript.onerror = () => {
                            console.error('Failed to load OrbitControls from all sources');
                            reject(new Error('Failed to load 3D libraries'));
                        };
                        document.head.appendChild(altControlsScript);
                    };
                    document.head.appendChild(controlsScript);
                };
                threeScript.onerror = function() {
                    console.error('Failed to load Three.js');
                    reject(new Error('Failed to load Three.js'));
                };
                document.head.appendChild(threeScript);
            });
        }

        function init3DPreview() {
            const container = document.getElementById('label-3d-preview');
            const loadingDiv = document.getElementById('preview-loading');
            const errorDiv = document.getElementById('preview-error');
            const controlsDiv = document.getElementById('preview-controls');
            
            if (!libraries3DLoaded || typeof THREE === 'undefined') {
                console.error('Three.js not loaded');
                showError();
                return;
            }

            try {
                // Scene setup
                scene = new THREE.Scene();
                scene.background = new THREE.Color(0xf8fafc);
                
                // Camera setup
                camera = new THREE.PerspectiveCamera(75, container.offsetWidth / container.offsetHeight, 0.1, 1000);
                camera.position.set(0, 0, 3);
                
                // Renderer setup
                renderer = new THREE.WebGLRenderer({ antialias: true });
                renderer.setSize(container.offsetWidth, container.offsetHeight);
                renderer.shadowMap.enabled = true;
                renderer.shadowMap.type = THREE.PCFSoftShadowMap;
                container.appendChild(renderer.domElement);
                
                // Controls (check if OrbitControls is available)
                if (typeof THREE.OrbitControls !== 'undefined') {
                    controls = new THREE.OrbitControls(camera, renderer.domElement);
                    controls.enableDamping = true;
                    controls.dampingFactor = 0.05;
                    controls.maxDistance = 10;
                    controls.minDistance = 1;
                } else {
                    console.warn('OrbitControls not available, using basic camera');
                }
                
                // Lighting
                const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
                scene.add(ambientLight);
                
                const directionalLight = new THREE.DirectionalLight(0xffffff, 0.4);
                directionalLight.position.set(5, 5, 5);
                directionalLight.castShadow = true;
                scene.add(directionalLight);
                
                // Create label based on configuration
                createLabel();
                
                // Hide loading, show controls
                loadingDiv.style.display = 'none';
                controlsDiv.style.display = 'flex';
                
                // Animation loop
                animate();
                
                console.log('3D Preview initialized successfully');
                
            } catch (error) {
                console.error('Error initializing 3D preview:', error);
                showError();
            }
        }

        function createLabel() {
            const width = Math.max(projectConfig.dimensions.width / 100, 0.5); // Convert mm to scene units, min 0.5
            const height = Math.max(projectConfig.dimensions.height / 100, 0.5);
            
            let geometry;
            
            // Create geometry based on shape
            switch(projectConfig.shape) {
                case 'circle':
                case 'circular':
                    geometry = new THREE.CircleGeometry(Math.max(width, height) / 2, 32);
                    break;
                case 'square':
                    const size = Math.max(width, height);
                    geometry = new THREE.PlaneGeometry(size, size);
                    break;
                default: // rectangle and others
                    geometry = new THREE.PlaneGeometry(width, height);
                    break;
            }
            
            // Material with nice orange color as default
            const material = new THREE.MeshLambertMaterial({ 
                color: 0xffa94d,
                transparent: true,
                opacity: 0.9
            });
            
            // Load material texture if available
            if (projectConfig.textureUrl && projectConfig.textureUrl !== '') {
                const loader = new THREE.TextureLoader();
                loader.load(
                    projectConfig.textureUrl, 
                    function(texture) {
                        texture.wrapS = THREE.RepeatWrapping;
                        texture.wrapT = THREE.RepeatWrapping;
                        texture.repeat.set(1, 1);
                        material.map = texture;
                        material.needsUpdate = true;
                        console.log('Material texture loaded');
                    },
                    undefined,
                    function(error) {
                        console.warn('Failed to load material texture:', error);
                    }
                );
            }
            
            labelMesh = new THREE.Mesh(geometry, material);
            labelMesh.receiveShadow = true;
            labelMesh.castShadow = true;
            scene.add(labelMesh);
            
            // Load artwork if available
            if (projectConfig.artworkUrl && projectConfig.artworkUrl !== '') {
                const loader = new THREE.TextureLoader();
                loader.load(
                    projectConfig.artworkUrl, 
                    function(texture) {
                        // Create artwork overlay
                        const artworkMaterial = new THREE.MeshLambertMaterial({ 
                            map: texture, 
                            transparent: true,
                            opacity: 0.9
                        });
                        
                        const artworkGeometry = geometry.clone();
                        const artworkMesh = new THREE.Mesh(artworkGeometry, artworkMaterial);
                        artworkMesh.position.z = 0.001; // Slightly above the base
                        scene.add(artworkMesh);
                        console.log('Artwork texture loaded');
                    },
                    undefined,
                    function(error) {
                        console.warn('Failed to load artwork texture:', error);
                    }
                );
            }
        }

        function animate() {
            if (!renderer || !scene || !camera) return;
            
            requestAnimationFrame(animate);
            
            if (isAnimating && labelMesh) {
                labelMesh.rotation.z += 0.01;
            }
            
            if (controls) {
                controls.update();
            }
            
            renderer.render(scene, camera);
        }

        function resetCamera() {
            if (!camera || !controls) return;
            camera.position.set(0, 0, 3);
            if (controls.reset) {
                controls.reset();
            }
        }

        function toggleAnimation() {
            isAnimating = !isAnimating;
            const button = document.getElementById('toggle-animation');
            if (button) {
                button.style.backgroundColor = isAnimating ? '#f97316' : '';
                button.style.color = isAnimating ? 'white' : '';
            }
        }

        function showError() {
            const loadingDiv = document.getElementById('preview-loading');
            const errorDiv = document.getElementById('preview-error');
            
            if (loadingDiv) loadingDiv.style.display = 'none';
            if (errorDiv) errorDiv.style.display = 'flex';
        }

        function proceedToPayment() {
            // Here you would implement payment flow
            alert('Funkcja płatności będzie dostępna wkrótce!');
        }

        // Window resize handler
        window.addEventListener('resize', function() {
            if (!camera || !renderer) return;
            
            const container = document.getElementById('label-3d-preview');
            if (container) {
                camera.aspect = container.offsetWidth / container.offsetHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.offsetWidth, container.offsetHeight);
            }
        });

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing 3D preview...');
            
            // Load 3D libraries and then initialize
            load3DLibraries()
                .then(() => {
                    console.log('3D libraries loaded, initializing preview...');
                    setTimeout(init3DPreview, 500); // Small delay to ensure container is properly sized
                })
                .catch((error) => {
                    console.error('Failed to load 3D libraries:', error);
                    setTimeout(showError, 1000); // Show error after 1 second
                });
        });

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const resetBtn = document.getElementById('reset-camera');
                const toggleBtn = document.getElementById('toggle-animation');
                
                if (resetBtn) {
                    resetBtn.addEventListener('click', resetCamera);
                }
                if (toggleBtn) {
                    toggleBtn.addEventListener('click', toggleAnimation);
                }
            }, 1000);
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
<?php endif; ?><?php /**PATH C:\dev\custom-label\resources\views/label/preview.blade.php ENDPATH**/ ?>