<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { computed, ref, provide, inject, reactive, watch, onMounted, nextTick } from "vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import JetInputError from "@/Components/InputError.vue";
import JetDialogModal from "@/Components/DialogModal.vue";
import helpers from '@/helpers.js'
import { Inertia } from "@inertiajs/inertia";
    
const { alertOn, alertOnDelete, alertOnUpdate, alertOnMessage, onAlert } = helpers();

const modals = reactive({
    add_edit: {
        show: false,
        details: {
            id: 0,
            title: 'Add Quesetion'
        }
    }
});

const form_add_edit = useForm({
    instruction: '',
    type: 'descriptive',
    setup: {
        choices: []
    }
});

const showAddEditModal = () => {

}

const addEditQuestion = () => {

}
</script>
<template>
    <AdminLayout :alertOn="alertOn" :alertOnDelete="alertOnDelete" :alertOnUpdate="alertOnUpdate" :alertOnMessage="alertOnMessage">
        <div class="container p-3 shadow-lg rounded-lg bg-white mt-10 mx-auto">
            <div class="flex justify-between p-2">
                <button
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                >
                <Link :href="route('administrator.survey')">
                    Back
                </Link>
                </button>
                <button
                    @click="showAddEditModal()"
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                >
                Add Question
                </button>
            </div>
        </div>
        <JetDialogModal :show="modals.add_edit.show">
            <template #title>{{ modals.add_edit.details.title }}</template>
            <template #content>
                dsadas
            </template>
            <template #footer>
                <button
                    @click="modals.add_edit.show = false"
                        class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg"
                    >
                        Cancel
                    </button>
                <button
                @click="addEditQuestion()"
                    class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                >
                    Submit
                </button>
            </template>
        </JetDialogModal>
    </AdminLayout>
</template>
