<script setup>
import {defineProps,defineEmits, ref ,onMounted} from "vue";
const props = defineProps({
    showHide: {
        type: Boolean,
        default:false
    }
})

const emits = defineEmits(['closeModal'])

const dataToSend = ref({
   "id": "",
   "title": "",
   "description": "",
   "contact": "",
   "salary": ""
})


</script>

<template>
    <section >
        <div class="relative z-20   flex justify-center">
            <div v-if="showHide" class="fixed fade-in backdrop-blur-sm inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <span class=" sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>
                    <div
                        class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle">
                        <h3 class="text-lg font-medium leading-6 text-gray-800 capitalize dark:text-white"
                            id="modal-title">
                            Create Job/Work
                        </h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                         Post Details
                        </p>

                      
                            <label for="Input-Details" class="text-sm text-gray-700 dark:text-gray-200">
                                Input Details
                            </label>
                            {{dataToSend.title}}
                            <label class="block mt-3" for="title">
                                <input type="text" name="title" id="title" placeholder="Job Title" v-model="dataToSend.title"
                                    class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                            </label>

                            <label class="block mt-3" for="Description">
                                <textarea type="Description" name="Description" id="Description" v-model="dataToSend.description"
                                    placeholder="Job Description"
                                    class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300"></textarea>
                            </label>


                            <label class="block mt-3" for="contact">
                                <input type="text" name="contact" id="contact" placeholder="Contact Email" v-model="dataToSend.contact"
                                    class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                            </label>

                            
                            <label class="block mt-3" for="Salary">
                                <input type="text" name="Salary" id="Salary" placeholder="Salary" v-model="dataToSend.salary"
                                    class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                            </label>
                            <div  class="mt-4 sm:flex sm:items-center sm:-mx-2">
                                <button type="button" @click="$emit('closeModal')"
                                    class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                    Cancel
                                </button>

                                <button  type="button"
                                    class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                    Post Job
                                </button>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>

    </section>

</template>



<style scoped>
.fade-in {
	-webkit-animation: fade-in 1.2s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
	        animation: fade-in 1.2s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
}
@-webkit-keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>