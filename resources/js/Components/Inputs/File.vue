<template>
    <div class="mb-4">
        <label v-if="label" class="block text-gray-700" :for="id">{{
            label
        }}</label>
        <input
            @change="hanldeFileChange"
            :id="id"
            type="file"
            :name="name"
            class="w-full px-4 py-2 border rounded focus:outline-none"
            :class="{ 'border-red-500': error }"
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
    error: String,
});

const emit = defineEmits(["update:modelValue"]);

const hanldeFileChange = (event) => {
    const file = event.target.files[0];
    emit("update:modelValue", file);
};
</script>

<style lang="scss" scoped></style>
