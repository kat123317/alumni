<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { inject, ref } from "vue";
import EmojiPicker from "vue3-emoji-picker";

// import css
import "../../../../../../node_modules/vue3-emoji-picker/dist/style.css";

const emojioverlay = ref(false);
const message_data = inject("message_data");
const function_send_message = (id) => {
    if (usePage().props.value.user_selected == null) {
        return;
    } else {
        message_data.conversation_id = id;
        axios
            .post(route("socialmedia.send_message"), message_data)
            .then((response) => {
                message_data.reset();
            });
    }
};

function onSelectEmoji(emoji) {
    console.log(emoji);

    message_data.content != null
        ? (message_data.content = message_data.content + emoji.i)
        : (message_data.content = emoji.i);
}
</script>
<template>
    <div class="bg-grey-lighter px-4 py-4 flex items-center">
        <div
            class="hover:text-yellow-200 cursor-pointer"
            @click="emojioverlay = !emojioverlay"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
            >
                <path
                    opacity=".45"
                    fill="#263238"
                    d="M9.153 11.603c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962zm-3.204 1.362c-.026-.307-.131 5.218 6.063 5.551 6.066-.25 6.066-5.551 6.066-5.551-6.078 1.416-12.129 0-12.129 0zm11.363 1.108s-.669 1.959-5.051 1.959c-3.505 0-5.388-1.164-5.607-1.959 0 0 5.912 1.055 10.658 0zM11.804 1.011C5.609 1.011.978 6.033.978 12.228s4.826 10.761 11.021 10.761S23.02 18.423 23.02 12.228c.001-6.195-5.021-11.217-11.216-11.217zM12 21.354c-5.273 0-9.381-3.886-9.381-9.159s3.942-9.548 9.215-9.548 9.548 4.275 9.548 9.548c-.001 5.272-4.109 9.159-9.382 9.159zm3.108-9.751c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962z"
                ></path>
            </svg>
        </div>
        <div
            v-if="emojioverlay"
            class="bg-red-200 slide-in-elliptic-top-fwd flex justify-start"
        >
            <div class="absolute mr-10" style="margin-top: -25rem !important">
                <EmojiPicker :native="false" @select="onSelectEmoji" />
                <button
                    type="button"
                    @click="emojioverlay = !emojioverlay"
                    class="float-right w-full text-white mt-1 bg-red-500 border border-gray-300 focus:outline-none hover:bg-red-900 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                >
                    Close
                </button>
            </div>
        </div>
        <div class="flex-1 mx-4">
            <textarea
                @click="emojioverlay = false"
                v-model="message_data.content"
                class="w-full border rounded px-2 py-2"
                type="text"
                :disabled="usePage().props.value.user_selected == null"
            />
        </div>
        <div>
            <button
                class="hover:text-green-500"
                @click="function_send_message($page.props.conversation_id)"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        class="hover:text-green-500"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>
