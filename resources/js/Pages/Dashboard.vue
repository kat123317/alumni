<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  } from 'vue';


import moment from 'moment'

const date_conversion = (value) => {
            if (value) {
                return moment(value).format('MMMM Do YYYY, h:mm:ss a')
            }
        }
const option_view  = ref(true)


onMounted(() => {
    const ramUsage = window.performance.memory;

    console.log("=-----------RAM----------= ", ramUsage)
})


const form_announcement = useForm({
    search_text:(usePage().props.value.search_text != null) ? usePage().props.value.search_text : null,
})

const search_announcement = () => {
    form_announcement.get(route('search_announcement'))
    // alert(form_announcement.text_search)
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Announcements
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Announcements
                    </a>
                    </li>
                   
                </ol>
            </nav>

                <div class="bg-white p-5 overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- <Welcome /> -->
                    
                    <div class="grid grid-flow-row-dense grid-cols-1 sm:grid-cols-3  grid-rows-1 ...">   
                    <div class="lg:mr-5 mb-10">
                        <div class=" bg-white p-2 rounded-lg border shadow-md sm:p-8">
                            <time class="text-lg font-semibold text-gray-900">Notifications</time>
                            <ol class="mt-3 divide-y max-h-[40vmin] overflow-hidden overflow-y-auto divider-gray-200">
                                <li v-for="(notifications, key) in usePage().props.value.notifications" :key="key">
                                    <a href="#" class="block items-center p-3 sm:flex hover:bg-gray-100">
                                        <img class="mr-3 mb-3 w-12 h-12 rounded-full sm:mb-0" src="https://th.bing.com/th/id/R.b4d35e6241b2840e8d62ae852f42ff38?rik=TqLvw0YR%2bKrNlw&riu=http%3a%2f%2fmattingly.design%2farticles%2fwp-content%2fuploads%2f2019%2f10%2fpied-piper-3.gif&ehk=r6%2ftXJgnQShtzu6PZbpJGRTVdXca%2fvgy5CN2NugQRuw%3d&risl=&pid=ImgRaw&r=0" alt="Jese Leos image">
                                        <div class="text-gray-600">
                                            <div class="text-base font-normal"><span class="font-medium text-gray-900">{{ notifications.title }}</span>
                                                <span class="inline-flex items-center ml-2 text-xs font-normal text-gray-500">
                                                <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path></svg>
                                                {{ (notifications.user_type == 1) ? 'Public':'Staff' }}
                                            </span> 
                                         </div>
                                        <em class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ notifications.user.name }}</em>
                                         <div class="text-sm font-normal truncate">"{{ notifications.content }}"</div>
                                         <button type="button" class="text-white  text-xs bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Show More</button>
                                        </div>
                                    </a>
                                </li>
                            </ol>
                            
                     
                        </div>
                        <div class="p-4 mt-10  bg-white rounded-lg border shadow-md sm:p-8">
                            <div class="flex justify-between items-center mb-4">
                                <h5 class="text-xl font-bold leading-none text-gray-900 ">Colleges</h5>
                            </div>
                                <div class="flow-root">
                                    <ul role="list" class="divide-y divide-gray-200">
                                        <li v-for="(colleges, key) in usePage().props.value.colleges" :key="key" class="py-3 sm:py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    <img class="w-8 h-8 rounded-full" src="https://th.bing.com/th/id/R.b4d35e6241b2840e8d62ae852f42ff38?rik=TqLvw0YR%2bKrNlw&riu=http%3a%2f%2fmattingly.design%2farticles%2fwp-content%2fuploads%2f2019%2f10%2fpied-piper-3.gif&ehk=r6%2ftXJgnQShtzu6PZbpJGRTVdXca%2fvgy5CN2NugQRuw%3d&risl=&pid=ImgRaw&r=0" alt="Neil image">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate" :title="colleges.name">
                                                        College of {{ colleges.name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate ">
                                                        {{ colleges.abbreviation }}
                                                    </p>
                                                </div>
                                                <div class="inline-flex items-center text-base font-semibold text-gray-900 ">

                                                </div>
                                            </div>
                                        </li>
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                       

                            <div class="col-span-2 w-full rounded-lg border shadow-md sm:p-8 px-10">
                                <!-- <pie-chart :data="[['Blueberry', 44], ['Strawberry', 23]]"></pie-chart> -->
                               
                                <div class="container mb-5 p-5 grid  grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mx-auto">
                                    
                                    <div  v-for="(colleges, key) in usePage().props.value.colleges" :key="key">
                                        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                            <div class="flex-auto p-4">
                                                <div class="flex flex-row -mx-3">
                                                    
                                                <div class="flex-none w-2/3 max-w-full px-3">
                                                    
                                                    <div>
                                                    <h1 class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">{{ colleges.abbreviation }}</h1>
                                                    <h5 class="mb-2 font-bold text-md"># of Courses: <span class="mb-2 font-bold text-sm">{{ colleges.courses.length }}</span></h5>
                                                    <span v-for="(courses, key) in colleges.courses" :key="key">
                                                        <h5 class="mb-2 font-bold text-md">{{ courses.abbrevation }}: <span class="mb-2 font-bold text-sm">{{ courses.users_count }}</span></h5>
                                                    </span>
                                                    </div>       
          
                                                </div>
                                                
                                                <div class="px-3 text-right basis-1/3 ">
                                                    <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-yellow-500 to-yellow-500">
                                                        <svg class="w-6 h-6 m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="flex justify-center w-auto bg-red-50">
                                                <pie-chart :colors="['#b00', '#666']" :data="[['Blueberry', 23],['SSD', 63], ['Overall', usePage().props.value.users.length]]" :donut="false"></pie-chart>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                        <div class="flex-auto p-4">
                                           
                                            <div class="flex flex-row -mx-3">
                                            <div class="flex-none w-2/3 max-w-full px-3">
                                                <div>
                                                <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">TOTAL Users</p>
                                                <h5 class="mb-2 font-bold text-md">{{ usePage().props.value.users.length }}</h5>
                                               
                                                </div>
                                            </div>
                                          
                                            <div class="px-3 text-right basis-1/3">
                                                <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-blue-500 to-blue-500">
                                                    <svg class="w-6 h-6  m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- HERE -->
                                                <div class="flex justify-center w-auto bg-red-50">
                                                <pie-chart :data="[['Blueberry', 23],['SSD', 63], ['Overall', usePage().props.value.users.length]]" :donut="false"></pie-chart>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <time class="text-lg font-semibold  text-gray-900 ">Announcements</time>
                        
                                <div class="flex mt-5 items-center">   
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input v-model="form_announcement.search_text" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5" placeholder="Search" required>
                                    </div>
                                    <button  @click="search_announcement()" class="p-2.5 ml-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                                

                                
                                <ol class="relative mt-10 border-b  z-20 overflow-auto max-h-[120vmin]">
                                 
                                    <li  v-for="(announcements, key) in usePage().props.value.announcements" :key="key" class="mb-5 px-10 border-b-1 bg-gray-100 rounded p-5 border-gray-500">
                                        <div class="flex ">             
                                              <img width="35" class="mr-2" src="https://th.bing.com/th/id/R.b4d35e6241b2840e8d62ae852f42ff38?rik=TqLvw0YR%2bKrNlw&riu=http%3a%2f%2fmattingly.design%2farticles%2fwp-content%2fuploads%2f2019%2f10%2fpied-piper-3.gif&ehk=r6%2ftXJgnQShtzu6PZbpJGRTVdXca%2fvgy5CN2NugQRuw%3d&risl=&pid=ImgRaw&r=0" alt="">
                                              <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 ">{{ announcements.title }}<span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded ml-3">{{ date_conversion(announcements.created_at) }}</span></h3>
                                        </div>
                                      
                                        <time class="block mb-5 ml-10 text-sm font-normal leading-none text-gray-400"> {{ announcements.user.name }} </time>
                                        <p class="mb-4 text-base font-normal text-gray-500">{{ announcements.content }}</p>
                                        
                                    </li>
                               
                                </ol>
                         </div>
                    </div>
              
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
/* width */
::-webkit-scrollbar {
  width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>