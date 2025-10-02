<div>
    @if($showSuccess)
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ __('messages.contact.form.success') }}</span>
                <button wire:click="hideSuccess" class="ml-auto text-green-500 hover:text-green-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <form wire:submit="submit" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input type="text" wire:model="firstName" placeholder="{{ __('messages.contact.form.fields.first_name') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors text-sm @error('firstName') border-red-500 @enderror">
                @error('firstName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <input type="text" wire:model="lastName" placeholder="{{ __('messages.contact.form.fields.last_name') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors text-sm @error('lastName') border-red-500 @enderror">
                @error('lastName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <input type="email" wire:model="email" placeholder="{{ __('messages.contact.form.fields.email') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors text-sm @error('email') border-red-500 @enderror">
            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <input type="tel" wire:model="phone" placeholder="{{ __('messages.contact.form.fields.phone') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors text-sm">
        </div>

        <div>
            <select wire:model="subject" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors text-sm @error('subject') border-red-500 @enderror">
                <option value="">{{ __('messages.contact.form.fields.subject') }}</option>
                <option value="Wycena projektu">{{ __('messages.contact.form.subjects.quote') }}</option>
                <option value="Pytanie techniczne">{{ __('messages.contact.form.subjects.technical') }}</option>
                <option value="Materiały i opcje">{{ __('messages.contact.form.subjects.materials') }}</option>
                <option value="Inne">{{ __('messages.contact.form.subjects.other') }}</option>
            </select>
            @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <textarea rows="4" wire:model="message" placeholder="{{ __('messages.contact.form.fields.message') }}" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors resize-none text-sm @error('message') border-red-500 @enderror"></textarea>
            @error('message') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-start">
            <input type="checkbox" wire:model="consent" class="mt-1 h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded @error('consent') border-red-500 @enderror">
            <label class="ml-2 text-xs text-gray-600">
                {{ __('messages.contact.form.fields.consent') }}
            </label>
        </div>
        @error('consent') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

        <button type="submit" 
                wire:loading.attr="disabled"
                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
            <span wire:loading.remove>📧 {{ __('messages.contact.form.button') }}</span>
            <span wire:loading>
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Wysyłanie...
            </span>
        </button>
    </form>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('hide-success-message', () => {
                setTimeout(() => {
                    Livewire.dispatch('hideSuccess');
                }, 5000);
            });
        });
    </script>
</div>