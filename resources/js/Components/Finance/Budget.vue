<script setup>
import {onMounted, ref, computed, onBeforeMount} from 'vue'; 

import BudgetInfo from '@/Components/Finance/BudgetInfo.vue'; 
import Subbudget from './Subbudget.vue';
import ProgressBar from '@/Components/Finance/ProgressBar.vue'; 
import Totals from './Totals.vue';
import ModalCreateBudget from './ModalCreateBudget.vue';

import { Chart, registerables } from 'chart.js';
import { useModal } from 'vue-final-modal';


var pieData = []; 
var pieLabels = [];
var colors = ['gold', 'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 120, 0)',
              'rgb(153, 102, 255)','rgb(75, 192, 192)'];
var pieColors = colors.slice(1);
var total = 0;
var budgetProgress = 0; 
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
          backgroundColor: pieColors,
          hoverOffset: 4
        }]
      }
    });
}
function budgetChecker(){
    let counter = 0; 
    Object.keys(props.budgets).forEach(key => {
       if(props.budgets[key].name == 'Income') {
            income = props.budgets[key].amount; 
            budgetsMoreThanIncome = props.budgets[key].over; 
       }
       else {
            total += props.budgets[key].amount; 
            budgetProgress += props.budgets[key].progress; 
            
            if(props.budgets[key].progress > props.budgets[key].amount){
                let newColor = 'rgb(255,0,0)';
                colors.splice(counter, 1, newColor); 
            }
            //Generate pie data values 
            pieData.push(props.budgets[key].amount);
            pieLabels.push(props.budgets[key].name);
       }
       counter = counter + 1; 
   });
   if(total > income) {
        overBudget.value = true; 
   }
}
onBeforeMount(() => {
    budgetChecker(); 
}); 
onMounted(() => {
    createPieChart(pieData, pieLabels); 
}); 
const { open, close } = useModal({
    component: ModalCreateBudget,
    attrs: {
        onConfirm() {
        close()
        },
    },
}); 
</script>
<template>

    <div class="mt-10 pt-8 pb-12 px-8 mx-auto h-fit w-2/3 bg-gray-200 relative rounded-xl
    items-center flex flex-col lg:flex-row mb-20 ">
        <div class="flex flex-col w-full mx-auto lg:w-1/2 lg:mr-20">
            <div class="flex flex-row justify-between">
                <h1 class="text-3xl underline text-gray-800 ">Budget Overview</h1>
                <button class="hover:text-green-400 border border-green-400 py-2 px-4 rounded-2xl
            hover:bg-white duration-150 ease-in-out" @click="() => open()"><i class="fa-solid fa-plus"></i></button>
            </div>

            <div class="text-green-600 text-lg w-full my-2" v-if="!budgetsMoreThanIncome">Your budgets match your income. <span class="font-bold">{{ total }} / {{ income }}</span></div>
            <div class="text-red-400 text-lg w-full my-2" v-if="budgetsMoreThanIncome">Your budgets exceed your income! <span class="font-bold">{{ total }} / {{ income }}</span></div>
            
            <div class="text-red-400 text-lg w-full my-2" v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>
            <div class="text-green-600 text-lg w-full my-2" v-if="$page.props.flash.success">{{ $page.props.flash.success }}</div>

            <div v-for="(budget, index) in props.budgets">
                <BudgetInfo :budget="budget" :color="colors[index]"></BudgetInfo>
                <ProgressBar :progress="budget.progress" :total="budget.amount" :color="colors[index]"></ProgressBar>
            </div>
        </div>
        
        <div class="w-4/5 lg:w-1/2 h-full m-auto flex flex-col lg:justify-between">
            <Totals :income=income :total=budgetProgress ></Totals>
            <div class="lg:pt-16 lg:mt-0 mt-8">
                <canvas id="myPieChart"></canvas>
            </div>
        </div>
        
    </div>
    
</template>
