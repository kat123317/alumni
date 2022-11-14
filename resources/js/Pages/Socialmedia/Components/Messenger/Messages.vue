<script setup>
import moment from "moment";
const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};
</script>
<template>
    <div class="flex-1 overflow-auto" style="background-color: #dad3cc">
        <div class="py-2 px-3">
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
                        Messages to this chat and calls are now secured with
                        end-to-end encryption. Tap for more info.
                    </p>
                </div>
            </div>
            <template
                v-for="(messages, key) in $page.props.messages"
                :key="key"
            >
                <div
                    class="flex mb-2"
                    :class="
                        messages.user_id == $page.props.user.id
                            ? 'justify-end'
                            : ''
                    "
                >
                    <div
                        class="rounded py-2 px-3"
                        style="background-color: #f2f2f2"
                    >
                        <p class="text-sm text-teal">
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
            </template>
        </div>
    </div>
</template>
