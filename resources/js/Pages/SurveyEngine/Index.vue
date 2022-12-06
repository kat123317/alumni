<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInputError from "@/Components/InputError.vue";
import QList from "@/Pages/Administrator/Survey/Question/QList.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, onBeforeMount, provide } from "vue";

import { Inertia } from "@inertiajs/inertia";
import { debounce } from "lodash";

const props = defineProps(["survey", "record", "user"]);
const my_choices = useForm({
    answers: {},
    status: "ongoing",
});
const questions = ref([]);
const err_message = ref([]);
onBeforeMount(() => {
    initialize();
});

const initialize = () => {
    if (props.record == null) {
        props.survey.questions.forEach((question) => {
            if (question.setup.input == true) {
                my_choices.answers["question_" + question.id] = "";
            } else if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                my_choices.answers["question_" + question.id] = 0;
                let write_in = {};
                question.setup.choices.forEach((choice) => {
                    if (choice.write_in) {
                        write_in["write_" + choice.value] = "";
                    }
                });
                if (Object.keys(write_in).length > 0) {
                    my_choices.answers["write_in_" + question.id] = write_in;
                }
            } else {
                let choices = {};
                let write_in = {};
                question.setup.choices.forEach((choice) => {
                    choices["choice_" + choice.value] = 0;
                    if (choice.write_in) {
                        write_in["write_" + choice.value] = "";
                    }
                });
                my_choices.answers["question_" + question.id] = choices;
                if (Object.keys(write_in).length > 0) {
                    my_choices.answers["write_in_" + question.id] = write_in;
                }
            }
        });
        if (props.user.user_type != "alumni") {
            my_choices.status = "test";
        }
    } else {
        my_choices.answers = props.record.answers;
        my_choices.status = props.record.status;

        props.survey.questions.forEach((question) => {
            if (question.setup.input == true) {
                if (
                    "question_" + question.id in props.record.answers ==
                    false
                ) {
                    my_choices.answers["question_" + question.id] = "";
                }
            } else if (
                question.setup.dropdown == true ||
                question.setup.multiple_select == false
            ) {
                if (
                    "question_" + question.id in props.record.answers ==
                    false
                ) {
                    my_choices.answers["question_" + question.id] = 0;
                    if (question.setup.dropdown == false) {
                        //single select
                        let write_in = {};
                        question.setup.choices.forEach((choice) => {
                            if (choice.write_in) {
                                write_in["write_" + choice.value] = "";
                            }
                        });
                        if (Object.keys(write_in).length > 0) {
                            my_choices.answers["write_in_" + question.id] =
                                write_in;
                        }
                    }
                }
            } else {
                if (
                    "question_" + question.id in props.record.answers ==
                    false
                ) {
                    let choices = {};
                    let write_in = {};
                    question.setup.choices.forEach((choice) => {
                        choices["choice_" + choice.value] = 0;
                        if (choice.write_in) {
                            write_in["write_" + choice.value] = "";
                        }
                    });
                    my_choices.answers["question_" + question.id] = choices;
                    if (Object.keys(write_in).length > 0) {
                        my_choices.answers["write_in_" + question.id] =
                            write_in;
                        console.table(write_in);
                    }
                } else {
                    question.setup.choices.forEach((choice) => {
                        if (
                            "choice_" + choice.value in
                                props.record.answers[
                                    "question_" + question.id
                                ] ==
                            false
                        ) {
                            my_choices.answers["question_" + question.id][
                                "choice_" + choice.value
                            ] = 0;
                            if (choice.write_in) {
                                my_choices.answers["write_in_" + question.id][
                                    "write_" + choice.value
                                ] = "";
                            }
                        }
                    });
                }
            }
        });
    }

    questions.value = props.survey.questions;
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
                if (my_choices.answers["question_" + question.id] == 0) {
                    proceed = false;
                    err_message.value[question.order - 1] = "* Required";
                }
            } else {
                proceed = false;
                err_message.value[question.order - 1] = "* Required";
                for (const key in my_choices.answers[
                    "question_" + question.id
                ]) {
                    if (
                        my_choices.answers["question_" + question.id][key] == 1
                    ) {
                        proceed = true;
                        err_message.value[question.order - 1] = "";
                        break;
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

provide("my_choices", my_choices);
</script>
<template>
    <AppLayout title="Survey">
        <div class="bg-gray-100">
            <div class="max-w-6xl bg-white rounded-lg mt-5 py-6 mx-auto">
                <div class="sm:rounded-lg">
                    <template v-for="(question, index) in questions">
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
                                        'question_' + question.id
                                    ]
                                "
                            />
                        </div>
                    </template>
                    <div class="px-6 flex justify-center pb-6">
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
