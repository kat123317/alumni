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
                <ConversationList class="block mt-5 w-screen min-h-[90vmin] lg:hidden" />
                <div class="py-6 px-2">
                    <div
                        class="flex border border-grey h-[150vmin] lg:h-[80vmin] rounded shadow-lg"
                    >
                        <!-- Left -->
                        <ConversationList class="hidden lg:block" />
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
