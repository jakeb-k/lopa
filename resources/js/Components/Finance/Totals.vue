<script setup>
import { ref, onMounted, computed } from 'vue';


const props = defineProps({
    total: Number,
    income: Number, 
})
var budgetTotal = ref(props.total)
var budgetIncome = ref(props.income) 
var isBudgetOver = false; 


function overUnder (isOverBudget, total, income){

    if(total > income){
        isOverBudget = true; 
    } else if(total <= income) {
        isOverBudget = false; 
    }
    return isOverBudget; 
}
onMounted(() => {
    isBudgetOver = overUnder(isBudgetOver, budgetTotal, budgetIncome); 
});

const budgetMsgStyle = computed(() =>
    isBudgetOver.value
        ? 'text-red-500 text-lg font-bold w-full'
        : 'text-green-600 text-lg font-bold basis-full'
);
const budgetMsg = computed(() =>
    isBudgetOver.value
        ? 'Your budget is not equal! Adjust your allocations!'
        : 'Great work! You are within budget.'
);

</script>
<template>
    <div>
        <div>
            <p>{{ total }}/{{ income }}</p>
            <p :class="budgetMsgStyle">{{ budgetMsg }}</p>
        </div>
    </div>
</template>