<script setup>
import {onMounted, ref} from 'vue'; 

import BudgetInfo from '@/Components/Finance/BudgetInfo.vue'; 
import { Chart, registerables } from 'chart.js';

var pieData = []; 
var pieLabels = [];
let myChart = null;  
Chart.register(...registerables);


const props = defineProps({
    budgets: {
        type: Object
    }
});

function createPieChart(pieData, pieLabels){
  const ctx = document.getElementById('myPieChart').getContext('2d');
  if(myChart){
    myChart.destroy()
  }
  myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: pieLabels,
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
    Object.keys(props.budgets).forEach(key => {
       
        if(props.budgets[key].name != 'Income') {
            pieData.push(props.budgets[key].amount);
            pieLabels.push(props.budgets[key].name);
        }
    });
    console.log(pieData); 
    createPieChart(pieData, pieLabels); 
}); 
</script>
<template>

    <div class="mt-10 p-8 mx-auto h-fit w-fit lg:w-3/5 lg:h-[450px] bg-gray-200 rounded-xl flex flex-row">

        <div class="flex flex-col w-1/2 mr-20">
        <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>
          <div v-for="budget in props.budgets">
            <BudgetInfo :budget="budget"></BudgetInfo>
          </div>
            
        </div>
        
        <div class="w-3/5">
           <canvas id="myPieChart"></canvas>
        </div>

    </div>
</template>