<template>
    <div class="mb-4">
        <label v-if="label" class="block text-gray-700" :for="id">{{
            label
        }}</label>
        <select
            :id="id"
            :name="name"
            class="w-full px-4 py-2 border rounded focus:outline-none"
            :class="{ 'border-red-500': error }"
            v-model="model"
        >
            <option
                v-for="option in options"
                :key="option.value"
                :value="option.value"
            >
                {{ option.label }}
            </option>
            <!-- <option value="Full-Time">Full-Time</option>
            <option value="Part-Time">Part-Time</option>
            <option value="Contract">Contract</option>
            <option value="Temporary">Temporary</option>
            <option value="Internship">Internship</option>
            <option value="Volunteer">Volunteer</option>
            <option value="On-Call">On-Call</option> -->
        </select>
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
    options: {
        type: Array,
        default: [],
    },
    error: String,
});

const model = defineModel();
</script>

<style lang="scss" scoped></style>
