<div>
    <form wire:submit.prevent="subscribe" class="flex flex-col sm:flex-row gap-4">
        <input type="email" 
               wire:model="email" 
               placeholder="Twój adres email"
               class="flex-1 px-5 py-4 rounded-xl border-2 border-blue-600 focus:outline-none focus:ring-2 focus:ring-yellow-300 text-gray-800 @error('email') border-red-500 @enderror">
        
        <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-medium px-6 py-4 rounded-xl transition-colors duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="subscribe">Zapisz się</span>
            <span wire:loading wire:target="subscribe">Zapisywanie...</span>
            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </form>
    
    @error('email')
        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
    @enderror
    
    @if($message)
        <p class="text-sm text-center mt-4 {{ $isSubscribed ? 'text-green-300' : 'text-red-400' }}">
            {{ $message }}
        </p>
    @endif
</div>
