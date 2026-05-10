<template>
    <header class="bg-blue-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-semibold">
                <Link :href="route('home')">Workopia</Link>
            </h1>
            <nav class="hidden md:flex items-center space-x-4">
                <NavLink :url="route('home')">Home</NavLink>
                <NavLink :url="route('jobs.index')">All Jobs</NavLink>
                <NavLink v-if="user" :url="route('bookmarks.index')"
                    >Saved Jobs</NavLink
                >
                <Link
                    v-if="user"
                    :href="route('logout')"
                    as="button"
                    method="delete"
                    class="py-2 cursor-pointer"
                >
                    <i class="fa fa-sign-out"></i> Logout
                </Link>
                <div v-if="user" class="flex items-center space-x-3">
                    <Link :href="route('dashboard')">
                        <img
                            class="w-10 h-10 rounded-full"
                            :src="`/storage/${user.avatar}`"
                            v-if="user.avatar"
                            :alt="user.name"
                        />
                        <img
                            class="w-10 h-10 rounded-full"
                            :src="`/storage/avatars/default-avatar.png`"
                            v-else
                            :alt="user.name"
                        />
                    </Link>
                </div>
                <ButtonLink v-if="user" :url="route('jobs.create')" icon="edit"
                    >Create Job</ButtonLink
                >
                <NavLink v-if="!user" :url="route('login')">Login</NavLink>
                <NavLink v-if="!user" :url="route('register')"
                    >Register</NavLink
                >
            </nav>
            <button
                aria-label="hamburger"
                @click="menu = !menu"
                id="hamburger"
                class="text-white md:hidden flex items-center"
            >
                <i class="fa fa-bars text-2xl"></i>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div
            id="mobile-menu"
            class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2"
            :class="{ hidden: menu }"
        >
            <NavLink mobile :url="route('home')">Home</NavLink>
            <NavLink mobile :url="route('jobs.index')">All Jobs</NavLink>
            <Link v-if="user" class="block px-4 py-2 hover:bg-blue-700"
                >Saved Jobs</Link
            >
            <NavLink v-if="user" mobile :url="route('dashboard')"
                >Dashboard</NavLink
            >
            <Link
                v-if="user"
                :href="route('logout')"
                as="button"
                method="delete"
                class="px-4 py-2 cursor-pointer"
            >
                <i class="fa fa-sign-out"></i> Logout
            </Link>
            <ButtonLink
                v-if="user"
                block
                :url="route('jobs.create')"
                icon="edit"
                >Create Job</ButtonLink
            >
            <NavLink v-if="!user" mobile :url="route('login')">Login</NavLink>
            <NavLink v-if="!user" mobile :url="route('register')"
                >Register</NavLink
            >
        </div>
    </header>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import NavLink from "./NavLink.vue";
import ButtonLink from "./ButtonLink.vue";
import { computed, ref } from "vue";

const menu = ref(false);

const page = usePage();
const user = computed(() => page.props.user);
</script>

<style lang="scss" scoped></style>
