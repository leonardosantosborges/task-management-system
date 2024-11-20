<template>
    <div class="form-group">
        <label :for="id" class="form-label">{{ label }}</label>
        <input
            :type="type"
            :id="id"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" class="form-input"
            :required="required"
        />
    </div>
</template>

<script>
export default {
    props: {
        id: String,
        label: String,
        modelValue: String,
        type: {
            type: String,
            default: 'text',
        },
        required: {
            type: Boolean,
            default: true,
        },
    },
};
</script>

<style scoped>
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #4b5563;
    margin-bottom: 0.5rem;
}

.form-input {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    box-sizing: border-box;
    focus: outline-none;
    focus: ring-2;
    focus: ring-blue-500;
}
</style>
