<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ModalsContainer } from 'vue-final-modal'; 
</script>

<template>
    <div class="w-full bg-gray-100">
        <div class="flex flex-row justify-around items-center mx-auto">
            <p>LOPA: Life Optimisation Personal Assistant</p>
            <div class="w-1/4 flex flex-row justify-around">
                <Link class="text-xl hover:underline hover:text-blue-500" :href="route('login')">Log In</Link>
                <Link class="text-xl hover:underline hover:text-blue-500" :href="route('register')">Register</Link>
            </div>
            

        </div>
    </div>
    <main>
        <slot />
        <ModalsContainer />
    </main>
</template>
