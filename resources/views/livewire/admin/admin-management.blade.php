@section('page-title', 'Gestão do Sistema')

<div class="w-full mt-8">
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <!-- Tabs -->
        <div class="bg-gray-50 border-b border-gray-200">
            <div class="flex">
                <button
                    wire:click="switchTab('categories')"
                    class="px-6 py-3 text-sm font-medium hover:cursor-pointer transition-colors duration-200 relative group"
                >
                    <span class="relative">
                        <span class="{{ $currentTab === 'categories' ? 'text-gray-800' : 'text-gray-500 group-hover:text-gray-800' }}">Categorias</span>
                        <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-[calc(100%-1rem)] h-0.5 transition-all duration-200 {{ $currentTab === 'categories' ? 'bg-gray-800' : 'bg-transparent group-hover:bg-gray-400' }}"></span>
                    </span>
                </button>
                <button
                    wire:click="switchTab('authors')"
                    class="px-6 py-3 text-sm font-medium hover:cursor-pointer transition-colors duration-200 relative group"
                >
                    <span class="relative">
                        <span class="{{ $currentTab === 'authors' ? 'text-gray-800' : 'text-gray-500 group-hover:text-gray-800' }}">Autores</span>
                        <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-[calc(100%-1rem)] h-0.5 transition-all duration-200 {{ $currentTab === 'authors' ? 'bg-gray-800' : 'bg-transparent group-hover:bg-gray-400' }}"></span>
                    </span>
                </button>
                <button
                    wire:click="switchTab('subscribers')"
                    class="px-6 py-3 text-sm font-medium hover:cursor-pointer transition-colors duration-200 relative group"
                >
                    <span class="relative">
                        <span class="{{ $currentTab === 'subscribers' ? 'text-gray-800' : 'text-gray-500 group-hover:text-gray-800' }}">Assinantes</span>
                        <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-[calc(100%-1rem)] h-0.5 transition-all duration-200 {{ $currentTab === 'subscribers' ? 'bg-gray-800' : 'bg-transparent group-hover:bg-gray-400' }}"></span>
                    </span>
                </button>
                <button
                    wire:click="switchTab('newsletters')"
                    class="px-6 py-3 text-sm font-medium hover:cursor-pointer transition-colors duration-200 relative group"
                >
                    <span class="relative">
                        <span class="{{ $currentTab === 'newsletters' ? 'text-gray-800' : 'text-gray-500 group-hover:text-gray-800' }}">Newsletters</span>
                        <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-[calc(100%-1rem)] h-0.5 transition-all duration-200 {{ $currentTab === 'newsletters' ? 'bg-gray-800' : 'bg-transparent group-hover:bg-gray-400' }}"></span>
                    </span>
                </button>
            </div>
        </div>

        <!-- Content Area -->
        <div>
            @if($currentTab === 'categories')
                <livewire:admin.category-list />
            @elseif($currentTab === 'authors')
                <livewire:admin.author-list />
            @elseif($currentTab === 'subscribers')
                <livewire:admin.subscriber-list />
            @elseif($currentTab === 'newsletters')
                <livewire:admin.newsletter-list />
            @endif
        </div>
    </div>
</div>