<template>
    <div class="w-full h-4 bg-gray-400 rounded-full overflow-hidden mt-4">
      <div
        class="h-full rounded-full duration-700"
        :style="{ width: progressBarWidth, backgroundColor: color }"
      ></div>
    </div>
  </template>
  
  <script setup>
  import { computed, ref } from 'vue';
  
  const props = defineProps({
    total: {
      type: Number,
      required: true
    },
    progress: {
      type: Number,
      required: true
    },
    color: {
      type: String,
      default: 'blue'
    }
  });
const total = ref(props.total); // Total value of progress
const progress = ref(0); // Initial progress value

const progressBarWidth = computed(() => `${(progress.value / total.value) * 100}%`);

// Example of updating progress
setInterval(() => {
  if (progress.value < props.progress) {
    progress.value += props.progress; // Increase by 10 units every second
  }
},60);
</script>
