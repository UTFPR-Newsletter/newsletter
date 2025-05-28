<div class="min-h-screen flex flex-col items-center justify-center relative py-12">
    <!-- Home button -->
    <a href="/" class="fixed top-4 right-4 p-3 bg-white shadow-xl border border-gray-200 rounded-lg text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200">
        <i class="fad fa-newspaper text-xl"></i>
    </a>

    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/spider_logo_transparent.png') }}" alt="WebNews" class="h-20 w-auto" />
    </div>

    <div class="bg-white rounded-lg shadow-xl border border-gray-200 w-full max-w-md mx-auto">
        <div class="flex flex-row justify-between w-full mb-6 px-4">
            <div>
                <h2 class="text-2xl font-semibold text-left italic pt-8">WebNews</h2>
            </div>
            <img src="{{ asset('images/spider_going_down.png') }}" alt="Spider" class="w-16 h-16 object-contain" />
        </div>
        
        <form wire:submit.prevent="handleSubmit" class="space-y-4 px-4">
            <!-- Email Field (sempre visível quando não está na verificação) -->
            @if(!$showVerification)
                <div class="flex flex-row mb-4">
                    <div class="p-3 bg-gray-200/50 rounded-l-md flex items-center pointer-events-none">
                        <i class="fad fa-envelope text-sm text-gray-600/70"></i>
                    </div>
                    <input
                        type="email"
                        wire:model="email"
                        class="w-full px- pl-2 py-2 border border-gray-200 rounded-r-md focus:outline-none focus:ring-2 focus:ring-gray-800/40"
                        placeholder="Seu email"
                        required
                    />
                </div>
            @endif

            <!-- Verification Code Field -->
            @if($showVerification && !$hasMagicLink)
                <div class="flex flex-row mb-4">
                    <div class="p-3 bg-gray-200/50 rounded-l-md flex items-center pointer-events-none">
                        <i class="fad fa-envelope-open-text text-sm text-gray-600/70"></i>
                    </div>
                    <input
                        type="text"
                        wire:model="verificationCode"
                        class="w-full px- pl-2 py-2 border border-gray-200 rounded-r-md focus:outline-none focus:ring-2 focus:ring-gray-800/40"
                        placeholder="Digite o código recebido"
                        required
                        maxlength="6"
                    />
                </div>
            @endif

            @if($showVerification && $hasMagicLink)
                <div class="p-4 pt-0 bg-gray-100 rounded-lg text-center">
                    <i class="fad fa-envelope-open-magic text-3xl text-gray-600 mt-0 mb-3"></i>
                    <p class="text-gray-700">Um link mágico foi enviado para seu email.</p>
                    <p class="text-sm text-gray-500 mt-2 mb-4">Acesse seu email e clique no link para fazer login automaticamente.</p>
                </div>
            @endif

            <!-- Password Field (apenas quando loginType é 'password') -->
            @if($loginType === 'password')
                <div class="flex flex-row mb-4" x-data="{ showPassword: false }">
                    <div class="p-3 bg-gray-200/50 rounded-l-md flex items-center pointer-events-none">
                        <i class="fad fa-key text-sm text-gray-600/70"></i>
                    </div>
                    <input
                        x-bind:type="showPassword ? 'text' : 'password'"
                        wire:model="password"
                        class="w-full px-4 pl-2 py-2 border border-gray-200 focus:outline-none focus:ring-1 focus:ring-gray-800/40"
                        placeholder="Sua senha"
                        required
                    />
                    <button 
                        type="button"
                        @click="showPassword = !showPassword"
                        class="px-3 flex items-center bg-gray-200/50 rounded-r-md text-gray-500 hover:text-gray-700"
                    >
                        <i x-bind:class="showPassword ? 'fad fa-eye-slash' : 'fad fa-eye'" class="text-sm"></i>
                    </button>
                </div>
            @endif

            <div class="flex space-x-4">
                <!-- Botão Voltar (quando está na verificação) -->
                @if($showVerification)
                    <button
                        wire:click="resetForm"
                        wire:loading.attr="disabled"
                        wire:target="resetForm"
                        type="button"
                        class="flex-1 text-sm text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <i class="fad fa-arrow-left mr-2 text-xs" wire:loading.remove wire:target="resetForm"></i>
                        <i class="fad fa-spinner-third fa-spin mr-2 text-xs" wire:loading wire:target="resetForm"></i>
                        <span wire:loading.remove wire:target="resetForm">Voltar</span>
                        <span wire:loading wire:target="resetForm">Processando...</span>
                    </button>
                @endif

                <!-- Botão Login com Senha (quando loginType é 'email' e não está na verificação) -->
                @if($loginType === 'email' && !$showVerification)
                    <button
                        wire:click="switchToPassword"
                        wire:loading.attr="disabled"
                        wire:target="switchToPassword"
                        type="button"
                        class="flex-1 text-sm text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <i class="fad fa-key mr-2 text-xs" wire:loading.remove wire:target="switchToPassword"></i>
                        <i class="fad fa-spinner-third fa-spin mr-2 text-xs" wire:loading wire:target="switchToPassword"></i>
                        <span wire:loading.remove wire:target="switchToPassword">Login com Senha</span>
                        <span wire:loading wire:target="switchToPassword">Processando...</span>
                    </button>
                @endif

                <!-- Botão Login Simplificado (quando loginType é 'password') -->
                @if($loginType === 'password')
                    <button
                        wire:click="switchToEmail"
                        wire:loading.attr="disabled"
                        wire:target="switchToEmail"
                        type="button"
                        class="flex-1 text-sm text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <i class="fad fa-envelope mr-2 text-xs" wire:loading.remove wire:target="switchToEmail"></i>
                        <i class="fad fa-spinner-third fa-spin mr-2 text-xs" wire:loading wire:target="switchToEmail"></i>
                        <span wire:loading.remove wire:target="switchToEmail">Login Simplificado</span>
                        <span wire:loading wire:target="switchToEmail">Processando...</span>
                    </button>
                @endif

                <!-- Botão Principal (Login/Verificar) -->
                @if(!($showVerification && $hasMagicLink))
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="handleSubmit"
                        class="flex-1 text-sm text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <i class="fad fa-sign-in mr-2 text-xs" wire:loading.remove wire:target="handleSubmit"></i>
                        <i class="fad fa-spinner-third fa-spin mr-2 text-xs" wire:loading wire:target="handleSubmit"></i>
                        <span wire:loading.remove wire:target="handleSubmit">
                            @if($showVerification)
                                Verificar
                            @else
                                Login
                            @endif
                        </span>
                        <span wire:loading wire:target="handleSubmit">Processando...</span>
                    </button>
                @endif
            </div>
        </form>

        <div class="px-4 mt-6">
            @if($loginType === 'email' && !$error && !$success)
                <p class="text-xs text-center mt-2 text-gray-500/50">
                    Login simplificado, você receberá um email com um link de acesso.
                </p>
            @endif
            
            @if($error)
                <div class="text-red-500 text-sm text-center">
                    {{ $error }}
                </div>
            @endif
            
            @if($success)
                <div class="text-green-500 text-sm text-center">
                    {{ $success }}
                </div>
            @endif
        </div>

        <div class="bg-black w-full h-1 mt-6 rounded-b-lg"></div>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center">
        <p class="text-xs text-gray-500">
            © 2025 WebNews. Todos os direitos reservados.
        </p>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('redirect-home', () => {
                setTimeout(() => {
                    window.location.href = '/';
                }, 1000);
            });
        });
    </script>

    <style>
        [x-cloak] { 
            display: none !important; 
        }
    </style>
</div>
