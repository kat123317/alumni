<script setup>
import { defineProps, defineEmits, ref, onMounted } from "vue";
const props = defineProps({
    showHideView: {
        type: Boolean,
        default: false,
    },
    jobData: {
        type: String,
        default: "nodata",
    },
});

const emits = defineEmits(["closeModalView"]);

const SendResume = () => {
    var yourMessage = "Application";
    var subject = "Resume: ";
    var mail =
        "mailto:" +
        props.jobData.job_email +
        "?subject=" +
        subject +
        "&body=" +
        yourMessage;

    window = window.open(mail, "emailWindow");
};
</script>

<template>
    <section v-if="showHideView">
        <div class="relative z-20 flex justify-center">
            <div
                class="fixed fade-in backdrop-blur-sm inset-0 z-10 overflow-y-auto"
                aria-labelledby="modal-title"
                role="dialog"
                aria-modal="true"
            >
                <div
                    class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0"
                >
                    <span
                        class="sm:inline-block sm:h-screen sm:align-middle"
                        aria-hidden="true"
                        >&#8203;</span
                    >
                    <div
                        class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle"
                    >
                        <h3
                            class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white"
                            id="modal-title"
                        >
                            {{ jobData.job_title }} - {{ jobData.job_company }}
                        </h3>
                        <p
                            class="mt-2 text-sm text-gray-500 dark:text-gray-400"
                        >
                            Details
                        </p>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{ jobData.job_description }}
                        </p>
                        <hr
                            class="my-2 h-px bg-gray-200 border-0 dark:bg-gray-700"
                        />
                        <p class="text-gray-500 dark:text-gray-400">
                            Salary: {{ jobData.job_salary }}
                        </p>
                        <hr
                            class="my-2 h-px bg-gray-200 border-0 dark:bg-gray-700"
                        />
                        <p class="text-gray-500 dark:text-gray-400">
                            Contact Us: {{ jobData.job_email }}
                        </p>

                        <button
                            type="button"
                            @click="SendResume()"
                            class="py-2 float-right px-3 text-xs font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300"
                        >
                            Apply
                        </button>
                        <button
                            type="button"
                            @click="$emit('closeModalView')"
                            class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 float-center mt-10 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        >
                            Close
                        </button>
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
