<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

import moment from "moment";

const modal_update_comment = ref(false);
const modal_update_post = ref(false);
const modal_delete_comment = ref(false);
const modal_delete_post = ref(false);
const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};

const postAlert = ref("");
const notificationTrigger = ref(false);

const errorAlert = (data) => {
    if (data) {
        postAlert.value = data;
        setTimeout(() => {
            postAlert.value = "";
        }, 3000);
    }
};

const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};
const option_view = ref(true);

onMounted(() => {});

const comment_data = useForm({
    comment: "",
    post_id: usePage().props.value.post[0].id,
    post_owner: usePage().props.value.post[0].user.id,
});

const post_update_data = useForm({
    content: usePage().props.value.post[0].content,
    id: usePage().props.value.post[0].id,
});

const comment_delete_post_data = useForm({
    id: usePage().props.value.post[0].id,
});

const comment_update_data = useForm({
    comment: "",
    id: "",
    post_id: usePage().props.value.post[0].id,
    post_owner: usePage().props.value.post[0].user.id,
});

const comment_delete_data = useForm({
    id: "",
});

const function_open_update_post_modal = () => {
    modal_update_post.value = !modal_update_post.value;
};

const function_open_delete_post_modal = () => {
    modal_delete_post.value = !modal_delete_post.value;
};

const function_update_post = () => {
    if (post_update_data.content == "") {
        errorAlert("System will not allow empty posts");
    } else {
        post_update_data.post(
            route("socialmedia.update_post", [post_update_data.id]),
            {
                preserveScroll: true,
                onSuccess: () => {
                    post_update_data.reset();
                    modal_update_post.value = !modal_update_post.value;
                },
            }
        );
    }
};

const function_delete_post = () => {
    comment_delete_post_data.delete(
        route("socialmedia.delete_post", [comment_delete_post_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {},
        }
    );
};

const function_comment = () => {
    if (comment_data.comment == "") {
        errorAlert("System will not allow empty comment, Thank you");
    } else {
        comment_data.post(route("socialmedia.add_comment"), {
            preserveScroll: true,
            onSuccess: () => {
                comment_data.reset();
            },
        });
    }
};

const function_open_update_modal = (id, content) => {
    comment_update_data.id = id;
    comment_update_data.comment = content;
    modal_update_comment.value = !modal_update_comment.value;
};

const function_update_comment = () => {
    comment_update_data.post(
        route("socialmedia.update_comment", [comment_update_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                comment_update_data.reset();
                modal_update_comment.value = !modal_update_comment.value;
            },
        }
    );
};

const function_open_delete_modal = (id) => {
    comment_delete_data.id = id;
    modal_delete_comment.value = !modal_delete_comment.value;
};

const function_delete_comment = () => {
    comment_delete_data.delete(
        route("socialmedia.delete_comment", [comment_delete_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                comment_delete_data.reset();
                modal_delete_comment.value = !modal_delete_comment.value;
            },
        }
    );
};

const like_data = useForm({
    post_id: null,
});
const function_like_post = (post_id, is_like) => {
    // let post = usePage().props.value.posts[index];
    // let pkey = post.details.like.indexOf(usePage().props.value.user.id);
    like_data.post_id = post_id;
    if (is_like) {
        like_data.post(route("socialmedia.unlike_post", [post_id]), {
            preserveScroll: true,
            onSuccess: () => {
                like_data.reset();
            },
        });
    } else {
        like_data.post(route("socialmedia.like_post", [post_id]), {
            preserveScroll: true,
            onSuccess: () => {
                like_data.reset();
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Comments">
        <div class="bg-gray-200">
            <div
                class="container flex items-center px-6 py-4 mx-auto overflow-y-auto whitespace-nowrap"
            >
                <a href="#" class="text-gray-600 dark:text-gray-200">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                        />
                    </svg>
                </a>

                <span
                    class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </span>

                <a
                    href="#"
                    class="flex items-center text-gray-600 -px-2 hover:underline"
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
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"
                        />
                    </svg>

                    <span class="mx-2">Comments</span>
                </a>
            </div>
        </div>
        <div
            v-if="postAlert"
            class="p-4 mb-4 border border-blue-300 rounded-lg bg-blue-50 dark:bg-blue-300"
            role="alert"
        >
            <div class="flex justify-center items-center">
                <svg
                    aria-hidden="true"
                    class="w-5 h-5 mr-2 text-blue-900"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span class="sr-only">Notification</span>
                <h3 class="text-lg font-medium text-blue-900">Notification</h3>
            </div>
            <div class="mt-2 text-center mb-4 text-sm text-blue-900">
                {{ postAlert }}
            </div>
            <div class="flex justify-center">
                <button
                    type="button"
                    @click="postAlert = ''"
                    class="text-blue-900 bg-transparent border border-blue-900 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
                    data-dismiss-target="#alert-additional-content-1"
                    aria-label="Close"
                >
                    Dismiss
                </button>
            </div>
        </div>
        <section class="flex justify-center px-5 mt-10">
            <article
                class="mb-4 max-w-7xl break-insider w-full p-6 rounded-xl bg-white flex flex-col bg-clip-border"
                v-for="(post, key) in usePage().props.value.post"
                :key="key"
            >
                <div class="flex pb-6 items-cente justify-between">
                    <div class="flex">
                        <a
                            class="inline-block mr-4"
                            :href="
                                route('socialmedia.user_profile', [
                                    usePage().props.value.post[0].user.id,
                                ])
                            "
                        >
                            <img
                                class="rounded-full max-w-none w-12 h-12"
                                :src="post.user.profile_photo_url"
                            />
                        </a>
                        <div class="flex flex-col">
                            <div>
                                <a
                                    class="inline-block text-lg font-bold"
                                    :href="
                                        route('socialmedia.user_profile', [
                                            usePage().props.value.post[0].user
                                                .id,
                                        ])
                                    "
                                    >{{ post.user.name }}</a
                                >
                            </div>
                            <div class="text-slate-500">
                                {{ date_conversion(post.created_at) }}
                            </div>
                            <div class="text-slate-500">
                                {{ date_conversion_from_now(post.created_at) }}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <a
                            v-if="post.user.id == usePage().props.value.user.id"
                            @click="function_open_update_post_modal()"
                            class="text-lg flex font-bold float-right relative"
                            href="#"
                            title="Update your post"
                            ><svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    class="text-blue-800"
                                    stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                />
                            </svg>
                        </a>

                        <a
                            v-if="post.user.id == usePage().props.value.user.id"
                            @click="function_open_delete_post_modal()"
                            class="text-lg font-bold float-right relative flex mr-4"
                            href="#"
                            title="Delete your post"
                            ><svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="text-red-500"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
                <p class="">
                    {{ post.content }}
                </p>
                <div class="py-4">
                    <div
                        class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 ..."
                    >
                        <a
                            v-for="(photos, key) in post.photo"
                            :key="key"
                            class="flex"
                            href="#"
                        >
                            <img class="w-auto" :src="photos" />
                        </a>
                    </div>
                </div>

                <div class="py-4">
                    <div
                        @click="
                            function_like_post(
                                post.id,
                                post.details.like
                                    .map((res) => res.id)
                                    .includes(usePage().props.value.user.id)
                            )
                        "
                        class="inline-flex items-center"
                    >
                        <button
                            type="button"
                            :class="
                                !post.details.like
                                    .map((res) => res.id)
                                    .includes(usePage().props.value.user.id)
                                    ? 'text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2'
                                    : 'text-white border border-blue-700 bg-blue-800 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2'
                            "
                            :title="post.details.like.map((res) => res.name)"
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
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z"
                                />
                            </svg>

                            {{ post.details.like.length }}
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <input
                        v-model="comment_data.comment"
                        class="pt-2 pb-2 pl-3 w-full h-11 bg-slate-100 rounded-lg placeholder:text-slate-600 font-medium pr-20"
                        type="text"
                        placeholder="Write a comment"
                        required
                    />
                    <button
                        class="flex absolute right-3 top-2/4 -mt-3 items-center"
                        @click="function_comment()"
                    >
                        <svg
                            class="mr-2"
                            style="width: 26px; height: 26px"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="currentColor"
                                d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z"
                            ></path>
                        </svg>
                        <svg
                            class="fill-blue-500"
                            style="width: 24px; height: 24px"
                            viewBox="0 0 24 24"
                        >
                            <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
                        </svg>
                    </button>
                </div>

                <div v-for="(comments, key) in post.comments" :key="key">
                    <div class="pt-6">
                        <div class="media flex pb-4">
                            <a class="inline-block mr-4" href="#">
                                <img
                                    class="rounded-full max-w-none w-12 h-12"
                                    :src="comments.user.profile_photo_url"
                                />
                            </a>
                            <div class="media-body">
                                <div>
                                    <a
                                        class="inline-block text-base font-bold mr-2"
                                        href="#"
                                        >{{ comments.user.name }}</a
                                    >
                                    <span class="text-slate-500">{{
                                        date_conversion_from_now(
                                            comments.created_at
                                        )
                                    }}</span>
                                    <button
                                        v-if="
                                            comments.user.id ==
                                            usePage().props.value.user.id
                                        "
                                        @click="
                                            function_open_update_modal(
                                                comments.id,
                                                comments.content
                                            )
                                        "
                                        class="inline-block ml-6"
                                        title="Update your comment"
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
                                                stroke-linecap="round"
                                                class="text-blue-800"
                                                stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                            />
                                        </svg>
                                    </button>
                                    <button
                                        v-if="
                                            comments.user.id ==
                                            usePage().props.value.user.id
                                        "
                                        @click="
                                            function_open_delete_modal(
                                                comments.id
                                            )
                                        "
                                        class="inline-block ml-2"
                                        title="Delete your comment"
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
                                                class="text-red-500"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <p>
                                    {{ comments.content }}
                                </p>
                                <!-- <div class="mt-2 flex items-center">
                                    <a
                                        class="inline-flex items-center"
                                        href="#"
                                    >
                                        <button
                                            type="button"
                                            class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
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
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z"
                                                />
                                            </svg>

                                            {{ 0 }}
                                        </button>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <div v-if="modal_update_post" class=" ">
                <div
                    id="popup-modal"
                    tabindex="-1"
                    class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                >
                    <div
                        class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto"
                    >
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label
                                        for="post"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                        >Your content</label
                                    >
                                    <textarea
                                        v-model="post_update_data.content"
                                        id="post"
                                        rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Your content..."
                                        required
                                    ></textarea>
                                </div>
                            </div>
                            <button
                                @click="function_open_update_post_modal()"
                                type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="popup-modal"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <h3
                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                >
                                    Are you sure you want to update your post?
                                </h3>
                                <button
                                    @click="function_update_post()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_open_update_post_modal()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                >
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="modal_update_comment" class=" ">
                <div
                    id="popup-modal"
                    tabindex="-1"
                    class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                >
                    <div
                        class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto"
                    >
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label
                                        for="content"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                        >Your content</label
                                    >
                                    <textarea
                                        v-model="comment_update_data.comment"
                                        id="content"
                                        rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Your content..."
                                        required
                                    ></textarea>
                                </div>
                            </div>
                            <button
                                @click="function_open_update_modal()"
                                type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="popup-modal"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <h3
                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                >
                                    Are you sure you want to update your
                                    comment?
                                </h3>
                                <button
                                    @click="function_update_comment()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_open_update_modal()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                >
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="modal_delete_comment">
                <div
                    id="popup-modal"
                    tabindex="-1"
                    class="overflow-y-auto flex justify-center backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                >
                    <div
                        class="relative p-4 animate w-full max-w-md h-full mt-[20vmin] transition ease-in-out md:h-auto"
                    >
                        <div class="relative bg-white rounded-lg shadow">
                            <button
                                @click="function_open_delete_modal()"
                                type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="popup-modal"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <h3
                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                >
                                    Are you sure you want to delete this
                                    comment?
                                </h3>
                                <button
                                    @click="function_delete_comment()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_open_delete_modal()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                >
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="modal_delete_post">
                <div
                    id="popup-modal"
                    tabindex="-1"
                    class="overflow-y-auto flex justify-center backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                >
                    <div
                        class="relative p-4 animate w-full max-w-md h-full mt-[20vmin] transition ease-in-out md:h-auto"
                    >
                        <div class="relative bg-white rounded-lg shadow">
                            <button
                                @click="function_open_delete_post_modal()"
                                type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="popup-modal"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <h3
                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                >
                                    Are you sure you want to delete this post?
                                </h3>
                                <button
                                    @click="function_delete_post()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_open_delete_post_modal()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                >
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
