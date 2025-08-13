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
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="relative cursor-pointer group">
                        <input type="radio" wire:model.live="selectedShape" value="<?php echo e($shape->id); ?>" class="sr-only">
                        <div class="border-2 rounded-xl p-6 text-center transition-all duration-200 group-hover:shadow-xl group-hover:scale-105 bg-orange-50"
                             :class="$wire.selectedShape == <?php echo e($shape->id); ?> ? 'border-orange-500 bg-orange-100 shadow-lg transform scale-105' : 'border-gray-200 hover:border-gray-300'">
                            
                            <!--[if BLOCK]><![endif]--><?php if($shape->icon_path): ?>
                                <img src="<?php echo e(asset('storage/' . $shape->icon_path)); ?>" alt="<?php echo e($shape->name); ?>" class="w-16 h-16 mx-auto mb-4">
                            <?php else: ?>
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                                    <span class="text-orange-600 text-xl font-bold"><?php echo e(substr($shape->name, 0, 1)); ?></span>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            
                            <h4 class="font-semibold text-gray-900 mb-2"><?php echo e($shape->name); ?></h4>
                            <!--[if BLOCK]><![endif]--><?php if($shape->description): ?>
                                <p class="text-sm text-gray-500 leading-relaxed"><?php echo e($shape->description); ?></p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedShape'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-600 text-sm mt-2 text-center"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
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
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="relative cursor-pointer group">
                        <input type="radio" wire:model.live="selectedMaterial" value="<?php echo e($material->id); ?>" class="sr-only">
                        <div class="border-2 rounded-xl p-6 transition-all duration-200 group-hover:shadow-xl bg-orange-50"
                             :class="$wire.selectedMaterial == <?php echo e($material->id); ?> ? 'border-orange-500 bg-orange-100 shadow-lg' : 'border-gray-200 hover:border-gray-300'">
                            
                            <!--[if BLOCK]><![endif]--><?php if($material->texture_image_path): ?>
                                <div class="w-16 h-16 mx-auto mb-4 rounded-lg overflow-hidden">
                                    <img src="<?php echo e(asset('storage/' . $material->texture_image_path)); ?>" alt="<?php echo e($material->name); ?>" class="w-full h-full object-cover">
                                </div>
                            <?php else: ?>
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                                    <span class="text-orange-600 text-sm font-bold"><?php echo e(substr($material->name, 0, 2)); ?></span>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            
                            <h4 class="font-semibold text-gray-900 mb-2"><?php echo e($material->name); ?></h4>
                            
                            <!--[if BLOCK]><![endif]--><?php if($material->description): ?>
                                <p class="text-sm text-gray-500 mb-3"><?php echo e($material->description); ?></p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            
                            <div class="text-sm font-semibold text-orange-600">
                                <?php echo e(number_format($material->price_per_cm2, 2)); ?> PLN/cm²
                            </div>
                        </div>
                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedMaterial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-600 text-sm mt-2 text-center"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
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

                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $laminateOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laminate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="relative cursor-pointer group">
                            <input type="radio" wire:model.live="selectedLaminate" value="<?php echo e($laminate->id); ?>" class="sr-only">
                            <div class="border-2 rounded-xl p-6 text-center transition-all duration-200 group-hover:shadow-xl bg-orange-50"
                                 :class="$wire.selectedLaminate == <?php echo e($laminate->id); ?> ? 'border-orange-500 bg-orange-100 shadow-lg' : 'border-gray-200 hover:border-gray-300'">
                                
                                <div class="w-12 h-12 mx-auto mb-3 bg-gradient-to-br from-orange-100 to-orange-200 rounded-full flex items-center justify-center">
                                    <span class="text-orange-600 text-sm font-medium"><?php echo e(strtoupper(substr($laminate->finish_type ?? 'L', 0, 1))); ?></span>
                                </div>
                                
                                <h4 class="font-medium text-gray-900 mb-1"><?php echo e($laminate->name); ?></h4>
                                
                                <!--[if BLOCK]><![endif]--><?php if($laminate->description): ?>
                                    <p class="text-sm text-gray-500 mb-2"><?php echo e($laminate->description); ?></p>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                
                                <div class="text-sm font-semibold text-orange-600">
                                    +<?php echo e(number_format(($laminate->price_multiplier - 1) * 100, 0)); ?>%
                                </div>
                            </div>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
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
                <!--[if BLOCK]><![endif]--><?php if(!$useCustomSize && count($availableSizes) > 0): ?>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $availableSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="relative cursor-pointer group">
                                <input type="radio" wire:model.live="selectedSize" value="<?php echo e($size->id); ?>" class="sr-only">
                                <div class="border-2 rounded-xl p-4 text-center transition-all duration-200 group-hover:shadow-md bg-orange-50"
                                     :class="$wire.selectedSize == <?php echo e($size->id); ?> ? 'border-orange-500 bg-orange-100 shadow-lg' : 'border-gray-200 hover:border-gray-300'">
                                    <h4 class="font-medium text-gray-900 mb-1"><?php echo e($size->name); ?></h4>
                                    <p class="text-xs text-gray-400 mt-1"><?php echo e(number_format($size->getAreaCm2(), 1)); ?> cm²</p>
                                </div>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedSize'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!-- Custom Size Inputs -->
                <!--[if BLOCK]><![endif]--><?php if($useCustomSize): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-lg mx-auto">
                        <div>
                            <label for="customWidth" class="block text-sm font-medium text-gray-700 mb-2">
                                Szerokość (mm)
                            </label>
                            <input type="number" wire:model.live="customWidth" id="customWidth" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                   placeholder="np. 100" min="10" max="500">
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['customWidth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        
                        <div>
                            <label for="customHeight" class="block text-sm font-medium text-gray-700 mb-2">
                                Wysokość (mm)
                            </label>
                            <input type="number" wire:model.live="customHeight" id="customHeight"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                   placeholder="np. 60" min="10" max="500">
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['customHeight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>

                    <!--[if BLOCK]><![endif]--><?php if($customWidth && $customHeight): ?>
                        <div class="mt-4 p-4 bg-orange-50 rounded-xl text-center">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-orange-600">Powierzchnia: <?php echo e(number_format(($customWidth * $customHeight) / 100, 1)); ?> cm²</span>
                            </p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <?php if(!$useCustomSize && count($availableSizes) === 0 && $selectedShape): ?>
                    <div class="text-center py-8 text-gray-500 bg-orange-50 rounded-xl">
                        <p class="mb-2">Brak dostępnych standardowych rozmiarów dla wybranego kształtu.</p>
                        <p class="text-sm">Przejdź na rozmiar niestandardowy powyżej.</p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
                    <!--[if BLOCK]><![endif]--><?php if($selectedShape): ?>
                        <div class="flex justify-between py-2 border-b border-orange-200">
                            <span class="text-gray-600 font-medium">Kształt:</span>
                            <span class="font-semibold text-gray-900"><?php echo e($shapes->find($selectedShape)->name ?? 'Nie wybrano'); ?></span>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    
                    <!--[if BLOCK]><![endif]--><?php if($selectedMaterial): ?>
                        <div class="flex justify-between py-2 border-b border-orange-200">
                            <span class="text-gray-600 font-medium">Materiał:</span>
                            <span class="font-semibold text-gray-900"><?php echo e($materials->find($selectedMaterial)->name ?? 'Nie wybrano'); ?></span>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    
                    <div class="flex justify-between py-2 border-b border-orange-200">
                        <span class="text-gray-600 font-medium">Laminat:</span>
                        <span class="font-semibold text-gray-900">
                            <!--[if BLOCK]><![endif]--><?php if($selectedLaminate): ?>
                                <?php echo e($laminateOptions->find($selectedLaminate)->name); ?>

                            <?php else: ?>
                                Bez laminatu
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </span>
                    </div>
                    
                    <div class="flex justify-between py-2 border-b border-orange-200">
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
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                
                <div class="space-y-4">
                    <label for="artworkFile" class="block text-sm font-semibold text-gray-700">
                        Plik graficzny (opcjonalnie)
                    </label>
                    <input type="file" wire:model="artworkFile" id="artworkFile" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                           accept=".jpg,.jpeg,.png,.svg,.pdf">
                    <p class="text-xs text-gray-500">JPG, PNG, SVG, PDF - max 10MB</p>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['artworkFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <!-- Price Display -->
            <!--[if BLOCK]><![endif]--><?php if($calculatedPrice > 0): ?>
                <div class="bg-gradient-to-br from-orange-100 to-amber-100 border border-orange-300 rounded-xl p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-lg font-semibold text-orange-900">Szacowana cena:</h4>
                            <p class="text-sm text-orange-700"><?php echo e($quantity); ?> szt. × <?php echo e(number_format($calculatedPrice / $quantity, 2)); ?> PLN</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-orange-900"><?php echo e(number_format($calculatedPrice, 2)); ?> PLN</div>
                            <p class="text-orange-700 text-sm">brutto (zawiera 23% VAT)</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
        <!--[if BLOCK]><![endif]--><?php if(config('app.debug')): ?>
            <div class="mt-8 p-4 bg-gray-100 rounded-xl text-sm text-gray-600">
                <h5 class="font-semibold mb-2">Debug Info:</h5>
                <div class="space-y-1">
                    <div>Kształt: <?php echo e($selectedShape ? 'ID: ' . $selectedShape : 'Nie wybrano'); ?></div>
                    <div>Materiał: <?php echo e($selectedMaterial ? 'ID: ' . $selectedMaterial : 'Nie wybrano'); ?></div>
                    <div>Rozmiar custom: <?php echo e($useCustomSize ? 'TAK' : 'NIE'); ?></div>
                    <!--[if BLOCK]><![endif]--><?php if($useCustomSize): ?>
                        <div>Wymiary: <?php echo e($customWidth); ?>mm x <?php echo e($customHeight); ?>mm</div>
                    <?php else: ?>
                        <div>Wybrany rozmiar: <?php echo e($selectedSize ? 'ID: ' . $selectedSize : 'Nie wybrano'); ?></div>
                        <div>Dostępne rozmiary: <?php echo e($availableSizes->count()); ?></div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <div>Ilość: <?php echo e($quantity); ?></div>
                    <div>Konfiguracja valid: <?php echo e($isConfigurationValid ? 'TAK' : 'NIE'); ?></div>
                    <div>Cena: <?php echo e(number_format($calculatedPrice, 2)); ?> PLN</div>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </form>
</div><?php /**PATH C:\dev\custom-label\resources\views/livewire/label-creator.blade.php ENDPATH**/ ?>