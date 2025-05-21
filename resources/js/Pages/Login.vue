<script setup>
    import onlyWebNews from '../assets/web_background.png'

    import { ref } from 'vue'
    import { Link } from '@inertiajs/vue3'

    const email = ref('')
    const password = ref('')

    const loginType = ref('email')
    const showPassword = ref(false)

    const handleSubmit = () => {
        // Implement your login logic here
        console.log('Email:', email.value)
    }
</script>

<template>
    <div class="min-h-screen flex items-center justify-center relative">

        <!-- Home button -->
        <Link href="/" class="fixed top-4 right-4 p-3 bg-white shadow-xl border border-gray-200 rounded-lg text-gray-800 hover:bg-gray-800 hover:text-white font-semibold hover:cursor-pointer transition-colors duration-200">
            <i class="fad fa-newspaper text-xl"></i>
        </Link>

        <div class="bg-white rounded-lg shadow-xl border border-gray-200 w-full max-w-md mx-auto">
            <div class="flex flex-row justify-between w-full mb-6 px-4">
                <div>
                    <h2 class="text-2xl font-semibold text-left italic pt-8">WebNews</h2>
                </div>
                <img src="../assets/spider_going_down.png" alt="Spider" class="w-16 h-16 object-contain" />
            </div>
            
            <form @submit.prevent="handleSubmit" class="space-y-4 px-4">
                <div class="flex flex-row mb-4">
                    <div class="p-3 bg-gray-200/50 rounded-l-md flex items-center pointer-events-none">
                        <i class="fad fa-envelope text-sm text-gray-600/70"></i>
                    </div>
                    <input
                        type="email"
                        v-model="email"
                        class="w-full px- pl-2 py-2 border border-gray-200 rounded-r-md focus:outline-none focus:ring-2 focus:ring-gray-800/40"
                        placeholder="Seu email"
                        required
                    />
                </div>

                <div v-if="loginType === 'password'" class="flex flex-row mb-4">
                    <div class="p-3 bg-gray-200/50 rounded-l-md flex items-center pointer-events-none">
                        <i class="fad fa-key text-sm text-gray-600/70"></i>
                    </div>
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        v-model="password"
                        class="w-full px-4 pl-2 py-2 border border-gray-200 focus:outline-none focus:ring-1 focus:ring-gray-800/40"
                        placeholder="Sua senha"
                        required
                    />
                    <button 
                        type="button"
                        @click="showPassword = !showPassword"
                        class="px-3 flex items-center bg-gray-200/50 rounded-r-md text-gray-500 hover:text-gray-700"
                    >
                        <i :class="showPassword ? 'fad fa-eye-slash' : 'fad fa-eye'" class="text-sm"></i>
                    </button>
                </div>

                <div class="flex space-x-4">
                    <button
                        @click="loginType = 'password'"
                        v-if="loginType === 'email'"
                        type="button"
                        class="flex-1 text-sm text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center"
                    >
                        <i class="fad fa-key mr-2 text-xs"></i>
                        Login com Senha
                    </button>

                    <button
                        @click="loginType = 'email'"
                        v-if="loginType === 'password'"
                        type="button"
                        class="flex-1 text-sm text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center"
                    >
                        <i class="fad fa-envelope mr-2 text-xs"></i>
                        Login Simplificado
                    </button>

                    <button
                        type="submit"
                        class="flex-1 text-sm text-center hover:cursor-pointer bg-white border border-gray-300 text-gray-800 hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center"
                    >
                        <i class="fad fa-sign-in mr-2 text-xs"></i>
                        Login
                    </button>
                </div>
            </form>

            <div class="px-4 mt-6">
                <p 
                    class="text-xs text-center mt-2 text-gray-500/50"
                    v-if="loginType === 'email'"
                >
                    Login simplificado, você receberá um email com um link de acesso.
                </p>
            </div>

            <div class="bg-black w-full h-1 mt-6 rounded-b-lg"></div>
        </div>
    </div>
</template>