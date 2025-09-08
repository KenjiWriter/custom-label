
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
    <div class="min-h-screen bg-[#fafbfc] py-4">
        <div class="max-w-4xl mx-auto scale-75">
            <!-- Stepper -->
            <div class="flex flex-col items-center mb-4">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Secure Checkout</h1>
                <p class="text-gray-600 mb-4 text-center">Complete your order with confidence. Your information is protected with bank-level security.</p>
                <div class="flex items-center w-full max-w-xl mb-2">
                    <div class="mx-2 text-orange-600 font-semibold">Cart</div>
                    <div class="flex-1 h-1 bg-orange-500 rounded-full"></div>
                    <div class="mx-2 text-orange-600 font-semibold">Checkout</div>
                    <div class="flex-1 h-1 bg-gray-200 rounded-full"></div>
                    <div class="mx-2 text-gray-400 font-semibold">Confirmation</div>
                </div>
                <div class="flex space-x-4 mt-2">
                    <span class="flex items-center space-x-1 text-green-600 text-xs font-semibold"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>SSL Secure</span>
                    <span class="flex items-center space-x-1 text-blue-600 text-xs font-semibold"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"></path></svg>30-Day Guarantee</span>
                    <span class="flex items-center space-x-1 text-orange-600 text-xs font-semibold"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h2l1 2h13l1-2h2"></path><path stroke-linecap="round" stroke-linejoin="round" d="M5 21h14a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z"></path></svg>Fast Delivery</span>
                    <span class="flex items-center space-x-1 text-purple-600 text-xs font-semibold"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"></path></svg>24/7 Support</span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- Contact & Shipping + Payment -->
                <div class="md:col-span-2 bg-white rounded-2xl shadow-lg p-8">
                    <div class="mb-6 flex items-center">
                        <span class="bg-orange-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3">1</span>
                        <h2 class="text-xl font-semibold">Contact & Shipping Information</h2>
                    </div>
                    <form id="checkoutForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Email Address *</label>
                                <input type="email" name="email" id="checkoutEmail" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg" placeholder="your.email@example.com" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Phone Number *</label>
                                <input type="tel" name="phone" id="checkoutPhone" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg" placeholder="+1 (555) 000-0000" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">First Name *</label>
                                <input type="text" name="first_name" id="checkoutFirstName" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg" placeholder="John" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Last Name *</label>
                                <input type="text" name="last_name" id="checkoutLastName" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg" placeholder="Doe" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Company Name (Optional)</label>
                            <input type="text" name="company" id="checkoutCompany" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg" placeholder="Your Company Ltd.">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Country/Region *</label>
                            <select name="country" id="checkoutCountry" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg" required>
                                <?php
                                    $countries = [
                                        'Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia','Austria','Azerbaijan',
                                        'Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi',
                                        'Cabo Verde','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czechia',
                                        'Denmark','Djibouti','Dominica','Dominican Republic',
                                        'Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Eswatini','Ethiopia',
                                        'Fiji','Finland','France',
                                        'Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana',
                                        'Haiti','Honduras','Hungary',
                                        'Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Ivory Coast',
                                        'Jamaica','Japan','Jordan',
                                        'Kazakhstan','Kenya','Kiribati','Kuwait','Kyrgyzstan',
                                        'Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg',
                                        'Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar',
                                        'Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','North Macedonia','Norway',
                                        'Oman',
                                        'Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal',
                                        'Qatar',
                                        'Romania','Russia','Rwanda',
                                        'Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Sweden','Switzerland','Syria',
                                        'Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu',
                                        'Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan',
                                        'Vanuatu','Vatican City','Venezuela','Vietnam',
                                        'Yemen',
                                        'Zambia','Zimbabwe'
                                    ];
                                ?>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php echo e($country === 'Poland' ? 'selected' : ''); ?>><?php echo e($country); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="saveAddress" class="mr-2">
                            <label for="saveAddress" class="text-gray-700 text-sm">Zapisz dane na przyszłość</label>
                        </div>
                        <div id="savedAddressesContainer" class="mt-2 hidden">
                            <label class="block text-gray-700 font-medium mb-1">Wybierz zapisany adres:</label>
                            <select id="savedAddresses" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg"></select>
                        </div>
                        <!-- Payment Methods -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-3">Metoda płatności</h3>
                            <div class="flex flex-wrap gap-3 mb-6 justify-center">
                                <label class="flex items-center border border-gray-300 rounded-lg px-4 py-3 cursor-pointer hover:border-orange-400 transition min-w-[140px] justify-center">
                                    <input type="radio" name="payment_method" value="card" class="mr-3 accent-orange-500" checked>
                                    <img src="https://img.icons8.com/color/36/000000/bank-card-back-side.png" class="w-7 h-7 mr-2" alt="Card">
                                    <span class="text-gray-700 font-medium">Karta</span>
                                </label>
                                <label class="flex items-center border border-gray-300 rounded-lg px-4 py-3 cursor-pointer hover:border-orange-400 transition min-w-[140px] justify-center">
                                    <input type="radio" name="payment_method" value="paypal" class="mr-3 accent-orange-500">
                                    <img src="https://img.icons8.com/color/36/000000/paypal.png" class="w-7 h-7 mr-2" alt="PayPal">
                                    <span class="text-gray-700 font-medium">PayPal</span>
                                </label>
                                <label class="flex items-center border border-gray-300 rounded-lg px-4 py-3 cursor-pointer hover:border-orange-400 transition min-w-[140px] justify-center">
                                    <input type="radio" name="payment_method" value="blik" class="mr-3 accent-orange-500">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6a/Blik_logo.svg" class="w-7 h-7 mr-2" alt="BLIK">
                                    <span class="text-gray-700 font-medium">BLIK</span>
                                </label>
                                <label class="flex items-center border border-gray-300 rounded-lg px-4 py-3 cursor-pointer hover:border-orange-400 transition min-w-[140px] justify-center">
                                    <input type="radio" name="payment_method" value="applepay" class="mr-3 accent-orange-500">
                                    <img src="https://img.icons8.com/ios-filled/36/000000/mac-os.png" class="w-7 h-7 mr-2" alt="Apple Pay">
                                    <span class="text-gray-700 font-medium">Apple Pay</span>
                                </label>
                                <label class="flex items-center border border-gray-300 rounded-lg px-4 py-3 cursor-pointer hover:border-orange-400 transition min-w-[140px] justify-center">
                                    <input type="radio" name="payment_method" value="googlepay" class="mr-3 accent-orange-500">
                                    <img src="https://img.icons8.com/color/36/000000/google-pay-india.png" class="w-7 h-7 mr-2" alt="Google Pay">
                                    <span class="text-gray-700 font-medium">Google Pay</span>
                                </label>
                                <label class="flex items-center border border-gray-300 rounded-lg px-4 py-3 cursor-pointer hover:border-orange-400 transition min-w-[140px] justify-center">
                                    <input type="radio" name="payment_method" value="invoice" class="mr-3 accent-orange-500">
                                    <img src="https://img.icons8.com/ios-filled/36/000000/invoice.png" class="w-7 h-7 mr-2" alt="Faktura">
                                    <span class="text-gray-700 font-medium">Faktura</span>
                                </label>
                            </div>
                            <!-- Dynamic Payment Panels -->
                            <div id="cardPanel" class="hidden w-full flex justify-center">
                                <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl p-6 shadow-lg flex flex-col items-center max-w-md mx-auto">
                                    <div class="w-full flex flex-col items-center mb-4">
                                        <div class="w-[420px] h-64 bg-gradient-to-br from-orange-500 to-orange-700 rounded-2xl shadow-xl relative flex flex-col justify-between p-6 text-white font-mono">
                                            <div class="flex justify-between items-center">
                                                <span class="text-lg font-bold tracking-widest">CREDIT CARD</span>
                                                <svg class="w-10 h-10" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="10" rx="2" fill="#fff2" /><rect x="2" y="7" width="20" height="4" rx="2" fill="#fff4" /></svg>
                                            </div>
                                            <div class="flex flex-col items-start mt-6">
                                                <input id="cardNumber" maxlength="19" class="bg-transparent border-none outline-none text-2xl tracking-widest w-full placeholder-white" placeholder="1234 5678 9012 3456">
                                                <div class="flex w-full mt-3 space-x-4">
                                                    <input id="cardExpiry" maxlength="5" class="bg-transparent border-none outline-none text-lg w-1/2 placeholder-white" placeholder="MM/YY">
                                                    <input id="cardCVC" maxlength="4" class="bg-transparent border-none outline-none text-lg w-1/2 placeholder-white" placeholder="CVC">
                                                </div>
                                            </div>
                                            <div class="flex justify-between items-center mt-6">
                                                <input id="cardName" class="bg-transparent border-none outline-none text-lg w-2/3 placeholder-white" placeholder="Imię i nazwisko">
                                                <span class="text-xs tracking-widest">Karta Kredytowa</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="blikPanel" class="hidden w-full flex justify-center">
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow flex flex-col items-center max-w-md mx-auto">
                                    <label for="blikCode" class="block text-gray-700 font-medium mb-2">Kod BLIK</label>
                                    <input id="blikCode" maxlength="6" class="w-40 border border-gray-300 rounded-lg px-4 py-3 text-center text-2xl tracking-widest focus:ring-orange-500 focus:border-orange-500" placeholder="123456">
                                    <button class="mt-4 bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold">Zapłać BLIK</button>
                                </div>
                            </div>
                            <div id="invoicePanel" class="hidden w-full flex justify-center">
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow flex flex-col items-center max-w-md mx-auto">
                                    <label class="block text-gray-700 font-medium mb-2">Dane do faktury</label>
                                    <input type="text" id="invoiceCompany" class="w-72 border border-gray-300 rounded-lg px-4 py-3 mb-2" placeholder="Nazwa firmy">
                                    <input type="text" id="invoiceNIP" class="w-72 border border-gray-300 rounded-lg px-4 py-3 mb-2" placeholder="NIP">
                                    <input type="text" id="invoiceAddress" class="w-72 border border-gray-300 rounded-lg px-4 py-3 mb-2" placeholder="Adres">
                                    <input type="text" id="invoiceCity" class="w-72 border border-gray-300 rounded-lg px-4 py-3 mb-2" placeholder="Miasto">
                                    <input type="text" id="invoiceZip" class="w-72 border border-gray-300 rounded-lg px-4 py-3 mb-2" placeholder="Kod pocztowy">
                                </div>
                            </div>
                        </div>
                        <!-- Promo Code Section -->

                    </form>
                </div>
                <!-- Order Summary -->
                <div class="w-full md:w-[440px]">
                    <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                        <h2 class="text-xl font-semibold mb-6">Order Summary</h2>
                        <div class="space-y-8">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="<?php echo e($project->artwork_file_path ? asset('storage/'.$project->artwork_file_path) : 'https://dummyimage.com/120x120/eee/aaa&text=LBL'); ?>" alt="Product" class="w-28 h-28 rounded-2xl mr-6 border border-gray-200 shadow-sm object-cover">
                                    <div>
                                        <div class="font-bold text-gray-800 text-xl"><?php echo e($project->labelMaterial->name ?? 'Brak materiału'); ?></div>
                                        <div class="text-base text-gray-500"><?php echo e($project->labelShape->name ?? 'Brak kształtu'); ?> • <?php echo e($project->getActualDimensions()['width'] ?? '?'); ?>×<?php echo e($project->getActualDimensions()['height'] ?? '?'); ?>mm</div>
                                        <div class="text-base text-gray-400">Ilość: <?php echo e(number_format($project->quantity)); ?></div>
                                        <?php if($project->laminateOption): ?>
                                            <div class="text-base text-blue-500">Laminat: <?php echo e($project->laminateOption->name); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="font-bold text-gray-800 text-3xl"><?php echo e(number_format($project->calculated_price, 2)); ?> zł</div>
                            </div>
                        </div>
                        <div class="border-t pt-6 mt-6 space-y-2">
                            <div class="flex justify-between text-gray-700 text-base">
                                <span>Subtotal</span>
                                <span><?php echo e(number_format($project->calculated_price, 2)); ?> zł</span>
                            </div>
                            <div class="flex justify-between text-gray-700 text-base">
                                <span>Shipping</span>
                                <span>0.00 zł</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold text-gray-900 mt-2">
                                <span>Total</span>
                                <span id="totalPrice"><?php echo e(number_format($project->calculated_price, 2)); ?> zł</span>
                            </div>
                        </div>
                        <!-- Promo Code Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-3">Promo Code</h3>
                            <div class="flex">
                                <input id="promoInput" type="text" class="flex-1 border border-gray-300 rounded-l-lg px-4 py-3 focus:ring-orange-500 focus:border-orange-500 text-lg" placeholder="Enter promo code">
                                <button type="button" id="applyPromoBtn" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-r-lg font-semibold">Apply</button>
                            </div>
                            <div id="promoInfo" class="text-green-600 text-sm mt-2 hidden">Kod rabatowy zastosowany!</div>
                            <div id="promoError" class="text-red-600 text-sm mt-2 hidden">Nieprawidłowy kod rabatowy.</div>
                        </div>
                    </form>

                        <button class="w-full mt-8 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 rounded-xl text-lg transition-all duration-200 shadow-lg">Pay Now</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Success Popup -->
    <div id="paymentSuccessPopup" class="fixed inset-0 bg-transparent flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl px-10 py-12 flex flex-col items-center border-4 border-orange-500 max-w-xs w-full animate-pop">
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-full w-20 h-20 flex items-center justify-center mb-6 shadow-lg">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-opacity="0.2" stroke-width="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12l3 3 5-5" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-orange-600 mb-2 text-center">Płatność zakończona!</h2>
            <p class="text-gray-700 text-center mb-6">Dziękujemy za złożenie zamówienia.<br>Potwierdzenie wysłaliśmy na Twój e-mail.</p>
            <button id="closeSuccessPopup" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-xl text-lg transition-all duration-200 shadow">Zamknij</button>
        </div>
    </div>
    <style>
        @keyframes pop {
            0% { transform: scale(0.8); opacity: 0; }
            80% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); }
        }
        .animate-pop { animation: pop 0.4s cubic-bezier(.4,2,.6,1) }
    </style>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment panel logic
    function showPanel(panel) {
        document.getElementById('cardPanel').style.display = panel === 'card' ? 'flex' : 'none';
        document.getElementById('blikPanel').style.display = panel === 'blik' ? 'flex' : 'none';
        document.getElementById('invoicePanel').style.display = panel === 'invoice' ? 'flex' : 'none';
    }
    // Default: karta
    showPanel('card');
    document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            if(this.value === 'card') showPanel('card');
            else if(this.value === 'blik') showPanel('blik');
            else if(this.value === 'invoice') showPanel('invoice');
            else showPanel('');
            if(this.value === 'paypal') {
                window.open('https://www.paypal.com/signin', '_blank');
            }
            if(this.value === 'applepay') {
                window.open('https://appleid.apple.com/', '_blank');
            }
            if(this.value === 'googlepay') {
                window.open('https://pay.google.com/', '_blank');
            }
        });
    });

    // Promo code logic (demo)
    document.getElementById('applyPromoBtn').onclick = function() {
        const code = document.getElementById('promoInput').value.trim();
        const promoInfo = document.getElementById('promoInfo');
        const promoError = document.getElementById('promoError');
        if(code === 'RABAT10') {
            promoInfo.classList.remove('hidden');
            promoError.classList.add('hidden');
            // Przykładowa zniżka 10%
            let price = parseFloat('<?php echo e($project->calculated_price); ?>');
            let newPrice = (price * 0.9).toFixed(2);
            document.getElementById('totalPrice').innerText = newPrice + ' zł';
        } else {
            promoInfo.classList.add('hidden');
            promoError.classList.remove('hidden');
        }
    };

    // Zapisane adresy (bez zmian)
    let savedAddresses = JSON.parse(localStorage.getItem('savedAddresses') || '[]');
    const savedAddressesContainer = document.getElementById('savedAddressesContainer');
    const savedAddressesSelect = document.getElementById('savedAddresses');
    const saveAddressCheckbox = document.getElementById('saveAddress');
    const form = document.getElementById('checkoutForm');
    if(savedAddresses.length > 0) {
        savedAddressesContainer.classList.remove('hidden');
        savedAddressesSelect.innerHTML = '';
        savedAddresses.forEach((addr, idx) => {
            savedAddressesSelect.innerHTML += `<option value="${idx}">${addr.first_name} ${addr.last_name}, ${addr.email}, ${addr.phone}</option>`;
        });
        savedAddressesSelect.addEventListener('change', function() {
            const addr = savedAddresses[this.value];
            if(addr) {
                document.getElementById('checkoutEmail').value = addr.email;
                document.getElementById('checkoutPhone').value = addr.phone;
                document.getElementById('checkoutFirstName').value = addr.first_name;
                document.getElementById('checkoutLastName').value = addr.last_name;
                document.getElementById('checkoutCompany').value = addr.company;
                document.getElementById('checkoutCountry').value = addr.country;
            }
        });
    }
    form.addEventListener('submit', function(e) {
        if(saveAddressCheckbox.checked) {
            const addr = {
                email: document.getElementById('checkoutEmail').value,
                phone: document.getElementById('checkoutPhone').value,
                first_name: document.getElementById('checkoutFirstName').value,
                last_name: document.getElementById('checkoutLastName').value,
                company: document.getElementById('checkoutCompany').value,
                country: document.getElementById('checkoutCountry').value
            };
            if(!savedAddresses.some(a => a.email === addr.email && a.phone === addr.phone)) {
                savedAddresses.push(addr);
                localStorage.setItem('savedAddresses', JSON.stringify(savedAddresses));
            }
        }
    });
});
// Pay Now popup logic
    document.querySelectorAll('.bg-gradient-to-r.from-orange-500').forEach(function(btn){
        btn.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById('paymentSuccessPopup').classList.remove('hidden');
        });
    });
    document.getElementById('closeSuccessPopup').onclick = function() {
        document.getElementById('paymentSuccessPopup').classList.add('hidden');
    };

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