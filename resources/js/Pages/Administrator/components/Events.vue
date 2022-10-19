
<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  computed} from 'vue';
import route from '../../../../../vendor/tightenco/ziggy/src/js';

const from_date = ref(usePage().props.value.from_request);
const to_date = ref(usePage().props.value.to_request);

const event_data = useForm({
    from:'',
    to:'',
    title:'',
    content:''
})

const function_submit = () => {
    event_data.from = from_date.value;
    event_data.to = to_date.value;
    event_data.post(route('events.store'), {
            preserveScroll:true,
            onSuccess: () => {
                alert("Added")
                event_data.reset()
            }
        })
}
</script>
<template>
    <section  class="text-gray-600 body-font relative">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Add Events</h1>
    
        </div>
        <div class="lg:w-full md:w-full mx-auto">
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="name" class="leading-7 text-sm text-gray-600">From</label>
                <input v-model="from_date" type="date" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-1/2">
              <div class="relative">
                <label for="name" class="leading-7 text-sm text-gray-600">To</label>
                <input v-model="to_date" type="date" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <label for="title" class="leading-7 text-sm text-gray-600">Title of Event</label>
                <input v-model="event_data.title" type="text" id="title" name="title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your content</label>
                    <textarea v-model="event_data.content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Your content..."></textarea>

              </div>
            </div>
         
            <div class="p-2 w-full">
              <button @click="function_submit()" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Post</button>
            </div>
            <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                
            <!-- <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                College
                            </th>
                            <th scope="col" class="py-3 px-6">
                                ABBR
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Actions
                            </th>
    
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                College of Something
                            </th>
                            <td class="py-4 px-6">
                                COS
                            </td>
                            <td class="py-4 px-6">
                                <a href="#" class="font-medium text-green-600 dark:text-green-500 hover:underline">Edit</a>
                                <a href="#" class="font-medium ml-2 text-green-600 dark:text-green-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>       -->
    
            </div>
          </div>
        </div>
      </div>
    </section>
    </template>