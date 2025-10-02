<div>
    <!-- AI Assistant Button -->
    <div class="fixed bottom-6 right-6 z-50">
        @if(!$isOpen)
            <button wire:click="toggleChat" 
                    class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-full p-4 shadow-2xl transform hover:scale-110 transition-all duration-300 group relative">
                <!-- Simple Robot Icon -->
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M21 9V7H15L13.5 7.5C13.1 7.2 12.6 7 12 7S10.9 7.2 10.5 7.5L9 7H3V9H1V11H3V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V11H23V9H21M19 19H5V9H8.2L9.7 8.5C10.1 8.8 10.6 9 11 9H13C13.4 9 13.9 8.8 14.3 8.5L15.8 9H19V19M9 11C7.9 11 7 11.9 7 13S7.9 15 9 15 11 14.1 11 13 10.1 11 9 11M15 11C13.9 11 13 11.9 13 13S13.9 15 15 15 17 14.1 17 13 16.1 11 15 11M12 16C10.7 16 9.6 16.6 9.1 17.5H14.9C14.4 16.6 13.3 16 12 16Z"/>
                </svg>
                
                <!-- Chat bubble tooltip -->
                <div x-data="{ 
                    messages: [
                        'Masz pytania? Zapytaj mnie! 💬',
                        'Potrzebujesz pomocy? Jestem tutaj! 🤖',
                        'Chcesz poznać nasze usługi? 🎨',
                        'Mogę pomóc z kreowaniem etykiet! ✨',
                        'Sprawdź nasz cennik lub zadaj pytanie! 💰'
                    ],
                    currentMessage: 0,
                    showBubble: false
                }"
                x-init="
                    setInterval(() => {
                        if (!$wire.isOpen) {
                            showBubble = true;
                            setTimeout(() => showBubble = false, 4000);
                            currentMessage = (currentMessage + 1) % messages.length;
                        }
                    }, 300000); // 5 minut
                    
                    // Pokaż pierwszy raz po 10 sekundach
                    setTimeout(() => {
                        if (!$wire.isOpen) {
                            showBubble = true;
                            setTimeout(() => showBubble = false, 4000);
                        }
                    }, 10000);
                "
                class="absolute bottom-full right-0 mb-4">
                    <div x-show="showBubble && !$wire.isOpen"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                         class="bg-white rounded-2xl shadow-xl border border-gray-200 p-3 max-w-xs relative">
                        <p class="text-gray-800 text-sm font-medium" x-text="messages[currentMessage]"></p>
                        <!-- Speech bubble arrow -->
                        <div class="absolute top-full right-6 w-0 h-0 border-l-4 border-r-4 border-t-8 border-transparent border-t-white"></div>
                        <div class="absolute top-full right-6 w-0 h-0 border-l-4 border-r-4 border-t-8 border-transparent border-t-gray-200" style="margin-top: 1px;"></div>
                    </div>
                </div>
            </button>
        @endif
    </div>

    <!-- Chat Window -->
    @if($isOpen)
        <div class="fixed bottom-6 right-6 z-50 w-96 h-[500px] bg-white rounded-2xl shadow-2xl border border-gray-200 flex flex-col overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4 flex items-center justify-between relative overflow-hidden">
                <!-- Background decoration -->
                <div class="absolute inset-0 bg-white bg-opacity-10"></div>
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-white bg-opacity-10 rounded-full"></div>
                <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-white bg-opacity-5 rounded-full"></div>
                
                <div class="flex items-center space-x-3 relative z-10">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white border-opacity-30">
                        <!-- Simple Robot Icon -->
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M21 9V7H15L13.5 7.5C13.1 7.2 12.6 7 12 7S10.9 7.2 10.5 7.5L9 7H3V9H1V11H3V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V11H23V9H21M19 19H5V9H8.2L9.7 8.5C10.1 8.8 10.6 9 11 9H13C13.4 9 13.9 8.8 14.3 8.5L15.8 9H19V19M9 11C7.9 11 7 11.9 7 13S7.9 15 9 15 11 14.1 11 13 10.1 11 9 11M15 11C13.9 11 13 11.9 13 13S13.9 15 15 15 17 14.1 17 13 16.1 11 15 11M12 16C10.7 16 9.6 16.6 9.1 17.5H14.9C14.4 16.6 13.3 16 12 16Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Asystent AI</h3>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <p class="text-white text-opacity-90 text-sm font-medium">Online • Custom Labels</p>
                        </div>
                    </div>
                </div>
                <button wire:click="toggleChat" class="text-white hover:text-gray-200 transition-colors relative z-10 p-1 rounded-full hover:bg-white hover:bg-opacity-20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50" id="chat-messages">
                @foreach($messages as $message)
                    <div class="flex {{ $message['type'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs lg:max-w-md">
                            @if($message['type'] === 'bot')
                                <div class="flex items-start space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-md border-2 border-white">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 11C7.9 11 7 11.9 7 13S7.9 15 9 15 11 14.1 11 13 10.1 11 9 11M15 11C13.9 11 13 11.9 13 13S13.9 15 15 15 17 14.1 17 13 16.1 11 15 11M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M5 9H19C20.1 9 21 9.9 21 11V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V11C3 9.9 3.9 9 5 9M12 16C10.7 16 9.6 16.6 9.1 17.5H14.9C14.4 16.6 13.3 16 12 16Z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="bg-white rounded-2xl rounded-tl-sm p-3 shadow-sm border">
                                            <p class="text-gray-800 text-sm">{!! $message['message'] !!}</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 ml-2">{{ $message['time'] }}</p>
                                        
                                        @if(isset($message['actions']) && count($message['actions']) > 0)
                                            <div class="mt-2 space-y-1">
                                                @foreach($message['actions'] as $action)
                                                    @if(isset($action['url']))
                                                        <a href="{{ $action['url'] }}" 
                                                           class="inline-block bg-orange-100 hover:bg-orange-200 text-orange-700 text-xs px-3 py-1 rounded-full transition-colors mr-1 mb-1">
                                                            {{ $action['text'] }}
                                                        </a>
                                                    @else
                                                        <button wire:click="executeAction('{{ $action['action'] }}')"
                                                                class="inline-block bg-orange-100 hover:bg-orange-200 text-orange-700 text-xs px-3 py-1 rounded-full transition-colors mr-1 mb-1">
                                                            {{ $action['text'] }}
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="flex items-start space-x-2 justify-end">
                                    <div>
                                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl rounded-tr-sm p-3 shadow-md">
                                            <p class="text-sm font-medium">{{ $message['message'] }}</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 text-right mr-2">{{ $message['time'] }}</p>
                                    </div>
                                    <div class="w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center flex-shrink-0 shadow-md border-2 border-white">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if($isTyping)
                    <div class="flex justify-start">
                        <div class="max-w-xs lg:max-w-md">
                            <div class="flex items-start space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-md border-2 border-white">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 11C7.9 11 7 11.9 7 13S7.9 15 9 15 11 14.1 11 13 10.1 11 9 11M15 11C13.9 11 13 11.9 13 13S13.9 15 15 15 17 14.1 17 13 16.1 11 15 11M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M5 9H19C20.1 9 21 9.9 21 11V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V11C3 9.9 3.9 9 5 9M12 16C10.7 16 9.6 16.6 9.1 17.5H14.9C14.4 16.6 13.3 16 12 16Z"/>
                                    </svg>
                                </div>
                                <div class="bg-white rounded-2xl rounded-tl-sm p-3 shadow-sm border">
                                    <div class="flex space-x-1">
                                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Input -->
            <div class="p-4 bg-white border-t border-gray-200">
                <form wire:submit.prevent="sendMessage" class="flex space-x-2">
                    <input type="text" 
                           wire:model="currentMessage" 
                           placeholder="Napisz wiadomość..."
                           class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm"
                           wire:keydown.enter="sendMessage">
                    <button type="submit" 
                            class="bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 transition-colors disabled:opacity-50"
                            wire:loading.attr="disabled">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-2 text-center">Powered by Custom Labels AI</p>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('scroll-to-bottom', () => {
                setTimeout(() => {
                    const chatMessages = document.getElementById('chat-messages');
                    if (chatMessages) {
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }, 100);
            });

            Livewire.on('scroll-to-element', (selector) => {
                setTimeout(() => {
                    const element = document.querySelector(selector);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }, 500);
            });
        });
    </script>
</div>