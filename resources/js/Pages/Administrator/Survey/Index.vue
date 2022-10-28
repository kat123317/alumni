<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed, ref, provide, inject } from "vue";
import Pagination from "./../components/Pagination.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";

const form_add = useForm({
    name: "",
    setup: {
        shown_only: "all",
        foreign_ids: [],
    },
});

const foreignIDs = computed(() => {
    let ids = [];
    switch (form_add.setup.shown_only) {
        case "college":
            for (
                let index = 0;
                index < usePage().props.value.colleges.length;
                index++
            ) {
                ids.push({
                    is_checked: false,
                    name: usePage().props.value.colleges[index].name,
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
                    is_checked: false,
                    name: usePage().props.value.courses[index].name,
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
                    is_checked: false,
                    name: usePage().props.value.users[index].name,
                });
            }
            break;
        default:
            break;
    }
    return ids;
});
</script>
<template>
    <AdminLayout>
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1
                        class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900"
                    >
                        Add Survey
                    </h1>
                    `
                    <div class="grid grid-cols-6 gap-3">
                        <div class="col-span-3">
                            <label class="leading-7 text-sm text-gray-600"
                                >Survey Name</label
                            >
                            <input
                                type="text"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                        </div>
                        <div class="col-span-3">
                            <label
                                for="email"
                                class="leading-7 text-sm text-gray-600"
                                >Shown Only</label
                            >
                            <select
                                v-model="form_add.setup.shown_only"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-nonefocus:outline-none focus:ring-0 focus:border-gray-200 peer"
                            >
                                <option value="all">All</option>
                                <option value="college">College</option>
                                <option value="course">Course</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="col-span-6 flex">
                            <label
                                for="email"
                                class="leading-7 text-sm text-gray-600"
                                >Select</label
                            >
                        </div>
                        <div class="col-span-6">
                            <template v-for="(ids, index) in foreignIDs">
                                <div class="flex">
                                    <JetCheckbox
                                        v-model="ids.is_checked"
                                    ></JetCheckbox>

                                    <JetInputLabel class="ml-1">{{
                                        ids.name
                                    }}</JetInputLabel>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="p-2 w-full">
                    <button
                        class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                    >
                        Add
                    </button>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>
