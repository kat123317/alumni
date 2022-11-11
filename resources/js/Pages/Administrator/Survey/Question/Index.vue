<script setup>
import JetDialogModal from "@/Components/DialogModal.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ModalAddEditQuestion from "./ModalAddEditQuestion.vue";
import QList from "./QList.vue";
import { Link, usePage, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { provide, reactive, ref, onBeforeMount } from "vue";
import helpers from "@/helpers.js";

const { alertOn, alertOnDelete, alertOnUpdate, alertOnMessage, onAlert } =
    helpers();

const form_add_edit = useForm({
    instruction: "",
    type: "descriptive",
    setup: {
        dropdown: false,
        multiple_select: false,
        required: false,
        choices: [],
    },
});

const modals = reactive({
    add_edit: {
        show: false,
        details: {
            id: 0,
            title: "Add Quesetion",
            method: "add",
        },
    },
    delete: {
        show: false,
        details: {
            title: "Delete Question",
            id: 0,
            content: "",
        },
    },
});

const my_choice = ref({});

onBeforeMount(() => {
    initialize();
});

const initialize = () => {
    usePage().props.value.survey.questions.forEach((question) => {
        if (
            question.setup.dropdown == true ||
            question.setup.multiple_select == false
        ) {
            my_choice.value["question_" + question.order] = 0;
        } else {
            let choices = {};
            question.setup.choices.forEach((choice) => {
                choices["choice_" + choice.value] = 0;
            });
            my_choice.value["question_" + question.order] = choices;
        }
    });
};

const showAddEditModal = (method = "add", index = -1) => {
    if (method == "add") {
        form_add_edit.reset();
        modals.add_edit.show = true;
        modals.add_edit.details.method = method;
        modals.add_edit.details.title = "Add Quesetion";
    } else {
        let edit_question = usePage().props.value.survey.questions[index];

        form_add_edit.instruction = edit_question.instruction;
        form_add_edit.setup.dropdown = edit_question.setup.dropdown;
        form_add_edit.setup.multiple_select =
            edit_question.setup.multiple_select;
        form_add_edit.setup.choices = edit_question.setup.choices;
        form_add_edit.setup.required = edit_question.setup.required;

        modals.add_edit.details.method = "edit";
        modals.add_edit.details.id = edit_question.id;
        modals.add_edit.details.title =
            "Update Question " + edit_question.order;
        modals.add_edit.show = true;
    }
};

const showDeleteModal = (index) => {
    modals.delete.details.id = usePage().props.value.survey.questions[index].id;
    modals.delete.details.content =
        "Are you sure you want to delete Question " +
        usePage().props.value.survey.questions[index].order +
        "?";
    modals.delete.show = true;
};

const deleteQuesiton = () => {
    Inertia.delete(
        route("surveys.questions.delete", {
            survey_id: usePage().props.value.survey.id,
            id: modals.delete.details.id,
        }),
        {
            preserveScroll: true,
            onSuccess: () => {
                alertOnMessage.value = "Question Deleted";
                onAlert("Delete");
                modals.delete.show = false;
            },
            onError: (err) => { },
        }
    );
};

provide("form_add_edit", form_add_edit);
provide("modals", modals);
provide("onAlert", onAlert);
provide("alertOn", alertOn);
provide("alertOnMessage", alertOnMessage);
provide("initialize", initialize);
</script>
<template>
    <AdminLayout :alertOn="alertOn" :alertOnDelete="alertOnDelete" :alertOnUpdate="alertOnUpdate"
        :alertOnMessage="alertOnMessage">
        <div class="container p-3  shadow-lg rounded-lg bg-white mt-10 mx-auto">
            <!-- <div class="sm:text-3xl m-5 mt-10 font-bold text-2xl font-medium title-font mb-4  text-gray-900">
                <h1> {{ $page.props.survey.name }}</h1>
            </div> -->
            <nav
                class="font-sans flex flex-col text-center bg-whte sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-white shadow sm:items-baseline w-full">
                <div class="mb-2 sm:mb-0">
                    <a class="text-2xl no-underline text-grey-darkest text-gray-700 font-bold">{{
                            $page.props.survey.name
                    }}</a>
                </div>
                <div>
                    <div class="flex justify-center  gap-1">
                        <button
                            class="flex text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                            <Link class="flex" :href="route('administrator.survey')"> <svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                            </svg>
                             </Link>
                        </button>
                        <a :href="
                            route('surveys.engine.review', {
                                survey_id: $page.props.survey.id,
                            })
                        " target="_blank"><button
                                class="flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                    <span class = "ml-1">Preview</span>
                                
                            </button></a>

                        <button @click="showAddEditModal('add')"
                            class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class = "ml-1">Add</span>
                        </button>
                    </div>
                </div>
            </nav>
            <div class="flex justify-between p-2">
                <!-- <button
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                    <Link :href="route('administrator.survey')"> Back </Link>
                </button> -->
                <!-- <div class="flex gap-1">
                    <a :href="
                        route('surveys.engine.review', {
                            survey_id: $page.props.survey.id,
                        })
                    " target="_blank"><button
                            class="flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">
                            Preview
                        </button></a>

                    <button @click="showAddEditModal('add')"
                        class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                        Add Question
                    </button>
                </div> -->
            </div>
            <div class="w-full px-2 mt-2">
                <template v-for="(question, index) in $page.props.survey.questions">
                    <div class="w-full">
                        <div class="flex float-right gap-1">
                            <button @click="showAddEditModal('edit', index)"
                                class="flex text-white bg-blue-500 border-0 py-1 px-2 focus:outline-none hover:bg-blue-600 rounded text-sm">
                                Edit
                            </button>
                            <button @click="showDeleteModal(index)"
                                class="flex text-white bg-red-500 border-0 py-1 px-2 focus:outline-none hover:bg-red-600 rounded text-sm">
                                Delete
                            </button>
                        </div>
                        <QList :question="question" :disabled="false" v-model="my_choice['question_' + (index + 1)]" />
                    </div>
                </template>
            </div>
        </div>
        <ModalAddEditQuestion />
        <JetDialogModal :show="modals.delete.show">
            <template #title>{{ modals.delete.details.title }}</template>
            <template #content>
                {{ modals.delete.details.content }}
            </template>
            <template #footer>
                <button @click="modals.delete.show = false"
                    class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">
                    Cancel
                </button>
                <button @click="deleteQuesiton()"
                    class="flex text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">
                    Delete
                </button>
            </template>
        </JetDialogModal>
    </AdminLayout>
</template>


<style scoped>

</style>