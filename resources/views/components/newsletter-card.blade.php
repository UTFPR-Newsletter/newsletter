@props(['icon', 'title', 'description', 'badges' => [], 'author', 'hour', 'frequency', 'initialSubscribed' => false])

<div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col">
    <div class="p-6 flex-grow">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                @if($icon)
                    <i class="{{ $icon }} text-2xl text-gray-700"></i>
                @else
                    <i class="fad fa-newspaper text-2xl text-gray-700"></i>
                @endif
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">{{ $title }}</h3>
                <p class="text-sm text-gray-500">por {{ $author }}</p>
            </div>
        </div>
        
        <p class="text-gray-600 mb-4">{{ $description }}</p>
        
        <div class="mb-4">
            <div class="flex items-center text-sm text-gray-500 mb-2">
                <i class="fad fa-clock mr-2"></i>
                <span>{{ $frequency }} às {{ $hour }}</span>
            </div>
        </div>
        
        @if(count($badges) > 0)
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($badges as $badge)
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-full">
                        {{ $badge }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
    
    <div class="p-4 bg-gray-50 border-t">
        <button class="w-full bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 transition-colors">
            <i class="fad fa-bell mr-2"></i>
            {{ $initialSubscribed ? 'Inscrito' : 'Inscrever-se' }}
        </button>
    </div>
</div> 