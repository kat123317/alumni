<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { computed, ref, provide, inject, reactive, watch, onMounted, nextTick } from "vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import JetInputError from "@/Components/InputError.vue";
import JetDialogModal from "@/Components/DialogModal.vue";

import ModalAddEditQuestion from "./ModalAddEditQuestion.vue";
import QList from "./QList.vue";

import helpers from '@/helpers.js'
import { Inertia } from "@inertiajs/inertia";
    
const { alertOn, alertOnDelete, alertOnUpdate, alertOnMessage, onAlert } = helpers();

const modals = reactive({
    add_edit: {
        show: false,
        details: {
            id: 0,
            title: 'Add Quesetion',
            method: 'add'
        }
    }
});

const showAddEditModal = (method = 'add') => {
    modals.add_edit.show = true;
    modals.add_edit.details.method = method;
}

provide('modals', modals);
provide('onAlert', onAlert);
provide('alertOn', alertOn);
provide('alertOnMessage', alertOnMessage);
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
            <QList />
        </div>
        <ModalAddEditQuestion />
    </AdminLayout>
</template>
