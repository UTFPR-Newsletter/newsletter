<div>
    <x-ts-modal
        title="Cadastro de Categoria"
        wire="categoryModal"
        center
        size="5xl"
    >
        <div>
            <!-- Form Fields -->
            <div class="space-y-4">
                <!-- Nome -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                    <input
                        type="text"
                        id="name"
                        wire:model="categoryForm.name"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                        placeholder="Digite o nome da categoria"
                    >
                </div>

                <!-- Descrição -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                    <textarea
                        id="description"
                        wire:model="categoryForm.description"
                        rows="3"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                        placeholder="Digite uma descrição para a categoria"
                    ></textarea>
                </div>
            </div>

            <x-slot:footer>
                <div class="w-full flex justify-between items-center">
                    <span class="text-sm text-black/40">Área de Gerenciamento</span>
                    <div class="flex items-center space-x-2">
                        <button
                            wire:click="$set('categoryModal', false)"
                            class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 hover:cursor-pointer transition-colors duration-200"
                        >
                            <i class="fad fa-times mr-2"></i>
                            Cancelar
                        </button>
                        <button
                            wire:click="submitFormCategory"
                            wire:loading.attr="disabled"
                            wire:target="submitFormCategory"
                            class="flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <i class="fad fa-save mr-2" wire:loading.remove wire:target="submitFormCategory"></i>
                            <i class="fad fa-spinner-third fa-spin mr-2" wire:loading wire:target="submitFormCategory"></i>
                            <span wire:loading.remove wire:target="submitFormCategory">Salvar</span>
                            <span wire:loading wire:target="submitFormCategory">Processando...</span>
                        </button>
                    </div>
                </div>
            </x-slot:footer>
        </div>
    </x-ts-modal>

    <!-- Search and Actions -->
    <div class="p-4 border-b border-gray-200 bg-white">
        <div class="flex items-center justify-between">
            <!-- Search -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fad fa-search text-gray-400"></i>
                    </div>
                    <input 
                        type="text" 
                        wire:model.live="search" 
                        class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-400" 
                        placeholder="Buscar..."
                    >
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-2">
                <button class="px-3 py-2 text-sm bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200 hover:cursor-pointer transition-colors duration-200">
                    <i class="fad fa-sort mr-2"></i>
                    Ordenar
                </button>
                <button 
                    wire:click="showInsertModal"
                    class="px-3 py-2 text-sm bg-gray-800 text-white rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200 flex items-center disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled"
                    wire:target="showInsertModal"
                >
                    <i class="fad fa-plus mr-2" wire:loading.remove wire:target="showInsertModal"></i>
                    <i class="fad fa-spinner-third fa-spin mr-2" wire:loading wire:target="showInsertModal"></i>
                    <span wire:loading.remove wire:target="showInsertModal">Adicionar Novo</span>
                    <span wire:loading wire:target="showInsertModal">Processando...</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registros</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-gray-200 flex items-center justify-center mr-3">
                                <i class="fad fa-tags text-gray-800"></i>
                            </div>
                            <div class="text-sm font-medium text-gray-900">{{ $category->cat_name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-left whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            @if(empty($category->cat_description))
                                <span class="italic text-gray-400">
                                    <i class="fad fa-info-circle mr-1 text-xs"></i>
                                    Sem descrição definida
                                </span>
                            @else
                                {{ $category->cat_description }}
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-left whitespace-nowrap text-sm text-gray-500">
                        {{ $category->newsletters->count() ?? 0 }} newsletters
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="w-full flex flex-row items-end justify-end">
                            <button 
                                wire:click="edit({{ $category->cat_id }})"
                                class="text-blue-600 hover:text-white mx-1 hover:cursor-pointer bg-blue-50 hover:bg-blue-600 p-2 rounded-lg transition-colors duration-200 flex items-center"
                                wire:loading.attr="disabled"
                                wire:target="edit({{ $category->cat_id }})"
                            >
                                <i class="fad fa-edit" wire:loading.remove wire:target="edit({{ $category->cat_id }})"></i>
                                <i class="fad fa-spinner-third fa-spin" wire:loading wire:target="edit({{ $category->cat_id }})"></i>
                            </button>
                            <button 
                                wire:click="delete({{ $category->cat_id }})"
                                class="text-red-600 hover:text-white mx-1 hover:cursor-pointer bg-red-50 hover:bg-red-600 p-2 rounded-lg transition-colors duration-200 flex items-center disabled:opacity-50 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled"
                                wire:target="delete({{ $category->cat_id }})"
                            >
                                <i class="fad fa-trash-alt" wire:loading.remove wire:target="delete({{ $category->cat_id }})"></i>
                                <i class="fad fa-spinner-third fa-spin" wire:loading wire:target="delete({{ $category->cat_id }})"></i>
                            </button>
                        </div>
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

    <!-- Pagination (Visual Only) -->
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex items-center justify-between">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Mostrando
                        <span class="font-medium">1</span>
                        até
                        <span class="font-medium">{{ count($categories) }}</span>
                        de
                        <span class="font-medium">{{ count($categories) }}</span>
                        resultados
                    </p>
                </div>
                <div>
                    <!-- Visual Pagination -->
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Anterior</span>
                            <i class="fad fa-chevron-left h-5 w-5"></i>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            1
                        </a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-gray-100 text-sm font-medium text-gray-700">
                            2
                        </span>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            3
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Próximo</span>
                            <i class="fad fa-chevron-right h-5 w-5"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div> 