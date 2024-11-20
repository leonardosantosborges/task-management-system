<template>
    <div v-if="showModal" class="modal show" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Tarefa</h5>
                    <button type="button" class="close ml-auto" @click="closeModal" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="emitirSalvarTarefa">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" id="titulo" v-model="novaTarefa.titulo" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea id="descricao" v-model="novaTarefa.descricao" class="form-control" required></textarea>
                        </div>

                        <input type="hidden" :value="csrfToken" name="_token">

                        <br />
                        <button type="submit" class="btn btn-dark">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from "vue";

const props = defineProps({
    showModal: {
        type: Boolean,
        required: true,
    }
});

const emit = defineEmits(['closeModal', 'salvarTarefa']);

const novaTarefa = ref({
    titulo: '',
    descricao: '',
});

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const emitirSalvarTarefa = () => {
    emit('salvarTarefa', novaTarefa.value);
    novaTarefa.value = {};
};

const closeModal = () => {
    emit('closeModal');
};
</script>
