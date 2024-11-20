<template>
    <div>
        <Navbar />

        <BotaoCriarTarefa @openModal="showModal = true" />

        <ModalTarefa :showModal="showModal" @closeModal="showModal = false" @salvarTarefa="salvarTarefa" />

        <ModalEditarTarefa
            :showModal="editModalVisible"
            :tarefa="tarefaSelecionada && tarefaSelecionada.id ? tarefaSelecionada : {}"
            @closeModal="editModalVisible = false"
            @editarTarefa="editarTarefa"
        />

        <br />

        <TabelaTarefas
            :tarefas="tarefas"
            @editarTarefa="abrirModalEdicao"
            @excluirTarefa="excluirTarefa"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Navbar from "@/Components/Navbar.vue";
import TabelaTarefas from "@/Components/TabelaTarefas.vue";
import ModalTarefa from "@/Components/ModalTarefa.vue";
import ModalEditarTarefa from "@/Components/ModalEditarTarefa.vue";
import BotaoCriarTarefa from "@/Components/BotaoCriarTarefa.vue";

const showModal = ref(false);
const editModalVisible = ref(false);
const tarefaSelecionada = ref({});
const tarefas = ref([]);
const isLoading = ref(false);

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const fetchTarefas = async () => {
    if (isLoading.value) return;

    try {
        isLoading.value = true;

        const response = await fetch('/tasks');

        if (!response.ok) {
            console.error('Erro ao carregar tarefas:', await response.text());
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
            console.error('Erro ao salvar tarefa:', await response.text());
            return;
        }

        fetchTarefas();
    } catch (error) {
        console.error('Erro ao salvar tarefa:', error);
    }
};

const editarTarefa = async (tarefaEditada) => {
    console.log(tarefaEditada)
    if (!tarefaEditada.id) {
        console.error('ID da tarefa não encontrado');
        return;
    }

    try {
        const response = await fetch(`/tasks/${tarefaEditada.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                titulo: tarefaEditada.titulo,
                descricao: tarefaEditada.descricao,
                status: tarefaEditada.status,
            }),
        });

        const responseText = await response.text();

        console.log(responseText);

        if (!response.ok) {
            console.error('Erro ao editar tarefa');
            return;
        }

        const data = JSON.parse(responseText);

        if (data.success) {
            editModalVisible.value = false;
            fetchTarefas();
        } else {
            console.error('Erro ao editar tarefa');
        }
    } catch (error) {
        console.error('Erro ao editar tarefa:', error);
    }
};

const excluirTarefa = async (id) => {
    try {
        const response = await fetch(`/tasks/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
        });

        if (!response.ok) {
            console.error('Erro ao excluir tarefa:', await response.text());
            return;
        }

        fetchTarefas();
    } catch (error) {
        console.error('Erro ao excluir tarefa:', error);
    }
};

const abrirModalEdicao = (tarefa) => {
    if (tarefa) {
        tarefaSelecionada.value = { ...tarefa, id: tarefa.id };
        editModalVisible.value = true;
    } else {
        console.error('Tarefa não encontrada para edição');
    }
};

onMounted(fetchTarefas);
</script>
