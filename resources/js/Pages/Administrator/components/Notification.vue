<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed, provide, inject } from "vue";
import route from "../../../../../vendor/tightenco/ziggy/src/js";

import moment from "moment";
import Pagination from "./Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

const trigger = inject("trigger");
const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY");
    }
};
const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};

const search_data = useForm({
    user_search_key: usePage().props.value.user_search_key
        ? usePage().props.value.user_search_key
        : "",
});

const action_data = useForm({
    action: "",
    notification_id: 0,
    user_id: 0,
});

const function_accept_user_staff_admin = (action, notification_id, user_id) => {
    action_data.action = action;
    action_data.notification_id = notification_id;
    action_data.user_id = user_id;
    action_data.post(route("register_action"), {
        preserveScroll: true,
        onSuccess: () => {
            action_data.reset();
            alert("Successfully accepted user");
        },
    });
};

const function_reject_user_staff_admin = (action, notification_id, user_id) => {
    action_data.action = action;
    action_data.notification_id = notification_id;
    action_data.user_id = user_id;
    action_data.post(route("register_action"), {
        preserveScroll: true,
        onSuccess: () => {
            action_data.reset();
            alert("Successfully rejected user");
        },
    });
};
provide("user_search_key", search_data.user_search_key);
</script>
<template>
    <section class="text-gray-600 body-font relative">
        <!-- <div
            v-if="alertadminPromote"
            class="bg-green-100 alertanim text-center py-4 lg:px-4"
        >
            <div
                class="p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert"
            >
                <span
                    class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                    >Notification</span
                >
                <span class="font-semibold mr-2 text-left flex-auto"
                    >User Successfully Promoted to Admin!</span
                >
                <svg
                    class="fill-current opacity-75 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                    />
                </svg>
            </div>
        </div>
        <div
            v-if="alertStaffPromote"
            class="bg-green-100 alertanim text-center py-4 lg:px-4"
        >
            <div
                class="p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert"
            >
                <span
                    class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                    >Notification</span
                >
                <span class="font-semibold mr-2 text-left flex-auto"
                    >User Successfully Promoted to Staff!</span
                >
                <svg
                    class="fill-current opacity-75 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                    />
                </svg>
            </div>
        </div>
        <div
            v-if="alertadminDemote"
            class="bg-gray-100 alertanim text-center py-4 lg:px-4"
        >
            <div
                class="p-2 bg-gray-800 items-center text-gray-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert"
            >
                <span
                    class="flex rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                    >Notification</span
                >
                <span class="font-semibold mr-2 text-left flex-auto"
                    >Admin has been demoted!</span
                >
                <svg
                    class="fill-current opacity-75 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                    />
                </svg>
            </div>
        </div>
        <div
            v-if="alertStaffDemote"
            class="bg-gray-100 text-center py-4 lg:px-4"
        >
            <div
                class="p-2 bg-gray-800 items-center text-gray-100 alertanim leading-none lg:rounded-full flex lg:inline-flex"
                role="alert"
            >
                <span
                    class="flex rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                    >Notice</span
                >
                <span class="font-semibold mr-2 text-left flex-auto"
                    >Staff has been demoted!</span
                >
                <svg
                    class="fill-current opacity-75 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                    />
                </svg>
            </div>
        </div>
        <div v-if="adminAccess" class="bg-gray-100 text-center py-4 lg:px-4">
            <div
                class="p-2 bg-gray-800 items-center text-gray-100 alertanim leading-none lg:rounded-full flex lg:inline-flex"
                role="alert"
            >
                <span
                    class="flex rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                    >Warning</span
                >
                <span class="font-semibold mr-2 text-left flex-auto">{{
                    adminAcccessMsg
                }}</span>
                <svg
                    class="fill-current opacity-75 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                    />
                </svg>
            </div>
        </div> -->

        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1
                    class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                >
                    Confirmation List
                </h1>
            </div>
            <div class="lg:w-full md:w-2/3 mx-auto">
                <nav
                    class="mb-10 flex justify-end"
                    aria-label="Page navigation example"
                >
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300"
                        >Search</label
                    >
                    <div class="relative">
                        <div
                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                ></path>
                            </svg>
                        </div>
                        <input
                            v-model="search_data.user_search_key"
                            type="search"
                            id="default-search"
                            class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search"
                        />
                        <button
                            @click="function_search_user()"
                            type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2"
                        >
                            Search
                        </button>
                    </div>
                </nav>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead
                            class="text-xs bg-green-500 text-white uppercase bg-gray-50"
                        >
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Fullname & Email
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    College & course
                                </th>
                                <th scope="col" class="py-3 px-6">address</th>
                                <th scope="col" class="py-3 px-6">
                                    Civil Status & gender
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Current Work
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Phone number
                                </th>
                                <th scope="col" class="py-3 px-6">Religion</th>
                                <th scope="col" class="py-3 px-6">
                                    Year graduated
                                </th>
                                <th scope="col" class="py-3 px-6">Status</th>
                                <th scope="col" class="py-3 px-6">
                                    Applied at
                                </th>

                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(notifications, index) in usePage().props
                                    .value.notifications.data"
                                :key="index"
                                class="bg-white border-b"
                            >
                                <th
                                    scope="row"
                                    class="py-4 px-6 font-medium text-gray-900"
                                >
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            {{ notifications.user.name }}
                                        </div>
                                        <div class="font-normal text-gray-500">
                                            {{ notifications.user.email }}
                                        </div>
                                    </div>
                                </th>
                                <td class="py-4 px-6">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            {{
                                                notifications.user.college
                                                    .abbreviation
                                            }}
                                        </div>
                                        <div
                                            v-if="notifications.user.course"
                                            class="font-normal text-gray-500"
                                        >
                                            {{
                                                notifications.user.course
                                                    .abbreviation
                                            }}
                                        </div>
                                        <div
                                            v-else-if="
                                                !notifications.user.course
                                            "
                                            class="font-normal text-gray-500"
                                        >
                                            No Course
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    {{ notifications.user.details.address }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            <span
                                                v-if="
                                                    notifications.user.details
                                                        .civil_status == 1
                                                "
                                                >Single</span
                                            >
                                            <span
                                                v-else-if="
                                                    notifications.user.details
                                                        .civil_status == 2
                                                "
                                                >Married</span
                                            >
                                            <span
                                                v-else-if="
                                                    notifications.user.details
                                                        .civil_status == 3
                                                "
                                                >Divorce</span
                                            >
                                        </div>
                                        <div class="font-normal text-gray-500">
                                            <span
                                                v-if="
                                                    notifications.user.details
                                                        .gender == 1
                                                "
                                                >Male</span
                                            >
                                            <span
                                                v-else-if="
                                                    notifications.user.details
                                                        .gender == 2
                                                "
                                                >Female</span
                                            >
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    {{
                                        notifications.user.details.current_work
                                    }}
                                </td>
                                <td class="py-4 px-6">
                                    {{
                                        notifications.user.details.phone_number
                                    }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ notifications.user.details.religion }}
                                </td>
                                <td class="py-4 px-6">
                                    {{
                                        notifications.user.details
                                            .year_graduated
                                    }}
                                </td>

                                <td class="py-4 px-6">
                                    <span
                                        v-if="
                                            notifications.user.user_type ==
                                            'alumni'
                                        "
                                        class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                        >Alumni</span
                                    >
                                    <span
                                        v-else-if="
                                            notifications.user.user_type ==
                                            'staff_admin'
                                        "
                                        class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                        >Staff Administrator</span
                                    >
                                    <span
                                        v-else-if="
                                            notifications.user.user_type ==
                                            'admin'
                                        "
                                        class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                        >Super Administrator</span
                                    >
                                </td>
                                <td class="py-4 px-6 w-full">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            {{
                                                date_conversion(
                                                    notifications.user
                                                        .created_at
                                                )
                                            }}
                                        </div>
                                        <div class="font-normal text-gray-500">
                                            {{
                                                date_conversion_from_now(
                                                    notifications.user
                                                        .created_at
                                                )
                                            }}
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            <button
                                                type="button"
                                                @click="
                                                    function_accept_user_staff_admin(
                                                        'reject',
                                                        notifications.id,
                                                        notifications.user.id
                                                    )
                                                "
                                                class="text-white bg-red-700 mb-1 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
                                                title="Reject this user"
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
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                </svg>
                                            </button>
                                            <button
                                                type="button"
                                                @click="
                                                    function_accept_user_staff_admin(
                                                        'approve',
                                                        notifications.id,
                                                        notifications.user.id
                                                    )
                                                "
                                                class="text-white bg-green-700 mb-1 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
                                                title="Accept this user"
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
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        class="px-4 w-100 py-3 flex items-center justify-center border-gray-200 sm:px-6"
                    >
                        <Pagination v-bind:links="$page.props.events.links" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
