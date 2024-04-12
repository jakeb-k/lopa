<script setup>
import {onMounted} from 'vue'; 
import PieChart from '@/Components/Finance/PieChart.vue'; 

var pieLabels = []; 
var pieData = []; 

const props = defineProps({
    budget: {
        type: Object
    }
});
onMounted(() => {
   pieData=[(props.budget['income'] * props.budget.housing), 
            (props.budget['income'] * props.budget.utils),
            (props.budget['income'] * props.budget.food),
            (props.budget['income'] * props.budget.transport),
            (props.budget['income'] * props.budget.savings)]; 

    
})
</script>
<template>
    <div class="mt-10 p-8 mx-auto w-2/5 h-[450px] bg-gray-200 rounded-xl flex flex-row">
        <div class="flex flex-col flex-grow w-1/2">
        <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>
            <div class="mt-4 flex justify-between w-3/4">
                <span>Income: </span>
                <span>${{ props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-3/4">
                <span>Housing: </span>
                <span>${{ props.budget.housing * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-3/4">
                <span>Utilities: </span>
                <span> ${{ props.budget.utils * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-3/4">
                <span>Food: </span>
                <span> ${{ props.budget.food * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-3/4">
                <span>Transport: </span>
                <span>${{ props.budget.transport * props.budget.income }}</span>
            </div>
            <div class="mt-4 flex justify-between w-3/4">
                <span>Savings: </span>
                <span>${{ props.budget.savings * props.budget.income }}</span>
            </div>
        </div>
        
        <div class="w-7/12">
            <PieChart :pieData="pieData"></PieChart>
        </div>

    </div>
</template>