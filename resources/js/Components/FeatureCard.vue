<template>
    <div class="bg-gray-100 rounded-lg p-6 shadow-md hover:shadow-lg text-left transition-all duration-200 hover:scale-[1.03] transform w-full h-full">
        <div class="flex flex-col items-start">
            <div class="bg-white rounded-lg p-4 shadow-sm mb-4">
                <i :class="icon + ' text-gray-800 text-2xl'"></i>
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-800">{{ title }}</h3>
            <p class="text-gray-600 text-left">{{ body }}</p>
        </div>
    </div>
</template>

<script setup>
defineProps({
    icon: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    body: {
        type: String,
        required: true
    }
});
</script> 