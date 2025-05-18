<template>
    <div class="bg-gray-100 rounded-lg pt-0 shadow-md hover:shadow-lg text-left transition-all duration-200 hover:scale-[1.03] transform w-full h-full flex flex-col">
        <div class="flex flex-col px-6 items-start flex-grow">
            <div class="flex flex-row justify-between w-full">
                <div class="bg-white rounded-lg p-4 shadow-sm mb-4 mt-6 flex justify-center items-center w-20 h-20">
                    <i :class="icon" class="text-4xl text-gray-700"></i>
                </div>
                <div class="flex items-center">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" v-model="isSubscribed" name="newsletter-subscription" class="sr-only peer">
                        <div class="relative w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gray-800"></div>
                    </label>
                </div>
            </div>
            <h3 class="text-xl font-bold mb-2 text-gray-800">{{ title }}</h3>
            <p class="text-gray-600 text-left mb-4" v-html="description"></p>
            
            <!-- Badges -->
            <div class="flex flex-wrap gap-2 mb-6">
                <span 
                    v-for="(badge, index) in badges" 
                    :key="index" 
                    class="px-3 py-1 bg-gray-800 text-white text-xs font-semibold rounded-full"
                >
                    {{ badge }}
                </span>
            </div>
            
            <!-- Author --> 
            <div class="flex items-center mb-3 ml-1">
                <i class="fad fa-user-edit mr-2 text-gray-600"></i>
                <span class="text-gray-700 text-sm font-medium">{{ author }}</span>
            </div>

            <div class="flex items-center mb-3 ml-1">
                <i class="fad fa-clock mr-2 text-gray-600"></i>
                <span class="text-gray-700 text-sm font-medium">{{ hour }}</span>
            </div>

            <div class="flex items-center mb-7 ml-1">
                <i class="fad fa-calendar-alt mr-2 text-gray-600"></i>
                <span class="text-gray-700 text-sm font-medium">{{ frequency }}</span>
            </div>

            <!-- Button -->
            <button class="w-full mt-auto bg-white text-gray-800 hover:cursor-pointer hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition-colors duration-200 flex items-center justify-center">
                <i class="fad fa-books mr-2"></i>
                Ver Edições
            </button>
        </div>
        
        
        
        <!-- Black band with spider image -->
        <div class="bg-gray-900 rounded-b-lg w-full mt-6 flex justify-center items-center">
            <img src="../assets/spider_white.png" alt="Spider Logo" class="h-12" />
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    
    const props = defineProps({
        icon: {
            type: String,
            default: 'fad fa-newspaper'
        },
        title: {
            type: String,
            required: true
        },
        description: {
            type: String,
            required: true
        },
        badges: {
            type: Array,
            default: () => []
        },
        author: {
            type: String,
            default: 'Anônimo'
        },
        hour: {
            type: String,
            default: '10:00'
        },
        frequency: {
            type: String,
            default: 'Semanal'
        },
        initialSubscribed: {
            type: Boolean,
            default: false
        }
    });
    
    const isSubscribed = ref(props.initialSubscribed);
</script> 