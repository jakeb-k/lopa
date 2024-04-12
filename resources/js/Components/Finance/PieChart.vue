<script setup>
import { Chart, registerables } from 'chart.js';
import {onMounted} from 'vue'; 

Chart.register(...registerables);

const props = defineProps({
    pieLabels: {
        type: Array
    },
    pieData: {
        type: Array
    },
})

function createPieChart(){
  const ctx = document.getElementById('myPieChart').getContext('2d');
  new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Housing', 'Utilities', 'Food', 'Transport', 'Savings'],
        datasets: [{
          label: 'My Budget',
          data: props.pieData,
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

onMounted(()=> {
  createPieChart(); 
});
</script>
<template>
    <canvas id="myPieChart"></canvas>
</template>