<x-layouts.app>
    <x-slot name="title">Ustawienia Profilu - Custom Labels</x-slot>
    
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Ustawienia Profilu</h1>
                <p class="text-gray-600">Zarządzaj swoimi danymi osobowymi i ustawieniami konta</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl border border-orange-100 overflow-hidden">
                <livewire:settings.profile />
            </div>
        </div>
    </div>
</x-layouts.app>
