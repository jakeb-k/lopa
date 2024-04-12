<script setup>
import {onMounted} from 'vue'; 
import PieChart from '@/Components/Finance/PieChart.vue'; 


const props = defineProps({
    budget: {
        type: Object
    }
});
onMounted( () => {
    console.log(props)
})
</script>
<template>
    <div class="mt-10 p-8 mx-auto w-1/2 h-[450px] bg-gray-200 rounded-xl flex flex-row">
        <div class="flex flex-col flex-grow w-1/2">
        <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>
            <div class="mt-4 flex justify-between w-1/2">
                <span>Income: </span>
                <span>${{ props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-1/2">
                <span>Housing: </span>
                <span>${{ props.budget.housing * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-1/2">
                <span>Utilities: </span>
                <span> ${{ props.budget.utils * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-1/2">
                <span>Food: </span>
                <span> ${{ props.budget.food * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-1/2">
                <span>Transport: </span>
                <span>${{ props.budget.transport * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-1/2">
                <span>Savings: </span>
                <span>${{ props.budget.savings * props.budget.income }}</span>
            </div>
        </div>
        
        <div>
            <PieChart></PieChart>
        </div>

    </div>
</template>