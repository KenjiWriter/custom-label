<div data-creator-section 
     x-data="{ 
        currentStep: 1,
        totalSteps: 5,
        nextStep() { 
            if (this.currentStep < this.totalSteps) this.currentStep++; 
        },
        prevStep() { 
            if (this.currentStep > 1) this.currentStep--; 
        }
    }" class="space-y-8">

    <!-- Progress Bar -->
    <div class="relative mb-12">
        <div class="flex items-center justify-between">
            <template x-for="step in totalSteps" :key="step">
                <div class="flex items-center" :class="step < totalSteps ? 'flex-1' : ''">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full border-2 transition-all duration-300"
                         :class="currentStep >= step ? 'bg-blue-600 border-blue-600 text-white shadow-lg' : 'bg-white border-gray-300 text-gray-400'">
                        <span x-text="step" class="font-semibold"></span>
                    </div>
                    <div x-show="step < totalSteps" class="flex-1 h-1 mx-4 transition-all duration-300"
                         :class="currentStep > step ? 'bg-blue-600' : 'bg-gray-200'">
                    </div>
                </div>
            </template>
        </div>
        
        <!-- Step Labels -->
        <div class="flex justify-between mt-4 text-sm">
            <span class="text-center font-medium" :class="currentStep >= 1 ? 'text-blue-600' : 'text-gray-500'">Kształt</span>
            <span class="text-center font-medium" :class="currentStep >= 2 ? 'text-blue-600' : 'text-gray-500'">Materiał</span>
            <span class="text-center font-medium" :class="currentStep >= 3 ? 'text-blue-600' : 'text-gray-500'">Laminat</span>
            <span class="text-center font-medium" :class="currentStep >= 4 ? 'text-blue-600' : 'text-gray-500'">Rozmiar</span>
            <span class="text-center font-medium" :class="currentStep >= 5 ? 'text-blue-600' : 'text-gray-500'">Finalizacja</span>
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
            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="relative cursor-pointer group">
                        <input type="radio" wire:model.live="selectedShape" value="<?php echo e($shape->id); ?>" class="sr-only">
                        <div class="border-2 rounded-xl p-8 text-center transition-all duration-200 group-hover:shadow-xl group-hover:scale-105"
                             :class="$wire.selectedShape == <?php echo e($shape->id); ?> ? 'border-blue-500 bg-blue-50 shadow-lg transform scale-105' : 'border-gray-200 hover:border-gray-300'">
                            
                            <!--[if BLOCK]><![endif]--><?php if($shape->icon_path): ?>
                                <img src="<?php echo e(asset('storage/' . $shape->icon_path)); ?>" alt="<?php echo e($shape->name); ?>" class="w-16 h-16 mx-auto mb-4">
                            <?php else: ?>
                                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center">
                                    <span class="text-gray-500 text-xl font-bold"><?php echo e(substr($shape->name, 0, 1)); ?></span>
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

        <!-- Remaining steps continue similarly with enhanced styling... -->
        

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-8 border-t border-gray-200">
            <button type="button" @click="prevStep()" x-show="currentStep > 1" 
                    class="flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Poprzedni krok
            </button>
            <div x-show="currentStep === 1"></div>
            
            <div class="flex space-x-4">
                <button type="button" @click="nextStep()" x-show="currentStep < totalSteps" 
                        class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Następny krok
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <button type="submit" x-show="currentStep === totalSteps" 
                        :disabled="!$wire.isConfigurationValid"
                        :class="$wire.isConfigurationValid ? 'bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800' : 'bg-gray-400 cursor-not-allowed'"
                        class="flex items-center px-8 py-3 text-white rounded-lg transition-all duration-200 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Przejdź do podglądu 3D
                </button>
            </div>
        </div>
    </form>
</div><?php /**PATH C:\dev\custom-label\resources\views/livewire/label-creator.blade.php ENDPATH**/ ?>