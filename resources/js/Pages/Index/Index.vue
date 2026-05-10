<template>
    <h2 class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">
        Welcome To Workopia
    </h2>
    <div v-if="jobs.length" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div v-for="job in jobs" :key="job">
            <JobCard :job="job" />
        </div>
    </div>
    <p v-else>No jobs available</p>
    <Link :href="route('jobs.index')" class="block text-xl text-center">
        <i class="fa fa-arrow-alt-circle-right"></i> Show All Jobs
    </Link>
    <BottomBanner />
</template>

<script setup>
import BottomBanner from "@/Components/UI/BottomBanner.vue";
import { Link } from "@inertiajs/vue3";
import JobCard from "../Jobs/Components/JobCard.vue";

defineProps({
    jobs: Array,
});
</script>

<style lang="scss" scoped></style>
