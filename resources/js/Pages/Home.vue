<script setup>
    import logo from '../assets/spider_logo_transparent.png'
    import logoOnlyWeb from '../assets/logo_only_web.png'
    import logoOnlyWebWhite from '../assets/logo_only_web_white.png'
    import spiderDivider from '../assets/spider_divider.png'
    import devKurt from '../assets/dev_kurt.jpg'
    import devVitor from '../assets/dev_vitor.jpg'

    import { ref, onMounted, onUnmounted, watch } from 'vue'
    import axios from 'axios'
    import FeatureCard from '@/Components/FeatureCard.vue'
    import AuthorCard from '@/Components/AuthorCard.vue'
    import NewsletterCard from '@/Components/NewsletterCard.vue'

    import { toast } from 'vue3-toastify'
    import 'vue3-toastify/dist/index.css'

    import { Link } from '@inertiajs/vue3'
    
    // Props from the server
    const props = defineProps({
        authors: {
            type: Array,
            default: () => []
        },
        newsletters: {
            type: Array,
            default: () => []
        }
    });
    
    const subscriberEmail = ref('')
    const searchQuery = ref('')
    const loading = ref(false)
    const activeTab = ref('sobre')
    const isMenuOpen = ref(false)
    const showBackToTop = ref(false)
    const mainHeader = ref(null)
    const showStickyHeader = ref(false)

    const subscribe = async () => {
        if (!subscriberEmail.value) {
            toast.warning('Digite um e-mail antes de assinar', { position: toast.POSITION.TOP_RIGHT })
            return
        }

        loading.value = true
        toast.info('Assinando…', { position: toast.POSITION.TOP_RIGHT })

        try {
            const { data } = await axios.post('/subscribe', {
                sub_email: subscriberEmail.value
            })
            // data = { status: true|false, message: string }
            if (data.status) {
                toast.success(data.message, { position: toast.POSITION.TOP_RIGHT })
                subscriberEmail.value = ''   // limpa o input, se quiser
            } else {
                toast.error(data.message,   { position: toast.POSITION.TOP_RIGHT })
            }
        } catch (err) {
            // se status 409 (já existe), por exemplo:
            const msg = err.response?.data?.message || 'Erro ao assinar'
            toast.error(msg, { position: toast.POSITION.TOP_RIGHT })
        } finally {
            loading.value = false
        }
    }
    
    const toggleMenu = () => {
        isMenuOpen.value = !isMenuOpen.value
    }

    const goLogin = () => {
        window.location.href = '/login';
    }
    
    // Function to handle scroll and show/hide sticky header
    const handleScroll = () => {
        if (mainHeader.value) {
            const headerBottom = mainHeader.value.getBoundingClientRect().bottom
            showStickyHeader.value = headerBottom < 0
        }
        
        // Show back-to-top button when scrolled down more than 500px
        showBackToTop.value = window.scrollY > 500
    }
    
    // Function to scroll to top
    const scrollToTop = () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
    }
    
    // Watch for tab changes and scroll to top
    watch(activeTab, () => {
        scrollToTop()
    })
    
    // Setup and cleanup scroll listener
    onMounted(() => {
        window.addEventListener('scroll', handleScroll)
    })
    
    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll)
    })
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <!-- Floating sticky header that appears on scroll -->
        <div 
            class="fixed top-4 left-0 right-0 mx-auto w-11/12 max-w-7xl bg-gray-300/50 rounded-xl shadow-lg transition-all duration-300 z-50 py-3 px-6 flex items-center justify-between"
            :class="{'translate-y-0 opacity-100': showStickyHeader, '-translate-y-20 opacity-0': !showStickyHeader}"
        >
            <div class="flex items-center">
                <!-- Logo in white square with hover effect -->
                <div class="logo-container mr-4">
                    <div class="logo-box">
                        <div class="logo-front flex items-center justify-center">
                            <img :src="logoOnlyWeb" alt="WebNews Logo" class="h-10" />
                        </div>
                        <div class="logo-back">
                            <img :src="logoOnlyWebWhite" alt="WebNews Logo" class="h-8" />
                        </div>
                    </div>
                </div>
                
                <!-- Navigation menu -->
                <nav class="flex space-x-6" aria-label="Navigation menu">
                    <a href="#" 
                        @click.prevent="activeTab = 'sobre'" 
                        :class="{'text-gray-900 font-medium active-tab': activeTab === 'sobre'}"
                        class="text-gray-600 hover:text-gray-800 hover:font-medium transition-all duration-200 relative nav-link">
                        Sobre
                    </a>
                    <a href="#" 
                        @click.prevent="activeTab = 'newsletters'" 
                        :class="{'text-gray-900 font-medium active-tab': activeTab === 'newsletters'}"
                        class="text-gray-600 hover:text-gray-800 hover:font-medium transition-all duration-200 relative nav-link">
                        Newsletters
                    </a>
                    <a href="#" 
                        @click.prevent="activeTab = 'autores'" 
                        :class="{'text-gray-900 font-medium active-tab': activeTab === 'autores'}"
                        class="text-gray-600 hover:text-gray-800 hover:font-medium transition-all duration-200 relative nav-link">
                        Autores
                    </a>
                </nav>
            </div>
            
            <!-- Spider button with dropdown -->
            <div class="relative">
                <button @click="toggleMenu" class="p-2 bg-white rounded-lg text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200">
                    <i class="fad fa-spider-black-widow text-xl"></i>
                </button>
                
                <!-- Dropdown menu -->
                <div v-if="isMenuOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                    <div class="px-4 py-2 flex items-center border-b border-gray-100">
                        <i class="fad fa-user-circle text-gray-700 text-xl mr-2"></i>
                        <span class="text-gray-800 font-medium">Perfil</span>
                    </div>
                    <div class="p-3">
                        <Link href="/login" 
                            class="w-full bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center">
                            <i class="fad fa-sign-in mr-2"></i>
                            Fazer Login
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top section with gray background and curved bottom -->
        <div class="bg-gray-200 relative">
            <!-- Header section -->
            <div class="container mx-auto px-4 py-6 flex items-center justify-between" ref="mainHeader">
                <div class="flex items-center">
                    <!-- Logo + system name -->
                    <img :src="logo" alt="Logo" class="h-16" />
                    <span class="ml-3 text-xl font-semibold">WebNews</span>
                    
                    <!-- Vertical divider -->
                    <div class="h-6 w-px bg-gray-400 mx-4"></div>
                    
                    <!-- Navigation menu -->
                    <nav class="flex space-x-6" aria-label="Navigation menu">
                        <a href="#" 
                            @click.prevent="activeTab = 'sobre'" 
                            :class="{'text-gray-900 font-medium active-tab': activeTab === 'sobre'}"
                            class="text-gray-600 hover:text-gray-800 hover:font-medium transition-all duration-200 relative nav-link">
                            Sobre
                        </a>
                        <a href="#" 
                            @click.prevent="activeTab = 'newsletters'" 
                            :class="{'text-gray-900 font-medium active-tab': activeTab === 'newsletters'}"
                            class="text-gray-600 hover:text-gray-800 hover:font-medium transition-all duration-200 relative nav-link">
                            Newsletters
                        </a>
                        <a href="#" 
                            @click.prevent="activeTab = 'autores'" 
                            :class="{'text-gray-900 font-medium active-tab': activeTab === 'autores'}"
                            class="text-gray-600 hover:text-gray-800 hover:font-medium transition-all duration-200 relative nav-link">
                            Autores
                        </a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Spider button with dropdown -->
                    <div class="relative">
                        <button @click="toggleMenu" class="p-2 bg-white rounded-lg text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200">
                            <i class="fad fa-spider-black-widow text-2xl"></i>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div v-if="isMenuOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <div class="px-4 py-2 flex items-center border-b border-gray-100">
                                <i class="fad fa-user-circle text-gray-700 text-xl mr-2"></i>
                                <span class="text-gray-800 font-medium">Perfil</span>
                            </div>
                            <div class="p-3">
                                <button class="w-full bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:cursor-pointer hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center">
                                    <i class="fad fa-sign-in mr-2"></i>
                                    Fazer Login
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero section -->
            <div class="container mx-auto px-4 py-12 pt-4 text-center">
                <!-- Circular logo background - white with inner shadow -->
                <div class="inline-block bg-white p-8 rounded-full shadow-inner border border-gray-300">
                    <img :src="logo" alt="Logo" class="h-64 mx-auto spider-logo" />
                </div>
                <!-- System name -->
                <h1 class="mt-10 text-3xl font-semibold italic">WebNews</h1>
                <!-- Description text -->
                <p class="mt-3 text-lg text-gray-600/55">
                    Conecte-se a teia de conhecimento que vem crescendo...
                </p>
                <!-- Email input + Subscribe button styled with Tailwind -->
                <div class="mt-12 mb-8 flex justify-center">
                    <div class="flex w-full max-w-3xl">
                        <!-- Icon Prepend -->
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700/40 border border-gray-300 border-r-0 rounded-l-md h-full">
                                <i class="fad fa-envelope text-xl"></i>
                            </span>
                        </div>
                        <!-- Input Field -->
                        <input
                            type="email"
                            v-model="subscriberEmail"
                            placeholder="Digite seu e-mail"
                            class="flex-1 px-4 py-3 text-lg bg-white border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required
                        />
                        <!-- Subscribe Button -->
                        <button 
                            @click="subscribe"
                            :disabled="loading"
                            class="px-6 py-3 bg-white text-lg rounded-r-md text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200 border border-gray-300 border-l-0">
                            {{ loading ? 'Assinando...' : 'Assinar' }}
                        </button>
                    </div>
                </div>

                <!-- Partnership credit - centered -->
                <div class="text-center mb-8">
                    <h1 class="text-xl font-semibold italic text-gray-700/55">Uma parceria entre CASIS e TypeX @ UTFPR-FB ❤️</h1>
                </div>
            </div>

            <!-- Curved transition to white section -->
            <div class="wave-transition">
                <div v-if="activeTab === 'sobre'" class="flex flex-col items-center justify-center">
                    <!-- Badge -->
                    <span class="inline-block px-4 py-2 mt-10 bg-gray-800 text-white rounded-full text-sm font-bold mb-6">
                        Conteúdo de Qualidade
                    </span>
                </div>

                <div v-if="activeTab === 'newsletters'" class="flex flex-col items-center justify-center">
                    <!-- Badge -->
                    <span class="inline-block px-4 py-2 mt-10 bg-gray-800 text-white rounded-full text-sm font-bold mb-6">
                        Nossos Conteúdos
                    </span>
                </div>

                <div v-if="activeTab === 'autores'" class="flex flex-col items-center justify-center">
                    <!-- Badge -->
                    <span class="inline-block px-4 py-2 mt-10 bg-gray-800 text-white rounded-full text-sm font-bold mb-6">
                        Autores Cadastrados
                    </span>
                </div>
            </div>
        </div>

        <!-- Bottom white section -->   
        <div class="bg-white flex-grow">
            <div class="w-full pt-8">
                <!-- Tab content sections -->
                <div v-if="activeTab === 'sobre'" class="content-section">
                    <div class="w-full mt-8">
                        <div class="flex flex-col items-center text-center">
                            <!-- Title -->
                            <h1 class="text-4xl font-bold mt-4 mb-4 px-4">
                                Unificando e a disseminação de conteúdo
                            </h1>
                            
                            <!-- Subtitle -->
                            <p class="text-xl mt-2 text-gray-700/55 mb-6 max-w-3xl px-4">
                                Um local onde qualquer um pode começar a disponibilizar newsletters para diversos alunos da UTFPR. Feito por alunos, para alunos.
                            </p>
                            
                            <!-- Statistics -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 w-full max-w-2xl mt-6 px-4">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl font-bold text-gray-800">1</span>
                                    <span class="text-gray-700/55 mt-2">Autores</span>
                                </div>
                                
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl font-bold text-gray-800">1</span>
                                    <span class="text-gray-700/55 mt-2">Newsletters</span>
                                </div>
                                
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl font-bold text-gray-800">100%</span>
                                    <span class="text-gray-700/55 mt-2">Gratuito</span>
                                </div>
                            </div>
                            
                            <!-- Divider with spider image -->
                            <div class="w-full flex items-center justify-center px-4">
                                <div class="h-px bg-gray-300 w-1/4"></div>
                                <div class="mx-4">
                                    <img :src="spiderDivider" alt="Spider Divider" class="h-30 mt-4" />
                                </div>
                                <div class="h-px bg-gray-300 w-1/4"></div>
                            </div>
                            
                            <!-- Features Cards -->
                            <span class="inline-block px-4 py-2 mt-6 bg-gray-800 text-white rounded-full text-sm font-bold mb-6">
                                Features do Sistema
                            </span>
                            <div class="container w-full max-w-7xl mx-auto mt-8 mb-8 px-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10 gap-y-10">
                                    <!-- Card 1 -->
                                    <FeatureCard 
                                        icon="fad fa-paper-plane"
                                        title="Entrega Instantânea"
                                        body="Receba newsletters diretamente na sua caixa de entrada no momento da publicação."
                                    />
                                    
                                    <!-- Card 2 -->
                                    <FeatureCard 
                                        icon="fad fa-users"
                                        title="Feito por Alunos"
                                        body="Conteúdo criado por e para a comunidade acadêmica da UTFPR."
                                    />
                                    
                                    <!-- Card 3 -->
                                    <FeatureCard 
                                        icon="fad fa-shield-check"
                                        title="Qualidade Garantida"
                                        body="Todo conteúdo passa por revisão para garantir precisão e relevância."
                                    />
                                    
                                    <!-- Card 4 -->
                                    <FeatureCard 
                                        icon="fad fa-bullhorn"
                                        title="Torne-se Autor"
                                        body="Compartilhe seu conhecimento e contribua com a comunidade acadêmica."
                                    />
                                    
                                    <!-- Card 5 -->
                                    <FeatureCard 
                                        icon="fad fa-book-reader"
                                        title="Conteúdo Diversificado"
                                        body="De tecnologia a humanidades, encontre newsletters sobre diversos temas."
                                    />
                                    
                                    <!-- Card 6 -->
                                    <FeatureCard 
                                        icon="fad fa-mobile-android"
                                        title="Acesso Multiplataforma"
                                        body="Leia em qualquer dispositivo, a qualquer hora e em qualquer lugar."
                                    />

                                    <!-- Card 7 -->
                                    <FeatureCard 
                                        icon="fad fa-laptop-code"
                                        title="LIVT Stack | Markdown"
                                        body="O sistema é construído com as tecnologias mais recentes para garantir a melhor experiência."
                                    />

                                    <!-- Card 8 -->
                                    <FeatureCard 
                                        icon="fad fa-hand-holding-heart"
                                        title="Objetivo Extensionista"
                                        body="Nossa missão é disseminar conhecimento e inovação para para comunidade acadêmica."
                                    />

                                    <!-- Card 9 -->
                                    <FeatureCard 
                                        icon="fad fa-lightbulb-on"
                                        title="Inovação"
                                        body="Projeto em andamento, com novas funcionalidades sendo adicionadas regularmente."
                                    />
                                </div>
                            </div>

                            <!-- Divider with spider image -->
                            <div class="w-full flex items-center justify-center px-4">
                                <div class="h-px bg-gray-300 w-1/4"></div>
                                <div class="mx-4">
                                    <img :src="spiderDivider" alt="Spider Divider" class="h-30 mt-4" />
                                </div>
                                <div class="h-px bg-gray-300 w-1/4"></div>
                            </div>

                            <span class="inline-block px-4 py-2 mt-6 bg-gray-800 text-white rounded-full text-sm font-bold mb-6">
                                Preview do Email
                            </span>
                            
                            <div class="container w-full max-w-7xl mx-auto mt-8 mb-12 px-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
                                    <!-- Left column -->
                                    <div class="bg-gray-100 rounded-lg w-full min-h-[32rem] shadow-md flex flex-col items-center justify-center p-4">
                                        <i class="fad fa-construction fa-4x text-amber-400 mb-4"></i>
                                        <h2 class="text-2xl font-semibold text-center text-amber-500/50">Em breve, Estamos preparando para você!</h2>
                                    </div>
                                    
                                    <!-- Right column -->
                                    <div class="bg-gray-100 rounded-lg w-full min-h-[32rem] shadow-md flex flex-col items-center justify-center p-4">
                                        <i class="fad fa-construction fa-4x text-amber-400 mb-4"></i>
                                        <h2 class="text-2xl font-semibold text-center text-amber-500/50">Em breve, Estamos preparando para você!</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div v-if="activeTab === 'newsletters'" class="content-section">
                    <div class="w-full p-8">
                        <div class="flex flex-col items-center container w-full max-w-7xl mx-auto mb-8">
                            <h1 class="text-4xl font-bold mb-4 px-4 text-center">
                                Newsletters Cadastrados <i class="fad fa-newspaper" style="font-size: 1.6rem;"></i>
                            </h1>
                            
                            <!-- Subtitle -->
                            <p class="text-xl text-center mt-2 text-gray-700/55 mb-6 max-w-3xl px-4">
                                Fitre os registros por categoria, autor ou palavra-chave. aqui começa sua jornada de conhecimento.
                            </p>

                            <!-- Search Field -->
                            <div class="mt-4 mb-4 w-full flex justify-center px-4">
                                <div class="flex w-full max-w-4xl">
                                    <!-- Icon Prepend -->
                                    <div class="flex-shrink-0">
                                        <span class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700/40 border border-gray-300 border-r-0 rounded-l-md h-full">
                                            <i class="fad fa-search text-xl"></i>
                                        </span>
                                    </div>
                                    <!-- Input Field -->
                                    <input
                                        type="text"
                                        v-model="searchQuery"
                                        placeholder="Buscar newsletters..."
                                        class="flex-1 px-4 py-3 text-lg bg-white border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400"
                                    />
                                    <!-- Search Button -->
                                    <button 
                                        class="px-6 py-3 bg-white text-lg rounded-r-md text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200 border border-gray-300 border-l-0">
                                        Buscar
                                    </button>
                                </div>
                            </div>

                            <!-- Filter Button -->
                            <div class="w-full max-w-4xl mx-auto mb-6 flex flex-col sm:flex-row justify-between px-4">
                                <div class="flex items-center mb-4 sm:mb-0">
                                    <button class="px-5 py-2 bg-white rounded-md text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200 border border-gray-300 flex items-center">
                                        <i class="fad fa-filter mr-2"></i>
                                        Filtros Avançados
                                    </button>

                                    <button class="px-5 py-2 ml-4 bg-white rounded-md text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200 border border-gray-300 flex items-center">
                                        <i class="fad fa-tags mr-2"></i>
                                        Categorias
                                    </button>
                                </div>

                                <div class="flex items-center text-gray-700/55">
                                    Apresentado 1 de 10 resultados
                                </div>
                            </div>

                            <div class="flex justify-center w-full mt-8 px-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10 gap-y-10 md:place-items-center">
                                    <!-- Show message if no newsletters -->
                                    <div v-if="props.newsletters.length === 0" class="col-span-3 text-center text-gray-500 py-10">
                                        <i class="fad fa-newspaper-slash text-4xl mb-4"></i>
                                        <p class="text-xl">Nenhuma newsletter cadastrada no momento</p>
                                    </div>
                                    
                                    <!-- Dynamic Author Cards -->
                                    <NewsletterCard 
                                        v-for="newsletter in props.newsletters" 
                                        :key="newsletter.id"
                                        :icon="newsletter.icon"
                                        :title="newsletter.title"
                                        :description="newsletter.body"
                                        :badges="newsletter.categories"
                                        :author="newsletter.author"
                                        :hour="newsletter.hour"
                                        :frequency="newsletter.frequency"
                                        :initialSubscribed="false"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="activeTab === 'autores'" class="content-section">
                    <div class="w-full p-8">
                        <div class="flex flex-col items-center container w-full max-w-7xl mx-auto mb-8">
                            <h1 class="text-4xl font-bold mb-4 px-4 text-center">
                                Tornesse um Autor <i class="fad fa-bullhorn" style="font-size: 1.6rem;"></i>
                            </h1>
                            
                            <!-- Subtitle -->
                            <p class="text-xl text-center mt-2 text-gray-700/55 mb-6 max-w-3xl px-4">
                                Credencie-se no sistema para poder publicar newsletters e compartilhar seu conhecimento com a comunidade acadêmica.
                            </p>

                            <!-- Register Button -->
                            <button class="px-6 py-3 bg-white text-lg rounded-md text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200 border border-gray-300 mb-2">
                                <i class="fad fa-user-plus mr-2"></i>
                                Me Cadastrar
                            </button>

                            <div class="flex justify-center w-full mt-8 px-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10 gap-y-10 md:place-items-center">
                                    <!-- Show message if no authors -->
                                    <div v-if="props.authors.length === 0" class="col-span-3 text-center text-gray-500 py-10">
                                        <i class="fad fa-user-slash text-4xl mb-4"></i>
                                        <p class="text-xl">Nenhum autor cadastrado no momento</p>
                                    </div>
                                    
                                    <!-- Dynamic Author Cards -->
                                    <AuthorCard 
                                        v-for="author in props.authors" 
                                        :key="author.id"
                                        :image="author.image || devKurt" 
                                        :name="author.name"
                                        :description="author.description"
                                        :badges="author.badges"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Developers section with black background - only shown in 'sobre' tab -->
        <div v-if="activeTab === 'sobre'" class="bg-gray-900 py-8">
            <div class="container mx-auto px-4 h-100 mt-10">
                <h2 class="text-3xl font-bold text-white text-center italic mt-6 mb-16">Desenvolvedores</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                    <!-- Developer Card 1 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg h-full">
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex items-center mb-4">
                                <div class="w-20 h-20 rounded-md bg-gray-700 overflow-hidden mr-4">
                                    <!-- Dev photo placeholder -->
                                    <img :src="devKurt" alt="Developer" class="w-full h-full object-cover" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Felipe Kurt Pohling</h3>
                                    <p class="text-gray-400">FullStack Developer - PHP</p>
                                </div>
                            </div>
                            <p class="text-gray-300 mb-4">Diretor de Ensino e Pesquisa @ CASIS-FB - Especialista em Laravel e TailwindCSS</p>
                            <div class="mt-auto">
                                <a href="https://github.com/Kzrtt" target="_blank" class="inline-block bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                                    <i class="fab fa-github mr-2"></i> GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Developer Card 2 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg h-full">
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex items-center mb-4">
                                <div class="w-20 h-20 rounded-md bg-gray-700 overflow-hidden mr-4">
                                    <!-- Dev photo placeholder -->
                                    <img :src="devVitor" alt="Developer" class="w-full h-full object-cover" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Vitor Ferreira</h3>
                                    <p class="text-gray-400">FullStack Developer - PHP</p>
                                </div>
                            </div>
                            <p class="text-gray-300 mb-4">Presidente @ TypeX - Especialista em PHP</p>
                            <div class="mt-auto">
                                <a href="https://github.com/VitorFerreiraCode" target="_blank" class="inline-block bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                                    <i class="fab fa-github mr-2"></i> GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-20">
                    <div class="border-t border-gray-700 w-200"></div>
                </div>
            </div>
        </div>
        
        <!-- Footer with gradient black background -->
        <footer>
            <!-- Darker black section -->
            <div class="bg-gray-900 pt-2 pb-15">
                <div class="container mx-auto px-4">
                    <div class="text-center">
                        <p class="text-gray-400 mt-12 mb-4">@2025 WebNews. All rights reserved.</p>
                        <p class="text-gray-500 text-sm max-w-2xl mx-auto">Esse projeto surgiu como forma de estudo, e agora ele pretende o impulsionar através de emails.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Back to top button -->
        <div 
            v-if="showBackToTop" 
            @click="scrollToTop"
            class="fixed bottom-8 right-8 p-3 px-4 bg-white rounded-lg shadow-lg text-gray-800 hover:bg-gray-800 hover:text-white hover:cursor-pointer transition-colors duration-200 z-50"
        >
            <i class="fad fa-arrow-up text-xl"></i>
        </div>
    </div>
</template>

<style scoped>
.shadow-inner {
    box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
}

.spider-logo {
    filter: drop-shadow(0 0 3px rgba(0, 0, 0, 0.2));
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

.content-section {
    min-height: 300px;
    transition: all 0.3s ease;
    width: 100%;
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
    background-color: #1f2937; /* Using the same gray-800 as the spider button hover state */
    transform: rotateY(180deg);
}
</style>
