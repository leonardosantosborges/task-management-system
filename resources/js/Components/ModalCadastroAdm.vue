<template>
    <div v-if="showModal" class="modal modal-overlay show" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Administrador</h5>
                <button type="button" class="close ml-auto" @click="closeModal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input
                            id="name"
                            type="text"
                            v-model="form.name"
                            class="form-control"
                            required
                            placeholder="Digite o nome"
                        />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            class="form-control"
                            required
                            placeholder="Digite o email"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input
                            id="password"
                            type="password"
                            v-model="form.password"
                            class="form-control"
                            required
                            placeholder="Digite a senha"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            v-model="form.password_confirmation"
                            class="form-control"
                            required
                            placeholder="Confirme a senha"
                        />
                    </div>

                    <button type="submit" class="btn btn-dark">Cadastrar</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    showModal: Boolean,
});

const emit = defineEmits(['closeModal']);

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'admin',
});

const closeModal = () => {
    emit('closeModal');
};

const submitForm = async () => {
    try {
        const response = await fetch('/register-admin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(form.value),
        });

        if (!response.ok) {
            console.error('Erro ao registrar administrador');
            alert('Erro ao registrar administrador');
            return;
        }

        const data = await response.json();
        if (data.success) {
            alert('Administrador cadastrado com sucesso');
            closeModal();
        } else {
            alert('Erro ao cadastrar administrador');
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Erro ao cadastrar administrador');
    }
};
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    width: 400px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

button {
    margin-top: 10px;
}

.btn-dark {
    background-color: #343a40;
    color: white;
}
</style>
