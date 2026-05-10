<template>
    <form @submit.prevent="search" class="block mx-5 md:mx-auto md:space-x-2">
        <input
            v-model="form.keywords"
            type="text"
            name="keywords"
            placeholder="Keywords"
            class="w-full md:w-72 px-4 py-3 focus:outline-none bg-white"
        />
        <input
            v-model="form.location"
            type="text"
            name="location"
            placeholder="Location"
            class="w-full md:w-72 px-4 py-3 focus:outline-none bg-white"
        />
        <button
            class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 focus:outline-none"
        >
            <i class="fa fa-search mr-1"></i> Search
        </button>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    filters: Object,
});

const form = useForm({
    keywords: props.filters?.keywords ?? "",
    location: props.filters?.location ?? "",
});

const emit = defineEmits(["search"]);

const search = () => {
    emit("search", form.data());

    form.get(route("jobs.search"), {
        preserveState: true,
    });
};

onMounted(() => {
    if (form.keywords || form.location) {
        emit("search", form.data());
    }
});
</script>

<style lang="scss" scoped></style>
