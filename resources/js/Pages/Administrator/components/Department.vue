<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onMounted,  computed} from 'vue';
import route from '../../../../../vendor/tightenco/ziggy/src/js';

const modal_update = ref(false)
const modal_delete = ref(false)

const alertOn = ref(false)
const alertOnUpdate = ref(false)
const alertOnDelete = ref(false)
const alertOnError = ref(false)

const onAlert = (data) => {
    if(data == 'Success'){
        alertOn.value = true;
    }else if(data == 'Update'){
        alertOnUpdate.value = true
    }else if(data == 'Delete'){
        alertOnDelete.value = true
    }else{
        alertOnError.value = true
    }

    setTimeout(() => {
        if(data == 'Success'){
        alertOn.value = false;
        }else if(data == 'Update'){
            alertOnUpdate.value = false
        }else if(data == 'Delete'){
            alertOnDelete.value = false
        }else{
            alertOnError.value = false
        }
    }, 4000);
}


const college_data = useForm({
    name:'',
    abbreviation:'',
    logo:'',
})

const update_college_data = useForm({
    id:'',
    name:'',
    abbreviation:'',
    logo:'',
})

const delete_college_data = useForm({
    id:''
})

const function_add_college = () => {
  if(college_data.name == '' || college_data.abbreviation == '' || college_data.logo == ''){
    onAlert('Others')
  }
  else{
    college_data.post(route('colleges.store'),{
            preserveScroll:true,
            onSuccess: () => {
                college_data.reset()
                onAlert('Success')
            }
        })
  }
}

const function_open_update_modal = (id, name, abbreviation, logo) => {
  update_college_data.id = id;
  update_college_data.name = name;
  update_college_data.abbreviation = abbreviation;
  update_college_data.logo = logo;
  modal_update.value  = ! modal_update.value;
}

const function_update_college = () => {
  update_college_data.put(route('colleges.update', [update_college_data.id]),{
            preserveScroll:true,
            onSuccess: () => {
                college_data.reset()
                onAlert('Update')
                modal_update.value  = ! modal_update.value;

            }
        })
}

const function_open_delete_modal= (id) => {
  delete_college_data.id = id;
  modal_delete.value  = ! modal_delete.value;

}

const function_delete_college = () => {
  delete_college_data.delete(route('colleges.delete', [delete_college_data.id]),{
            preserveScroll:true,
            onSuccess: () => {
                college_data.reset()
                onAlert('Delete')
                modal_delete.value  = ! modal_delete.value;

            }
        })
}
</script>
<template>
<section  class="text-gray-600 body-font relative">
    
    <div v-if="alertOn" class="bg-green-100 alertanim text-center py-4 lg:px-4">
            <div class="p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                <span class="font-semibold mr-2 text-left flex-auto">College Successfully added</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>
        </div>  
        <div v-if="alertOnUpdate" class="bg-blue-100 alertanim text-center py-4 lg:px-4">
            <div class="p-2 bg-blue-800 items-center text-blue-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-blue-500 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                <span class="font-semibold mr-2 text-left flex-auto">College Successfully updated</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>
        </div>
        <div v-if="alertOnDelete" class="bg-red-100 alertanim text-center py-4 lg:px-4">
            <div class="p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                <span class="font-semibold mr-2 text-left flex-auto">College Successfully deleted</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>
        </div>  
        <div v-if="alertOnError" class="bg-gray-100 text-center py-4 lg:px-4">
            <div class="p-2 bg-gray-800 items-center text-gray-100 alertanim leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold mr-3">Notice</span>
                <span class="font-semibold mr-2 text-left flex-auto">Fill Empty fields</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>
        </div> 
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Add College</h1>

    </div>
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-1/3">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">Abbreviation</label>
            <input v-model="college_data.abbreviation" type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-[52vmin]">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-gray-600">College</label>
            <input v-model="college_data.name" type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-full">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-gray-600">Logo Link</label>
            <input v-model="college_data.logo" type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
     
        <div class="p-2 w-full">
          <button @click="function_add_college()" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Add</button>
        </div>
        <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
            
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
                            Logo
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Actions
                        </th>

                    </tr>
                </thead>
                <tbody v-for="(colleges, key) in usePage().props.value.colleges" :key="key">
                    <tr>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                            {{ colleges.name }}
                        </th>
                        <td class="py-4 px-6">
                            {{ colleges.abbreviation }}
                        </td>
                        <td class="py-2 px-6">
                            <img :src=colleges.logo class="h-[5vmin]">
                        </td>
                        <td class="py-4 px-6">
                            <a href="#" @click="function_open_update_modal(colleges.id, colleges.name, colleges.abbreviation, colleges.logo)" class="font-medium text-green-600">Edit</a>
                            <a href="#" @click="function_open_delete_modal(colleges.id)" class="font-medium ml-2 text-red-600">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>      

        </div>
      </div>
    </div>



    <div v-if="modal_update" class=" ">
        <div id="popup-modal" tabindex="-1" class="overflow-y-auto  flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">Abbreviation</label>
                                    <input v-model="update_college_data.abbreviation" type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                    <input v-model="update_college_data.name" type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="title" class="leading-7 text-sm text-gray-600">Logo</label>
                                    <input v-model="update_college_data.logo" type="text" id="title" name="title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                                </div>
                            </div>
                    <button @click="function_open_update_modal()" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to update this college?</h3>
                        <button @click="function_update_college()" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button @click="function_open_update_modal()" data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="modal_delete">
        <div id="popup-modal" tabindex="-1" class="overflow-y-auto flex justify-center backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative p-4 animate w-full max-w-md h-full mt-[20vmin] transition ease-in-out md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <button @click="function_open_delete_modal()" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this College?</h3>
                        <button @click="function_delete_college()" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button @click="function_open_delete_modal()" data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
</section>
</template>