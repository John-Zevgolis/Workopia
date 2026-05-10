<template>
    <Header />
    <Hero v-if="route().current('home')" />
    <TopBanner v-if="route().current('home')" />
    <Alert v-if="alert" :type="alert.type">{{ alert.message }}</Alert>
    <main class="container mx-auto p-4 mt-4">
        <slot />
    </main>
</template>

<script setup>
import Alert from "@/Components/UI/Alert.vue";
import Header from "@/Components/UI/Header.vue";
import Hero from "@/Components/UI/Hero.vue";
import TopBanner from "@/Components/UI/TopBanner.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const alert = computed(() => {
    if (page.props.flash.success) {
        return { message: page.props.flash.success, type: "success" };
    }
    if (page.props.flash.error) {
        return { message: page.props.flash.error, type: "error" };
    }
    return null;
});
</script>

<style lang="scss" scoped></style>
