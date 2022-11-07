<script setup>
import JetDialogModal from "@/Components/DialogModal.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ModalAddEditQuestion from "./ModalAddEditQuestion.vue";
import QList from "./QList.vue";
import { Link, usePage, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { provide, reactive, ref } from "vue";
import helpers from "@/helpers.js";

const { alertOn, alertOnDelete, alertOnUpdate, alertOnMessage, onAlert } =
    helpers();

const myChoice = ref(1);

const form_add_edit = useForm({
    instruction: "",
    type: "descriptive",
    setup: {
        dropdown: false,
        multiple_select: false,
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

const showAddEditModal = (method = "add", index = -1) => {
    if (method == "add") {
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
            onError: (err) => {},
        }
    );
};

provide("form_add_edit", form_add_edit);
provide("modals", modals);
provide("onAlert", onAlert);
provide("alertOn", alertOn);
provide("alertOnMessage", alertOnMessage);
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
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                >
                    <Link :href="route('administrator.survey')"> Back </Link>
                </button>
                <button
                    @click="showAddEditModal('add')"
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                >
                    Add Question
                </button>
            </div>
            <div class="w-full px-2 mt-2">
                <template
                    v-for="(question, index) in $page.props.survey.questions"
                >
                    <div class="w-full">
                        <div class="flex float-right gap-1">
                            <button
                                @click="showAddEditModal('edit', index)"
                                class="flex text-white bg-blue-500 border-0 py-1 px-2 focus:outline-none hover:bg-blue-600 rounded text-sm"
                            >
                                Edit
                            </button>
                            <button
                                @click="showDeleteModal(index)"
                                class="flex text-white bg-red-500 border-0 py-1 px-2 focus:outline-none hover:bg-red-600 rounded text-sm"
                            >
                                Delete
                            </button>
                        </div>
                        <QList :question="question" v-model="myChoice" />
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
                <button
                    @click="modals.delete.show = false"
                    class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg"
                >
                    Cancel
                </button>
                <button
                    @click="deleteQuesiton()"
                    class="flex text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                >
                    Delete
                </button>
            </template>
        </JetDialogModal>
    </AdminLayout>
</template>
