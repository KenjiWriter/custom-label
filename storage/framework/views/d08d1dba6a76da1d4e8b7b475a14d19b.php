<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Secure Checkout']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Secure Checkout']); ?>
    <div class="min-h-screen bg-gray-50">

        <!-- Progress Bar -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center py-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                        <span class="ml-2 text-sm font-medium text-orange-600">Cart</span>
                    </div>
                    <div class="flex-1 h-1 bg-orange-600 mx-4"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                        <span class="ml-2 text-sm font-medium text-orange-600">Payment</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                        <span class="ml-2 text-sm font-medium text-gray-500">Confirmation</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Top Banner -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Choose Your Payment Method</h1>
                <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                    Complete your purchase with confidence. Our secure checkout process ensures your information is protected every step of the way.
                </p>
                
                <!-- Security Features -->
                <div class="flex justify-center space-x-8">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">256-bit SSL Encryption</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Instant Processing</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-600 rounded-full flex items-center justify-center mr-2">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Refund Protection</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Panel - Payment Details -->
                <div class="space-y-8">
                    <!-- Order Summary -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Custom Label (<?php echo e($project->quantity ?? 1); ?> szt.)</span>
                                <span class="font-medium"><?php echo e(number_format($project->calculated_price ?? 0, 2)); ?> zł</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Processing Fee</span>
                                <span class="font-medium">0.00 zł</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium">0.00 zł</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax (23%)</span>
                                <span class="font-medium"><?php echo e(number_format(($project->calculated_price ?? 0) * 0.23, 2)); ?> zł</span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-orange-600"><?php echo e(number_format(($project->calculated_price ?? 0) * 1.23, 2)); ?> zł</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Select Payment Method</h3>
                        <div class="space-y-3">
                            <!-- Credit/Debit Card -->
                            <div class="space-y-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="card" checked class="sr-only">
                                    <div class="relative overflow-hidden rounded-lg border-2 border-orange-600 bg-gradient-to-br from-orange-50 to-orange-100 transition-all duration-300 hover:shadow-lg">
                                        <!-- Credit Card Visual -->
                                        <div class="relative p-4">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <div class="w-4 h-4 border-2 border-orange-600 rounded-full bg-orange-600 flex items-center justify-center mr-2">
                                                        <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                                                    </div>
                                                    <span class="font-semibold text-gray-900">Credit/Debit Card</span>
                                                </div>
                                                <div class="flex space-x-1">
                                                    <img src="https://img.icons8.com/color/16/000000/visa.png" alt="Visa" class="opacity-80">
                                                    <img src="https://img.icons8.com/color/16/000000/mastercard.png" alt="Mastercard" class="opacity-80">
                                                    <img src="https://img.icons8.com/color/16/000000/amex.png" alt="Amex" class="opacity-80">
                                                </div>
                                            </div>
                                            
                                            <!-- Mini Credit Card Preview -->
                                            <div class="relative bg-gradient-to-br from-gray-800 to-gray-900 rounded p-3 text-white shadow">
                                                <div class="flex justify-between items-start mb-2">
                                                    <div class="text-xs opacity-75">CARD NUMBER</div>
                                                    <div class="w-6 h-4 bg-white rounded opacity-20"></div>
                                                </div>
                                                <div class="text-xs font-mono tracking-wider mb-2">•••• •••• •••• 1234</div>
                                                <div class="flex justify-between items-end">
                                                    <div>
                                                        <div class="text-xs opacity-75">EXP</div>
                                                        <div class="text-xs">12/25</div>
                                                    </div>
                                                    <div class="text-xs opacity-75">CVV</div>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2 text-xs text-gray-600">
                                                <span class="inline-flex items-center">
                                                    <svg class="w-3 h-3 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                    </svg>
                                                    Secure & Encrypted
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <!-- Card Information Form -->
                                <div id="card-info" class="bg-white rounded-lg shadow-sm p-4 border border-orange-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-sm font-semibold text-gray-900">Card Information</h3>
                                        <div class="flex items-center text-green-600">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span class="text-xs font-medium">Secure</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Mini Credit Card Visual -->
                                    <div class="relative mb-4">
                                        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-3 text-white shadow-lg">
                                            <div class="flex justify-between items-center mb-2">
                                                <div class="text-xs opacity-75">CREDIT CARD</div>
                                                <div class="flex space-x-1">
                                                    <div class="w-4 h-3 bg-white rounded opacity-20"></div>
                                                    <div class="w-4 h-3 bg-white rounded opacity-20"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-2">
                                                <div class="text-xs opacity-75 mb-1">CARD NUMBER</div>
                                                <div class="text-sm font-mono tracking-wider" id="card-display-number">•••• •••• •••• ••••</div>
                                            </div>
                                            
                                            <div class="flex justify-between items-end">
                                                <div>
                                                    <div class="text-xs opacity-75 mb-1">NAME</div>
                                                    <div class="text-xs font-medium" id="card-display-name">FULL NAME</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-xs opacity-75 mb-1">EXP</div>
                                                    <div class="text-xs font-mono" id="card-display-expiry">MM/YY</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-xs opacity-75 mb-1">CVV</div>
                                                    <div class="text-xs font-mono" id="card-display-cvv">•••</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Form Inputs -->
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Card Number</label>
                                            <input type="text" id="card-number" placeholder="1234 5678 9012 3456" 
                                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 card-input">
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-1">Expiry</label>
                                                <input type="text" id="card-expiry" placeholder="MM/YY" 
                                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 card-input">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-700 mb-1">CVV</label>
                                                <input type="text" id="card-cvv" placeholder="123" 
                                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 card-input">
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Cardholder Name</label>
                                            <input type="text" id="card-name" placeholder="John Doe" 
                                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 card-input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PayPal -->
                            <div class="space-y-3">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="paypal" class="sr-only">
                                    <div class="relative overflow-hidden rounded-lg border-2 border-gray-200 bg-gradient-to-br from-blue-50 to-blue-100 transition-all duration-300 hover:border-blue-400 hover:shadow-lg">
                                        <div class="p-4">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <div class="w-4 h-4 border-2 border-gray-300 rounded-full mr-2"></div>
                                                    <span class="font-semibold text-gray-900">PayPal</span>
                                                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Express</span>
                                                </div>
                                                <div class="w-8 h-6 bg-gradient-to-r from-blue-600 to-blue-800 rounded flex items-center justify-center">
                                                    <span class="text-white font-bold text-xs">PP</span>
                                                </div>
                                            </div>
                                            
                                            <!-- PayPal Visual -->
                                            <div class="bg-white rounded p-3 shadow-sm border border-blue-200">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-2">
                                                        <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.543-.676c-.978-1.01-2.4-1.35-3.92-1.35h-3.73l-.98 6.2h3.73c1.52 0 2.94-.34 3.92-1.35.978-1.01 1.35-2.42 1.35-3.92 0-.23-.02-.46-.05-.68z"/>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-xs font-medium text-gray-900">Pay with PayPal</div>
                                                            <div class="text-xs text-gray-500">Safe & fast</div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-xs text-green-600 font-medium">✓ Protected</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <!-- PayPal Form -->
                                <div id="paypal-info" class="bg-white rounded-lg shadow-sm p-4 border border-blue-200 hidden">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-sm font-semibold text-gray-900">PayPal Account</h3>
                                        <div class="flex items-center text-blue-600">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span class="text-xs font-medium">Secure</span>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 mb-1">PayPal Email</label>
                                            <input type="email" id="paypal-email" placeholder="your@email.com" 
                                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        
                                        <div class="bg-blue-50 rounded p-3">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div class="text-xs text-blue-800">
                                                    <strong>Note:</strong> You will be redirected to PayPal to complete your payment securely.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Apple Pay -->
                            <div class="space-y-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="applepay" class="sr-only">
                                    <div class="relative overflow-hidden rounded-xl border-2 border-gray-200 bg-gradient-to-br from-gray-50 to-gray-100 transition-all duration-300 hover:border-gray-400 hover:shadow-lg">
                                        <div class="p-6">
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="w-5 h-5 border-2 border-gray-300 rounded-full mr-3"></div>
                                                    <span class="font-semibold text-gray-900 text-lg">Apple Pay</span>
                                                    <span class="ml-3 px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Touch ID</span>
                                                </div>
                                                <div class="w-12 h-8 bg-black rounded flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.11-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <!-- Apple Pay Visual -->
                                            <div class="bg-black rounded-lg p-4 text-white">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.11-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium">Pay with Apple Pay</div>
                                                            <div class="text-xs opacity-75">Touch ID or Face ID</div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-xs opacity-75">Instant</div>
                                                        <div class="text-xs text-green-400 font-medium">✓ Secure</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <!-- Apple Pay Form -->
                                <div id="applepay-info" class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 hidden">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-sm font-semibold text-gray-900">Apple Pay Account</h3>
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span class="text-xs font-medium">Secure</span>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Apple ID Email</label>
                                            <input type="email" id="applepay-email" placeholder="your@icloud.com" 
                                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                                        </div>
                                        
                                        <div class="bg-gray-50 rounded p-3">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div class="text-xs text-gray-700">
                                                    <strong>Note:</strong> You will be redirected to Apple Pay to complete your payment securely.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Google Pay -->
                            <div class="space-y-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="payment_method" value="googlepay" class="sr-only">
                                    <div class="relative overflow-hidden rounded-xl border-2 border-gray-200 bg-gradient-to-br from-red-50 to-red-100 transition-all duration-300 hover:border-red-400 hover:shadow-lg">
                                        <div class="p-6">
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="w-5 h-5 border-2 border-gray-300 rounded-full mr-3"></div>
                                                    <span class="font-semibold text-gray-900 text-lg">Google Pay</span>
                                                    <span class="ml-3 px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">One-tap</span>
                                                </div>
                                                <div class="w-12 h-8 bg-gradient-to-r from-red-500 to-red-600 rounded flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <!-- Google Pay Visual -->
                                            <div class="bg-white rounded-lg p-4 shadow-sm border border-red-200">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-8 h-8 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">Pay with Google Pay</div>
                                                            <div class="text-xs text-gray-500">One-tap payment</div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-xs text-gray-500">Fast</div>
                                                        <div class="text-xs text-green-600 font-medium">✓ Safe</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <!-- Google Pay Form -->
                                <div id="googlepay-info" class="bg-white rounded-lg shadow-sm p-4 border border-red-200 hidden">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-sm font-semibold text-gray-900">Google Pay Account</h3>
                                        <div class="flex items-center text-red-600">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                            <span class="text-xs font-medium">Secure</span>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Google Account Email</label>
                                            <input type="email" id="googlepay-email" placeholder="your@gmail.com" 
                                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                        </div>
                                        
                                        <div class="bg-red-50 rounded p-3">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div class="text-xs text-red-800">
                                                    <strong>Note:</strong> You will be redirected to Google Pay to complete your payment securely.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Transfer -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="bank" class="sr-only">
                                <div class="relative overflow-hidden rounded-xl border-2 border-gray-200 bg-gradient-to-br from-green-50 to-green-100 transition-all duration-300 hover:border-green-400 hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center">
                                                <div class="w-5 h-5 border-2 border-gray-300 rounded-full mr-3"></div>
                                                <span class="font-semibold text-gray-900 text-lg">Bank Transfer</span>
                                                <span class="ml-3 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">2-3 business days</span>
                                            </div>
                                            <div class="w-12 h-8 bg-gradient-to-r from-green-600 to-green-700 rounded flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        
                                        <!-- Bank Transfer Visual -->
                                        <div class="bg-white rounded-lg p-4 shadow-sm border border-green-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Direct Bank Transfer</div>
                                                        <div class="text-xs text-gray-500">Traditional banking</div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-xs text-gray-500">2-3 days</div>
                                                    <div class="text-xs text-green-600 font-medium">✓ Reliable</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!-- Cryptocurrency -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="crypto" class="sr-only">
                                <div class="relative overflow-hidden rounded-xl border-2 border-gray-200 bg-gradient-to-br from-purple-50 to-purple-100 transition-all duration-300 hover:border-purple-400 hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center">
                                                <div class="w-5 h-5 border-2 border-gray-300 rounded-full mr-3"></div>
                                                <span class="font-semibold text-gray-900 text-lg">Cryptocurrency</span>
                                                <span class="ml-3 px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">BTC, ETH, LTC</span>
                                            </div>
                                            <div class="w-12 h-8 bg-gradient-to-r from-purple-600 to-purple-700 rounded flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        
                                        <!-- Crypto Visual -->
                                        <div class="bg-white rounded-lg p-4 shadow-sm border border-purple-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex space-x-1">
                                                        <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white text-xs font-bold">₿</span>
                                                        </div>
                                                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white text-xs font-bold">Ξ</span>
                                                        </div>
                                                        <div class="w-6 h-6 bg-gray-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white text-xs font-bold">Ł</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Pay with Crypto</div>
                                                        <div class="text-xs text-gray-500">Bitcoin, Ethereum, Litecoin</div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-xs text-gray-500">Instant</div>
                                                    <div class="text-xs text-purple-600 font-medium">✓ Decentralized</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>


                    <!-- Pay Button -->
                    <button class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-4 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Pay <?php echo e(number_format(($project->calculated_price ?? 0) * 1.23, 2)); ?> zł Now
                    </button>
                    
                    <p class="text-xs text-gray-500 text-center">
                        By clicking "Pay Now", you agree to our Terms of Service and Privacy Policy.
                    </p>
                    
                    <div class="flex justify-center space-x-6">
                        <div class="flex items-center text-green-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span class="text-sm font-medium">SSL Protected</span>
                        </div>
                        <div class="flex items-center text-green-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-sm font-medium">Refund Policy</span>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Product Display & Security Info -->
                <div class="space-y-8">
                    <!-- Product Display -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Your Product</h3>
                            <a href="<?php echo e(route('label.creator')); ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-orange-600 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Label
                            </a>
                        </div>
                        
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                                <?php if($project && $project->artwork_file_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $project->artwork_file_path)); ?>" alt="Product" class="w-full h-full object-cover rounded-lg">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-orange-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900"><?php echo e($project->labelMaterial->name ?? 'Custom Label'); ?></h4>
                                <p class="text-sm text-gray-600"><?php echo e($project->labelShape->name ?? 'Custom Shape'); ?></p>
                                <p class="text-sm text-gray-500">
                                    <?php echo e($project->getActualDimensions()['width'] ?? '50'); ?>×<?php echo e($project->getActualDimensions()['height'] ?? '50'); ?>mm
                                </p>
                                <?php if($project && $project->laminateOption): ?>
                                    <p class="text-sm text-blue-600">Laminat: <?php echo e($project->laminateOption->name); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Quantity Selector -->
                        <div class="border-t pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Ilość</span>
                                <div class="flex items-center">
                                    <button type="button" id="quantity-decrease" class="p-2 rounded-l-lg bg-orange-100 text-orange-600 border border-r-0 border-orange-200 hover:bg-orange-200 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity-input" value="<?php echo e($project->quantity ?? 1); ?>" min="1" max="10000" 
                                           class="w-20 text-center py-2 border-y border-orange-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    <button type="button" id="quantity-increase" class="p-2 rounded-r-lg bg-orange-100 text-orange-600 border border-l-0 border-orange-200 hover:bg-orange-200 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <span class="ml-2 text-gray-600 text-sm">sztuk</span>
                                </div>
                            </div>
                            <div class="mt-2 text-xs text-gray-500">
                                Price per unit: <?php echo e(number_format(($project->calculated_price ?? 0) / ($project->quantity ?? 1), 2)); ?> zł
                            </div>
                        </div>
                    </div>

                    <!-- Bank-Level Security -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Bank-Level Security</h3>
                                <p class="text-sm text-gray-600">Your payment information is protected with industry-standard encryption.</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-5 h-5 bg-orange-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-900">256-bit SSL Encryption</span>
                                    <p class="text-sm text-gray-600">All data transmitted is encrypted</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-5 h-5 bg-orange-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-900">PCI DSS Compliant</span>
                                    <p class="text-sm text-gray-600">Meets payment card industry standards</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-5 h-5 bg-orange-600 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-900">Fraud Detection</span>
                                    <p class="text-sm text-gray-600">Advanced AI monitors for suspicious activity</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trusted By Millions -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Trusted By Millions</h3>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="text-center">
                                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-gray-900">10M+</div>
                                <div class="text-sm text-gray-600">Transactions</div>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-gray-900">99.9%</div>
                                <div class="text-sm text-gray-600">Uptime</div>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-gray-900">24/7</div>
                                <div class="text-sm text-gray-600">Support</div>
                            </div>
                            <div class="text-center">
                                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-2xl font-bold text-gray-900">150+</div>
                                <div class="text-sm text-gray-600">Countries</div>
                            </div>
                        </div>
                        
                        <div class="flex justify-center space-x-4">
                            <img src="https://img.icons8.com/color/24/000000/visa.png" alt="Visa">
                            <img src="https://img.icons8.com/color/24/000000/mastercard.png" alt="Mastercard">
                            <img src="https://img.icons8.com/color/24/000000/amex.png" alt="Amex">
                            <img src="https://img.icons8.com/color/24/000000/discover.png" alt="Discover">
                            <img src="https://img.icons8.com/color/24/000000/paypal.png" alt="PayPal">
                            <img src="https://img.icons8.com/ios-filled/24/000000/mac-os.png" alt="Apple Pay">
                            <img src="https://img.icons8.com/color/24/000000/google-pay-india.png" alt="Google Pay">
                        </div>
                    </div>

                    <!-- Customer Testimonials -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">What Our Customers Say</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                <div>
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-gray-900">Sarah Johnson</span>
                                        <div class="flex ml-2">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                                <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600">"Fast and secure payment process. Highly recommended!"</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                <div>
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-gray-900">Mike Chen</span>
                                        <div class="flex ml-2">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                                <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600">"Excellent service and great customer support."</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Money Back Guarantee -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">30-Day Money Back Guarantee</h3>
                                <p class="text-sm text-gray-600">Not satisfied? Get a full refund within 30 days, no questions asked.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method selection
            const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
            const cardInfo = document.getElementById('card-info');
            const paypalInfo = document.getElementById('paypal-info');
            const applepayInfo = document.getElementById('applepay-info');
            const googlepayInfo = document.getElementById('googlepay-info');
            
            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    // Update radio button styles
                    paymentMethods.forEach(m => {
                        const label = m.closest('label');
                        if (m.checked) {
                            label.classList.add('border-orange-600', 'bg-orange-50');
                            label.classList.remove('border-gray-200');
                            const radio = label.querySelector('.w-4.h-4, .w-5.h-5');
                            if (radio) {
                                radio.classList.add('border-orange-600', 'bg-orange-600');
                                radio.classList.remove('border-gray-300');
                            }
                        } else {
                            label.classList.remove('border-orange-600', 'bg-orange-50');
                            label.classList.add('border-gray-200');
                            const radio = label.querySelector('.w-4.h-4, .w-5.h-5');
                            if (radio) {
                                radio.classList.remove('border-orange-600', 'bg-orange-600');
                                radio.classList.add('border-gray-300');
                            }
                        }
                    });
                    
                    // Hide all forms
                    [cardInfo, paypalInfo, applepayInfo, googlepayInfo].forEach(form => {
                        if (form) form.classList.add('hidden');
                    });
                    
                    // Show selected form
                    if (this.value === 'card' && cardInfo) {
                        cardInfo.classList.remove('hidden');
                    } else if (this.value === 'paypal' && paypalInfo) {
                        paypalInfo.classList.remove('hidden');
                    } else if (this.value === 'applepay' && applepayInfo) {
                        applepayInfo.classList.remove('hidden');
                    } else if (this.value === 'googlepay' && googlepayInfo) {
                        googlepayInfo.classList.remove('hidden');
                    }
                });
            });
            
            // Card number formatting and visual update
            const cardNumberInput = document.getElementById('card-number');
            const cardDisplayNumber = document.getElementById('card-display-number');
            
            if (cardNumberInput && cardDisplayNumber) {
                cardNumberInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
                    
                    // Limit to 16 digits
                    if (value.length > 16) {
                        value = value.substring(0, 16);
                    }
                    
                    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                    e.target.value = formattedValue;
                    
                    // Update visual card
                    if (value.length > 0) {
                        let displayValue = formattedValue;
                        while (displayValue.length < 19) {
                            displayValue += ' •';
                        }
                        cardDisplayNumber.textContent = displayValue.substring(0, 19);
                    } else {
                        cardDisplayNumber.textContent = '•••• •••• •••• ••••';
                    }
                    
                    // Add visual feedback
                    if (value.length === 16) {
                        e.target.classList.add('form-success');
                        e.target.classList.remove('form-error');
                    } else if (value.length > 0) {
                        e.target.classList.add('form-error');
                        e.target.classList.remove('form-success');
                    } else {
                        e.target.classList.remove('form-error', 'form-success');
                    }
                });
            }
            
            // Expiry date formatting and validation
            const expiryInput = document.getElementById('card-expiry');
            const cardDisplayExpiry = document.getElementById('card-display-expiry');
            
            if (expiryInput && cardDisplayExpiry) {
                expiryInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length >= 2) {
                        value = value.substring(0, 2) + '/' + value.substring(2, 4);
                    }
                    e.target.value = value;
                    
                    // Update visual card
                    if (value.length > 0) {
                        cardDisplayExpiry.textContent = value;
                    } else {
                        cardDisplayExpiry.textContent = 'MM/YY';
                    }
                    
                    // Validate expiry date
                    if (value.length === 5) {
                        const [month, year] = value.split('/');
                        const currentDate = new Date();
                        const currentYear = currentDate.getFullYear() % 100;
                        const currentMonth = currentDate.getMonth() + 1;
                        
                        if (parseInt(month) >= 1 && parseInt(month) <= 12 && 
                            (parseInt(year) > currentYear || (parseInt(year) === currentYear && parseInt(month) >= currentMonth))) {
                            e.target.classList.add('form-success');
                            e.target.classList.remove('form-error');
                        } else {
                            e.target.classList.add('form-error');
                            e.target.classList.remove('form-success');
                        }
                    } else if (value.length > 0) {
                        e.target.classList.add('form-error');
                        e.target.classList.remove('form-success');
                    } else {
                        e.target.classList.remove('form-error', 'form-success');
                    }
                });
            }
            
            // CVV validation
            const cvvInput = document.getElementById('card-cvv');
            const cardDisplayCvv = document.getElementById('card-display-cvv');
            
            if (cvvInput && cardDisplayCvv) {
                cvvInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    e.target.value = value;
                    
                    // Update visual card
                    if (value.length > 0) {
                        cardDisplayCvv.textContent = '•'.repeat(value.length);
                    } else {
                        cardDisplayCvv.textContent = '•••';
                    }
                    
                    if (value.length >= 3) {
                        e.target.classList.add('form-success');
                        e.target.classList.remove('form-error');
                    } else if (value.length > 0) {
                        e.target.classList.add('form-error');
                        e.target.classList.remove('form-success');
                    } else {
                        e.target.classList.remove('form-error', 'form-success');
                    }
                });
            }
            
            // Cardholder name validation
            const nameInput = document.getElementById('card-name');
            const cardDisplayName = document.getElementById('card-display-name');
            
            if (nameInput && cardDisplayName) {
                nameInput.addEventListener('input', function(e) {
                    // Update visual card
                    if (e.target.value.length > 0) {
                        cardDisplayName.textContent = e.target.value.toUpperCase();
                    } else {
                        cardDisplayName.textContent = 'FULL NAME';
                    }
                    
                    if (e.target.value.length >= 2) {
                        e.target.classList.add('form-success');
                        e.target.classList.remove('form-error');
                    } else if (e.target.value.length > 0) {
                        e.target.classList.add('form-error');
                        e.target.classList.remove('form-success');
                    } else {
                        e.target.classList.remove('form-error', 'form-success');
                    }
                });
            }
            
            // Quantity controls
            const quantityInput = document.getElementById('quantity-input');
            const quantityDecrease = document.getElementById('quantity-decrease');
            const quantityIncrease = document.getElementById('quantity-increase');
            
            if (quantityInput && quantityDecrease && quantityIncrease) {
                quantityDecrease.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value) || 1;
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                        updateOrderSummary();
                    }
                });
                
                quantityIncrease.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value) || 1;
                    if (currentValue < 10000) {
                        quantityInput.value = currentValue + 1;
                        updateOrderSummary();
                    }
                });
                
                quantityInput.addEventListener('input', function() {
                    let value = parseInt(this.value) || 1;
                    if (value < 1) value = 1;
                    if (value > 10000) value = 10000;
                    this.value = value;
                    updateOrderSummary();
                });
            }
            
            // Update order summary function
            function updateOrderSummary() {
                const quantity = parseInt(quantityInput.value) || 1;
                const basePrice = <?php echo e($project->calculated_price ?? 0); ?> / <?php echo e($project->quantity ?? 1); ?>;
                const newTotal = basePrice * quantity * 1.23;
                
                // Update total in order summary
                const totalElement = document.querySelector('.text-2xl.font-bold.text-orange-600');
                if (totalElement) {
                    totalElement.textContent = newTotal.toFixed(2) + ' zł';
                }
                
                // Update pay button
                const payButton = document.querySelector('button[class*="bg-orange-600"]');
                if (payButton) {
                    payButton.innerHTML = `<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>Pay ${newTotal.toFixed(2)} zł Now`;
                }
            }
            
            // Pay button click with validation
            const payButton = document.querySelector('button[class*="bg-orange-600"]');
            if (payButton) {
                payButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Get selected payment method
                    const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
                    
                    if (!selectedMethod) {
                        alert('Proszę wybrać metodę płatności');
                        return;
                    }
                    
                    // Handle different payment methods
                    if (selectedMethod.value === 'paypal') {
                        // Redirect to PayPal
                        window.open('https://www.paypal.com/signin', '_blank');
                        return;
                    }
                    
                    if (selectedMethod.value === 'applepay') {
                        // Redirect to Apple Pay
                        window.open('https://appleid.apple.com/', '_blank');
                        return;
                    }
                    
                    if (selectedMethod.value === 'googlepay') {
                        // Redirect to Google Pay
                        window.open('https://pay.google.com/', '_blank');
                        return;
                    }
                    
                    if (selectedMethod.value === 'bank') {
                        // Show bank transfer info
                        alert('Bank Transfer: Please transfer the amount to our account. Details will be sent to your email.');
                        return;
                    }
                    
                    if (selectedMethod.value === 'crypto') {
                        // Show crypto payment info
                        alert('Cryptocurrency Payment: Please send Bitcoin, Ethereum, or Litecoin to our wallet address. Details will be sent to your email.');
                        return;
                    }
                    
                    // Validate card information if card is selected
                    if (selectedMethod.value === 'card') {
                        const cardNumber = cardNumberInput.value.replace(/\s/g, '');
                        const expiry = expiryInput.value;
                        const cvv = cvvInput.value;
                        const name = nameInput.value;
                        
                        if (cardNumber.length < 16) {
                            showPaymentError('Proszę podać prawidłowy numer karty');
                            cardNumberInput.focus();
                            return;
                        }
                        
                        if (expiry.length !== 5) {
                            showPaymentError('Proszę podać prawidłową datę ważności (MM/YY)');
                            expiryInput.focus();
                            return;
                        }
                        
                        if (cvv.length < 3) {
                            showPaymentError('Proszę podać prawidłowy kod CVV');
                            cvvInput.focus();
                            return;
                        }
                        
                        if (name.length < 2) {
                            showPaymentError('Proszę podać imię i nazwisko');
                            nameInput.focus();
                            return;
                        }
                    }
                    
                    // Show payment processing popup
                    showPaymentProcessing(selectedMethod.value);
                });
            }
            
            // Payment processing modal
            function showPaymentProcessing(method) {
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                modal.innerHTML = `
                    <div class="bg-white rounded-2xl p-8 max-w-md mx-auto text-center animate-pop">
                        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-orange-600 loading-spinner" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Przetwarzanie płatności...</h3>
                        <p class="text-gray-600 mb-6">Proszę czekać, Twoja płatność jest przetwarzana.</p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                            <div class="bg-orange-600 h-2 rounded-full animate-pulse" style="width: 60%"></div>
                        </div>
                        <p class="text-sm text-gray-500">Metoda: ${getPaymentMethodName(method)}</p>
                    </div>
                `;
                document.body.appendChild(modal);
                
                // Simulate processing time
                setTimeout(() => {
                    modal.remove();
                    showPaymentSuccess();
                }, 3000);
            }
            
            // Payment error modal
            function showPaymentError(message) {
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                modal.innerHTML = `
                    <div class="bg-white rounded-2xl p-8 max-w-md mx-auto text-center animate-pop">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Błąd płatności</h3>
                        <p class="text-gray-600 mb-6">${message}</p>
                        <button onclick="this.closest('.fixed').remove()" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                            Spróbuj ponownie
                        </button>
                    </div>
                `;
                document.body.appendChild(modal);
            }
            
            // Payment success modal
            function showPaymentSuccess() {
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                modal.innerHTML = `
                    <div class="bg-white rounded-2xl p-8 max-w-md mx-auto text-center animate-pop">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Płatność zakończona pomyślnie!</h3>
                        <p class="text-gray-600 mb-6">Dziękujemy za złożenie zamówienia. Potwierdzenie zostało wysłane na Twój e-mail.</p>
                        <div class="space-y-3">
                            <button onclick="this.closest('.fixed').remove()" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors">
                                Zamknij
                            </button>
                            <button onclick="window.location.href='<?php echo e(route('home')); ?>'" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-lg transition-colors">
                                Wróć do strony głównej
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            }
            
            // Get payment method name
            function getPaymentMethodName(method) {
                const names = {
                    'card': 'Karta kredytowa',
                    'paypal': 'PayPal',
                    'applepay': 'Apple Pay',
                    'googlepay': 'Google Pay',
                    'bank': 'Przelew bankowy',
                    'crypto': 'Kryptowaluta'
                };
                return names[method] || method;
            }
            
            // Add CSS for animations
            const style = document.createElement('style');
            style.textContent = `
                .animate-pop {
                    animation: pop 0.4s cubic-bezier(.4, 2, .6, 1);
                }
                @keyframes pop {
                    0% { transform: scale(0.8); opacity: 0; }
                    80% { transform: scale(1.05); opacity: 1; }
                    100% { transform: scale(1); }
                }
            `;
            document.head.appendChild(style);
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
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/checkout.blade.php ENDPATH**/ ?>