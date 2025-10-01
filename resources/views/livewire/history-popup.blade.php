<div>
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold text-gray-900">Historia Działań</h3>
        <button wire:click="close" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    
    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-2 mb-6 bg-gray-100 rounded-lg p-1">
        <button wire:click="setFilter('all')" 
                class="flex-1 min-w-[120px] px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $activeFilter === 'all' ? 'text-orange-600 bg-white shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            Wszystko
        </button>
        <button wire:click="setFilter('login')" 
                class="flex-1 min-w-[120px] px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $activeFilter === 'login' ? 'text-orange-600 bg-white shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            Logowanie
        </button>
        <button wire:click="setFilter('label_created')" 
                class="flex-1 min-w-[120px] px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $activeFilter === 'label_created' ? 'text-orange-600 bg-white shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            Etykiety
        </button>
        <button wire:click="setFilter('project_created')" 
                class="flex-1 min-w-[120px] px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $activeFilter === 'project_created' ? 'text-orange-600 bg-white shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            Projekty
        </button>
    </div>

    <!-- History Items -->
    <div class="space-y-3 max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        @if($loading)
            <div class="text-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500 mx-auto"></div>
                <p class="text-gray-500 mt-2">Ładowanie...</p>
            </div>
        @elseif($activities->count() > 0)
            @foreach($activities as $activity)
                <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-{{ $activity->type_color }}-100 rounded-full flex items-center justify-center">
                            <span class="text-{{ $activity->type_color }}-600 text-sm">{{ $activity->type_icon }}</span>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $activity->title }}</p>
                        @if($activity->description)
                            <p class="text-xs text-gray-600 mt-1">{{ $activity->description }}</p>
                        @endif
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $activity->created_at->diffForHumans() }} • {{ $activity->device_info }}
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <p class="text-gray-500">Brak aktywności do wyświetlenia</p>
                <p class="text-xs text-gray-400 mt-1">Twoje działania pojawią się tutaj</p>
            </div>
        @endif
    </div>
</div>