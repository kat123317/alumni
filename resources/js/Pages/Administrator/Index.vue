<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted, provide } from 'vue'
import Announcement from './components/Announcement.vue';
import Alumni from './components/Alumni.vue';
import Usermangement from './components/Usermangement.vue';
import Department from './components/Department.vue';
import Course from './components/Course.vue';
import Events from './components/Events.vue';
import YearBook from './components/YearBook.vue';

const trigger  = ref(usePage().props.value.trigger);

// const props = defineProps([
//     'colleges', 
//     'notifications', 
//     'courses',
//     'users',
//     'announcements'
// ]);
provide('trigger', trigger);
provide('filter_courses_id', usePage().props.value.filter_courses_id);
</script>
<template>
    <div class="bg-cmu">
        <header class="text-gray-600 body-font bg-green-700">
            <div class="container mx-auto flex flex-wrap  p-5 flex-col md:flex-row items-center">
                <a class="flex  title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                <span class="ml-3 text-white text-xl">ADMINISTRATOR</span>
                </a>
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <button @click="trigger = 1" class="mr-5 text-white hover:text-gray-200">Announcements</button>
                <button  @click="trigger = 8" class="mr-5 text-white hover:text-gray-200">Year Book</button>
                <button  @click="trigger = 2" class="mr-5 text-white hover:text-gray-200">Alumni</button>
                <button @click="trigger = 3" class="mr-5 text-white hover:text-gray-200">User Managenment</button>
                <button @click="trigger = 4" class="mr-5 text-white hover:text-gray-200">College</button>
                <button @click="trigger = 5" class="mr-5 text-white hover:text-gray-200">Course</button>
                <button @click="trigger = 6" class="mr-5 text-white hover:text-gray-200">Survey</button>
                <button @click="trigger = 7" class="mr-5 text-white hover:text-gray-200">Events</button>
                <button @click="trigger = 7" class="mr-5 text-white hover:text-gray-200">Notification</button>
                </nav>
                <a :href="route('dashboard')" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Back to home
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
                </a>
            </div>
        </header>
        
        <Announcement v-if="trigger == 1" />
        <Alumni v-if="trigger == 2" />
        <Usermangement v-if="trigger == 3" />
        <Department v-if="trigger == 4" />
        <Course v-if="trigger == 5" />
        <Course v-if="trigger == 6" />
        <Events v-if="trigger == 7" />
        <YearBook v-if="trigger == 8" />

    </div>
</template>

<style scoped>
.bg-cmu{
}
.bg-cmu::after {
      content: "";
      background: url('https://th.bing.com/th/id/R.f2794a18807eeceb02baa5f575b09553?rik=XGySs8XRrUO18w&riu=http%3a%2f%2fumap.org%2fwp-content%2fuploads%2f2018%2f09%2fCMU_LOGO_2015_transparent_1-300x300.png&ehk=wMcHjqqG%2bIHf4L1fwHJZnx914Lm01VQTU8oalYWhSDk%3d&risl=&pid=ImgRaw&r=0') no-repeat center center;
      background-size:cover;
      opacity: 0.03;
      top: 0;
      left: 23%;
      bottom: 0;
      right: 0;
      position: absolute;
      z-index: -1;  
      -webkit-filter: grayscale(1); /* Old WebKit */
      filter: grayscale(1);
    }
</style>