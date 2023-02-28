<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import moment from "moment";
import AuthenticationCarLogo from '@/Components/AuthenticationCardLogo.vue'

const datetimeNow = ref("Loading...");

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM DD YYYY");
    }
};
const dateRealtime = () => {
    setInterval(() => {
        datetimeNow.value = moment(Date.now()).format(
            "MMMM Do YYYY, h:mm:ss a"
        );
    }, 1000);
};
const date_conversion_day_text = (value) => {
    if (value) {
        return moment(value).format("dddd");
    }
};
const date_conversion_day_num = (value) => {
    if (value) {
        return moment(value).format("Do");
    }
};
const date_conversion_day_mon = (value) => {
    if (value) {
        return moment(value).format("MMM");
    }
};
const date_conversion_complete = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};
const date_conversion_complete_rt = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};
onMounted(() => {
    dateRealtime();
});

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <div class="bg-image ">
        <nav class="bg-white mb-10 px-2 sm:px-4 py-2.5  fixed w-full z-20 top-0 left-0 border-b border-gray-200 ">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <a href="https://alumni.com/" class="flex items-center">
                    <AuthenticationCarLogo />
                    <!-- <img src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo"> -->
                    <span class="self-center text-xl font-semibold whitespace-nowrap ">Central Mindanao University</span>
                </a>
                <div
                            class="flex items-center lg:order-2"
                            v-if="canLogin"
                        >
                            <a
                                :href="route('login')"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 "
                                >Log in</a
                            >
                            <a
                                v-if="canRegister"
                                :href="route('register')"
                                class="focus:outline-none text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 "
                                >Register</a
                            >
                            <a
                                v-if="$page.props.user"
                                :href="route('dashboard')"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none"
                                >Get started</a
                            >
                        </div>

            </div>
        </nav>
        <section>
            
                <div
                    class="overflow-hidden mb-1 lg:mx-[32vmin] lg:mt-24 backdrop-opacity-50 backdrop-blur-lg text-white py-10 lg:py-20 bg-hero bg-no-repeat bg-cover bg-center h-[100%] flex flex-col"
                    style="
                        background-image: url('/img/background.jpg');
                        background-size: 100%;
                        /* background-image: url('http://[::1]:5173/resources/assets/farm.jpg'); */
                        /* background-image: url('https://images.unsplash.com/photo-1444858291040-58f756a3bdd6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1678&q=80'); */
                    "
                >
                    <scroll-parallax :right="true" direction="x">
                        <div
                            class="container backdrop-blur-md bg-white/30 max-w-[100vmin] flex-col md:flex-row items-center my-12 md:my-24"
                        >
                            <div
                                class="flex flex-col justify-center items-start p-8"
                            >
                                <h1
                                    class="text-3xl md:text-5xl p-2 text-white w-full"
                                >
                                    Central Mindanao University
                                </h1>
                                <h2
                                    class="text-3xl md:text-5xl leading-relaxed md:leading-snug mb-2"
                                >
                                    Alumni
                                </h2>
                                <a
                                    :href="route('login')"
                                    class="bg-transparent hover:bg-green-300 text-green-300 hover:text-black rounded shadow hover:shadow-lg py-2 px-4 border border-green-300 hover:border-transparent"
                                >
                                    Login</a
                                >
                            </div>
                        </div>
                    </scroll-parallax>
                </div>
            </section>


 <section class="overflow-hidden mb-5 text-gray-700 ">
  <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
    <div class="flex flex-wrap -m-1 md:-m-2">
      <div  v-for="(colleges, key) in usePage().props.value
                                .colleges"
                            :key="key" class="flex flex-wrap w-1/3">
        <div class="w-full p-1 md:p-2">
          <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
          :src="'/images/colleges/' + colleges.logo">
        </div>
      </div>
     
    </div>
  </div>
</section>

        <section class="text-gray-600 body-font">
            <div class="container bg-white border shadow-lg rounded-lg px-5 py-10 mx-auto">

                <div class="flex flex-wrap -m-4">
                    <div class="p-4 md:w-1/2 w-full">
                        <div class="h-full bg-gray-100 p-8 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                <path
                                    d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                                </path>
                            </svg>
                            <p class="leading-relaxed mb-6"> Section 2 of Republic Act No. 4498
                                mandates that Central Mindanao
                                University “shall provide programs of
                                instruction at all levels in the arts,
                                sciences, technical, professional,
                                educational, and philosophical fields,
                                and shall concern itself with “pure” and
                                “applied” research in all branches of
                                knowledge for the intellectual and
                                professional growth of faculty members,
                                for the advance instruction of students,
                                and for increasing knowledge and
                                understanding.</p>
                            <a class="inline-flex items-center">
                                <img alt="testimonial" src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                    class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                <span class="flex-grow flex flex-col pl-4">
                                    <span class="title-font font-medium text-gray-900">Mandate</span>

                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 md:w-1/2 w-full">
                        <div class="h-full bg-gray-100 p-8 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                <path
                                    d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                                </path>
                            </svg>
                            <p class="leading-relaxed mb-6">To advance the frontier of knowledge
                                through internationalization of
                                education and equitable access to
                                quality instruction, research, extension
                                and production for economic prosperity,
                                moral integrity, social and cultural
                                sensitivity and environmental
                                consciousness.</p>
                            <a class="inline-flex items-center">
                                <img alt="testimonial" src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                    class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                <span class="flex-grow flex flex-col pl-4">
                                    <span class="title-font font-medium text-gray-900">Mission</span>

                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="p-4 md:w-1/2 w-full">
                        <div class="h-full bg-gray-100 p-8 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                <path
                                    d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                                </path>
                            </svg>
                            <p class="leading-relaxed mb-6">A leading ASEAN university actively
                                committed to the total development of
                                people for a globally sustainable
                                environment and a humane society.</p>
                            <a class="inline-flex items-center">
                                <img alt="testimonial" src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                    class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                <span class="flex-grow flex flex-col pl-4">
                                    <span class="title-font font-medium text-gray-900">Vision</span>

                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="text-gray-600  body-font">
            <div class="container bg-white px-5 shadow-lg  mt-14 py-10 border rounded-lg mx-auto">
                <div class="flex flex-wrap w-full ">
                    <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                        <h1 class="text-3xl mt-2 font-black text-black">Announcements</h1>
                        <div class="h-1 w-20 bg-green-500 rounded"></div>
                    </div>
                </div>

                <div class="flex flex-wrap   ">

                    <div v-for="(announcement, key) in usePage().props.value
                    .announcements" :key="key" class="xl:w-1/4  md:w-1/2 p-4 ">
                    <div class="flex justify-evenly">
                        <div v-for="(photos, key) in announcement.photo" :key="key" class=" w-100  ">
                                <img class="  object-contain      "
                                    :src="'./images/announcements/' + photos" alt="content">
                            </div>
                    </div>
                             
                            <img v-if="announcement.photo == '' || announcement.photo == null"
                                class="h-40 rounded w-full object-cover object-center "
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                alt="content">
                        <div class=" shadow-lg p-6  rounded-lg">
                            <h3 class="tracking-widest text-green-500 text-xs font-medium title-font">{{
                                date_conversion_complete(
                                    announcement.created_at
                                                            )
                            }}</h3>
                            <h2 class="text-lg text-gray-900 font-medium title-font mb-4"> {{ announcement.title }}</h2>
                            <p class="leading-relaxed text-base" v-html="announcement.content"></p>
                            <div class="flex items-center mt-2 ">
                                <img class="hidden object-cover w-10 h-10  rounded-full sm:block"
                                    src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                    alt="avatar" />
                                <a class="font-bold text-gray-700 cursor-pointer " tabindex="0" role="link">Posted by :
                                    Admin -
                                    {{ announcement.updated_by.name }}</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="text-gray-600  body-font">
            <div class="container  px-5   mt-2 py-10  rounded-lg mx-auto">
                <div class="flex flex-wrap w-full ">
                    <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                        <h1 class="text-3xl mt-2 font-black text-black">Events</h1>
                        <div class="h-1 w-20 bg-green-500 rounded"></div>
                    </div>
                </div>

                <div class="flex flex-wrap   ">

                    <div v-for="(events, key) in usePage().props.value.events" :key="key"
                        class="xl:w-1/4  md:w-1/2 p-4  ">
                        <div class=" shadow-lg p-6 border rounded-lg  bg-white">
                            <h2 class="text-4xl mt-2 font-black text-green-900 "> {{ events.title }}</h2>
                            <p class="text-2xl my-5 font-medium text-gray-900 "   v-html="events.content"></p>
                            <h3 class="tracking-widest text-green-500 text-xs font-medium title-font">{{
                                                    date_conversion_day_mon(
                                                        events.from
                                                    )
                                                }}
                                                {{
                                                    date_conversion_day_num(
                                                        events.from
                                                    )
                                                }}
                                          
                                            ({{
                                                date_conversion_day_text(
                                                    events.from
                                                )
                                            }}) to   {{   date_conversion_day_mon(
                                                        events.to
                                                    )
                                                }}
                                                {{
                                                    date_conversion_day_num(
                                                        events.to
                                                    )
                                                }}
                                          
                                            ({{
                                                date_conversion_day_text(
                                                    events.to
                                                )
                                            }}) </h3>
                       
                        </div>
                    </div>

                </div>
            </div>
        </section>



    </div>

</template>

<style scoped>
.text-focus-in1 {
    -webkit-animation: text-focus-in 1s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
    animation: text-focus-in 1s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
}

.text-focus-in2 {
    -webkit-animation: text-focus-in 2s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
    animation: text-focus-in 2s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
}

.text-focus-in3 {
    -webkit-animation: text-focus-in 3s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
    animation: text-focus-in 3s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
}

@-webkit-keyframes text-focus-in {
    0% {
        -webkit-filter: blur(12px);
        filter: blur(12px);
        opacity: 0;
    }

    100% {
        -webkit-filter: blur(0px);
        filter: blur(0px);
        opacity: 1;
    }
}

@keyframes text-focus-in {
    0% {
        -webkit-filter: blur(12px);
        filter: blur(12px);
        opacity: 0;
    }

    100% {
        -webkit-filter: blur(0px);
        filter: blur(0px);
        opacity: 1;
    }
}


.bg-cmu {
    background-image: url("https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/277753676_1304000960076328_3274280775987084409_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeHJcCK3w_9DuFAiXfYAq3S7FvihVsOuc7kW-KFWw65zuQYPI5GPMEC7ErJbk8-BDN4ZeZV3QOdDv5pNH0FMNba-&_nc_ohc=OfNQfGLwYt8AX9rsBeN&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfCtOta09b4tk-aXI30Z7P0ncjWGsLrAHpY6vgaHfESFiQ&oe=63BB4BC1");
    background-repeat: no-repeat;
    background-size: cover;
    background: center;
}

#vertical_date {
    text-orientation: upright;
    writing-mode: vertical-lr;
    font-size: 4rem;
    font-weight: bolder;
    text-indent: -20px;
    letter-spacing: -15px;
    text-transform: uppercase;
    text-shadow: 2px 2px 2px lightgray;
}

.bg-pattern {
    color: white;
    display: flex;

    background-color: #343a40;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='hexagons' fill='%239C92AC' fill-opacity='0.25' fill-rule='nonzero'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"),
        linear-gradient(to right top,
            #343a40,
            #2b2c31,
            #211f22,
            #151314,
            #000000);
}

.font-cus {
    color: #363833;
    font-family: "Poppins", sans-serif;
    font-weight: 900;
    font-size: 5vmin;
    grid-area: overlap;
    letter-spacing: 1px;
    -webkit-text-stroke: 4px transparent;
}

.bg-image {
background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='100%25' width='100%25'%3E%3Cdefs%3E%3Cpattern id='doodad' width='23.09' height='40' viewBox='0 0 34.64101615137755 60' patternUnits='userSpaceOnUse' patternTransform='rotate(135)'%3E%3Crect width='100%25' height='100%25' fill='rgba(240, 255, 244,1)'/%3E%3Cpath d='M36.37 39L36.37 41L32.91 39L34.64 38L34.64 42L32.91 41L34.64 40z' stroke-linejoin='miter' fill='rgba(203, 213, 224,1)'/%3E%3Cpath d='M19.05 49L19.05 51L15.59 49L17.32 48L17.32 52L15.59 51L17.32 50z' stroke-linejoin='miter' fill='rgba(203, 213, 224,1)'/%3E%3Cpath d='M1.73 39L1.73 41L-1.73 39L0 38L0 42L-1.73 41L0 40z' stroke-linejoin='miter' fill='rgba(203, 213, 224,1)'/%3E%3Cpath d='M1.73 19L1.73 21L-1.73 19L0 18L0 22L-1.73 21L0 20z' stroke-linejoin='miter' fill='rgba(203, 213, 224,1)'/%3E%3Cpath d='M19.05 9L19.05 11L15.59 9L17.32 8L17.32 12L15.59 11L17.32 10z' stroke-linejoin='miter' fill='rgba(203, 213, 224,1)'/%3E%3Cpath d='M36.37 19L36.37 21L32.91 19L34.64 18L34.64 22L32.91 21L34.64 20z' stroke-linejoin='miter' fill='rgba(203, 213, 224,1)'/%3E%3Cpath d='M34.64 41L35.51 40.5L33.77 39.5L33.77 40.5L35.51 39.5L34.64 39L34.64 40z' stroke-linejoin='miter' fill='rgba(198, 246, 213,1)'/%3E%3Cpath d='M17.32 51L18.19 50.5L16.45 49.5L16.45 50.5L18.19 49.5L17.32 49L17.32 50z' stroke-linejoin='miter' fill='rgba(198, 246, 213,1)'/%3E%3Cpath d='M0 41L0.87 40.5L-0.87 39.5L-0.87 40.5L0.87 39.5L0 39L0 40z' stroke-linejoin='miter' fill='rgba(198, 246, 213,1)'/%3E%3Cpath d='M0 21L0.87 20.5L-0.87 19.5L-0.87 20.5L0.87 19.5L0 19L0 20z' stroke-linejoin='miter' fill='rgba(198, 246, 213,1)'/%3E%3Cpath d='M17.32 11L18.19 10.5L16.45 9.5L16.45 10.5L18.19 9.5L17.32 9L17.32 10z' stroke-linejoin='miter' fill='rgba(198, 246, 213,1)'/%3E%3Cpath d='M34.64 21L35.51 20.5L33.77 19.5L33.77 20.5L35.51 19.5L34.64 19L34.64 20z' stroke-linejoin='miter' fill='rgba(198, 246, 213,1)'/%3E%3Cpath d='M17.32 30L17.32 30L17.32 30L17.32 30L17.32 30L17.32 30L17.32 30z' stroke-linejoin='miter' fill='rgba(203, 213, 224,1)'/%3E%3C/pattern%3E%3C/defs%3E%3Crect fill='url(%23doodad)' height='200%25' width='200%25'/%3E%3C/svg%3E ")
}
</style>