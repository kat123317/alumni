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
const option_view = ref(true);

onMounted(() => { });
</script>

<template>
    <AppLayout title="Dashboard">
        <section>
            <nav class="z-0   w-full rounded-lg  ">
                <div class="relative z-10  bg-green-800 shadow">
                    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                        <div class="relative flex items-center justify-between h-16">
                            <div class="flex items-center px-2 lg:px-0">
                                <a class="flex-shrink-0" href="#">
                                    <img class="block lg:hidden h-12 w-16"
                                        src="https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-facebook_-512.png"
                                        alt="Logo">
                                    <img class="hidden lg:block h-12 w-auto"
                                        src="https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-facebook_-512.png"
                                        alt="Logo">
                                </a>
                                <div class="hidden lg:block lg:ml-2">
                                    <div class="flex ">

                                        <a href="#"
                                            class="ml-4 px-3 py-2 text-white  rounded-md text-sm leading-5 font-medium  font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700 ">
                                            Profie </a>
                                        <a href="#"
                                            class="ml-4 px-3 py-2 text-white  rounded-md text-sm leading-5 font-medium  font-semibold hover:bg-yellow-500 hover:text-white transition duration-150 ease-in-out cursor-pointer focus:outline-none focus:text-white focus:bg-gray-700 ">
                                            Notification </a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end">
                                <div class="max-w-lg w-full lg:max-w-xs">
                                    <label for="search" class="sr-only">Search </label>
                                    <form methode="get" action="#" class="relative z-50">
                                        <button type="submit" id="searchsubmit"
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <input type="text" name="s" id="s"
                                            class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-yellow-200 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:text-gray-900 sm:text-sm transition duration-150 ease-in-out"
                                            placeholder="Search">
                                    </form>
                                </div>
                            </div>
                            <div class="flex lg:hidden">
                                <button @click="menu = !menu"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                                    aria-label="Main menu" aria-expanded="false">
                                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div  class="block md:hidden">
                        <div class="px-2 pt-2 pb-3">

                            <a href="#"
                                class="mt-1 block px-3 py-2 rounded-md text-white font-semibold font-medium hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Profile
                            </a>
                            <a href="#"
                                class="mt-1 block px-3 py-2 rounded-md text-white font-semibold font-medium hover:bg-yellow-500 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Notification
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="bg-gray-200 dark:bg-gray-800">
            <div class="container flex items-center px-6 py-4 mx-auto overflow-y-auto whitespace-nowrap">
                <a href="#" class="text-gray-600 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>

                <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>

                <a href="#" class="flex items-center text-gray-600 -px-2 dark:text-gray-200 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>



                    <span class="mx-2">Home</span>
                </a>


            </div>
        </div>
            <div class="bg-gray-100">
                <div class="container mx-auto my-5 p-5">
                    <div class="md:flex  md:-mx-2 ">
                        <!-- Left Side -->
                        <div class="w-full md:w-3/12 md:mx-2">
                            <!-- Profile Card -->
                            <div class="bg-white p-3 border-t-4 border-green-400">
                                <div class="image overflow-hidden">
                                    <img class="h-auto w-full mx-auto"
                                        src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                        alt="">
                                </div>
                                <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">Jane Doe</h1>
                                <h3 class="text-gray-600 font-lg text-semibold leading-6">Owner at Her Company Inc.</h3>
                                <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Lorem ipsum dolor sit
                                    amet
                                    consectetur adipisicing elit.
                                    Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p>
                                <ul
                                    class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                    <li class="flex items-center py-3">
                                        <span>Status</span>
                                        <span class="ml-auto"><span
                                                class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                                    </li>
                                    <li class="flex items-center py-3">
                                        <span>Member since</span>
                                        <span class="ml-auto">Nov 07, 2016</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- End of profile card -->
                            <div class="my-4"></div>
                            <!-- Friends card -->
                            <div class="bg-white p-3 hover:shadow">
                                <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                    <span class="text-green-500">
                                        <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </span>
                                    <span>Online</span>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="text-center my-2">
                                        <img class="h-16 w-16 rounded-full mx-auto"
                                            src="https://cdn.australianageingagenda.com.au/wp-content/uploads/2015/06/28085920/Phil-Beckett-2-e1435107243361.jpg"
                                            alt="">
                                        <a href="#" class="text-main-color">Kojstantin</a>
                                    </div>
                                    <div class="text-center my-2">
                                        <img class="h-16 w-16 rounded-full mx-auto"
                                            src="https://avatars2.githubusercontent.com/u/24622175?s=60&amp;v=4" alt="">
                                        <a href="#" class="text-main-color">James</a>
                                    </div>
           
                                    <div class="text-center my-2">
                                        <img class="h-16 w-16 rounded-full mx-auto"
                                            src="https://bucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com/public/images/f04b52da-12f2-449f-b90c-5e4d5e2b1469_361x361.png"
                                            alt="">
                                        <a href="#" class="text-main-color">Casey</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End of friends card -->
                        </div>
                        <!-- Right Side -->
                        <div class="w-full  mx-2 ">
                            <!-- Profile tab -->
                            <!-- About Section -->
                            <div class="bg-white p-3 shadow-sm rounded-sm">
                                <div class="w-full h-16 flex items-center flex justify-between px-5">
                                    <img class=" rounded-full w-10 h-10 mr-3"
                                        src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-1/263319349_447542383644148_1687301738999888976_n.jpg?stp=dst-jpg_p200x200&_nc_cat=1&ccb=1-7&_nc_sid=c6021c&_nc_eui2=AeHRTyWXz-_3AxPRUiwWh8awl8hrSYTXnPWXyGtJhNec9Y-S8tT3ujsJJWZSymcMBCQg3bQghiO8IuGy5HvvZ7lN&_nc_ohc=co2qDQr2ueEAX9_HYV8&_nc_ht=scontent.fmnl25-4.fna&oh=00_AfAaU3s6WB0_AMniF9I6vVHHbV8VjVEgbHvMhy_W6spt4w&oe=636108D7"
                                        alt="">
                                    <input type="text" class=" w-full rounded-full h-10 bg-gray-200 px-5"
                                        placeholder="What's on your mind?">

                                </div>
                                <div class="w-full h-10 flex justify-between mt-4 px-3 md:px-10 lg:px-24 xl:px-5">
                                    <button class=" flex h-full  items-center">
                                        <svg class="h-12  text-green-500 stroke-current"
                                            xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                            viewBox="0 0 24 24" fill="none" stroke="#b0b0b0" stroke-width="2"
                                            stroke-linecap="square" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <path d="M20.4 14.5L16 10 4 20" />
                                        </svg>
                                        <span class="text-xs lg:text-md mx-2 font-semibold text-gray-500">Upload Photo
                                        </span>
                                    </button>
                                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            Post
                                            <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                </div>
   
                            </div>
                            <!-- End of about section -->


                            <div class="my-4"></div>

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
                                            <svg class="fill-rose-600 dark:fill-rose-400"
                                                style="width: 24px; height: 24px;" viewBox="0 0 24 24">
                                                <path
                                                    d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z">
                                                </path>
                                            </svg> 
                                        </span>
                                        <span class="text-lg font-bold">34</span>
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a  :href="route('socialmedia.comments')"
                                        class="py-3 px-4 w-full block bg-slate-100 dark:bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition ease-in-out delay-75">Show
                                        more comments</a>
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
