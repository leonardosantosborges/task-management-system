<template>
    <div class="filters">
        <select v-model="status" class="form-select" @change="emitirFiltros">
            <option value="">Todos</option>
            <option value="pending">Pendente</option>
            <option value="in_progress">Em andamento</option>
            <option value="completed">Concluída</option>
        </select>

        <select v-model="orderBy" class="form-select" @change="emitirFiltros">
            <option value="created_at">Data de criação</option>
            <option value="updated_at">Data de atualização</option>
        </select>
    </div>
</template>

<script setup>
import {ref, defineEmits} from "vue";

const emit = defineEmits(['changeFiltros']);

const status = ref("");
const orderBy = ref("created_at");

const emitirFiltros = () => {
    emit('changeFiltros', {status: status.value, orderBy: orderBy.value});
};
</script>

<style scoped>
.filters {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-select {
    width: 150px;
    padding: 0.5rem;
    font-size: 0.875rem;
}
</style>
