<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./Socialmedia/Components/emptypost.vue";
import moment from "moment";

// Alert Function
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

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};

const only_date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY");
    }
};

const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};

const option_view = ref(true);

onMounted(() => {});

const post_data = useForm({
    content: "",
});

const open_notif_data = useForm({
    id: "",
    is_read: 1,
});

const function_add_post = () => {
    if (post_data.content == "") {
        errorAlert("System will not allow empty post, Sorry");
    } else {
        post_data.post(route("socialmedia.store"), {
            preserveScroll: true,
            onSuccess: () => {
                post_data.reset();
                errorAlert("Your content has been posted");
            },
        });
    }
};

const function_open_notif = (id, notif_id) => {
    open_notif_data.id = id;
    open_notif_data.post(route("socialmedia.open_notif", [notif_id]), {
        preserveScroll: true,
        onSuccess: () => {
            open_notif_data.reset();
        },
    });
};

const like_data = useForm({
    post_id: null,
});
const function_like_post = (index) => {
    let post = usePage().props.value.posts[index];
    let pkey = post.details.like.indexOf(usePage().props.value.user.name);
    like_data.post_id = post.id;
    if (pkey == -1) {
        like_data.post(route("socialmedia.like_post", [post.id]), {
            preserveScroll: true,
            onSuccess: () => {
                like_data.reset();
            },
        });
    } else {
        like_data.post(route("socialmedia.unlike_post", [post.id]), {
            preserveScroll: true,
            onSuccess: () => {
                like_data.reset();
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Dashboard">
        <section>
            <div class="bg-gray-200 dark:bg-gray-800">
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
                        class="flex items-center text-gray-600 -px-2 dark:text-gray-200 hover:underline"
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
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                            />
                        </svg>

                        <span class="mx-2">Home</span>
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
                    <h3 class="text-lg font-medium text-blue-900">
                        Notification
                    </h3>
                </div>
                <div class="mt-2 text-center mb-4 text-sm text-blue-900">
                    {{ postAlert }}
                </div>
                <div class="flex justify-center">
                    <button
                        type="button"
                        @click="postAlert = ''"
                        class="text-blue-900 bg-transparent border border-blue-900 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:border-blue-800 dark:text-blue-800 dark:hover:text-white"
                        data-dismiss-target="#alert-additional-content-1"
                        aria-label="Close"
                    >
                        Dismiss
                    </button>
                </div>
            </div>

            <div class="bg-gray-100">
                <div class="container mx-auto my-5 p-5">
                    <div class="md:flex md:-mx-2">
                        <!-- Left Side -->
                        <div class="lg:block w-full md:w-3/12 md:mx-2">
                            <!-- Profile Card -->
                            <div
                                class="bg-white p-3 border-t-4 border-green-400"
                            >
                                <div class="image overflow-hidden">
                                    <img
                                        class="h-auto rounded-lg w-full mx-auto"
                                        :src="
                                            usePage().props.value.user
                                                .profile_photo_url
                                        "
                                        alt=""
                                    />
                                </div>
                                <h1
                                    class="text-gray-900 font-bold text-xl leading-8 my-1"
                                >
                                    <a
                                        :href="
                                            route('socialmedia.user_profile', [
                                                usePage().props.value.user.id,
                                            ])
                                        "
                                    >
                                        {{ usePage().props.value.user.name }}({{
                                            usePage().props.value.user.details
                                                .nickname
                                        }})
                                    </a>
                                </h1>
                                <h3
                                    class="text-gray-600 font-lg text-semibold leading-6"
                                >
                                    {{
                                        usePage().props.value.user.details
                                            .current_work
                                    }}
                                </h3>
                                <p
                                    class="text-sm text-gray-500 hover:text-gray-600 leading-6"
                                >
                                    <i>
                                        {{
                                            usePage().props.value.user.details
                                                .motto
                                        }}
                                    </i>
                                </p>
                                <ul
                                    class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
                                >
                                    <li class="flex p-2 items-center py-3">
                                        <span>Status</span>
                                        <span class="ml-auto"
                                            ><span
                                                class="bg-green-500 py-1 px-2 rounded text-white text-sm"
                                                >{{
                                                    usePage().props.value.user
                                                        .is_active == 1
                                                        ? "Active"
                                                        : "Deactivated"
                                                }}</span
                                            ></span
                                        >
                                    </li>
                                    <li
                                        @click="
                                            notificationTrigger =
                                                !notificationTrigger
                                        "
                                        class="flex hover:bg-blue-800 hover:text-white p-2 cursor-pointer rounded items-center py-3"
                                    >
                                        <span>Notifications</span>
                                        <span class="ml-auto"
                                            ><span
                                                class="bg-blue-500 animate-pulse py-1 px-2 rounded-full text-white text-sm"
                                                >{{
                                                    usePage().props.value
                                                        .user_notification
                                                        .length
                                                }}</span
                                            ></span
                                        >
                                    </li>

                                    <div
                                        v-if="notificationTrigger"
                                        class="z-20 relative w-full max-w-sm bg-white rounded divide-y divide-gray-100 shadow"
                                        aria-labelledby="dropdownNotificationButton"
                                        data-popper-reference-hidden=""
                                        data-popper-escaped=""
                                        data-popper-placement="bottom"
                                    >
                                        <div
                                            class="block py-2 px-4 font-medium text-center text-gray-700 bg-gray-50"
                                        >
                                            Notifications
                                        </div>
                                        <div
                                            class="divide-y max-h-[70vmin] lg:max-h-[20vmin] overflow-hidden overflow-y-auto divide-gray-100"
                                        >
                                            <a
                                                @click="
                                                    function_open_notif(
                                                        user_notification
                                                            .details.post_id,
                                                        user_notification.id
                                                    )
                                                "
                                                v-for="(
                                                    user_notification, key
                                                ) in usePage().props.value
                                                    .user_notification"
                                                :key="key"
                                                class="flex py-3 px-4 hover:bg-gray-100"
                                            >
                                                <div class="flex-shrink-0">
                                                    <img
                                                        class="w-11 h-11 rounded-full"
                                                        :src="
                                                            user_notification
                                                                .user
                                                                .profile_photo_url
                                                        "
                                                        alt="Jese image"
                                                    />
                                                </div>
                                                <div class="pl-3 w-full">
                                                    <div
                                                        class="text-gray-500 text-sm mb-1.5"
                                                    >
                                                        New message from
                                                        <span
                                                            class="font-semibold text-gray-900"
                                                            >{{
                                                                user_notification
                                                                    .user.name
                                                            }}</span
                                                        >: "{{
                                                            user_notification.title
                                                        }}"
                                                        <p>
                                                            {{
                                                                user_notification.content
                                                            }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="text-xs text-blue-600"
                                                    >
                                                        {{
                                                            date_conversion_from_now(
                                                                user_notification.created_at
                                                            )
                                                        }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a
                                            href="#"
                                            class="block py-2 text-sm font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white"
                                        >
                                            <div
                                                class="inline-flex items-center"
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
                                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                                                    />
                                                </svg>

                                                Hide Notification
                                            </div>
                                        </a>
                                    </div>

                                    <li class="flex p-2 items-center py-3">
                                        <span>Member since</span>
                                        <span class="ml-auto">{{
                                            only_date_conversion(
                                                usePage().props.value.user
                                                    .created_at
                                            )
                                        }}</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Dropdown menu -->

                            <!-- End of profile card -->
                            <div class="my-4"></div>
                            <!-- Friends card -->
                            <div class="bg-white mb-5 p-3 hover:shadow">
                                <div
                                    class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8"
                                >
                                    <span class="text-green-500">
                                        <svg
                                            class="h-5 fill-current"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                            />
                                        </svg>
                                    </span>
                                    <span>Online</span>
                                </div>
                                <div class="grid mb-25 grid-cols-3">
                                    <div class="text-center my-2">
                                        <img
                                            class="h-16 w-16 rounded-full mx-auto"
                                            src="https://cdn.australianageingagenda.com.au/wp-content/uploads/2015/06/28085920/Phil-Beckett-2-e1435107243361.jpg"
                                            alt=""
                                        />
                                        <a href="#" class="text-main-color"
                                            >Kojstantin</a
                                        >
                                    </div>
                                    <div class="text-center my-2">
                                        <img
                                            class="h-16 w-16 rounded-full mx-auto"
                                            src="https://avatars2.githubusercontent.com/u/24622175?s=60&amp;v=4"
                                            alt=""
                                        />
                                        <a href="#" class="text-main-color"
                                            >James</a
                                        >
                                    </div>

                                    <div class="text-center my-2">
                                        <img
                                            class="h-16 w-16 rounded-full mx-auto"
                                            src="https://bucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com/public/images/f04b52da-12f2-449f-b90c-5e4d5e2b1469_361x361.png"
                                            alt=""
                                        />
                                        <a href="#" class="text-main-color"
                                            >Casey</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- End of friends card -->
                        </div>
                        <!-- Right Side -->
                        <div class="w-full">
                            <!-- Profile tab -->
                            <!-- About Section -->
                            <div class="bg-white p-3 shadow-sm rounded-sm">
                                <div
                                    class="w-full h-16 flex items-center flex justify-between px-5"
                                >
                                    <a
                                        :href="
                                            route('socialmedia.user_profile', [
                                                usePage().props.value.user.id,
                                            ])
                                        "
                                    >
                                        <img
                                            class="rounded-full w-10 h-10 mr-3"
                                            :src="
                                                usePage().props.value.user
                                                    .profile_photo_url
                                            "
                                            alt=""
                                        />
                                    </a>
                                    <input
                                        v-model="post_data.content"
                                        type="text"
                                        class="w-full rounded-full h-10 bg-gray-200 px-5"
                                        placeholder="What's on your mind?"
                                    />
                                </div>
                                <div
                                    class="w-full h-10 flex justify-between mt-4 px-3 md:px-10 lg:px-24 xl:px-5"
                                >
                                    <button class="flex h-full items-center">
                                        <svg
                                            class="h-12 text-green-500 stroke-current"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="27"
                                            height="27"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="#b0b0b0"
                                            stroke-width="2"
                                            stroke-linecap="square"
                                            stroke-linejoin="round"
                                        >
                                            <rect
                                                x="3"
                                                y="3"
                                                width="18"
                                                height="18"
                                                rx="2"
                                            />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <path d="M20.4 14.5L16 10 4 20" />
                                        </svg>
                                        <span
                                            class="text-xs lg:text-md mx-2 font-semibold text-gray-500"
                                            >Upload Photo
                                        </span>
                                    </button>
                                    <button
                                        @click="function_add_post()"
                                        type="button"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                    >
                                        Post
                                        <svg
                                            aria-hidden="true"
                                            class="ml-2 -mr-1 w-5 h-5"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- End of about section -->
                            <NoPostsYet
                                v-if="usePage().props.value.posts.length == 0"
                            />
                            <div class="my-4"></div>

                            <article
                                v-for="(posts, key) in usePage().props.value
                                    .posts"
                                :key="key"
                                class="mb-4 break-insider w-full p-6 rounded-xl bg-white flex flex-col bg-clip-border"
                            >
                                <div
                                    class="flex pb-6 items-center justify-between"
                                >
                                    <div class="flex">
                                        <a
                                            class="inline-block mr-4"
                                            :href="
                                                route(
                                                    'socialmedia.user_profile',
                                                    [posts.user.id]
                                                )
                                            "
                                        >
                                            <img
                                                class="rounded-full max-w-none w-12 h-12"
                                                :src="
                                                    posts.user.profile_photo_url
                                                "
                                            />
                                        </a>
                                        <div class="flex flex-col">
                                            <div>
                                                <a
                                                    class="inline-block text-lg font-bold"
                                                    :href="
                                                        route(
                                                            'socialmedia.user_profile',
                                                            [posts.user.id]
                                                        )
                                                    "
                                                    >{{ posts.user.name }}</a
                                                >
                                            </div>
                                            <div class="text-slate-500">
                                                {{
                                                    date_conversion(
                                                        posts.created_at
                                                    )
                                                }}
                                            </div>
                                            <div class="text-slate-500">
                                                {{
                                                    date_conversion_from_now(
                                                        posts.created_at
                                                    )
                                                }}
                                                <!-- if the content is liked -->
                                                <kbd
                                                    class="px-2 ml-2 py-1.5 text-xs font-semibold text-white bg-blue-700 border border-gray-200 rounded-lg"
                                                    >Liked</kbd
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p>
                                    {{ posts.content }}
                                </p>
                                <div class="py-4">
                                    <div
                                        class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 ..."
                                    >
                                        <a
                                            class="flex"
                                            href="#"
                                            v-for="(photos, key) in posts.photo"
                                            :key="key"
                                        >
                                            <img class="w-auto" :src="photos" />
                                        </a>
                                    </div>
                                </div>
                                <div class="py-4">
                                    <div
                                        @click="function_like_post(key)"
                                        class="inline-flex items-center"
                                    >
                                        <button
                                            type="button"
                                            class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
                                            :title="posts.details.like"
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

                                            {{ posts.details.like.length }}
                                        </button>
                                    </div>
                                </div>
                                <h2 class="mt-4 border-t font-bold">
                                    Comments
                                </h2>
                                <div
                                    v-for="(
                                        commentsData, key2
                                    ) in posts.comments_custom"
                                    :key="key2"
                                    class="flex bg-white rounded-lg mx-4 md:mx-auto max-w-md md:max-w-2xl"
                                >
                                    <div class="flex items-start px-4 py-6">
                                        <img
                                            class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                                            :src="
                                                commentsData.user
                                                    .profile_photo_url
                                            "
                                            alt="avatar"
                                        />
                                        <div class="">
                                            <div
                                                class="flex items-center justify-between"
                                            >
                                                <h2
                                                    class="text-lg font-semibold text-gray-900 -mt-1"
                                                >
                                                    {{ commentsData.user.name }}
                                                </h2>
                                                <small
                                                    class="ml-2 text-sm text-gray-700"
                                                    >{{
                                                        date_conversion(
                                                            commentsData.created_at
                                                        )
                                                    }}</small
                                                >
                                            </div>
                                            <p class="text-gray-700">
                                                <small>
                                                    Updated
                                                    {{
                                                        date_conversion(
                                                            commentsData.updated_at
                                                        )
                                                    }}
                                                </small>
                                            </p>
                                            <p
                                                class="mt-3 text-gray-700 text-sm"
                                            >
                                                {{ commentsData.content }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <a
                                        :href="
                                            route('socialmedia.comments', [
                                                posts.id,
                                            ])
                                        "
                                        class="py-3 px-4 w-full block bg-slate-100 text-center rounded-lg font-medium hover:bg-slate-200 transition ease-in-out delay-75"
                                        >Show more comments</a
                                    >
                                </div>
                            </article>
                            <div class="flex justify-center">
                                <small>End of Posts</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style>
/* width */
::-webkit-scrollbar {
    width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
