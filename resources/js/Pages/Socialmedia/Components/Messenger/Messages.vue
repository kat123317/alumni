<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { onMounted, ref, watch, nextTick } from "vue";
const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};
const messagesLength = ref(0);
onMounted(() => {
    // setInterval(() => {
    //     scrolltoDown()
    // }, 1000);
    scrolltoDown();
});

watch(
    () => usePage().props.value.messages.length,
    (message) => {
        scrolltoDown();
    }
);

const scrolltoDown = async () => {
    await nextTick();
    let objDiv = document.getElementById("scrollMe");
    objDiv.scrollTop = objDiv.scrollHeight;
};
</script>
<template>
    <div class="flex-1 overflow-auto" id="scrollMe" style="background: #dad3cc">
        <div
            class="py-2 px-3"
            style="background: url('https://i.ibb.co/BqvS41T/whatsa.png')"
        >
            <div class="flex justify-center mb-2">
                <div class="rounded py-2 px-4">
                    <p class="text-sm uppercase">February 20, 2018</p>
                </div>
            </div>

            <div class="flex justify-center mb-4">
                <div
                    class="rounded py-2 px-4"
                    style="background-color: #fcf4cb"
                >
                    <p class="text-xs">
                        Messages to this chat is now secured with end-to-end
                        encryption.
                    </p>
                </div>
            </div>
            <div v-for="(messages, key) in $page.props.messages" :key="key">
                <div
                    class="flex mb-2"
                    :class="
                        messages.user_id == $page.props.user.id
                            ? 'justify-end  '
                            : ''
                    "
                >
                    <div
                        :class="
                            messages.user_id == $page.props.user.id
                                ? 'rounded-lg py-2 px-3 text-white bg-green-500'
                                : 'rounded-lg py-2 px-3 bg-white '
                        "
                    >
                        <p class="text-sm font-bold text-teal">
                            {{
                                messages.user.name == $page.props.user.name
                                    ? "You"
                                    : messages.user.name
                            }}
                        </p>
                        <p class="text-sm mt-1">
                            {{ messages.content }}
                        </p>
                        <p class="text-right text-xs text-grey-dark mt-1">
                            {{ date_conversion_from_now(messages.created_at) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
