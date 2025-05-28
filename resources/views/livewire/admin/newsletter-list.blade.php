<div>
    <x-ts-modal
        title="Cadastro de Newsletter"
        wire="newsletterModal"
        center
        size="5xl"
    >
        <div>
            <!-- Form Fields -->
            <div class="space-y-4">
                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input
                        type="text"
                        id="title"
                        wire:model="newsletterForm.title"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                        placeholder="Digite o título da newsletter"
                    >
                </div>

                <!-- Conteúdo -->
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Conteúdo</label>
                    <textarea
                        id="body"
                        wire:model="newsletterForm.body"
                        rows="5"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                        placeholder="Digite o conteúdo da newsletter"
                    ></textarea>
                </div>

                <!-- Ícone -->
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Ícone</label>
                    <input
                        type="text"
                        id="icon"
                        wire:model="newsletterForm.icon"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                        placeholder="URL do ícone da newsletter"
                    >
                </div>

                <!-- Frequência -->
                <div>
                    <label for="frequency" class="block text-sm font-medium text-gray-700 mb-1">Frequência</label>
                    <select
                        id="frequency"
                        wire:model="newsletterForm.frequency"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                    >
                        @foreach(\App\Models\Newsletter::$frequencyOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Horário -->
                <div>
                    <label for="hour" class="block text-sm font-medium text-gray-700 mb-1">Horário</label>
                    <select
                        id="hour"
                        wire:model="newsletterForm.hour"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                    >
                        @foreach(\App\Models\Newsletter::$hourOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Data Estimada -->
                <div>
                    <label for="estimate_date" class="block text-sm font-medium text-gray-700 mb-1">Data Estimada</label>
                    <input
                        type="date"
                        id="estimate_date"
                        wire:model="newsletterForm.estimate_date"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                    >
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select
                        id="status"
                        wire:model="newsletterForm.status"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm outline-none transition-all focus:border-gray-400 focus:ring-1 focus:ring-gray-400"
                    >
                        @foreach(\App\Models\Newsletter::$statusOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <x-slot:footer>
                <div class="w-full flex justify-between items-center">
                    <span class="text-sm text-black/40">Área de Gerenciamento</span>
                    <div class="flex items-center space-x-2">
                        <button
                            wire:click="$set('newsletterModal', false)"
                            class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 hover:cursor-pointer transition-colors duration-200"
                        >
                            <i class="fad fa-times mr-2"></i>
                            Cancelar
                        </button>
                        <button
                            wire:click="submitFormNewsletter"
                            wire:loading.attr="disabled"
                            wire:target="submitFormNewsletter"
                            class="flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <i class="fad fa-save mr-2" wire:loading.remove wire:target="submitFormNewsletter"></i>
                            <i class="fad fa-spinner-third fa-spin mr-2" wire:loading wire:target="submitFormNewsletter"></i>
                            <span wire:loading.remove wire:target="submitFormNewsletter">Salvar</span>
                            <span wire:loading wire:target="submitFormNewsletter">Processando...</span>
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

    <!-- Newsletters Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Frequência</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horário</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($newsletters as $newsletter)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-gray-200 flex items-center justify-center mr-3">
                                <i class="fad fa-newspaper text-gray-800"></i>
                            </div>
                            <div class="text-sm font-medium text-gray-900">{{ $newsletter->new_title }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-left whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $newsletter->frequencyLabel }}</div>
                    </td>
                    <td class="px-6 py-4 text-left whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $newsletter->new_hour }}</div>
                    </td>
                    <td class="px-6 py-4 text-left whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $newsletter->new_status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $newsletter->statusLabel }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="w-full flex flex-row items-end justify-end">
                            <button
                                wire:click="edit({{ $newsletter->new_id }})"
                                class="text-blue-600 hover:text-white mx-1 hover:cursor-pointer bg-blue-50 hover:bg-blue-600 p-2 rounded-lg transition-colors duration-200 flex items-center"
                                wire:loading.attr="disabled"
                                wire:target="edit({{ $newsletter->new_id }})"
                            >
                                <i class="fad fa-edit" wire:loading.remove wire:target="edit({{ $newsletter->new_id }})"></i>
                                <i class="fad fa-spinner-third fa-spin" wire:loading wire:target="edit({{ $newsletter->new_id }})"></i>
                            </button>
                            <button
                                wire:click="delete({{ $newsletter->new_id }})"
                                class="text-red-600 hover:text-white mx-1 hover:cursor-pointer bg-red-50 hover:bg-red-600 p-2 rounded-lg transition-colors duration-200 flex items-center disabled:opacity-50 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled"
                                wire:target="delete({{ $newsletter->new_id }})"
                            >
                                <i class="fad fa-trash-alt" wire:loading.remove wire:target="delete({{ $newsletter->new_id }})"></i>
                                <i class="fad fa-spinner-third fa-spin" wire:loading wire:target="delete({{ $newsletter->new_id }})"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Nenhuma newsletter encontrada
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex items-center justify-between">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Mostrando
                        <span class="font-medium">1</span>
                        até
                        <span class="font-medium">{{ count($newsletters) }}</span>
                        de
                        <span class="font-medium">{{ count($newsletters) }}</span>
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
