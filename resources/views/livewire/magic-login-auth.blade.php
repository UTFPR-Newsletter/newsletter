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
    @else
        <!-- Description text -->
        <p class="mt-3 text-lg text-gray-600/55">
            Autenticando sua conexão...
        </p>

        <!-- Loading spinner -->
        <div class="mt-8">
            <i class="fad fa-spinner-third fa-spin text-4xl text-gray-800"></i>
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
    </style>
</div>
