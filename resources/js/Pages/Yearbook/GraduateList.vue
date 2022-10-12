<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted } from 'vue';

const form_search = useForm({
    search: '',
    yearbook_id: null,
    college_id: null,
    course_id: null
});

onMounted(() => {
    // console.log(usePage().props.value.courses);
});

const filtered_course = computed(() => {
    if (form_search.college_id != null) {
        return usePage().props.value.courses.filter(course => course.college_id == form_search.college_id);
    } else {
        return usePage().props.value.courses;
    }
});
</script>

<template>
    <div class="m-6">
        <div class="mb-5 flex">
        
            <select v-model="form_search.college_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-2 w-75 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose a College</option>
            <option value="1">Engineering</option>
            <option value="2">Forestry</option>
            <option value="3">Veterenary Medicine</option>
            </select>

            <select v-model="form_search.course_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-2 w-75 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose a Course</option>
            <template v-for="course in filtered_course">
                <option :value="course.id">{{course.name}}</option>
            </template>
            </select>

            <input type="text" placeholder="School Year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <form class="flex ml-2 items-center">   
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input v-model="form_search.search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                </div>
                <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
            
        </div>
        <div class="container grid grid-cols-4 gap-5 mx-auto">
            <div v-for="graduate in $page.props.graduates.data" class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <a href="#" class="flex justify-center py-5">
                    <img class="rounded" width="300" src="https://scontent.fcgy1-1.fna.fbcdn.net/v/t1.6435-9/108026469_3149193648477703_9078657788133657642_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=174925&_nc_ohc=HMJrHF1WRsQAX9vuiIe&_nc_ht=scontent.fcgy1-1.fna&oh=00_AT9ZTJlU0pamzNp1CWfYsKpBAwAs57tMn0m1cF8q_jdTYw&oe=636C13E9" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ graduate.firstname+' '+graduate.middlename+' '+graduate.lastname+''+graduate.suffix }}
                        </h5>
                    </a>
                    <p class="mb-0 font-normal text-gray-700 dark:text-gray-400">College of Engineering</p>
                    <em class="mb-3 font-normal text-gray-700 dark:text-gray-400">2016-2020</em>
                    <p class="mt-3 font-normal text-gray-700 dark:text-gray-400">BSIT - Bachelor of Science in Information Technology</p>
                    <em class="mb-3 font-normal text-gray-700 dark:text-gray-400">Programmer of the year</em>

                </div>
            </div>
        </div>

    </div>
</template>
