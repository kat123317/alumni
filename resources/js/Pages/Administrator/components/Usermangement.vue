<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  computed} from 'vue';
import route from '../../../../../vendor/tightenco/ziggy/src/js';

import moment from 'moment';
import Pagination from '../../Pagination.vue';

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
                                    Picture
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Fullname
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    College
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Course
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    address
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Civil Status
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Current Work
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Gender
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
                                    Applied at
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Status
                                </th>
                        
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(users, index) in usePage().props.value.users" :key="index" class="bg-white border-b ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900">
                                    <img :src=users.profile_photo_url>
                                </th>
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900">
                                    {{ users.name }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ users.college.name }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.course.abbreviation }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.details.address }}
                                </td>
                                <td class="py-4 px-6">
                                    <span v-if="users.details.civil_status == 1">Single</span>
                                    <span v-else-if="users.details.civil_status == 2">Married</span>
                                    <span v-else-if="users.details.civil_status == 3">Divorce</span>
                                </td>
                                <td class="py-4 px-6">
                                    {{ users.details.current_work }}
                                </td>
                                <td class="py-4 px-6">
                                    <span v-if="users.details.gender == 1">Male</span>
                                    <span v-else-if="users.details.gender == 2">Female</span>
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
                                    {{ date_conversion(users.created_at) }}
                                    <br>
                                    {{ date_conversion_from_now(users.created_at) }}
                                </td>
                                <td class="py-4 px-6">
                                    <span v-if="users.status == 'approved'" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Approved</span>
                                    <span v-else-if="users.status == 'rejected'" class="bg-pink-100 text-pink-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">Declined</span>
                                    <span v-else-if="users.status == 'pending' && usePage().props.value.user.user_type == 'staff_admin'" class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded ">Pending</span>
                                    <span v-else-if="users.status == 'pending' && usePage().props.value.user.user_type == 'admin'" class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Pre - approved</span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="#" class="font-medium text-green-600 hover:underline mr-2">Approve</a>
                                    <a href="#" class="font-medium text-red-600 hover:underline">Decline</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    
                </div>

        </div>
      </div>
    </section>
    </template>