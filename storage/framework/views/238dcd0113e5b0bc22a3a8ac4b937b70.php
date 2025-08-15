<!-- Footer -->
<footer class="bg-white border-t border-orange-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-amber-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Custom Labels</h3>
                </div>
                <p class="text-gray-600 mb-4 max-w-md">
                    Tworzymy spersonalizowane etykiety najwyższej jakości.
                    Zaprojektuj swoją idealną etykietę w kilku prostych krokach.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-orange-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Szybkie linki</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="<?php echo e(route('home')); ?>" class="text-gray-600 hover:text-orange-600">Kreator etykiet</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-orange-600">Galeria projektów</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-orange-600">Cennik</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-orange-600">FAQ</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Wsparcie</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="text-gray-600 hover:text-orange-600">Pomoc</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-orange-600">Kontakt</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-orange-600">Regulamin</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-orange-600">Polityka prywatności</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-orange-200 mt-8 pt-8 flex flex-col sm:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">
                © <?php echo e(date('Y')); ?> Custom Labels. Wszystkie prawa zastrzeżone.
            </p>
            <div class="mt-4 sm:mt-0 flex space-x-6">
                <span class="text-gray-500 text-sm">Akceptujemy:</span>
                <div class="flex space-x-2">
                    <div class="w-8 h-5 bg-orange-600 rounded text-white text-xs flex items-center justify-center font-bold">VISA</div>
                    <div class="w-8 h-5 bg-red-600 rounded text-white text-xs flex items-center justify-center font-bold">MC</div>
                    <div class="w-8 h-5 bg-yellow-500 rounded text-white text-xs flex items-center justify-center font-bold">PP</div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\custom-label\resources\views/components/layouts/footer.blade.php ENDPATH**/ ?>