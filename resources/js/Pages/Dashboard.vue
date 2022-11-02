<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
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

const function_add_post = () => {
    if (post_data.content == "") {
        alert("System will not allow empty post, Sorry");
    } else {
        post_data.post(route("socialmedia.store"), {
            preserveScroll: true,
            onSuccess: () => {
                post_data.reset();
                alert("Your content has been posted");
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Dashboard">
        <section>
            <nav class="z-0 w-full rounded-lg">
                <div class="relative z-10 bg-green-800 shadow">
                    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                        <div
                            class="relative flex items-center justify-between h-16"
                        >
                            <div class="flex items-center px-2 lg:px-0">
                                <a class="flex-shrink-0" href="#">
                                    <img
                                        class="block lg:hidden h-12 w-16"
                                        src="https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-facebook_-512.png"
                                        alt="Logo"
                                    />
                                    <img
                                        class="hidden lg:block h-12 w-auto"
                                        src="https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-facebook_-512.png"
                                        alt="Logo"
                                    />
                                </a>
                                <div class="hidden lg:block lg:ml-2">
                                    <div class="flex">
                                        <a
                                            href="#"
                                            class="ml-4 px-3 py-2 text-white rounded-md text-sm leading-5 font-medium font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700"
                                        >
                                            Profie
                                        </a>
                                        <a
                                            href="#"
                                            class="ml-4 px-3 py-2 text-white rounded-md text-sm leading-5 font-medium font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700"
                                        >
                                            Notification
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end"
                            >
                                <div class="max-w-lg w-full lg:max-w-xs">
                                    <label for="search" class="sr-only"
                                        >Search
                                    </label>
                                    <form
                                        methode="get"
                                        action="#"
                                        class="relative z-50"
                                    >
                                        <button
                                            type="submit"
                                            id="searchsubmit"
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                        >
                                            <svg
                                                class="h-5 w-5 text-gray-400"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </button>
                                        <input
                                            type="text"
                                            name="s"
                                            id="s"
                                            class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-yellow-200 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:text-gray-900 sm:text-sm transition duration-150 ease-in-out"
                                            placeholder="Search"
                                        />
                                    </form>
                                </div>
                            </div>
                            <div class="flex lg:hidden">
                                <button
                                    @click="menu = !menu"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                                    aria-label="Main menu"
                                    aria-expanded="false"
                                >
                                    <svg
                                        class="block h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        ></path>
                                    </svg>
                                    <svg
                                        class="hidden h-6 w-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="block md:hidden">
                        <div class="px-2 pt-2 pb-3">
                            <a
                                href="#"
                                class="mt-1 block px-3 py-2 rounded-md text-white font-semibold font-medium hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                >Profile
                            </a>
                            <a
                                href="#"
                                class="mt-1 block px-3 py-2 rounded-md text-white font-semibold font-medium hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                                >Notification
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
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
            <div class="bg-gray-100">
                <div class="container mx-auto my-5 p-5">
                    <div class="md:flex md:-mx-2">
                        <!-- Left Side -->
                        <div class="w-full md:w-3/12 md:mx-2">
                            <!-- Profile Card -->
                            <div
                                class="bg-white p-3 border-t-4 border-green-400"
                            >
                                <div class="image overflow-hidden">
                                    <img
                                        class="h-auto w-full mx-auto"
                                        src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                        alt=""
                                    />
                                </div>
                                <h1
                                    class="text-gray-900 font-bold text-xl leading-8 my-1"
                                >
                                    Jane Doe
                                </h1>
                                <h3
                                    class="text-gray-600 font-lg text-semibold leading-6"
                                >
                                    Owner at Her Company Inc.
                                </h3>
                                <p
                                    class="text-sm text-gray-500 hover:text-gray-600 leading-6"
                                >
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Reprehenderit, eligendi
                                    dolorum sequi illum qui unde aspernatur non
                                    deserunt
                                </p>
                                <ul
                                    class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
                                >
                                    <li class="flex items-center py-3">
                                        <span>Status</span>
                                        <span class="ml-auto"
                                            ><span
                                                class="bg-green-500 py-1 px-2 rounded text-white text-sm"
                                                >Active</span
                                            ></span
                                        >
                                    </li>
                                    <li class="flex items-center py-3">
                                        <span>Member since</span>
                                        <span class="ml-auto"
                                            >Nov 07, 2016</span
                                        >
                                    </li>
                                </ul>
                            </div>
                            <!-- End of profile card -->
                            <div class="my-4"></div>
                            <!-- Friends card -->
                            <div class="bg-white p-3 hover:shadow">
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
                                <div class="grid grid-cols-3">
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
                        <div class="w-full mx-2">
                            <!-- Profile tab -->
                            <!-- About Section -->
                            <div class="bg-white p-3 shadow-sm rounded-sm">
                                <div
                                    class="w-full h-16 flex items-center flex justify-between px-5"
                                >
                                    <img
                                        class="rounded-full w-10 h-10 mr-3"
                                        :src="
                                            usePage().props.value.user
                                                .profile_photo_url
                                        "
                                        alt=""
                                    />
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
                                        <a class="inline-block mr-4" href="#">
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
                                                    href="#"
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
                                    <a
                                        class="inline-flex items-center"
                                        href="#"
                                    >
                                        <span class="mr-2">
                                            <svg
                                                class="fill-rose-600 dark:fill-rose-400"
                                                style="
                                                    width: 24px;
                                                    height: 24px;
                                                "
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z"
                                                ></path>
                                            </svg>
                                            <svg
                                                version="1.1"
                                                id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                x="0px"
                                                y="0px"
                                                viewBox="0 0 512 512"
                                                style="
                                                    enable-background: new 0 0
                                                        512 512;
                                                "
                                                xml:space="preserve"
                                            >
                                                <path
                                                    d="M512,304.021c0-12.821-5.099-24.768-13.867-33.6c9.963-10.901,15.019-25.536,13.632-40.725
                                                                c-2.475-27.115-26.923-48.363-55.616-48.363H324.395c6.485-19.819,16.939-56.149,16.939-85.333c0-46.272-39.317-85.333-64-85.333
                                                                c-22.165,0-38.016,12.459-38.677,12.992c-2.539,2.048-3.989,5.099-3.989,8.341v72.32l-61.44,133.141l-2.56,1.28v-4.075
                                                                c0-5.888-4.779-10.667-10.667-10.667H53.333C23.936,224,0,247.936,0,277.333V448c0,29.397,23.936,53.333,53.333,53.333h64
                                                                c23.083,0,42.773-14.72,50.219-35.243c17.749,9.131,41.643,13.931,56.469,13.931H419.84c23.232,0,43.541-15.68,48.32-37.269
                                                                c2.453-11.115,1.024-22.315-3.84-32.043c15.744-7.936,26.347-24.171,26.347-42.688c0-7.552-1.728-14.784-5.013-21.333
                                                                C501.397,338.752,512,322.517,512,304.021z M149.333,448c0,17.643-14.379,32-32,32h-64c-17.664,0-32-14.357-32-32V277.333
                                                                c0-17.643,14.357-32,32-32v0.107h95.957v10.667c0,0.064,0.043,0.107,0.043,0.171V448z M466.987,330.368
                                                                c-4.117,0.469-7.595,3.264-8.896,7.211c-1.301,3.925-0.235,8.277,2.795,11.115c5.44,5.141,8.427,12.011,8.427,19.349
                                                                c0,13.44-10.155,24.768-23.637,26.304c-4.117,0.469-7.595,3.264-8.896,7.211c-1.301,3.925-0.235,8.277,2.795,11.115
                                                                c7.04,6.635,9.856,15.936,7.744,25.472c-2.624,11.883-14.187,20.523-27.499,20.523H224c-15.851,0-41.365-6.848-53.333-15.744
                                                                V262.656l15.381-7.68c2.155-1.088,3.883-2.88,4.907-5.077l64-138.667c0.64-1.387,0.981-2.923,0.981-4.459V37.909
                                                                c4.437-2.453,12.139-5.803,21.333-5.803c11.691,0,42.667,29.077,42.667,64c0,37.525-20.416,91.669-20.629,92.203
                                                                c-1.237,3.264-0.811,6.955,1.195,9.835c2.005,2.88,5.269,4.608,8.789,4.608h146.795c17.792,0,32.896,12.715,34.389,28.971
                                                                c1.131,12.16-4.672,23.723-15.168,30.187c-3.285,2.005-5.205,5.653-5.056,9.493c0.128,3.84,2.347,7.296,5.781,9.067
                                                                c9.003,4.608,14.592,13.653,14.592,23.595C490.603,317.504,480.448,328.832,466.987,330.368z"
                                                />
                                            </svg>
                                        </span>
                                        <span class="text-lg font-bold">
                                            {{ 100 }}
                                        </span>
                                    </a>
                                </div>
                                <!-- <div>
                                    <div class="pt-6">
                                        <div class="media flex pb-4">
                                            <a
                                                class="inline-block mr-4"
                                                href="#"
                                            >
                                                <img
                                                    class="rounded-full max-w-none w-12 h-12"
                                                    :src="
                                                        posts.comments_custom
                                                            .user == null
                                                            ? posts
                                                                  .comments_custom
                                                                  .user
                                                                  .profile_photo_url
                                                            : 'http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png'
                                                    "
                                                />
                                            </a>
                                            <div class="media-body">
                                                <div>
                                                    <a
                                                        class="inline-block text-base font-bold mr-2"
                                                        href="#"
                                                        >{{
                                                            posts
                                                                .comments_custom
                                                                .user.name
                                                        }}</a
                                                    >
                                                    <span
                                                        class="text-slate-500"
                                                        >{{
                                                            date_conversion_from_now(
                                                                posts
                                                                    .comments_custom
                                                                    .created_at
                                                            )
                                                        }}</span
                                                    >
                                                </div>
                                                <p>
                                                    <i>{{
                                                        posts.comments_custom
                                                            .content
                                                    }}</i>
                                                </p>
                                                <div
                                                    class="mt-2 flex items-center"
                                                >
                                                    <a
                                                        class="inline-flex items-center py-2 mr-3"
                                                        href="#"
                                                    >
                                                        <span class="mr-2">
                                                            <svg
                                                                class="fill-rose-600"
                                                                style="
                                                                    width: 22px;
                                                                    height: 22px;
                                                                "
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    d="M12.1 18.55L12 18.65L11.89 18.55C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5C9.04 5 10.54 6 11.07 7.36H12.93C13.46 6 14.96 5 16.5 5C18.5 5 20 6.5 20 8.5C20 11.39 16.86 14.24 12.1 18.55M16.5 3C14.76 3 13.09 3.81 12 5.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5C2 12.27 5.4 15.36 10.55 20.03L12 21.35L13.45 20.03C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3Z"
                                                                ></path>
                                                            </svg>
                                                        </span>
                                                        <span
                                                            class="text-base font-bold"
                                                            >0</span
                                                        >
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

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
