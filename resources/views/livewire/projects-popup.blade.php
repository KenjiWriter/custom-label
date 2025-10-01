<div>
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold text-gray-900">Moje Projekty</h3>
        <button wire:click="close" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        @if($loading)
            <div class="col-span-full text-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500 mx-auto"></div>
                <p class="text-gray-500 mt-2">Ładowanie projektów...</p>
            </div>
        @elseif($projects->count() > 0)
            @foreach($projects as $project)
                <div class="bg-white rounded-xl p-4 border border-gray-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="px-2 py-1 text-xs bg-{{ $project->status_color }}-100 text-{{ $project->status_color }}-800 rounded-full font-medium">
                            {{ $project->status_text }}
                        </span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">{{ $project->name }}</h4>
                    @if($project->description)
                        <p class="text-xs text-gray-600 mb-2">{{ Str::limit($project->description, 50) }}</p>
                    @endif
                    @if($project->material)
                        <p class="text-xs text-gray-600 mb-1">Materiał: {{ $project->material }}</p>
                    @endif
                    @if($project->laminate)
                        <p class="text-xs text-gray-600 mb-2">Laminat: {{ $project->laminate }}</p>
                    @endif
                    <p class="text-xs text-gray-500">{{ $project->updated_at->diffForHumans() }}</p>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <button wire:click="editProject({{ $project->id }})" 
                                class="text-xs bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-md transition-colors flex-1 min-w-0">
                            Edytuj
                        </button>
                        <button wire:click="previewProject({{ $project->id }})" 
                                class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded-md transition-colors flex-1 min-w-0">
                            Podgląd
                        </button>
                        @if($project->status === 'completed')
                            <button wire:click="duplicateProject({{ $project->id }})" 
                                    class="text-xs bg-blue-200 hover:bg-blue-300 text-blue-700 px-3 py-1 rounded-md transition-colors flex-1 min-w-0">
                                Duplikuj
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-span-full text-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-gray-500">Brak projektów</p>
                <p class="text-xs text-gray-400 mt-1">Utwórz swój pierwszy projekt w kreatorze</p>
            </div>
        @endif
    </div>
</div>