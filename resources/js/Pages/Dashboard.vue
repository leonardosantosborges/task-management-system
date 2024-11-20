<template>
    <div>
        <Navbar />
        <TabelaTarefas :tarefas="tarefas" />
    </div>
</template>

<script setup>
import Navbar from "@/Components/Navbar.vue";
import TabelaTarefas from "@/Components/TabelaTarefas.vue";
import { ref } from "vue";

const tarefas = ref([
    {
        nome: "Tarefa 1",
        descricao: "Descrição da tarefa 1",
        status: "Pendente",
    },
    {
        nome: "Tarefa 2",
        descricao: "Descrição da tarefa 2",
        status: "Em andamento",
    },
    {
        nome: "Tarefa 3",
        descricao: "Descrição da tarefa 3",
        status: "Concluída",
    },
]);
</script>
