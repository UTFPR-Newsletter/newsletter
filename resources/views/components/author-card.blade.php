@props(['image', 'name', 'description', 'badges' => []])

<div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col">
    <div class="p-6 flex-grow">
        <div class="flex items-center mb-4">
            <div class="w-16 h-16 rounded-full bg-gray-200 overflow-hidden mr-4">
                @if($image)
                    <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-cover" />
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fad fa-user text-2xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">{{ $name }}</h3>
            </div>
        </div>
        
        <p class="text-gray-600 mb-4">{{ $description }}</p>
        
        @if(count($badges) > 0)
            <div class="flex flex-wrap gap-2">
                @foreach($badges as $badge)
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full">
                        {{ $badge }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
</div> 