<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed, provide, inject } from "vue";

import moment from "moment";
import Pagination from "./components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

const alertadminPromote = ref(false);
const alertStaffPromote = ref(false);
const alertadminDemote = ref(false);
const alertStaffDemote = ref(false);
const adminAcccess = ref(false);
const adminAcccessMsg = ref("");

const onAlert = (data, message) => {
    if (data == "adminPromote") {
        alertadminPromote.value = true;
    } else if (data == "staffPromote") {
        alertStaffPromote.value = true;
    } else if (data == "adminDemote") {
        alertadminDemote.value = true;
    } else if (data == "staffDemote") {
        alertStaffDemote.value = true;
    } else {
        adminAcccess.value = true;
    }

    setTimeout(() => {
        if (data == "adminPromote") {
            alertadminPromote.value = false;
        } else if (data == "staffPromote") {
            alertStaffPromote.value = false;
        } else if (data == "adminDemote") {
            alertadminDemote.value = false;
        } else if (data == "staffDemote") {
            alertStaffDemote.value = false;
        } else {
            adminAcccess.value = false;
        }
    }, 4000);
};

// const trigger = inject("trigger");
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

const deactivate_data = useForm({
    id: "",
});

const add_staff_admin_data = useForm({
    id: "",
});

const remove_staff_admin_data = useForm({
    id: "",
});

const activate_data = useForm({
    id: "",
});

const search_data = useForm({
    search: usePage().props.value.search ? usePage().props.value.search : "",
});

const deactivate_user = (id, type) => {
    if (id == usePage().props.value.user.id) {
        // alert('Cannot deactivate your account')
        onAlert("staffAccess", "Cannot deactivate your account");
    } else if (
        usePage().props.value.user.user_type == "staff_admin" &&
        type == "admin"
    ) {
        onAlert(
            "staffAccess",
            "Only super admin have the previledge to deactivate and activate account"
        );
    } else {
        deactivate_data.id = id;
        deactivate_data.put(route("deactivate_user", [deactivate_data.id]), {
            preserveScroll: true,
            onSuccess: () => {
                // onAlert('Delete')
                onAlert("staffDemote");
            },
        });
    }
};

const activate_user = (id) => {
    activate_data.id = id;
    activate_data.put(route("activate_user", [activate_data.id]), {
        preserveScroll: true,
        onSuccess: () => {
            // onAlert('Delete')
            onAlert("staffPromote");
        },
    });
};

const function_assign_as_admin = (id) => {
    add_staff_admin_data.id = id;
    add_staff_admin_data.put(
        route("assign_as_admin", [add_staff_admin_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                // onAlert('Delete')
                onAlert("adminPromote");
            },
        }
    );
};

const function_remove_as_admin = (id) => {
    remove_staff_admin_data.id = id;
    remove_staff_admin_data.put(
        route("remove_as_admin", [remove_staff_admin_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                // onAlert('Delete')
                onAlert("adminDemote");
            },
        }
    );
};

const function_search_user = () => {
    search_data.get(route("administrator.user_management"), {
        preserveScroll: true,
        onSuccess: () => {},
    });
};

// provide("user_search_key", search_data.user_search_key);
</script>
<template>
    <AdminLayout>
        <section class="text-gray-600 body-font relative">
            <div
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
            <div
                v-if="adminAccess"
                class="bg-gray-100 text-center py-4 lg:px-4"
            >
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
            </div>

            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        User Management
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
                                v-model="search_data.search"
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

                    <div
                        class="overflow-x-auto relative shadow-md sm:rounded-lg"
                    >
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
                                    <th scope="col" class="py-3 px-6">
                                        address
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Civil Status & gender
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Current Work
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Phone number
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Religion
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Year graduated
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status
                                    </th>
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
                                    v-for="(users, index) in usePage().props
                                        .value.users.data"
                                    :key="index"
                                    class="bg-white border-b"
                                >
                                    <th
                                        scope="row"
                                        class="py-4 px-6 font-medium text-gray-900"
                                    >
                                        <div class="pl-3">
                                            <img
                                                class="w-10 h-10 rounded-full"
                                                :src="users.profile_photo_url"
                                                alt="Jese image"
                                            />
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                {{ users.name }}
                                            </div>
                                            <div
                                                class="font-normal text-gray-500"
                                            >
                                                {{ users.email }}
                                            </div>
                                        </div>
                                    </th>
                                    <td class="py-4 px-6">
                                        <div class="pl-3">
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                {{ users.college.abbreviation }}
                                            </div>
                                            <div
                                                v-if="users.course"
                                                class="font-normal text-gray-500"
                                            >
                                                {{ users.course.abbreviation }}
                                            </div>
                                            <div
                                                v-else-if="!users.course"
                                                class="font-normal text-gray-500"
                                            >
                                                No Course
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ users.details.address }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="pl-3">
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                <span
                                                    v-if="
                                                        users.details
                                                            .civil_status == 1
                                                    "
                                                    >Single</span
                                                >
                                                <span
                                                    v-else-if="
                                                        users.details
                                                            .civil_status == 2
                                                    "
                                                    >Married</span
                                                >
                                                <span
                                                    v-else-if="
                                                        users.details
                                                            .civil_status == 3
                                                    "
                                                    >Divorce</span
                                                >
                                            </div>
                                            <div
                                                class="font-normal text-gray-500"
                                            >
                                                <span
                                                    v-if="
                                                        users.details.gender ==
                                                        1
                                                    "
                                                    >Male</span
                                                >
                                                <span
                                                    v-else-if="
                                                        users.details.gender ==
                                                        2
                                                    "
                                                    >Female</span
                                                >
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ users.details.current_work }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ users.details.phone_number }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ users.details.religion }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ users.details.year_graduated }}
                                    </td>

                                    <td class="py-4 px-6">
                                        <span
                                            v-if="users.user_type == 'alumni'"
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                            >Alumni</span
                                        >
                                        <span
                                            v-else-if="
                                                users.user_type == 'staff_admin'
                                            "
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                            >Staff Administrator</span
                                        >
                                        <span
                                            v-else-if="
                                                users.user_type == 'admin'
                                            "
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                            >Super Administrator</span
                                        >
                                    </td>
                                    <td class="py-4 px-6 w-full">
                                        <div class="pl-3">
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                {{
                                                    date_conversion(
                                                        users.created_at
                                                    )
                                                }}
                                            </div>
                                            <div
                                                class="font-normal text-gray-500"
                                            >
                                                {{
                                                    date_conversion_from_now(
                                                        users.created_at
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="pl-3">
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                <button
                                                    type="button"
                                                    v-if="
                                                        users.user_type ==
                                                        'staff_admin'
                                                    "
                                                    @click="
                                                        function_remove_as_admin(
                                                            users.id
                                                        )
                                                    "
                                                    class="text-white bg-red-700 mb-1 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
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
                                                    v-else-if="
                                                        users.user_type ==
                                                        'alumni'
                                                    "
                                                    @click="
                                                        function_assign_as_admin(
                                                            users.id
                                                        )
                                                    "
                                                    class="text-white bg-blue-700 mb-1 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                <button
                                                    type="button"
                                                    v-if="
                                                        users.is_active == 1 &&
                                                        users.user_type !=
                                                            'admin'
                                                    "
                                                    @click="
                                                        deactivate_user(
                                                            users.id,
                                                            users.user_type
                                                        )
                                                    "
                                                    class="text-white bg-red-700 mb-1 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
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
                                                            d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"
                                                        />
                                                    </svg>
                                                </button>

                                                <button
                                                    type="button"
                                                    v-else-if="
                                                        users.is_active == 0
                                                    "
                                                    @click="
                                                        activate_user(users.id)
                                                    "
                                                    class="text-white bg-blue-700 mb-1 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                                                            d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"
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
                            <Pagination
                                v-bind:links="$page.props.users.links"
                                :search="search_data.search"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>
