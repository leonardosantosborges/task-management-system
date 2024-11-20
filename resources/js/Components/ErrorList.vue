<template>
    <div v-if="errors.length > 0" class="alert alert-danger">
        <ul>
            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        errors: Array,
    },
};
</script>

<style scoped>
.alert {
    background-color: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border-radius: 0.375rem;
    border: 1px solid #f5c6cb;
}
</style>
