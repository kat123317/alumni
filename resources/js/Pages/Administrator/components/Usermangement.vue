<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  computed} from 'vue';
import route from '../../../../../vendor/tightenco/ziggy/src/js';

import moment from 'moment';
import Pagination from '../../Pagination.vue';
import { Inertia } from '@inertiajs/inertia';

const date_conversion = (value) => {
            if (value) {
                return moment(value).format('MMMM Do YYYY')
            }
        }
const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow()
    }
}

const deactivate_data = useForm({
    id:''
})

const add_staff_admin_data = useForm({
    id:''
})

const remove_staff_admin_data = useForm({
    id:''
})

const activate_data = useForm({
    id:''
})

const deactivate_user = (id, type) => {
    if(id == usePage().props.value.user.id){
        alert('Cannot deactivate your account')
    }
    else if(usePage().props.value.user.user_type == 'staff_admin' && type == 'admin'){
        alert('Only super admin have the previledge to deactivate and activate account')
    }
    else{
        deactivate_data.id = id
        deactivate_data.put(route('deactivate_user', [deactivate_data.id]),{
            preserveScroll:true,
                onSuccess: () => {
                    // onAlert('Delete')
                    alert('Deactivated')
                }
        })
    }
    
}

const activate_user = (id) => {
    activate_data.id = id
    activate_data.put(route('activate_user', [activate_data.id]),{
        preserveScroll:true,
            onSuccess: () => {
                // onAlert('Delete')
                alert('Activated')
            }
    })
}

const function_assign_as_admin = (id) => {
    add_staff_admin_data.id = id
    add_staff_admin_data.put(route('assign_as_admin', [add_staff_admin_data.id]),{
        preserveScroll:true,
            onSuccess: () => {
                // onAlert('Delete')
                alert('Assign as admin complete')
            }
    })
}

const function_remove_as_admin = (id) => {
    remove_staff_admin_data.id = id
    remove_staff_admin_data.put(route('remove_as_admin', [remove_staff_admin_data.id]),{
        preserveScroll:true,
            onSuccess: () => {
                // onAlert('Delete')
                alert('Removed as admin complete')
            }
    })
}


</script>
<template>

    <section  class="text-gray-600 body-font relative">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">User Management</h1>
        </div>
        <div class="lg:w-full md:w-2/3 mx-auto">
            <nav class="mb-10  flex justify-end" aria-label="Page navigation example">
                <form>   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
            </nav>
       
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Fullname & Email
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    College & course
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    address
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Civil Status & gender
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Current Work
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Phone number
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Religion
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Year graduated
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Applied at
                                </th>
                        
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(users, index) in usePage().props.value.users" :key="index" class="bg-white border-b ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900">
                                    <div class="pl-3">
                                        <img class="w-10 h-10 rounded-full" :src=users.profile_photo_url alt="Jese image">
                                        <div class="text-base font-semibold">{{ users.name }}</div>
                                        <div class="font-normal text-gray-500">{{ users.email }}</div>
                                    </div>  
                                </th>
                                <td class="py-4 px-6">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ users.college.abbreviation }}</div>
                                        <div class="font-normal text-gray-500">{{ users.course.abbreviation }}</div>
                                    </div>  
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.details.address }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            <span v-if="users.details.civil_status == 1">Single</span>
                                            <span v-else-if="users.details.civil_status == 2">Married</span>
                                            <span v-else-if="users.details.civil_status == 3">Divorce</span>
                                        </div>
                                        <div class="font-normal text-gray-500">
                                            <span v-if="users.details.gender == 1">Male</span>
                                            <span v-else-if="users.details.gender == 2">Female</span>   
                                        </div>
                                    </div> 
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.details.current_work }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.details.phone_number }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.details.religion }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.details.year_graduated }}
                                </td>
                                
                                <td class="py-4 px-6">
                                    <span v-if="users.user_type == 'alumni'" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Alumni</span>
                                    <span v-else-if="users.user_type == 'staff_admin'" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Staff Administrator</span>
                                    <span v-else-if="users.user_type == 'admin'" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Super Administrator</span>
                                </td>
                                <td class="py-4 px-6 w-full">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ date_conversion(users.created_at) }}</div>
                                        <div class="font-normal text-gray-500">{{ date_conversion_from_now(users.created_at) }}</div>
                                    </div>  
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            <a v-if="users.user_type == 'staff_admin'" @click="function_remove_as_admin(users.id)" href="#" class="font-medium text-red-600 hover:underline mr-2">Remove as staff</a>
                                            <a v-else-if="users.user_type == 'alumni'" @click="function_assign_as_admin(users.id)" href="#" class="font-medium text-green-600 hover:underline mr-2">Assign as staff</a>
                                        </div>
                                        <div class="text-base font-semibold">
                                            <a v-if="users.is_active == 1 && users.user_type !='admin'" @click="deactivate_user(users.id, users.user_type)" href="#" class="font-medium text-red-600 hover:underline">Deactivate</a>
                                            <a v-else-if="users.is_active == 0" @click="activate_user(users.id)" href="#" class="font-medium text-red-600 hover:underline">Activate</a>
                                        </div>
                                    </div>  
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    
                </div>

        </div>
      </div>
    </section>
    </template>