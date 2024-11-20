<template>
    <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-lg">
        <table class="min-w-full table-auto border-collapse">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Tarefa</th>
                <th class="px-4 py-2 text-left">Descrição</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Editar</th>
                <th class="px-4 py-2 text-left">Excluir</th>

                <th v-if="props.role === 'admin'" class="px-4 py-2 text-left">ID do Criador</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="tarefa in tarefas" :key="tarefa.id">
                <td class="px-4 py-2">{{ tarefa.title }}</td>
                <td class="px-4 py-2">{{ tarefa.description }}</td>
                <td class="px-4 py-2">{{ tarefa.status }}</td>
                <td class="px-4 py-2">
                    <button
                        class="btn btn-outline-warning"
                        @click="emit('editarTarefa', tarefa)"
                    >
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                </td>
                <td class="px-4 py-2">
                    <button
                        class="btn btn-outline-danger"
                        @click="emit('excluirTarefa', tarefa.id)"
                    >
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>

                <td v-if="props.role === 'admin'" class="px-4 py-2">{{ tarefa.user_id }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    tarefas: {
        type: Array,
        required: true,
    },
    role: {
        type: String,
        required: true,
    },
});

const emit = defineEmits(['editarTarefa', 'excluirTarefa']);
</script>

<style scoped>
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

table {
    width: 100%;
    border-spacing: 0;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
}

th {
    background-color: #f3f3f3;
}
</style>
