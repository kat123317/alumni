<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed, onMounted, ref } from "vue";
import Pagination from "./Pagination.vue";

const form_search = useForm({
    search: usePage().props.value.search,
    yearbook_id: usePage().props.value.yearbook_id,
    college_id: usePage().props.value.college_id,
    course_id: usePage().props.value.course_id,
});
const globalkey = ref('noData');

onMounted(() => {
    // console.log(usePage().props.value.courses);
});

const searchAlumni = (filter = false) => {
    if (filter) {
        form_search.search = "";
    }
    form_search.get(route("graduates.index"), {
        preserveScroll: true,
        onSuccess: () => { },
    });
};

const openSelectedAchievements = (Data) => {
    if (Data == globalkey.value) {
        globalkey.value = 'noData'
    } else {
        globalkey.value = Data
    }

};
</script>

<template>
    <div class="m-6">
        <div class="w-full mb-5 grid grid-cols-2 lg:grid-cols-4">
            <select @change="searchAlumni(true)" v-model="form_search.college_id" id="countries"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-2 w-75 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option :value="null">Choose a College</option>
                <option v-for="(colleges, key) in usePage().props.value.colleges" :key="key" :value="colleges.id">
                    {{ colleges.name }}
                </option>
            </select>

            <select @change="searchAlumni(true)" v-model="form_search.course_id" id="countries"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-2 w-75 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option :value="null">Choose a Course</option>
                <template v-for="course in $page.props.courses">
                    <option :value="course.id">{{ course.name }}</option>
                </template>
            </select>

            <select @change="searchAlumni(true)" v-model="form_search.yearbook_id"
                class="bg-gray-50 border border-gray-300 mt-2 lg:mt-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option :value="null">Choose School Year</option>
                <template v-for="yearbook in $page.props.yearbooks">
                    <option :value="yearbook.id">
                        {{
                                yearbook.schoolyear_from +
                                "-" +
                                yearbook.schoolyear_to
                        }}
                    </option>
                </template>
            </select>

            <div class="flex ml-2 items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input v-model="form_search.search" type="text" id="simple-search"
                        class="bg-gray-50 border border-gray-300  mt-2 lg:mt-0 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search" required />
                </div>
                <button @click="searchAlumni()" type="button"
                    class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
        <div class=" grid grid-cols-1 lg:grid-cols-4 gap-6   text-center">

            <div v-for="(graduate, key) in usePage().props.value.graduates.data" :key="key"
                class="w-full max-w-md px-8 py-4 mt-16 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full dark:border-green-400"
                        alt="Testimonial avatar" :src="
                            '/images/graduates/' +
                            graduate.details.profile_picture
                        ">
                </div>

                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                    <span>{{ graduate.firstname }} </span>
                    &nbsp;
                    <span v-if="graduate.middlename != null">{{ graduate.middlename }}
                    </span>
                    &nbsp;
                    <span>{{ graduate.lastname }} </span>
                    &nbsp;
                    <span v-if="graduate.suffix == null"></span>
                    <span v-else>{{ graduate.suffix }}</span>
                </h2>
                College of {{ graduate.course.college.name }}


                <div class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                    </svg>


                    <h1 class="px-2 text-sm">{{ graduate.course.abbreviation }} -
                        {{ graduate.course.name }}</h1>
                </div>
                <div class="flex mt-2">
                    <button :disabled="graduate.details.achievements == null" type="button" @click="openSelectedAchievements(key)"
                        class="inline-flex w-full items-center justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Achievements
                        <span v-if="graduate.details.achievements !=null"
                            class="inline-flex justify-center items-center ml-2 w-4 h-4 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                            {{ graduate.details.achievements.length
                            }}
                        </span>
                        <span v-else> &nbsp; (No Achievements Yet)</span>
                    </button>
                </div>
                <div v-if="key == globalkey" class="grid mt-5 grid-cols-4">
                    <kbd v-for="(achievements, achievement_key) in graduate
                    .details.achievements" :key="achievement_key"
                        class="p-2 m-1 text-xs font-semibold text-center text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 mx-auto text-yellow-600  h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                        </svg>
                        {{
                                achievements
                        }}</kbd>
    
                </div>
    
                <blockquote>
                    <p class="text-sm italic mt-5 font-bold ">
                        " {{ graduate.details.moto }} "
                    </p>
                </blockquote>
            </div>
        </div>
        <Pagination v-bind:links="$page.props.graduates.links" />
    </div>
</template>
