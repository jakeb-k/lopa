<template>
    <div class="w-full h-4 bg-gray-400 rounded-full overflow-hidden mt-4">
      <div
        class="h-full rounded-full duration-700"
        :style="{ width: progressBarWidth, backgroundColor: color }"
      ></div>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  
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
  
  const progressBarWidth = computed(() => {
    const percentage = Math.max(0, Math.min(100, (props.progress / props.total) * 100));
    return `${percentage}%`;
  });
  </script>
