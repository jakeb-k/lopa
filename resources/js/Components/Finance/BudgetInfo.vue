<script setup>
import { onMounted, ref } from 'vue';
import { useModal } from 'vue-final-modal';

import ModalBudget from './ModalBudget.vue'


const props = defineProps({
    income: Number,
    budgetCat: Number,
    name: String, 
    id: Number,
})
var title = ref(props.name); 
var budgetPercent = ref(props.budgetCat);
var id = ref(props.id);
var income = ref(props.income); 

const { open, close } = useModal({
    component: ModalBudget,
    attrs: {
        title: title,
        budgetPercent: budgetPercent,
        id: id,
        income: income,
        onConfirm() {
        close()
        },
    },
}); 


onMounted(()=>{
    if(!props.budgetCat){
        props.budgetCat = 1
    }
}); 

</script>
<template>
   <div class="mt-4 flex justify-between items-center w-full">
        <span class="basis-1/3">{{ props.name }}: </span>
        <span class="basis-1/4">${{props.budgetCat * props.income }}</span>
        <button class="basis-1/6 hover:text-blue-500 border border-blue-500 hover:underline p-2 rounded-2xl
        hover:bg-white duration-150 ease-in-out"
        @click="() => open()">UPDATE</button>

    </div>

</template>