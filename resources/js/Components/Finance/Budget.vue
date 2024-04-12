<script setup>
import {onMounted} from 'vue'; 
import PieChart from '@/Components/Finance/PieChart.vue'; 
import BudgetInfo from '@/Components/Budget/BudgetInfo.vue'; 
 
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
            (props.budget['income'] * props.budget.savings)
    ];
}); 
</script>
<template>

    <div class="mt-10 p-8 mx-auto w-fit h-[450px] bg-gray-200 rounded-xl flex flex-row">

        <div class="flex flex-col w-1/2 mr-20">
        <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>
          
            <BudgetInfo :budgetCat="1" :income="props.budget.income" :name="'Income'">
            </BudgetInfo>

            <BudgetInfo :budgetCat="props.budget.housing" :income="props.budget.income" :name="'Housing'">
            </BudgetInfo>

            <BudgetInfo :budgetCat="props.budget.food" :income="props.budget.income" :name="'Food'">
            </BudgetInfo>

            <BudgetInfo :budgetCat="props.budget.transport" :income="props.budget.income" :name="'Transport'">
            </BudgetInfo>

            <BudgetInfo :budgetCat="props.budget.savings" :income="props.budget.income" :name="'Savings'">
            </BudgetInfo>
        </div>
        
        <div class="w-3/5">
            <PieChart :pieLabels=" ['Housing', 'Utilities','Food', 'Transport','Savings']" :pieData="pieData"></PieChart>
        </div>

    </div>
</template>