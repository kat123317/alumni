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
const post_images = ref([]);
const postAlert = ref("");


const post_data = useForm({
    job_title: "",
    job_description: "",
    job_email: "",
    job_salary: "",
    job_company: "",
    location: "",
    photos:[]
});

const errorAlert = (data) => {
    if (data) {
        postAlert.value = data;
        setTimeout(() => {
            postAlert.value = "";
        }, 3000);
    }
};

const function_add_job_post = () => {
    
    if (
        post_data.job_title == "" ||
        post_data.job_description == "" ||
        post_data.job_email == "" ||
        post_data.job_salary == "" ||
        post_data.job_company == "" ||
        post_data.location == "" 
    ) {
        errorAlert("System will not allow empty post, Sorry");
    } else {
        post_data.post(route("socialmedia.post_job"), {
            preserveScroll: true,
            onSuccess: () => {
                post_data.reset();
                post_images.value = [];
                post_data.photos = [];
                emits("closeModal");
                usePage().props.value.errors.job_email = "";
                errorAlert("Your content has been posted");
            },
        });
    }
};

const openFile = () => {
    let hidden = document.getElementById("post_image");
    hidden.click();
    hidden.onchange = (e) => {
        if (post_images.value.length + e.target.files.length > 1) {
            errorAlert("Only 1 images can be selected");
            return;
        } else {
            for (let index = 0; index < e.target.files.length; index++) {
                post_images.value.push(
                    window.URL.createObjectURL(e.target.files[index])
                );
                post_data.photos.push(e.target.files[index]);
            }
        }
    };
};

const remove_image = (key) => {
    post_images.value.splice(key, 1);
    post_data.photos.splice(key, 1);
};
</script>

<template>
    <section>
        <div
                v-if="postAlert"
                class="p-4 mb-4 border border-blue-300 rounded-lg bg-blue-50"
                role="alert"
            >
                <div class="flex justify-center items-center">
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5 mr-2 text-blue-900"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="sr-only">Notification</span>
                    <h3 class="text-lg font-medium text-blue-900">
                        Notification
                    </h3>
                </div>
                <div class="mt-2 text-center mb-4 text-sm text-blue-900">
                    {{ postAlert }}
                </div>
                <div class="flex justify-center">
                    <button
                        type="button"
                        @click="postAlert = ''"
                        class="text-blue-900 bg-transparent border border-blue-900 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
                        data-dismiss-target="#alert-additional-content-1"
                        aria-label="Close"
                    >
                        Dismiss
                    </button>
                </div>
            </div>
        <div class="relative z-20 flex justify-center">
            <div
                v-if="showHide"
                class="fixed fade-in backdrop-blur-sm inset-0 z-10 overflow-y-auto"
                aria-labelledby="modal-title"
                role="dialog"
                aria-modal="true"
            >
                <div
                    class="flex items-end justify-center min-h-screen px-4 pt-1 pb-[50vmin] text-center sm:block sm:p-0"
                >
                    <span
                        class="sm:inline-block sm:h-screen sm:align-middle"
                        aria-hidden="true"
                        >&#8203;</span
                    >
                    <div
                        class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle"
                    >
                        <h3
                            class="text-lg font-medium leading-6 text-gray-800 capitalize"
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
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            />
                        </label>

                        <label class="block mt-3" for="Description">
                       
                            <QuillEditor v-model:content="post_data.job_description" theme="snow" toolbar="minimal"   id="postEditor"   contentType="html"></QuillEditor>
                           
                        </label>
                        <small>Description</small>

                        <label class="block mt-3" for="contact">
                            <input
                                type="text"
                                name="contact"
                                id="contact"
                                placeholder="Contact Email"
                                v-model="post_data.job_email"
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            />
                            <small class="text-red-500">{{
                                usePage().props.value.errors.job_email
                            }}</small>
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

                        <label class="block mt-3" for="Location">
                            <input
                                type="text"
                                name="Location"
                                id="Location"
                                placeholder="Location"
                                v-model="post_data.location"
                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            />
                        </label>

                        <div class="w-full h-5 flex justify-between mt-6 px-3 md:px-10 lg:px-24 xl:px-5">
                                    <div class="flex">
                                        <button
                                            @click="openFile()"
                                            class="flex h-full items-center"
                                        >
                                            <svg
                                                class="h-12 text-green-500 stroke-current"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="27"
                                                height="27"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="#b0b0b0"
                                                stroke-width="2"
                                                stroke-linecap="square"
                                                stroke-linejoin="round"
                                            >
                                                <rect
                                                    x="3"
                                                    y="3"
                                                    width="18"
                                                    height="18"
                                                    rx="2"
                                                />
                                                <circle
                                                    cx="8.5"
                                                    cy="8.5"
                                                    r="1.5"
                                                />
                                                <path
                                                    d="M20.4 14.5L16 10 4 20"
                                                />
                                            </svg>
                                            <span
                                                class="text-xs lg:text-md mx-2 font-semibold text-gray-500"
                                                >Upload Photo
                                            </span>
                                        </button>
                                    </div>
                                    <input
                                        id="post_image"
                                        type="file"
                                        class="hidden"
                                        accept="image/png, image/gif, image/jpeg"
                                        multiple
                                    />
                                </div>
                                <div
                                v-if="post_images != null"
                                class="grid mt-2 grid-cols-1"
                            >
                                <div
                                    v-for="(image, key) in post_images"
                                    :key="key"
                                >
                                    <div
                                        class="w-auto mt-2 mx-auto  z-30"
                                    >
                                        <div class="shadow-lg bg-white p-3">
                                            <img
                                                class="w-full max-h-[100%] object-cover"
                                                :src="image"
                                            />
                                            <ul
                                                class="mt-3 flex justify-end flex-wrap"
                                            >
                                                <li>
                                                    <button
                                                        @click="
                                                            remove_image(key)
                                                        "
                                                        class="flex text-gray-400 hover:text-gray-600"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.5"
                                                            stroke="currentColor"
                                                            class="w-6 h-6"
                                                        >
                                                            <path
                                                                class="text-red-500"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                            />
                                                        </svg>
                                                        <span
                                                            class="text-red-500"
                                                            >Remove</span
                                                        >
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                            <button
                                type="button"
                                @click="$emit('closeModal')"
                                class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40"
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
