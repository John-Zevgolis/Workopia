<template>
    <section class="container mx-auto my-6">
        <div
            class="bg-blue-800 text-white rounded p-4 flex items-center justify-between"
        >
            <div>
                <h2 class="text-xl font-semibold">
                    <slot name="heading">Looking to hire?</slot>
                </h2>
                <p class="text-gray-200 text-lg mt-2">
                    <slot name="subheading"
                        >Post your job listing now and find the perfect
                        candidate.</slot
                    >
                </p>
            </div>
            <ButtonLink :url="route('jobs.create')" icon="edit"
                >Create Job</ButtonLink
            >
        </div>
    </section>
</template>

<script setup>
import ButtonLink from "./ButtonLink.vue";
</script>

<style lang="scss" scoped></style>
