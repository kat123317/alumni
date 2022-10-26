<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { computed, inject, onMounted, ref } from "vue";

const props = defineProps(["links", "search"]);
const search_url = computed(() =>
    props.search != "" && props.search != undefined
        ? "&search=" + props.search
        : ""
);
const search_variable = ref("");
onMounted(() => {
    // search_variable.value += usePage().props.value.searched ? "&searchTxT=" + usePage().props.value.searched:'';
    if (usePage().props.value.search != null) {
        search_variable.value += "&search=" + usePage().props.value.search;
    } else {
        if (usePage().props.value.yearbook_id != null) {
            search_variable.value +=
                "&yearbook_id=" + usePage().props.value.yearbook_id;
        }
        if (usePage().props.value.college_id != null) {
            search_variable.value +=
                "&college_id=" + usePage().props.value.college_id;
        }
        if (usePage().props.value.course_id != null) {
            search_variable.value +=
                "&course_id=" + usePage().props.value.course_id;
        }
    }
});
</script>

<template>
    <div class="mt-6 -mb-1 flex flex-wrap">
        <template v-for="(link, key) in links" :key="key">
            <div
                v-if="link.url === null"
                class="mr-1 mb-1 px-2 py-1 text-sm bg-white border rounded text-gray-400"
                :class="{ 'ml-auto': links.length === key + 1 }"
            >
                <span v-html="link.label"></span>
            </div>
            <Link
                v-else
                class="mr-1 mb-1 px-2 bg-white py-1 text-sm shadow-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                :class="{
                    'bg-white': link.active,
                    'ml-auto': links.length === key + 1,
                }"
                :href="link.url + search_url + search_variable"
            >
                <span v-html="link.label"></span>
            </Link>
        </template>
    </div>
</template>
