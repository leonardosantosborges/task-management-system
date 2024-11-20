<template>
    <form @submit.prevent="onSubmit">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" v-model="titulo" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" v-model="descricao" class="form-control" required></textarea>
        </div>
        <br />
        <button type="submit" class="btn btn-dark">Salvar</button>
    </form>
</template>

<script setup>
import { ref, defineEmits } from "vue";

const emit = defineEmits(['salvar']);

const titulo = ref('');
const descricao = ref('');

const onSubmit = () => {
    emit('salvar', { titulo: titulo.value, descricao: descricao.value });

    titulo.value = '';
    descricao.value = '';
};
</script>
