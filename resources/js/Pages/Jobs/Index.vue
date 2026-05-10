<template>
    <div
        class="bg-blue-900 h-24 px-4 mb-4 flex justify-center items-center rounded"
    >
        <Search :filters="filters" @search="checkData" />
    </div>

    <Link
        v-if="show"
        :href="route('jobs.index')"
        class="bg-gray-700 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-600"
    >
        <i class="fa fa-arrow-left mr-1"></i>Back
    </Link>
    <div v-if="jobs.data.length">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div v-for="job in jobs.data" :key="job">
                <JobCard :job="job" />
            </div>
        </div>
        <div class="w-full flex justify-center my-4">
            <Pagination :links="jobs.links" />
        </div>
    </div>
    <p v-else>No jobs available</p>
</template>

<script setup>
import Pagination from "@/Components/UI/Pagination.vue";
import JobCard from "./Components/JobCard.vue";
import Search from "@/Components/UI/Search.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    jobs: Object,
    filters: Object,
});

const show = ref(false);

const checkData = (data) => {
    Object.values(data).some((item) => item.trim())
        ? (show.value = true)
        : (show.value = false);
};
</script>

<style lang="scss" scoped></style>
