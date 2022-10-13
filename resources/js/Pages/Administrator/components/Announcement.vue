<script setup>
    import { ref, onMounted } from 'vue';


    const collapseVar  = ref(false);
    const checkedData = ref([]);
    const datasample = ref(2);
    const courses = ref([
        {
          "id": 1,
          "name": "COE"
        },
        {
          "id": 1,
          "name": "COD"
        },
        {
          "id": 1,
          "name": "COC"
        },
        {
          "id": 1,
          "name": "COO"
        },
    ]);

</script>





<template>
   <section class="text-gray-600 h-[90vmin] body-font relative">
            <div class="absolute  lg:block hidden inset-0 bg-gray-300">
                <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4700.147561062848!2d125.05044014002942!3d7.859731708811927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32ff184711ed6b0f%3A0xa6348944e8acd9bf!2sCentral%20Mindanao%20University!5e0!3m2!1sen!2sph!4v1665578365379!5m2!1sen!2sph" style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
                
            </div>
            <div class="container px-5 py-24 mx-auto flex">
                <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col  md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
                <h2 class="text-gray-900 text-lg mb-5 font-medium title-font">Post-Announcement</h2>
                
                <div class="relative mb-4">
                    <label for="email" class="leading-7 text-sm text-gray-600">Privacy</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected>Only Me</option>
                        <option value="COE">Private</option>
                        <option value="COED">Public</option>
                    </select>
                </div>
                <div class="relative w-full  mb-4">
                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Department</h3>
                <ul class=" grid grid-cols-2 text-sm  font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 w-100 dark:text-white">
                    <li  v-for="(items, index) in courses" :key="index" class="w-full mr-1 rounded-t-lg border-b dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input id="vue-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="vue-checkbox" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">{{items.name}}</label>
                        </div>
                    </li>
                </ul>

          
                </div>
                <div class="relative mb-4">
                    <label for="message" class="leading-7 text-sm text-gray-600">Announcement</label>
                    <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                </div>
                <button class="text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg">Post</button>
                <p class="text-xs text-gray-500 mt-3">Post some NEWS, events and other important matters.</p>
                </div>
            </div>
          </section>  
</template>
