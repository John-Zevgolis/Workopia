<template>
    <div class="mb-4">
        <label v-if="label" class="block text-gray-700" :for="id">{{
            label
        }}</label>
        <input
            :id="id"
            :type="type"
            :name="name"
            class="w-full px-4 py-2 border rounded focus:outline-none"
            :class="{ 'border-red-500': error }"
            :placeholder="placeholder"
            v-model="model"
        />
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
    type: {
        type: String,
        default: "text",
    },
    placeholder: {
        type: String,
        default: "",
    },
    error: String,
});

const model = defineModel();
</script>

<style lang="scss" scoped></style>
