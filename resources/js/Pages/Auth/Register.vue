<template>
    <div class="auth-container">
        <div class="auth-form">
            <h2 class="auth-title">Registrar</h2>

            <ErrorList :errors="errorMessages" />

            <form @submit.prevent="submitForm">
                <FormInput
                    id="name"
                    label="Nome"
                    v-model="form.name"
                    required
                />

                <FormInput
                    id="email"
                    label="Email"
                    type="email"
                    v-model="form.email"
                    required
                />

                <FormInput
                    id="password"
                    label="Senha"
                    type="password"
                    v-model="form.password"
                    required
                />

                <FormInput
                    id="password_confirmation"
                    label="Confirmar senha"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                />

                <SubmitButton>Registrar</SubmitButton>
            </form>

            <div class="login-link">
                <p>Já tem uma conta?
                    <inertia-link href="/login" class="text-blue-600">Faça login</inertia-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { Inertia } from '@inertiajs/inertia';
import ErrorList from '@/Components/ErrorList.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormInput from '@/Components/FormInput.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';
export default {
    components: {
        FormInput,
        ErrorList,
        SubmitButton,
        InertiaLink
    },
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                role: "user",
            },
            errorMessages: [],
        };
    },
    methods: {
        async submitForm() {
            this.errorMessages = [];

            try {
                const response = await axios.post("/register", this.form);
                console.log("User registered successfully:", response.data);

                Inertia.visit('/dashboard');
            } catch (error) {
                console.error("Erro durante o registro:", error.response?.data || error.message);
                if (error.response && error.response.data.errors) {
                    this.errorMessages = Object.values(error.response.data.errors).flat();
                }
            }
        },
    },
};
</script>

<style scoped>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f3f4f6;
}

.auth-form {
    width: 100%;
    max-width: 400px;
    padding: 1rem;
    background-color: white;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.auth-title {
    font-size: 1.5rem;
    font-weight: 700;
    text-align: center;
    color: #333;
}

.login-link {
    text-align: center;
    margin-top: 1rem;
}

.login-link .text-blue-600 {
    color: #2563eb;
    text-decoration: none;
}

.login-link .text-blue-600:hover {
    text-decoration: underline;
}
</style>
