<script setup>
import { onMounted, ref } from 'vue';
import { useModal } from 'vue-final-modal';
import { router } from '@inertiajs/vue3';

import ModalBudget from './ModalBudget.vue'


const props = defineProps({
    budget: Object, 
    flash: Object
})

var title = ref(props.budget.name); 
var amount = ref(props.budget.amount);
var progress = ref(props.budget.progress);
var id = ref(props.budget.id);


const { open, close } = useModal({
    component: ModalBudget,
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


onMounted(()=>{

}); 

</script>
<template>
   <div class="mt-4 flex justify-between items-center w-full">
        <span class="basis-1/3">{{ props.budget.name }}: </span>
        <span class="basis-1/4">${{props.budget.progress }}/{{props.budget.amount }}</span>
        <button class="basis-1/6 hover:text-blue-500 border border-blue-500 hover:underline p-2 rounded-2xl
        hover:bg-white duration-150 ease-in-out"
        @click="() => open()">UPDATE</button>
    
    </div>

</template>