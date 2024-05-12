<script setup>
import { onMounted, ref } from 'vue';
import { useModal } from 'vue-final-modal';
import { router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import ModalUpdateBudget from './ModalUpdateBudget.vue';
import Subbudget from './Subbudget.vue'; 


const props = defineProps({
    budget: Object, 
    flash: Object
})

var title = ref(props.budget.name); 
var amount = ref(props.budget.amount);
var progress = ref(props.budget.progress);
var id = ref(props.budget.id);
const showSubbudgets = ref(false); 


const subbudgets = props.budget.subbudgets; 


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

function toggleSubbudgets(){
    showSubbudgets.value = !showSubbudgets.value; 
}


</script>
<template>
   <div class="mt-4 flex justify-between items-center w-full">
        <div class="flex flex-row text-left">
            <span class="mr-6">{{ props.budget.name }}: </span>
            <span class="basis-1/4">${{props.budget.progress }}/{{props.budget.amount }}</span>
        </div>
        
        <div class="flex flex-row lg:w-5/12 w-1/3 justify-between">
            <button class="hover:text-blue-500 border border-blue-500 hover:underline py-2 px-4 rounded-2xl
            hover:bg-white duration-150 ease-in-out"
            @click="() => open()"><i class="fa-regular fa-pen-to-square"></i></button>

            <button v-if="title != 'Income'" class="hover:text-red-500 border border-red-500 hover:underline py-2 px-4 rounded-2xl
            hover:bg-white duration-150 ease-in-out"
            @click="deleteBudget(id)"><i class="fa-solid fa-trash"></i></button>

            <button  v-if="title != 'Income'" class="hover:text-lime-500 border border-lime-500 hover:underline py-2 px-4 rounded-2xl
            hover:bg-white duration-150 ease-in-out"
            @click="toggleSubbudgets()"><i class="fa-solid fa-caret-down"></i></button>

        </div>

        
    
    </div>

    <div v-if="showSubbudgets" v-for="budget in subbudgets" >
        <Subbudget :budget=budget></Subbudget>
    </div>
        

</template>