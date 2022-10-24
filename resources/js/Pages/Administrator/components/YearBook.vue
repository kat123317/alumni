<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  computed, provide, inject} from 'vue';
import route from '../../../../../vendor/tightenco/ziggy/src/js';

import moment from 'moment';
import Pagination from '../../Pagination.vue';
import { Inertia } from '@inertiajs/inertia';

const trigger = inject('trigger')
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

const search_data = useForm({
    user_search_key:usePage().props.value.user_search_key? usePage().props.value.user_search_key:''
})

const yearbook_data = useForm({
    from:'',
    to:''
})
 provide('user_search_key', search_data.user_search_key)
</script>
<template>

    <section  class="text-gray-600 body-font relative">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Add Year book</h1>
            <div class="p-2 w-full">
                <div class="relative">
                <label for="name" class="leading-7 text-sm text-gray-600">From</label>
                <input v-model="yearbook_data.from" type="date" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
            <div class="p-2 w-full">
                <div class="relative">
                <label for="name" class="leading-7 text-sm text-gray-600">To</label>
                <input v-model="yearbook_data.to" type="date" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>
        </div>
        <div class="p-2 w-full">
            <button @click="function_add_yearbook()" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Add</button>
        </div>
        <div class="lg:w-full md:w-2/3 mx-auto">
            <nav class="mb-10  flex justify-end" aria-label="Page navigation example">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input v-model="search_data.user_search_key" type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
                        <button @click="function_yearbook_user()" type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
            </nav>
       
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    School year from
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    School year to
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(yearbooks, index) in usePage().props.value.yearbooks.data" :key="index" class="bg-white border-b ">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900">
                                    <div class="pl-3">
                                        <div class="font-normal text-gray-500">{{ yearbooks.from }}</div>
                                    </div>  
                                </th>
                                <td class="py-4 px-6">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ yearbooks.to }}</div>
                                    </div>  
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            <a   href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                            <a  href="#" class="font-medium text-red-600 hover:underline">Delete</a>
                                        </div>
                                    </div>  
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="px-4 w-100 py-3 flex items-center justify-center border-gray-200 sm:px-6">
                        <Pagination v-bind:links="$page.props.events.links"/>
                    </div>
                </div>

        </div>
      </div>
    </section>
    </template>