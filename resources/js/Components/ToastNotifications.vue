<!-- resources/js/Components/ToastNotifications.vue -->
<template>
    <!-- Este componente não renderiza nada visual diretamente -->
</template>

<script setup>
    import { useToasts } from '@/Composables/useToasts'
    // Chama o composable para começar a “ouvir” as flash messages
    useToasts()
</script>
