<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
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

const props = defineProps(["survey", "record"]);
const my_choices = useForm({
    answers: {},
    status: "ongoing",
});

onBeforeMount(() => {
    if (props.record == null) {
        props.survey.questions.forEach((question) => {
            if (question.setup.dropdown == true) {
                my_choices.answers["question_" + question.order] = 0;
            } else if (
                question.setup.dropdown == false &&
                question.setup.multiple_select == true
            ) {
                let choices = {};
                question.setup.choices.forEach((choice) => {
                    choices["choice_" + choice] = 0;
                });
                my_choices.answers["question_" + question.order] = choices;
            } else {
                my_choices.answers["question_" + question.order] = 0;
            }
        });
    } else {
        my_choices.answers = props.record.answers;
        my_choices.status = props.record.status;
    }
});

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
    Inertia.get(
        route("surveys.engine.finish_survey", { survey_id: props.survey.id })
    );
};
</script>
<template>
    <AppLayout title="Survey">
        <div class="bg-gray-100">
            <div class="max-w-6xl py-6 mx-auto">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <template v-for="(question, index) in survey.questions">
                        <div class="p-6 w-full">
                            <QList
                                :disabled="my_choices.status == 'complete'"
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
                                record.status == "complete"
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
