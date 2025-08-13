<div data-creator-section 
     x-data="{ 
        currentStep: 1,
        totalSteps: 4,
        nextStep() { 
            if (this.currentStep < this.totalSteps) this.currentStep++; 
        },
        prevStep() { 
            if (this.currentStep > 1) this.currentStep--; 
        }
    }" 
     class="space-y-8" 
     id="label-creator">

    <!-- Progress Bar -->
    <div class="relative mb-12">
        <div class="flex items-center justify-between">
            <template x-for="step in totalSteps" :key="step">
                <div class="flex items-center" :class="step < totalSteps ? 'flex-1' : ''">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full border-2 transition-all duration-300"
                         :class="currentStep >= step ? 'bg-orange-500 border-orange-500 text-white shadow-lg' : 'bg-white border-gray-300 text-gray-400'">
                        <span x-text="step" class="font-semibold"></span>
                    </div>
                    <div x-show="step < totalSteps" class="flex-1 h-1 mx-4 transition-all duration-300"
                         :class="currentStep > step ? 'bg-orange-500' : 'bg-gray-200'">
                    </div>
                </div>
            </template>
        </div>
        
        <!-- Step Labels -->
        <div class="flex justify-between mt-4 text-sm">
            <span class="text-center font-medium" :class="currentStep >= 1 ? 'text-orange-600' : 'text-gray-500'">Kształt</span>
            <span class="text-center font-medium" :class="currentStep >= 2 ? 'text-orange-600' : 'text-gray-500'">Materiał</span>
            <span class="text-center font-medium" :class="currentStep >= 3 ? 'text-orange-600' : 'text-gray-500'">Laminat & Rozmiar</span>
            <span class="text-center font-medium" :class="currentStep >= 4 ? 'text-orange-600' : 'text-gray-500'">Finalizacja</span>
        </div>
    </div>

    <form wire:submit="saveProject" class="space-y-12">
        <!-- Step 1: Shape Selection -->
        <div x-show="currentStep === 1" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-8"
             class="space-y-8">
            
            <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Wybierz kształt etykiety</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Wybierz kształt, który najlepiej pasuje do Twojego produktu. Każdy kształt ma swoje unikalne zastosowania.
                </p>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($shapes as $shape)
                    <label class="relative cursor-pointer group">
                        <input type="radio" wire:model.live="selectedShape" value="{{ $shape->id }}" class="sr-only">
                        <div class="border-2 rounded-xl p-6 text-center transition-all duration-200 group-hover:shadow-xl group-hover:scale-105 bg-orange-50"
                             :class="$wire.selectedShape == {{ $shape->id }} ? 'border-orange-500 bg-orange-100 shadow-lg transform scale-105' : 'border-gray-200 hover:border-gray-300'">
                            
                            @if($shape->icon_path)
                                <img src="{{ asset('storage/' . $shape->icon_path) }}" alt="{{ $shape->name }}" class="w-16 h-16 mx-auto mb-4">
                            @else
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                                    <span class="text-orange-600 text-xl font-bold">{{ substr($shape->name, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <h4 class="font-semibold text-gray-900 mb-2">{{ $shape->name }}</h4>
                            @if($shape->description)
                                <p class="text-sm text-gray-500 leading-relaxed">{{ $shape->description }}</p>
                            @endif
                        </div>
                    </label>
                @endforeach
            </div>
            
            @error('selectedShape')
                <p class="text-red-600 text-sm mt-2 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Step 2: Material Selection -->
        <div x-show="currentStep === 2" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-8"
             class="space-y-8">
            
            <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Wybierz materiał</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Każdy materiał ma inne właściwości i zastosowania. Wybierz ten, który najlepiej sprawdzi się w Twoim przypadku.
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($materials as $material)
                    <label class="relative cursor-pointer group">
                        <input type="radio" wire:model.live="selectedMaterial" value="{{ $material->id }}" class="sr-only">
                        <div class="border-2 rounded-xl p-6 transition-all duration-200 group-hover:shadow-xl bg-orange-50"
                             :class="$wire.selectedMaterial == {{ $material->id }} ? 'border-orange-500 bg-orange-100 shadow-lg' : 'border-gray-200 hover:border-gray-300'">
                            
                            @if($material->texture_image_path)
                                <div class="w-16 h-16 mx-auto mb-4 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $material->texture_image_path) }}" alt="{{ $material->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                                    <span class="text-orange-600 text-sm font-bold">{{ substr($material->name, 0, 2) }}</span>
                                </div>
                            @endif
                            
                            <h4 class="font-semibold text-gray-900 mb-2">{{ $material->name }}</h4>
                            
                            @if($material->description)
                                <p class="text-sm text-gray-500 mb-3">{{ $material->description }}</p>
                            @endif
                            
                            <div class="text-sm font-semibold text-orange-600">
                                {{ number_format($material->price_per_cm2, 2) }} PLN/cm²
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
            
            @error('selectedMaterial')
                <p class="text-red-600 text-sm mt-2 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Step 3: Laminate & Size -->
        <div x-show="currentStep === 3" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-8"
             class="space-y-8">
            
            <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Laminat i rozmiar</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Wybierz opcjonalny laminat dla dodatkowej ochrony oraz określ rozmiar etykiety.
                </p>
            </div>

            <!-- Laminate Selection -->
            <div class="space-y-6">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-orange-200 pb-2">Opcje laminowania</h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- No laminate option -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" wire:model.live="selectedLaminate" value="" class="sr-only">
                        <div class="border-2 rounded-xl p-6 text-center transition-all duration-200 group-hover:shadow-xl bg-orange-50"
                             :class="$wire.selectedLaminate === '' ? 'border-orange-500 bg-orange-100 shadow-lg' : 'border-gray-200 hover:border-gray-300'">
                            <div class="w-12 h-12 mx-auto mb-3 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900 mb-1">Bez laminatu</h4>
                            <p class="text-sm text-gray-500">Podstawowa wersja</p>
                        </div>
                    </label>

                    @foreach($laminateOptions as $laminate)
                        <label class="relative cursor-pointer group">
                            <input type="radio" wire:model.live="selectedLaminate" value="{{ $laminate->id }}" class="sr-only">
                            <div class="border-2 rounded-xl p-6 text-center transition-all duration-200 group-hover:shadow-xl bg-orange-50"
                                 :class="$wire.selectedLaminate == {{ $laminate->id }} ? 'border-orange-500 bg-orange-100 shadow-lg' : 'border-gray-200 hover:border-gray-300'">
                                
                                <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-br from-orange-100 to-orange-200 rounded-full flex items-center justify-center">
                                    <span class="text-orange-600 text-sm font-medium">{{ strtoupper(substr($laminate->finish_type ?? 'L', 0, 1)) }}</span>
                                </div>
                                
                                <h4 class="font-medium text-gray-900 mb-1">{{ $laminate->name }}</h4>
                                
                                @if($laminate->description)
                                    <p class="text-sm text-gray-500 mb-2">{{ $laminate->description }}</p>
                                @endif
                                
                                <div class="text-sm font-semibold text-orange-600">
                                    +{{ number_format(($laminate->price_multiplier - 1) * 100, 0) }}%
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Size Selection -->
            <div class="space-y-6">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-orange-200 pb-2">Wybierz rozmiar</h4>
                
                <!-- Size Type Toggle -->
                <div class="flex flex-wrap gap-4 justify-center bg-orange-50 p-4 rounded-xl">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model.live="useCustomSize" value="false" class="mr-2 text-orange-500 focus:ring-orange-500">
                        <span class="text-sm font-medium text-gray-700">Standardowe rozmiary</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model.live="useCustomSize" value="true" class="mr-2 text-orange-500 focus:ring-orange-500">
                        <span class="text-sm font-medium text-gray-700">Rozmiar niestandardowy</span>
                    </label>
                </div>

                <!-- Predefined Sizes -->
                @if(!$useCustomSize && count($availableSizes) > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach($availableSizes as $size)
                            <label class="relative cursor-pointer group">
                                <input type="radio" wire:model.live="selectedSize" value="{{ $size->id }}" class="sr-only">
                                <div class="border-2 rounded-xl p-4 text-center transition-all duration-200 group-hover:shadow-md bg-orange-50"
                                     :class="$wire.selectedSize == {{ $size->id }} ? 'border-orange-500 bg-orange-100 shadow-lg' : 'border-gray-200 hover:border-gray-300'">
                                    <h4 class="font-medium text-gray-900 mb-1">{{ $size->name }}</h4>
                                    <p class="text-xs text-gray-400 mt-1">{{ number_format($size->getAreaCm2(), 1) }} cm²</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    
                    @error('selectedSize')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                @endif

                <!-- Custom Size Inputs -->
                @if($useCustomSize)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-lg mx-auto">
                        <div>
                            <label for="customWidth" class="block text-sm font-medium text-gray-700 mb-2">
                                Szerokość (mm)
                            </label>
                            <input type="number" wire:model.live="customWidth" id="customWidth" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                   placeholder="np. 100" min="10" max="500">
                            @error('customWidth')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="customHeight" class="block text-sm font-medium text-gray-700 mb-2">
                                Wysokość (mm)
                            </label>
                            <input type="number" wire:model.live="customHeight" id="customHeight"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                   placeholder="np. 60" min="10" max="500">
                            @error('customHeight')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @if($customWidth && $customHeight)
                        <div class="mt-4 p-4 bg-orange-50 rounded-xl text-center">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-orange-600">Powierzchnia: {{ number_format(($customWidth * $customHeight) / 100, 1) }} cm²</span>
                            </p>
                        </div>
                    @endif
                @endif

                @if(!$useCustomSize && count($availableSizes) === 0 && $selectedShape)
                    <div class="text-center py-8 text-gray-500 bg-orange-50 rounded-xl">
                        <p class="mb-2">Brak dostępnych standardowych rozmiarów dla wybranego kształtu.</p>
                        <p class="text-sm">Przejdź na rozmiar niestandardowy powyżej.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Step 4: Final Configuration -->
        <div x-show="currentStep === 4" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="space-y-8">
            
            <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Finalizacja zamówienia</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Sprawdź konfigurację, wybierz ilość i opcjonalnie prześlij plik graficzny.
                </p>
            </div>
            
            <!-- Configuration Summary -->
            <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-6 border border-orange-200">
                <h4 class="font-bold text-gray-900 mb-4 text-lg">Podsumowanie konfiguracji</h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    @if($selectedShape)
                        <div class="flex justify-between py-2 border-b border-orange-200">
                            <span class="text-gray-600 font-medium">Kształt:</span>
                            <span class="font-semibold text-gray-900">{{ $shapes->find($selectedShape)->name ?? 'Nie wybrano' }}</span>
                        </div>
                    @endif
                    
                    @if($selectedMaterial)
                        <div class="flex justify-between py-2 border-b border-orange-200">
                            <span class="text-gray-600 font-medium">Materiał:</span>
                            <span class="font-semibold text-gray-900">{{ $materials->find($selectedMaterial)->name ?? 'Nie wybrano' }}</span>
                        </div>
                    @endif
                    
                    <div class="flex justify-between py-2 border-b border-orange-200">
                        <span class="text-gray-600 font-medium">Laminat:</span>
                        <span class="font-semibold text-gray-900">
                            @if($selectedLaminate)
                                {{ $laminateOptions->find($selectedLaminate)->name }}
                            @else
                                Bez laminatu
                            @endif
                        </span>
                    </div>
                    
                    <div class="flex justify-between py-2 border-b border-orange-200">
                        <span class="text-gray-600 font-medium">Rozmiar:</span>
                        <span class="font-semibold text-gray-900">
                            @if($useCustomSize && $customWidth && $customHeight)
                                {{ $customWidth }}mm × {{ $customHeight }}mm
                            @elseif($selectedSize && count($availableSizes) > 0)
                                {{ $availableSizes->find($selectedSize)->name ?? 'Nie wybrano' }}
                            @else
                                Nie wybrano
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Quantity and File Upload -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <label for="quantity" class="block text-sm font-semibold text-gray-700">
                        Ilość (sztuk)
                    </label>
                    <input type="number" wire:model.live="quantity" id="quantity" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                           min="1" max="10000" placeholder="100">
                    @error('quantity')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="space-y-4">
                    <label for="artworkFile" class="block text-sm font-semibold text-gray-700">
                        Plik graficzny (opcjonalnie)
                    </label>
                    <input type="file" wire:model="artworkFile" id="artworkFile" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                           accept=".jpg,.jpeg,.png,.svg,.pdf">
                    <p class="text-xs text-gray-500">JPG, PNG, SVG, PDF - max 10MB</p>
                    @error('artworkFile')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Price Display -->
            @if($calculatedPrice > 0)
                <div class="bg-gradient-to-br from-orange-100 to-amber-100 border border-orange-300 rounded-xl p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-lg font-semibold text-orange-900">Szacowana cena:</h4>
                            <p class="text-sm text-orange-700">{{ $quantity }} szt. × {{ number_format($calculatedPrice / $quantity, 2) }} PLN</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-orange-900">{{ number_format($calculatedPrice, 2) }} PLN</div>
                            <p class="text-orange-700 text-sm">brutto (zawiera 23% VAT)</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-8 border-t border-gray-200">
            <button type="button" @click="prevStep()" x-show="currentStep > 1" 
                    class="flex items-center px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Poprzedni krok
            </button>
            <div x-show="currentStep === 1"></div>
            
<div class="flex space-x-4">
                <button type="button" @click="nextStep()" x-show="currentStep < totalSteps" 
                        class="flex items-center px-6 py-3 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition-colors duration-200">
                    Następny krok
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <button type="submit" 
                        x-show="currentStep === totalSteps" 
                        wire:loading.attr="disabled"
                        wire:target="saveProject"
                        :disabled="!$wire.isConfigurationValid"
                        :class="$wire.isConfigurationValid ? 'bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-700 hover:to-amber-700' : 'bg-gray-400 cursor-not-allowed'"
                        class="flex items-center px-8 py-3 text-white rounded-xl transition-all duration-200 font-semibold">
                    
                    <!-- Loading state -->
                    <div wire:loading wire:target="saveProject" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Zapisywanie...
                    </div>
                    
                    <!-- Normal state -->
                    <div wire:loading.remove wire:target="saveProject" class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Przejdź do podglądu 3D
                    </div>
                </button>
            </div>
        </div>
        @if(config('app.debug'))
            <div class="mt-8 p-4 bg-gray-100 rounded-xl text-sm text-gray-600">
                <h5 class="font-semibold mb-2">Debug Info:</h5>
                <div class="space-y-1">
                    <div>Kształt: {{ $selectedShape ? 'ID: ' . $selectedShape : 'Nie wybrano' }}</div>
                    <div>Materiał: {{ $selectedMaterial ? 'ID: ' . $selectedMaterial : 'Nie wybrano' }}</div>
                    <div>Rozmiar custom: {{ $useCustomSize ? 'TAK' : 'NIE' }}</div>
                    @if($useCustomSize)
                        <div>Wymiary: {{ $customWidth }}mm x {{ $customHeight }}mm</div>
                    @else
                        <div>Wybrany rozmiar: {{ $selectedSize ? 'ID: ' . $selectedSize : 'Nie wybrano' }}</div>
                        <div>Dostępne rozmiary: {{ $availableSizes->count() }}</div>
                    @endif
                    <div>Ilość: {{ $quantity }}</div>
                    <div>Konfiguracja valid: {{ $isConfigurationValid ? 'TAK' : 'NIE' }}</div>
                    <div>Cena: {{ number_format($calculatedPrice, 2) }} PLN</div>
                </div>
            </div>
        @endif
    </form>
</div>