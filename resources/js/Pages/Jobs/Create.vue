<template>
    <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
        <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>
        <form @submit.prevent="createJob" enctype="multipart/form-data">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            <Text
                id="title"
                name="title"
                label="Job Title"
                placeholder="Software Engineer"
                v-model="form.title"
                :error="form.errors.title"
            />

            <Textarea
                id="description"
                name="description"
                label="Job Description"
                placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..."
                v-model="form.description"
                :error="form.errors.description"
            />

            <Text
                id="salary"
                name="salary"
                label="Annual Salary"
                placeholder="90000"
                type="number"
                v-model="form.salary"
                :error="form.errors.salary"
            />

            <Textarea
                id="requirements"
                name="requirements"
                label="Requirements"
                placeholder="Bachelor's degree in Computer Science"
                v-model="form.requirements"
                :error="form.errors.requirements"
            />

            <Textarea
                id="benefits"
                name="benefits"
                label="Benefits"
                placeholder="Health insurance, 401k, paid time off"
                v-model="form.benefits"
                :error="form.errors.benefits"
            />

            <Text
                id="tags"
                name="tags"
                label="Tags (comma-separated)"
                placeholder="development,coding,java,python"
                v-model="form.tags"
                :error="form.errors.tags"
            />

            <Select
                id="job_type"
                name="job_type"
                label="Job Type"
                v-model="form.job_type"
                :error="form.errors.job_type"
                :options="[
                    { value: 'Full-Time', label: 'Full-Time' },
                    { value: 'Part-Time', label: 'Part-Time' },
                    { value: 'Contract', label: 'Contract' },
                    { value: 'Temporary', label: 'Temporary' },
                    { value: 'Internship', label: 'Internship' },
                    { value: 'Volunteer', label: 'Volunteer' },
                    { value: 'On-Call', label: 'On-Call' },
                ]"
            />

            <Select
                id="remote"
                name="remote"
                label="Remote"
                v-model="form.remote"
                :error="form.errors.remote"
                :options="[
                    { value: false, label: 'No' },
                    { value: true, label: 'Yes' },
                ]"
            />

            <Text
                id="address"
                name="address"
                label="T123 Main St"
                placeholder="123 Main St"
                v-model="form.address"
                :error="form.errors.address"
            />

            <Text
                id="city"
                name="city"
                label="City"
                placeholder="Albany"
                v-model="form.city"
                :error="form.errors.city"
            />

            <Text
                id="state"
                name="state"
                label="State"
                placeholder="NY"
                v-model="form.state"
                :error="form.errors.state"
            />

            <Text
                id="zipcode"
                name="zipcode"
                label="ZIP Code"
                placeholder="12201"
                v-model="form.zipcode"
                :error="form.errors.zipcode"
            />

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>

            <Text
                id="company_name"
                name="company_name"
                label="Company Name"
                placeholder="Company name"
                v-model="form.company_name"
                :error="form.errors.company_name"
            />

            <Textarea
                id="company_description"
                name="company_description"
                label="Company Description"
                placeholder="Company Description"
                v-model="form.company_description"
                :error="form.errors.company_description"
            />

            <Text
                id="company_website"
                name="company_website"
                label="Company Website"
                placeholder="Company name"
                type="url"
                v-model="form.company_website"
                :error="form.errors.company_website"
            />

            <Text
                id="contact_phone"
                name="contact_phone"
                label="Contact Phone"
                placeholder="Enter phone"
                v-model="form.contact_phone"
                :error="form.errors.contact_phone"
            />

            <Text
                id="contact_email"
                name="contact_email"
                label="Contact Email"
                type="email"
                placeholder="Email where you want to receive applications"
                v-model="form.contact_email"
                :error="form.errors.contact_email"
            />

            <File
                id="company_logo"
                name="company_logo"
                label="Company Logo"
                :error="form.errors.company_logo"
                v-model="form.company_logo"
            />

            <button
                type="submit"
                class="w-full cursor-pointer bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
            >
                Save
            </button>
        </form>
    </div>
</template>

<script setup>
import File from "@/Components/Inputs/File.vue";
import Select from "@/Components/Inputs/Select.vue";
import Text from "@/Components/Inputs/Text.vue";
import Textarea from "@/Components/Inputs/Textarea.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    title: "",
    description: "",
    salary: "",
    tags: "",
    job_type: "Full-Time",
    remote: false,
    requirements: "",
    benefits: "",
    address: "",
    city: "",
    state: "",
    zipcode: "",
    contact_phone: "",
    contact_email: "",
    company_name: "",
    company_description: "",
    company_logo: null,
    company_website: "",
});

const createJob = () => form.post(route("jobs.store"));
</script>

<style lang="scss" scoped></style>
