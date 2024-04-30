<script setup>
import { ref, computed, onBeforeMount } from 'vue';


const props = defineProps({
    total: Number,
    income: Number, 
})

var budgetTotal = ref(props.total)
var budgetIncome = ref(props.income) 
var isBudgetOver = ref(false); 


function overUnder (isOverBudget, total, income){

    if(total > income){
        isOverBudget = true; 
    } else {
        isOverBudget = false; 
    }

    return isOverBudget; 
}

onBeforeMount(() => {
    isBudgetOver.value = overUnder(isBudgetOver.value, budgetTotal.value, budgetIncome.value); 
});

const budgetMsgStyle = computed(() =>
    isBudgetOver.value
        ? 'text-red-500 text-lg w-full'
        : 'text-green-600 text-lg'
);
const budgetMsg = computed(() =>
    isBudgetOver.value
        ? 'You have spent more than your current income!'
        : "Great work! You're spending within your means."
);

</script>
<template>
    <div>
        <div>
            <p :class=budgetMsgStyle>Weekly Spendings: <span class="font-bold">{{ total }}</span></p>
            <p :class=budgetMsgStyle>Weekly Income: <span class="font-bold">{{ income }}</span></p>
            <p :class="budgetMsgStyle">{{ budgetMsg }}</p>
        </div>
    </div>
</template>