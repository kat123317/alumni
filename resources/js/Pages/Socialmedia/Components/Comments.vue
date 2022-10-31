<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};
const option_view = ref(true);

onMounted(() => {});
</script>

<template>
    <AppLayout title="Comments">
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
                            d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"
                        />
                    </svg>

                    <span class="mx-2">Comments</span>
                </a>
            </div>
        </div>
        <section class="flex justify-center mt-10">
            <article
                class="mb-4 max-w-7xl break-insider w-full p-6 rounded-xl bg-white dark:bg-slate-800 flex flex-col bg-clip-border"
                v-for="(posts, key) in usePage().props.value.post"
                :key="key"
            >
                <div>
                    <a class="text-lg font-bold float-right relative" href="#"
                        >Edit</a
                    >
                </div>
                <div class="flex pb-6 items-cente justify-between">
                    <div class="flex">
                        <a class="inline-block mr-4" href="#">
                            <img
                                class="rounded-full max-w-none w-12 h-12"
                                src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-1/263319349_447542383644148_1687301738999888976_n.jpg?stp=dst-jpg_p200x200&_nc_cat=1&ccb=1-7&_nc_sid=c6021c&_nc_eui2=AeHRTyWXz-_3AxPRUiwWh8awl8hrSYTXnPWXyGtJhNec9Y-S8tT3ujsJJWZSymcMBCQg3bQghiO8IuGy5HvvZ7lN&_nc_ohc=co2qDQr2ueEAX9_HYV8&_nc_ht=scontent.fmnl25-4.fna&oh=00_AfAaU3s6WB0_AMniF9I6vVHHbV8VjVEgbHvMhy_W6spt4w&oe=636108D7"
                            />
                        </a>
                        <div class="flex flex-col">
                            <div>
                                <a
                                    class="inline-block text-lg font-bold dark:text-white"
                                    href="#"
                                    >Regei Cabug-os</a
                                >
                            </div>
                            <div
                                class="text-slate-500 dark:text-slate-300 dark:text-slate-400"
                            >
                                July 17, 2018
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold dark:text-white">
                    Web Design templates Selection
                </h2>
                <div class="py-4">
                    <div
                        class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 ..."
                    >
                        <a v-for="items in 4" class="flex" href="#">
                            <img
                                class="w-auto"
                                src="https://images.pexels.com/photos/92866/pexels-photo-92866.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                            />
                        </a>
                    </div>
                </div>
                <p class="dark:text-slate-200">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua.
                </p>
                <div class="py-4">
                    <a class="inline-flex items-center" href="#">
                        <span class="mr-2">
                            <svg
                                class="fill-rose-600 dark:fill-rose-400"
                                style="width: 24px; height: 24px"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z"
                                ></path>
                            </svg>
                        </span>
                        <span class="text-lg font-bold">34</span>
                    </a>
                </div>
                <div class="relative">
                    <input
                        class="pt-2 pb-2 pl-3 w-full h-11 bg-slate-100 dark:bg-slate-600 rounded-lg placeholder:text-slate-600 dark:placeholder:text-slate-300 font-medium pr-20"
                        type="text"
                        placeholder="Write a comment"
                    />
                    <span
                        class="flex absolute right-3 top-2/4 -mt-3 items-center"
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
                            class="fill-blue-500 dark:fill-slate-50"
                            style="width: 24px; height: 24px"
                            viewBox="0 0 24 24"
                        >
                            <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
                        </svg>
                    </span>
                </div>

                <div class="pt-6">
                    <div class="media flex pb-4">
                        <a class="inline-block mr-4" href="#">
                            <img
                                class="rounded-full max-w-none w-12 h-12"
                                src="https://randomuser.me/api/portraits/women/76.jpg"
                            />
                        </a>
                        <div class="media-body">
                            <div>
                                <a
                                    class="inline-block text-base font-bold mr-2"
                                    href="#"
                                    >Tina Mills</a
                                >
                                <span class="text-slate-500 dark:text-slate-300"
                                    >3 minutes ago</span
                                >
                            </div>
                            <p>
                                Dolor sit ameteiusmod consectetur adipiscing
                                elit.
                            </p>
                            <div class="mt-2 flex items-center">
                                <a
                                    class="inline-flex items-center py-2 mr-3"
                                    href="#"
                                >
                                    <span class="mr-2">
                                        <svg
                                            class="fill-rose-600 dark:fill-rose-400"
                                            style="width: 22px; height: 22px"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M12.1 18.55L12 18.65L11.89 18.55C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5C9.04 5 10.54 6 11.07 7.36H12.93C13.46 6 14.96 5 16.5 5C18.5 5 20 6.5 20 8.5C20 11.39 16.86 14.24 12.1 18.55M16.5 3C14.76 3 13.09 3.81 12 5.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5C2 12.27 5.4 15.36 10.55 20.03L12 21.35L13.45 20.03C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3Z"
                                            ></path>
                                        </svg>
                                    </span>
                                    <span class="text-base font-bold">0</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </AppLayout>
</template>
