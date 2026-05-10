<template>
    <section
        class="hero relative bg-cover bg-center bg-no-repeat h-72 flex items-center"
    >
        <div class="absolute inset-0 bg-black/80 z-10"></div>
        <div class="container mx-auto text-center z-10">
            <h2 class="text-5xl text-white font-bold mb-8">
                {{ title }}
            </h2>
            <Search />
        </div>
    </section>
</template>

<script setup>
import Search from "./Search.vue";

defineProps({
    title: {
        type: String,
        default: "Find Your Dream Job",
    },
});
</script>

<style scoped>
.hero {
    background-image: url("/images/hero.jpg");
}
</style>
