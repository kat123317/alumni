<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./emptypost.vue";
import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};
const date_conversion2 = (value) => {
    if (value) {
        return moment(value).format("h:mm:ss");
    }
};
</script>

<template>
    <AppLayout title="UserProfile">
        <div class="bg-gray-200">
            <div
                class="container flex items-center px-6 py-4 mx-auto overflow-y-auto whitespace-nowrap"
            >
                <a href="#" class="text-gray-600">
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

                <span class="mx-5 text-gray-500 rtl:-scale-x-100">
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
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                        />
                    </svg>

                    <span class="mx-2">Home</span>
                </a>
                <span class="mx-5 text-gray-500 rtl:-scale-x-100">
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
                    class="flex items-center text-green-600 -px-2 hover:underline"
                >
                    <span class="mx-2">
                        {{ usePage().props.value.user_profile[0].name }}</span
                    >
                </a>
            </div>
        </div>

        <!-- component -->

        <div
            style="
                background: url('https://www.cmu.edu.ph/wp-content/uploads/2022/05/1new-cmubanner-1045x218-1.jpg');
                background-repeat: no-repeat;
                background-size: contain;
            "
            class="bg-gray-800 font-sans pt-[30vmin] lg:pt-0 lg:h-[50vmin] w-full flex flex-row justify-center items-center"
        >
            <div
                class="card w-96 mx-auto bg-white rounded-lg shadow-xl hover:shadow"
            >
                <img
                    class="w-32 mx-auto rounded-full -mt-20 border-8 border-white"
                    :src="
                        usePage().props.value.user_profile[0].profile_photo_url
                    "
                    alt=""
                />
                <div class="text-center mt-2 text-3xl font-medium">
                    {{ usePage().props.value.user_profile[0].name }}
                </div>
                <div class="text-center mt-2 font-light text-sm">
                    @
                    {{ usePage().props.value.user_profile[0].details.nickname }}
                </div>
                <div class="text-center font-normal text-lg">
                    {{ usePage().props.value.user_profile[0].details.nickname }}
                </div>
                <div class="px-6 text-center mt-2 font-light text-sm">
                    <p>
                        {{
                            usePage().props.value.user_profile[0].details.motto
                        }}
                    </p>
                </div>
                <hr class="mt-8" />
                <div class="flex p-4">
                    <div class="w-full text-center">
                        <span class="font-bold">
                            {{
                                usePage().props.value.user_profile[0].posts
                                    .length
                            }}</span
                        >
                        Posts
                    </div>
                </div>
            </div>
        </div>
        <h2 class="flex flex-row flex-nowrap items-center my-8">
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
            <span
                class="flex-none block mx-4 px-4 py-2.5 text-xs leading-none font-medium uppercase bg-green-700 rounded-lg text-white"
            >
                Your Posts
            </span>
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
        </h2>
        <NoPostsYet v-if="usePage().props.value.user_posts[0].length == 0" />
        <div class="w-full px-2 lg:px-10 grid grid-cols-1 lg:grid-cols-3 gap-3">
            <article
                v-for="(posts, key) in usePage().props.value.user_posts"
                :key="key"
                class="mb-4 w-full break-inside p-6 rounded-xl bg-white"
            >
                <div class="flex pb-6 items-center justify-between">
                    <div class="flex">
                        <a class="inline-block mr-4" href="#">
                            <img
                                class="rounded-full max-w-none w-12 h-12"
                                :src="posts.user.profile_photo_url"
                            />
                        </a>
                        <div class="flex flex-col">
                            <div>
                                <a class="inline-block text-lg font-bold">
                                    {{ posts.user.name }}</a
                                >
                            </div>
                            <div class="text-slate-500">
                                {{ date_conversion(posts.created_at) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="py-4">
                        <div class="flex justify-between gap-1 mb-1">
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-tl-lg"
                                    src="https://images.pexels.com/photos/92866/pexels-photo-92866.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full"
                                    src="https://images.pexels.com/photos/247929/pexels-photo-247929.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-tr-lg"
                                    src="https://images.pexels.com/photos/631522/pexels-photo-631522.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                        </div>
                        <div class="flex justify-between gap-1">
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-bl-lg"
                                    src="https://images.pexels.com/photos/1429748/pexels-photo-1429748.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-br-lg"
                                    src="https://images.pexels.com/photos/69020/pexels-photo-69020.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                        </div>
                    </div> -->
                <p class="">
                    {{ posts.content }}
                </p>
                <!-- <div class="py-4">
                        <a class="inline-flex items-center" href="#">
                            <span class="mr-2">
                                <svg class="fill-rose-600 dark:fill-rose-400" style="width: 24px; height: 24px"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z">
                                    </path>
                                </svg>
                            </span>
                            <span class="text-lg font-bold">34</span>
                        </a>
                    </div> -->
                <h2 class="mt-4 border-t font-bold">Comments</h2>
                <div class="max-h-[70vmin] lg:max-h-[25vmin] overflow-hidden">
                    <div
                        v-for="(commentsData, key2) in posts.comments"
                        :key="key2"
                        class="flex bg-white rounded-lg mx-4 md:mx-auto max-w-md md:max-w-2xl"
                    >
                        <!--horizantil margin is just for display-->
                        <div class="flex items-start px-4 py-6">
                            <img
                                class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                                :src="commentsData.user.profile_photo_url"
                                alt="avatar"
                            />
                            <div class="">
                                <div class="flex items-center justify-between">
                                    <h2
                                        class="text-lg font-semibold text-gray-900 -mt-1"
                                    >
                                        {{ commentsData.user.name }}
                                    </h2>
                                </div>
                                <small class="text-gray-700"
                                    >Commented
                                    {{
                                        date_conversion2(
                                            commentsData.updated_at
                                        )
                                    }}
                                </small>
                                <p class="mt-3 text-gray-700 text-lg">
                                    {{ commentsData.content }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Comments content -->
                <div class="pt-6 flex items-end">
                    <div class="w-full">
                        <a
                            :href="route('socialmedia.comments', [posts.id])"
                            class="py-3 px-4 w-full block bg-slate-100 text-center rounded-lg font-medium hover:bg-slate-200 transition ease-in-out delay-75"
                            >Show more comments
                            <kbd
                                class="px-2 py-1.5 text-xs font-semibold text-white bg-green-800 border border-green-200 rounded-lg"
                                >{{ posts.comments.length }}</kbd
                            ></a
                        >
                    </div>
                </div>
            </article>
        </div>
    </AppLayout>
</template>

<style></style>
