<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed, provide, inject } from "vue";

import moment from "moment";
import Pagination from "./components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import helpers from "@/helpers.js";

const {
    alertOn,
    alertOnDelete,
    alertOnUpdate,
    alertOnMessage,
    alertOnError,
    onAlert,
} = helpers();

const selected_photo = ref('');
const modal_image = ref(false);

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

const search_data = useForm({
    search: usePage().props.value.search ? usePage().props.value.search : "",
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
            alertOnMessage.value = "Successfully accepted user";
            onAlert("Success");
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
            alertOnMessage.value = "Successfully rejected user";
            onAlert("Error");
        },
    });
};
const search_user = () => {
    search_data.get(route("administrator.notification"));
};
// provide("search", search_data.search);

const function_select_image = (image) => {
    selected_photo.value = image;
    modal_image.value =! modal_image.value
}

const function_close = () => {
    modal_image.value =! modal_image.value
}
</script>
<template>
    <AdminLayout :alertOn="alertOn" :alertOnDelete="alertOnDelete" :alertOnUpdate="alertOnUpdate"
        :alertOnMessage="alertOnMessage" :alertOnError="alertOnError">
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-10 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                        Confirmation List
                    </h1>
                </div>
                <div class="lg:w-full md:w-2/3 mx-auto">
                    <nav class="mb-10 flex justify-end" aria-label="Page navigation example">
                        <label for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input v-model="search_data.search" type="search" id="default-search"
                                class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                placeholder="Search" />
                            <button @click="search_user()" type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                Search
                            </button>
                        </div>
                    </nav>

                    <div class="overflow-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs bg-green-500 text-white uppercase bg-gray-50">
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
                                        Civil Status & sex
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
                                        Type
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Applied at
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Verification photos
                                    </th>

                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(notifications, index) in usePage()
                                    .props.value.notifications.data" :key="index" class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900">
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
                                            <div v-if="notifications.user.course" class="font-normal text-gray-500">
                                                {{
                                                    notifications.user.course
                                                        .abbreviation
                                                }}
                                            </div>
                                            <div v-else-if="!notifications.user.course
                                                    " class="font-normal text-gray-500">
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
                                                <span v-if="notifications.user
                                                    .details
                                                    .civil_status == 1
                                                    ">Single</span>
                                                <span v-else-if="notifications.user
                                                    .details
                                                    .civil_status == 2
                                                    ">Married</span>
                                                <span v-else-if="notifications.user
                                                    .details
                                                    .civil_status == 3
                                                    ">Divorce</span>
                                                <span v-else>None</span>
                                            </div>
                                            <div class="font-normal text-gray-500">
                                                <span v-if="notifications.user
                                                    .details.gender == 1
                                                    ">Male</span>
                                                <span v-else-if="notifications.user
                                                    .details.gender == 2
                                                    ">Female</span>
                                                <span class="text-xs" v-else-if="notifications.user
                                                    .details.gender == 3
                                                    ">Prefer not to say</span>
                                                <span v-else></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        {{
                                            notifications.user.details
                                                .current_work ?? 'None'
                                        }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{
                                            notifications.user.details
                                                .phone_number ?? 'None'
                                        }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{
                                            notifications.user.details.religion ?? 'None'
                                        }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{
                                            notifications.user.details
                                                .year_graduated
                                        }}
                                    </td>


                                    <td class="py-4 px-6">
                                        <span v-if="notifications.user.user_type ==
                                                'alumni'
                                                "
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Alumni</span>
                                        <span v-else-if="notifications.user.user_type ==
                                            'staff_admin'
                                            "
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Staff
                                            Administrator</span>
                                        <span v-else-if="notifications.user.user_type ==
                                            'admin'
                                            "
                                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Super
                                            Administrator</span>
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
                                    <td class="py-6 w-full">
                                        <p v-if="notifications.user.details.photos == null">None</p>
                                        <p v-else>
                                            <template v-for="(photo, key) in notifications.user.details.photos" :key="key">
                                                <p class="flex cursor-pointer" @click="function_select_image(photo)">
                                                    {{ 'Image ' + (key + 1) + ': ' }} <img class="h-10 w-10"
                                                        :src="'./../images/verification/' + photo" alt="">
                                                </p>
                                            </template>
                                        </p>

                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">
                                                <button type="button" @click="
                                                    function_reject_user_staff_admin(
                                                        'reject',
                                                        notifications.id,
                                                        notifications.user
                                                            .id
                                                    )
                                                    "
                                                    class="text-white bg-red-700 mb-1 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
                                                    title="Reject this user">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </button>
                                                <button type="button" @click="
                                                    function_accept_user_staff_admin(
                                                        'approve',
                                                        notifications.id,
                                                        notifications.user
                                                            .id
                                                    )
                                                    "
                                                    class="text-white bg-green-700 mb-1 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
                                                    title="Accept this user">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="px-4 w-100 py-3 flex items-center justify-center border-gray-200 sm:px-6">
                            <Pagination v-bind:links="$page.props.notifications.links" :search="search_data.search" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main modal -->
        
        <div v-if="modal_image == true" class="fixed z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full ml-[30%] mt-[10%]">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900 ">
                                Verification Photo
                            </h3>
                            <button @click="function_close"  type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                data-modal-hide="defaultModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <img class="h-[50%] w-[50%] object-cover mx-auto" :src="'./../images/verification/' + selected_photo" alt="">
                        </div>
                </div>
            </div>
        </div>
</AdminLayout>
</template>
