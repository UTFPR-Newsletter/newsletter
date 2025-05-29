<div class="min-h-screen flex flex-col items-center justify-center relative py-12">
    <!-- Floating buttons -->
    <div class="fixed top-4 right-4 flex flex-col gap-2">
        <!-- Home button -->
        <a href="/" class="p-3 bg-white shadow-xl border border-gray-200 rounded-lg text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200">
            <i class="fad fa-newspaper text-xl"></i>
        </a>
        
        <!-- Login button -->
        <a href="/login" class="p-3 bg-white shadow-xl border border-gray-200 rounded-lg text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200">
            <i class="fad fa-sign-in text-xl"></i>
        </a>
    </div>

    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/spider_logo_transparent.png') }}" alt="WebNews" class="h-20 w-auto" />
    </div>

    <div class="bg-white rounded-lg shadow-xl border border-gray-200 w-full max-w-2xl mx-auto">
        <div class="flex flex-row justify-between w-full mb-4 px-4">
            <div>
                <h2 class="text-2xl font-semibold text-left italic pt-8">Cadastro de Autor</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Cadastro simplificado, você posteriormente poderá preencher o restante dos dados.
                </p>
                <p class="text-xs text-red-500 mt-2">
                    * Campos obrigatórios
                </p>
            </div>
            <img src="{{ asset('images/spider_going_down.png') }}" alt="Spider" class="w-16 h-16 object-contain" />
        </div>

        <!-- Divider -->
        <div class="flex items-center justify-center py-4 mt-0 mb-2">
            <div class="w-6/7 h-px bg-gray-200"></div>
        </div>
        
        <form wire:submit="handleSubmit" class="space-y-4 px-4 pb-8">
            <!-- Informações Pessoais -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nome Completo <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="authorForm.name"
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
                        wire:model.live="authorForm.cpf"
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
                    wire:model="authorForm.email"
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
                            wire:model="authorForm.body"
                            rows="6"
                            class="w-full px-4 py-2 border-0 focus:ring-0"
                            placeholder="Conte um pouco sobre você usando Markdown..."
                        ></textarea>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="flex items-center justify-center py-4 mt-4">
                <div class="w-6/7 h-px bg-gray-200"></div>
            </div>

            <!-- Upload de Foto -->
            <div class="mt-0">
                <x-ts-upload
                    wire:model="authorForm.photo"
                    label="Foto de Perfil (Opcional)"
                    hint="Arquivos permitidos: JPG, PNG. Tamanho máximo: 2MB"
                    accept="image/*"
                    max-size="2MB"
                />
            </div>

            <!-- Botões -->
            <div class="flex space-x-4 pt-4">
                <a
                    href="/login"
                    class="flex-1 text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center"
                >
                    <i class="fad fa-arrow-left mr-2"></i>
                    Voltar
                </a>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="handleSubmit"
                    class="flex-1 text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <i class="fad fa-user-plus mr-2" wire:loading.remove wire:target="handleSubmit"></i>
                    <i class="fad fa-spinner-third fa-spin mr-2" wire:loading wire:target="handleSubmit"></i>
                    <span wire:loading.remove wire:target="handleSubmit">Cadastrar</span>
                    <span wire:loading wire:target="handleSubmit">Processando...</span>
                </button>
            </div>
        </form>

        <div class="bg-black w-full h-1 mt-6 rounded-b-lg"></div>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center">
        <p class="text-xs text-gray-500">
            © 2025 WebNews. Todos os direitos reservados.
        </p>
    </div>

    <style>
        [x-cloak] { 
            display: none !important; 
        }
    </style>
</div>
