<script setup>
import { onMounted, ref } from 'vue';
import { useModal } from 'vue-final-modal';
import { router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import ModalUpdateBudget from './ModalUpdateBudget.vue'


const props = defineProps({
    budget: Object, 
    flash: Object
})

var title = ref(props.budget.name); 
var amount = ref(props.budget.amount);
var progress = ref(props.budget.progress);
var id = ref(props.budget.id);


const { open, close } = useModal({
    component: ModalUpdateBudget,
    attrs: {
        title: title,
        amount: amount,
        progress: progress,
        id: id,
        onConfirm() {
        close()
        },
    },
}); 

function deleteBudget(id) {
    if (confirm('Are you sure you want to delete this budget and subbudgets?\nYou cannot recover it once deleted')) {
        Inertia.delete(`public/budget/${id}`)
    }

}

onMounted(()=>{

}); 

</script>
<template>
   <div class="mt-4 flex justify-between items-center w-full">
        <div class="flex flex-row text-left">
            <span class="mr-6">{{ props.budget.name }}: </span>
            <span class="basis-1/4">${{props.budget.progress }}/{{props.budget.amount }}</span>
        </div>
        
        <div class="flex flex-row lg:w-1/4 w-1/5 justify-between">
            <button class=" hover:text-blue-500 border border-blue-500 hover:underline py-2 px-4 rounded-2xl
            hover:bg-white duration-150 ease-in-out"
            @click="() => open()"><i class="fa-regular fa-pen-to-square"></i></button>

            <button v-if="title != 'Income'" class="hover:text-red-500 border border-red-500 hover:underline py-2 px-4 rounded-2xl
            hover:bg-white duration-150 ease-in-out"
            @click="deleteBudget(id)"><i class="fa-solid fa-trash"></i></button>
        </div>
        
    
    </div>

</template>