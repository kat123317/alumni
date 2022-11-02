<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed, ref, provide, inject, reactive, watch } from "vue";
import Pagination from "./../components/Pagination.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import JetInputError from "@/Components/InputLabel.vue";
import JetDialogModal from "@/Components/DialogModal.vue";
import SurveyList from './SurveyList.vue';
import helpers from '@/helpers.js'
    
const { alertOn, onAlert } = helpers()

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
    details: ref({})
})

const addEditSurvey = () => {
    form_add_edit.post(
        route("surveys.store"),
        {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Success");
                form_add_edit.reset();
                modal.show = false;
            },
            onError: (err) => {

            }
        }
    );
};

const resetForeignList = (checked) => {
    // nextTick();
    let ids = [];
    switch (form_add_edit.setup.shown_only) {
        case "college":
            for (
                let index = 0;
                index < usePage().props.value.colleges.length;
                index++
            ) {
                ids.push({
                    is_checked: checked,
                    name: usePage().props.value.colleges[index].name,
                    id: usePage().props.value.colleges[index].id
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
                    is_checked: checked,
                    name: usePage().props.value.courses[index].name,
                    id: usePage().props.value.courses[index].id
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
                    is_checked: checked,
                    name: usePage().props.value.users[index].name,
                    id: usePage().props.value.users[index].id
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
            if (form_add_edit.setup.foreign_ids.length == usePage().props.value.colleges.length) {
                form_add_edit.setup.select_all = true;
            }else {
                form_add_edit.setup.select_all = false;
            }
            break;
        case "course":
        if (form_add_edit.setup.foreign_ids.length == usePage().props.value.courses.length) {
                form_add_edit.setup.select_all = true;
            }else {
                form_add_edit.setup.select_all = false;
            }
            break;
        case "user":
        if (form_add_edit.setup.foreign_ids.length == usePage().props.value.users.length) {
                form_add_edit.setup.select_all = true;
            }else {
                form_add_edit.setup.select_all = false;
            }
            break;
        default:
            break;
    }
};

watch(
  () => foreign_list.value,
  (newValue, oldValue) => {
    form_add_edit.setup.foreign_ids = [];
    newValue.forEach(element => {
        if (element.is_checked) {
            form_add_edit.setup.foreign_ids.push(element.id)
        }
    });
    checkSelectAll()
  },
  { deep: true }
);
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
                        >Survey Added</span
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
            <div class="container p-3 shadow-lg rounded-lg bg-white mt-10 mx-auto">
                <div class="flex p-2">
                    <button
                        @click="modal.show = true"
                        class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                    >
                        Add Survey
                    </button>
                </div>
                <SurveyList />
            </div>
        </section>
        <JetDialogModal :show="modal.show">
            <template #title>Add Survey</template>
            <template #content>
                <div class="grid grid-cols-6 gap-3">
                        <div class="col-span-3">
                            <label class="leading-7 text-sm text-gray-600"
                                >Survey Name</label
                            >
                            <input
                                v-model="form_add_edit.name"
                                type="text"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                            <JetInputError>{{form_add_edit.errors.name}}</JetInputError>
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
                                        v-model:checked="form_add_edit.setup.select_all"
                                        @change="resetForeignList(form_add_edit.setup.select_all)"
                                    >
                                    </JetCheckbox> <span>{{ form_add_edit.setup.select_all == true ? 'Unselect All': 'Select All'  }}</span>
                                </JetInputLabel>
                            </div>
                            <template v-for="(ids, index) in foreign_list">
                                <div class="col-span-3">
                                    <JetInputLabel>
                                        <JetCheckbox
                                            v-model:checked="ids.is_checked"
                                        >
                                        </JetCheckbox> <span>{{ids.name}}</span>
                                    </JetInputLabel>
                                </div>
                            </template>
                        </template>
                    </div>
            </template>
            <template #footer>
                <button
                    @click="modal.show = false"
                        class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                    >
                        Cancel
                    </button>
                <button
                    @click="addEditSurvey()"
                        class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                    >
                        Submit
                    </button>
            </template>
        </JetDialogModal>
    </AdminLayout>
</template>
