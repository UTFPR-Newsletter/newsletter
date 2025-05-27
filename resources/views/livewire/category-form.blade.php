<div class="p-4">
    <!-- Search and Actions -->
    <div class="flex items-center justify-between mb-6">
        <!-- Search -->
        <div class="flex-1 max-w-md">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fad fa-search text-gray-400"></i>
                </div>
                <input
                    wire:model.live="search"
                    type="text"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-400" 
                    placeholder="Buscar categorias..."
                >
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center space-x-2">
            <button class="px-3 py-2 text-sm bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200 hover:cursor-pointer transition-colors duration-200">
                <i class="fad fa-filter mr-2"></i>
                Filtros
            </button>
            <button 
                wire:click="openModal"
                class="px-3 py-2 text-sm bg-gray-800 text-white rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200 flex items-center"
            >
                <i class="fad fa-plus mr-2"></i>
                Nova Categoria
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left">
                        <div class="flex items-center">
                            <button wire:click="sortBy('cat_name')" class="group inline-flex">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</span>
                                <span class="ml-2 flex-none rounded text-gray-400">
                                    @if($sortField === 'cat_name')
                                        <i class="fad fa-sort-{{ $sortDirection }}" aria-hidden="true"></i>
                                    @else
                                        <i class="fad fa-sort" aria-hidden="true"></i>
                                    @endif
                                </span>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        <div class="flex items-center">
                            <button wire:click="sortBy('cat_description')" class="group inline-flex">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</span>
                                <span class="ml-2 flex-none rounded text-gray-400">
                                    @if($sortField === 'cat_description')
                                        <i class="fad fa-sort-{{ $sortDirection }}" aria-hidden="true"></i>
                                    @else
                                        <i class="fad fa-sort" aria-hidden="true"></i>
                                    @endif
                                </span>
                            </button>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registros</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($filteredCategories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-gray-200 flex items-center justify-center mr-3">
                                    <i class="fad fa-tags text-gray-800"></i>
                                </div>
                                <div class="text-sm font-medium text-gray-900">{{ $category['cat_name'] }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-left">
                            <div class="text-sm text-gray-500">{{ $category['cat_description'] }}</div>
                        </td>
                        <td class="px-6 py-4 text-left whitespace-nowrap text-sm text-gray-500">
                            {{ count($category['newsletters'] ?? []) }} newsletters
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button 
                                wire:click="openModal({{ $category['cat_id'] }})"
                                class="text-blue-600 hover:text-blue-800 mx-1 hover:cursor-pointer bg-blue-50 p-2 rounded-lg"
                            >
                                <i class="fad fa-edit"></i>
                            </button>
                            <button 
                                wire:click="delete({{ $category['cat_id'] }})"
                                class="text-red-600 hover:text-red-800 mx-1 hover:cursor-pointer bg-red-50 p-2 rounded-lg"
                            >
                                <i class="fad fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Nenhuma categoria encontrada
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 mt-4 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div class="flex-1 flex justify-between sm:hidden">
                <button wire:click="previousPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Anterior
                </button>
                <button wire:click="nextPage" wire:loading.attr="disabled" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Próxima
                </button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Mostrando
                        <span class="font-medium">{{ $filteredCategories->count() }}</span>
                        de
                        <span class="font-medium">{{ $totalResults }}</span>
                        resultados
                    </p>
                </div>
                <div>
                    {{ $filteredCategories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
