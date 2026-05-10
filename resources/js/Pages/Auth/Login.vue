<template>
    <div
        class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12"
    >
        <h2 class="text-4xl text-center font-bold mb-4">Login</h2>
        <form @submit.prevent="login">
            <div class="mb-4">
                <Text
                    :error="form.errors.email"
                    v-model="form.email"
                    name="email"
                    placeholder="Email Address"
                />
            </div>
            <div class="mb-4">
                <Text
                    :error="form.errors.password"
                    v-model="form.password"
                    type="password"
                    name="password"
                    placeholder="Password"
                />
            </div>
            <button
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none"
            >
                Login
            </button>

            <p class="mt-4 text-gray-500">
                Don't have an account?
                <Link class="text-blue-900" :href="route('register')"
                    >Register</Link
                >
            </p>
        </form>
    </div>
</template>

<script setup>
import Text from "@/Components/Inputs/Text.vue";
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

const login = () => form.post(route("login.store"));
</script>

<style lang="scss" scoped></style>
