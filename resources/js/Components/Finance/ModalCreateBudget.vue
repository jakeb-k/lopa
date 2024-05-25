<script setup lang="ts">
import { ref, reactive } from 'vue'; 
import { router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { VueFinalModal } from 'vue-final-modal'
import LoadingWheel from '../LoadingWheel.vue';

const props = defineProps<{
  isSubBudget: boolean,
  budgetId: number,
}>()

const isSubBudget = ref(props.isSubBudget); 

const budget = reactive({
  name: '', 
  amount: 0,
  progress: 0,
  isPaid: false, 
  budgetId: props.budgetId,
});

const emit = defineEmits<{
  (e: 'confirm'): void
}>()

var isSubmitting = ref(false);

function createBudget() {
  if(isSubBudget){
    isSubmitting.value = true;  // Start submission
    // Use Inertia.post to make a POST request
    Inertia.post(route('subbudget.create'), budget, {
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
    isSubmitting.value = true;  // Start submission

    // Use Inertia.post to make a post request
    Inertia.post(route('budget.store'), budget, {
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
    content-class="flex flex-col lg:w-1/4 w-1/2 mx-4 p-4 bg-white border rounded-lg space-y-2"
  >
  <LoadingWheel :isSubmitting=isSubmitting></LoadingWheel>

    <h1 class="text-xl"  v-if="isSubBudget"> New Sub Budget </h1>
    <h1 class="text-xl"  v-if="!isSubBudget"> New Budget </h1>

    <label for="name" v-if="!isSubBudget">Name for New Budget</label>
    <label for="name" v-if="isSubBudget">Name for New Sub Budget</label>
    <input id="name" v-model="budget.name"> 

    <label for="amount" v-if="!isSubBudget">Amount for New Budget</label>
    <label for="amount" v-if="isSubBudget">Amount for New Sub Budget</label>
    <input id="amount" type="number" v-model="budget.amount"> 

    <label for="progress" v-if="!isSubBudget">Progress for New Budget</label>
    <input id="progress" type="number" v-if="!isSubBudget" v-model="budget.progress"> 

    <div v-if="isSubBudget" class="mt-8">
      <label>
      <input type="checkbox" v-model="budget.isPaid" />
      Is Paid?
      </label>
    </div>
    
    <button class="mt-1 ml-auto px-2 border rounded-lg" @click="createBudget()">
      CREATE
    </button>
  </VueFinalModal>
</template>
