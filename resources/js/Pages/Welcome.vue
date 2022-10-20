<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted, computed } from 'vue';
import moment from 'moment';

const date_conversion = (value) => {
    if (value) {
        return moment(value).format('MMMM DD YYYY')
    }
}
const date_conversion_complete = (value) => {
    if (value) {
        return moment(value).format('MMMM Do YYYY, h:mm:ss a');
    }
}

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>

    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen   sm:items-center sm:pt-0">
        <!-- <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div> -->

        <div class=" w-full bg-white  ">
            <header>
                <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 ">
                    <div class="flex flex-wrap justify-between items-center mx-auto ">
                        <a href="https://flowbite.com" class="flex items-center">
                            <img src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png" class="mr-3 h-6 sm:h-9"
                                alt="Flowbite Logo" />
                            <span class="self-center text-xl font-bold whitespace-nowrap ">Central Mindanao University</span>
                        </a>
                        <div class="flex items-center lg:order-2" v-if="canLogin">
                            <a :href="route('login')"
                                class="text-gray-800  hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  focus:outline-none ">Log
                                in</a>
                            <a v-if="canRegister" :href="route('register')"
                                class="text-gray-800  hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  focus:outline-none ">Register</a>
                            <a v-if="$page.props.user" :href="route('dashboard')"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2   focus:outline-none ">Get
                                started</a>

                        </div>

                    </div>
                </nav>
            </header>
            <section>
                <div class=" overflow-hidden bg-cmu backdrop-opacity-50 backdrop-blur-lg text-white py-20" style="background-image: url('https://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/backgrounds/main_gate.jpg');">
                    <scroll-parallax :right="true" direction="x">
                        <div class="container backdrop-blur-md bg-white/30   max-w-[100vmin] flex-col md:flex-row items-center my-12 md:my-24">
                            <div class="flex flex-col    justify-center items-start p-8">
                                <h1 class="text-3xl md:text-5xl p-2 text-green-800 w-full ">Central Mindanao University </h1>
                                <h2 class="text-3xl md:text-5xl leading-relaxed md:leading-snug mb-2">Alumni Association Incorporated
                                </h2>
                                <p class="text-sm md:text-base text-gray-50 mb-4">Explore your favourite events and
                                    register now.</p>
                                <a :href="route('login')"
                                    class="bg-transparent hover:bg-green-300 text-green-300 hover:text-black rounded shadow hover:shadow-lg py-2 px-4 border border-green-300 hover:border-transparent">
                                    Login</a>
                            </div>
   
                        </div>
                    </scroll-parallax>
                </div>
            </section>

            <section class="bg-gray-50 px-5 ">
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
                    <div class="max-w-screen-md mb-4">

                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
                    </div>


                    <div class="space-y-8  md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                        <div class="">

                            <figure class="mx-auto max-w-screen-md text-center">
                                <svg aria-hidden="true" class="mx-auto mb-3 w-12 h-12 text-gray-400 dark:text-gray-600"
                                    viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"></path>
                                </svg>
                                <blockquote>
                                    <p class="text-2xl italic font-medium text-gray-900 dark:text-white">Section 2 of
                                        Republic Act No. 4498
                                        mandates that Central Mindanao University “shall provide programs of instruction
                                        at
                                        all levels in the arts, sciences, technical, professional, educational, and
                                        philosophical fields, and shall concern itself with “pure” and “applied”
                                        research in
                                        all branches of knowledge for the intellectual and professional growth of
                                        faculty
                                        members, for the advance instruction of students, and for increasing knowledge
                                        and
                                        understanding.</p>
                                </blockquote>
                                <figcaption class="flex justify-center items-center mt-6 space-x-3">

                                    <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                                        <cite class="pr-3 font-medium text-gray-900 dark:text-white">Mandate</cite>

                                    </div>
                                </figcaption>
                            </figure>

                        </div>
                        <div class="">
                            <figure class="mx-auto max-w-screen-md text-center">
                                <svg aria-hidden="true" class="mx-auto mb-3 w-12 h-12 text-gray-400 dark:text-gray-600"
                                    viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"></path>
                                </svg>
                                <blockquote>
                                    <p class="text-2xl italic font-medium text-gray-900 dark:text-white">To advance the
                                        frontier of
                                        knowledge through internationalization of education and equitable access to
                                        quality
                                        instruction, research, extension and production for economic prosperity, moral
                                        integrity, social and cultural sensitivity and environmental consciousness.</p>
                                </blockquote>
                                <figcaption class="flex justify-center items-center mt-6 space-x-3">

                                    <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                                        <cite class="pr-3 font-medium text-gray-900 dark:text-white">Mission</cite>

                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div>
                            <figure class="mx-auto max-w-screen-md text-center">
                                <svg aria-hidden="true" class="mx-auto mb-3 w-12 h-12 text-gray-400 dark:text-gray-600"
                                    viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"></path>
                                </svg>
                                <blockquote>
                                    <p class="text-2xl italic font-medium text-gray-900 dark:text-white">A leading ASEAN
                                        university actively
                                        committed to the total development of people for a globally sustainable
                                        environment
                                        and a humane society.</p>
                                </blockquote>
                                <figcaption class="flex justify-center items-center mt-6 space-x-3">

                                    <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                                        <cite class="pr-3 font-medium text-gray-900 dark:text-white">Vision</cite>

                                    </div>
                                </figcaption>
                            </figure>
                        </div>

                    </div>

                </div>
            </section>

            <section class="bg-gray-50 px-5 ">
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
                    <div class="max-w-screen-md mb-4">
                        <h2 class="mb-2 text-4xl font-extrabold text-gray-900 ">Colleges</h2>
                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
                    </div>


                    <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-6 md:gap-12 md:space-y-0">
                        <div class="  p-2 drop-shadow-sm" v-for="(colleges, key) in usePage().props.value.colleges"
                            :key="key">
                            <img class="grayscale  w-25 " :src=colleges.logo>
                        </div>
                    </div>

                </div>
            </section>




            <section class="px-10 bg-green-700">
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
                    <div class="max-w-screen-md mb-4">
                        <h2 class="mb-2 text-4xl font-extrabold text-white">Announcements</h2>
                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
                    </div>
                    <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-2 md:gap-12 md:space-y-0">
                        <div v-for="(announcement, key) in usePage().props.value.announcements" :key="key"
                            class="bg-white p-2 rounded drop-shadow-sm">

                            <div class="bg-gray-400 flex p-0 items-center">
                                <h3
                                    class="border-double border-4 border-white text-xl px-4 max-w-[20rem] bg-green-800 font-bold text-white">
                                    {{ announcement.title}}</h3>
                                <h3 class="ml-4 text-sm font-bold text-white">{{
                                date_conversion_complete(announcement.created_at)}}</h3>
                            </div>

                            <p class="text-gray-500 mb-2 mt-6">{{announcement.content}}</p>
                            <p class="text-sm font-bold text-green-800">Posted by : Admin - {{ announcement.updated_by.name }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="px-10 bg-gray-200">
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
                    <div class="max-w-screen-md mb-4">
                        <h2 class="mb-2 text-4xl font-extrabold text-gray-900 ">Events</h2>
                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
                    </div>
                    <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                        <div v-for="(events, key) in usePage().props.value.events" :key="key"
                            class="bg-white p-2 rounded drop-shadow-sm">

                            <div class="bg-gray-400 flex p-0 items-center">
                                <h3
                                    class="border-double border-4 border-white text-xl px-4 max-w-[8rem] bg-green-800 font-bold text-white">
                                    {{date_conversion(events.created_at)}}</h3>
                                <h3 class="ml-4 text-sm font-bold text-white">{{date_conversion(events.from)}} to
                                    {{date_conversion(events.to)}}</h3>
                            </div>

                            <p class="text-gray-500 mb-2 ">{{events.content}}</p>
                            <p class="text-sm font-bold text-green-800">- {{events.title}}</p>
                            <p class="text-sm font-bold text-green-800">Posted by - {{events.updated_by.name}}</p>
                        </div>
                    </div>
                </div>
            </section>



            <footer class="p-4 bg-gray-50 sm:p-6 ">
                <div class="mx-auto">

                    <hr class="my-6 border-gray-200 sm:mx-auto  lg:my-8" />
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <span class="text-sm text-gray-500 sm:text-center ">© 2022 <a href="#"
                                class="hover:underline">Allan MArk</a>. All Rights Reserved.
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<style>
.bg-cmu{
    background-image: url('https://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/backgrounds/main_gate.jpg');
    background-repeat: no-repeat;
    object-fit:cover; 
    background-size: cover;   
}
</style>