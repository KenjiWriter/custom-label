<div> <!-- Zewnętrzny div -->
    <div class="h-1 bg-gradient-to-r from-transparent via-orange-200 to-transparent my-25"></div>
    <div data-creator-section x-data="{
        currentStep: 1,
        totalSteps: 4,
        nextStep() {
            if (this.currentStep < this.totalSteps) {
                this.currentStep++;
                // Emit event for animation handling
                window.dispatchEvent(new CustomEvent('stepChanged', { detail: { step: this.currentStep } }));
            }
        },
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                // Emit event for animation handling
                window.dispatchEvent(new CustomEvent('stepChanged', { detail: { step: this.currentStep } }));
            }
        }
    }" class="space-y-8" id="label-creator">

        <!-- Poprawiony pasek postępu - usunięte przekreślenia -->
        <div class="relative mb-12">
            <div class="flex items-center justify-between">
                <template x-for="step in totalSteps" :key="step">
                    <div class="flex-1 flex items-center"
                        :class="step === 1 ? 'justify-start' : (step === totalSteps ? 'justify-end' : 'justify-center')">
                        <div class="relative">
                            <div class="flex items-center relative z-10">
                                <div class="border-2 border-orange-600 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300"
                                    :class="currentStep >= step ?
                                        'bg-orange-600 text-white' :
                                        >
                                    <span class="text-sm font-semibold" x-text="step"></span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium transition-colors"
                                        :class="currentStep >= step ? 'text-orange-600 border-b-2 border-orange-600 pb-1' :
                                            'text-gray-500'">
                                        <span x-show="step === 1">Wybierz kształt</span>
                                        <span x-show="step === 2">Wybierz materiał</span>
                                        <span x-show="step === 3">Wybierz rozmiar</span>
                                        <span x-show="step === 4">Finalizacja</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <form class="space-y-8">
            <!-- Step 1: Choose Shape -->
            <div x-show="currentStep === 1"
                x-transition:enter="transition ease-out duration-300 transform step-enter-right"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8"
                class="space-y-8 step-1">

                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Wybierz kształt etykiety</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Wybierz kształt, który najlepiej pasuje do Twojego produktu. Każdy kształt ma swoje unikalne
                        zastosowania.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model.live="selectedShape" value="<?php echo e($shape->id); ?>"
                                class="sr-only peer">
                            <div
                                class="flex flex-col items-center p-4 border-2 rounded-xl transition-all duration-200 bg-white shadow-sm hover:shadow-md peer-checked:border-orange-600 peer-checked:shadow-lg peer-checked:bg-orange-50">
                                <div class="bg-orange-100 p-3 rounded-full mb-3">
                                    <!--[if BLOCK]><![endif]--><?php if($shape->slug == 'circle'): ?>
                                        <div class="w-12 h-12 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                                                <circle cx="12" cy="12" r="10"/>
                                            </svg>
                                        </div>
                                    <?php elseif($shape->slug == 'rectangle'): ?>
                                        <div class="w-12 h-12 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                                                <rect x="3" y="6" width="18" height="12" rx="2"/>
                                            </svg>
                                        </div>
                                    <?php elseif($shape->slug == 'square'): ?>
                                        <div class="w-12 h-12 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            </svg>
                                        </div>
                                    <?php elseif($shape->slug == 'oval'): ?>
                                        <div class="w-12 h-12 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                                                <ellipse cx="12" cy="12" rx="9" ry="6"/>
                                            </svg>
                                        </div>
                                    <?php elseif($shape->slug == 'star'): ?>
                                        <div class="w-12 h-12 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                        </div>
                                    <?php else: ?>
                                        <div class="w-12 h-12 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <span class="font-medium text-gray-900 text-sm"><?php echo e($shape->name); ?></span>
                                <p class="mt-1 text-xs text-gray-500"><?php echo e(Str::limit($shape->description, 60)); ?></p>
                            </div>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="flex justify-center">
                    <button type="button"
                        class="border-2 border-orange-600 px-8 py-3 font-semibold rounded-xl transition-all duration-200 <?php echo e($selectedShape ? 'bg-orange-600 text-orange-600 shadow-lg hover:bg-orange-700' : 'bg-gray-300 text-orange-600 cursor-not-allowed'); ?>"
                        @click="nextStep()" :disabled="!<?php echo e($selectedShape ? 'true' : 'false'); ?>">
                        Dalej
                    </button>
                </div>
            </div>

            <!-- Step 2: Choose Material -->
            <div x-show="currentStep === 2"
                x-transition:enter="transition ease-out duration-300 transform step-enter-right"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8"
                class="space-y-8 step-2">

                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Wybierz materiał</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Każdy materiał ma inne właściwości i zastosowania. Wybierz ten, który najlepiej sprawdzi się w
                        Twoim przypadku.
                    </p>
                </div>

                <!-- Poprawione karty materiałów z lepszymi ikonami -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="relative cursor-pointer">
                            <input type="radio" wire:model.live="selectedMaterial" value="<?php echo e($material->id); ?>"
                                class="sr-only peer">
                            <div
                                class="flex flex-col h-full p-4 border-2 rounded-xl transition-all duration-200 bg-white shadow-sm hover:shadow-md peer-checked:border-orange-600 peer-checked:shadow-lg peer-checked:bg-orange-50">
                                <div
                                    class="flex-shrink-0 mb-3 h-20 overflow-hidden rounded-lg flex items-center justify-center">
                                    <!--[if BLOCK]><![endif]--><?php if($material->image_path): ?>
                                        <img src="<?php echo e(asset($material->image_path)); ?>" alt="<?php echo e($material->name); ?>"
                                            class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <!--[if BLOCK]><![endif]--><?php if(str_contains($material->slug, 'white-matte') || str_contains($material->slug, 'bialy-matowy')): ?>
                                            <div
                                                class="w-full h-full rounded-md flex items-center justify-center relative overflow-hidden">
                                                <!-- Gradient tła dla papieru matowego - delikatny, bez połysku -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-white via-gray-50 to-gray-100">
                                                </div>
                                                <!-- Subtelna tekstura matowa -->
                                                <div class="absolute inset-0 opacity-10"
                                                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHJlY3Qgd2lkdGg9IjIwIiBoZWlnaHQ9IjIwIiBmaWxsPSIjZjBmMGYwIj48L3JlY3Q+PHBhdGggZD0iTTAgMEwxMCAxME0xMCAwTDAgMTAiIHN0cm9rZT0iI2U4ZThlOCIgc3Ryb2tlLXdpZHRoPSIxIj48L3BhdGg+PC9zdmc+');">
                                                </div>
                                                <!-- Brak efektu połysku -->
                                                <span class="relative z-10 font-medium text-gray-400">PAPIER BIAŁY
                                                    MATOWY</span>
                                            </div>
                                        <?php elseif(str_contains($material->slug, 'white-glossy') || str_contains($material->slug, 'bialy-blysk')): ?>
                                            <div
                                                class="w-full h-full rounded-md flex items-center justify-center relative overflow-hidden">
                                                <!-- Jaśniejszy gradient dla papieru błyszczącego z niebieskim odcieniem -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-white via-blue-50 to-blue-100">
                                                </div>
                                                <!-- Efekt połysku jak w folii -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-tl from-transparent via-white to-transparent opacity-70 animate-pulse">
                                                </div>
                                                <!-- Przesuwający się efekt błysku -->
                                                <div class="absolute -inset-full w-[400%] h-[200%]"
                                                    style="background: linear-gradient(115deg, transparent 20%, rgba(255,255,255,0.9) 40%, transparent 60%); transform: rotate(25deg); animation: shine 3s linear infinite;">
                                                </div>
                                                <!-- Efekt refleksów światła -->
                                                <div
                                                    class="absolute top-1/3 left-1/4 w-8 h-8 bg-white rounded-full opacity-80 blur-sm">
                                                </div>
                                                <div
                                                    class="absolute bottom-1/4 right-1/3 w-6 h-6 bg-white rounded-full opacity-70 blur-sm">
                                                </div>
                                                <span class="relative z-10 font-medium text-gray-400">PAPIER BIAŁY
                                                    BŁYSZCZĄCY</span>
                                            </div>
                                        <?php elseif(str_contains($material->slug, 'kraft') || str_contains($material->slug, 'kraft')): ?>
                                            <div class="w-full h-full rounded-md flex items-center justify-center"
                                                style="background-color: #d4b996;">
                                                <div class="w-full h-full flex items-center justify-center"
                                                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZDRiOTk2Ij48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9IiNjM2E0ODIiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4=');">
                                                    <span class="text-white font-medium shadow-sm">PAPIER KRAFT</span>
                                                </div>
                                            </div>
                                        <?php elseif(str_contains($material->slug, 'gold') || str_contains($material->slug, 'zlot')): ?>
                                            <div
                                                class="w-full h-full rounded-md flex items-center justify-center relative overflow-hidden">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-yellow-300 via-yellow-500 to-amber-600">
                                                </div>
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-tl from-transparent via-yellow-200 to-transparent opacity-70 animate-pulse">
                                                </div>
                                                <span class="relative z-10 font-medium text-white drop-shadow-md">FOLIA
                                                    ZŁOTA</span>
                                            </div>
                                        <?php elseif(str_contains($material->slug, 'silver') || str_contains($material->slug, 'srebr')): ?>
                                            <div
                                                class="w-full h-full rounded-md flex items-center justify-center relative overflow-hidden">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-gray-200 via-gray-400 to-gray-500">
                                                </div>
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-tl from-transparent via-white to-transparent opacity-70">
                                                </div>
                                                <span class="relative z-10 font-medium text-white drop-shadow-md">FOLIA
                                                    SREBRNA</span>
                                            </div>
                                        <?php elseif(str_contains($material->slug, 'waterproof') || str_contains($material->slug, 'wodoodporn')): ?>
                                            <div
                                                class="w-full h-full bg-blue-50 rounded-md flex items-center justify-center relative overflow-hidden border border-blue-200">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-b from-white via-blue-50 to-blue-100 opacity-80">
                                                </div>
                                                <div class="absolute top-0 left-0 right-0 h-2 bg-blue-400 opacity-30">
                                                </div>
                                                <div
                                                    class="w-full h-full flex flex-col items-center justify-center relative z-10">
                                                    <svg class="w-8 h-8 text-blue-500 mb-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5" d="M12 14l-9-5 9-5 9 5-9 5z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5" d="M12 14v10"></path>
                                                    </svg>
                                                    <span class="text-xs font-medium text-blue-700">PAPIER
                                                        WODOODPORNY</span>
                                                </div>
                                            </div>
                                        <?php elseif(str_contains($material->slug, 'transparent') || str_contains($material->slug, 'przezroczyst')): ?>
                                            <div
                                                class="w-full h-full rounded-md flex items-center justify-center relative overflow-hidden border border-gray-200">
                                                <div class="absolute inset-0 bg-white bg-opacity-30 backdrop-blur-sm">
                                                </div>
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-tl from-transparent via-white to-transparent opacity-40">
                                                </div>
                                                <div
                                                    class="w-3/4 h-1/2 border border-dashed border-gray-300 rounded flex items-center justify-center bg-transparent relative z-10">
                                                    <span class="text-xs font-medium text-gray-500">FOLIA
                                                        PRZEZROCZYSTA</span>
                                                </div>
                                            </div>
                                        <?php elseif(str_contains($material->slug, 'white') || str_contains($material->slug, 'biala')): ?>
                                            <div
                                                class="w-full h-full rounded-md flex items-center justify-center relative overflow-hidden">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-white via-gray-50 to-gray-200">
                                                </div>
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-tl from-transparent via-white to-transparent opacity-70 animate-pulse">
                                                </div>
                                                <div class="absolute -inset-full w-[400%] h-[200%]"
                                                    style="background: linear-gradient(115deg, transparent 20%, rgba(255,255,255,0.9) 40%, transparent 60%); transform: rotate(25deg); animation: shine 3s linear infinite;">
                                                </div>
                                                <span class="relative z-10 font-medium text-gray-400">FOLIA
                                                    BIAŁA</span>
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="w-full h-full bg-gray-100 rounded-md flex items-center justify-center">
                                                <svg class="w-10 h-10 text-orange-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                    </path>
                                                </svg>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div class="flex-grow space-y-1">
                                    <span class="font-medium text-gray-900"><?php echo e($material->name); ?></span>
                                    <p class="text-sm text-gray-500"><?php echo e(Str::limit($material->description, 80)); ?></p>
                                </div>

                                <div class="mt-3 flex items-center justify-between">
                                    <div class="text-sm text-orange-600 font-medium">
                                        <?php echo e(number_format($material->price_per_cm2 * 100, 2)); ?> zł / 100 cm²
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php if($material->is_waterproof): ?>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            Wodoodporny
                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="flex justify-between">
                    <button type="button"
                        class="px-8 py-3 font-semibold rounded-xl bg-gray-200 text-gray-700 transition-all duration-200 hover:bg-gray-300"
                        @click="prevStep()">
                        Wstecz
                    </button>

                    <button type="button"
                        class="px-8 py-3 font-semibold rounded-xl transition-all duration-200 <?php echo e($selectedMaterial ? 'bg-orange-600 text-white shadow-lg hover:bg-orange-700' : 'bg-gray-300 text-gray-600 cursor-not-allowed'); ?>"
                        @click="nextStep()" :disabled="!<?php echo e($selectedMaterial ? 'true' : 'false'); ?>">
                        Dalej
                    </button>
                </div>
            </div>

            <!-- Step 3: Choose Size -->
            <div x-show="currentStep === 3"
                x-transition:enter="transition ease-out duration-300 transform step-enter-right"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-8"
                class="space-y-8 step-3">

                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Wybierz rozmiar</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Wybierz jeden z dostępnych standardowych rozmiarów lub podaj własne wymiary.
                    </p>
                </div>

                <!-- Size Type Tabs -->
                <div class="flex justify-center bg-gray-100 rounded-xl overflow-hidden p-1 max-w-md mx-auto">
                    <button type="button" wire:click="setCustomSize(false)"
                        class="py-3 px-6 rounded-xl text-center font-medium transition-all duration-200 flex-1 <?php echo e(!$useCustomSize ? 'bg-white shadow' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        Standardowe rozmiary
                    </button>
                    <button type="button" wire:click="setCustomSize(true)"
                        class="py-3 px-6 rounded-xl text-center font-medium transition-all duration-200 flex-1 <?php echo e($useCustomSize ? 'bg-white shadow' : 'text-gray-600 hover:bg-gray-50'); ?>">
                        Własne wymiary
                    </button>
                </div>

                <!-- Custom Size Form -->
                <div x-show="<?php echo e($useCustomSize ? 'true' : 'false'); ?>" class="max-w-md mx-auto">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
                        <h4 class="font-semibold text-gray-900 mb-4">Podaj własne wymiary</h4>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Szerokość (mm)</label>
                                <div class="relative">
                                    <input type="number" wire:model.blur="customWidth"
                                        class="w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-colors"
                                        min="10" max="500" step="1">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500">mm</span>
                                    </div>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['customWidth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-red-600 text-sm"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Wysokość (mm)</label>
                                <div class="relative">
                                    <input type="number" wire:model.blur="customHeight"
                                        class="w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50 transition-colors"
                                        min="10" max="500" step="1">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500">mm</span>
                                    </div>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['customHeight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-red-600 text-sm"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <div class="mt-4 text-sm text-gray-500">
                            <p>Minimalne wymiary: 10mm × 10mm</p>
                            <p>Maksymalne wymiary: 500mm × 500mm</p>
                        </div>
                    </div>
                </div>

                <!-- Predefined Sizes -->
                <div x-show="!<?php echo e($useCustomSize ? 'true' : 'false'); ?>" class="max-w-4xl mx-auto">
                    <!--[if BLOCK]><![endif]--><?php if(count($availableSizes) > 0): ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $availableSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="relative cursor-pointer">
                                    <input type="radio" wire:model.live="selectedSize" value="<?php echo e($size->id); ?>"
                                        class="sr-only peer">
                                    <div
                                        class="p-4 border-2 rounded-xl transition-all duration-200 bg-white shadow-sm hover:shadow-md peer-checked:border-orange-600 peer-checked:shadow-lg peer-checked:bg-orange-50 h-full">
                                        <div class="font-semibold text-gray-900 mb-1"><?php echo e($size->name); ?></div>
                                        <div class="text-sm text-gray-500 mb-2"><?php echo e($size->width_mm); ?> ×
                                            <?php echo e($size->height_mm); ?> mm</div>

                                        <div class="relative h-20 bg-gray-100 rounded-lg overflow-hidden">
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div style="width: <?php echo e(min(80, $size->width_mm / 2)); ?>px; height: <?php echo e(min(60, $size->height_mm / 2)); ?>px;"
                                                    class="bg-orange-300 rounded shadow-sm"></div>
                                            </div>
                                            <div class="absolute bottom-1 right-2 text-xs text-gray-500">
                                                <?php echo e($size->width_mm); ?>×<?php echo e($size->height_mm); ?>mm
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500 bg-orange-50 rounded-xl">
                            <p class="mb-2">Brak dostępnych standardowych rozmiarów dla wybranego kształtu.</p>
                            <p class="text-sm">Przejdź na rozmiar niestandardowy powyżej.</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- Laminat - poprawiony na mniejsze karty bez paska przewijania -->
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-900 text-lg text-center">Wybierz laminat (opcjonalnie)</h4>
                    <p class="text-gray-500 text-sm text-center max-w-2xl mx-auto">
                        Laminat zwiększa trwałość etykiety i chroni przed wilgocią, promieniowaniem UV oraz
                        uszkodzeniami mechanicznymi.
                    </p>

                    <div class="flex flex-wrap justify-center gap-4 pb-2">
                        <!-- Opcja bez laminatu -->
                        <label class="relative cursor-pointer flex-shrink-0"
                            style="min-width: 170px; max-width: 200px;">
                            <input type="radio" wire:model.live="selectedLaminate" value=""
                                class="sr-only peer">
                            <div class="p-3 border-2 rounded-xl transition-all duration-200 bg-white shadow-sm hover:shadow-md peer-checked:border-orange-600 peer-checked:shadow-lg peer-checked:bg-orange-50 h-full flex flex-col"
                                style="min-height: 160px;">
                                <div class="flex-shrink-0 mb-2 h-14 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>

                                <div class="flex-grow">
                                    <div class="font-medium text-gray-900 mb-1 text-sm">Bez laminatu</div>
                                    <p class="text-xs text-gray-500">Standardowe wykończenie bez dodatkowej ochrony.
                                    </p>
                                </div>

                                <div class="mt-2 text-center">
                                    <span class="text-xs font-medium text-gray-500">Bez dopłaty</span>
                                </div>
                            </div>
                        </label>

                        <!-- Opcje laminatu -->
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $laminateOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="relative cursor-pointer flex-shrink-0"
                                style="min-width: 170px; max-width: 200px;">
                                <input type="radio" wire:model.live="selectedLaminate" value="<?php echo e($option->id); ?>"
                                    class="sr-only peer">
                                <div class="p-3 border-2 rounded-xl transition-all duration-200 bg-white shadow-sm hover:shadow-md peer-checked:border-orange-600 peer-checked:shadow-lg peer-checked:bg-orange-50 h-full flex flex-col"
                                    style="min-height: 160px;">
                                    <div class="flex-shrink-0 mb-2 h-14 overflow-hidden rounded-lg relative">
                                        <!--[if BLOCK]><![endif]--><?php if($option->texture_image_path): ?>
                                            <img src="<?php echo e(asset($option->texture_image_path)); ?>"
                                                alt="<?php echo e($option->name); ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <!-- Dynamiczne ikony dla różnych typów laminatu -->
                                            <!--[if BLOCK]><![endif]--><?php if(str_contains($option->slug, 'matte') || str_contains($option->slug, 'mat')): ?>
                                                <div
                                                    class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative">
                                                    <div
                                                        class="absolute top-2 left-2 w-8 h-8 bg-white rounded-full opacity-25">
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-800">MAT</span>
                                                </div>
                                            <?php elseif(str_contains($option->slug, 'glossy') || str_contains($option->slug, 'blysk')): ?>
                                                <div
                                                    class="w-full h-full bg-gradient-to-br from-white to-blue-50 flex items-center justify-center relative overflow-hidden">
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-tl from-transparent via-white to-transparent opacity-70">
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-800 z-10">POŁYSK</span>
                                                </div>
                                            <?php elseif(str_contains($option->slug, 'soft-touch') || str_contains($option->slug, 'soft')): ?>
                                                <div
                                                    class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center relative">
                                                    <div class="absolute inset-0 bg-black opacity-5 filter blur-sm">
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-800">SOFT</span>
                                                </div>
                                            <?php else: ?>
                                                <div
                                                    class="w-full h-full bg-gray-100 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                        <div class="absolute bottom-1 right-1 bg-blue-500 rounded-full p-1 shadow-sm">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="flex-grow">
                                        <div class="font-medium text-gray-900 mb-1 text-sm"><?php echo e($option->name); ?></div>
                                        <p class="text-xs text-gray-500"><?php echo e(Str::limit($option->description, 50)); ?>

                                        </p>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <span
                                            class="text-xs font-medium text-orange-600">+<?php echo e(number_format(($option->price_multiplier - 1) * 100, 0)); ?>%</span>
                                    </div>
                                </div>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <!-- Przyciski Wstecz/Dalej w sekcji rozmiaru -->
                <div class="flex justify-between">
                    <button type="button"
                        class="px-8 py-3 font-semibold rounded-xl bg-gray-200 text-gray-700 transition-all duration-200 hover:bg-gray-300"
                        @click="prevStep()">
                        Wstecz
                    </button>

                    <button type="button"
                        class="px-8 py-3 font-semibold rounded-xl transition-all duration-200 <?php echo e(($useCustomSize && $customWidth && $customHeight) || (!$useCustomSize && $selectedSize) ? 'bg-orange-600 text-white shadow-lg hover:bg-orange-700' : 'bg-gray-300 text-gray-600 cursor-not-allowed'); ?>"
                        @click="nextStep()"
                        :disabled="!(
                            <?php echo e(($useCustomSize && $customWidth && $customHeight) || (!$useCustomSize && $selectedSize) ? 'true' : 'false'); ?>)">
                        Dalej
                    </button>
                </div>
            </div>

            <!-- Step 4: Final Configuration -->
            <div x-show="currentStep === 4"
                x-transition:enter="transition ease-out duration-300 transform step-enter-right"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                class="space-y-8 step-4">

                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Finalizacja zamówienia</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Sprawdź konfigurację, wybierz ilość i opcjonalnie prześlij plik graficzny.
                    </p>
                </div>

                <!-- Configuration Summary -->
                <div
                    class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-6 border border-orange-200 transform transition-all duration-500 hover:shadow-xl">
                    <h4 class="font-bold text-gray-900 mb-4 text-lg">Podsumowanie konfiguracji</h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <!--[if BLOCK]><![endif]--><?php if($selectedShape): ?>
                            <div
                                class="flex justify-between py-2 border-b border-orange-200 hover:bg-orange-100/30 transition-colors duration-200 rounded px-2">
                                <span class="text-gray-600 font-medium">Kształt:</span>
                                <span
                                    class="font-semibold text-gray-900"><?php echo e($shapes->find($selectedShape)->name ?? 'Nie wybrano'); ?></span>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <!--[if BLOCK]><![endif]--><?php if($selectedMaterial): ?>
                            <div
                                class="flex justify-between py-2 border-b border-orange-200 hover:bg-orange-100/30 transition-colors duration-200 rounded px-2">
                                <span class="text-gray-600 font-medium">Materiał:</span>
                                <span
                                    class="font-semibold text-gray-900"><?php echo e($materials->find($selectedMaterial)->name ?? 'Nie wybrano'); ?></span>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <div
                            class="flex justify-between py-2 border-b border-orange-200 hover:bg-orange-100/30 transition-colors duration-200 rounded px-2">
                            <span class="text-gray-600 font-medium">Rozmiar:</span>
                            <span class="font-semibold text-gray-900">
                                <?php if($useCustomSize && $customWidth && $customHeight): ?>
                                    <?php echo e($customWidth); ?>mm × <?php echo e($customHeight); ?>mm
                                <?php elseif($selectedSize && count($availableSizes) > 0): ?>
                                    <?php echo e($availableSizes->find($selectedSize)->name ?? 'Nie wybrano'); ?>

                                <?php else: ?>
                                    Nie wybrano
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </span>
                        </div>

                        <div
                            class="flex justify-between py-2 border-b border-orange-200 hover:bg-orange-100/30 transition-colors duration-200 rounded px-2">
                            <span class="text-gray-600 font-medium">Laminat:</span>
                            <span class="font-semibold text-gray-900">
                                <!--[if BLOCK]><![endif]--><?php if($selectedLaminate): ?>
                                    <?php echo e($laminateOptions->find($selectedLaminate)->name ?? 'Bez laminatu'); ?>

                                <?php else: ?>
                                    Bez laminatu
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h4 class="text-lg font-semibold text-gray-900 border-b border-orange-200 pb-2">Grafika</h4>

                    <!-- Grid layout z plikiem po lewej i podglądem po prawej -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Lewa kolumna - wybór pliku -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Plik graficzny
                                    (opcjonalnie)</label>
                                <div
                                    class="bg-white border border-gray-300 border-dashed rounded-xl p-6 flex flex-col items-center justify-center text-center">
                                    <label class="w-full cursor-pointer">
                                        <div class="space-y-4">
                                            <div
                                                class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-orange-100 text-orange-600">
                                                <svg class="h-10 w-10" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium text-orange-600">Kliknij aby wybrać
                                                        plik</span> lub przeciągnij i upuść
                                                </p>
                                                <p class="mt-1 text-xs text-gray-500">
                                                    PNG, JPG, GIF do 10MB
                                                </p>
                                            </div>
                                        </div>
                                        <input type="file" wire:model="artworkFile" class="hidden">
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ilość</label>
                                <div class="flex items-center">
                                    <button type="button"
                                        wire:click="$set('quantity', Math.max(1, <?php echo e($quantity); ?> - 10))"
                                        class="p-2 rounded-l-lg bg-orange-100 text-orange-600 border border-r-0 border-orange-200 hover:bg-orange-200 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" wire:model.blur="quantity" min="1" max="10000"
                                        class="w-24 text-center py-2 border-y border-orange-200">
                                    <button type="button" wire:click="$set('quantity', <?php echo e($quantity); ?> + 10)"
                                        class="p-2 rounded-r-lg bg-orange-100 text-orange-600 border border-l-0 border-orange-200 hover:bg-orange-200 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <span class="ml-2 text-gray-600">sztuk</span>
                                </div>
                            </div>
                        </div>

                        <!-- Prawa kolumna - podgląd obrazka (tylko wybór, bez pozycjonowania) -->
                        <div
                            class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden flex items-center justify-center shadow-inner transform transition-all duration-300 hover:shadow-lg relative h-[300px]">
                            <div class="relative w-full h-full min-h-[200px] flex items-center justify-center">
                                <div class="absolute inset-0 bg-checkerboard flex items-center justify-center">
                                    <!-- Wyświetlanie kształtu etykiety w zależności od wyboru użytkownika -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <?php
                                            $shape = $shapes->firstWhere('id', $selectedShape);
                                            $shapeType = $shape ? $shape->slug : 'rectangle';
                                            $material = $materials->firstWhere('id', $selectedMaterial);
                                            $materialSlug = $material ? $material->slug : '';

                                            // Określenie wymiarów
                                            if ($useCustomSize) {
                                                $width = $customWidth;
                                                $height = $customHeight;
                                            } else {
                                                $size = $availableSizes->firstWhere('id', $selectedSize);
                                                $width = $size ? $size->width_mm : 50;
                                                $height = $size ? $size->height_mm : 50;
                                            }

                                            // Skalowanie do proporcji ekranu (max 80% kontenera)
                                            $containerSize = 240; // 80% z 300px
                                            $scale =
                                                $width > 0 && $height > 0
                                                    ? min($containerSize / $width, $containerSize / $height)
                                                    : 1; // Default scale if width or height is invalid
                                            $displayWidth = $width * $scale;
                                            $displayHeight = $height * $scale;

                                            // Dodanie klas dla materiałów
                                            $materialClass = '';

                                            if (
                                                str_contains($materialSlug, 'white-matte') ||
                                                str_contains($materialSlug, 'bialy-matowy')
                                            ) {
                                                $materialClass = 'bg-gray-50';
                                            } elseif (
                                                str_contains($materialSlug, 'white-glossy') ||
                                                str_contains($materialSlug, 'bialy-blysk')
                                            ) {
                                                $materialClass = 'bg-blue-50';
                                            } elseif (str_contains($materialSlug, 'kraft')) {
                                                $materialClass = 'bg-amber-100';
                                            } elseif (
                                                str_contains($materialSlug, 'gold') ||
                                                str_contains($materialSlug, 'zlot')
                                            ) {
                                                $materialClass =
                                                    'bg-gradient-to-br from-yellow-300 via-yellow-500 to-amber-600';
                                            } elseif (
                                                str_contains($materialSlug, 'silver') ||
                                                str_contains($materialSlug, 'srebr')
                                            ) {
                                                $materialClass =
                                                    'bg-gradient-to-br from-gray-200 via-gray-400 to-gray-500';
                                            } elseif (
                                                str_contains($materialSlug, 'white') ||
                                                str_contains($materialSlug, 'biala')
                                            ) {
                                                $materialClass = 'bg-white';
                                            } elseif (
                                                str_contains($materialSlug, 'transparent') ||
                                                str_contains($materialSlug, 'przezroczyst')
                                            ) {
                                                $materialClass =
                                                    'bg-white bg-opacity-30 border border-dashed border-gray-300';
                                            } elseif (
                                                str_contains($materialSlug, 'waterproof') ||
                                                str_contains($materialSlug, 'wodoodporn')
                                            ) {
                                                $materialClass = 'bg-blue-50';
                                            } else {
                                                $materialClass = 'bg-white';
                                            }
                                        ?>

                                        <!-- Kształt etykiety -->
                                        <!--[if BLOCK]><![endif]--><?php if($shapeType == 'circle'): ?>
                                            </div>
                                        <?php elseif($shapeType == 'oval'): ?>
                                            </div>
                                        <?php elseif($shapeType == 'square'): ?>
                                            </div>
                                        <?php elseif($shapeType == 'star'): ?>
                                            </div>
                                        <?php else: ?>
                                            <!-- Domyślny prostokąt -->
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <!-- Grafika nakładana na etykietę (tylko podgląd, bez pozycjonowania) -->
                                    <!--[if BLOCK]><![endif]--><?php if($tempArtworkPath): ?>
                                        <img src="/storage/<?php echo e($tempArtworkPath); ?>" alt="Podgląd grafiki"
                                            class="max-w-[80%] max-h-[80%] object-contain opacity-90"
                                            onerror="this.onerror=null; this.src='/images/placeholder-image.png';">
                                    <?php else: ?>
                                        <div class="text-center text-gray-500">
                                            <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-sm">Wybierz plik graficzny</p>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 text-center">
                            <div class="text-lg font-medium text-gray-700 mb-1">Całkowita cena</div>
                            <div class="text-3xl font-bold text-orange-600 mb-1">
                                <?php echo e(number_format($calculatedPrice, 2)); ?> zł</div>
                            <div class="text-sm text-gray-500">z VAT</div>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-4">
                            <button type="button"
                                class="w-full sm:w-auto px-8 py-3 font-semibold rounded-xl bg-gray-200 text-gray-700 transition-all duration-200 hover:bg-gray-300"
                                @click="prevStep()">
                                Wróć do rozmiarów
                            </button>

                            <!-- Final Submit Button -->
                            <button type="button" 
                                wire:click="goToPreview"
                                class="w-full sm:w-auto px-8 py-4 font-semibold rounded-xl transition-all duration-200 shadow-lg <?php echo e($isConfigurationValid ? 'bg-orange-600 text-white hover:bg-orange-700' : 'bg-gray-300 text-gray-600 cursor-not-allowed'); ?>"
                                <?php if(!$isConfigurationValid): ?> disabled <?php endif; ?>>
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="font-medium">Przejdź do podglądu 3D</span>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!--[if BLOCK]><![endif]--><?php if(config('app.debug')): ?>
                        <div class="mt-8 p-4 bg-gray-100 rounded-xl text-sm text-gray-600">
                            <h5 class="font-semibold mb-2">Debug Info:</h5>
                            <div class="space-y-1">
                                <div>Kształt: <?php echo e($selectedShape ? 'ID: ' . $selectedShape : 'Nie wybrano'); ?></div>
                                <div>Materiał: <?php echo e($selectedMaterial ? 'ID: ' . $selectedMaterial : 'Nie wybrano'); ?>

                                </div>
                                <div>Rozmiar custom: <?php echo e($useCustomSize ? 'TAK' : 'NIE'); ?></div>
                                <!--[if BLOCK]><![endif]--><?php if($useCustomSize): ?>
                                    <div>Wymiary: <?php echo e($customWidth); ?>mm x <?php echo e($customHeight); ?>mm</div>
                                <?php else: ?>
                                    <div>Wybrany rozmiar: <?php echo e($selectedSize ? 'ID: ' . $selectedSize : 'Nie wybrano'); ?>

                                    </div>
                                    <div>Dostępne rozmiary: <?php echo e($availableSizes->count()); ?></div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
        </form>

        <!-- SKRYPT OBSŁUGUJĄCY POWRÓT Z PODGLĄDU 3D -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Sprawdź czy mamy parametr returnToCreator w URL
                const urlParams = new URLSearchParams(window.location.search);
                const returnToCreator = urlParams.get('returnToCreator') === 'true';

                if (returnToCreator) {
                    // Opóźnij wykonanie aby dać komponentowi Livewire czas na inicjalizację
                    setTimeout(() => {
                        // Wywołaj metodę Livewire do przywrócenia danych projektu
                        const component = window.Livewire.find(document.querySelector('[wire\\:id]')
                            .getAttribute('wire:id'));
                        component.call('restoreFromPreview');

                        // Zmień krok na 4 (finalizacja)
                        if (window.Alpine) {
                            const stepContainer = document.querySelector('[x-data]');
                            if (stepContainer && stepContainer.__x) {
                                stepContainer.__x.getUnobservedData().currentStep = 4;
                            }
                        }

                        // Przewiń do sekcji kreatora etykiet
                        const creatorSection = document.getElementById('label-creator');
                        if (creatorSection) {
                            // Płynne przewijanie do sekcji kreatora z małym opóźnieniem,
                            // aby dać czas na wyrenderowanie zawartości
                            setTimeout(() => {
                                creatorSection.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }, 300);
                        }
                    }, 300); // Zwiększono opóźnienie dla pewności załadowania komponentu
                }
            });
            
            
        </script>
    </div> <!-- Zamknięcie div data-creator-section -->
</div> <!-- Zamknięcie zewnętrznego div -->
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/livewire/label-creator.blade.php ENDPATH**/ ?>