<template>
    <section class="flex flex-col md:flex-row gap-6">
        <!-- Profile Info -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-1/2">
            <h3 class="text-3xl text-center font-bold mb-4">Profile Info</h3>
            <div v-if="user.avatar" class="mt-2 flex justify-center">
                <img
                    class="w-32 h-32 object-cover rounded-full"
                    :src="`/storage/${user.avatar}`"
                    :alt="user.name"
                />
            </div>
            <form @submit.prevent="updateUser">
                <Text
                    id="name"
                    name="name"
                    label="Name"
                    v-model="form.name"
                    :error="form.errors.name"
                />
                <Text
                    type="email"
                    id="email"
                    name="email"
                    label="Email"
                    v-model="form.email"
                    :error="form.errors.email"
                />
                <File
                    id="avatar"
                    name="avatar"
                    label="Upload Avatar"
                    :error="form.errors.avatar"
                    v-model="form.avatar"
                />
                <button
                    type="submit"
                    class="w-full cursor-pointer bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
                >
                    Save
                </button>
            </form>
        </div>

        <!-- My Job Listings -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">My Job Listings</h3>
            <div v-if="jobs.length">
                <div v-for="job in jobs" :key="job.id">
                    <div
                        class="flex justify-between items-center border-b-2 border-gray-200 py-2"
                    >
                        <div>
                            <h3 class="text-xl font-semibold">
                                {{ job.title }}
                            </h3>
                            <p class="text-gray-700">{{ job.job_type }}</p>
                        </div>
                        <div class="flex gap-3">
                            <Link
                                :href="route('jobs.edit', job.id)"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm"
                                >Edit</Link
                            >
                            <Link
                                :href="
                                    route('jobs.destroy', {
                                        job: job.id,
                                        from: 'dashboard',
                                    })
                                "
                                as="button"
                                method="delete"
                                class="bg-red-500 hover:bg-red-600 cursor-pointer text-white px-4 py-2 rounded text-sm"
                            >
                                Delete
                            </Link>
                        </div>
                    </div>
                    <div class="mt-4 bg-gray-100 p-2">
                        <h4 class="text-lg font-semibold">Applicants</h4>
                        <div v-if="job.applicants.length">
                            <div
                                v-for="applicant in job.applicants"
                                :key="applicant.id"
                            >
                                <div class="py-2">
                                    <p class="text-gray-800">
                                        <strong>Name: </strong
                                        >{{ applicant.full_name }}
                                    </p>
                                    <p class="text-gray-800">
                                        <strong>Phone: </strong
                                        >{{ applicant.contact_phone }}
                                    </p>
                                    <p class="text-gray-800">
                                        <strong>Email: </strong
                                        >{{ applicant.contact_email }}
                                    </p>
                                    <p class="text-gray-800">
                                        <strong>Message: </strong
                                        >{{ applicant.message }}
                                    </p>
                                    <p class="text-gray-800 mt-2">
                                        <a
                                            download
                                            :href="`/storage/${applicant.resume_path}`"
                                            class="text-blue-500 hover:underline text-sm"
                                        >
                                            <i class="fas fa-download"></i>
                                            Download Resume
                                        </a>
                                    </p>
                                    <button
                                        class="text-red-500 hover:text-red-700 text-sm"
                                        @click="confirmDelete(applicant.id)"
                                    >
                                        <i class="fas fa-trash"></i> Delete
                                        Applicant
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p v-else class="text-gray-700">
                            No applicants for this jobs
                        </p>
                    </div>
                </div>
            </div>
            <p v-else class="text-gray-700">You have not job listings</p>
        </div>
    </section>
</template>

<script setup>
import File from "@/Components/Inputs/File.vue";
import Text from "@/Components/Inputs/Text.vue";
import { Link, useForm, usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    jobs: Array,
});

const page = usePage();
const user = computed(() => page.props.user);

const form = useForm({
    name: page.props.user.name,
    email: page.props.user.email,
    avatar: null,
});

const updateUser = () => form.put(route("profile.update"));

const confirmDelete = (id) => {
    if (confirm("Are you sure you want to delete this applicant?")) {
        router.delete(route("applicant.destroy", id), {
            preserveScroll: true,
        });
    }
};
</script>

<style lang="scss" scoped></style>
