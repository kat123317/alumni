<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import  'https://unpkg.com/flowbite@1.5.3/dist/datepicker.js';
</script>

<template>
  <AppLayout title="survey_charts">
    <section class="bg-white dark:bg-gray-900">
      <div class="container px-6 py-10 mx-auto">
        <h1
          class="
            text-3xl
            font-semibold
            text-gray-800
            capitalize
            lg:text-4xl
            dark:text-white
          "
        >
          Survey Charts - Survey title
        </h1>

        <div inline-datepicker data-date="02/25/2022"></div>

        <p class="mt-4 text-gray-500 xl:mt-6 dark:text-gray-300">
          Survey Reports
        </p>

        <div
          class="
            grid grid-cols-1
            gap-8
            mt-8
            xl:mt-12 xl:gap-12
            md:grid-cols-2
            xl:grid-cols-3
          "
        >
          <div
            v-for="(items, key) in 5"
            :key="key"
            class="
              p-8
              space-y-3
              border-2 border-green-400
              dark:border-green-300
              rounded-xl
            "
          >
            <span class="inline-block flex text-green-500 dark:text-green-400">
              Question {{ key + 1 }}
            </span>

            <h1
              class="
                text-2xl
                font-semibold
                text-gray-700
                capitalize
                dark:text-white
              "
            >
              Do you like number {{ key }}
            </h1>

            <pie-chart
              :data="[
                ['choice 1', key + 1],
                [key, key + Math.round(5.95)],
              ]"
            ></pie-chart>
            <ul
              class="mb-8 space-y-4 text-left text-gray-500 dark:text-gray-400"
            >
              <li
                v-for="(answer, key2) in 4"
                :key="key2"
                class="flex items-center space-x-3"
              >
                <!-- Icon -->

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="
                    w-6
                    h-6
                    flex-shrink-0
                    w-5
                    h-5
                    text-green-500
                    dark:text-green-400
                  "
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>

                <span
                  >Choice {{ key2 + 1 }}:
                  <a class="underline decoration-sky-500">{{ key2 }}</a>
                  Answers</span
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>

