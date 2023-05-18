<script setup>
import JetDialogModal from "@/Components/DialogModal.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import InputToggle from "@/Components/InputToggle.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { inject, nextTick, ref } from "vue";
import helpers from "@/helpers.js";
import { Inertia } from "@inertiajs/inertia";

const { random_str } = helpers();

const modals = inject("modals");
const alertOnMessage = inject("alertOnMessage");
const onAlert = inject("onAlert");
const form_add_edit = inject("form_add_edit");
const initialize = inject("initialize");
const questions = inject("questions");

const new_choice = ref("");
const img_choices = ref([]);

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
        write_in: false,
        img_src: "",
    });
    new_choice.value = "";
};

const removeChoice = (index) => {
    form_add_edit.setup.choices.splice(index, 1);
};

const addEditQuestion = () => {
    if (modals.add_edit.details.method == "add") {
        axios
            .post(
                route("surveys.questions.store", {
                    survey_id: usePage().props.value.survey.id,
                }),
                form_add_edit
            )
            .then(function (res) {
                //upload image after adding question
                if (img_choices.value.length > 0) {
                    uploadImages(res);
                } else {
                    form_add_edit.reset();
                    questions.value.push(res.data.question);
                    initialize();
                }

                modals.add_edit.show = false;
                alertOnMessage.value = "Question Added";
                onAlert("Success");
            })
            .catch(function (error) {
                console.log(error);
            });
    } else {
        axios
            .put(
                route("surveys.questions.update", {
                    survey_id: usePage().props.value.survey.id,
                    id: modals.add_edit.details.id,
                }),
                form_add_edit
            )
            .then(function (res) {
                //upload image after adding question

                if (img_choices.value.length > 0) {
                    uploadImages(res);
                } else {
                    form_add_edit.reset();
                    let index = questions.value.findIndex(
                        (q) => q.id == modals.add_edit.details.id
                    );
                    questions.value[index] = res.data.question;
                    initialize();
                }
                alertOnMessage.value = "Question Successfully updated";
                onAlert("Update");
                modals.add_edit.show = false;
            })
            .catch(function (error) {
                console.log(error);
            });
    }
};

const checkDropdown = (check = "dropdown") => {
    if (check == "dropdown") {
        if (form_add_edit.setup.dropdown) {
            form_add_edit.setup.multiple_select = false;
            form_add_edit.setup.image = false;
            form_add_edit.setup.input = false;
        } else if (form_add_edit.setup.input) {
            form_add_edit.setup.multiple_select = false;
            form_add_edit.setup.image = false;
        }
    } else {
        if (form_add_edit.setup.input) {
            form_add_edit.setup.multiple_select = false;
            form_add_edit.setup.image = false;
            form_add_edit.setup.dropdown = false;
        }
    }
};

const openFile = (index) => {
    let hidden = document.getElementById("hidden-input-" + index);
    hidden.click();
    hidden.onchange = (e) => {
        let file = e.target.files[0];
        if (
            form_add_edit.setup.choices[index].img_src == "" ||
            form_add_edit.setup.choices[index].img_src == null
        ) {
            form_add_edit.setup.choices[index].img_src =
                random_str(5) + "." + file.name.split(".").pop();
        } else {
            form_add_edit.setup.choices[index].img_src =
                form_add_edit.setup.choices[index].img_src.split(".").shift() +
                "." +
                file.name.split(".").pop();
        }
        img_choices.value[index] = file;
    };
};

const uploadImages = (res) => {
    Inertia.post(
        route("surveys.questions.upload_images", {
            survey_id: usePage().props.value.survey.id,
            id: res.data.q_id,
        }),
        { images: img_choices.value, setup: form_add_edit.setup },
        {
            preserveScroll: true,
            onSuccess: () => {
                img_choices.value = [];
                form_add_edit.reset();
                initialize();
            },
            onFinish: () => { },
            onError: (err) => { },
        }
    );
};
</script>
<template>
    <JetDialogModal :show="modals.add_edit.show" maxWidth="6xl" :closeable="false">
        <template #title>
            <div class="flex justify-between">
             {{ modals.add_edit.details.title }} 
            <div class="flex items-center mb-4">
                            <input id="default-checkbox" type="checkbox" v-model="form_add_edit.setup.required" :checked="(form_add_edit.setup.choices.length == 0)? false:form_add_edit.setup.required"
                                class="ml-2 mt-2 w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" >
                            <label for="default-checkbox"
                                class="ml-2 text-sm font-medium text-gray-900">Required</label>
                        </div>
                    </div>
        </template>
        <template #content>
            <JetInputLabel>Instruction</JetInputLabel>
            <QuillEditor v-model:content="form_add_edit.instruction"
                class="relative w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                theme="snow" toolbar="minimal" id="postEditor" contentType="html"></QuillEditor>
            <div class="grid grid-cols-6 gap-1">
                <div class="col-span-6">
                    <JetInputError :message="form_add_edit.errors.instruction"></JetInputError>
                </div>
                <div class="col-span-5">
                    <template v-if="form_add_edit.setup.input">
                        <JetInputLabel>Input Label</JetInputLabel>
                        <input v-model="form_add_edit.setup.input_label" type="text"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                    </template>
                    <template v-else>
                        <JetInputLabel>Choices</JetInputLabel>
                        <template v-for="(choice, index) in form_add_edit.setup
                            .choices">
                            <div class="flex gap-1 mb-1">
                                <input v-model="choice.label" type="text" placeholder="choice label"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                <template v-if="form_add_edit.setup.image">
                                    <input v-model="choice.img_src" readonly placeholder="image name" type="text"
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base placeholder-gray-300 outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    <button @click="openFile(index)"
                                        class="flex text-white bg-blue-500 border-0 py-2 px-4 focus:outline-none hover:bg-blue-600 rounded text-lg">
                                        Image
                                    </button>
                                    <input :id="'hidden-input-' + index" type="file" class="hidden"
                                        accept="image/png, image/gif, image/jpeg" />
                                </template>

                                <button @click="removeChoice(index)"
                                    class="flex text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded text-lg">
                                    Delete
                                </button>
                            </div>
                            <JetInputLabel class="inline-block" v-if="form_add_edit.setup.dropdown == false">
                                <JetCheckbox v-model="choice.write_in" class="-mt-1" />
                                <span class="pl-1 mb-3">Write In Choice</span>
                            </JetInputLabel>
                        </template>
                        <div class="flex gap-1">
                            <input v-model="new_choice" type="text" placeholder="New Choice"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                            <button @click="addChoice()"
                                class="flex text-white bg-green-500 border-0 py-2 px-[1.6rem] focus:outline-none hover:bg-green-600 rounded text-lg">
                                Add
                            </button>
                        </div>
                    </template>
                </div>
                <div class="col-span-1">
                    <div class="mt-7 mb-2">
                        <InputToggle @change="checkDropdown('input')" v-model:checked="form_add_edit.setup.input">Input
                        </InputToggle>
                        <InputToggle class="pt-1" @change="checkDropdown('dropdown')"
                            v-model:checked="form_add_edit.setup.dropdown">Dropdown</InputToggle>
                        <InputToggle class="py-1" :class="{
                            'cursor-not-allowed':
                                form_add_edit.setup.dropdown ||
                                form_add_edit.setup.input,
                        }" @change="checkDropdown()" v-model:checked="form_add_edit.setup.multiple_select
    ">Multiple Select</InputToggle>
                        <InputToggle class="pb-1" :class="{
                            'cursor-not-allowed':
                                form_add_edit.setup.dropdown ||
                                form_add_edit.setup.input,
                        }" @change="checkDropdown()" v-model:checked="form_add_edit.setup.image">Image Select
                        </InputToggle>
                        
                        <!-- <InputToggle v-model:checked="form_add_edit.setup.required">Required</InputToggle> -->
                    </div>
                </div>
            </div>
        </template>
        <template #footer>
            <button @click="modals.add_edit.show = false"
                class="flex mr-2 text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">
                Cancel
            </button>
            <button @click="addEditQuestion()"
                class="flex text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                Submit
            </button>
        </template>
    </JetDialogModal>
</template>
