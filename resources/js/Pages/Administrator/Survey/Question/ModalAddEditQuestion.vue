<script setup>
import JetDialogModal from "@/Components/DialogModal.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import InputToggle from "@/Components/InputToggle.vue";
import JetInputError from "@/Components/InputError.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { inject, nextTick, ref } from "vue";

const modals = inject("modals");
const alertOnMessage = inject("alertOnMessage");
const onAlert = inject("onAlert");
const form_add_edit = inject("form_add_edit");
const initialize = inject("initialize");

const new_choice = ref("");

const addChoice = () => {
    let cvalue = 1;
    let maxValue = Math.max.apply(
        null,
        form_add_edit.setup.choices.map(function (o) {
            return o.value;
        })
    );
    if (maxValue > 0) {
        //to maintain choice value
        cvalue = maxValue + 1;
    }

    form_add_edit.setup.choices.push({
        label: new_choice.value,
        value: cvalue,
    });
    new_choice.value = "";
};

const removeChoice = (index) => {
    form_add_edit.setup.choices.splice(index, 1);
};

const addEditQuestion = () => {
    if (modals.add_edit.details.method == "add") {
        form_add_edit.post(
            route("surveys.questions.store", {
                survey_id: usePage().props.value.survey.id,
            }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    initialize();
                    modals.add_edit.show = false;
                    alertOnMessage.value = "Question Added";
                    onAlert("Success");
                    form_add_edit.reset();
                },
                onError: (err) => {},
            }
        );
    } else {
        form_add_edit.put(
            route("surveys.questions.update", {
                survey_id: usePage().props.value.survey.id,
                id: modals.add_edit.details.id,
            }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    initialize();
                    alertOnMessage.value = "Question Successfully updated";
                    onAlert("Update");
                    form_add_edit.reset();
                    modals.add_edit.show = false;
                },
                onError: (err) => {},
            }
        );
    }
};

const checkDropdown = () => {
    if (form_add_edit.setup.dropdown) {
        form_add_edit.setup.multiple_select = false;
    }
};
</script>
<template>
    <JetDialogModal
        :show="modals.add_edit.show"
        maxWidth="6xl"
        :closeable="false"
    >
        <template #title>{{ modals.add_edit.details.title }}</template>
        <template #content>
                    <JetInputLabel>Instruction</JetInputLabel>
                    <QuillEditor v-model:content="form_add_edit.instruction"  class="relative w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" theme="snow" toolbar="minimal"   id="postEditor"   contentType="html"></QuillEditor>
            <div class="grid grid-cols-6 gap-1">
                <div class="col-span-6">
                 
                    <!-- <textarea
                        v-model="form_add_edit.instruction"
                        rows="5"
                        class="w-full w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                    ></textarea> -->
                  
                    <JetInputError
                        :message="form_add_edit.errors.instruction"
                    ></JetInputError>
                </div>
                <div class="col-span-4">
                    <JetInputLabel>Choices</JetInputLabel>
                    <template
                        v-for="(choice, index) in form_add_edit.setup.choices"
                    >
                        <div class="flex gap-1 mb-1">
                            <input
                                v-model="choice.label"
                                type="text"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            />
                            <button
                                @click="removeChoice(index)"
                                class="flex text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded text-lg"
                            >
                                Delete
                            </button>
                        </div>
                    </template>
                    <div class="flex gap-1 mt-2">
                        <input
                            v-model="new_choice"
                            type="text"
                            placeholder="New Choice"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        />
                        <button
                            @click="addChoice()"
                            class="flex text-white bg-green-500 border-0 py-2 px-[1.6rem] focus:outline-none hover:bg-green-600 rounded text-lg"
                        >
                            Add
                        </button>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="mt-7 mb-2">
                        <InputToggle
                            @change="checkDropdown()"
                            v-model:checked="form_add_edit.setup.dropdown"
                            >Dropdown</InputToggle
                        >
                        <InputToggle
                            class="py-1"
                            :class="{
                                'cursor-not-allowed':
                                    form_add_edit.setup.dropdown,
                            }"
                            @change="checkDropdown()"
                            v-model:checked="
                                form_add_edit.setup.multiple_select
                            "
                            >Multiple Select</InputToggle
                        >
                        <InputToggle
                            v-model:checked="form_add_edit.setup.required"
                            >Required</InputToggle
                        >
                    </div>
                </div>
            </div>
        </template>
        <template #footer>
            <button
                @click="modals.add_edit.show = false"
                class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg"
            >
                Cancel
            </button>
            <button
                @click="addEditQuestion()"
                class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg"
            >
                Submit
            </button>
        </template>
    </JetDialogModal>
</template>
