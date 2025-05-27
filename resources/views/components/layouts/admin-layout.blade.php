<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/font-awesome-pro-master.min.css') }}?v=0.0.1"
    >
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="64x64">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <tallstackui:script />
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-200">
    <x-ts-dialog />
    <x-ts-toast />

    <div x-data="adminPage()" x-init="init()">
        <!-- Floating sticky header that appears on scroll -->
        <div
            class="fixed top-4 left-0 right-0 mx-auto w-11/12 max-w-7xl bg-gray-300/50 rounded-xl shadow-lg transition-all duration-300 z-50 py-3 px-6 flex items-center justify-between"
            x-show="showStickyHeader"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-y-20 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-20 opacity-0"
            x-cloak
        >
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center">
                    <!-- Logo in white square with hover effect -->
                    <div class="logo-container mr-4">
                        <div class="logo-box">
                            <div class="logo-front flex items-center justify-center">
                                <img src="{{ asset('images/logo_only_web.png') }}" alt="WebNews Logo" class="h-8 mt-1" />
                            </div>
                            <div class="logo-back">
                                <img src="{{ asset('images/logo_only_web_white.png') }}" alt="WebNews Logo" class="h-8" />
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation menu -->
                    <nav class="flex space-x-6" aria-label="Navigation menu">
                        <a href="{{ route('admin.dashboard') }}"
                            class="transition-all duration-200 relative nav-link {{ request()->routeIs('admin.dashboard') ? 'text-gray-900 font-medium active-tab' : 'text-gray-600 hover:text-gray-800 hover:font-medium' }}">
                            Home
                        </a>
                        <a href="{{ route('admin.management') }}"
                            class="transition-all duration-200 relative nav-link {{ request()->routeIs('admin.management') ? 'text-gray-900 font-medium active-tab' : 'text-gray-600 hover:text-gray-800 hover:font-medium' }}">
                            Gestão
                        </a>
                    </nav>
                </div>

                <!-- User Menu -->
                <div class="relative" x-data="{ isMenuOpen: false }">
                    <!-- Admin user button -->
                    <button @click="isMenuOpen = !isMenuOpen" class="flex items-center space-x-3 p-2 bg-white rounded-lg text-gray-800 hover:bg-gray-50 transition-colors duration-200 border border-gray-200">
                        <!-- User avatar with initial -->
                        <div class="w-8 h-8 bg-gray-800 text-white rounded-md flex items-center justify-center font-semibold text-sm">
                            {{ strtoupper(substr($user->usr_email, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium truncate max-w-24">{{ explode('@', $user->usr_email)[0] }}</span>
                        <i class="fad fa-chevron-down text-xs mr-6"></i>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div x-show="isMenuOpen"
                            @click.outside="isMenuOpen = false"
                            x-transition
                            x-cloak
                            class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                        <!-- Admin menu -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gray-800 text-white rounded-lg flex items-center justify-center font-semibold text-lg">
                                    {{ strtoupper(substr($user->usr_email, 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $user->usr_email }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ $user->usr_level }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="py-2">
                            <button class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50 flex items-center">
                                <i class="fad fa-user-shield text-blue-500 mr-3"></i>
                                Configurações
                            </button>
                            <button class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50 flex items-center">
                                <i class="fad fa-key text-green-500 mr-3"></i>
                                Alterar Senha
                            </button>
                        </div>
                        
                        <div class="border-t border-gray-100 py-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 flex items-center">
                                    <i class="fad fa-sign-out text-red-500 mr-3"></i>
                                    Sair
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top section with gray background -->
        <div class="bg-gray-200 relative h-34">
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
                        <a href="{{ route('admin.dashboard') }}"
                            class="transition-all duration-200 relative nav-link {{ request()->routeIs('admin.dashboard') ? 'text-gray-900 font-medium active-tab' : 'text-gray-600 hover:text-gray-800 hover:font-medium' }}">
                            Home
                        </a>
                        <a href="{{ route('admin.management') }}"
                            class="transition-all duration-200 relative nav-link {{ request()->routeIs('admin.management') ? 'text-gray-900 font-medium active-tab' : 'text-gray-600 hover:text-gray-800 hover:font-medium' }}">
                            Gestão
                        </a>
                    </nav>
                </div>

                <!-- User Menu -->
                <div class="relative" x-data="{ isMenuOpen: false }">
                    <!-- Admin user button -->
                    <button @click="isMenuOpen = !isMenuOpen" class="flex items-center space-x-3 p-2 bg-white rounded-lg text-gray-800 hover:bg-gray-50 transition-colors duration-200 border border-gray-200">
                        <!-- User avatar with initial -->
                        <div class="w-10 h-10 bg-gray-800 text-white rounded-lg flex items-center justify-center font-semibold">
                            {{ strtoupper(substr($user->usr_email, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium truncate max-w-32">{{ explode('@', $user->usr_email)[0] }}</span>
                        <i class="fad fa-chevron-down text-sm"></i>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div x-show="isMenuOpen"
                            @click.outside="isMenuOpen = false"
                            x-transition
                            x-cloak
                            class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                        <!-- Admin menu -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gray-800 text-white rounded-lg flex items-center justify-center font-semibold text-lg">
                                    {{ strtoupper(substr($user->usr_email, 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $user->usr_email }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ $user->usr_level }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="py-2">
                            <button class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50 flex items-center">
                                <i class="fad fa-user-shield text-blue-500 mr-3"></i>
                                Configurações
                            </button>
                            <button class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50 flex items-center">
                                <i class="fad fa-key text-green-500 mr-3"></i>
                                Alterar Senha
                            </button>
                        </div>
                        
                        <div class="border-t border-gray-100 py-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 flex items-center">
                                    <i class="fad fa-sign-out text-red-500 mr-3"></i>
                                    Sair
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wave transition -->
            <div class="wave-transition">
                <div class="container mx-auto px-4">
                    <!-- Badge -->
                    <span class="inline-block px-4 py-2 mt-10 bg-gray-800 text-white rounded-full text-sm font-bold mb-6">
                        @if(request()->routeIs('admin.dashboard'))
                            Dashboard
                        @elseif(request()->routeIs('admin.management'))
                            Gestão do Sistema
                        @else
                            Admin
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-grow bg-white">
            <div class="container mx-auto px-4 py-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Back to top button -->
        <div
            x-show="showBackToTop"
            @click="scrollToTop()"
            class="fixed bottom-8 right-8 p-3 px-4 bg-white rounded-lg shadow-lg text-gray-800 hover:bg-gray-800 hover:text-white hover:cursor-pointer transition-colors duration-200 z-50"
        >
            <i class="fad fa-arrow-up text-xl"></i>
        </div>
    </div>

    <script>
        function adminPage() {
            return {
                showStickyHeader: false,
                showBackToTop: false,
                
                init() {
                    this.handleScroll();
                    window.addEventListener('scroll', () => this.handleScroll());
                },
                
                handleScroll() {
                    if (this.$refs.mainHeader) {
                        const headerBottom = this.$refs.mainHeader.getBoundingClientRect().bottom;
                        this.showStickyHeader = headerBottom < 0;
                    }
                    
                    this.showBackToTop = window.scrollY > 500;
                },
                
                scrollToTop() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            }
        }
    </script>

    <style>
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

        .active-tab::after {
            width: 100% !important;
            height: 3px !important;
            background-color: #000 !important;
        }

        /* Logo animation styles */
        .logo-container {
            perspective: 1000px;
            height: 42px;
            width: 42px;
        }

        .logo-box {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            cursor: pointer;
        }

        .logo-container:hover .logo-box {
            transform: rotateY(180deg) rotate(45deg);
        }

        .logo-front, .logo-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }

        .logo-front {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .logo-back {
            background-color: #1f2937;
            transform: rotateY(180deg);
        }

        [x-cloak] { 
            display: none !important; 
        }

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
    </style>

    @livewireScripts
</body>
</html> 