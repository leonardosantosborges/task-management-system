<template>
    <div v-if="showModal" class="modal show" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Tarefa</h5>
                    <button type="button" class="close ml-auto" @click="closeModal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="emitirEditarTarefa">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input
                                type="text"
                                id="titulo"
                                v-model="tarefaEditada.titulo"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea
                                id="descricao"
                                v-model="tarefaEditada.descricao"
                                class="form-control"
                                required
                            ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select
                                id="status"
                                v-model="tarefaEditada.status"
                                class="form-control"
                                required
                            >
                                <option value="pending">Pendente</option>
                                <option value="in_progress">Em andamento</option>
                                <option value="completed">Concluída</option>
                            </select>
                        </div>

                        <input type="hidden" :value="tarefaEditada.id" name="id">

                        <input type="hidden" :value="csrfToken" name="_token">

                        <br />
                        <button type="submit" class="btn btn-dark">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";

const props = defineProps({
    showModal: {
        type: Boolean,
        required: true,
    },
    tarefa: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(['closeModal', 'editarTarefa']);

const tarefaEditada = ref({});

watch(
    () => props.tarefa,
    (newTarefa) => {
        if (newTarefa) {
            console.log("Sincronizando tarefa:", newTarefa);
            tarefaEditada.value = { ...newTarefa };
        }
    },
    { immediate: true }
);

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const emitirEditarTarefa = () => {
    console.log("Tarefa editada enviada:", tarefaEditada.value);
    emit('editarTarefa', tarefaEditada.value);
};

const closeModal = () => {
    emit('closeModal');
};

</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
}
.modal-dialog {
    max-width: 500px;
    width: 100%;
}
</style>
