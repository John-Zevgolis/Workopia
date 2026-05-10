<template>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <section class="md:col-span-3">
            <div class="rounded-lg shadow-md bg-white p-3">
                <div class="flex justify-between items-center">
                    <Link
                        class="block p-4 text-blue-700"
                        :href="route('jobs.index')"
                    >
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        Back To Listings
                    </Link>
                    <div class="flex space-x-3 ml-4">
                        <Link
                            :href="route('jobs.edit', job.id)"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                            >Edit</Link
                        >
                        <Link
                            :href="route('jobs.destroy', job.id)"
                            as="button"
                            method="delete"
                            class="px-4 py-2 cursor-pointer bg-red-500 hover:bg-red-600 text-white rounded"
                        >
                            Delete
                        </Link>
                    </div>
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{ job.title }}</h2>
                    <p class="text-gray-700 text-lg mt-2">
                        {{ job.description }}
                    </p>
                    <ul class="my-4 bg-gray-100 p-4">
                        <li class="mb-2">
                            <strong>Job Type:</strong> {{ job.job_type }}
                        </li>
                        <li class="mb-2">
                            <strong>Remote:</strong>
                            {{ job.remote ? "Yes" : "No" }}
                        </li>
                        <li class="mb-2">
                            <strong>Salary:</strong> ${{
                                Number(job.salary).toLocaleString()
                            }}
                        </li>
                        <li class="mb-2">
                            <strong>Site Location:</strong> {{ job.city }},
                            {{ job.state }}
                        </li>
                        <li v-if="job.tags" class="mb-2">
                            <strong>Tags:</strong>
                            {{ tags }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container mx-auto p-4">
                <div v-if="job.requirements || job.benefits">
                    <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                    <div class="rounded-lg shadow-md bg-white p-4">
                        <h3 class="text-lg font-semibold mb-2 text-blue-500">
                            Job Requirements
                        </h3>
                        <p>{{ job.requirements }}</p>
                        <h3
                            class="text-lg font-semibold mt-4 mb-2 text-blue-500"
                        >
                            Benefits
                        </h3>
                        <p>{{ job.benefits }}</p>
                    </div>
                    <div v-if="user">
                        <p class="my-5">
                            Put "Job Application" as the subject of your email
                            and attach your resume.
                        </p>
                        <button
                            @click="open = true"
                            class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
                        >
                            Apply Now
                        </button>
                        <Transition name="modal">
                            <div
                                v-show="open"
                                @click.self="open = false"
                                class="fixed overflow-auto inset-0 z-100 p-3 flex justify-center bg-gray-900/50"
                            >
                                <div
                                    class="bg-white w-full max-w-md my-auto p-6 rounded-lg shadow-md"
                                >
                                    <h3 class="text-lg font-semibold mb-4">
                                        Apply For {{ job.title }}
                                    </h3>
                                    <form @submit.prevent="apply">
                                        <Text
                                            v-model="form.full_name"
                                            :error="form.errors.full_name"
                                            id="full_name"
                                            name="full_name"
                                            label="Full Name"
                                        />
                                        <Text
                                            v-model="form.contact_phone"
                                            :error="form.errors.contact_phone"
                                            id="contact_phone"
                                            name="contact_phone"
                                            label="Contact Phone"
                                        />
                                        <Text
                                            v-model="form.contact_email"
                                            :error="form.errors.contact_email"
                                            id="email"
                                            name="email"
                                            label="Contact Email"
                                        />
                                        <Textarea
                                            v-model="form.message"
                                            :error="form.errors.message"
                                            id="message"
                                            name="message"
                                            label="Message"
                                        />
                                        <Text
                                            v-model="form.location"
                                            :error="form.errors.location"
                                            id="location"
                                            name="location"
                                            label="Location"
                                        />
                                        <File
                                            :key="fileKey"
                                            v-model="form.resume"
                                            :error="form.errors.resume"
                                            id="resume"
                                            name="resume"
                                            label="Upload Your Resume (pdf)"
                                        />
                                        <button
                                            class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"
                                        >
                                            Submit Application
                                        </button>
                                        <button
                                            type="button"
                                            @click="open = false"
                                            class="ml-1 cursor-pointer bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md"
                                        >
                                            Cancel
                                        </button>
                                        <div
                                            v-if="form.errors.error_message"
                                            class="mt-4 p-3 bg-red-100 text-red-700 text-sm rounded-md border border-red-200"
                                        >
                                            <i
                                                class="fas fa-exclamation-circle"
                                            ></i>
                                            {{ form.errors.error_message }}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </Transition>
                    </div>
                    <p v-else class="my-5 bg-gray-200 rounded p-3">
                        <i class="fas fa-info-circle mr-3"></i> You must be
                        logged in to apply for this job
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md mt-6">
                <div id="map" class="h-[400px]"></div>
            </div>
        </section>
        <aside class="bg-white rounded-lg shadow-md p-3">
            <h3 class="text-xl text-center mb-4 font-bold">Company Info</h3>
            <img
                v-if="job.company_logo"
                :src="`/storage/${job.company_logo}`"
                :alt="job.company_name"
                class="w-full rounded-lg mb-4 m-auto"
            />
            <h4 class="text-lg font-bold">{{ job.company_name }}</h4>
            <p
                v-if="job.company_description"
                class="text-gray-700 text-lg my-3"
            >
                {{ job.company_description }}
            </p>
            <a
                v-if="job.company_website"
                :href="job.company_website"
                target="_blank"
                class="text-blue-500"
                >Visit Website</a
            >
            <Link
                v-if="user"
                :preserve-scroll="true"
                :href="
                    route(
                        jobIsBookmarked
                            ? 'bookmarks.destroy'
                            : 'bookmarks.store',
                        job.id,
                    )
                "
                as="button"
                :method="jobIsBookmarked ? 'delete' : 'post'"
                class="mt-10 cursor-pointer text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center"
                :class="
                    jobIsBookmarked
                        ? 'bg-red-500 hover:bg-red-600'
                        : 'bg-blue-500 hover:bg-blue-600'
                "
                ><i class="fas fa-bookmark mr-3"></i>
                {{
                    jobIsBookmarked ? "Remove Bookmark" : "Bookmark Listing"
                }}</Link
            >
            <p
                v-else
                class="mt-10 bg-gray-200 text-gray-700 font-bold w-full py-2 px-4 rounded-full text-center"
            >
                <i class="fas fa-info-circle mr-3"></i> You must be looged in to
                bookmark a job
            </p>
        </aside>
    </div>
</template>

<script setup>
import File from "@/Components/Inputs/File.vue";
import Text from "@/Components/Inputs/Text.vue";
import Textarea from "@/Components/Inputs/Textarea.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { computed, ref, watch, onMounted } from "vue";
import mapboxgl from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";

const props = defineProps({
    job: Object,
    mapboxToken: String,
});

const tags = computed(() => {
    return props.job.tags
        .split(",")
        .map((tag) => {
            const firstLetter = tag.charAt(0).toUpperCase();
            const remainingLetters = tag.slice(1);
            return firstLetter + remainingLetters;
        })
        .join(", ");
});

const page = usePage();
const user = computed(() => page.props.user);
const jobIsBookmarked = computed(() =>
    page.props.user.bookmarked.includes(props.job.id),
);

const open = ref(false);
const fileKey = ref(0);

const form = useForm({
    full_name: "",
    contact_email: "",
    contact_phone: "",
    message: "",
    location: "",
    resume: null,
});

const apply = () =>
    form.post(route("applicant.store", props.job.id), {
        preserveScroll: true,
        onSuccess: () => {
            open.value = false;
            fileKey.value++;
            form.reset();
        },
    });

watch(open, (value) => {
    if (value) {
        document.body.classList.add("overflow-hidden");
    } else {
        document.body.classList.remove("overflow-hidden");
    }
});

onMounted(() => {
    mapboxgl.accessToken = props.mapboxToken;

    const map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11",
        center: [-74.5, 40],
        zoom: 9,
    });

    const address = `${props.job.city}, ${props.job.state}`;

    fetch(`/geocode?address=${encodeURIComponent(address)}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.features && data.features.length > 0) {
                const [longitude, latitude] = data.features[0].center;

                map.setCenter([longitude, latitude]);
                map.setZoom(14);

                new mapboxgl.Marker()
                    .setLngLat([longitude, latitude])
                    .addTo(map);
            }
        })
        .catch((error) => console.error("Geocoding error:", error));
});
</script>

<style scoped>
.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from .bg-white,
.modal-leave-to .bg-white {
    transform: scale(0.9);
}

.modal-enter-active .bg-white,
.modal-leave-active .bg-white {
    transition: transform 0.3s ease;
}
</style>
