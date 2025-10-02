<x-layouts.app>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                @if($success)
                    <div class="mx-auto h-12 w-12 text-green-600">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 48 48" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Wypisano z newslettera
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Zostałeś pomyślnie wypisany z naszego newslettera. 
                        Nie będziesz już otrzymywać od nas wiadomości email.
                    </p>
                    <p class="mt-4 text-sm text-gray-500">
                        Jeśli zmienisz zdanie, zawsze możesz zapisać się ponownie na naszej stronie głównej.
                    </p>
                @else
                    <div class="mx-auto h-12 w-12 text-red-600">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 48 48" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Błąd wypisywania
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Nie udało się wypisać z newslettera. Link może być nieprawidłowy lub wygasły.
                    </p>
                    <p class="mt-4 text-sm text-gray-500">
                        Jeśli problem będzie się powtarzał, skontaktuj się z nami: CustomLabelHelps@gmail.com
                    </p>
                @endif
                
                <div class="mt-8">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Wróć na stronę główną
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
