<template>
    <div class="rounded-lg shadow-md bg-white p-4 h-full flex flex-col">
        <div>
            <div class="flex items-center space-between gap-4">
                <img
                    v-if="job.company_logo"
                    :src="`/storage/${job.company_logo}`"
                    :alt="job.company_name"
                    class="w-14"
                />
                <div>
                    <h2 class="text-xl font-semibold">{{ job.title }}</h2>
                    <p class="text-sm text-gray-500">{{ job.job_type }}</p>
                </div>
            </div>
            <p class="text-gray-700 text-lg mt-2">
                {{ limitText(job.description, 100) }}
            </p>
        </div>
        <div class="mt-auto">
            <ul class="my-4 bg-gray-100 p-4 rounded">
                <li class="mb-2">
                    <strong>Salary:</strong> ${{
                        Number(job.salary).toLocaleString()
                    }}
                </li>
                <li class="mb-2">
                    <strong>Location:</strong> {{ job.city }}, {{ job.state }}
                    <span
                        v-if="job.remote"
                        class="text-xs bg-green-500 text-white rounded-full px-2 py-1 ml-2"
                    >
                        Remote
                    </span>
                    <span
                        v-else
                        class="text-xs bg-red-500 text-white rounded-full px-2 py-1 ml-2"
                    >
                        On-site
                    </span>
                </li>
                <li v-if="job.tags" class="mb-2">
                    <strong>Tags:</strong>
                    {{ tags }}
                </li>
            </ul>
        </div>
        <Link
            :href="route('jobs.show', job.id)"
            class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
        >
            Details
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    job: Object,
});

const limitText = (text, limit) => {
    if (!text) return;
    return text.length > limit ? text.slice(0, limit) + "..." : text;
};

const tags = computed(() => {
    return props.job.tags
        .split(",")
        .map((tag) => {
            const firstLetter = tag.charAt(0).toUpperCase();
            const remainingLetters = tag.slice(1);
            return firstLetter + remainingLetters;
        })
        .join(", ");
});
</script>

<style lang="scss" scoped></style>
