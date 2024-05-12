<script setup lang="ts">
import { ref, reactive } from 'vue'; 
import { router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { VueFinalModal } from 'vue-final-modal'
import LoadingWheel from '../LoadingWheel.vue';

const props = defineProps<{
  name?: string,
  amount: number,
  progress: number,
  id: number,
  isSubBudget: boolean
}>()
var amount = ref(props.amount);
var progress = ref(props.progress);
var name = ref(props.name); 
const isSubBudget = ref(props.isSubBudget); 

const budget = reactive({
  name: name, 
  amount: amount,
  progress: progress,
  isPaid: false,
});

const emit = defineEmits<{
  (e: 'confirm'): void
}>()

var isSubmitting = ref(false);

function update() {
  isSubmitting.value = true;  // Start submission
  if(isSubBudget){
      // Use Inertia.put to make a PUT request
    Inertia.put(`public/subbudget/${props.id}`, budget, {
      preserveScroll: true,
      onSuccess: () => {
        emit('confirm');
        isSubmitting.value = false;  // End submission after reload completes
      },
      onError: () => {
        console.error("Error during the update process");
        isSubmitting.value = false;  // Reset on error as well
      }
    });
  } 
  else {
    // Use Inertia.put to make a PUT request
    Inertia.put(`public/budget/${props.id}`, budget, {
    preserveScroll: true,
    onSuccess: () => {
      emit('confirm');
      isSubmitting.value = false;  // End submission after reload completes
    },
    onError: () => {
      console.error("Error during the update process");
      isSubmitting.value = false;  // Reset on error as well
    }
  });
  }
 
}
</script>

<template>
  <VueFinalModal
    class="flex justify-center items-center"
    content-class="flex flex-col lg:w-1/4 w-1/2 mx-4 p-4 bg-white dark:bg-gray-900 border dark:border-gray-700 rounded-lg space-y-2"
  >
  <LoadingWheel :isSubmitting=isSubmitting></LoadingWheel>

    <h1 class="text-xl">
      {{ name }}
    </h1>
    
    <label for="name">Edit Name: {{ name }}</label>
    <input id="name" type="text" v-model="budget.name"> 

    <label for="amount">Amount for {{ name }}</label>
    <input id="amount" type="number" v-model="budget.amount"> 

    <label v-if="!isSubBudget" for="progress">Progress for {{ name }}</label>
    <input v-if="!isSubBudget" id="progress" type="number" v-model="budget.progress"> 

    <div v-if="isSubBudget" class="mt-8">
      <label>
      <input type="checkbox" v-model="budget.isPaid" />
      Is Paid?
      </label>
    </div>
    
    <button class="mt-1 ml-auto px-2 border rounded-lg" @click="update()">
      UPDATE
    </button>
  </VueFinalModal>
</template>
