<script setup>
import { onMounted, ref } from 'vue';
import { useModal } from 'vue-final-modal';
import { router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import ModalUpdateBudget from './ModalUpdateBudget.vue'


const props = defineProps({
    budget: Object, 
    flash: Object
})

const title = ref(props.budget.name); 

const amount = ref(props.budget.amount); 
const id = ref(props.budget.id);



const { open, close } = useModal({
    component: ModalUpdateBudget,
    attrs: {
        title: title,
        id: id,
        onConfirm() {
        close()
        },
    },
}); 

function deleteBudget(id) {
    if (confirm('Are you sure you want to delete this budget and subbudgets?\nYou cannot recover it once deleted')) {
        Inertia.delete(`public/budget/${id}`)
    }

}

onMounted(()=>{

}); 

</script>
<template>
   <div class="mt-4">
        <span >{{title }}: </span>
        <span className=""> {{ amount }}</span>
    </div>

</template>