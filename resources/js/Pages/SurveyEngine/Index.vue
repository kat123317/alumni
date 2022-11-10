<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInputError from "@/Components/InputError.vue";
import QList from "@/Pages/Administrator/Survey/Question/QList.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import {
    computed,
    ref,
    provide,
    inject,
    reactive,
    watch,
    onBeforeMount,
    nextTick,
} from "vue";

import { Inertia } from "@inertiajs/inertia";
import { debounce } from "lodash";

const props = defineProps(["survey", "record", "user"]);
const my_choices = useForm({
    answers: {},
    status: "ongoing",
});

const err_message = ref([]);
onBeforeMount(() => {
    initialize();
});

const initialize = () => {
    if (props.record == null) {
        props.survey.questions.forEach((question) => {
            if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                my_choices.answers["question_" + question.order] = 0;
            } else {
                let choices = {};
                question.setup.choices.forEach((choice) => {
                    choices["choice_" + choice.value] = 0;
                });
                my_choices.answers["question_" + question.order] = choices;
            }
        });
        if (props.user.user_type != "alumni") {
            my_choices.status = "test";
        }
    } else {
        my_choices.answers = props.record.answers;
        my_choices.status = props.record.status;

        props.survey.questions.forEach((question) => {
            if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                if (
                    "question_" + question.order in props.record.answers ==
                    false
                ) {
                    my_choices.answers["question_" + question.order] = 0;
                }
            } else {
                if (
                    "question_" + question.order in props.record.answers ==
                    false
                ) {
                    let choices = {};
                    question.setup.choices.forEach((choice) => {
                        choices["choice_" + choice.value] = 0;
                    });
                    my_choices.answers["question_" + question.order] = choices;
                } else {
                    question.setup.choices.forEach((choice) => {
                        if (
                            "choice_" + choice.value in
                                props.record.answers[
                                    "question_" + question.order
                                ] ==
                            false
                        ) {
                            my_choices.answers["question_" + question.order][
                                "choice_" + choice.value
                            ] = 0;
                        }
                    });
                }
            }
        });
    }
};

const saveAnswer = debounce(() => {
    my_choices.post(
        route("surveys.engine.save_answer", { survey_id: props.survey.id }),
        {
            preserveScroll: true,
            onSuccess: () => {},
            onError: (err) => {},
        }
    );
}, 1000);

const finishSurvey = () => {
    let proceed = true;
    err_message.value = [];
    //check required
    props.survey.questions.forEach((question) => {
        if (question.setup.required) {
            if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                if (my_choices.answers["question_" + question.order] == 0) {
                    proceed = false;
                    err_message.value[question.order - 1] = "* Required";
                }
            } else {
                for (const key in my_choices.answers[
                    "question_" + question.order
                ]) {
                    if (
                        my_choices.answers["question_" + question.order][key] ==
                        0
                    ) {
                        proceed = false;
                        err_message.value[question.order - 1] = "* Required";
                    }
                }
            }
        }
    });
    if (proceed) {
        Inertia.get(
            route("surveys.engine.finish_survey", {
                survey_id: props.survey.id,
                status: my_choices.status,
            })
        );
    }
};
</script>
<template>
    <AppLayout title="Survey">
        <div class="bg-gray-100">
            <div class="max-w-6xl py-6 mx-auto">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <template v-for="(question, index) in survey.questions">
                        <div class="p-6 w-full">
                            <JetInputError :message="err_message[index]" />
                            <QList
                                :disabled="
                                    my_choices.status == 'complete' &&
                                    question.setup.required
                                "
                                @change="saveAnswer()"
                                :question="question"
                                v-model="
                                    my_choices.answers[
                                        'question_' + (index + 1)
                                    ]
                                "
                            />
                        </div>
                    </template>
                    <div class="px-6 pb-6">
                        <button
                            @click="finishSurvey()"
                            class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
                        >
                            {{
                                my_choices.status == "complete"
                                    ? "Save Answers"
                                    : "Finish Survey"
                            }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
