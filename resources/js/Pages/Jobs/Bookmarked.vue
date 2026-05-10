<template>
    <h2 class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">
        Saved Jobs
    </h2>
    <div v-if="bookmarks.data.length">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div v-for="job in bookmarks.data" :key="job">
                <JobCard :job="job" />
            </div>
        </div>
        <div class="w-full flex justify-center my-4">
            <Pagination :links="bookmarks.links" />
        </div>
    </div>
    <p v-else>No bookmarked jobs</p>
</template>

<script setup>
import Pagination from "@/Components/UI/Pagination.vue";
import JobCard from "./Components/JobCard.vue";

defineProps({
    bookmarks: Object,
});
</script>

<style lang="scss" scoped></style>
