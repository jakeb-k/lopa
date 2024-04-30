<script setup> 

import { ref, reactive } from 'vue'; 

const props = defineProps({
    isSubmitting: Boolean, 
});

var isSubmitting = ref(props.isSubmitting); 

</script>
<template>
    <div v-if="isSubmitting" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-blue-600"></div>
    </div>
</template>