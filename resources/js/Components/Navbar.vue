<template>
    <nav class="navbar">
        <div class="container">
            <div class="flex shrink-0 items-center">
                <Link :href="route('dashboard')">
                    <ApplicationLogo class="logo" />
                </Link>
                <a class="task-link">
                    Gerenciador de tarefas
                </a>
            </div>

            <div class="menu">
                <button v-if="role === 'admin'" @click="openModal" class="menu-link">Cadastrar Administrador</button>
                <form method="POST" action="/logout" class="inline">
                    <input type="hidden" :value="csrfToken" name="_token">
                    <button type="submit" class="menu-link">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</template>

<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import {defineEmits, defineProps} from "vue";

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const props = defineProps({
    role: {
        type: String,
        required: true,
    },
});

const emit = defineEmits();

const openModal = () => {
    emit('openModal');
};
</script>

<style scoped>
.navbar {
    border-bottom: 1px solid #f3f4f6;
    width: 100%;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 4rem;
}

.logo {
    height: 2.25rem;
    width: auto;
    fill: currentColor;
    color: #1f2937;
}

.task-link {
    font-size: 1.125rem;
    font-weight: bold;
    color: #1f2937;
    margin-left: 2.5rem;
}

.menu {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.menu-link {
    color: #4b5563;
    text-decoration: none;
    font-size: 1rem;
}

.menu-link:hover {
    color: #1f2937;
}
</style>
