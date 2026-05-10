<template>
    <section class="bg-blue-900 text-white py-6 text-center">
        <div class="container mx-auto">
            <h2 class="text-3xl font-semibold">
                <slot name="heading">Unlock Your Career Potential</slot>
            </h2>
            <p class="text-lg mt-2">
                <slot name="subheading"
                    >Discover the perfect job opportunity for you.</slot
                >
            </p>
        </div>
    </section>
</template>

<script setup></script>

<style lang="scss" scoped></style>
