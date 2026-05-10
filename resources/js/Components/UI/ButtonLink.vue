<template>
    <Link
        :href="url"
        :class="{ block }"
        class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300"
        ><i v-if="icon" :class="`fa fa-${icon} mr-1`"></i> <slot
    /></Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    url: String,
    icon: String,
    block: {
        type: Boolean,
        default: false,
    },
});
</script>

<style lang="scss" scoped></style>
