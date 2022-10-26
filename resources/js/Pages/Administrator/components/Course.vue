<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed, inject, provide } from "vue";
import route from "../../../../../vendor/tightenco/ziggy/src/js";

import moment from "moment";
import Pagination from "./Pagination.vue";

// const selected_course_view = computed(()=>{
//   return usePage().props.value.filter_courses_id.id ? usePage().props.value.filter_courses_id.id:'no_select'
// })
const trigger = inject("trigger");
const id_selected_in_filter = ref("");

const modal_update = ref(false);
const modal_delete = ref(false);

const select_course_view = useForm({
    id: 1,
});

onMounted(() => {
    select_course_view.id = inject("filter_courses_id");
});

const add_course_data = useForm({
    abbreviation: "",
    name: "",
    college_id: "",
    logo: "",
    image_name: "",
});

const filter_table_show = () => {
    select_course_view.get(route("administrator", { trigger: trigger.value }));
};

const course_save = () => {
    if (
        add_course_data.name == "" ||
        add_course_data.abbreviation == "" ||
        add_course_data.college_id == "" ||
        add_course_data.image_name == ""
    ) {
        onAlert("empty");
    } else {
        add_course_data.post(route("courses.store"), {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Success");
                // alert("Added")
                add_course_data.reset();
            },
        });
    }
};

const delete_course_data = useForm({
    id: "",
});

const function_open_delete_modal = (id) => {
    delete_course_data.id = id;
    modal_delete.value = !modal_delete.value;
};

const function_delete_event = () => {
    delete_course_data.delete(
        route("courses.delete", [delete_course_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Delete");
                // alert('deleted')
                modal_delete.value = !modal_delete.value;
            },
        }
    );
};

const update_course_data = useForm({
    abbreviation: "",
    name: "",
    id: "",
    college_id: "",
    logo: "",
    image_name: "",
});

const function_open_update_modal = (
    id,
    name,
    abbreviation,
    college_id,
    logo
) => {
    update_course_data.logo = logo;
    update_course_data.id = id;
    update_course_data.college_id = college_id;
    update_course_data.name = name;
    update_course_data.abbreviation = abbreviation;
    modal_update.value = !modal_update.value;
};

const alertOn = ref(false);
const alertOnUpdate = ref(false);
const alertOnDelete = ref(false);
const alertOnError = ref(false);

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

const function_update_course = () => {
    if (
        update_course_data.name == "" ||
        update_course_data.abbreviation == "" ||
        update_course_data.college_id == ""
    ) {
        alert("Please fill out all fields");
    } else {
        update_course_data.post(
            route("courses.update", [update_course_data.id]),
            {
                preserveScroll: true,
                onSuccess: () => {
                    // onAlert('Update')
                    update_course_data.reset();
                    onAlert("Update");
                    modal_update.value = !modal_update.value;
                },
            }
        );
    }
};

const openFile = () => {
    let hidden = document.getElementById("course-hidden-input");
    hidden.click();
    hidden.onchange = (e) => {
        let file = e.target.files[0];
        add_course_data.image_name = file.name;
        add_course_data.logo = file;
    };
};
const openFileEdit = () => {
    let hidden = document.getElementById("course-hidden-edit");
    hidden.click();
    hidden.onchange = (e) => {
        let file = e.target.files[0];
        update_course_data.image_name = file.name;
        update_course_data.logo = file;
    };
};
</script>
<template>
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
                    >Course Successfully added</span
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
                    >Course Successfully updated</span
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
                    >Course Successfully deleted</span
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
        <div v-if="alertOnError" class="bg-gray-100 text-center py-4 lg:px-4">
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
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1
                    class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                >
                    Add Course
                </h1>
            </div>
            <div
                class="lg:w-1/2 p-10 shadow-lg rounded-lg bg-white md:w-2/3 mx-auto"
            >
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/3">
                        <div class="relative">
                            <label
                                for="name"
                                class="leading-7 text-sm text-gray-600"
                                >Abbreviation</label
                            >
                            <input
                                v-model="add_course_data.abbreviation"
                                type="text"
                                id="name"
                                name="name"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                    </div>
                    <div class="p-2 w-[52vmin]">
                        <div class="relative">
                            <label
                                for="email"
                                class="leading-7 text-sm text-gray-600"
                                >Course</label
                            >
                            <input
                                v-model="add_course_data.name"
                                type="email"
                                id="email"
                                name="email"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                    </div>
                    <div class="p-2 p-2 w-1/3">
                        <div class="relative">
                            <label
                                for="email"
                                class="leading-7 text-sm text-gray-600"
                                >College</label
                            >
                            <select
                                v-model="add_course_data.college_id"
                                id="countries"
                                class="bg-gray-50 border border-gray-300 w text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            >
                                <option
                                    v-for="(colleges, key) in usePage().props
                                        .value.colleges"
                                    :key="key"
                                    :value="colleges.id"
                                >
                                    {{ colleges.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="p-2 p-2 w-1/3">
                        <div class="relative">
                            <input
                                v-model="add_course_data.image_name"
                                type="email"
                                id="email"
                                name="email"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                disabled
                            />
                            <input
                                id="course-hidden-input"
                                type="file"
                                class="hidden"
                                accept="image/png, image/gif, image/jpeg"
                            />
                            <button
                                @click="openFile"
                                class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none"
                            >
                                Select Logo
                            </button>
                        </div>
                    </div>

                    <div class="p-2 w-full">
                        <button
                            @click="course_save()"
                            class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                        >
                            Submit
                        </button>
                    </div>
                    <div
                        class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center"
                    >
                        <div
                            class="overflow-x-auto relative shadow-md sm:rounded-lg"
                        >
                            <div class="p-2 p-2 w-1/2">
                                <div class="relative">
                                    <select
                                        v-model="select_course_view.id"
                                        @change="filter_table_show()"
                                        id="countries"
                                        class="bg-gray-50 border border-gray-300 w text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    >
                                        <option value="no_select" selected>
                                            Choose a College Filter
                                        </option>
                                        <option
                                            v-for="(colleges, key) in usePage()
                                                .props.value.colleges"
                                            :key="key"
                                            :value="colleges.id"
                                        >
                                            {{ colleges.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-white uppercase bg-green-500"
                                >
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Logo
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Course
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            ABBR
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(courses, key) in usePage().props
                                            .value.courses.data"
                                        :key="key"
                                    >
                                        <th
                                            scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 word-break font-bold"
                                        >
                                            <img
                                                :src="
                                                    '/images/courses/' +
                                                    courses.logo
                                                "
                                                class="h-[5vmin]"
                                            />
                                        </th>
                                        <th
                                            scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 word-break"
                                        >
                                            {{ courses.name }}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ courses.abbreviation }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <a
                                                href="#"
                                                @click="
                                                    function_open_update_modal(
                                                        courses.id,
                                                        courses.name,
                                                        courses.abbreviation,
                                                        courses.college_id,
                                                        courses.logo
                                                    )
                                                "
                                                class="font-medium text-green-600 hover:underline"
                                                >Edit</a
                                            >
                                            <a
                                                href="#"
                                                @click="
                                                    function_open_delete_modal(
                                                        courses.id
                                                    )
                                                "
                                                class="font-medium ml-2 text-red-600 hover:underline"
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
                                />
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
                                    Are you sure you want to delete this course?
                                </h3>
                                <button
                                    @click="function_delete_event()"
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
                                        >Abbr</label
                                    >
                                    <input
                                        v-model="
                                            update_course_data.abbreviation
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
                                        >Name</label
                                    >
                                    <textarea
                                        v-model="update_course_data.name"
                                        id="content"
                                        rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Name"
                                        required
                                    ></textarea>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label
                                        for="content"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                        >College</label
                                    >
                                    <select
                                        v-model="update_course_data.college_id"
                                        id="countries"
                                        class="bg-gray-50 border border-gray-300 w text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    >
                                        <option
                                            v-for="(colleges, key) in usePage()
                                                .props.value.colleges"
                                            :key="key"
                                            :value="colleges.id"
                                        >
                                            {{ colleges.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <img
                                        :src="
                                            '/images/courses/' +
                                            update_course_data.logo
                                        "
                                        class="h-[5vmin] flex flex-center"
                                    />
                                    <input
                                        v-model="update_course_data.image_name"
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        disabled
                                    />
                                    <input
                                        id="course-hidden-edit"
                                        type="file"
                                        class="hidden"
                                        accept="image/png, image/gif, image/jpeg"
                                    />
                                    <button
                                        @click="openFileEdit"
                                        class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none"
                                    >
                                        Select Logo
                                    </button>
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
                                    Are you sure you want to update this course?
                                </h3>
                                <button
                                    @click="function_update_course()"
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
        </div>
    </section>
</template>
