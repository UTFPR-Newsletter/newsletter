<!-- Management Grid Component -->
<div class="w-full" x-data="{ activeTab: 'categories' }">
    <!-- Listing Area -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <!-- Tabs -->
        <div class="bg-gray-50 border-b border-gray-200">
            <div class="flex">
                <button 
                    @click="activeTab = 'categories'"
                    :class="{ 'text-gray-800 border-b-2 border-gray-800 bg-white': activeTab === 'categories', 'text-gray-500 hover:text-gray-800 hover:bg-gray-100': activeTab !== 'categories' }"
                    class="px-6 py-3 text-sm font-medium hover:cursor-pointer transition-colors duration-200">
                    Categorias
                </button>
                <button 
                    @click="activeTab = 'topics'"
                    :class="{ 'text-gray-800 border-b-2 border-gray-800 bg-white': activeTab === 'topics', 'text-gray-500 hover:text-gray-800 hover:bg-gray-100': activeTab !== 'topics' }"
                    class="px-6 py-3 text-sm font-medium hover:cursor-pointer transition-colors duration-200">
                    Tópicos
                </button>
            </div>
        </div>

        <!-- Search and Actions -->
        <div class="p-4 border-b border-gray-200 bg-white">
            <div class="flex items-center justify-between">
                <!-- Search -->
                <div class="flex-1 max-w-md">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fad fa-search text-gray-400"></i>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-400" placeholder="Buscar...">
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-2 text-sm bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200 hover:cursor-pointer transition-colors duration-200">
                        <i class="fad fa-filter mr-2"></i>
                        Filtros
                    </button>
                    <button class="px-3 py-2 text-sm bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200 hover:cursor-pointer transition-colors duration-200">
                        <i class="fad fa-sort mr-2"></i>
                        Ordenar
                    </button>
                    <button class="px-3 py-2 text-sm bg-gray-800 text-white rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200 flex items-center">
                        <i class="fad fa-plus mr-2"></i>
                        Adicionar Novo
                    </button>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div x-show="activeTab === 'categories'" x-transition>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registros</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Sample Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-gray-200 flex items-center justify-center mr-3">
                                        <i class="fad fa-tags text-gray-800"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Tecnologia</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-left whitespace-nowrap">
                                <div class="text-sm text-gray-500">Notícias sobre tecnologia e inovação</div>
                            </td>
                            <td class="px-6 py-4 text-left whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Ativo
                                </span>
                            </td>
                            <td class="px-6 py-4 text-left whitespace-nowrap text-sm text-gray-500">
                                23 newsletters
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button class="text-blue-600 hover:text-blue-800 mx-1 hover:cursor-pointer bg-blue-50 p-2 rounded-lg">
                                    <i class="fad fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 mx-1 hover:cursor-pointer bg-red-50 p-2 rounded-lg">
                                    <i class="fad fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Sample Row 2 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-gray-200 flex items-center justify-center mr-3">
                                        <i class="fad fa-tags text-gray-800"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Ciência</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-left whitespace-nowrap">
                                <div class="text-sm text-gray-500">Descobertas e avanços científicos</div>
                            </td>
                            <td class="px-6 py-4 text-left whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Ativo
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                15 newsletters
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button class="text-blue-600 hover:text-blue-800 mx-1 hover:cursor-pointer bg-blue-50 p-2 rounded-lg">
                                    <i class="fad fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 mx-1 hover:cursor-pointer bg-red-50 p-2 rounded-lg">
                                    <i class="fad fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Topics Table -->
        <div x-show="activeTab === 'topics'" x-transition>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registros</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Sample Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-gray-200 flex items-center justify-center mr-3">
                                        <i class="fad fa-bookmark text-gray-800"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">Inteligência Artificial</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">Avanços em IA e Machine Learning</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Ativo
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                8 newsletters
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button class="text-blue-600 hover:text-blue-800 mx-1 hover:cursor-pointer bg-blue-50 p-2 rounded-lg">
                                    <i class="fad fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800 mx-1 hover:cursor-pointer bg-red-50 p-2 rounded-lg">
                                    <i class="fad fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:cursor-pointer">
                        Anterior
                    </button>
                    <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:cursor-pointer">
                        Próxima
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Mostrando
                            <span class="font-medium">1</span>
                            até
                            <span class="font-medium">10</span>
                            de
                            <span class="font-medium">20</span>
                            resultados
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:cursor-pointer">
                                <i class="fad fa-chevron-left"></i>
                            </button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:cursor-pointer">
                                1
                            </button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-gray-800 text-sm font-medium text-white hover:cursor-pointer">
                                2
                            </button>
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 hover:cursor-pointer">
                                3
                            </button>
                            <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:cursor-pointer">
                                <i class="fad fa-chevron-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style> 