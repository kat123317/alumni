<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import {
    computed,
    ref,
    provide,
    inject,
    reactive,
    watch,
    onMounted,
    nextTick,
} from "vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import JetInputError from "@/Components/InputError.vue";
import JetDialogModal from "@/Components/DialogModal.vue";
import SurveyList from "./SurveyList.vue";
import helpers from "@/helpers.js";
import { Inertia } from "@inertiajs/inertia";

const { alertOn, alertOnDelete, alertOnUpdate, alertOnMessage, onAlert } =
    helpers();

const search = ref(usePage().props.value.search);
const form_add_edit = useForm({
    name: "",
    setup: {
        shown_only: "all",
        select_all: false,
        foreign_ids: [],
    },
});

const foreign_list = ref([]);

const modal = reactive({
    show: false,
    details: ref({}),
});

const modals = reactive({
    add_edit: {
        show: false,
        details: {
            title: "Add Survey",
            id: 0,
            method: "add",
            btn_submit: "Submit",
        },
    },
    delete: {
        show: false,
        details: {
            title: "Delete Survey",
            id: 0,
            content: "",
        },
    },
});

onMounted(() => {
    resetForeignList(false);
});

const showAddModal = () => {
    modals.add_edit.show = true;
    modals.add_edit.details.method = "add";
    modals.add_edit.details.title = "Add Survey";
    form_add_edit.name = "";
};

const addEditSurvey = () => {
    if (modals.add_edit.details.method == "add") {
        form_add_edit.post(route("surveys.store"), {
            preserveScroll: true,
            onSuccess: () => {
                alertOnMessage.value = "Survey Added";
                onAlert("Success");
                form_add_edit.reset();
                modals.add_edit.show = false;
            },
            onError: (err) => {},
        });
    } else if (modals.add_edit.details.method == "edit") {
        form_add_edit.put(
            route("surveys.update", { id: modals.add_edit.details.id }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    alertOnMessage.value = "Survey Successfully updated";
                    onAlert("Update");
                    form_add_edit.reset();
                    modals.add_edit.show = false;
                },
                onError: (err) => {},
            }
        );
    } else {
        form_add_edit.put(
            route("surveys.send_invitaion", { id: modals.add_edit.details.id }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    alertOnMessage.value = "Survey Invitaion Successfully sent";
                    onAlert("Update");
                    form_add_edit.reset();
                    modals.add_edit.show = false;
                },
                onError: (err) => {},
            }
        );
    }
};

const deleteSurvey = () => {
    Inertia.delete(route("surveys.delete", { id: modals.delete.details.id }), {
        preserveScroll: true,
        onSuccess: () => {
            alertOnMessage.value = "Survey Deleted";
            onAlert("Delete");
            modals.delete.show = false;
        },
        onError: (err) => {},
    });
};

const resetForeignList = (checked) => {
    nextTick();
    let ids = [];
    switch (form_add_edit.setup.shown_only) {
        case "college":
            for (
                let index = 0;
                index < usePage().props.value.colleges.length;
                index++
            ) {
                ids.push({
                    is_checked:
                        checked != null
                            ? checked
                            : form_add_edit.setup.foreign_ids.includes(
                                  usePage().props.value.colleges[index].id
                              ),
                    name: usePage().props.value.colleges[index].name,
                    id: usePage().props.value.colleges[index].id,
                });
            }
            break;
        case "course":
            for (
                let index = 0;
                index < usePage().props.value.courses.length;
                index++
            ) {
                ids.push({
                    is_checked:
                        checked != null
                            ? checked
                            : form_add_edit.setup.foreign_ids.includes(
                                  usePage().props.value.courses[index].id
                              ),
                    name: usePage().props.value.courses[index].name,
                    id: usePage().props.value.courses[index].id,
                });
            }
            break;
        case "user":
            for (
                let index = 0;
                index < usePage().props.value.users.length;
                index++
            ) {
                ids.push({
                    is_checked:
                        checked != null
                            ? checked
                            : form_add_edit.setup.foreign_ids.includes(
                                  usePage().props.value.users[index].id
                              ),
                    name: usePage().props.value.users[index].name,
                    id: usePage().props.value.users[index].id,
                });
            }
            break;
        default:
            break;
    }
    foreign_list.value = ids;
};

const checkSelectAll = () => {
    switch (form_add_edit.setup.shown_only) {
        case "college":
            if (
                form_add_edit.setup.foreign_ids.length ==
                usePage().props.value.colleges.length
            ) {
                form_add_edit.setup.select_all = true;
            } else {
                form_add_edit.setup.select_all = false;
            }
            break;
        case "course":
            if (
                form_add_edit.setup.foreign_ids.length ==
                usePage().props.value.courses.length
            ) {
                form_add_edit.setup.select_all = true;
            } else {
                form_add_edit.setup.select_all = false;
            }
            break;
        case "user":
            if (
                form_add_edit.setup.foreign_ids.length ==
                usePage().props.value.users.length
            ) {
                form_add_edit.setup.select_all = true;
            } else {
                form_add_edit.setup.select_all = false;
            }
            break;
        default:
            break;
    }
};

const searchSurvey = () => {
    Inertia.get(route("administrator.survey", { search: search.value }));
};

watch(
    () => foreign_list.value,
    (newValue, oldValue) => {
        form_add_edit.setup.foreign_ids = [];
        newValue.forEach((element) => {
            if (element.is_checked) {
                form_add_edit.setup.foreign_ids.push(element.id);
            }
        });
        checkSelectAll();
    },
    { deep: true }
);

watch(
    () => modals.add_edit.show,
    (newValue, oldValue) => {
        if (
            modals.add_edit.details.method == "edit" ||
            modals.add_edit.details.method == "invite"
        ) {
            resetForeignList(null);
        }
    },
    { deep: true }
);

provide("modals", modals);
provide("search", search);
provide("form_add_edit", form_add_edit);
provide("form_add_edit", form_add_edit);
</script>
<template>
    <AdminLayout
        :alertOn="alertOn"
        :alertOnDelete="alertOnDelete"
        :alertOnUpdate="alertOnUpdate"
        :alertOnMessage="alertOnMessage"
    >
        <div class="container p-3 shadow-lg rounded-lg bg-white mt-10 mx-auto">
            <div class="flex justify-between p-2">
                <button
                    @click="showAddModal()"
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                >
                    Add Survey
                </button>
                <nav
                    class="flex justify-end"
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
                            @keydown.enter="searchSurvey()"
                            type="search"
                            v-model="search"
                            id="default-search"
                            class="block pr-4 pl-10 py-3 w-[300px] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search Survey"
                        />
                        <button
                            @click="searchSurvey()"
                            type="button"
                            class="text-white absolute right-2 bottom-1 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2"
                        >
                            Search
                        </button>
                    </div>
                </nav>
            </div>
            <SurveyList />
        </div>
        <JetDialogModal :show="modals.add_edit.show">
            <template #title>{{ modals.add_edit.details.title }}</template>
            <template #content>
                <div class="grid grid-cols-6 gap-3">
                    <div class="col-span-3">
                        <label class="leading-7 text-sm text-gray-600"
                            >Survey Name</label
                        >
                        <input
                            v-model="form_add_edit.name"
                            :disabled="
                                modals.add_edit.details.method == 'invite'
                            "
                            type="text"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        />
                        <JetInputError
                            :message="form_add_edit.errors.name"
                        ></JetInputError>
                    </div>
                    <div class="col-span-3">
                        <label
                            for="email"
                            class="leading-7 text-sm text-gray-600"
                            >Shown Only</label
                        >
                        <select
                            v-model="form_add_edit.setup.shown_only"
                            @change="resetForeignList(false)"
                            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-nonefocus:outline-none focus:ring-0 focus:border-gray-200 peer"
                        >
                            <option value="all">All</option>
                            <option value="college">College</option>
                            <option value="course">Course</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <template v-if="form_add_edit.setup.shown_only != 'all'">
                        <div class="col-span-6 flex">
                            <JetInputLabel>
                                <JetCheckbox
                                    v-model:checked="
                                        form_add_edit.setup.select_all
                                    "
                                    @change="
                                        resetForeignList(
                                            form_add_edit.setup.select_all
                                        )
                                    "
                                >
                                </JetCheckbox>
                                <span>{{
                                    form_add_edit.setup.select_all == true
                                        ? "Unselect All"
                                        : "Select All"
                                }}</span>
                            </JetInputLabel>
                        </div>
                        <template v-for="(ids, index) in foreign_list">
                            <div class="col-span-3">
                                <JetInputLabel>
                                    <JetCheckbox
                                        v-model:checked="ids.is_checked"
                                    >
                                    </JetCheckbox>
                                    <span>{{ ids.name }}</span>
                                </JetInputLabel>
                            </div>
                        </template>
                    </template>
                </div>
            </template>
            <template #footer>
                <button
                    @click="modals.add_edit.show = false"
                    class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    Cancel
                </button>
                <button
                    @click="addEditSurvey()"
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                >
                    {{ modals.add_edit.details.btn_submit }}
                </button>
            </template>
        </JetDialogModal>

        <JetDialogModal :show="modals.delete.show">
            <template #title>{{ modals.delete.details.title }}</template>
            <template #content>
                {{ modals.delete.details.content }}
            </template>
            <template #footer>
                <button
                    @click="modals.delete.show = false"
                    class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    Cancel
                </button>
                <button
                    @click="deleteSurvey()"
                    class="flex text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                >
                    Delete
                </button>
            </template>
        </JetDialogModal>
    </AdminLayout>
</template>
