<script setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, onUnmounted, computed, inject } from "vue";
import moment from "moment";

// const conversation_list = ref([]);
const open_convo_data = inject("open_convo_data");
const search_data = useForm({
    search_text: "",
    searching: false,
});

const conversation_list = computed(() => {
    if (search_data.searching == false) {
        return usePage().props.value.conversations;
    } else {
        return usePage().props.value.users.filter(
            (user) =>
                user.name.toLowerCase().indexOf(search_data.search_text) > -1
        );
    }
});

onMounted(() => {
    // conversation_list.value = usePage().props.value.conversations;
});

const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};
const function_search = () => {
    //search_data.get(route("socialmedia.messaging"));
    if (search_data.search_text == "") {
        // conversation_list.value = usePage().props.value.conversations;
        search_data.searching = false;
    } else {
        search_data.searching = true;
        /* conversation_list.value = usePage().props.value.users.filter(
            (user) =>
                user.name.toLowerCase().indexOf(search_data.search_text) > -1
        ); */
    }
};

const function_open_messages = (id, user_id) => {
    // open_convo_data.user1 = usePage().props.value.user.id;
    // open_convo_data.user2 = id;
    open_convo_data.conversation_id = id;
    open_convo_data.selected_user_id = user_id;
    open_convo_data.get(route("socialmedia.messaging"), {
        preserveScroll: true,
        onSuccess: () => {
            search_data.searching = false;
            open_convo_data.reset();
        },
    });
};
</script>
<template>

    <div class="w-1/3  border flex flex-col">
        <!-- Header -->
        <div class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">
            <div>
                <img class="w-10 h-10 rounded-full" :src="$page.props.user.profile_photo_url" />
            </div>


        </div>

        <!-- Search -->
        <div class="flex gap-1 py-2 px-2 bg-grey-lightest">
            <input v-model="search_data.search_text" type="text" class="w-full px-2 py-2 text-sm"
                placeholder="Search or start new chat" />
            <button @click="function_search()" type="submit"
                class="text-white right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 mt-1 float-right">
                Search
            </button>
        </div>

        <!-- Contacts -->
        <template v-if="search_data.searching == true">
            <div class="bg-grey-200 w-full flex-1  overflow-auto"
                v-for="(conversation, key) in conversation_list" :key="key">
                <div @click="function_open_messages(null, conversation.id)"
                    class="bg-white px-3 flex items-center  hover:bg-grey-lighter cursor-pointer">
                    <div>
                        <img class="h-12 w-12 rounded-full" :src="conversation.profile_photo_url" />
                    </div>
                    <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
                        <div class="flex items-bottom justify-between">
                            <p class="text-grey-darkest">
                                {{ conversation.name }}
                            </p>
                        </div>
                        <p class="text-grey-dark mt-1 text-sm">I'll be back</p>
                    </div>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="bg-grey-lighter  lg:flex-1 overflow-auto"
                v-for="(conversation, key) in conversation_list" :key="key">
                <div @click="
                    function_open_messages(
                        conversation.id,
                        conversation.user1.id == $page.props.user.id
                            ? conversation.user2.id
                            : conversation.user1.id
                    )
                " class="bg-white px-3  flex items-center hover:bg-grey-lighter cursor-pointer" :class="
    conversation.id == $page.props.conversation_id
        ? 'bg-green-300'
        : ''
">
                    <div>
                        <img class="h-12 w-12 rounded-full" :src="
                            conversation.user1.id == $page.props.user.id
                                ? conversation.user2.profile_photo_url
                                : conversation.user1.profile_photo_url
                        " />
                    </div>
                    <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
                        <div class="flex items-bottom justify-between">
                            <p class="text-grey-darkest" :class="{
                                'font-bold':
                                    conversation.read.includes(
                                        $page.props.user.id
                                    ) == false,
                            }">
                                {{
                                        conversation.user1.id == $page.props.user.id
                                            ? conversation.user2.name
                                            : conversation.user1.name
                                }}
                            </p>
                            <p class="text-xs text-grey-darkest">
                                {{
        date_conversion_from_now(
            conversation.created_at
        )
                                }}
                            </p>
                        </div>
                        <p class="text-grey-dark mt-1 text-sm">I'll be back</p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
