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
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
            <span
                class="flex-none block mx-4 px-4 py-2.5 text-xs leading-none font-medium uppercase bg-green-700 rounded-lg text-white"
            >
                Your Surveys
            </span>
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
        </h2>
        <div class="w-full px-2 lg:px-10 grid grid-cols-1 lg:grid-cols-3 gap-3">
            <article class="mb-4 w-full break-inside p-6 rounded-xl bg-white">
                <div class="flex pb-6 items-center justify-between">
                    <div class="flex">
                        <a class="inline-block mr-4" href="#">
                            <img class="rounded-full max-w-none w-12 h-12" />
                        </a>
                        <div class="flex flex-col">
                            <div>
                                <a class="inline-block text-lg font-bold">
                                    Survey Title</a
                                >
                            </div>
                            <div class="text-slate-500">Items: 100</div>
                        </div>
                    </div>

                    <em>Percentage taken: 100%</em>
                    <em>Status: Finished</em>
                    <em>created_at</em>
                    <em>updated_at</em>
                    <em>retake / take</em>
                </div>
            </article>
        </div>
    </AppLayout>
</template>

<style></style>
