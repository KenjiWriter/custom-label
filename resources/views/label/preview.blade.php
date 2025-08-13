
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
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                                <p class="text-gray-600">Ładowanie podglądu 3D...</p>
                            </div>
                        </div>
                        
                        <!-- Controls -->
                        <div class="absolute bottom-4 left-4 flex space-x-2">
                            <button id="reset-camera" 
                                    class="bg-white/80 hover:bg-white text-gray-700 p-2 rounded-lg shadow-sm backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                            <button id="toggle-animation" 
                                    class="bg-white/80 hover:bg-white text-gray-700 p-2 rounded-lg shadow-sm backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1M9 16v-2a2 2 0 012-2h2a2 2 0 012 2v2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Material Preview -->
                @if($project->labelMaterial->texture_image_path)
                <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Podgląd materiału
                    </h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto mb-2 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $project->labelMaterial->texture_image_path) }}" 
                                     alt="{{ $project->labelMaterial->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $project->labelMaterial->name }}</p>
                        </div>
                        
                        @if($project->laminateOption)
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto mb-2 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <span class="text-gray-600 text-sm font-medium">{{ strtoupper(substr($project->laminateOption->finish_type ?? 'L', 0, 1)) }}</span>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $project->laminateOption->name }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
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
                            <span class="font-medium">{{ $project->labelShape->name }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Materiał:</span>
                            <span class="font-medium">{{ $project->labelMaterial->name }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Laminat:</span>
                            <span class="font-medium">
                                {{ $project->laminateOption ? $project->laminateOption->name : 'Bez laminatu' }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Rozmiar:</span>
                            <span class="font-medium">
                                @php $dimensions = $project->getActualDimensions(); @endphp
                                {{ $dimensions['width_mm'] }}mm × {{ $dimensions['height_mm'] }}mm
                            </span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Powierzchnia:</span>
                            <span class="font-medium">{{ number_format($project->getAreaCm2(), 1) }} cm²</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ilość:</span>
                            <span class="font-medium">{{ $project->quantity }} szt.</span>
                        </div>
                        
                        @if($project->artwork_file_path)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Grafika:</span>
                            <span class="font-medium text-green-600">✓ Przesłana</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-6 border border-blue-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        Cena zamówienia
                    </h3>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Cena za sztukę:</span>
                            <span>{{ number_format($project->calculated_price / $project->quantity, 2) }} PLN</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ilość:</span>
                            <span>{{ $project->quantity }} szt.</span>
                        </div>
                        
                        <div class="flex justify-between font-medium border-t border-blue-200 pt-3">
                            <span>Suma netto:</span>
                            <span>{{ number_format($project->calculated_price / 1.23, 2) }} PLN</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">VAT (23%):</span>
                            <span>{{ number_format($project->calculated_price - ($project->calculated_price / 1.23), 2) }} PLN</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-blue-200 mt-4 pt-4">
                        <div class="flex justify-between items-center text-xl font-bold text-blue-900">
                            <span>Razem:</span>
                            <span>{{ number_format($project->calculated_price, 2) }} PLN</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
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
    <!-- Three.js for 3D preview -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/controls/OrbitControls.js"></script>
    
    <script>
        let scene, camera, renderer, controls, labelMesh;
        let isAnimating = false;

        // Project configuration from backend
        const projectConfig = {
            shape: '{{ $project->labelShape->slug }}',
            material: '{{ $project->labelMaterial->slug }}',
            dimensions: {
                width: {{ $dimensions['width_mm'] }},
                height: {{ $dimensions['height_mm'] }}
            },
            textureUrl: '{{ $project->labelMaterial->texture_image_path ? asset("storage/" . $project->labelMaterial->texture_image_path) : "" }}',
            artworkUrl: '{{ $project->artwork_file_path ? asset("storage/" . $project->artwork_file_path) : "" }}'
        };

        function init3DPreview() {
            const container = document.getElementById('label-3d-preview');
            const loadingDiv = document.getElementById('preview-loading');
            
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
            
            // Controls
            controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.05;
            controls.maxDistance = 10;
            controls.minDistance = 1;
            
            // Lighting
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
            scene.add(ambientLight);
            
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.4);
            directionalLight.position.set(5, 5, 5);
            directionalLight.castShadow = true;
            scene.add(directionalLight);
            
            // Create label based on configuration
            createLabel();
            
            // Hide loading
            loadingDiv.style.display = 'none';
            
            // Animation loop
            animate();
        }

        function createLabel() {
            const width = projectConfig.dimensions.width / 100; // Convert mm to scene units
            const height = projectConfig.dimensions.height / 100;
            
            let geometry;
            
            // Create geometry based on shape
            switch(projectConfig.shape) {
                case 'circle':
                case 'circular':
                    geometry = new THREE.CircleGeometry(Math.max(width, height) / 2, 32);
                    break;
                case 'square':
                    geometry = new THREE.PlaneGeometry(Math.max(width, height), Math.max(width, height));
                    break;
                default: // rectangle and others
                    geometry = new THREE.PlaneGeometry(width, height);
                    break;
            }
            
            // Material
            const loader = new THREE.TextureLoader();
            const material = new THREE.MeshLambertMaterial({ color: 0xffffff });
            
            // Load material texture if available
            if (projectConfig.textureUrl) {
                loader.load(projectConfig.textureUrl, function(texture) {
                    texture.wrapS = THREE.RepeatWrapping;
                    texture.wrapT = THREE.RepeatWrapping;
                    texture.repeat.set(2, 2);
                    material.map = texture;
                    material.needsUpdate = true;
                });
            }
            
            // Load artwork if available
            if (projectConfig.artworkUrl) {
                loader.load(projectConfig.artworkUrl, function(texture) {
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
                });
            }
            
            labelMesh = new THREE.Mesh(geometry, material);
            labelMesh.receiveShadow = true;
            scene.add(labelMesh);
        }

        function animate() {
            requestAnimationFrame(animate);
            
            if (isAnimating && labelMesh) {
                labelMesh.rotation.z += 0.01;
            }
            
            controls.update();
            renderer.render(scene, camera);
        }

        function resetCamera() {
            camera.position.set(0, 0, 3);
            controls.reset();
        }

        function toggleAnimation() {
            isAnimating = !isAnimating;
            const button = document.getElementById('toggle-animation');
            button.style.backgroundColor = isAnimating ? '#3b82f6' : '';
            button.style.color = isAnimating ? 'white' : '';
        }

        function proceedToPayment() {
            // Here you would implement payment flow
            alert('Przejście do płatności - do implementacji');
        }

        // Window resize handler
        window.addEventListener('resize', function() {
            const container = document.getElementById('label-3d-preview');
            camera.aspect = container.offsetWidth / container.offsetHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.offsetWidth, container.offsetHeight);
        });

        // Event listeners
        document.getElementById('reset-camera').addEventListener('click', resetCamera);
        document.getElementById('toggle-animation').addEventListener('click', toggleAnimation);

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(init3DPreview, 100); // Small delay to ensure container is properly sized
        });
    </script>
    @endpush
</x-layouts.app>