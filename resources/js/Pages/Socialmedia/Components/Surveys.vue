<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./emptypost.vue";
import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};
const date_conversion2 = (value) => {
    if (value) {
        return moment(value).format("h:mm:ss");
    }
};
</script>

<template>
    <AppLayout title="UserSurveys">
        <!-- component -->

        <h2 class="flex flex-row flex-nowrap items-center my-8">
            <span class="flex-grow block border-t border-green-700" aria-hidden="true" role="presentation"></span>
            <span
                class="flex-none block mx-4 px-4 py-2.5 text-xs leading-none font-medium uppercase bg-green-700 rounded-lg text-white">
                Your Surveys
            </span>
            <span class="flex-grow block border-t border-green-700" aria-hidden="true" role="presentation"></span>
        </h2>
        <div class="w-full px-2 lg:px-10 grid grid-cols-1 gap-10 lg:grid-cols-4 ">
            <div v v-for="items in 10" class="w-full max-w-sm px-4 py-3 border-b-4 border-green-400 bg-white rounded-md shadow-md ">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-gray-800">Survey Title</span>
                    <span class="px-3 py-1 text-xs text-white uppercase bg-green-800 rounded-full">Survey</span>
                </div>

                <div>
                    <h1 class="mt-2 text-lg font-semibold text-gray-800 ">Items: 100</h1>

                    <div class="grid grid-cols-2 mb-5">
                        <div>
                            <p class="mt-2 text-md text-gray-600 ">Percentage taken: 100%</p>
                            <p class="mt-2 text-md text-gray-600 ">Status: Finished</p>
                            <p class="mt-2 text-md text-gray-600 ">created_at</p>
                            <p class="mt-2 text-md text-gray-600 ">updated_at</p>
                            <p class="mt-2 text-md text-gray-600 ">retake / take</p>
                        </div>
                        <a class="inline-block mr-4" href="#">
                            <img class=" max-w-none w-full rounded-lg" src="https://iserp.columbia.edu/sites/default/files/Data%20Analysis%20Graphic.png" />
                        </a>
                    </div>
                </div>

                <button
                    class="px-6 float-right py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-green-800 rounded-md hover:bg-green-500 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-80">
                    Retake / Take
                </button>
            </div>
        </div>
    </AppLayout>
</template>

<style>

</style>
