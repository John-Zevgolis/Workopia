<template>
    <div
        class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12"
    >
        <h2 class="text-4xl text-center font-bold mb-4">Register</h2>
        <form @submit.prevent="createUser">
            <div class="mb-4">
                <Text
                    :error="form.errors.name"
                    v-model="form.name"
                    name="name"
                    placeholder="Full Name"
                />
            </div>
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
            <div class="mb-4">
                <Text
                    :error="form.errors.password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                />
            </div>
            <button
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none"
            >
                Register
            </button>

            <p class="mt-4 text-gray-500">
                Already have an account?
                <Link class="text-blue-900" :href="route('login')">Login</Link>
            </p>
        </form>
    </div>
</template>

<script setup>
import Text from "@/Components/Inputs/Text.vue";
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const createUser = () => form.post(route("register.store"));
</script>

<style lang="scss" scoped></style>
