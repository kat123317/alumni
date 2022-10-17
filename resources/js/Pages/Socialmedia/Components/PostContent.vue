<template>
    <div>
        <div class="flex justify-between px-10">
            <select id="countries" class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
            <option selected>College</option>
            <option value="US">College of Engineering</option>
            <option value="CA">College of Education</option>
            <option value="FR">College of Agri</option>
            <option value="DE">College of Forestry</option>
            </select>
            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-green-600 group-hover:from-green-400 group-hover:to-green-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Add Content
                </span>
            </button>

        </div>
          <div class='flex items-center px-10 mb-5 justify-center ' v-for="items in 5">  
                <div class="rounded-xl border p-5 shadow-md  bg-white">
                <div class="flex w-full items-center justify-between border-b pb-3">
                <div class="flex items-center space-x-3">
                    <div class="h-8 w-8 rounded-full hidden lg:block bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                    <div class="text-lg font-bold text-slate-700">Allan Mark</div>
                </div>
                <div class="flex items-center space-x-8">
                    <button class="rounded-2xl border bg-green-100 px-3 py-1 text-xs font-semibold">Public</button>
                    <div class="text-xs text-neutral-500">2 hours ago</div>
                </div>
                </div>

                <div class="mt-4 mb-6">
                <div class="mb-3 text-xl font-bold">I am the best</div>
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
</template>