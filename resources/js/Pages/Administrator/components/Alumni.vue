<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';

const image_name = ref('');
const tmp_achievement = ref('');
const form_alumni = useForm({
    firstname: '',
    middlename: '',
    lastname: '',
    suffix: '',
    details: {
        achievements: [],
        moto: '',
        profile_picture: ''
    },
    yearbook_id: null,
    college_id: null,
    course_id: null,
    profile_data: null
});

const courses = computed(() => {
    if (form_alumni.college_id == null) {
        return [];
    } else {
        return usePage().props.value.colleges.find(c => c.id == form_alumni.college_id).courses;
    }
});

const openFile = () => {
    let hidden = document.getElementById("alumni-hidden-input");
    hidden.click();
    hidden.onchange = (e) => { 
        let file = e.target.files[0]
        image_name.value = file.name;
        form_alumni.profile_data = file;
    };
    }

const addAlumni = () => {
    form_alumni.post(route('graduates.store'),{
        preserveScroll:true,
        onSuccess: () => {
            form_alumni.reset();
        }
    })
}

const addAchievement = () => {
    form_alumni.details.achievements.push(tmp_achievement.value);
    tmp_achievement.value = '';
}
</script>
<template>
    <section  class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Add a Alumnus</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Add Alumni Here</p>
        </div>
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
        <div class="flex flex-wrap -m-2">
            
            <div class="p-2 w-full">
                <div class="relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">School Year</label>
                    <select v-model="form_alumni.yearbook_id" id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option :value="null" disabled>Select School Year</option>
                        <template v-for="yearbook in $page.props.yearbooks">
                            <option :value="yearbook.id">{{ yearbook.schoolyear_from+'-'+yearbook.schoolyear_to }}</option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="p-2 w-1/2">
            <div class="relative">
                <label for="name" class="leading-7 text-sm text-gray-600">First Name</label>
                <input v-model="form_alumni.firstname" type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="name" class="leading-7 text-sm text-gray-600">Middle Name</label>
                    <input v-model="form_alumni.middlename" type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="name" class="leading-7 text-sm text-gray-600">Last Name</label>
                    <input v-model="form_alumni.lastname" type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">Suffix (Optional)</label>
                    <input v-model="form_alumni.suffix" type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="image" class="leading-7 text-sm text-gray-600">Image</label>
                    <input v-model="image_name" type="text" id="image" name="image" readonly class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <input id="alumni-hidden-input" type="file" class="hidden" accept="image/png, image/gif, image/jpeg"/>
                    <button @click="openFile" class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                        Select Logo
                    </button>
                </div>
                
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">Add Achievement</label>
                    <div class="flex items-center">   
                        <div class="relative w-full">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-6 h-6 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            </div>
                            <input v-model="tmp_achievement" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Achievement" required>
                        </div>
                        <button @click="addAchievement()" type="button" class="p-2.5 ml-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            <span class="sr-only">Add</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-2 w-1/2">
            <div class="relative">
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Achievements</h2>
            <ul class="space-y-1 max-w-md list-disc list-inside text-gray-500 dark:text-gray-400">
                <template v-for="achivement in form_alumni.details.achievements">
                    <li>
                        {{achivement}}
                    </li>
                </template>
            </ul>
            </div>
            </div>
            <div class="p-2 w-1/2">
            <div class="relative">
                <label for="name" class="leading-7 text-sm text-gray-600">College</label>
                <select v-model="form_alumni.college_id" id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option :value="null" disabled>Select College</option>
                    <template v-for="college in $page.props.colleges">
                        <option :value="college.id">{{ college.name }}</option>
                    </template>
                </select>
            </div>
            </div>
            <div class="p-2 w-1/2">
                <div class="relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">Course</label>
                    <select v-model="form_alumni.course_id" id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option :value="null" disabled>Select Course</option>
                        <template v-for="course in courses">
                            <option :value="course.id">{{ course.name }}</option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="p-2 w-full">
            <div class="relative">
                <label for="message" class="leading-7 text-sm text-gray-600">Motto</label>
                <textarea v-model="form_alumni.details.moto" id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
            </div>
            </div>
            <div class="p-2 w-full">
            <button @click="addAlumni()" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Submit</button>
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
</template>