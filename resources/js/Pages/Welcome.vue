<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  computed} from 'vue';
import moment from 'moment';

const date_conversion = (value) => {
            if (value) {
                return moment(value).format('MMMM DD YYYY')
            }
        }
const date_conversion_complete = (value) => {
    if(value){
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
                            <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9"
                                alt="Flowbite Logo" />
                            <span class="self-center text-xl font-semibold whitespace-nowrap ">Allan Mark
                                Studio Practice</span>
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
                <div class="bg-black text-white py-20">
                    <scroll-parallax :right="true" direction="x">
                        <div class="container mx-auto flex flex-col md:flex-row items-center my-12 md:my-24">
                            <div class="flex flex-col w-full lg:w-1/3 justify-center items-start p-8">
                                <h1 class="text-3xl md:text-5xl p-2 text-green-300 tracking-loose">TechFest</h1>
                                <h2 class="text-3xl md:text-5xl leading-relaxed md:leading-snug mb-2">Space : The
                                    Timeless
                                    Infinity
                                </h2>
                                <p class="text-sm md:text-base text-gray-50 mb-4">Explore your favourite events and
                                    register now to showcase your talent and win exciting prizes.</p>
                                <a  :href="route('login')"
                                    class="bg-transparent hover:bg-green-300 text-green-300 hover:text-black rounded shadow hover:shadow-lg py-2 px-4 border border-green-300 hover:border-transparent">
                                    Login</a>
                            </div>
                            <div class="p-8 mt-12 mb-6 md:mb-0 md:mt-0 ml-0 md:ml-12 lg:w-2/3  justify-center">
                                <div class="h-48 flex flex-wrap content-center">
                                    <div>
                                        <img class="inline-block mt-28 hidden xl:block"
                                            src="https://s.yimg.com/ny/api/res/1.2/E.XEHApTT5lv1PtuFKk6aQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTk2MDtoPTU0MC42NjY2NjY2NjY2NjY2/https://s.yimg.com/uu/api/res/1.2/bYsw7QtVNbS58wqCg0tvNQ--~B/aD04MTE7dz0xNDQwO2FwcGlkPXl0YWNoeW9u/https://media.zenfs.com/en/cosmopolitan_438/842a18738bf42ecd803a576d6349a8e0">
                                    </div>
        
                                </div>
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
                        <div class="bg-green-800 border-double border-8 border-white rounded p-2 drop-shadow-sm">
                            <h3 class="mb-2 text-2xl font-extrabold text-white italic ">Mandate</h3>
                            <h3 class="mb-2 text-1xl font-extrabold text-white">Section 2 of Republic Act No. 4498
                                mandates that Central Mindanao University “shall provide programs of instruction at
                                all levels in the arts, sciences, technical, professional, educational, and
                                philosophical fields, and shall concern itself with “pure” and “applied” research in
                                all branches of knowledge for the intellectual and professional growth of faculty
                                members, for the advance instruction of students, and for increasing knowledge and
                                understanding.”</h3>
                        </div>
                        <div class="bg-white border-double border-8 border-green-800 rounded p-2 drop-shadow-sm">
                            <h3 class="mb-2 text-2xl font-extrabold text-green-900 flex italic ">Mission <svg
                                    class="ml-2 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg></h3>
                            <h3 class="mb-2 text-1xl font-extrabold text-gray-900">To advance the frontier of
                                knowledge through internationalization of education and equitable access to quality
                                instruction, research, extension and production for economic prosperity, moral
                                integrity, social and cultural sensitivity and environmental consciousness.</h3>
                        </div>
                        <div
                            class="bg-green-800 border-double border-8 border-white border-white rounded  p-2 drop-shadow-sm">
                            <h3 class="mb-2 text-2xl font-extrabold text-white flex italic ">Vision <svg
                                    class="w-8 h-8 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg></h3>
                            <h3 class="mb-2 text-1xl font-extrabold text-white">A leading ASEAN university actively
                                committed to the total development of people for a globally sustainable environment
                                and a humane society.</h3>
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
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25 "
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Agriculture.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Engineering.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Nursing.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Education.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Arts%20and%20Science.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Forestry%20and%20Evironmental%20Science.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Human%20Ecology.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Business%20Management.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Veterinary%20Medicine.png">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Information%20Science%20and%20Computing.jpg">
                        </div>
                        <div class="  p-2 drop-shadow-sm">
                            <img class="grayscale  w-25"
                                src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png">
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
                        <div v-for="(announcement, key) in usePage().props.value.announcements" :key="key" class="bg-white p-2 rounded drop-shadow-sm">

                            <div class="bg-gray-400 flex p-0 items-center">
                                <h3
                                    class="border-double border-4 border-white text-xl px-4 max-w-[20rem] bg-green-800 font-bold text-white">
                                    {{ announcement.title}}</h3>
                                <h3 class="ml-4 text-sm font-bold text-white">{{ date_conversion_complete(announcement.created_at)}}</h3>
                            </div>

                            <p class="text-gray-500 mb-2 mt-6">{{announcement.content}}</p>
                            <p class="text-sm font-bold text-green-800">Posted by : Admin - {{ announcement.user.name }}</p>
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
                        <div v-for="(events, key) in usePage().props.value.events" :key="key" class="bg-white p-2 rounded drop-shadow-sm">

                            <div class="bg-gray-400 flex p-0 items-center">
                                <h3
                                    class="border-double border-4 border-white text-xl px-4 max-w-[8rem] bg-green-800 font-bold text-white">
                                    {{date_conversion(events.created_at)}}</h3>
                                <h3 class="ml-4 text-sm font-bold text-white">{{date_conversion(events.from)}} to {{date_conversion(events.to)}}</h3>
                            </div>

                            <p class="text-gray-500 mb-2 ">{{events.content}}</p>
                            <p class="text-sm font-bold text-green-800">- {{events.title}}</p>
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
