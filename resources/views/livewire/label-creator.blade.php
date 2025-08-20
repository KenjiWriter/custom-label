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

            <!-- Poprawione wyświetlanie obrazków kształtów -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
    @foreach($shapes as $shape)
        <label class="relative cursor-pointer group">
            <input type="radio" wire:model.live="selectedShape" value="{{ $shape->id }}" class="sr-only">
            <div class="border-2 rounded-xl p-6 text-center transition-all duration-200 group-hover:shadow-xl group-hover:scale-105 bg-orange-50"
                 :class="$wire.selectedShape == {{ $shape->id }} ? 'border-orange-500 bg-orange-100 shadow-lg transform scale-105' : 'border-gray-200 hover:border-gray-300'">

                <!-- NAPRAWIONY OBRAZEK KSZTAŁTU -->
                @if($shape->icon_path)
                    <div class="w-20 h-20 mx-auto mb-4 bg-white rounded-lg shadow-sm border border-gray-100 flex items-center justify-center">
                        <img src="{{ asset($shape->icon_path) }}"
                             alt="{{ $shape->name }}"
                             class="w-16 h-16 object-contain"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'text-orange-600 text-2xl font-bold\'>{{ substr($shape->name, 0, 1) }}</span>';">
                    </div>
                @else
                    <!-- FALLBACK - litera gdy brak obrazka -->
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                        <span class="text-orange-600 text-2xl font-bold">{{ substr($shape->name, 0, 1) }}</span>
                    </div>
                @endif

                <h4 class="font-semibold text-gray-900 mb-2">{{ $shape->name }}</h4>
                @if($shape->description)
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $shape->description }}</p>
                @endif

                @if($selectedShape == $shape->id)
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
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
            <div class="border-2 rounded-xl p-6 text-center transition-all duration-200 group-hover:shadow-xl"
                 :class="$wire.selectedMaterial == {{ $material->id }} ? 'border-orange-500 bg-orange-50 shadow-lg' : 'border-gray-200 hover:border-orange-300'">

                <!-- NAPRAWIONY OBRAZEK MATERIAŁU -->
                @if($material->texture_image_path)
                    <div class="w-20 h-20 mx-auto mb-4 rounded-lg overflow-hidden border-2 border-gray-200 shadow-sm">
                        <img src="{{ asset($material->texture_image_path) }}"
                             alt="{{ $material->name }}"
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center\'><span class=\'text-orange-600 text-xl font-bold\'>{{ substr($material->name, 0, 2) }}</span></div>';">
                    </div>
                @else
                    <!-- FALLBACK -->
                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                        <span class="text-orange-600 text-xl font-bold">{{ substr($material->name, 0, 2) }}</span>
                    </div>
                @endif

                <h4 class="font-semibold text-gray-900 mb-2">{{ $material->name }}</h4>
                @if($material->description)
                    <p class="text-sm text-gray-500 mb-2">{{ $material->description }}</p>
                @endif
                <div class="text-sm font-semibold text-orange-600">
                    {{ number_format($material->price_per_cm2, 2) }} zł/cm²
                </div>

                @if($selectedMaterial == $material->id)
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                @endif
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
            <div class="w-16 h-16 mx-auto mb-3 bg-gray-100 rounded-full flex items-center justify-center">
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

                <!-- NAPRAWIONY OBRAZEK LAMINATU -->
                @if($laminate->texture_image_path)
                    <div class="w-16 h-16 mx-auto mb-3 rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ asset($laminate->texture_image_path) }}"
                             alt="{{ $laminate->name }}"
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center\'><span class=\'text-orange-600 text-sm font-medium\'>{{ strtoupper(substr($laminate->finish_type ?? 'L', 0, 1)) }}</span></div>';">
                    </div>
                @else
                    <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-orange-100 to-orange-200 rounded-full flex items-center justify-center">
                        <span class="text-orange-600 text-sm font-medium">{{ strtoupper(substr($laminate->finish_type ?? 'L', 0, 1)) }}</span>
                    </div>
                @endif

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

                <!-- Size Type Toggle - NAPRAWIONE -->
<div class="flex flex-wrap gap-4 justify-center bg-orange-50 p-4 rounded-xl"
     x-data="{ customSize: @entangle('useCustomSize').live }">

    <label class="flex items-center cursor-pointer">
        <input type="radio"
               x-model="customSize"
               :value="false"
               @change="$wire.set('useCustomSize', false); $wire.set('selectedSize', null); $wire.set('customWidth', null); $wire.set('customHeight', null);"
               class="mr-2 text-orange-500 focus:ring-orange-500">
        <span class="text-sm font-medium text-gray-700">Standardowe rozmiary</span>
    </label>

    <label class="flex items-center cursor-pointer">
        <input type="radio"
               x-model="customSize"
               :value="true"
               @change="$wire.set('useCustomSize', true); $wire.set('selectedSize', null);"
               class="mr-2 text-orange-500 focus:ring-orange-500">
        <span class="text-sm font-medium text-gray-700">Rozmiar niestandardowy</span>
    </label>
</div>

<!-- Predefined Sizes -->
@if(!$useCustomSize && $availableSizes->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4" wire:key="standard-sizes-{{ $selectedShape }}">
        @foreach($availableSizes as $size)
            <label class="relative cursor-pointer group">
                <input type="radio" wire:model.live="selectedSize" value="{{ $size->id }}" class="sr-only">
                <div class="border-2 p-4 rounded-xl text-center transition-all duration-200
                    {{ $selectedSize == $size->id
                        ? 'border-orange-500 bg-orange-50 shadow-lg transform scale-105'
                        : 'border-gray-200 hover:border-orange-300 hover:shadow-md' }}">

                    <div class="text-sm font-medium text-gray-900 mb-1">
                        {{ $size->name }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ $size->width_mm }}×{{ $size->height_mm }}mm
                    </div>

                    @if($selectedSize == $size->id)
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </label>
        @endforeach
    </div>
@endif

<!-- Custom Size Inputs -->
@if($useCustomSize)
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6" wire:key="custom-size-inputs">
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

@if(!$useCustomSize && $availableSizes->count() === 0 && $selectedShape)
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

            <div class="space-y-6">
    <h4 class="text-lg font-semibold text-gray-900 border-b border-orange-200 pb-2">Grafika</h4>

    <!-- Grid layout z plikiem po lewej i podglądem po prawej -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Lewa kolumna - upload pliku -->
        <div class="bg-orange-50 rounded-xl p-6">
            <div x-data="{ uploading: false, progress: 0 }"
                 x-on:livewire-upload-start="uploading = true"
                 x-on:livewire-upload-finish="uploading = false"
                 x-on:livewire-upload-error="uploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="block mb-4">
                    <span class="text-gray-700">Dodaj swoją grafikę (opcjonalnie)</span>
                    <input type="file" wire:model="artworkFile" accept="image/*" class="block w-full text-sm text-gray-500 mt-2
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-orange-50 file:text-orange-600
                        hover:file:bg-orange-100">
                    <p class="text-xs text-gray-500 mt-1">Max 10MB. Formaty: JPG, PNG, SVG</p>
                </label>

                <!-- Progress bar -->
                <div x-show="uploading" class="mt-2">
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full" :style="`width: ${progress}%`"></div>
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Wgrywanie... <span x-text="progress"></span>%</div>
                </div>

                @error('artworkFile') <span class="text-red-600 text-sm block mt-1">{{ $message }}</span> @enderror

                <div class="flex items-center mt-4" x-show="!uploading && $wire.tempArtworkPath">
                    <button type="button" wire:click="$set('tempArtworkPath', null)"
                            class="text-sm text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Usuń grafikę
                    </button>
                </div>
            </div>
        </div>

        <!-- Prawa kolumna - podgląd obrazka -->
        <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden flex items-center justify-center">
            @if($tempArtworkPath)
    <div class="relative w-full h-full min-h-[200px] flex items-center justify-center">
        <img src="/storage/{{ $tempArtworkPath }}"
             alt="Podgląd grafiki"
             class="max-w-full max-h-[300px] object-contain p-4"
             onerror="this.onerror=null; this.src='/images/placeholder-image.png'; console.log('Błąd ładowania obrazka: ' + this.src);">


@else
    <div class="text-center p-8 text-gray-400 flex flex-col items-center">
        <svg class="w-16 h-16 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <p>Podgląd grafiki pojawi się tutaj</p>
    </div>
@endif
        </div>
    </div>
</div>

            <!-- Quantity and File Upload -->
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
            <!-- Price Display -->
@if($calculatedPrice > 0)
    <div class="bg-gradient-to-br from-orange-100 to-amber-100 border border-orange-300 rounded-xl p-6">
        <div class="flex justify-between items-center">
            <div>
                <h4 class="text-lg font-semibold text-orange-900">Szacowana cena:</h4>
                <p class="text-sm text-orange-700">
                    {{ $quantity }} szt. ×
                    {{ $quantity > 0 ? number_format($calculatedPrice / $quantity, 2) : '0.00' }} PLN
                </p>
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
