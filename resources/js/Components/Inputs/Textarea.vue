<template>
    <div class="mb-4">
        <label v-if="label" class="block text-gray-700" :for="id">{{
            label
        }}</label>
        <textarea
            :cols="cols"
            :rows="rows"
            :id="id"
            :name="name"
            class="w-full px-4 py-2 border rounded focus:outline-none"
            :class="{ 'border-red-500': error }"
            :placeholder="placeholder"
            v-model="model"
        ></textarea>
        <p class="text-red-500 text-sm mt-1" v-if="error">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
defineProps({
    id: String,
    name: String,
    label: {
        type: String,
        default: null,
    },
    placeholder: {
        type: String,
        default: "",
    },
    rows: {
        type: Number,
        default: 7,
    },
    cols: {
        type: Number,
        default: 30,
    },
    error: String,
});

const model = defineModel();
</script>

<style lang="scss" scoped></style>
