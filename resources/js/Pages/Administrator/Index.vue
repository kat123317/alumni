<script setup>
import { ref, onMounted } from 'vue'

const trigger  = ref(1);

</script>
<template>
    <div>
        <header class="text-gray-600 body-font bg-green-700">
            <div class="container mx-auto flex flex-wrap  p-5 flex-col md:flex-row items-center">
                <a class="flex  title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                <span class="ml-3 text-white text-xl">ADMINISTRATOR</span>
                </a>
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <button @click="trigger = 1" class="mr-5 text-white hover:text-gray-200">Announcements</button>
                <button @click="trigger = 2" class="mr-5 text-white hover:text-gray-200">Year Book</button>
                <button @click="trigger = 3" class="mr-5 text-white hover:text-gray-200">User Managenment</button>
                <button @click="trigger = 4" class="mr-5 text-white hover:text-gray-200">Survey</button>
                </nav>
                <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Back to home
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
                </button>
            </div>
        </header>
        
        <section v-if="trigger == 1"  class="text-gray-600 h-[90vmin] body-font relative">
            <div class="absolute  lg:block hidden inset-0 bg-gray-300">
                <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4700.147561062848!2d125.05044014002942!3d7.859731708811927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32ff184711ed6b0f%3A0xa6348944e8acd9bf!2sCentral%20Mindanao%20University!5e0!3m2!1sen!2sph!4v1665578365379!5m2!1sen!2sph" style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
                
            </div>
            <div class="container px-5 py-24 mx-auto flex">
                <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col  md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
                <h2 class="text-gray-900 text-lg mb-5 font-medium title-font">Post-Announcement</h2>
                
                <div class="relative mb-4">
                    <label for="email" class="leading-7 text-sm text-gray-600">Privacy</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected>Only Me</option>
                        <option value="COE">Private</option>
                        <option value="COED">Public</option>
                    </select>
                </div>
                <div class="relative mb-4">
                <label for="email" class="leading-7  text-sm text-gray-600">Department</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected>All</option>
                       
                        <option value="COE">COE</option>
                        <option value="COED">COED</option>
                        <option value="BSBS">BSBS</option>
                        <option value="SBSB">SBSB</option>
                    </select>
                </div>
                <div class="relative mb-4">
                    <label for="message" class="leading-7 text-sm text-gray-600">Announcement</label>
                    <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                </div>
                <button class="text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg">Post</button>
                <p class="text-xs text-gray-500 mt-3">Post some NEWS, events and other important matters.</p>
                </div>
            </div>
          </section>



          <section v-if="trigger == 2" class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Add a Alumnus</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Add Alumni Here</p>
                </div>
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">First Name</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">Middle Name</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">Last Name</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Suffix (Optional)</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Add Achivement</label>
                        <div class="flex items-center">   
                            <div class="relative w-full">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-6 h-6 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                                <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Achievement" required>
                            </div>
                            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Achievements</h2>
                    <ul class="space-y-1 max-w-md list-disc list-inside text-gray-500 dark:text-gray-400">
                        <li>
                           Best in Math
                        </li>
                        <li>
                           Citizen of the year
                        </li>
                    </ul>
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="name" class="leading-7 text-sm text-gray-600">College</label>
                        <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="COE">COE</option>
                            <option value="COED">COED</option>
                            <option value="BSBS">BSBS</option>
                            <option value="SBSB">SBSB</option>
                        </select>
                    </div>
                    </div>
                    <div class="p-2 w-1/2">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Course</label>
                        <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="COE">BSIT</option>
                            <option value="COED">BSMS</option>
                            <option value="BSBS">SSWD</option>
                            <option value="SBSB">WWER</option>
                        </select>
                    </div>
                    </div>
                    <div class="p-2 w-full">
                    <div class="relative">
                        <label for="message" class="leading-7 text-sm text-gray-600">Motto</label>
                        <textarea id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                    </div>
                    </div>
                    <div class="p-2 w-full">
                    <button class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Submit</button>
                    </div>
                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">

                    </div>
                </div>
                </div>
                
                    <div class="hidden overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Product name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Color
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Category
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Apple MacBook Pro 17"
                                    </th>
                                    <td class="py-4 px-6">
                                        Sliver
                                    </td>
                                    <td class="py-4 px-6">
                                        Laptop
                                    </td>
                                    <td class="py-4 px-6">
                                        $2999
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Microsoft Surface Pro
                                    </th>
                                    <td class="py-4 px-6">
                                        White
                                    </td>
                                    <td class="py-4 px-6">
                                        Laptop PC
                                    </td>
                                    <td class="py-4 px-6">
                                        $1999
                                    </td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Magic Mouse 2
                                    </th>
                                    <td class="py-4 px-6">
                                        Black
                                    </td>
                                    <td class="py-4 px-6">
                                        Accessories
                                    </td>
                                    <td class="py-4 px-6">
                                        $99
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

            </div>
            </section>

    </div>
</template>