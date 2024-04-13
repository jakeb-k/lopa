<script setup lang="ts">
import { ref } from 'vue'; 
import { VueFinalModal } from 'vue-final-modal'

const props = defineProps<{
  title?: string,
  budgetPercent: number,
  income: number,
  id: number,
}>()
var budgetPercent = ref(props.budgetPercent);

const emit = defineEmits<{
  (e: 'confirm'): void
}>()
</script>

<template>
  <VueFinalModal
    class="flex justify-center items-center"
    content-class="flex flex-col w-1/4 mx-4 p-4 bg-white dark:bg-gray-900 border dark:border-gray-700 rounded-lg space-y-2"
  >
    <h1 class="text-xl">
      {{ title }}
    </h1>
    <label>Amount for {{ title }}</label>
    <input type="number" :value="income * budgetPercent "> 
    <slot />
    <button class="mt-1 ml-auto px-2 border rounded-lg" @click="emit('confirm')">
      UPDATE
    </button>
  </VueFinalModal>
</template>
