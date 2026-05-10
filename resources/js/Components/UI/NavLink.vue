<template>
    <Link
        v-if="mobile"
        :href="url"
        class="block px-4 py-2 hover:bg-blue-700"
        :class="{ 'font-bold text-yellow-500': isActive }"
        ><i v-if="icon" :class="`fa fa-${icon} mr-1`"></i> <slot
    /></Link>
    <Link
        v-else
        :href="url"
        class="text-white hover:underline py-2"
        :class="{ 'font-bold text-yellow-500': isActive }"
        ><i v-if="icon" :class="`fa fa-${icon} mr-1`"></i> <slot
    /></Link>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const isActive = computed(() => {
    const urlPath = new URL(props.url).pathname;

    return page.url === urlPath || page.url.startsWith(urlPath + "?");
});

const props = defineProps({
    active: Boolean,
    url: String,
    icon: String,
    mobile: {
        type: Boolean,
        default: false,
    },
});
</script>

<style lang="scss" scoped></style>
