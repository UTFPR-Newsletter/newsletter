@props(['icon', 'title', 'body'])

<div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 hover:shadow-lg">
    <div class="flex items-center mb-4">
        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
            <i class="{{ $icon }} text-2xl text-gray-700"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-800">{{ $title }}</h3>
    </div>
    <p class="text-gray-600 flex-grow">{{ $body }}</p>
</div> 