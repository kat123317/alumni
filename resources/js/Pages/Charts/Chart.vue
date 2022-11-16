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

const tabType = ref(2);

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
    tab: usePage().props.value.tab,
});

const tab_index = useForm({
    tab: usePage().props.value.tab,
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

const changeTab = (data) => {
    tab_index.tab = data;
    tab_index.get(route("charts"), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout title="Chart">
        <!-- component -->
        <section class="bg-gray-900 min-h-screen">
            <div class="container px-6 py-12 mx-auto">
                <h1 class="text-2xl font-semibold lg:text-4xl text-white">
                    Charts and Reports
                </h1>

                <div class="mt-8 xl:mt-16 lg:flex lg:-mx-12">
                    <div class="lg:mx-12">
                        <h1 class="text-xl font-semibold text-white">
                            Available Charts
                        </h1>

                        <div class="mt-4 space-y-4 lg:mt-8">
                            <a
                                @click="changeTab(1)"
                                :class="[
                                    route().params.tab == 1
                                        ? 'text-blue-500 block cursor-pointer'
                                        : 'text-white block cursor-pointer',
                                ]"
                                >Colleges</a
                            >

                            <a
                                @click="changeTab(2)"
                                :class="[
                                    route().params.tab == 2
                                        ? 'text-blue-500 block cursor-pointer'
                                        : 'text-white block cursor-pointer',
                                ]"
                                >Users</a
                            >
                            <a
                                @click="changeTab(3)"
                                :class="[
                                    route().params.tab == 3
                                        ? 'text-blue-500 block cursor-pointer'
                                        : 'text-white block cursor-pointer',
                                ]"
                                >Graduates</a
                            >
                            <a
                                @click="changeTab(4)"
                                :class="[
                                    route().params.tab == 4
                                        ? 'text-blue-500 block cursor-pointer'
                                        : 'text-white block cursor-pointer',
                                ]"
                                >Surveys</a
                            >
                        </div>
                    </div>

                    <div class="flex-1 mt-8 lg:mt-0">
                        <div v-if="!route().params.tab">
                            <div
                                class="flex w-full flex-col justify-center items-center bg-white rounded-lg min-h-[30vmin]"
                            >
                                <h1 class="text-6xl text-gray-700 text-center">
                                    Charts and Reports
                                </h1>
                                <h1
                                    class="text-sml shake-horizontal flex mt-6 text-black-800 text-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="block sm:hidden w-6 h-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75"
                                        />
                                    </svg>

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="hidden lg:block w-6 h-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                                        />
                                    </svg>
                                    Select to show reports
                                </h1>
                            </div>
                        </div>
                        <div
                            v-if="route().params.tab == 1"
                            class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3"
                        >
                            <div
                                class="md:col-span-2 lg:col-span-1"
                                v-for="(colleges, key) in usePage().props.value
                                    .colleges"
                                :key="key"
                            >
                                <div
                                    class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white"
                                >
                                    <div>
                                        <h5
                                            class="text-xl text-gray-600 text-center"
                                        >
                                            {{ colleges.abbreviation }}
                                        </h5>
                                        <div
                                            class="mt-2 flex justify-center gap-4"
                                        >
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
                                                    >{{
                                                        colleges.courses.length
                                                    }}
                                                </span>
                                            </div>
                                        </div>
                                        <span
                                            class="block text-center text-gray-500"
                                        >
                                            College of {{ colleges.name }}</span
                                        >
                                    </div>
                                    <pie-chart
                                        class="w-[20vmin]"
                                        :data="
                                            chart_colleges_array[
                                                colleges.abbreviation
                                            ]
                                        "
                                        legend="left"
                                        :donut="true"
                                    ></pie-chart>
                                </div>
                            </div>
                        </div>

                        <div v-if="route().params.tab == 2">
                            <select
                                class="mb-2 ml-5 block p-2 px-[4vmin] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-lg focus:ring-green-500 focus:border-green-500"
                                v-model="total_users_model"
                                @change="total_users(total_users_model)"
                            >
                                <option value="0" disabled>
                                    Select Charts
                                </option>
                                <option value="1">Pie Chart</option>
                                <option value="2">Line Chart</option>
                            </select>
                        </div>

                        <div
                            v-if="route().params.tab == 2"
                            class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-1"
                        >
                            <div v-if="total_users_pie" class="mb-5 p-5">
                                <div
                                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border"
                                >
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-row -mx-3">
                                            <div
                                                class="flex-none w-2/3 max-w-full px-3"
                                            >
                                                <div>
                                                    <p
                                                        class="mb-0 font-sans font-semibold leading-normal uppercase text-lg"
                                                    >
                                                        TOTAL Users by colleges:
                                                        <span
                                                            class="mb-2 font-bold text-md"
                                                            >{{
                                                                usePage().props
                                                                    .value.users
                                                                    .length
                                                            }}</span
                                                        >
                                                        user/users
                                                    </p>
                                                </div>
                                            </div>

                                            <div
                                                class="px-3 text-right basis-1/3"
                                            >
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

                                        <div
                                            class="flex justify-left w-auto bg-gray-50"
                                        >
                                            <pie-chart
                                                :data="chart_total_array"
                                                legend="bottom"
                                                :donut="false"
                                            >
                                            </pie-chart>
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
                                            <div
                                                class="flex-none w-2/3 max-w-full px-3"
                                            >
                                                <div>
                                                    <p
                                                        class="mb-0 font-sans font-semibold leading-normal uppercase text-lg"
                                                    >
                                                        Users in line graph:
                                                        <span
                                                            class="mb-2 font-bold text-md"
                                                            >{{
                                                                usePage().props
                                                                    .value.users
                                                                    .length
                                                            }}</span
                                                        >
                                                        user/users
                                                    </p>
                                                </div>
                                            </div>

                                            <div
                                                class="px-3 text-right basis-1/3"
                                            >
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

                                        <div
                                            class="flex justify-left w-auto bg-gray-50"
                                        >
                                            <line-chart
                                                :data="chart_total_array"
                                                legend="bottom"
                                                :donut="false"
                                            >
                                            </line-chart>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="route().params.tab == 3" class="flex mb-5">
                            <select
                                @change="function_search_between()"
                                v-model="search_graduates_year.from"
                                name=""
                                id=""
                                class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block pl-10 pr-10 p-2.5"
                            >
                                <option
                                    v-for="(yearbook, key) in usePage().props
                                        .value.yearbooks"
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
                                    v-for="(yearbook, key) in usePage().props
                                        .value.yearbooks"
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
                        <div
                            v-if="route().params.tab == 3"
                            class="flex justify-left w-auto bg-gray-50"
                        >
                            <column-chart
                                :data="chart_graduates_bar"
                            ></column-chart>
                        </div>

                        <div
                            v-if="route().params.tab == 4"
                            class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3"
                        >
                            <div
                                v-for="(surveys, key) in usePage().props.value
                                    .surveys"
                                :key="key"
                                class="flex max-w-md overflow-hidden bg-white rounded-lg shadow-lg"
                            >
                                <div
                                    class="w-1/3 bg-cover"
                                    style="
                                        background-image: url('http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png');
                                    "
                                ></div>

                                <div class="w-2/3 p-4 md:p-4">
                                    <h1
                                        class="text-2xl font-bold text-gray-800"
                                    >
                                        {{ surveys.name }}
                                    </h1>
                                    <p
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-400"
                                    >
                                        Status: {{ surveys.status }}
                                    </p>
                                    <p
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-400"
                                    >
                                        Survey to:
                                        {{ surveys.setup.shown_only }}
                                    </p>
                                    <p
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-400"
                                    >
                                        Completes: 200
                                    </p>
                                    <p
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-400"
                                    >
                                        Created by: {{ surveys.user.name }}
                                    </p>
                                    <p
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-400"
                                    >
                                        Created Created at:
                                        {{
                                            date_conversion(surveys.created_at)
                                        }}
                                    </p>
                                    <p
                                        class="mt-2 text-sm text-gray-600 dark:text-gray-400"
                                    >
                                        Created Updated at:
                                        {{
                                            date_conversion(surveys.updated_at)
                                        }}
                                    </p>
                                    <div
                                        class="flex justify-between mt-3 item-center"
                                    >
                                        <a
                                            :href="
                                                route('survey_charts', {
                                                    survey_id: surveys.id,
                                                })
                                            "
                                            class="px-2 py-1 text-xs font-bold text-white uppercase transition-colors duration-300 transform bg-green-800 rounded dhover:bg-gray-700 focus:outline-none focus:bg-gray-700"
                                        >
                                            View Charts
                                        </a>
                                    </div>
                                    <div
                                        class="flex justify-between mt-3 item-center"
                                        v-if="
                                            usePage().props.value.user
                                                .user_type == 'admin' ||
                                            usePage().props.value.user
                                                .user_type == 'staff_admin'
                                        "
                                    >
                                        <button
                                            class="px-2 py-1 text-xs font-bold text-white uppercase transition-colors duration-300 transform bg-green-800 rounded dhover:bg-gray-700 focus:outline-none focus:bg-gray-700"
                                        >
                                            Download CSV
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.shake-horizontal {
    -webkit-animation: shake-horizontal 4s
        cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite both;
    animation: shake-horizontal 4s cubic-bezier(0.455, 0.03, 0.515, 0.955)
        infinite both;
}

@-webkit-keyframes shake-horizontal {
    0%,
    100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }

    10%,
    30%,
    50%,
    70% {
        -webkit-transform: translateX(-10px);
        transform: translateX(-10px);
    }

    20%,
    40%,
    60% {
        -webkit-transform: translateX(10px);
        transform: translateX(10px);
    }

    80% {
        -webkit-transform: translateX(8px);
        transform: translateX(8px);
    }

    90% {
        -webkit-transform: translateX(-8px);
        transform: translateX(-8px);
    }
}

@keyframes shake-horizontal {
    0%,
    100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }

    10%,
    30%,
    50%,
    70% {
        -webkit-transform: translateX(-10px);
        transform: translateX(-10px);
    }

    20%,
    40%,
    60% {
        -webkit-transform: translateX(10px);
        transform: translateX(10px);
    }

    80% {
        -webkit-transform: translateX(8px);
        transform: translateX(8px);
    }

    90% {
        -webkit-transform: translateX(-8px);
        transform: translateX(-8px);
    }
}
</style>
