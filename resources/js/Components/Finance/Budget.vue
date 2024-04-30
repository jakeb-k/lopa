<script setup>
import {onMounted, ref, computed, onBeforeMount} from 'vue'; 

import BudgetInfo from '@/Components/Finance/BudgetInfo.vue'; 
import ProgressBar from '@/Components/Finance/ProgressBar.vue'; 
import Totals from './Totals.vue';

import { Chart, registerables } from 'chart.js';


var pieData = []; 
var pieLabels = [];
var colors = ['gold', 'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 120, 0)',
              'rgb(153, 102, 255)','rgb(75, 192, 192)'];
var total = 0;
var totalProgress = 0; 
var overBudget = ref(false); 

var income; 
var budgetsMoreThanIncome; 
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
            budgetsMoreThanIncome = props.budgets[key].over; 
       }
       else {
            total += props.budgets[key].amount; 
            totalProgress += props.budgets[key].progress; 
            
            //Generate pie data values 
            pieData.push(props.budgets[key].amount);
            pieLabels.push(props.budgets[key].name);
       }
   });
   if(total > income) {
        overBudget.value = true; 
   }
   console.log(totalProgress, income); 
}
onBeforeMount(() => {
    budgetChecker(); 
}); 
onMounted(() => {
    createPieChart(pieData, pieLabels); 
}); 

</script>
<template>

    <div class="mt-10 pt-8 pb-12 px-8 mx-auto h-fit w-2/3 bg-gray-200 relative rounded-xl
    items-center flex flex-col lg:flex-row">
        <div class="flex flex-col w-full mx-auto lg:w-1/2 lg:mr-20">
            <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>

            <div class="text-red-400 text-lg w-full my-2" v-if="budgetsMoreThanIncome">Your budgets exceed your income!</div>
            <div class="text-red-400 text-lg w-full my-2" v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>
            <div class="text-green-600 text-lg w-full my-2" v-if="$page.props.flash.success">{{ $page.props.flash.success }}</div>

            <div v-for="(budget, index) in props.budgets">
                <BudgetInfo :budget="budget"></BudgetInfo>
                <ProgressBar :progress="budget.progress" :total="budget.amount" :color="colors[index]"></ProgressBar>
            </div>
        </div>
        
        <div class="w-4/5 lg:w-1/2 h-full m-auto flex flex-col justify-between">
            <Totals :income=income :total=totalProgress ></Totals>
            <div class="pt-24">
                <canvas id="myPieChart"></canvas>
            </div>
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
