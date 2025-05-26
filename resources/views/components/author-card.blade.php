@props(['image', 'name', 'description', 'badges' => []])

<div class="bg-gray-100 rounded-lg p-6 pt-0 shadow-md hover:shadow-lg text-left transition-all duration-200 hover:scale-[1.03] transform w-full h-full flex flex-col">
    <div class="flex flex-col items-start flex-grow">
        <div class="flex flex-row justify-between w-full">
            <div class="bg-white rounded-lg p-4 shadow-sm mb-4 mt-6 flex justify-between w-40">
                @if($image)
                    <img src="{{ $image }}" alt="Author" class="w-32 h-32 object-cover rounded" />
                @else
                    <div class="w-32 h-32 bg-gray-200 rounded flex items-center justify-center">
                        <i class="fad fa-user text-4xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            <img src="{{ asset('images/spider_going_down.png') }}" alt="Spider" class="w-32 h-32 object-contain" />
        </div>
        <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $name }}</h3>
        <p class="text-gray-600 text-left mb-4">{!! $description !!}</p>
        
        <!-- Badges -->
        @if(count($badges) > 0)
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($badges as $badge)
                    <span class="px-3 py-1 bg-gray-800 text-white text-xs font-semibold rounded-full">
                        {{ $badge }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Button -->
    <button class="w-full mt-auto bg-white text-gray-800 hover:cursor-pointer hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center">
        <i class="fad fa-book-spells mr-2"></i>
        Ver Newsletters
    </button>
</div> 