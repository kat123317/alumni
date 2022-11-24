<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import moment from "moment";

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
    <Head title="Welcome" />

    <div
        class="relative bg-pattern flex items-top justify-center min-h-screen sm:items-center sm:pt-0"
    >
        <!-- <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div> -->

        <div class="w-full bg-gray-200">
            <div class="flex justify-between bg-green-900">
                <div class="text-yellow-600 font-mono ml-4 text-[4vmin]">
                    {{ datetimeNow }}
                </div>
                <div class="text-yellow-600 font-mono text-[4vmin] mr-4">
                    Central Mindanao University
                </div>
            </div>
            <header>
                <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5">
                    <div
                        class="flex flex-wrap justify-between items-center mx-auto"
                    >
                        <a
                            href="https://flowbite.com"
                            class="flex items-center"
                        >
                            <img
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                class="mr-3 h-6 sm:h-9"
                                alt="Flowbite Logo"
                            />
                            <span
                                class="self-center text-xl font-bold whitespace-nowrap"
                                >Central Mindanao University</span
                            >
                        </a>
                        <div
                            class="flex items-center lg:order-2"
                            v-if="canLogin"
                        >
                            <a
                                :href="route('login')"
                                class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none"
                                >Log in</a
                            >
                            <a
                                v-if="canRegister"
                                :href="route('register')"
                                class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none"
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
            </header>
            <section>
                <div
                    class="overflow-hidden bg-cmu backdrop-opacity-50 backdrop-blur-lg text-white py-20"
                    style="
                        background-image: url('https://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/backgrounds/main_gate.jpg');
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
                                    class="text-3xl md:text-5xl p-2 text-green-800 w-full"
                                >
                                    Central Mindanao University
                                </h1>
                                <h2
                                    class="text-3xl md:text-5xl leading-relaxed md:leading-snug mb-2"
                                >
                                    Alumni Association Incorporated
                                </h2>
                                <p
                                    class="text-sm md:text-base text-gray-50 mb-4"
                                >
                                    Explore your favourite events and register
                                    now.
                                </p>
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

            <section class=" mb-2 px-5">
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
         

                    <div
                        class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0"
                    >
                        <div class="">
                            <figure class="mx-auto max-w-screen-md text-focus-in1  text-center text-gray-800">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-3 w-12 h-12"
                                    viewBox="0 0 24 27"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                                <blockquote>
                                    <p
                                        class="text-2xl italic font-medium  text-gray-800"
                                    >
                                        Section 2 of Republic Act No. 4498
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
                                        understanding.
                                    </p>
                                </blockquote>
                                <figcaption
                                    class="flex justify-center items-center mt-6 space-x-3"
                                >
                                    <div
                                        class="flex items-center divide-x-2 divide-gray-500"
                                    >
                                        <cite
                                            class="pr-3 font-medium "
                                            >Mandate</cite
                                        >
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="">
                            <figure class="mx-auto max-w-screen-md text-focus-in2 text-gray-800 text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-3 w-12 h-12 "
                                    viewBox="0 0 24 27"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                                <blockquote>
                                    <p
                                        class="text-2xl italic font-medium "
                                    >
                                        To advance the frontier of knowledge
                                        through internationalization of
                                        education and equitable access to
                                        quality instruction, research, extension
                                        and production for economic prosperity,
                                        moral integrity, social and cultural
                                        sensitivity and environmental
                                        consciousness.
                                    </p>
                                </blockquote>
                                <figcaption
                                    class="flex justify-center items-center mt-6 space-x-3"
                                >
                                    <div
                                        class="flex items-center divide-x-2 divide-gray-500"
                                    >
                                        <cite
                                            class="pr-3 font-medium "
                                            >Mission</cite
                                        >
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div>
                            <figure class="mx-auto text-gray-900 text-focus-in3 max-w-screen-md text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-3 w-12 h-12 "
                                    viewBox="0 0 24 27"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                                <blockquote>
                                    <p
                                        class="text-2xl italic font-medium "
                                    >
                                        A leading ASEAN university actively
                                        committed to the total development of
                                        people for a globally sustainable
                                        environment and a humane society.
                                    </p>
                                </blockquote>
                                <figcaption
                                    class="flex justify-center items-center mt-6 space-x-3"
                                >
                                    <div
                                        class="flex items-center divide-x-2 divide-gray-500"
                                    >
                                        <cite
                                            class="pr-3 font-medium "
                                            >Vision</cite
                                        >
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </section>
            <div class="bg-yellow-600 h-[1vmin]"></div>
            <div class="font-mono bg-green-900 mb-4 h-[3vmin]">
                <h2
                    class="mb-2 text-[2rem] font-extrabold text-start ml-4 text-yellow-600 flex"
                >
                  
                  
                </h2>
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <div class="text-3xl w-full flex justify-center text-gray-800 font-cus"><p>Colleges </p></div>
            <section class=" px-5">
               
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
                    
                    <div
                        class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-6 md:gap-12 md:space-y-0"
                    >
                        <div
                            class="p-2 drop-shadow-sm"
                            v-for="(colleges, key) in usePage().props.value
                                .colleges"
                            :key="key"
                        >
                            <img
                                class="grayscale w-25"
                                :src="'/images/colleges/' + colleges.logo"
                            />
                        </div>
                    </div>
                </div>
            </section>

            <div class="bg-yellow-600 h-[1vmin]"></div>
            <div class="font-mono bg-green-900 mb-4 h-[3vmin]">
                <h2
                    class="mb-2 text-[2rem] font-extrabold text-start ml-4 text-yellow-600 flex"
                >
                  
                  
                </h2>
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <div class="text-3xl w-full flex justify-center text-gray-800 font-cus"><p>Announcements </p></div>
      
            <section class="px-10 bg-gray-200">
              
                <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
                    <div
                        class="space-y-8 md:grid md:grid-cols-1 lg:grid-cols-1 md:gap-12 md:space-y-0"
                    >
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
                        <div
                            v-for="(announcement, key) in usePage().props.value
                                .announcements"
                            :key="key"
                            class="px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800"
                        >
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-sm font-light text-gray-600 dark:text-gray-400"
                                    >{{
                                        date_conversion_complete(
                                            announcement.created_at
                                        )
                                    }}</span
                                >
                                <a
                                    class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform bg-green-600 rounded cursor-pointer hover:bg-green-500"
                                    tabindex="0"
                                    role="button"
                                    ><svg
                                        class="w-6 h-6"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"
                                        ></path></svg
                                ></a>
                            </div>

                            <div class="mt-2">
                                <div class="flex justify-center">
                                    <div
                                        v-for="(
                                            photos, key
                                        ) in announcement.photo"
                                        :key="key"
                                    >
                                        <img
                                            class="gap-2"
                                            :src="
                                                './images/announcements/' +
                                                photos
                                            "
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <a
                                    href="#"
                                    class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline"
                                    tabindex="0"
                                    role="link"
                                >
                                    {{ announcement.title }}</a
                                >
                                <p v-html="announcement.content"
                                    class="mt-2 text-gray-600 dark:text-gray-300"
                                >
                                 
                                </p>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <div class="flex items-center">
                                    <img
                                        class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block"
                                        src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png"
                                        alt="avatar"
                                    />
                                    <a
                                        class="font-bold text-gray-700 cursor-pointer dark:text-gray-200"
                                        tabindex="0"
                                        role="link"
                                        >Posted by : Admin -
                                        {{ announcement.updated_by.name }}</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
          
            <div class="bg-yellow-600 h-[1vmin]"></div>
            <div class="font-mono bg-green-900 mb-4 h-[3vmin]">
                <h2
                    class="mb-2 text-[2rem] font-extrabold text-start ml-4 text-yellow-600 flex"
                >
                  
                  
                </h2>
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <div class="text-3xl w-full flex justify-center text-gray-800 font-cus"><p>Events </p></div>
            <section class="px-10 bg-gray-200">
                <div class="py-8 px-4 mx-auto">
                    <div
                        class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0"
                    >
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
                        <div
                            v-for="(events, key) in usePage().props.value
                                .events"
                            :key="key"
                            class="flex"
                        >
                            <div class="w-full">
                                <div
                                    class="bg-green-900 rounded-lg text-center text-yellow-500 font-bold text-[2rem]"
                                >
                                    {{ events.title }}
                                </div>
                                <div v-html="events.content"
                                    class="bg-yellow-500 mt-1 rounded-lg text-center text-green-800 font-bold"
                                >
                                 
                                </div>

                                <div
                                    class="mt-2 grid grid-cols-1 lg:grid-cols-1 sm:grid-cols-1"
                                >
                                    <div
                                        class="flex mr-0 lg:mr-2 p-0 font-mono rounded-lg text-center text-yellow-500 font-bold"
                                    >
                                        <div>
                                            <p
                                                id="vertical_date"
                                                class="rounded-lg lg:bg-transparent text-green-900 mt-3 pt-1 text-center"
                                            >
                                                {{
                                                    date_conversion_day_mon(
                                                        events.from
                                                    )
                                                }}
                                            </p>
                                        </div>
                                        <div
                                            class="bg-green-900 w-full rounded-lg p-2"
                                        >
                                            <span>From</span> <br />
                                            <span class="text-[4rem]"
                                                >{{
                                                    date_conversion_day_num(
                                                        events.from
                                                    )
                                                }}
                                                <br />
                                            </span>
                                            <em>{{
                                                date_conversion_day_text(
                                                    events.from
                                                )
                                            }}</em>
                                        </div>
                                    </div>
                                    <div
                                        class="flex mt-5 p-0 font-mono rounded-lg text-center text-green-800 font-bold"
                                    >
                                        <div>
                                            <p
                                                id="vertical_date"
                                                class="rounded-lg lg:bg-transparent text-yellow-600 mt-3 pt-1 text-center"
                                            >
                                                {{
                                                    date_conversion_day_mon(
                                                        events.to
                                                    )
                                                }}
                                            </p>
                                        </div>
                                        <div
                                            class="bg-yellow-500 w-full mr-2 rounded-lg p-2"
                                        >
                                            <span>to</span> <br />
                                            <span class="text-[4rem]"
                                                >{{
                                                    date_conversion_day_num(
                                                        events.to
                                                    )
                                                }}
                                                <br />
                                            </span>
                                            <em>{{
                                                date_conversion_day_text(
                                                    events.to
                                                )
                                            }}</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="p-4 bg-gray-50 sm:p-6">
                <div class="mx-auto">
                    <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
                    <div
                        class="sm:flex sm:items-center sm:justify-between text-center"
                    >
                        <span class="text-sm text-gray-500 sm:text-center"
                            >© 2022
                            <a href="#" class="hover:underline"
                                >Central Mindanao University</a
                            >. All Rights Reserved.
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<style scoped>

.text-focus-in1 {
	-webkit-animation: text-focus-in 1s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
	        animation: text-focus-in 1s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
}
.text-focus-in2 {
	-webkit-animation: text-focus-in 2s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
	        animation: text-focus-in 2s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
}
.text-focus-in3 {
	-webkit-animation: text-focus-in 3s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
	        animation: text-focus-in 3s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
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
    background-image: url("https://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/backgrounds/main_gate.jpg");
    background-repeat: no-repeat;
    object-fit: cover;
    background-size: cover;
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
        linear-gradient(
            to right top,
            #343a40,
            #2b2c31,
            #211f22,
            #151314,
            #000000
        );
}


.font-cus {
  color: #363833;
  font-family: 'Poppins', sans-serif;
  font-weight: 900;
  font-size: 5vmin;
  grid-area: overlap;
  letter-spacing: 1px;
  -webkit-text-stroke: 4px transparent;
}



</style>
