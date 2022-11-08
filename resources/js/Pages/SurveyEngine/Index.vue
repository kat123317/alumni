<script setup>
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

const props = defineProps(["survey"]);
const MyChoices = ref({});

onBeforeMount(() => {
    props.survey.questions.forEach((question) => {
        if (question.setup.dropdown == true) {
            MyChoices.value["question_" + question.order] = 0;
        } else if (
            question.setup.dropdown == false &&
            question.setup.multiple_select == true
        ) {
            let choices = {};
            question.setup.choices.forEach((choice) => {
                choices["choice_" + choice.value] = 0;
            });
            MyChoices.value["question_" + question.order] = choices;
        } else {
            MyChoices.value["question_" + question.order] = 0;
        }
    });
});
</script>
<template>
    <div class="container mx-auto py-6 shadow-2xl">
        <template v-for="(question, index) in survey.questions">
            <div class="p-6 w-full">
                <QList
                    :question="question"
                    v-model="MyChoices['question_' + (index + 1)]"
                />
            </div>
        </template>
    </div>
</template>
