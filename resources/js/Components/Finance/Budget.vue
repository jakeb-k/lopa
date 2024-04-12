<script setup>
import {onMounted} from 'vue'; 
import PieChart from '@/Components/Finance/PieChart.vue'; 
import BudgetInfo from '@/Components/Finance/BudgetInfo.vue'; 
import { Chart, registerables } from 'chart.js';

var pieData = []; 
Chart.register(...registerables);


const props = defineProps({
    budget: {
        type: Object
    }
});

function createPieChart(pieData){
  const ctx = document.getElementById('myPieChart').getContext('2d');
  new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Housing', 'Utilities', 'Food', 'Transport', 'Savings'],
        datasets: [{
          label: 'My Budget',
          data: pieData,
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
           'rgb(153, 102, 255)'
          ],
          hoverOffset: 4
        }]
      }
    });
}

onMounted(() => {
   pieData=[(props.budget['income'] * props.budget.housing), 
            (props.budget['income'] * props.budget.utils),
            (props.budget['income'] * props.budget.food),
            (props.budget['income'] * props.budget.transport),
            (props.budget['income'] * props.budget.savings)
    ];
    createPieChart(pieData); 
}); 
</script>
<template>

    <div class="mt-10 p-8 mx-auto w-3/5 h-[450px] bg-gray-200 rounded-xl flex flex-row">

        <div class="flex flex-col w-1/2 mr-20">
        <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>
          
            <BudgetInfo :id="props.budget.id" :budgetCat="1" :income="props.budget.income" :name="'Income'">
            </BudgetInfo>

            <BudgetInfo :id="props.budget.id" :budgetCat="props.budget.housing" :income="props.budget.income" :name="'Housing'">
            </BudgetInfo>

            <BudgetInfo :id="props.budget.id" :budgetCat="props.budget.food" :income="props.budget.income" :name="'Food'">
            </BudgetInfo>

            <BudgetInfo :id="props.budget.id" :budgetCat="props.budget.transport" :income="props.budget.income" :name="'Transport'">
            </BudgetInfo>

            <BudgetInfo :id="props.budget.id" :budgetCat="props.budget.savings" :income="props.budget.income" :name="'Savings'">
            </BudgetInfo>
        </div>
        
        <div class="w-3/5">
            <canvas id="myPieChart"></canvas>
        </div>

    </div>
</template>