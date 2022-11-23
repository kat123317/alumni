<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed, inject, provide } from "vue";

import moment from "moment";
import Pagination from "./components/Pagination.vue";
import helpers from "@/helpers.js";

const {
    alertOn,
    alertOnDelete,
    alertOnUpdate,
    alertOnMessage,
    alertOnError,
    onAlert,
} = helpers();

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

const collapseVar = ref(false);

const modal_update = ref(false);
const modal_delete = ref(false);

const post_images = ref([]);

const announcement_search = useForm({
    search: usePage().props.value.search ? usePage().props.value.search : "",
});

const announcement_data = useForm({
    title: "",
    content: "",
    photos: [],
});

const update_announcement_data = useForm({
    id: "",
    title: "",
    content: "",
});

const delete_announcement_data = useForm({
    id: "",
});

const post_announcement = () => {
    if (announcement_data.title == "" || announcement_data.content == "") {
        alertOnMessage.value = "Fill Empty fields";
        onAlert("Tae");
    } else {
        announcement_data.post(route("announcements.store"), {
            preserveScroll: true,
            onSuccess: () => {
                announcement_data.reset();
                post_images.value = [];
                announcement_data.photos = [];
                alertOnMessage.value = "Announcement Successfully added";
                onAlert("Success");
            },
        });
    }
};

const function_open_update_modal = (id, title, content) => {
    update_announcement_data.id = id;
    update_announcement_data.title = title;
    update_announcement_data.content = content;
    modal_update.value = !modal_update.value;
};

const function_update_post = () => {
    update_announcement_data.put(
        route("announcements.update", [update_announcement_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                announcement_data.reset();
                alertOnMessage.value = "Announcement Successfully updated";
                onAlert("Update");
                modal_update.value = !modal_update.value;
            },
        }
    );
};

const function_open_delete_modal = (id) => {
    delete_announcement_data.id = id;
    modal_delete.value = !modal_delete.value;
};

const function_delete_post = () => {
    delete_announcement_data.delete(
        route("announcements.delete", [delete_announcement_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                delete_announcement_data.reset();
                alertOnMessage.value = "Announcement Successfully deleted";
                onAlert("Delete");
                modal_delete.value = !modal_delete.value;
            },
        }
    );
};

const searchAnnouncements = () => {
    announcement_search.get(route("administrator.announcement"));
};

// provide("announcement_search_key", announcement_search.announcement_search_key);

const openFile = () => {
    let hidden = document.getElementById("post_image");
    hidden.click();
    hidden.onchange = (e) => {
        if (post_images.value.length + e.target.files.length > 2) {
            alertOnMessage.value = "Only 2 images can be selected";
            onAlert("Delete");
            return;
        } else {
            for (let index = 0; index < e.target.files.length; index++) {
                post_images.value.push(
                    window.URL.createObjectURL(e.target.files[index])
                );
                announcement_data.photos.push(e.target.files[index]);
            }
        }
    };
};

const remove_image = (key) => {
    post_images.value.splice(key, 1);
    announcement_data.photos.splice(key, 1);
};
</script>
<template>
    <AdminLayout
        :alertOn="alertOn"
        :alertOnDelete="alertOnDelete"
        :alertOnUpdate="alertOnUpdate"
        :alertOnMessage="alertOnMessage"
        :alertOnError="alertOnError"
    >
        <section class="text-gray-600 body-font relative">
            <div
                class="container px-5 py-24 p-10 shadow-lg rounded-lg bg-white mt-10 mx-auto flex sm:flex-nowrap flex-wrap"
            >
                <div
                    class="lg:w-2/3 md:w-1/2 bg-gray-50 rounded-lg overflow-hidden sm:mr-10 p-10 items-start justify-center relative"
                >
                    <nav
                        class="mb-2 flex justify-end"
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
                                v-model="announcement_search.search"
                                type="search"
                                id="default-search"
                                class="block p-4 pl-10 w-[100%] lg:w-[30vmin] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                placeholder="Search Announcement"
                            />
                            <button
                                @click="searchAnnouncements()"
                                type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2"
                            >
                                Search
                            </button>
                        </div>
                    </nav>
                    <div class="overflow-x-auto rounded relative">
                        <table
                            class="w-full max-w-7xl text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-green-500 text-white"
                            >
                                <tr>
                                    <th scope="col" class="py-3 px-6">Title</th>
                                    <th scope="col" class="py-3 px-6">Image</th>
                                    <th scope="col" class="py-3 px-6">
                                        Content
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Posted at
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Updated at
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Posted by
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Updated by
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                v-for="(announcements, key) in usePage().props
                                    .value.announcements.data"
                                :key="key"
                            >
                                <tr
                                    class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="py-4 px-6 font-bold capitalize text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ announcements.title }}
                                    </th>
                                    <td
                                        class="py-4 max-w-[70vmin] w-[26vmin] px-2"
                                    >
                                        <div v-if="announcements.photo == null">
                                            <p>No Image</p>
                                        </div>
                                        <div
                                            v-else
                                            v-for="(
                                                photo, key
                                            ) in announcements.photo"
                                            :key="key"
                                        >
                                            <img
                                                class="mb-2"
                                                :src="
                                                    './../images/announcements/' +
                                                    photo
                                                "
                                                alt=""
                                            />
                                        </div>
                                    </td>
                                    <td
                                        class="py-4 max-w-[70vmin] w-[26vmin] px-2"
                                    >
                                        {{ announcements.content }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{
                                            date_conversion(
                                                announcements.created_at
                                            )
                                        }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{
                                            date_conversion_from_now(
                                                announcements.updated_at
                                            )
                                        }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ announcements.user.name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ announcements.updated_by.name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a
                                            href="#"
                                            @click="
                                                function_open_update_modal(
                                                    announcements.id,
                                                    announcements.title,
                                                    announcements.content
                                                )
                                            "
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2"
                                            >Edit</a
                                        >
                                        <a
                                            href="#"
                                            @click="
                                                function_open_delete_modal(
                                                    announcements.id
                                                )
                                            "
                                            class="font-medium text-red-600 hover:underline ml-2"
                                            >Delete</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0"
                >
                    <h2
                        class="text-gray-900 text-lg mb-1 font-medium title-font"
                    >
                        Post-Announcement
                    </h2>
                    <div class="relative mb-4">
                        <label
                            for="name"
                            class="leading-7 text-sm text-gray-600"
                            >Title</label
                        >
                        <input
                            v-model="announcement_data.title"
                            type="text"
                            id="name"
                            name="name"
                            class="w-full bg-white rounded border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        />
                    </div>
                    <div class="relative mb-4">
                        <input
                            id="post_image"
                            type="file"
                            class="hidden"
                            accept="image/png, image/gif, image/jpeg"
                            multiple
                        />
                        <button
                            @click="openFile"
                            class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none"
                        >
                            Upload Images
                        </button>
                        <div
                            v-if="post_images != null"
                            class="grid mt-2 grid-cols-1 lg:grid-cols-4"
                        >
                            <div v-for="(image, key) in post_images" :key="key">
                                <div
                                    class="w-auto mt-2 mx-auto lg:max-w-[20vmin] z-30"
                                >
                                    <div class="shadow-lg bg-white p-3">
                                        <img
                                            class="w-full max-h-[40vmin] object-cover"
                                            :src="image"
                                        />
                                        <ul
                                            class="mt-3 flex justify-end flex-wrap"
                                        >
                                            <li>
                                                <button
                                                    @click="remove_image(key)"
                                                    class="flex text-gray-400 hover:text-gray-600"
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
                                                            class="text-red-500"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                        />
                                                    </svg>
                                                    <span class="text-red-500"
                                                        >Remove</span
                                                    >
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-4">
                        <label
                            for="message"
                            class="leading-7 text-sm text-gray-600"
                            >Announcement</label
                        >
                        <textarea
                            v-model="announcement_data.content"
                            id="message"
                            name="message"
                            class="w-full bg-white rounded border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                        ></textarea>
                    </div>
                    <button
                        @click="post_announcement()"
                        class="text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg"
                    >
                        Post
                    </button>
                </div>
            </div>
            <div
                class="px-4 w-100 py-3 flex items-center justify-center border-gray-200 sm:px-6"
            >
                <Pagination
                    v-bind:links="$page.props.announcements.links"
                    :search="announcement_search.search"
                />
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
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label
                                        for="title"
                                        class="leading-7 text-sm text-gray-600"
                                        >Title of Announcement</label
                                    >
                                    <input
                                        v-model="update_announcement_data.title"
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
                                            update_announcement_data.content
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
                                @click="function_open_update_modal()"
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
                                <span class="sr-only">Close modal</span>
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
                                    Are you sure you want to update this post?
                                </h3>
                                <button
                                    @click="function_update_post()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_open_update_modal()"
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
                        <div class="relative bg-white rounded-lg shadow">
                            <button
                                @click="function_open_delete_modal()"
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
                                <span class="sr-only">Close modal</span>
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
                                    Are you sure you want to delete this post?
                                </h3>
                                <button
                                    @click="function_delete_post()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_open_delete_modal()"
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
        </section>
    </AdminLayout>
</template>
