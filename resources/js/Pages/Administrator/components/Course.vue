<template>
<section class="text-gray-600 body-font relative">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Add Department</h1>

    </div>
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">
        <div class="p-2 w-1/3">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">Abbreviation</label>
            <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 w-[52vmin]">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-gray-600">Course</label>
            <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <div class="p-2 p-2 w-1/3">
          <div class="relative">
            <label for="email" class="leading-7 text-sm text-gray-600">Department</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 w text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option selected>Choose a Department</option>
              <option value="US">COE</option>
              <option value="CA">COD</option>
              <option value="FR">COED</option>
              <option value="DE">SSD</option>
            </select>
          </div>
        </div>
     
        <div class="p-2 w-full">
          <button class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Submit</button>
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
        </div>      

        </div>
      </div>
    </div>
  </div>
</section>
</template>