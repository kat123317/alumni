<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted, computed } from 'vue';
import moment from 'moment';

const datetimeNow = ref('Loading...');

const date_conversion = (value) => {
    if (value) {
        return moment(value).format('MMMM DD YYYY')
    }
}
const dateRealtime = () =>{
    setInterval(() => {
        datetimeNow.value =  moment(Date.now()).format('MMMM Do YYYY, h:mm:ss a');
    }, 1000);
}
const date_conversion_day_text = (value) => {
    if (value) {
        return moment(value).format('dddd')
    }
}
const date_conversion_day_num = (value) => {
    if (value) {
        return moment(value).format('od')
    }
}
const date_conversion_day_mon = (value) => {
    if (value) {
        return moment(value).format('MMM')
    }
}
const date_conversion_complete = (value) => {
    if (value) {
        return moment(value).format('MMMM Do YYYY, h:mm:ss a');
    }
}
const date_conversion_complete_rt = (value) => {

    if (value) {
            return moment(value).format('MMMM Do YYYY, h:mm:ss a');
    
    }
}
onMounted(() => {
    dateRealtime()
})

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>


    <Head title="Welcome" />

    <div class="relative bg-pattern flex items-top justify-center min-h-screen   sm:items-center sm:pt-0">
        <!-- <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div> -->

        <div class=" w-full bg-white  ">
            <div class="flex justify-between bg-green-900">
                <div class="text-yellow-600 custom-font ml-4 text-[4vmin]">{{ datetimeNow }}
                </div>
                <div class="text-yellow-600 custom-font  text-[4vmin] mr-4">Central Mindanao University</div>
            </div>
            <header>
                <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 ">
                    <div class="flex flex-wrap justify-between items-center mx-auto ">
                        <a href="https://flowbite.com" class="flex items-center">
                            <img src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                            <span class="self-center text-xl font-bold whitespace-nowrap ">Central Mindanao
                                University</span>
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
                <div class=" overflow-hidden bg-cmu backdrop-opacity-50 backdrop-blur-lg text-white py-20"
                    style="background-image: url('https://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/backgrounds/main_gate.jpg');">
                    <scroll-parallax :right="true" direction="x">
                        <div
                            class="container backdrop-blur-md bg-white/30   max-w-[100vmin] flex-col md:flex-row items-center my-12 md:my-24">
                            <div class="flex flex-col    justify-center items-start p-8">
                                <h1 class="text-3xl md:text-5xl p-2 text-green-800 w-full ">Central Mindanao University
                                </h1>
                                <h2 class="text-3xl md:text-5xl leading-relaxed md:leading-snug mb-2">Alumni Association
                                    Incorporated
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

            <section class="bg-green-900 mb-2 px-5 ">
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
                    <div class="max-w-screen-md mb-4">

                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
                    </div>


                    <div class="space-y-8  md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                        <div class="">

                            <figure class="mx-auto max-w-screen-md text-center">
                                <svg aria-hidden="true" class="mx-auto mb-3 w-12 h-12 text-white" viewBox="0 0 24 27"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"></path>
                                </svg>
                                <blockquote>
                                    <p class="text-2xl italic font-medium text-white">Section 2 of
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

                                    <div class="flex items-center divide-x-2 divide-gray-500">
                                        <cite class="pr-3 font-medium text-white">Mandate</cite>

                                    </div>
                                </figcaption>
                            </figure>

                        </div>
                        <div class="">
                            <figure class="mx-auto max-w-screen-md text-center">
                                <svg aria-hidden="true" class="mx-auto mb-3 w-12 h-12 text-white" viewBox="0 0 24 27"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"></path>
                                </svg>
                                <blockquote>
                                    <p class="text-2xl italic font-medium text-white">To advance the
                                        frontier of
                                        knowledge through internationalization of education and equitable access to
                                        quality
                                        instruction, research, extension and production for economic prosperity, moral
                                        integrity, social and cultural sensitivity and environmental consciousness.</p>
                                </blockquote>
                                <figcaption class="flex justify-center items-center mt-6 space-x-3">

                                    <div class="flex items-center divide-x-2 divide-gray-500 ">
                                        <cite class="pr-3 font-medium text-white">Mission</cite>

                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div>
                            <figure class="mx-auto max-w-screen-md text-center">
                                <svg aria-hidden="true" class="mx-auto mb-3 w-12 h-12 text-white" viewBox="0 0 24 27"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"></path>
                                </svg>
                                <blockquote>
                                    <p class="text-2xl italic font-medium text-white">A leading ASEAN
                                        university actively
                                        committed to the total development of people for a globally sustainable
                                        environment
                                        and a humane society.</p>
                                </blockquote>
                                <figcaption class="flex justify-center items-center mt-6 space-x-3">

                                    <div class="flex items-center divide-x-2 divide-gray-500 ">
                                        <cite class="pr-3 font-medium text-white ">Vision</cite>

                                    </div>
                                </figcaption>
                            </figure>
                        </div>

                    </div>

                </div>
            </section>
            <div class=" bg-yellow-600  h-[1vmin]">  
            </div>
            <div class=" custom-font  bg-green-900  mb-4">
                        <h2 class="mb-2 text-[3rem] font-extrabold text-start ml-4 text-yellow-600 flex">Colleges <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  class="w-12 mt-2 ml-2 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
</svg>
 </h2>
                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <section class="bg-gray-50 px-5 ">
                
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">



                    <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-6 md:gap-12 md:space-y-0">
                        <div class="  p-2 drop-shadow-sm" v-for="(colleges, key) in usePage().props.value.colleges"
                            :key="key">
                            <img class="grayscale  w-25 " :src="'/images/colleges/' + colleges.logo">
                        </div>
                    </div>

                </div>
            </section>

            <div class=" bg-yellow-600  h-[1vmin]">  
            </div>
            <div class=" custom-font  bg-green-900  ">
                        <h2 class=" text-[3rem] font-extrabold text-start ml-4 text-yellow-600 flex">Announcements <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 mt-2 ml-2 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
</svg>
</h2>
                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <section class="px-10 bg-gray-200">
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">

                    <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-2 md:gap-12 md:space-y-0">
                        <!-- <div v-for="(announcement, key) in usePage().props.value.announcements" :key="key"
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
                        </div> -->
                        <div v-for="(announcement, key) in usePage().props.value.announcements" :key="key"
                            class=" px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{
                                        date_conversion_complete(announcement.created_at)
                                }}</span>
                                <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform bg-green-600 rounded cursor-pointer hover:bg-green-500"
                                    tabindex="0" role="button"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                        </path>
                                    </svg></a>
                            </div>

                            <div class="mt-2">
                                <a href="#"
                                    class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline"
                                    tabindex="0" role="link"> {{ announcement.title }}</a>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ announcement.content }}</p>
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <div class="flex items-center">
                                    <img class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block"
                                        src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                        alt="avatar">
                                    <a class="font-bold text-gray-700 cursor-pointer dark:text-gray-200" tabindex="0"
                                        role="link">Posted by : Admin - {{ announcement.updated_by.name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class=" bg-yellow-600  h-[1vmin]">  
            </div>
            <div class=" custom-font  bg-green-900 ">
                        <h2 class=" text-[3rem] font-extrabold text-start ml-4 text-yellow-600 flex">Events <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 mt-3 ml-2 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
</svg>
 </h2>
                        <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <section class="px-10 bg-gray-200">
                <div class="py-8 px-4 mx-auto">

                    <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                        <!-- <div v-for="(events, key) in usePage().props.value.events" :key="key"
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
                        </div> -->
                        <div v-for="(events, key) in usePage().props.value.events" :key="key" class=" flex">
                            <p id="vertical_date" class="bg-gray-300 rounded-lg lg:bg-transparent text-green-900 pt-3">
                                {{ date_conversion_day_mon(events.from) }}
                            </p>
                            <div class=" w-full">
                                <div class="bg-green-900 rounded-lg text-center text-yellow-500 font-bold">
                                    {{ events.title }}
                                </div>
                                <div class="bg-yellow-500 mt-1 rounded-lg text-center text-green-800 font-bold">
                                    {{ events.content }}
                                </div>
                                <div class=" mt-2 grid grid-cols-1 lg:grid-cols-2  sm:grid-cols-1">

                                    <div
                                        class="bg-green-900 mr-2 p-0  custom-font rounded-lg text-center text-yellow-500 font-bold">

                                        <span class="text-[6rem]">{{ date_conversion_day_num(events.from) }} <br>
                                        </span>
                                        <em>{{ date_conversion_day_text(events.from) }}</em>
                                    </div>
                                    <div
                                        class="bg-yellow-500 mr-2 p-0 mt-1 lg:mt-0 custom-font rounded-lg text-center text-green-800 font-bold">
                                        <span class="text-[6rem]">{{ date_conversion_day_num(events.to) }} <br> </span>
                                        <em>{{ date_conversion_day_text(events.to) }}</em>
                                    </div>
                                </div>
                            </div>
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

<style scoped>
@import url('http://fonts.cdnfonts.com/css/onramp');

.bg-cmu {
    background-image: url('https://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/backgrounds/main_gate.jpg');
    background-repeat: no-repeat;
    object-fit: cover;
    background-size: cover;
}

#vertical_date {
    text-orientation: upright;
    writing-mode: vertical-lr;
    font-size: 6rem;
    font-weight: bolder;
    outline-width: 1vmin !important;
    font-family: 'ONRAMP', sans-serif;
    text-shadow: 2px 2px 2px lightgray;

}

.custom-font {
    font-family: 'ONRAMP', sans-serif;
    
}

.bg-pattern {

    color: white;
    display: flex;



    background-color: #343a40;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='hexagons' fill='%239C92AC' fill-opacity='0.25' fill-rule='nonzero'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"), linear-gradient(to right top, #343a40, #2b2c31, #211f22, #151314, #000000);
}
</style>