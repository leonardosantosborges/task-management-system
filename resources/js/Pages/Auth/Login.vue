<template>
    <div class="auth-container">
        <div class="auth-form">
            <h2 class="auth-title">Logar</h2>

            <div v-if="form.errors.email" class="alert alert-danger">
                {{ form.errors.email }}
            </div>
            <div v-if="form.errors.password" class="alert alert-danger">
                {{ form.errors.password }}
            </div>

            <form @submit.prevent="handleLogin">
                <FormInput
                    id="email"
                    label="Email"
                    v-model="form.email"
                    type="email"
                    required
                />

                <FormInput
                    id="password"
                    label="Senha"
                    v-model="form.password"
                    type="password"
                    required
                />

                <div class="form-group">
                    <SubmitButton>Logar</SubmitButton>
                </div>
            </form>

            <div class="register-link">
                <p>Ainda não tem uma conta?
                    <inertia-link href="/register" class="text-blue-600">Registre-se</inertia-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { Link as InertiaLink } from '@inertiajs/vue3';
import SubmitButton from "@/Components/SubmitButton.vue";
import FormInput from "@/Components/FormInput.vue";

export default {
    components: {
        FormInput,
        SubmitButton,
        InertiaLink
    },
    setup() {
        const form = useForm({
            email: "",
            password: "",
        });

        const handleLogin = () => {
            form.post("/login", {
                onSuccess: () => {
                    window.location.href = "/dashboard";
                },
                onError: () => {
                }
            });
        };

        return { form, handleLogin };
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
    padding: 2rem;
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

.form-group {
    margin-bottom: 1.5rem;
}

.register-link {
    text-align: center;
    margin-top: 1rem;
}

.register-link .text-blue-600 {
    color: #2563eb;
    text-decoration: none;
}

.register-link .text-blue-600:hover {
    text-decoration: underline;
}
</style>
