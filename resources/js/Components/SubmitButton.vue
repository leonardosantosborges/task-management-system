<template>
    <div class="form-group">
        <button
            type="submit"
            class="btn btn-dark"
        >
            <slot></slot>
        </button>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.btn-dark {
    width: 100%;
    padding: 1rem;
    font-size: 1rem;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: background-color 0.2s;
}
</style>
