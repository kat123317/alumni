<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, provide } from "vue";
import Announcement from "@/Pages/Administrator/components/Announcement.vue";
import Alumni from "@/Pages/Administrator/components/Alumni.vue";
import Usermangement from "@/Pages/Administrator/components/Usermangement.vue";
import Department from "@/Pages/Administrator/components/Department.vue";
import Course from "@/Pages/Administrator/components/Course.vue";
import Events from "@/Pages/Administrator/components/Events.vue";
import YearBook from "@/Pages/Administrator/components/YearBook.vue";
import Notification from "@/Pages/Administrator/components/Notification.vue";

const trigger = ref(usePage().props.value.trigger);

provide("trigger", trigger);
provide("filter_courses_id", usePage().props.value.filter_courses_id);
</script>
<template>
    <AdminLayout>
        <Announcement v-if="trigger == 1" />
        <Alumni v-if="trigger == 2" />
        <Usermangement v-if="trigger == 3" />
        <Department v-if="trigger == 4" />
        <Course v-if="trigger == 5" />
        <Course v-if="trigger == 6" />
        <Events v-if="trigger == 7" />
        <YearBook v-if="trigger == 8" />
        <Notification v-if="trigger == 9" />
    </AdminLayout>
</template>
