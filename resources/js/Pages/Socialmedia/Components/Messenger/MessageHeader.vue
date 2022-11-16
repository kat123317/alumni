<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, inject } from "vue";

const user_selected = ref({});
const selected_is_online = inject("selected_is_online");
onMounted(() => {
    if (usePage().props.value.user_selected != null) {
        user_selected.value = usePage().props.value.user_selected;
    } else {
        user_selected.value = {
            profile_photo_url: "",
            name: "",
        };
    }
});
</script>
<template>
    <div
        class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center"
    >
        <div
            class="flex items-center"
            v-if="usePage().props.value.user_selected != null"
        >
            <div>
                <img
                    class="w-10 h-10 rounded-full"
                    :src="user_selected.profile_photo_url"
                />
            </div>
            <div class="ml-4 flex">
                <p class="text-grey-darkest">
                    {{ user_selected.name }}
                </p>
                <p class="text-grey-darker text-xs mt-1">
                    <!-- {{ selected_is_online == true ? "Online" : "Offline" }} -->
                    <span :class="selected_is_online == true ? 'inline-flex ml-2 items-center p-1 mr-2 text-sm font-semibold text-gray-800  rounded-full bg-green-400 text-gray-300' : ' inline-flex ml-2 items-center p-1 mr-2 text-sm font-semibold text-gray-800  rounded-full  text-gray-300 bg-gray-400'">

                    </span>
                </p>
            </div>
        </div>

        <div class="flex">
 
        </div>
    </div>
</template>
