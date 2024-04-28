<script setup>
import {onMounted, ref, computed} from 'vue'; 

import BudgetInfo from '@/Components/Finance/BudgetInfo.vue'; 
import ProgressBar from '@/Components/Finance/ProgressBar.vue'; 

import { Chart, registerables } from 'chart.js';


var pieData = []; 
var pieLabels = [];
var colors = ['gold', 'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 120, 0)',
              'rgb(153, 102, 255)','rgb(75, 192, 192)'];
var total = 0;
var totalProgress = 0; 
var overBudget = ref(false); 
var income; 
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
            'rgb(255, 120, 0)',
         'rgb(153, 102, 255)',
            'rgb(75, 192, 192)',
          ],
          hoverOffset: 4
        }]
      }
    });
}
function budgetChecker(){
    Object.keys(props.budgets).forEach(key => {
       
       if(props.budgets[key].name == 'Income') {
            income = props.budgets[key].amount; 
       }
       else {
            total += props.budgets[key].amount; 
            totalProgress += props.budgets[key].progress; 

       }
   });
   if(total > income) {
        overBudget.value = true; 
   }
   console.log(totalProgress, income); 
}

onMounted(() => {
    Object.keys(props.budgets).forEach(key => {
       
        if(props.budgets[key].name != 'Income') {
            pieData.push(props.budgets[key].amount);
            pieLabels.push(props.budgets[key].name);
        }
    });
    budgetChecker(); 
    createPieChart(pieData, pieLabels); 
}); 
const budgetMsgStyle = computed(() =>
    overBudget.value
        ? 'text-red-500 text-lg font-bold w-full'
        : 'text-green-600 text-lg font-bold basis-full'
);
const budgetMsg = computed(() =>
    overBudget.value
        ? 'Your budget is not equal! Adjust your allocations!'
        : 'Great work! You are within budget.'
);
</script>
<template>

    <div class="mt-10 pt-8 pb-12 px-8 mx-auto h-fit w-2/3 bg-gray-200 relative rounded-xl
    items-center flex flex-col lg:flex-row">

        <div class="flex flex-col w-full mx-auto lg:w-1/2 lg:mr-20">
        <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>
        <div class="text-red-400 text-lg w-full my-2" v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>
        <div class="text-green-600 text-lg w-full my-2" v-if="$page.props.flash.success">{{ $page.props.flash.success }}</div>
        <span :class="budgetMsgStyle">{{ budgetMsg }}</span>
          <div v-for="(budget, index) in props.budgets">
            
                <BudgetInfo :budget="budget"></BudgetInfo>
                <ProgressBar :progress="budget.progress" :total="budget.amount" :color="colors[index]"></ProgressBar>
        
            </div>
        </div>
        
        <div class="w-[400px] my-auto">
           <canvas id="myPieChart"></canvas>
        </div>
        
    </div>
    
</template>
<script>
    export default {

        mounted() {
            console.log(this.$page.props)
        }
    }
</script>
