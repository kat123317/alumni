<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ConversationList from "./Messenger/ConversationList.vue";
import Messages from "./Messenger/Messages.vue";
import MessageInput from "./Messenger/MessageInput.vue";
import MessageHeader from "./Messenger/MessageHeader.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted, onUnmounted, computed, inject, provide } from "vue";

import { Inertia } from "@inertiajs/inertia";

const props = defineProps([
    "conversations",
    "user_selected",
    "messages",
    "conversation_id",
    "users",
]);

const open_convo_data = useForm({
    // user1: null,
    // user2: null,
    conversation_id: props.conversation_id,
    selected_user_id: null,
});

const message_data = useForm({
    conversation_id: props.conversation_id,
    content: "",
});

const online_users = inject("online_users");
const selected_is_online = computed(() => {
    if (props.user_selected != "") {
        let user = online_users.value.find(
            (user) => user.id == props.user_selected.id
        );
        if (user != undefined) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
});

onMounted(() => {
    if (open_convo_data.conversation_id != null) {
        Echo.channel("message." + open_convo_data.conversation_id).listen(
            ".message-sent",
            (res) => {
                Inertia.reload({ only: ["messages", "conversations"] });
            }
        );
    }
    Echo.join("online-users")
        .here((users) => {
            online_users.value = users;
        })
        .joining((user) => {
            online_users.value.push({
                id: user.id,
                name: user.name,
                profile_photo_url: user.profile_photo_url,
            });
        })
        .leaving((user) => {
            let i = online_users.value.findIndex((x) => x.id == user.id);
            online_users.value.splice(i, 1);
        });
});

onUnmounted(() => {
    if (props.conversation != null) {
        Echo.channel("message." + props.conversation.id).stopListening(
            ".message-sent"
        );
    }
});

provide("open_convo_data", open_convo_data);
provide("message_data", message_data);
provide("selected_is_online", selected_is_online);
</script>

<template>
    <AppLayout title="Messenger">
        <div>
            <div class="container mx-auto">
                <div class="mx-2 block lg:hidden">
                    <h1 class="text-center my-4 text-gray-800 font-bold">
                        Hey!
                    </h1>
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only"
                        >Search</label
                    >
                    <div class="relative">
                        <div
                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-5 h-5 text-gray-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                ></path>
                            </svg>
                        </div>
                        <input
                            type="search"
                            id="default-search"
                            class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 da"
                            placeholder="Search user"
                            required
                        />
                        <button
                            type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
                        >
                            Search
                        </button>
                    </div>
                    <div
                        id="dropdownUsers"
                        class="z-10 w-full mt-2 bg-white rounded shadow"
                    >
                        <ul
                            class="overflow-y-auto py-1 h-48 text-gray-700"
                            aria-labelledby="dropdownUsersButton"
                        >
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Jese Leos
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Robert Gough
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Bonnie Green
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Leslie Livingston
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Michael Gough
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Joseph Mcfall
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Roberta Casas
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Neil Sims
                                </a>
                            </li>
                        </ul>
                        <a
                            href="#"
                            class="flex items-center p-3 text-sm font-medium text-green-600 bg-gray-50 border-t border-gray-200 hover:bg-gray-100 dark:bg-gray-700"
                        >
                            <svg
                                class="mr-1 w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"
                                ></path>
                            </svg>
                            Online
                        </a>
                    </div>
                </div>
                <div class="py-6 px-2">
                    <div
                        class="flex border border-grey h-[150vmin] lg:h-[80vmin] rounded shadow-lg"
                    >
                        <!-- Left -->
                        <ConversationList />
                        <!-- Right -->
                        <div class="w-full border flex flex-col">
                            <!-- Header -->
                            <MessageHeader />

                            <!-- Messages -->
                            <Messages />

                            <!-- Input -->
                            <MessageInput />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
