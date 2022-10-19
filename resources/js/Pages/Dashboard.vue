<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  computed} from 'vue';


import moment from 'moment'

const date_conversion = (value) => {
            if (value) {
                return moment(value).format('MMMM Do YYYY, h:mm:ss a')
            }
        }
const option_view  = ref(true)

const chart_total_array = computed(() => {
    let chart_array = [];
    let count_registered_user = 0;

    for (let i = 0; i < usePage().props.value.colleges.length; i++) {
        usePage().props.value.colleges[i].users.forEach(users => {
            if(users.status == 'approved'){
                count_registered_user += 1;
            }
        });
        chart_array.push([usePage().props.value.colleges[i].name,count_registered_user])
        count_registered_user=0

    }
    return chart_array
})

const chart_colleges_array = computed(() => {
    let chart_array = {};
    for (let i = 0; i < usePage().props.value.colleges.length; i++) {
        let pie_data = []
        
        usePage().props.value.colleges[i].courses.forEach(course => {
            let count_registered_user = 0;
            course.users.forEach(users => {
                if(users.status == 'approved'){
                    count_registered_user += 1;
                }
            });
            pie_data.push([course.abbreviation, count_registered_user])
            count_registered_user=0

        });
        let key = usePage().props.value.colleges[i].abbreviation
        chart_array[key] = pie_data
    }
    return chart_array
})

onMounted(() => {
    // const ramUsage = window.performance.memory;

    // console.log("=-----------RAM----------= ", ramUsage)
})

const form_announcement = useForm({
    search_text:(usePage().props.value.search_text != null) ? usePage().props.value.search_text : null,
})

const search_announcement = () => {
    form_announcement.get(route('dashboard'))
    // alert(form_announcement.text_search)
}


const total_users_model = ref('0')

const total_users_line = ref(false)
const total_users_pie = ref(true)
const total_users = () => {
    if(total_users_model.value == 1)
    {
        total_users_pie.value = true
        total_users_line.value =false
    }
    else if(total_users_model.value == 2){
        total_users_pie.value = false
        total_users_line.value =true
    }
}
</script>

<template>
    <AppLayout title="Dashboard">

        
        <!-- component -->
<aside class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
    <div>
        <div class="-mx-6 px-6 py-4">
            <a href="#" title="home">
                <img src="https://tailus.io/sources/blocks/stats-cards/preview/images/logo.svg" class="w-32" alt="tailus logo">
            </a>
        </div>

        <div class="mt-8 text-center">
            <img src="https://tailus.io/sources/blocks/stats-cards/preview/images/second_user.webp" alt="" class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
            <h5 class="hidden mt-4 text-xl font-semibold text-gray-600 lg:block">REGEI</h5>
            <span class="hidden text-gray-400 lg:block">Admin</span>
        </div>

        <ul class="space-y-2 tracking-wide mt-8">
            <li>
                <a href="#" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-white bg-gradient-to-r from-sky-600 to-cyan-400">
                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                        <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                        <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current group-hover:text-sky-300"></path>
                    </svg>
                    <span class="-mr-1 font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Categories</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Reports</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                    </svg>
                    <span class="group-hover:text-gray-700">Other data</span>
                </a>
            </li>
            <li>
                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                    <span class="group-hover:text-gray-700">Finance</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
        <button class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="group-hover:text-gray-700">Logout</span>
        </button>
    </div>
</aside>
<div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5">
        <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
            <h5 hidden class="text-2xl text-gray-600 font-medium lg:block">Dashboard</h5>
            <button class="w-12 h-16 -mr-2 border-r lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex space-x-4">
                <!--search bar -->
                <div hidden class="md:block">
                    <div class="relative flex items-center text-gray-400 focus-within:text-cyan-400">
                        <span class="absolute left-4 h-6 flex items-center pr-3 border-r border-gray-300">
                        <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 fill-current" viewBox="0 0 35.997 36.004">
                            <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"></path>
                        </svg>
                        </span>
                        <input type="search" name="leadingIcon" id="leadingIcon" placeholder="Search here" class="w-full pl-14 pr-4 py-2.5 rounded-xl text-sm text-gray-600 outline-none border border-gray-300 focus:border-cyan-300 transition">
                    </div>
                </div>
                <!--/search bar -->
                <button aria-label="search" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200 md:hidden">
                    <svg xmlns="http://ww50w3.org/2000/svg" class="w-4 mx-auto fill-current text-gray-600" viewBox="0 0 35.997 36.004">
                        <path id="Icon_awesome-search" data-name="search" d="M35.508,31.127l-7.01-7.01a1.686,1.686,0,0,0-1.2-.492H26.156a14.618,14.618,0,1,0-2.531,2.531V27.3a1.686,1.686,0,0,0,.492,1.2l7.01,7.01a1.681,1.681,0,0,0,2.384,0l1.99-1.99a1.7,1.7,0,0,0,.007-2.391Zm-20.883-7.5a9,9,0,1,1,9-9A8.995,8.995,0,0,1,14.625,23.625Z"></path>
                    </svg>
                </button>
                <button aria-label="chat" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </button>
                <button aria-label="notification" class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="px-6 pt-6 2xl:container">
        <div  class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div class="md:col-span-2 lg:col-span-1" v-for="(colleges, key) in usePage().props.value.colleges" :key="key" >
                <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    <!-- <pie-chart  :data="chart_colleges_array[colleges.abbreviation]" legend="left" :donut="false"></pie-chart> -->
                    <div>
                        <h5 class="text-xl text-gray-600 text-center">{{ colleges.abbreviation }}</h5>
                        <div class="mt-2 flex justify-center gap-4">
                            <!-- <h3 class="text-3xl font-bold text-gray-700">{{ colleges.courses.length }}</h3> -->
                            <div class="flex items-end gap-1 text-green-500">
                                <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                </svg>
                                <span>{{ colleges.courses.length }} </span>
                            </div>
                        </div>
                        <span class="block text-center text-gray-500">  College of {{ colleges.name }}</span>
                    </div>
                       <pie-chart class="w-[20vmin]" :data="chart_colleges_array[colleges.abbreviation]" legend="left" :donut="true"></pie-chart>
                     
                </div>
            </div> 
            <div class="md:col-span-2 lg:col-span-1" >
                <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    <div>
                        <h5 class="text-xl text-gray-600 text-center">Total</h5>
                        <div class="mt-2 flex justify-center gap-4">
                          
                            <div class="flex items-end gap-1 text-green-500">
                                <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                </svg>
                                
                            </div>
                        </div>
                        <pie-chart :data="chart_total_array" legend="bottom" :donut="false"></pie-chart>
                    </div>
                </div>
            </div> 
            
        </div>
        
    </div>
    <select class="mb-2 mt-10 ml-5 block p-2 px-[4vmin] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-lg focus:ring-green-500 focus:border-green-500" v-model="total_users_model" @change="total_users(total_users_model)">
        <option value="0" disabled>Select Charts</option>
        <option value="1">Pie Chart</option>
        <option value="2">Line Chart</option>
    </select>
    <div v-if="total_users_pie" class="container mb-5 p-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                
                <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">TOTAL Users by colleges:  <span class="mb-2 font-bold text-md">{{ usePage().props.value.users.length }}</span> user/users</p>
                    </div>
                </div>
                
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-green-500 to-green-500">
                        <svg class="w-6 h-6  m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                </div>
                
                    <div class="flex justify-left w-auto bg-gray-50">
                        <pie-chart :data="chart_total_array" legend="bottom" :donut="false"></pie-chart>
                    </div>
            </div>
        </div>
    </div>
    <div v-if="total_users_line" class="container mb-5 p-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
            
                <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">Users in line graph: <span class="mb-2 font-bold text-md">{{ usePage().props.value.users.length }}</span> user/users</p>
                    </div>
                </div>
            
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-green-500 to-green-500">
                        <svg class="w-6 h-6  m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                </div>
            
                    <div class="flex justify-left w-auto bg-gray-50">
                        <line-chart :data="chart_total_array" legend="bottom" :donut="false"></line-chart>
                    </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 p-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                
                <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                        <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">Graduates</p>
                    </div>
                    
                    <div class="flex  my-5">        
                        <input class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block  pl-10 p-2.5" type="date">
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block  pl-10 p-2.5" type="date">
                    </div>
                </div>
                
                
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-green-500 to-green-500">
                        <svg class="w-6 h-6 m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                    </div>
                </div>
                </div>
                
                    <div class="flex justify-left w-auto bg-gray-50">
                        <column-chart :data="[['1997', 32], ['1998', 46], ['1999', 28], ['2000', 28], ['2001', 28], ['2002', 28], ['2003', 28], ['2004', 100]]"></column-chart>
                    </div>
            </div>
        </div>
    </div>

    <div>
        <!-- component -->
<!-- This is an example component -->
        <div class="max-w-screen-md ml-5 mb-4">
                <h2 class="mb-2 text-4xl flex font-extrabold text-gray-900 dark:text-white">Social Media <svg class="w-10 h-10 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></h2>
                <!-- <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> -->
        </div>
    <div v-for="items in 10" class='flex items-center py-6 bg-white justify-center '> 
            <div  class="rounded-xl border p-5 shadow-md w-9/12 bg-white">
                    <div class="flex w-full items-center justify-between border-b pb-3">
                    <div class="flex items-center space-x-3">
                        <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                        <div class="text-lg font-bold text-slate-700">Joe Smith</div>
                    </div>
                    <div class="flex items-center space-x-8">
                        <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">Category</button>
                        <div class="text-xs text-neutral-500">2 hours ago</div>
                    </div>
                    </div>

                    <div class="mt-4 mb-6">
                    <div class="mb-3 text-xl font-bold">Nulla sed leo tempus, feugiat velit vel, rhoncus neque?</div>
                    <div class="text-sm text-neutral-600">Aliquam a tristique sapien, nec bibendum urna. Maecenas convallis dignissim turpis, non suscipit mauris interdum at. Morbi sed gravida nisl, a pharetra nulla. Etiam tincidunt turpis leo, ut mollis ipsum consectetur quis. Etiam faucibus est risus, ac condimentum mauris consequat nec. Curabitur eget feugiat massa</div>
                    </div>

                    <div>
                    <div class="flex items-center justify-between text-slate-500">
                        <div class="flex space-x-4 md:space-x-8">
                        <div class="flex cursor-pointer items-center transition hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <span>125</span>
                        </div>
                        <div class="flex cursor-pointer items-center transition hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>4</span>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
</div>
        <!-- <div class="py-12">
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
                  
                    
                    <div class="grid grid-flow-row-dense grid-cols-1 sm:grid-cols-3  grid-rows-1 ...">   
                    <div class="lg:mr-5 mb-10">
                        <div class="bg-green-600 rounded-t-lg  p-3">
                            <time class="text-lg text-white font-semibold">Notifications</time>
                        </div>
                        <div class="p-2  border shadow-md sm:p-8">
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
                        <div class="bg-green-600 mt-10 rounded-t-lg  p-3">
                            <time class="text-lg text-white font-semibold">Colleges</time>
                        </div>
                        <div class="p-4   bg-white rounded-lg border shadow-md sm:p-8">
    
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
                                
                                <div class="flex-none w-2/3 max-w-full px-3">
                                                <div>
                                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">Categorized registered users population by courses</p>
                                                </div>
                                            </div>
                                <div class="container mb-5 p-5 grid  grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mx-auto">
                                    
                                    <div  v-for="(colleges, key) in usePage().props.value.colleges" :key="key">
                                        
                                        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                                <div class="bg-green-600 rounded-t-lg  p-2">
                                                <div class="flex justify-between">
                                                <h1 class="mb-0 font-sans text-white font-semibold leading-normal uppercase text-lg">{{ colleges.abbreviation }}</h1>
                                                <h5 class="mb-2 font-bold text-white text-md"># of Courses: <span class="mb-2 font-bold text-sm">{{ colleges.courses.length }}</span></h5>
                                                </div>   
                                             </div>
                                            <div class="flex-auto p-4">
                                                <div class="flex flex-row -mx-3">
                                                    
                                 
                                                </div>
                                                <div class="flex justify-center w-auto bg-gray-50">
                                                    <pie-chart  :data="chart_colleges_array[colleges.abbreviation]" legend="left" :donut="false"></pie-chart>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <select class="mb-2 ml-5 block p-2 px-[4vmin] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-lg focus:ring-green-500 focus:border-green-500" v-model="total_users_model" @change="total_users(total_users_model)">
                                    <option value="0" disabled>Select Charts</option>
                                    <option value="1">Pie Chart</option>
                                    <option value="2">Line Chart</option>
                                </select>
                                <div v-if="total_users_pie" class="container mb-5 p-5">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                                        <div class="flex-auto p-4">
                                           
                                            <div class="flex flex-row -mx-3">
                                            <div class="flex-none w-2/3 max-w-full px-3">
                                                <div>
                                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">TOTAL Users by colleges:  <span class="mb-2 font-bold text-md">{{ usePage().props.value.users.length }}</span> user/users</p>
                                                </div>
                                            </div>
                                            
                                            <div class="px-3 text-right basis-1/3">
                                                <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-green-500 to-green-500">
                                                    <svg class="w-6 h-6  m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                </div>
                                            </div>
                                            </div>
                                         
                                                <div class="flex justify-left w-auto bg-gray-50">
                                                    <pie-chart :data="chart_total_array" legend="bottom" :donut="false"></pie-chart>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="total_users_line" class="container mb-5 p-5">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                                        <div class="flex-auto p-4">
                                           
                                            <div class="flex flex-row -mx-3">
                                            <div class="flex-none w-2/3 max-w-full px-3">
                                                <div>
                                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">Users in line graph: <span class="mb-2 font-bold text-md">{{ usePage().props.value.users.length }}</span> user/users</p>
                                                </div>
                                            </div>
                                          
                                            <div class="px-3 text-right basis-1/3">
                                                <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-green-500 to-green-500">
                                                    <svg class="w-6 h-6  m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                </div>
                                            </div>
                                            </div>
                                           
                                                <div class="flex justify-left w-auto bg-gray-50">
                                                    <line-chart :data="chart_total_array" legend="bottom" :donut="false"></line-chart>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container mb-5 p-5">
                                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                                        <div class="flex-auto p-4">
                                           
                                            <div class="flex flex-row -mx-3">
                                            <div class="flex-none w-2/3 max-w-full px-3">
                                                <div>
                                                    <p class="mb-0 font-sans font-semibold leading-normal uppercase text-lg">Graduates</p>
                                                </div>
                                             
                                                <div class="flex  my-5">        
                                                    <input class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block  pl-10 p-2.5" type="date">
                                                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block  pl-10 p-2.5" type="date">
                                                </div>
                                            </div>
                                           
                                          
                                            <div class="px-3 text-right basis-1/3">
                                                <div class="inline-block w-12 h-12   rounded-circle bg-gradient-to-tl from-green-500 to-green-500">
                                                    <svg class="w-6 h-6 m-auto my-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                                </div>
                                            </div>
                                            </div>
                                         
                                                <div class="flex justify-left w-auto bg-gray-50">
                                                    <column-chart :data="[['1997', 32], ['1998', 46], ['1999', 28], ['2000', 28], ['2001', 28], ['2002', 28], ['2003', 28], ['2004', 100]]"></column-chart>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <time class="text-lg font-semibold  text-gray-900 ">Announcements</time>
                        
                                <div class="flex mt-mb-10 items-center">   
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
                                


                                <ol class="border-l-2 mt-10 border-green-600">
                                    <li  v-for="(announcements, key) in usePage().props.value.announcements" :key="key" >
                                        <div class="flex flex-start items-center">
                                        <div class="bg-green-600 w-4 h-4 flex items-center justify-center rounded-full -ml-2 mr-3 -mt-2"></div>
                                        <img width="35" class="mr-2" src="https://th.bing.com/th/id/R.b4d35e6241b2840e8d62ae852f42ff38?rik=TqLvw0YR%2bKrNlw&riu=http%3a%2f%2fmattingly.design%2farticles%2fwp-content%2fuploads%2f2019%2f10%2fpied-piper-3.gif&ehk=r6%2ftXJgnQShtzu6PZbpJGRTVdXca%2fvgy5CN2NugQRuw%3d&risl=&pid=ImgRaw&r=0" alt="">
                                        <h4 class="text-gray-800 font-semibold text-xl -mt-2">{{ announcements.user.name }} - {{ announcements.title }}</h4>
                                        </div>
                                        <div class="ml-6 mb-6 pb-6">
                                        <a href="#!" class="text-green-600 hover:text-green-700 focus:text-green-800 duration-300 transition ease-in-out text-sm">{{ date_conversion(announcements.created_at) }}</a>
                                        <p class="text-gray-700 mt-5">{{ announcements.content }}</p>
                                       
                                        </div>
                                    </li>
                                 </ol>
                         </div>
                    </div>
              
                </div>
            </div>
        </div> -->
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