<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

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
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto ">
                <a href="https://flowbite.com" class="flex items-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Allan Mark Studio Practice</span>
                </a>
                <div class="flex items-center lg:order-2" v-if="canLogin">
                    <a :href="route('login')" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a>
                    <a  v-if="canRegister" :href="route('register')" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Register</a>
                    <a v-if="$page.props.user" :href="route('dashboard')" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Get started</a>

                </div>
          
            </div>
        </nav>
    </header>

    <section class="bg-gray-50 px-5 ">
        <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-4">
               
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <scroll-parallax   :right="true" direction="x">

            <div class="space-y-8  md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div class="bg-green-800 border-double border-8 border-white rounded p-2 drop-shadow-sm">
                    <h3 class="mb-2 text-2xl font-extrabold text-white italic ">Mandate</h3>
                    <h3 class="mb-2 text-1xl font-extrabold text-white">ection 2 of Republic Act No. 4498 mandates that Central Mindanao University “shall provide programs of instruction at all levels in the arts, sciences, technical, professional, educational, and philosophical fields, and shall concern itself with “pure” and “applied” research in all branches of knowledge for the intellectual and professional growth of faculty members, for the advance instruction of students, and for increasing knowledge and understanding.”</h3>
                </div>
                <div class="bg-white border-double border-8 border-green-800 rounded p-2 drop-shadow-sm">
                    <h3 class="mb-2 text-2xl font-extrabold text-green-900 flex italic ">Mission <svg class="ml-2 w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></h3>
                    <h3 class="mb-2 text-1xl font-extrabold text-gray-900">To advance the frontier of knowledge through internationalization of education and equitable access to quality instruction, research, extension and production for economic prosperity, moral integrity, social and cultural sensitivity and environmental consciousness.</h3>
                </div>
                <div class="bg-green-800 border-double border-8 border-white border-white rounded  p-2 drop-shadow-sm">
                    <h3 class="mb-2 text-2xl font-extrabold text-white flex italic ">Vision <svg class="w-8 h-8 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></h3>
                    <h3 class="mb-2 text-1xl font-extrabold text-white">A leading ASEAN university actively committed to the total development of people for a globally sustainable environment and a humane society.</h3>
                </div>
              
            </div>
        </scroll-parallax>
        </div>
      </section>

    <section class="bg-gray-50 px-5 ">
        <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-4">
                <h2 class="mb-2 text-4xl font-extrabold text-gray-900 dark:text-white">Colleges</h2>
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <scroll-parallax   :left="true" direction="x">

            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-6 md:gap-12 md:space-y-0">
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Agriculture.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Engineering.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Nursing.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Education.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Arts%20and%20Science.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Forestry%20and%20Evironmental%20Science.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Human%20Ecology.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Business%20Management.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Veterinary%20Medicine.png">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/College%20of%20Information%20Science%20and%20Computing.jpg">
                </div>
                <div class="  p-2 drop-shadow-sm">
                    <img class="grayscale " src="http://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/logos/CMU-LOGO.png">
                </div>
            </div>
        </scroll-parallax>
        </div>
      </section>

      

 
    <section class="px-10 bg-green-700">
        <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-4">
                <h2 class="mb-2 text-4xl font-extrabold text-white">Announcements</h2>
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-2 md:gap-12 md:space-y-0">
                <div v-for="items in 5" class="bg-white p-2 drop-shadow-sm">

                    <div class="bg-gray-400 flex p-0 items-center">
                        <h3 class="border-double border-4 border-white text-xl px-4 max-w-[8rem] bg-green-800 font-bold text-white">OCT 10</h3>
                        <h3 class="ml-4 text-sm font-bold text-white">College of Agriculture</h3>
                    </div>
                   
                    <p class="text-gray-500 mb-2 dark:text-gray-400">Plan it, create it, launch it. Collaborate seamlessly with all  the organization and hit your marketing goals every month with our marketing plan.</p>
                    <p class="text-sm font-bold text-green-800">October 2 2022 </p>
                </div>
            </div>
        </div>
      </section>

    <section class="px-10 bg-gray-200">
        <div class="py-8 px-4 mx-auto sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-4">
                <h2 class="mb-2 text-4xl font-extrabold text-gray-900 dark:text-white">Events</h2>
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div v-for="items in 5" class="bg-white p-2 drop-shadow-sm">

                    <div class="bg-gray-400 flex p-0 items-center">
                        <h3 class="border-double border-4 border-white text-xl px-4 max-w-[8rem] bg-green-800 font-bold text-white">OCT 10</h3>
                        <h3 class="ml-4 text-sm font-bold text-white">11:00 to 12:00</h3>
                    </div>
                   
                    <p class="text-gray-500 mb-2 dark:text-gray-400">Plan it, create it, launch it. Collaborate seamlessly with all  the organization and hit your marketing goals every month with our marketing plan.</p>
                    <p class="text-sm font-bold text-green-800">- CMU GROUND</p>
                </div>
            </div>
        </div>
      </section>

    

    <footer class="p-4 bg-gray-50 sm:p-6 dark:bg-gray-800">
        <div class="mx-auto">
         
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a href="#" class="hover:underline">Allan MArk</a>. All Rights Reserved.
                </span>
            </div>
        </div>
    </footer>
        </div>
    </div>
</template>
