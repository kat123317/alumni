<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};
const option_view = ref(true);

const chart_total_array = computed(() => {
    let chart_array = [];
    let count_registered_user = 0;

    for (let i = 0; i < usePage().props.value.colleges.length; i++) {
        usePage().props.value.colleges[i].users.forEach((users) => {
            if (users.status == "approved") {
                count_registered_user += 1;
            }
        });
        chart_array.push([
            usePage().props.value.colleges[i].name,
            count_registered_user,
        ]);
        count_registered_user = 0;
    }
    return chart_array;
});

const chart_colleges_array = computed(() => {
    let chart_array = {};
    for (let i = 0; i < usePage().props.value.colleges.length; i++) {
        let pie_data = [];

        usePage().props.value.colleges[i].courses.forEach((course) => {
            let count_registered_user = 0;
            course.users.forEach((users) => {
                if (users.status == "approved") {
                    count_registered_user += 1;
                }
            });
            pie_data.push([course.abbreviation, count_registered_user]);
            count_registered_user = 0;
        });
        let key = usePage().props.value.colleges[i].abbreviation;
        chart_array[key] = pie_data;
    }
    return chart_array;
});

const search_graduates_year = useForm({
    from: usePage().props.value.from ? usePage().props.value.from : "",
    to: usePage().props.value.to ? usePage().props.value.to : "",
});

const chart_graduates_bar = computed(() => {
    let chart_array = [];
    for (let i = 0; i < usePage().props.value.yearbook.length; i++) {
        chart_array.push([
            usePage().props.value.yearbook[i].schoolyear_from +
                " - " +
                usePage().props.value.yearbook[i].schoolyear_to,
            usePage().props.value.yearbook[i].graduates_count,
        ]);
    }
    return chart_array;
});

const function_search_between = () => {
    search_graduates_year.get(route("charts"), {
        preserveScroll: true,
    });
};

onMounted(() => {
    // const ramUsage = window.performance.memory;
    // console.log("=-----------RAM----------= ", ramUsage)
});

const form_announcement = useForm({
    search_text:
        usePage().props.value.search_text != null
            ? usePage().props.value.search_text
            : null,
});

const search_announcement = () => {
    form_announcement.get(route("dashboard"));
    // alert(form_announcement.text_search)
};

const total_users_model = ref("0");

const total_users_line = ref(false);
const total_users_pie = ref(true);
const total_users = () => {
    if (total_users_model.value == 1) {
        total_users_pie.value = true;
        total_users_line.value = false;
    } else if (total_users_model.value == 2) {
        total_users_pie.value = false;
        total_users_line.value = true;
    }
};
</script>

<template>
    <AppLayout title="Chart">
        <!-- component -->

        <div class="mb-6 lg:w-[100%] xl:w-[100%] 2xl:w-[100%]">
            <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
                <div
                    class="px-6 flex items-center justify-between space-x-4 2xl:container"
                >
                    <h5
                        hidden
                        class="text-2xl text-gray-600 font-medium lg:block"
                    >
                        Charts
                    </h5>
                </div>
            </div>

            <div class="px-6 w-full pt-6 px-[3vmin]">
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        class="md:col-span-2 lg:col-span-1"
                        v-for="(colleges, key) in usePage().props.value
                            .colleges"
                        :key="key"
                    >
                        <div
                            class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white"
                        >
                            <!-- <pie-chart  :data="chart_colleges_array[colleges.abbreviation]" legend="left" :donut="false"></pie-chart> -->
                            <div>
                                <h5 class="text-xl text-gray-600 text-center">
                                    {{ colleges.abbreviation }}
                                </h5>
                                <div class="mt-2 flex justify-center gap-4">
                                    <!-- <h3 class="text-3xl font-bold text-gray-700">{{ colleges.courses.length }}</h3> -->
                                    <div
                                        class="flex items-end gap-1 text-green-500"
                                    >
                                        <svg
                                            class="w-3"
                                            viewBox="0 0 12 15"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z"
                                                fill="currentColor"
                                            />
                                        </svg>
                                        <span
                                            >{{ colleges.courses.length }}
                                        </span>
                                    </div>
                                </div>
                                <span class="block text-center text-gray-500">
                                    College of {{ colleges.name }}</span
                                >
                            </div>
                            <pie-chart
                                class="w-[20vmin]"
                                :data="
                                    chart_colleges_array[colleges.abbreviation]
                                "
                                legend="left"
                                :donut="true"
                            ></pie-chart>
                        </div>
                    </div>
                </div>
            </div>
            <select
                class="mb-2 mt-10 ml-5 block p-2 px-[4vmin] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-lg focus:ring-green-500 focus:border-green-500"
                v-model="total_users_model"
                @change="total_users(total_users_model)"
            >
                <option value="0" disabled>Select Charts</option>
                <option value="1">Pie Chart</option>
                <option value="2">Line Chart</option>
            </select>
            <div v-if="total_users_pie" class="mb-5 p-5">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p
                                        class="mb-0 font-sans font-semibold leading-normal uppercase text-lg"
                                    >
                                        TOTAL Users by colleges:
                                        <span class="mb-2 font-bold text-md">{{
                                            usePage().props.value.users.length
                                        }}</span>
                                        user/users
                                    </p>
                                </div>
                            </div>

                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 rounded-circle bg-gradient-to-tl from-green-500 to-green-500"
                                >
                                    <svg
                                        class="w-6 h-6 m-auto my-2 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-left w-auto bg-gray-50">
                            <pie-chart
                                :data="chart_total_array"
                                legend="bottom"
                                :donut="false"
                            ></pie-chart>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="total_users_line" class="mb-5 p-5">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p
                                        class="mb-0 font-sans font-semibold leading-normal uppercase text-lg"
                                    >
                                        Users in line graph:
                                        <span class="mb-2 font-bold text-md">{{
                                            usePage().props.value.users.length
                                        }}</span>
                                        user/users
                                    </p>
                                </div>
                            </div>

                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 rounded-circle bg-gradient-to-tl from-green-500 to-green-500"
                                >
                                    <svg
                                        class="w-6 h-6 m-auto my-2 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-left w-auto bg-gray-50">
                            <line-chart
                                :data="chart_total_array"
                                legend="bottom"
                                :donut="false"
                            ></line-chart>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 p-5">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border h-[50%]"
                >
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p
                                        class="mb-0 font-sans font-semibold leading-normal uppercase text-lg"
                                    >
                                        Graduates
                                    </p>
                                </div>

                                <div class="flex my-5">
                                    <select
                                        @change="function_search_between()"
                                        v-model="search_graduates_year.from"
                                        name=""
                                        id=""
                                        class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block pl-10 pr-10 p-2.5"
                                    >
                                        <option
                                            v-for="(yearbook, key) in usePage()
                                                .props.value.yearbooks"
                                            :key="key"
                                            :value="yearbook.id"
                                        >
                                            {{
                                                yearbook.schoolyear_from +
                                                " - " +
                                                yearbook.schoolyear_to
                                            }}
                                        </option>
                                    </select>
                                    <select
                                        @change="function_search_between()"
                                        v-model="search_graduates_year.to"
                                        name=""
                                        id=""
                                        class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block pl-2 pr-10 p-2.5"
                                    >
                                        <option
                                            v-for="(yearbook, key) in usePage()
                                                .props.value.yearbooks"
                                            :key="key"
                                            :value="yearbook.id"
                                        >
                                            {{
                                                yearbook.schoolyear_from +
                                                " - " +
                                                yearbook.schoolyear_to
                                            }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 rounded-circle bg-gradient-to-tl from-green-500 to-green-500"
                                >
                                    <svg
                                        class="w-6 h-6 m-auto my-2 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M12 14l9-5-9-5-9 5 9 5z"
                                        ></path>
                                        <path
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                                        ></path>
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-left w-auto bg-gray-50">
                            <column-chart
                                :data="chart_graduates_bar"
                            ></column-chart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
