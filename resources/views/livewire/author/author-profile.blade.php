<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-md ring-1 ring-gray-200/50 p-8 relative z-10 hover:shadow-lg transition-shadow duration-200">
        <!-- User header -->
        <div class="flex items-center space-x-4 mb-2 pb-6 border-b border-gray-100">
            @if($user->author->aut_photo)
                <img src="{{ asset('storage/images/authors/' . $user->author->aut_id . '/' . $user->author->aut_photo) }}" 
                    alt="{{ $user->author->aut_name }}" 
                    class="w-20 h-20 rounded-xl object-cover"
                />
            @else
                <div class="w-20 h-20 bg-gray-800 text-white rounded-xl flex items-center justify-center text-3xl font-semibold">
                    {{ strtoupper(substr($user->author->aut_name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $user->author->aut_name }}</h1>
                <p class="text-gray-500">{{ $user->usr_email }}</p>
                <p class="text-sm text-gray-400 capitalize mt-1">{{ $user->usr_level }}</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200">
            <div class="flex justify-between items-center">
                <nav class="-mb-px flex space-x-8">
                    <button
                        @click="$wire.activeTab = 'magic-login'"
                        :class="{'border-gray-800 text-gray-800': $wire.activeTab === 'magic-login',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:cursor-pointer hover:border-gray-300': $wire.activeTab !== 'magic-login'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        <i class="fad fa-magic mr-2"></i>
                        Login Mágico
                    </button>
                    <button
                        @click="$wire.activeTab = 'edit-profile'"
                        :class="{'border-gray-800 text-gray-800': $wire.activeTab === 'edit-profile',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:cursor-pointer hover:border-gray-300': $wire.activeTab !== 'edit-profile'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        <i class="fad fa-user-edit mr-2"></i>
                        Editar Perfil
                    </button>
                    <button
                        @click="$wire.activeTab = 'password'"
                        :class="{'border-gray-800 text-gray-800': $wire.activeTab === 'password',
                                'border-transparent text-gray-500 hover:text-gray-700 hover:cursor-pointer hover:border-gray-300': $wire.activeTab !== 'password'}"
                        class="py-4 px-1 border-b-2 font-medium text-sm">
                        <i class="fad fa-lock mr-2"></i>
                        Senha
                    </button>
                </nav>
                <button
                    wire:click="logout"
                    class="py-4 px-1 border-b-2 font-medium text-sm border-transparent text-red-600 hover:text-red-700 hover:cursor-pointer hover:border-red-600">
                    <i class="fad fa-sign-out mr-2"></i>
                    Sair
                </button>
            </div>
        </div>

        <!-- Tab content -->
        <div class="py-6">
            <!-- Magic Login Tab -->
            <div x-show="$wire.activeTab === 'magic-login'" x-cloak>
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
                                    Validade do link de dois dias
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
            <div x-show="$wire.activeTab === 'edit-profile'" x-cloak>
                <div class="flex items-start space-x-8">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Informações do Perfil</h3>
                        <form wire:submit="updateProfile" class="space-y-6">
                            <!-- Nome e CPF -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Nome Completo <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        wire:model="editProfileForm.name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                        placeholder="Seu nome completo"
                                        required
                                    />
                                </div>

                                <div>
                                    <label for="cpf" class="block text-sm font-medium text-gray-700">
                                        CPF <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        wire:model.live="editProfileForm.cpf"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                        placeholder="000.000.000-00"
                                        maxlength="14"
                                        required
                                    />
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    E-mail <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    wire:model="editProfileForm.email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    placeholder="Seu email"
                                    required
                                />
                            </div>

                            <!-- Detalhes -->
                            <div>
                                <label for="body" class="block text-sm font-medium text-gray-700">Detalhes</label>
                                <div class="mt-1 bg-white shadow-sm border border-gray-300 rounded-lg p-4">
                                    <p class="text-sm text-gray-600 mb-4">
                                        Este campo aceita formatação Markdown (.md). Você pode usar:
                                        <span class="block mt-2 space-y-1">
                                            <code class="bg-gray-200 px-2 py-1 rounded"># Título</code>
                                            <code class="bg-gray-200 px-2 py-1 rounded">**negrito**</code>
                                            <code class="bg-gray-200 px-2 py-1 rounded">*itálico*</code>
                                            <code class="bg-gray-200 px-2 py-1 rounded">[link](url)</code>
                                            <code class="bg-gray-200 px-2 py-1 rounded">🚀 Emojis</code>
                                        </span>
                                    </p>
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <div class="bg-gray-100 px-4 py-2 border-b border-gray-200">
                                            <div class="flex items-center space-x-2">
                                                <button type="button" class="p-1 hover:bg-gray-200 rounded" title="Negrito">
                                                    <i class="fad fa-bold"></i>
                                                </button>
                                                <button type="button" class="p-1 hover:bg-gray-200 rounded" title="Itálico">
                                                    <i class="fad fa-italic"></i>
                                                </button>
                                                <button type="button" class="p-1 hover:bg-gray-200 rounded" title="Link">
                                                    <i class="fad fa-link"></i>
                                                </button>
                                                <button type="button" class="p-1 hover:bg-gray-200 rounded" title="Lista">
                                                    <i class="fad fa-list-ul"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <textarea
                                            wire:model="editProfileForm.body"
                                            rows="6"
                                            class="w-full px-4 py-2 border-0 focus:ring-0"
                                            placeholder="Conte um pouco sobre você usando Markdown..."
                                        ></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload de Foto -->
                            <div class="mt-0">
                                <x-ts-upload
                                    wire:model="editProfileForm.photo"
                                    label="Foto de Perfil (Opcional)"
                                    hint="Arquivos permitidos: JPG, PNG. Tamanho máximo: 2MB"
                                    accept="image/*"
                                    max-size="2MB"
                                />
                            </div>

                            <div>
                                <button type="submit" class="inline-flex hover:cursor-pointer items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700">
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
            <div x-show="$wire.activeTab === 'password'" x-cloak>
                <div class="flex items-start space-x-8">
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Alterar Senha</h3>
                        <form wire:submit="updatePassword" class="space-y-6">
                            @if($hasPassword)
                                <div x-data="{ show: false }">
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">Senha Atual</label>
                                    <div class="relative mt-1">
                                        <input
                                            :type="show ? 'text' : 'password'" 
                                            wire:model="passwordForm.current_password"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm pr-10"
                                        >
                                        <button
                                            @click="show = !show"
                                            type="button"
                                            class="absolute inset-y-0 right-0 px-3 flex items-center"
                                        >
                                            <i class="fad" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fad fa-info-circle text-blue-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-blue-700">
                                                Você ainda não possui uma senha cadastrada. Por favor, defina sua primeira senha abaixo.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div x-data="{ show: false }">
                                <label for="new_password" class="block text-sm font-medium text-gray-700">Nova Senha</label>
                                <div class="relative mt-1">
                                    <input
                                        :type="show ? 'text' : 'password'"
                                        wire:model="passwordForm.new_password"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm pr-10"
                                    >
                                    <button
                                        @click="show = !show"
                                        type="button"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center"
                                    >
                                        <i class="fad" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                            <div x-data="{ show: false }">
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nova Senha</label>
                                <div class="relative mt-1">
                                    <input
                                        :type="show ? 'text' : 'password'"
                                        wire:model="passwordForm.new_password_confirmation"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm pr-10"
                                    >
                                    <button
                                        @click="show = !show"
                                        type="button"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center"
                                    >
                                        <i class="fad" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    wire:loading.attr="disabled"
                                    wire:target="updatePassword"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span wire:loading.remove wire:target="updatePassword">
                                        <i class="fad fa-key mr-2"></i>
                                        Alterar Senha
                                    </span>
                                    <span wire:loading wire:target="updatePassword">
                                        <i class="fad fa-spinner fa-spin mr-2"></i>
                                        Aguarde...
                                    </span>
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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</div> 