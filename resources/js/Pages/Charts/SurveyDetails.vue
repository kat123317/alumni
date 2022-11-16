<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

import moment from "moment";
</script>

<template>
    <AppLayout title="survey_charts">
        <section class="bg-white dark:bg-gray-900">
            <div class="container px-6 py-10 mx-auto">
                <h1
                    class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white"
                >
                    Survey Charts
                </h1>

                <p class="mt-4 text-gray-500 xl:mt-6 dark:text-gray-300">
                    Survey Reports
                    {{ usePage().props.value.records_count }} person who answer
                    this survey
                </p>

                <div
                    class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3"
                >
                    <div
                        v-for="(chart, key) in usePage().props.value.charts"
                        :key="key"
                        class="p-8 space-y-3 border-2 border-green-400 dark:border-green-300 rounded-xl"
                    >
                        <span
                            class="inline-block flex text-green-500 dark:text-green-400"
                        >
                            Question {{ key + 1 }}
                        </span>

                        <h1
                            class="text-2xl font-semibold text-gray-700 capitalize dark:text-white"
                        >
                            {{ chart.instructions }}
                        </h1>

                        <pie-chart :data="chart.data"></pie-chart>
                        <ul
                            class="mb-8 space-y-4 text-left text-gray-500 dark:text-gray-400"
                        >
                            <li
                                v-for="(answer, key2) in chart.data"
                                :key="key2"
                                class="flex items-center space-x-3"
                            >
                                <!-- Icon -->

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>

                                <span>
                                    {{ answer[0] }}:
                                    <span class="decoration-sky-500">{{
                                        answer[1]
                                    }}</span></span
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
