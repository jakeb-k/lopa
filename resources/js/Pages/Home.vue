<script setup>
import {onMounted} from 'vue'; 
import MasterLayout from '@/Layouts/MasterLayout.vue';
import { Head } from '@inertiajs/vue3';
import Budget from '@/Components/Finance/Budget.vue';


const props = defineProps({
    budgets: {
        type: Object
    }
 });

 onMounted( () => {

})

</script>

<template>
    <Head title="Home" />

    <MasterLayout>
       <div class="w-full h-screen bg-gray-700 absolute">
            <div class="w-1/2 h-48 p-10 bg-gray-200 text-black mx-auto mt-24 rounded-xl ">
                <h1> Welcome to LOPA! Your life optimisation personal assistant.</h1>
                <br> 
                <p> <a class="text-blue-500 hover:underline hover:text-blue-500/80" :href="route('login')">Login </a> or  
                    <a class="text-blue-500 hover:underline hover:text-blue-500/80" :href="route('register')">Register</a> to get started!
                </p>
    
            </div>
       </div>
    </MasterLayout>
</template>
