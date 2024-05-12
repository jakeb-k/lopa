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
        <div class="h-full w-full pt-1 bg-gray-700 pb-10">
            <Budget :budgets="budgets"></Budget>
        </div>
         
    </MasterLayout>
</template>
