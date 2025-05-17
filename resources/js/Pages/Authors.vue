<template>
    <div class="bg-white py-16 px-4 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-center text-gray-900 mb-12">Perfil do Autor</h1>

            <div class="bg-gray-100 rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informações Pessoais</h2>
                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nome</label>
                        <input type="text" id="name" name="name" placeholder="Digite seu nome"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 text-gray-800" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Alterar e-mail</label>
                        <input type="email" id="email" name="email" placeholder="Digite seu e-mail"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 text-gray-800">
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-2">Alterar senha</label>
                        <input type="password" id="password" name="password" placeholder="Digite sua nova senha"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 text-gray-800">
                    </div>

                                        <div>
                        <label for="password" class="block text-gray-700 font-medium mb-2">Confirmar senha</label>
                        <input type="password" id="password" name="password" placeholder="***********"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 text-gray-800">
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit"
                                class="px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-colors duration-200">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</template>

<script setup>

</script>

