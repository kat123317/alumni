<script setup>
import Pagination from "@/Pages/Administrator/components/Pagination.vue";
import { usePage, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { inject } from "vue";

const modals = inject("modals");
const search = inject("search");
const form_add_edit = inject("form_add_edit");

const showEditModal = (index, method = "edit") => {
    let edit_survey = usePage().props.value.surveys.data[index];
    modals.add_edit.details.method = method;
    modals.add_edit.details.id = edit_survey.id;
    form_add_edit.name = edit_survey.name;
    form_add_edit.setup.shown_only = edit_survey.setup.shown_only;
    form_add_edit.setup.select_all = edit_survey.setup.select_all;
    form_add_edit.setup.foreign_ids = edit_survey.setup.foreign_ids;
    if (method == "edit") {
        modals.add_edit.details.title = "Update Survey";
        modals.add_edit.details.btn_submit = "Submit";
    } else {
        modals.add_edit.details.title = "Send Invites";
        modals.add_edit.details.btn_submit = "Send Invitation";
    }

    modals.add_edit.show = true;
};

const showDeleteModal = (index) => {
    modals.delete.details.id = usePage().props.value.surveys.data[index].id;
    modals.delete.details.content =
        "Are you sure you want to delete " +
        usePage().props.value.surveys.data[index].name +
        "?";
    modals.delete.show = true;
};
</script>
<template>
    <div class="px-2">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-green-500 text-white"
            >
                <tr>
                    <th scope="col" class="py-3 px-6">Name</th>
                    <th scope="col" class="py-3 px-6">Status</th>
                    <th scope="col" class="py-3 px-6">Created by</th>
                    <th scope="col" class="py-3 px-6">Created</th>
                    <th scope="col" class="py-3 px-6">Updated</th>
                    <th scope="col" class="py-3 px-6">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(survey, index) in $page.props.surveys.data"
                    class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
                >
                    <th
                        scope="row"
                        class="py-4 px-6 font-bold capitalize text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        <Link
                            :href="
                                route('surveys.questions.index', {
                                    survey_id: survey.id,
                                })
                            "
                        >
                            {{ survey.name }}
                        </Link>
                    </th>
                    <td class="py-4 capitalize px-6">
                        {{ survey.status }}
                    </td>
                    <td class="py-4 px-6">
                        {{ survey.user.name }}
                    </td>
                    <td class="py-4 px-6">
                        {{ moment(survey.created_at).format("MMMM Do YYYY") }}
                    </td>
                    <td class="py-4 px-6">
                        {{ moment(survey.updated_at).format("MMMM Do YYYY") }}
                    </td>
                    <td class="py-4 px-6">
                        <a
                            @click="showEditModal(index, 'invite')"
                            href="#"
                            class="font-medium text-green-600 dark:text-green-500 hover:underline"
                            >Send Invitation</a
                        >
                        <a
                            @click="showEditModal(index)"
                            href="#"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2"
                            >Edit</a
                        >
                        <a
                            @click="showDeleteModal(index)"
                            href="#"
                            class="font-medium text-red-600 hover:underline ml-2"
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
                v-bind:links="$page.props.surveys.links"
                :search="search"
            />
        </div>
    </div>
</template>
