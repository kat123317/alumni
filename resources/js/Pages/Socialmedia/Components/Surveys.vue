<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./emptypost.vue";
import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};
const date_conversion2 = (value) => {
    if (value) {
        return moment(value).format("h:mm:ss");
    }
};

const getPercentage = (notification) => {
    let record = notification.record;
    let survey = notification.survey;
    // console.log(record != null);
    if (record != null) {
        var count = 0;
        survey.questions.forEach((question) => {
            if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                if ("question_" + question.id in record.answers == true) {
                    if (record.answers["question_" + question.id] != 0) {
                        count++;
                    }
                }
            } else {
                if ("question_" + question.id in record.answers == true) {
                    question.setup.choices.every((choice) => {
                        if (
                            "choice_" + choice.value in
                                record.answers["question_" + question.id] ==
                            true
                        ) {
                            if (
                                record.answers["question_" + question.id][
                                    "choice_" + choice.value
                                ] != 0
                            ) {
                                count++;
                                return false;
                            }
                        }
                        return true;
                    });
                }
            }
        });

        return (count / survey.questions.length) * 100;
    } else {
        return 0;
    }
};

const getStatus = (notification) => {
    let record = notification.record;
    let survey = notification.survey;
    if (record != null) {
        var count = 0;
        survey.questions.forEach((question) => {
            if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                if ("question_" + question.id in record.answers == true) {
                    if (record.answers["question_" + question.id] != 0) {
                        count++;
                    }
                }
            } else {
                if ("question_" + question.id in record.answers == true) {
                    question.setup.choices.every((choice) => {
                        if (
                            "choice_" + choice.value in
                                record.answers["question_" + question.id] ==
                            true
                        ) {
                            if (
                                record.answers["question_" + question.id][
                                    "choice_" + choice.value
                                ] != 0
                            ) {
                                count++;
                                return false;
                            }
                        }
                        return true;
                    });
                }
            }
        });
        var status = (count / survey.questions.length) * 100;
        return status == 100 ? "Finished" : "Incomplete";
    } else {
        return "Not yet taken";
    }
};

const getStatusButton = (notification) => {
    let record = notification.record;
    let survey = notification.survey;
    if (record != null) {
        var count = 0;
        survey.questions.forEach((question) => {
            if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                if ("question_" + question.id in record.answers == true) {
                    if (record.answers["question_" + question.id] != 0) {
                        count++;
                    }
                }
            } else {
                if ("question_" + question.id in record.answers == true) {
                    question.setup.choices.every((choice) => {
                        if (
                            "choice_" + choice.value in
                                record.answers["question_" + question.id] ==
                            true
                        ) {
                            if (
                                record.answers["question_" + question.id][
                                    "choice_" + choice.value
                                ] != 0
                            ) {
                                count++;
                                return false;
                            }
                        }
                        return true;
                    });
                }
            }
        });
        var status = (count / survey.questions.length) * 100;
        return status == 100 ? "Completed" : "Answer";
    } else {
        return "Answer";
    }
};

const getSurveyType = (notification) => {
    let record = notification.record;
    let survey = notification.survey;
    if (record != null) {
        var count = 0;
        survey.questions.forEach((question) => {
            if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                if ("question_" + question.id in record.answers == true) {
                    if (record.answers["question_" + question.id] != 0) {
                        count++;
                    }
                }
            } else {
                if ("question_" + question.id in record.answers == true) {
                    question.setup.choices.every((choice) => {
                        if (
                            "choice_" + choice.value in
                                record.answers["question_" + question.id] ==
                            true
                        ) {
                            if (
                                record.answers["question_" + question.id][
                                    "choice_" + choice.value
                                ] != 0
                            ) {
                                count++;
                                return false;
                            }
                        }
                        return true;
                    });
                }
            }
        });
        var status = (count / survey.questions.length) * 100;
        return status == 100 ? "Retake" : "Answer";
    } else {
        return "Answer";
    }
};

const status = () => {
}
</script>

<template>
    <AppLayout title="UserSurveys">
        <!-- component -->

        <h2 class="flex flex-row flex-nowrap items-center my-8">
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
            <span
                class="flex-none block mx-4 px-4 py-2.5 text-xs leading-none font-medium uppercase bg-green-700 rounded-lg text-white"
            >
                Your Surveys
            </span>
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
        </h2>
        <div
            class="w-full px-2 lg:px-10 grid grid-cols-1 gap-10 lg:grid-cols-4"
        >
            <div
                v
                v-for="(user_survey, key) in usePage().props.value.user_surveys"
                :key="key"
                class="w-full max-w-sm px-4 py-3 border-b-4 border-green-400 bg-white rounded-md shadow-md"
            >
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-gray-800">{{
                        user_survey.survey.name
                    }}</span>
                    <span
                        class="px-3 py-1 text-xs text-white uppercase bg-green-800 rounded-full"
                        >Survey</span
                    >
                </div>

                <div>
                    <h1 class="mt-2 text-lg font-semibold text-gray-800">
                        Items: {{ user_survey.survey.questions.length }}
                    </h1>

                    <div class="grid grid-cols-2 mb-5">
                        <div>
                            <p class="mt-2 text-md text-gray-600">
                                Percentage taken:
                                {{ getPercentage(user_survey) }}%
                            </p>
                            <p class="mt-2 text-md text-gray-600">
                                Status: {{ getStatus(user_survey) }}
                            </p>
                            <p class="mt-2 text-md text-gray-600">
                                Created at:
                                {{
                                    date_conversion(
                                        user_survey.survey.created_at
                                    )
                                }}
                            </p>
                            <p class="mt-2 text-md text-gray-600">
                                Updated at:
                                {{
                                    date_conversion(
                                        user_survey.survey.updated_at
                                    )
                                }}
                            </p>
                        </div>
                        <a class="inline-block mr-4" href="#">
                            <img class="max-w-none w-full rounded-lg" src="" />
                        </a>
                    </div>
                </div>

                <a
                    class="px-6 float-right py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-green-800 rounded-md hover:bg-green-500 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-80"
                    :href="getStatusButton(user_survey) == 'Completed' ? status():user_survey.details.link"
                    target="_blank"
                >
                    {{ getStatusButton(user_survey) }}
                </a>
            </div>
        </div>
    </AppLayout>
</template>

<style></style>
