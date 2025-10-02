<div x-data="{ activeTab: 'profile' }">
    <!-- Settings Tabs -->
    <div class="border-b border-gray-200 px-8 pt-6">
        <nav class="-mb-px flex space-x-8">
            <button @click="activeTab = 'profile'" 
                    :class="activeTab === 'profile' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Profil
            </button>
            <button @click="activeTab = 'security'" 
                    :class="activeTab === 'security' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Bezpieczeństwo
            </button>
        </nav>
    </div>
    
    <!-- Profile Tab -->
    <div x-show="activeTab === 'profile'">
        <form wire:submit="updateProfileInformation" class="p-8">
            <!-- Profile Header -->
            <div class="text-center mb-8">
                <div class="relative inline-block">
                    @if($currentAvatar)
                        <img src="{{ Storage::url($currentAvatar) }}" 
                             alt="Avatar" 
                             class="w-24 h-24 rounded-full object-cover border-4 border-orange-200 shadow-lg relative z-10">
                        
                        <!-- Remove avatar button -->
                        <button wire:click="removeAvatar" 
                                class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1.5 transition-colors shadow-lg z-20"
                                title="Usuń zdjęcie">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @else
                        <!-- Standardowy pomarańczowy avatar jak w mainpage -->
                        <div class="w-24 h-24 rounded-full bg-orange-100 border-4 border-orange-200 flex items-center justify-center shadow-lg relative z-10">
                            <span class="text-orange-600 font-semibold text-2xl">
                                {{ substr($name ?? 'U', 0, 2) }}
                            </span>
                        </div>
                    @endif
                    
                    <!-- Camera upload button -->
                    <label for="avatar" class="absolute -bottom-2 -right-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 cursor-pointer transition-colors shadow-lg z-20 border-2 border-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </label>
                    <input type="file" id="avatar" wire:model="avatar" class="hidden" accept="image/*">
                    
                    <!-- Loading indicator -->
                    <div wire:loading wire:target="avatar" class="absolute inset-0 bg-white bg-opacity-75 rounded-full flex items-center justify-center z-30">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500"></div>
                    </div>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mt-4">{{ $name ?? 'Użytkownik' }}</h2>
                <p class="text-gray-600">{{ $email ?? 'user@example.com' }}</p>
                
                <!-- Upload status messages -->
                @if (session()->has('message'))
                    <div class="mt-2 text-sm text-green-600 bg-green-50 px-3 py-2 rounded-lg">
                        ✅ {{ session('message') }}
                    </div>
                @endif
                
                @if (session()->has('error'))
                    <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                        ❌ {{ session('error') }}
                    </div>
                @endif
                
                @error('avatar')
                    <div class="mt-2 text-sm text-red-600 bg-red-50 px-3 py-2 rounded-lg">
                        ❌ {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Personal Information -->
            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Dane osobowe</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Imię i nazwisko</label>
                        <input type="text" 
                               id="name" 
                               wire:model="name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors @error('name') border-red-500 @enderror"
                               placeholder="Wprowadź imię i nazwisko"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" 
                               id="email" 
                               wire:model="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors @error('email') border-red-500 @enderror"
                               placeholder="Wprowadź email"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Profile Info -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Account Info -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informacje o koncie</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Data rejestracji</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->created_at->format('d.m.Y') }}</p>
                            </div>
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Ostatnie logowanie</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Status konta</p>
                                <p class="text-xs text-gray-500">Aktywne</p>
                            </div>
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statystyki</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Utworzone projekty</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->projects()->count() }} projektów</p>
                            </div>
                            <div class="text-orange-600 font-bold">{{ auth()->user()->projects()->count() }}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Aktywność w tym miesiącu</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->activityLogs()->whereMonth('created_at', now()->month)->count() }} działań</p>
                            </div>
                            <div class="text-blue-600 font-bold">{{ auth()->user()->activityLogs()->whereMonth('created_at', now()->month)->count() }}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Poziom użytkownika</p>
                                <p class="text-xs text-gray-500">Członek</p>
                            </div>
                            <div class="text-purple-600 font-bold">⭐</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-r from-orange-50 to-blue-50 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Szybkie akcje</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <button @click="activeTab = 'security'" class="bg-white hover:bg-gray-50 rounded-lg p-4 text-center transition-colors border border-gray-200">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-900">Bezpieczeństwo</p>
                        <p class="text-xs text-gray-500">Hasło, 2FA</p>
                    </button>
                    
                    <button @click="alert('Funkcja w trakcie rozwoju...')" class="bg-white hover:bg-gray-50 rounded-lg p-4 text-center transition-colors border border-gray-200">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12 7H4.828z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-900">Historia</p>
                        <p class="text-xs text-gray-500">Aktywności</p>
                    </button>
                    
                    <button @click="alert('Eksportowanie danych...')" class="bg-white hover:bg-gray-50 rounded-lg p-4 text-center transition-colors border border-gray-200">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-900">Eksport danych</p>
                        <p class="text-xs text-gray-500">Pobierz pliki</p>
                    </button>
                </div>
            </div>

            <!-- Email Verification -->
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-yellow-800">Email niezweryfikowany</h3>
                            <p class="text-sm text-yellow-700 mt-1">
                                Twój adres email nie został zweryfikowany. 
                                <button type="button" 
                                        wire:click="resendVerificationNotification"
                                        class="text-orange-600 hover:text-orange-500 font-medium underline">
                                    Kliknij tutaj, aby wysłać ponownie email weryfikacyjny.
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="text-sm text-green-700 font-medium mt-2">
                                    Nowy link weryfikacyjny został wysłany na Twój adres email.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-4">
                    <button type="submit" 
                            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-xl font-medium transition-colors shadow-lg hover:shadow-xl">
                        <span wire:loading.remove wire:target="updateProfileInformation">
                            Zapisz zmiany
                        </span>
                        <span wire:loading wire:target="updateProfileInformation" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Zapisywanie...
                        </span>
                    </button>
                    
                    <button type="button" 
                            class="text-gray-500 hover:text-gray-700 px-4 py-3 rounded-xl font-medium transition-colors">
                        Anuluj
                    </button>
                </div>

                <!-- Success Message -->
                <div x-data="{ show: @entangle('$wire.showSuccessMessage') }" 
                     x-show="show" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="flex items-center text-green-600 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Zmiany zostały zapisane!
                </div>
            </div>
        </form>
    </div>

    <!-- Security Tab -->
    <div x-show="activeTab === 'security'" class="p-8">
        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Bezpieczeństwo</h3>
        
        <div class="space-y-6">
            <!-- Password Change -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Zmiana hasła</h4>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aktualne hasło</label>
                        <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Wprowadź aktualne hasło">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nowe hasło</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Wprowadź nowe hasło">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Potwierdź hasło</label>
                            <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Potwierdź nowe hasło">
                        </div>
                    </div>
                </div>
                <button onclick="changePassword()" class="mt-4 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Zmień hasło
                </button>
            </div>

            <!-- Email Change -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Zmiana adresu email</h4>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nowy adres email</label>
                        <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Wprowadź nowy email">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aktualne hasło</label>
                        <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Potwierdź hasłem">
                    </div>
                </div>
                <button onclick="changeEmail()" class="mt-4 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Zmień email
                </button>
            </div>

            <!-- Two-Factor Authentication -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Weryfikacja dwuetapowa</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Aplikacja uwierzytelniająca</p>
                                <p class="text-xs text-gray-500">Google Authenticator, Authy</p>
                            </div>
                        </div>
                        <button onclick="toggle2FA('app')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                            Włącz
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Kody SMS</p>
                                <p class="text-xs text-gray-500">Weryfikacja przez SMS</p>
                            </div>
                        </div>
                        <button onclick="toggle2FA('sms')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                            Włącz
                        </button>
                    </div>
                </div>
            </div>

            <!-- Login History -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Historia logowań</h4>
                <p class="text-sm text-gray-600 mb-4">Ostatnie logowania do Twojego konta</p>
                <div class="space-y-3 max-h-64 overflow-y-auto" id="login-history">
                    <!-- Login history will be populated by JavaScript -->
                </div>
            </div>

            <!-- Security Settings -->
            <div class="bg-gray-50 rounded-xl p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Ustawienia bezpieczeństwa</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Automatyczne wylogowanie</p>
                            <p class="text-xs text-gray-500">Wyloguj po 30 minutach nieaktywności</p>
                        </div>
                        <button onclick="toggleSecuritySetting('auto_logout')" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Włączone
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Powiadomienia o logowaniu</p>
                            <p class="text-xs text-gray-500">Email o nowych logowaniach</p>
                        </div>
                        <button onclick="toggleSecuritySetting('login_notifications')" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Włączone
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Blokada konta</p>
                            <p class="text-xs text-gray-500">Po 5 nieudanych próbach logowania</p>
                        </div>
                        <button onclick="toggleSecuritySetting('account_lockout')" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Włączone
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Security functions
    function changePassword() {
        console.log('Zmiana hasła...');
    }
    
    function changeEmail() {
        console.log('Zmiana email...');
    }
    
    function toggle2FA(type) {
        console.log('Przełączanie 2FA:', type);
    }
    
    function toggleSecuritySetting(setting) {
        console.log('Przełączanie ustawienia:', setting);
    }
    
    // Generate login history
    function generateLoginHistory() {
        const historyContainer = document.getElementById('login-history');
        if (!historyContainer) return;
        
        const devices = [
            { name: 'Chrome na Windows', icon: '🌐', status: 'active' },
            { name: 'Safari na iPhone', icon: '📱', status: 'active' },
            { name: 'Firefox na macOS', icon: '🦊', status: 'inactive' },
            { name: 'Edge na Windows', icon: '🌐', status: 'inactive' },
            { name: 'Chrome na Android', icon: '📱', status: 'active' }
        ];
        
        const times = [
            '2 minuty temu',
            '1 godzinę temu', 
            '3 godziny temu',
            'Wczoraj',
            '2 dni temu'
        ];
        
        const locations = [
            'Warszawa, Polska',
            'Kraków, Polska',
            'Gdańsk, Polska',
            'Wrocław, Polska',
            'Poznań, Polska'
        ];
        
        historyContainer.innerHTML = devices.map((device, index) => `
            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">${device.icon}</span>
                    <div>
                        <p class="text-sm font-medium text-gray-900">${device.name}</p>
                        <p class="text-xs text-gray-500">${times[index]} • ${locations[index]}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full ${device.status === 'active' ? 'bg-green-500' : 'bg-gray-400'}"></span>
                    <span class="text-xs text-gray-500">${device.status === 'active' ? 'Aktywne' : 'Nieaktywne'}</span>
                </div>
            </div>
        `).join('');
    }
    
    // Initialize login history when page loads
    document.addEventListener('DOMContentLoaded', generateLoginHistory);
    
    // Fix camera button positioning
    function fixCameraButton() {
        const cameraButton = document.querySelector('label[for="avatar"]');
        if (cameraButton) {
            cameraButton.style.position = 'absolute';
            cameraButton.style.bottom = '-8px';
            cameraButton.style.right = '-8px';
            cameraButton.style.zIndex = '20';
            cameraButton.style.backgroundColor = '#f97316';
            cameraButton.style.border = '2px solid white';
            cameraButton.style.borderRadius = '50%';
            cameraButton.style.padding = '8px';
            cameraButton.style.cursor = 'pointer';
            cameraButton.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
            cameraButton.style.transition = 'all 0.3s ease';
        }
    }
    
    // Apply fix when page loads
    document.addEventListener('DOMContentLoaded', fixCameraButton);
    
    // Apply fix when Livewire updates
    document.addEventListener('livewire:updated', fixCameraButton);
</script>