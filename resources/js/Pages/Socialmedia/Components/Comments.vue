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

onMounted(() => { });
</script>


<template>
    <AppLayout title="Comments">
        <article v-for="iitems in 1 "
            class="mb-4 break-insider w-full  p-6 rounded-xl bg-white dark:bg-slate-800 flex flex-col bg-clip-border  ">
            <div class="flex pb-6 items-cente justify-between">
                <div class="flex">
                    <a class="inline-block mr-4" href="#">
                        <img class="rounded-full max-w-none w-12 h-12"
                            src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-1/263319349_447542383644148_1687301738999888976_n.jpg?stp=dst-jpg_p200x200&_nc_cat=1&ccb=1-7&_nc_sid=c6021c&_nc_eui2=AeHRTyWXz-_3AxPRUiwWh8awl8hrSYTXnPWXyGtJhNec9Y-S8tT3ujsJJWZSymcMBCQg3bQghiO8IuGy5HvvZ7lN&_nc_ohc=co2qDQr2ueEAX9_HYV8&_nc_ht=scontent.fmnl25-4.fna&oh=00_AfAaU3s6WB0_AMniF9I6vVHHbV8VjVEgbHvMhy_W6spt4w&oe=636108D7" />
                    </a>
                    <div class="flex flex-col">
                        <div>
                            <a class="inline-block text-lg font-bold dark:text-white" href="#">Regei
                                Cabug-os</a>
                        </div>
                        <div class="text-slate-500 dark:text-slate-300 dark:text-slate-400">
                            July 17, 2018
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold dark:text-white">
                Web Design templates Selection
            </h2>
            <div class="py-4">
                <div class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 ... ">
                    <a v-for="items in 4" class="flex" href="#">
                        <img class="w-auto "
                            src="https://images.pexels.com/photos/92866/pexels-photo-92866.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />

                    </a>
                </div>

            </div>
            <p class="dark:text-slate-200">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <div class="py-4">
                <a class="inline-flex items-center" href="#">
                    <span class="mr-2">
                        <svg class="fill-rose-600 dark:fill-rose-400" style="width: 24px; height: 24px;"
                            viewBox="0 0 24 24">
                            <path
                                d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z">
                            </path>
                        </svg>
                    </span>
                    <span class="text-lg font-bold">34</span>
                </a>
            </div>
            <div class="w-full">
                <a href="#"
                    class="py-3 px-4 w-full block bg-slate-100 dark:bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition ease-in-out delay-75">Show
                    more comments</a>
            </div>
        </article>
    </AppLayout>
</template>