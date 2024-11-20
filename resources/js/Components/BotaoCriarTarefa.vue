<template>
    <div class="flex justify-center mt-4">
        <button class="btn btn-dark" @click="openModal">
            Nova tarefa
        </button>
    </div>
</template>

<script setup>
import { defineEmits } from "vue";

const emit = defineEmits(['openModal']);

const openModal = () => {
    emit('openModal', true);
};
</script>
