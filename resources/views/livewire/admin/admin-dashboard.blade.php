@section('page-title', 'Dashboard')

<div class="w-full mt-8">
    <div class="w-full">
        <!-- Top row with 3 equal-sized cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Quick Access Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <!-- Black header -->
                <div class="bg-gray-900 h-40 py-8 pt-8 rounded-b-lg px-6 relative">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo_only_web_white.png') }}" alt="WebNews Logo" class="h-6 mr-2" />
                        <h3 class="text-lg font-semibold text-white">Acesso Rápido</h3>
                    </div>
                    
                    <!-- Newsletters button - overlapping -->
                    <div class="absolute left-4 right-4 -bottom-8">
                        <a href="#" class="block">
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <div class="p-4 text-center">
                                    <div class="flex flex-col items-center space-y-2">
                                        <i class="fad fa-newspaper text-2xl text-gray-800"></i>
                                        <span class="text-gray-800 font-medium">Newsletters</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Quick access buttons -->
                <div class="p-4 pt-12 space-y-4">
                    <!-- Bottom buttons grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Authors button -->
                        <a href="#" class="block">
                            <div class="bg-white rounded-lg p-4 text-center transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <i class="fad fa-users text-xl text-gray-800"></i>
                                    <span class="text-gray-800 font-medium text-sm">Autores</span>
                                </div>
                            </div>
                        </a>
    
                        <!-- Subscribers button -->
                        <a href="#" class="block">
                            <div class="bg-white rounded-lg p-4 text-center transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <i class="fad fa-user-check text-xl text-gray-800"></i>
                                    <span class="text-gray-800 font-medium text-sm">Assinantes</span>
                                </div>
                            </div>
                        </a>
    
                        <!-- Categories button -->
                        <a href="#" class="block">
                            <div class="bg-white rounded-lg p-4 text-center transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <i class="fad fa-tags text-xl text-gray-800"></i>
                                    <span class="text-gray-800 font-medium text-sm">Categorias</span>
                                </div>
                            </div>
                        </a>
    
                        <!-- Topics button -->
                        <a href="#" class="block">
                            <div class="bg-white rounded-lg p-4 text-center transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                                <div class="flex flex-col items-center space-y-2">
                                    <i class="fad fa-bookmark text-xl text-gray-800"></i>
                                    <span class="text-gray-800 font-medium text-sm">Tópicos</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
    
            <!-- Card 2 - Engagement Metrics -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Métricas de Engajamento</h3>
                    <p class="text-sm text-gray-500">Dados para parceiros e anunciantes</p>
                </div>
    
                <!-- Metrics Grid -->
                <div class="space-y-6">
                    <!-- Sent Emails -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                <i class="fad fa-paper-plane text-2xl text-gray-800"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-500">Emails Enviados</h4>
                                <div class="flex items-center mt-1">
                                    <span class="text-xl font-bold text-gray-800">1,257</span>
                                    <span class="ml-2 text-sm text-gray-500">
                                        últimos 30 dias
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-500">Média diária</span>
                            <p class="text-sm font-medium text-gray-800">41.9</p>
                        </div>
                    </div>
    
                    <!-- Open Rate -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                <i class="fad fa-envelope-open text-2xl text-gray-800"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-500">Taxa de Abertura</h4>
                                <div class="flex items-center mt-1">
                                    <span class="text-xl font-bold text-gray-800">68.5%</span>
                                    <span class="ml-2 text-sm text-green-500 flex items-center">
                                        <i class="fad fa-arrow-up mr-1"></i>
                                        2.1%
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-500">Média do setor</span>
                            <p class="text-sm font-medium text-gray-800">42.3%</p>
                        </div>
                    </div>
    
                    <!-- Audience Growth -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                <i class="fad fa-users-crown text-2xl text-gray-800"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-500">Crescimento Mensal</h4>
                                <div class="flex items-center mt-1">
                                    <span class="text-xl font-bold text-gray-800">+12.4%</span>
                                    <span class="ml-2 text-sm text-green-500 flex items-center">
                                        <i class="fad fa-arrow-up mr-1"></i>
                                        2.3%
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-500">Média do setor</span>
                            <p class="text-sm font-medium text-gray-800">8.1%</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Card 3 - Statistics -->
            <div class="bg-white rounded-lg shadow-md p-6 pt-0 border border-gray-200">
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div class="pt-6">
                            <h3 class="text-lg font-semibold text-gray-800">Estatísticas</h3>
                            <p class="text-sm text-gray-500">Estatísticas do sistema</p>
                        </div>
                        <img src="{{ asset('images/spider_going_down.png') }}" alt="Spider" class="h-18" />
                    </div>
                </div>
    
                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-6">
                    <!-- Authors Stats -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                            <i class="fad fa-users text-2xl text-gray-800"></i>
                        </div>
                        <div class="ml-3 mt-1">
                            <span class="block text-xl font-bold text-gray-800">48</span>
                            <span class="text-sm text-gray-500">Autores</span>
                        </div>
                    </div>
    
                    <!-- Newsletters Stats -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                            <i class="fad fa-newspaper text-2xl text-gray-800"></i>
                        </div>
                        <div class="ml-3 mt-1">
                            <span class="block text-xl font-bold text-gray-800">156</span>
                            <span class="text-sm text-gray-500">Newsletters</span>
                        </div>
                    </div>
    
                    <!-- Subscribers Stats -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                            <i class="fad fa-user-check text-2xl text-gray-800"></i>
                        </div>
                        <div class="ml-3 mt-1">
                            <span class="block text-xl font-bold text-gray-800">2.4k</span>
                            <span class="text-sm text-gray-500">Assinantes</span>
                        </div>
                    </div>
    
                    <!-- Categories Stats -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                            <i class="fad fa-tags text-2xl text-gray-800"></i>
                        </div>
                        <div class="ml-3 mt-1">
                            <span class="block text-xl font-bold text-gray-800">12</span>
                            <span class="text-sm text-gray-500">Categorias</span>
                        </div>
                    </div>
    
                    <!-- Topics Stats -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                            <i class="fad fa-bookmark text-2xl text-gray-800"></i>
                        </div>
                        <div class="ml-3 mt-1">
                            <span class="block text-xl font-bold text-gray-800">34</span>
                            <span class="text-sm text-gray-500">Tópicos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Bottom row with 2 equal-sized cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Large Card 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Últimas Edições</h3>
                    <button class="text-blue-500 hover:text-blue-700">
                        <i class="fad fa-ellipsis-h"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <!-- Newsletter Item -->
                    <div class="bg-white rounded-lg p-4 transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                    <i class="fad fa-newspaper text-2xl text-gray-800"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Tecnologia Semanal</h4>
                                    <p class="text-xs text-gray-500">Enviada há 2 horas</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-600">847 leitores</span>
                        </div>
                    </div>
    
                    <!-- More newsletter items... -->
                    <div class="bg-white rounded-lg p-4 transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                    <i class="fad fa-leaf text-2xl text-gray-800"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Sustentabilidade Hoje</h4>
                                    <p class="text-xs text-gray-500">Enviada há 5 horas</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-600">632 leitores</span>
                        </div>
                    </div>
    
                    <div class="bg-white rounded-lg p-4 transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                    <i class="fad fa-leaf text-2xl text-gray-800"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Sustentabilidade Hoje</h4>
                                    <p class="text-xs text-gray-500">Enviada há 5 horas</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-600">632 leitores</span>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Large Card 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Log de Ações</h3>
                    <button class="text-blue-500 hover:text-blue-700">
                        <i class="fad fa-ellipsis-h"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <!-- Create Log -->
                    <div class="bg-white rounded-lg p-4 transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                    <i class="fad fa-plus-circle text-2xl text-green-500"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Newsletter Criada</h4>
                                    <p class="text-xs text-gray-500">por Maria Santos • há 10 min</p>
                                </div>
                            </div>
                            <span class="text-xs font-medium text-green-500">CREATE</span>
                        </div>
                    </div>
    
                    <!-- Update Log -->
                    <div class="bg-white rounded-lg p-4 transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                    <i class="fad fa-edit text-2xl text-blue-500"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Categoria Atualizada</h4>
                                    <p class="text-xs text-gray-500">por João Silva • há 25 min</p>
                                </div>
                            </div>
                            <span class="text-xs font-medium text-blue-500">UPDATE</span>
                        </div>
                    </div>
    
                    <!-- Delete Log -->
                    <div class="bg-white rounded-lg p-4 transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                    <i class="fad fa-trash-alt text-2xl text-red-500"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Tópico Removido</h4>
                                    <p class="text-xs text-gray-500">por Carlos Oliveira • há 1h</p>
                                </div>
                            </div>
                            <span class="text-xs font-medium text-red-500">DELETE</span>
                        </div>
                    </div>
    
                    <!-- Read Log -->
                    <div class="bg-white rounded-lg p-4 transition-all duration-300 shadow-md border border-gray-200 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-200 flex items-center justify-center">
                                    <i class="fad fa-eye text-2xl text-purple-500"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Acesso ao Sistema</h4>
                                    <p class="text-xs text-gray-500">por Ana Luiza • há 2h</p>
                                </div>
                            </div>
                            <span class="text-xs font-medium text-purple-500">READ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
