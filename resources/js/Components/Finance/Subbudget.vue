<script setup>
import { onMounted, ref } from 'vue';
import { useModal } from 'vue-final-modal';
import { router } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import ModalUpdateBudget from './ModalUpdateBudget.vue';
import LoadingWheel from '../LoadingWheel.vue';


const props = defineProps({
    budget: Object, 
    flash: Object,
    color: String,
})

const name = ref(props.budget.name); 

const amount = ref(props.budget.amount); 
const id = ref(props.budget.id);

var isSubmitting = ref(false);

const { open, close } = useModal({
    component: ModalUpdateBudget,
    attrs: {
        name: name,
        amount: amount,
        isSubbudget: true, 
        id: id,
        onConfirm() {
        close()
        },
    },
}); 

function deleteBudget(id) {
    if (confirm('Are you sure you want to delete this subbudget?\nYou cannot recover it once deleted')) {
        isSubmitting.value = true;
        Inertia.delete(`public/subbudget/${id}`,{
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

onMounted(()=>{

}); 

</script>
<template>
    <div className="flex flex-row w-ful border-b py-2 border-gray-400 l my-4 items-center justify-between">
        <div class="w-8/12 flex flex-row justify-between">
        <span >{{name }}: </span>
        <span className=" font-bold"> ${{ amount }}</span>
    </div>
    <div class="flex flex-row justify-between w-1/6">
        <button class="hover:text-blue-500 hover:underline rounded-2xl
            hover:bg-white duration-150 ease-in-out"
            @click="() => open()"><i class="fa-regular fa-pen-to-square"></i></button>

            <button v-if="name != 'Income'" class="hover:text-red-500 hover:underline rounded-2xl
            hover:bg-white duration-150 ease-in-out"
            @click="deleteBudget(id)"><i class="fa-solid fa-trash"></i></button>
    </div>
    </div>  
    <LoadingWheel :isSubmitting=isSubmitting></LoadingWheel>

</template>