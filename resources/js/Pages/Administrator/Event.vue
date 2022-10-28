<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed, inject, provide } from "vue";

import moment from "moment";
import Pagination from "./components/Pagination.vue";

// const trigger = inject("trigger");

const event_search = useForm({
    search: usePage().props.value.search ? usePage().props.value.search : "",
});

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

const modal_update = ref(false);
const modal_delete = ref(false);
const alertOn = ref(false);
const alertOnUpdate = ref(false);
const alertOnDelete = ref(false);
const alertOnError = ref(false);

const from_date = ref(usePage().props.value.from_date);
const to_date = ref(usePage().props.value.to_date);

const from_date_update = ref();
const to_date_update = ref();

const event_data = useForm({
    from: "",
    to: "",
    title: "",
    content: "",
});

const update_event_data = useForm({
    from: "",
    to: "",
    title: "",
    content: "",
    id: "",
});

const delete_event_data = useForm({
    id: "",
});
const onAlert = (data) => {
    if (data == "Success") {
        alertOn.value = true;
    } else if (data == "Update") {
        alertOnUpdate.value = true;
    } else if (data == "Delete") {
        alertOnDelete.value = true;
    } else {
        alertOnError.value = true;
    }

    setTimeout(() => {
        if (data == "Success") {
            alertOn.value = false;
        } else if (data == "Update") {
            alertOnUpdate.value = false;
        } else if (data == "Delete") {
            alertOnDelete.value = false;
        } else {
            alertOnError.value = false;
        }
    }, 4000);
};

const function_submit = () => {
    event_data.from = from_date.value;
    event_data.to = to_date.value;
    if (event_data.title == "" || event_data.content == "") {
        onAlert("other");
    } else {
        event_data.post(route("events.store"), {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Success");
                event_data.reset();
            },
        });
    }
};

const function_open_update_modal = (title, content, from, to, id) => {
    from_date_update.value = moment(from).format("YYYY-MM-DD");
    to_date_update.value = moment(to).format("YYYY-MM-DD");
    update_event_data.title = title;
    update_event_data.content = content;
    update_event_data.id = id;
    modal_update.value = !modal_update.value;
};

const function_update_event = () => {
    update_event_data.from = from_date_update.value;
    update_event_data.to = to_date_update.value;
    if (update_event_data.title == "" || update_event_data.content == "") {
        alert("Please fill out all fields");
    } else {
        update_event_data.put(route("events.update", [update_event_data.id]), {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Update");
                modal_update.value = !modal_update.value;
            },
        });
    }
};

const function_open_delete_modal = (id) => {
    delete_event_data.id = id;
    modal_delete.value = !modal_delete.value;
};

const function_delete_event = () => {
    delete_event_data.delete(route("events.delete", [delete_event_data.id]), {
        preserveScroll: true,
        onSuccess: () => {
            onAlert("Delete");
            modal_delete.value = !modal_delete.value;
        },
    });
};

const searchEvents = () => {
    event_search.get(route("administrator.event"));
};

// provide("event_search_key", event_search.event_search_key);
</script>
<template>
    <AdminLayout>
        <section class="text-gray-600 body-font relative">
            <div
                v-if="alertOn"
                class="bg-green-100 alertanim text-center py-4 lg:px-4"
            >
                <div
                    class="p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span
                        class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                        >Success</span
                    >
                    <span class="font-semibold mr-2 text-left flex-auto"
                        >Event Successfully added</span
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
                v-if="alertOnUpdate"
                class="bg-blue-100 alertanim text-center py-4 lg:px-4"
            >
                <div
                    class="p-2 bg-blue-800 items-center text-blue-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span
                        class="flex rounded-full bg-blue-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                        >Success</span
                    >
                    <span class="font-semibold mr-2 text-left flex-auto"
                        >Event Successfully updated</span
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
                v-if="alertOnDelete"
                class="bg-red-100 alertanim text-center py-4 lg:px-4"
            >
                <div
                    class="p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span
                        class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                        >Success</span
                    >
                    <span class="font-semibold mr-2 text-left flex-auto"
                        >Event Successfully deleted</span
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
                v-if="alertOnError"
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
                        >Fill Empty fields</span
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
            <div class="container  max-w-7xl  px-5 mt-[12vmin] py-2 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        Add Events
                    </h1>
                </div>
                <div class="lg:w-full md:w-full mx-auto">
                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label
                                    for="name"
                                    class="leading-7 text-sm text-gray-600"
                                    >From</label
                                >
                                <input
                                    v-model="from_date"
                                    type="date"
                                    id="name"
                                    name="name"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                />
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label
                                    for="name"
                                    class="leading-7 text-sm text-gray-600"
                                    >To</label
                                >
                                <input
                                    v-model="to_date"
                                    type="date"
                                    id="name"
                                    name="name"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                />
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label
                                    for="title"
                                    class="leading-7 text-sm text-gray-600"
                                    >Title of Event</label
                                >
                                <input
                                    v-model="event_data.title"
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    required
                                />
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label
                                    for="content"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                    >Your content</label
                                >
                                <textarea
                                    v-model="event_data.content"
                                    id="content"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Your content..."
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <div class="p-2 w-full">
                            <button
                                @click="function_submit()"
                                class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                            >
                                Post
                            </button>
                        </div>
                        <div
                            class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center"
                        >
                            <div
                                class="overflow-x-auto relative shadow-md sm:rounded-lg"
                            >
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
                                            v-model="event_search.search"
                                            type="search"
                                            id="default-search"
                                            class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                            placeholder="Search "
                                            required
                                        />
                                        <button
                                            @click="searchEvents()"
                                            type="submit"
                                            class="text-white absolute right-2.5 bottom-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                        >
                                            Search
                                        </button>
                                    </div>
                                </nav>
                                <table
                                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                >
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                                Title
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Content
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                From
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                to
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Created by
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Updated by
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Created on
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Updated on
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(events, key) in usePage()
                                                .props.value.events.data"
                                            :key="key"
                                        >
                                            <th
                                                scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap"
                                            >
                                                {{ events.title }}
                                            </th>
                                            <td class="py-4 px-6">
                                                {{ events.content }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{
                                                    date_conversion(events.from)
                                                }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ date_conversion(events.to) }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ events.user.name }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ events.updated_by.name }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{
                                                    date_conversion_from_now(
                                                        events.created_at
                                                    )
                                                }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{
                                                    date_conversion_from_now(
                                                        events.updated_at
                                                    )
                                                }}
                                            </td>
                                            <td class="py-4 px-6">
                                                <a
                                                    href="#"
                                                    @click="
                                                        function_open_update_modal(
                                                            events.title,
                                                            events.content,
                                                            events.from,
                                                            events.to,
                                                            events.id
                                                        )
                                                    "
                                                    class="font-medium text-green-600 dark:text-green-500 hover:underline"
                                                    >Edit</a
                                                >
                                                <a
                                                    href="#"
                                                    @click="
                                                        function_open_delete_modal(
                                                            events.id
                                                        )
                                                    "
                                                    class="font-medium ml-2 text-red-600 dark:text-red-500 hover:underline"
                                                    >Delete</a
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div
                                    class="px-4 w-100 py-3 flex items-center justify-center border-gray-200 sm:px-6"
                                >
                                    <Pagination
                                        v-bind:links="$page.props.events.links"
                                        :search="event_search.search"
                                    />
                                </div>
                            </div>

                            <div v-if="modal_update" class=" ">
                                <div
                                    id="popup-modal"
                                    tabindex="-1"
                                    class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                                >
                                    <div
                                        class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto"
                                    >
                                        <div
                                            class="relative bg-white rounded-lg shadow"
                                        >
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label
                                                        for="name"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >From</label
                                                    >
                                                    <input
                                                        v-model="
                                                            from_date_update
                                                        "
                                                        type="date"
                                                        id="name"
                                                        name="name"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label
                                                        for="name"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >To</label
                                                    >
                                                    <input
                                                        v-model="to_date_update"
                                                        type="date"
                                                        id="name"
                                                        name="name"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                    />
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label
                                                        for="title"
                                                        class="leading-7 text-sm text-gray-600"
                                                        >Title of Event</label
                                                    >
                                                    <input
                                                        v-model="
                                                            update_event_data.title
                                                        "
                                                        type="text"
                                                        id="title"
                                                        name="title"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label
                                                        for="content"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                                        >Your content</label
                                                    >
                                                    <textarea
                                                        v-model="
                                                            update_event_data.content
                                                        "
                                                        id="content"
                                                        rows="4"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                        placeholder="Your content..."
                                                        required
                                                    ></textarea>
                                                </div>
                                            </div>
                                            <button
                                                @click="
                                                    function_open_update_modal()
                                                "
                                                type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-toggle="popup-modal"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span class="sr-only"
                                                    >Close modal</span
                                                >
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg
                                                    aria-hidden="true"
                                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    ></path>
                                                </svg>
                                                <h3
                                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                                >
                                                    Are you sure you want to
                                                    update this event?
                                                </h3>
                                                <button
                                                    @click="
                                                        function_update_event()
                                                    "
                                                    data-modal-toggle="popup-modal"
                                                    type="button"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                                >
                                                    Yes, I'm sure
                                                </button>
                                                <button
                                                    @click="
                                                        function_open_update_modal()
                                                    "
                                                    data-modal-toggle="popup-modal"
                                                    type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                                >
                                                    No, cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="modal_delete">
                                <div
                                    id="popup-modal"
                                    tabindex="-1"
                                    class="overflow-y-auto flex justify-center backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                                >
                                    <div
                                        class="relative p-4 animate w-full max-w-md h-full mt-[20vmin] transition ease-in-out md:h-auto"
                                    >
                                        <div
                                            class="relative bg-white rounded-lg shadow"
                                        >
                                            <button
                                                @click="
                                                    function_open_delete_modal()
                                                "
                                                type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                data-modal-toggle="popup-modal"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    class="w-5 h-5"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                                <span class="sr-only"
                                                    >Close modal</span
                                                >
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg
                                                    aria-hidden="true"
                                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    ></path>
                                                </svg>
                                                <h3
                                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                                >
                                                    Are you sure you want to
                                                    delete this event?
                                                </h3>
                                                <button
                                                    @click="
                                                        function_delete_event()
                                                    "
                                                    data-modal-toggle="popup-modal"
                                                    type="button"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                                >
                                                    Yes, I'm sure
                                                </button>
                                                <button
                                                    @click="
                                                        function_open_delete_modal()
                                                    "
                                                    data-modal-toggle="popup-modal"
                                                    type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                                >
                                                    No, cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>

