<script setup>
import { onMounted } from 'vue';


const props = defineProps({
    income: Number,
    budgetCat: Number,
    name: String, 
})

onMounted(()=>{
        if(!props.budgetCat){
            props.budgetCat = 1
        }
}); 

</script>
<template>
   <div class="mt-4 flex justify-between w-full">
        <span class="basis-1/3">{{ props.name }}: </span>
        <span class="basis-1/4">${{props.budgetCat * props.income }}</span>
        <button class="basis-1/6">EDIT</button>

    </div>
</template>