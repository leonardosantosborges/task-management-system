<template>
    <div>
        <Navbar />

        <BotaoCriarTarefa @openModal="showModal = true" />

        <ModalTarefa :showModal="showModal" @closeModal="showModal = false" @salvarTarefa="salvarTarefa" />

        <br />

        <TabelaTarefas :tarefas="tarefas" />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Navbar from "@/Components/Navbar.vue";
import TabelaTarefas from "@/Components/TabelaTarefas.vue";
import ModalTarefa from "@/Components/ModalTarefa.vue";
import BotaoCriarTarefa from "@/Components/BotaoCriarTarefa.vue";

const showModal = ref(false);
const tarefas = ref([]);
const isLoading = ref(false);

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const fetchTarefas = async () => {
    if (isLoading.value) return;

    try {
        isLoading.value = true;

        const response = await fetch('/tasks');

        if (!response.ok) {
            const errorText = await response.text();
            console.error('Erro ao carregar tarefas:', errorText);
            return;
        }

        const data = await response.json();
        if (data.success) {
            tarefas.value = data.tasks;
        } else {
            console.error('Erro ao carregar tarefas');
        }
    } catch (error) {
        console.error('Erro ao buscar tarefas:', error);
    } finally {
        isLoading.value = false;
    }
};

const salvarTarefa = async (novaTarefa) => {
    try {
        const response = await fetch('/tasks', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                titulo: novaTarefa.titulo,
                descricao: novaTarefa.descricao,
            }),
        });

        if (!response.ok) {
            const errorText = await response.text();
            console.error('Erro no servidor:', errorText);
            alert('Erro no servidor');
            return;
        }

        const data = await response.json();

        if (data.success) {
            showModal.value = false;

            novaTarefa.titulo = '';
            novaTarefa.descricao = '';

            fetchTarefas();
        } else {
            alert('Erro ao salvar tarefa');
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Erro ao salvar tarefa');
    }
};

onMounted(() => {
    fetchTarefas();
});
</script>
