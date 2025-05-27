<div class="min-h-screen bg-gray-200 flex flex-col items-center justify-center">
    <!-- Circular logo background - white with inner shadow -->
    <div class="inline-block bg-white p-8 rounded-full shadow-inner border border-gray-300">
        <img src="{{ asset('images/spider_logo_transparent.png') }}" alt="Logo" class="h-48 mx-auto spider-logo" />
    </div>

    <!-- System name -->
    <h1 class="mt-10 text-3xl font-semibold italic">WebNews</h1>

    @if($error)
        <!-- Error message -->
        <div class="mt-6 text-red-600 text-lg">
            <i class="fad fa-exclamation-circle mr-2"></i>
            {{ $error }}
        </div>
        <!-- Botão para voltar -->
        <a href="{{ route('login') }}" class="mt-4 px-6 py-2 bg-white rounded-md text-gray-800 hover:bg-gray-800 hover:text-white font-semibold transition-colors duration-200 inline-flex items-center">
            <i class="fad fa-arrow-left mr-2"></i>
            Voltar para o login
        </a>
    @elseif($isSuccess)
        <!-- Success message -->
        <div class="mt-6 text-green-600 text-lg animate-fade-in">
            <i class="fad fa-check-circle mr-2"></i>
            Login realizado com sucesso!
        </div>
        <p class="mt-2 text-gray-600/55">
            Redirecionando...
        </p>
    @else
        <!-- Processing message -->
        <div class="mt-6">
            @if($isProcessing)
                <div class="text-gray-800 text-lg mb-3">
                    <i class="fad fa-shield-check mr-2"></i>
                    Verificando credenciais...
                </div>
            @endif
            <div class="flex items-center justify-center">
                <i class="fad fa-spinner-third fa-spin text-4xl text-gray-800"></i>
            </div>
        </div>
    @endif

    <style>
        .shadow-inner {
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
        }

        .spider-logo {
            filter: drop-shadow(0 0 3px rgba(0, 0, 0, 0.2));
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .fa-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }
    </style>
</div>
