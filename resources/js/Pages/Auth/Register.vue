<template>
    <div class="auth-container">
        <div class="auth-form">
            <h2 class="auth-title">Registrar</h2>

            <ErrorList :errors="errorMessages" />

            <form @submit.prevent="submitForm">
                <input type="hidden" :value="csrfToken" name="_token">
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
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    methods: {
        async submitForm() {
            this.errorMessages = [];

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch("/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify(this.form),
            });

            if (response.ok) {
                const data = await response.json();
                console.log("User registered successfully:", data.message);

                window.location.href = data.redirect_url;
            } else {
                const errorData = await response.json();
                console.error("Erro durante o registro:", errorData);
                this.errorMessages = errorData.errors ? Object.values(errorData.errors).flat() : ["An unknown error occurred"];
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
