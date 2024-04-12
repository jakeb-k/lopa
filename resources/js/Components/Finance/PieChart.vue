<script setup>
import { Chart, registerables } from 'chart.js';
import {onMounted} from 'vue'; 

Chart.register(...registerables);



onMounted(()=> {
    const ctx = document.getElementById('myPieChart').getContext('2d');
    const myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Red', 'Blue', 'Yellow'],
        datasets: [{
          label: 'My First Dataset',
          data: [300, 50, 100],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
          ],
          hoverOffset: 4
        }]
      }
    });
});
</script>
<template>
    <canvas id="myPieChart"></canvas>
</template>