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
        <div class="h-dvh w-full pt-20 bg-gray-700">
            <p class="text-3xl text-white underline text-center">Home Page</p>
            <Budget :budgets="budgets"></Budget>
        </div>
         
    </MasterLayout>
</template>
