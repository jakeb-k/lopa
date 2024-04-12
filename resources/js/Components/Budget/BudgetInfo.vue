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
        <span>{{ props.name }}: </span>
        <span>${{props.budgetCat * props.income }}</span>
    </div>
</template>