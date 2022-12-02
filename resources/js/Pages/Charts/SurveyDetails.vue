<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

import moment from "moment";

const chart_type = ref("pie");

// const color_random = [
//     [
//         "#0000FF",
//         "#8A2BE2",
//         "#A52A2A",
//         "#DEB887",
//         "#5F9EA0",
//         "#7FFF00",
//         "#D2691E",
//         "#FF7F50",
//         "#6495ED",
//         "#FFF8DC",
//         "#DC143C",
//         "#00FFFF",
//         "#00008B",
//         "#008B8B",
//         "#B8860B",
//         "#A9A9A9",
//         "#006400",
//         "#BDB76B",
//         "#8B008B",
//     ],
//     // ["Dark Olive Green", "#556B2F"],
//     // ["Dark Orange", "#FF8C00"],
//     // ["Dark Orchid", "#9932CC"],
//     // ["Dark Red", "#8B0000"],
//     // ["Dark Salmon", "#E9967A"],
//     // ["Dark Sea Green", "#8FBC8F"],
//     // ["Dark Slate Blue", "#483D8B"],
//     // ["Dark Slate Gray", "#2F4F4F"],
//     // ["Dark Slate Grey", "#2F4F4F"],
//     // ["Dark Turquoise", "#00CED1"],
//     // ["Dark Violet", "#9400D3"],
//     // ["Deep Pink", "#2F4F4F"],
//     // ["Deep Sky Blue", "#00BFFF"],
//     // ["Dim Gray", "#696969"],
//     // ["Dim Grey", "#696969"],
//     // ["Dodger Blue", "#1E90FF"],
//     // ["Fire Brick", "#B22222"],
//     // ["Floral White", "#FFFAF0"],
//     // ["Forest Green", "#228B22"],
//     // ["Fuchsia", "#FF00FF"],
//     // ["Gainsboro", "#DCDCDC"],
//     // ["Ghost White", "#F8F8FF"],
//     // ["Gold", "#FFD700"],
//     // ["Golden Rod", "#DAA520"],
//     // ["Gray", "#808080"],
//     // ["Green", "#008000"],
//     // ["Green Yellow", "#ADFF2F"],
//     // ["Honey Dew", "#F0FFF0"],
//     // ["Hot Pink", "#FF69B4"],
//     // ["Indian Red", "#CD5C5C"],
//     // ["Indigo", "#4B0082"],
//     // ["Ivory", "#FFFFF0"],
//     // ["Khaki", "#F0E68C"],
//     // ["Lavender", "#E6E6FA"],
//     // ["Lavender Blush", "#FFF0F5"],
//     // ["Lawn Green", "#7CFC00"],
//     // ["Lemon Chiffon", "#FFFACD"],
//     // ["Light Blue", "#ADD8E6"],
//     // ["Light Coral", "#F08080"],
//     // ["Light Cyan", "#E0FFFF"],
//     // ["Light Golden Rod Yellow", "#FAFAD2"],
//     // ["Light Gray", "#D3D3D3"],
//     // ["Light Green", "#90EE90"],
//     // ["Light Pink", "#FFB6C1"],
//     // ["Light Salmon", "#FFA07A"],
//     // ["Light Sea Green", "#20B2AA"],
//     // ["Light Sky Blue", "#87CEFA"],
//     // ["Light Slate Gray", "#778899"],
//     // ["Light Steel Blue", "#B0C4DE"],
//     // ["Light Yellow", "#FFFFE0"],
//     // ["Lime", "#00FF00"],
//     // ["Lime Green", "#32CD32"],
//     // ["Linen", "#FAF0E6"],
//     // ["Magenta", "#FF00FF"],
//     // ["Maroon", "#800000"],
//     // ["Medium Aqua Marine", "#66CDAA"],
//     // ["Medium Blue", "#0000CD"],
//     // ["Medium Orchid", "#BA55D3"],
//     // ["Medium Purple", "#9370DB"],
//     // ["Medium Sea Green", "#3CB371"],
//     // ["Medium Slate Blue", "#7B68EE"],
//     // ["Medium Spring Green", "#00FA9A"],
//     // ["Medium Turquoise", "#48D1CC"],
//     // ["Medium Violet Red", "#C71585"],
//     // ["Midnight Blue", "#191970"],
//     // ["Mint Cream", "#F5FFFA"],
//     // ["Misty Rose", "#FFE4E1"],
//     // ["Moccasin", "#FFE4B5"],
//     // ["Navajo White", "#FFDEAD"],
//     // ["Navy", "#000080"],
//     // ["Old Lace", "#FDF5E6"],
//     // ["Olive", "#808000"],
//     // ["Olive Drab", "#6B8E23"],
//     // ["Orange", "#FFA500"],
//     // ["Orange Red", "#FF4500"],
//     // ["Orchid", "#DA70D6"],
//     // ["Pale Golden Rod", "#EEE8AA"],
//     // ["PaleGreen", "#98FB98"],
//     // ["Pale Turquoise", "#AFEEEE"],
//     // ["Pale Violet Red", "#DB7093"],
//     // ["Papaya Whip", "#FFEFD5"],
//     // ["Peach Puff", "#FFDAB9"],
//     // ["Peru", "#CD853F"],
//     // ["Pink", "#FFC0CB"],
//     // ["Plum", "#DDA0DD"],
//     // ["Powder Blue", "#B0E0E6"],
//     // ["Purple", "#800080"],
//     // ["Rebecca Purple", "#663399"],
//     // ["Red", "#FF0000"],
//     // ["Rosy Brown", "#BC8F8F"],
//     // ["Royal Blue", "#4169E1"],
//     // ["Saddle Brown", "#8B4513"],
//     // ["Salmon", "#FA8072"],
//     // ["Sandy Brown", "#F4A460"],
//     // ["Sea Green", "#2E8B57"],
//     // ["Sea Shell", "#FFF5EE"],
//     // ["Sienna", "#A0522D"],
//     // ["Silver", "#C0C0C0"],
//     // ["SkyBlue", "#87CEEB"],
//     // ["Slate Blue", "#6A5ACD"],
//     // ["SlateGray", "#708090"],
//     // ["Snow", "#FFFAFA"],
//     // ["Spring Green", "#00FF7F"],
//     // ["Steel Blue", "#4682B4"],
//     // ["Tan", "#D2B48C"],
//     // ["Teal", "#008080"],
//     // ["Thistle", "#D8BFD8"],
//     // ["Tomato", "#FF6347"],
//     // ["Turquoise", "#40E0D0"],
//     // ["Violet", "#EE82EE"],
//     // ["Wheat", "#F5DEB3"],
//     // ["White", "#FFFFFF"],
//     // ["White Smoke", "#F5F5F5"],
//     // ["Yellow", "#FFFF00"],
//     // ["YellowGreen", "#9ACD32"],
// ];

const function_calculate_percent = (answer, index) => {
    let total_answers = 0;
    for (
        let index2 = 0;
        index2 < usePage().props.value.charts[index].data.length;
        index2++
    ) {
        total_answers += usePage().props.value.charts[index].data[index2][1];
    }
    console.log(total_answers);
    let calculated = (answer / total_answers) * 100;
    return calculated.toFixed(2) + "%";
};
</script>

<template>
    <AppLayout title="survey_charts">
        <section class="bg-white">
            <div class="container px-6 py-10 mx-auto">
                <div class="flex justify-between">
                    <div>
                        <h1
                            class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl"
                        >
                            Survey Charts
                        </h1>

                        <p class="mt-4 text-gray-500 xl:mt-6">
                            Survey Reports
                            {{ usePage().props.value.records_count }} person/s
                            who answer this survey
                        </p>
                    </div>
                    <div>
                        <select
                            v-model="chart_type"
                            class="mb-2 ml-5 block p-2 px-[4vmin] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-lg focus:ring-green-500 focus:border-green-500"
                        >
                            <option value="pie">Pie Chart</option>
                            <option value="donut">Donut Chart</option>
                            <option value="bar">Bar Chart</option>
                            <option value="column">Column Chart</option>
                            <option value="line">Line Chart</option>
                            <option value="area">Area Chart</option>
                        </select>
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3"
                >
                    <div
                        v-for="(chart, key) in usePage().props.value.charts"
                        :key="key"
                        class="p-8 space-y-3 border-2 border-green-400 rounded-xl"
                    >
                        <span class="inline-block flex text-green-500">
                            Question {{ key + 1 }}
                        </span>
                        <span class="inline-block flex text-green-500">
                            <span v-html="chart.instruction"></span>
                        </span>

                        <h1
                            class="text-2xl font-semibold text-gray-700 capitalize"
                        >
                            {{ chart.instructions }}
                        </h1>
                        <pie-chart
                            v-if="chart_type == 'donut'"
                            :data="chart.data"
                            :donut="true"
                            :download="true"
                        ></pie-chart>
                        <pie-chart
                            v-if="chart_type == 'pie'"
                            :data="chart.data"
                            :donut="false"
                            :download="true"
                        ></pie-chart>
                        <bar-chart
                            v-if="chart_type == 'bar'"
                            :data="chart.data"
                            :download="true"
                        ></bar-chart>
                        <column-chart
                            v-if="chart_type == 'column'"
                            :data="chart.data"
                            :download="true"
                        ></column-chart>
                        <line-chart
                            v-if="chart_type == 'line'"
                            :data="chart.data"
                            :download="true"
                        ></line-chart>
                        <area-chart
                            v-if="chart_type == 'area'"
                            :data="chart.data"
                            :download="true"
                        ></area-chart>
                        <ul class="mb-8 space-y-4 text-left text-gray-500">
                            <li
                                v-for="(answer, key2) in chart.data"
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
                                    class="w-6 h-6 flex-shrink-0 w-5 h-5 text-green-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>

                                <span>
                                    {{ answer[0] }}:
                                    <span class="decoration-sky-500">{{
                                        answer[1]
                                    }}</span>
                                    <span>
                                        -
                                        {{
                                            function_calculate_percent(
                                                answer[1],
                                                key
                                            )
                                        }}</span
                                    ></span
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
