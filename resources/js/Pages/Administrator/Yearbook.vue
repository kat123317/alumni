<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed, provide, inject } from "vue";
import moment from "moment";
import Pagination from "./components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

// const trigger = inject("trigger");

const modal_update = ref(false);
const modal_delete = ref(false);

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

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("YYYY");
    }
};
const date_conversion2 = (value) => {
    if (value) {
        return moment(value).format("YYYY Do MMMM");
    }
};

const search_data = useForm({
    search: usePage().props.value.search ? usePage().props.value.search : "",
});

const yearbook_data = useForm({
    schoolyear_from: "",
    schoolyear_to: "",
});

const add_yearbook = () => {
    if (
        yearbook_data.schoolyear_from == "" ||
        yearbook_data.schoolyear_to == ""
    ) {
        onAlert("others");
    } else {
        yearbook_data.schoolyear_from = date_conversion(
            yearbook_data.schoolyear_from
        );
        yearbook_data.schoolyear_to = date_conversion(
            yearbook_data.schoolyear_to
        );
        yearbook_data.post(route("yearbooks.store"), {
            preserveScroll: true,
            onSuccess: () => {
                yearbook_data.reset();
                onAlert("Success");
            },
        });
    }
};

const update_yearbook_data = useForm({
    id: "",
    from_date_update: "",
    to_date_update: "",
});

const delete_yearbook_data = useForm({
    id: "",
});
const function_search_year = () => {
    search_data.get(route("administrator.yearbook"), {
        preserveScroll: true,
        onSuccess: () => {},
    });
};

const function_open_delete_modal = (id) => {
    delete_yearbook_data.id = id;
    modal_delete.value = !modal_delete.value;
};

const function_delete_yeabook = () => {
    delete_yearbook_data.delete(
        route("yearbooks.delete", [delete_yearbook_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Delete");
                modal_delete.value = !modal_delete.value;
            },
        }
    );
};

const function_open_update = (id, from, to) => {
    update_yearbook_data.id = id;
    update_yearbook_data.from_date_update = from + "-01";
    update_yearbook_data.to_date_update = to + "-01";
    modal_update.value = !modal_update.value;
};

const function_update_yeabook = () => {
    update_yearbook_data.put(
        route("yearbooks.update", [update_yearbook_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Update");
                update_yearbook_data.reset();
                modal_update.value = !modal_update.value;
            },
        }
    );
};
// provide("year_search_key", search_data.year_search_key);
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
                        >School year Successfully added</span
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
                        >School year Successfully updated</span
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
                        >School year Successfully deleted</span
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
            <div class=" p-10 container shadow border  mt-10 mx-auto">
                <div class="flex flex-col text-center w-full ">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                        Add School Year
                    </h1>
                </div>
                <div class="flex flex-col p-10  text-center w-full mb-12">

                    <div class="p-2 w-full">
                        <div class="relative">
                            <label
                                for="name"
                                class="leading-7 text-sm text-gray-600"
                                >From</label
                            >
                            <input
                                v-model="yearbook_data.schoolyear_from"
                                type="month"
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
                                v-model="yearbook_data.schoolyear_to"
                                type="month"
                                id="name"
                                name="name"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                    </div>
                    <div class="p-2 flex justify-end w-full">
                        <button
                            @click="add_yearbook()"
                            class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                        >
                            Add
                        </button>
                    </div>
                </div>

                <div class="lg:w-full md:w-2/3 mx-auto">
                    <nav
                        class="mb-10 flex justify-end"
                        aria-label="Page navigation example"
                    >
                        <label
                            for="default-search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only"
                            >Search</label
                        >
                        <div class="relative">
                            <div
                                class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5 text-gray-500"
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
                                class="block p-4 pl-10 w-[80vmin] lg:w-[50vmin] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                placeholder="Search "
                                required
                            />
                            <button
                                @click="function_search_year()"
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
                                class="text-xs text-white uppercase bg-green-500"
                            >
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        School year from
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        School year to
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Created at
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Updated at
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(yearbooks, index) in usePage().props
                                        .value.yearbooks.data"
                                    :key="index"
                                    class="border-b"
                                >
                                    <th
                                        scope="row"
                                        class="py-4 px-6 font-medium text-gray-900"
                                    >
                                        <div class="pl-3">
                                            <div
                                                class="font-normal text-gray-500"
                                            >
                                                {{
                                                    date_conversion(
                                                        yearbooks.schoolyear_from
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </th>
                                    <td class="py-4 px-6">
                                        <div class="pl-3">
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                {{
                                                    date_conversion(
                                                        yearbooks.schoolyear_to
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="pl-3">
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                {{
                                                    date_conversion2(
                                                        yearbooks.created_at
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="pl-3">
                                            <div
                                                class="text-base font-semibold"
                                            >
                                                {{
                                                    date_conversion2(
                                                        yearbooks.updated_at
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="pl-3">
                                            <div
                                                class="text-base flex justify-center font-semibold"
                                            >
                                                <button
                                                    @click="
                                                        function_open_update(
                                                            yearbooks.id,
                                                            yearbooks.schoolyear_from,
                                                            yearbooks.schoolyear_to
                                                        )
                                                    "
                                                    class="flex items-center justify-center w-full px-2 py-1 text-white transition-colors duration-300 transform bg-blue-600 rounded-md focus:outline-none sm:w-auto sm:mx-1 hover:bg-blue-500 focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                                >
                                                    <span class="mx-1">
                                                        Edit
                                                    </span>
                                                </button>
                                                <button
                                                    @click="
                                                        function_open_delete_modal(
                                                            yearbooks.id
                                                        )
                                                    "
                                                    class="flex items-center justify-center w-full px-2 py-1 text-white transition-colors duration-300 transform bg-red-600 rounded-md focus:outline-none sm:w-auto sm:mx-1 hover:bg-red-500 focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-40"
                                                >
                                                    <span class="mx-1">
                                                        Delete
                                                    </span>
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
                                v-bind:links="$page.props.yearbooks.links"
                                :search="search_data.search"
                            />
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
                                            for="name"
                                            class="leading-7 text-sm text-gray-600"
                                            >From</label
                                        >
                                        <input
                                            v-model="
                                                update_yearbook_data.from_date_update
                                            "
                                            type="month"
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
                                            v-model="
                                                update_yearbook_data.to_date_update
                                            "
                                            type="month"
                                            id="name"
                                            name="name"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        />
                                    </div>
                                </div>
                                <button
                                    @click="function_open_update()"
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
                                        class="mx-auto mb-4 w-14 h-14 text-gray-400"
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
                                        class="mb-5 text-lg font-normal text-gray-500"
                                    >
                                        Are you sure you want to update this
                                        yearbook?
                                    </h3>
                                    <button
                                        @click="function_update_yeabook()"
                                        data-modal-toggle="popup-modal"
                                        type="button"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                    >
                                        Yes, I'm sure
                                    </button>
                                    <button
                                        @click="function_open_update()"
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
                                        class="mx-auto mb-4 w-14 h-14 text-gray-400"
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
                                        class="mb-5 text-lg font-normal text-gray-500"
                                    >
                                        Are you sure you want to delete this
                                        yearbook?
                                    </h3>
                                    <button
                                        @click="function_delete_yeabook()"
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
            </div>
        </section>
    </AdminLayout>
</template>

<style>
.animate {
    animation: myAnim 0.5s ease 0s 1 normal forwards;
}
.alertanim {
    animation: Bounce 0.5s ease 0s 1 normal forwards;
}

@keyframes myAnim {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes Bounce {
    0% {
        animation-timing-function: ease-in;
        opacity: 0;
        transform: translateY(-250px);
    }

    38% {
        animation-timing-function: ease-out;
        opacity: 1;
        transform: translateY(0);
    }

    55% {
        animation-timing-function: ease-in;
        transform: translateY(-65px);
    }

    72% {
        animation-timing-function: ease-out;
        transform: translateY(0);
    }

    81% {
        animation-timing-function: ease-in;
        transform: translateY(-28px);
    }

    90% {
        animation-timing-function: ease-out;
        transform: translateY(0);
    }

    95% {
        animation-timing-function: ease-in;
        transform: translateY(-8px);
    }

    100% {
        animation-timing-function: ease-out;
        transform: translateY(0);
    }
}
</style>
