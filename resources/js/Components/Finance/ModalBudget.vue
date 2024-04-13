<script setup lang="ts">
import { ref, reactive } from 'vue'; 
import { router } from '@inertiajs/vue3';
import { VueFinalModal } from 'vue-final-modal'

const props = defineProps<{
  title?: string,
  amount: number,
  id: number,
}>()
var amount = ref(props.amount);

const budget = reactive({
  amount: amount,
  progress: 1,
});

const emit = defineEmits<{
  (e: 'confirm'): void
}>()

function update() {
  router.put(`public/updatebudget/${props.id}`, budget); 
  window.location.reload();
  emit('confirm');  
  
}
</script>

<template>
  <VueFinalModal
    class="flex justify-center items-center"
    content-class="flex flex-col w-1/4 mx-4 p-4 bg-white dark:bg-gray-900 border dark:border-gray-700 rounded-lg space-y-2"
  >
    <h1 class="text-xl">
      {{ title }}
    </h1>
    <label for="amount">Amount for {{ title }}</label>
    <input id="amount" type="number" v-model="budget.amount"> 
    <slot />
    <button class="mt-1 ml-auto px-2 border rounded-lg" @click="update()">
      UPDATE
    </button>
  </VueFinalModal>
</template>
