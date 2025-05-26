<div
    x-data="{ 
        activeTab: @entangle('activeTab'),
        isMenuOpen: false,
        showStickyHeader: false,
        init() {
            this.handleScroll();
            window.addEventListener('scroll', () => this.handleScroll());
        },
        handleScroll() {
            const mainHeader = this.$refs.mainHeader;
            if (mainHeader) {
                const headerBottom = mainHeader.getBoundingClientRect().bottom;
                this.showStickyHeader = headerBottom < 0;
            }
        }
    }"
    class="min-h-screen flex flex-col"
>
    <!-- Top section with gray background and curved bottom -->
    <div class="bg-gray-200 h-35 relative">
        <!-- Header section -->
        <div class="container mx-auto px-4 py-6 flex items-center justify-between" x-ref="mainHeader">
            <div class="flex items-center">
                <!-- Logo + system name -->
                <img src="{{ asset('images/spider_logo_transparent.png') }}" alt="Logo" class="h-16" />
                <span class="ml-3 text-xl font-semibold">WebNews</span>
                
                <!-- Vertical divider -->
                <div class="h-6 w-px bg-gray-400 mx-4"></div>
                
                <!-- Navigation menu -->
                <nav class="flex space-x-6" aria-label="Navigation menu">
                    <a href="/"
                        class="text-gray-600 hover:text-gray-800 hover:font-medium transition-all duration-200 relative nav-link">
                        Voltar
                    </a>
                </nav>
            </div>

            <!-- Profile Badge -->
            <span class="inline-block px-4 py-2 bg-gray-800 text-white rounded-full text-sm font-bold">
                Perfil do Assinante
            </span>
        </div>

        <!-- Wave transition -->
        <div class="wave-transition"></div>
    </div>

    <!-- White section with profile content -->
    <div class="bg-white flex-grow mt-15">
        <div class="container mx-auto px-4 -mt-8">
            <div class="bg-white rounded-xl shadow-md ring-1 ring-gray-200/50 p-8 relative z-10 hover:shadow-lg transition-shadow duration-200">
                <!-- User header -->
                <div class="flex items-center space-x-4 mb-2 pb-6 border-b border-gray-100">
                    <div class="w-20 h-20 bg-gray-800 text-white rounded-xl flex items-center justify-center text-3xl font-semibold">
                        {{ strtoupper(substr($user->usr_email, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $user->subscriber->sub_name ?? explode('@', $user->usr_email)[0] }}</h1>
                        <p class="text-gray-500">{{ $user->usr_email }}</p>
                        <p class="text-sm text-gray-400 capitalize mt-1">{{ $user->usr_level }}</p>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button
                            @click="activeTab = 'magic-login'"
                            :class="{'border-gray-800 text-gray-800': activeTab === 'magic-login',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:cursor-pointer hover:border-gray-300': activeTab !== 'magic-login'}"
                            class="py-4 px-1 border-b-2 font-medium text-sm">
                            <i class="fad fa-magic mr-2"></i>
                            Login Mágico
                        </button>
                        <button
                            @click="activeTab = 'edit-profile'"
                            :class="{'border-gray-800 text-gray-800': activeTab === 'edit-profile',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:cursor-pointer hover:border-gray-300': activeTab !== 'edit-profile'}"
                            class="py-4 px-1 border-b-2 font-medium text-sm">
                            <i class="fad fa-user-edit mr-2"></i>
                            Editar Perfil
                        </button>
                        <button
                            @click="activeTab = 'password'"
                            :class="{'border-gray-800 text-gray-800': activeTab === 'password',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:cursor-pointer hover:border-gray-300': activeTab !== 'password'}"
                            class="py-4 px-1 border-b-2 font-medium text-sm">
                            <i class="fad fa-lock mr-2"></i>
                            Senha
                        </button>
                    </nav>
                </div>

                <!-- Tab content -->
                <div class="py-6">
                    <!-- Magic Login Tab -->
                    <div x-show="activeTab === 'magic-login'" x-cloak>
                        <div class="flex items-start space-x-8">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Como funciona o Login Mágico?</h3>
                                <p class="text-gray-600 mb-4">
                                    O Login Mágico é uma forma segura e conveniente de acessar sua conta sem precisar memorizar senhas.
                                    Caso você habilite o login mágico, você passará a receber um email diretamente contendo um link de acesso
                                    através desse link mágico fazemos a sua autenticação.
                                </p>
                                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Benefícios do Login Mágico:</h4>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li class="flex items-center">
                                            <i class="fad fa-check-circle text-green-500 mr-2"></i>
                                            Não precisa memorizar senhas
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fad fa-check-circle text-green-500 mr-2"></i>
                                            Acesso seguro e criptografado
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fad fa-check-circle text-green-500 mr-2"></i>
                                            Processo simples e rápido
                                        </li>
                                        <li class="flex items-center">
                                            <i class="fad fa-check-circle text-green-500 mr-2"></i>
                                            Validade do link de dois dias.
                                        </li>
                                    </ul>
                                </div>
                                <button
                                    wire:click="sendMagicLogin"
                                    wire:loading.attr="disabled"
                                    wire:target="sendMagicLogin"
                                    class="inline-flex items-center px-4 py-2 hover:cursor-pointer border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <div class="inline-flex items-center">
                                        <!-- Estado normal -->
                                        <span wire:loading.remove wire:target="sendMagicLogin">
                                            <i class="fad fa-magic mr-2"></i>
                                            {{ $user->usr_has_magic_link ? 'Desativar login mágico' : 'Ativar login mágico' }}
                                        </span>
                                        <!-- Estado de loading -->
                                        <span wire:loading wire:target="sendMagicLogin">
                                            <i class="fad fa-spinner fa-spin mr-2"></i>
                                            Aguarde...
                                        </span>
                                    </div>
                                </button>
                            </div>
                            <div class="w-76 mt-6 flex items-center border-0 justify-center">
                                <img src="{{ asset('images/magic_link.png') }}" alt="Magic Link Illustration" class="w-full h-auto object-contain rounded-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Tab -->
                    <div x-show="activeTab === 'edit-profile'" x-cloak>
                        <div class="flex items-start space-x-8">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Informações do Perfil</h3>
                                <form class="space-y-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700">
                                            <i class="fad fa-save mr-2"></i>
                                            Salvar Alterações
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="w-76 mt-6 flex items-center justify-center">
                                <img src="{{ asset('images/edit_profile.png') }}" alt="Edit Profile Illustration" class="w-full h-auto object-contain rounded-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Password Tab -->
                    <div x-show="activeTab === 'password'" x-cloak>
                        <div class="flex items-start space-x-8">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Alterar Senha</h3>
                                <form class="space-y-6">
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700">Senha Atual</label>
                                        <input type="password" name="current_password" id="current_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="new_password" class="block text-sm font-medium text-gray-700">Nova Senha</label>
                                        <input type="password" name="new_password" id="new_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nova Senha</label>
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700">
                                            <i class="fad fa-key mr-2"></i>
                                            Alterar Senha
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="w-76 mt-6 flex items-center border-0 justify-center">
                                <img src="{{ asset('images/change_pass_image.png') }}" alt="Change Password Illustration" class="w-full h-auto object-contain rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .wave-transition {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: white;
            border-radius: 100% 100% 0 0;
            transform: translateY(50%);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #193763;
            transition: width 0.2s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        [x-cloak] {
            display: none !important;
        }
    </style>
</div>