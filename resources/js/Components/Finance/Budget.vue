<script setup>
import {onMounted} from 'vue'; 


const props = defineProps({
    budget: {
        type: Object
    }
});
onMounted( () => {
    console.log(props)
})
</script>
<template>
    <div class="mt-10 p-8 mx-auto w-1/2 h-[450px] bg-gray-200 rounded-xl">
        <h1 class="text-3xl underline text-gray-800">Budget Overview</h1>
        <p>Housing: {{ props.budget }}</p>
    </div>
</template>