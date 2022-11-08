<script setup>
import { defineProps, defineEmits, ref, onMounted } from "vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
    showHide: {
        type: Boolean,
        default: false,
    },
});

const emits = defineEmits(["closeModal"]);

const post_data = useForm({
    job_title: "",
    job_description: "",
    job_email: "",
    job_salary: "",
    job_company: "",
});

const function_add_job_post = () => {
    if (
        post_data.job_title == "" ||
        post_data.job_description == "" ||
        post_data.job_email == "" ||
        post_data.job_salary == "" ||
        post_data.job_company == ""
    ) {
        errorAlert("System will not allow empty post, Sorry");
    } else {
        post_data.post(route("socialmedia.post_job"), {
            preserveScroll: true,
            onSuccess: () => {
                post_data.reset();
                emits("closeModal");
                errorAlert("Your content has been posted");
            },
        });
    }
};
</script>

<template>
    <section>
        <div class="relative z-20 flex justify-center">
            <div
                v-if="showHide"
                class="fixed fade-in backdrop-blur-sm inset-0 z-10 overflow-y-auto"
                aria-labelledby="modal-title"
                role="dialog"
                aria-modal="true"
            >
                <div
                    class="flex  items-end justify-center min-h-screen px-4 pt-1 pb-[50vmin] text-center sm:block sm:p-0"
                >
                    <span
                        class="sm:inline-block sm:h-screen sm:align-middle"
                        aria-hidden="true"
                        >&#8203;</span
                    >
                    <div
                        class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl w-[93vmin] md:w-[50vmin] sm:p-6 sm:align-middle"
                    >
                        <h3
                            class="text-lg font-medium leading-6 text-gray-800 capitalize "
                            id="modal-title"
                        >
                            Create Job/Work
                        </h3>

                        <label class="block mt-3" for="title">
                            <input
                                type="text"
                                name="title"
                                id="title"
                                placeholder="Job Title"
                                v-model="post_data.job_title"
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 "
                            />
                        </label>

                        <label class="block mt-3" for="Description">
                            <textarea
                                type="Description"
                                name="Description"
                                id="Description"
                                v-model="post_data.job_description"
                                placeholder="Job Description"
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 "
                            ></textarea>
                        </label>

                        <label class="block mt-3" for="contact">
                            <input
                                type="text"
                                name="contact"
                                id="contact"
                                placeholder="Contact Email"
                                v-model="post_data.job_email"
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            />
                        </label>

                        <label class="block mt-3" for="Salary">
                            <input
                                type="text"
                                name="Salary"
                                id="Salary"
                                placeholder="Salary"
                                v-model="post_data.job_salary"
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            />
                        </label>

                        <label class="block mt-3" for="Company">
                            <input
                                type="text"
                                name="Company"
                                id="Company"
                                placeholder="Company"
                                v-model="post_data.job_company"
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            />
                        </label>

                        <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                            <button
                                type="button"
                                @click="$emit('closeModal')"
                                class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2  hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40"
                            >
                                Cancel
                            </button>

                            <button
                                @click="function_add_job_post()"
                                type="button"
                                class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            >
                                Post Job
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.fade-in {
    -webkit-animation: fade-in 1.2s cubic-bezier(0.39, 0.575, 0.565, 1) both;
    animation: fade-in 1.2s cubic-bezier(0.39, 0.575, 0.565, 1) both;
}
@-webkit-keyframes fade-in {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
@keyframes fade-in {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>
