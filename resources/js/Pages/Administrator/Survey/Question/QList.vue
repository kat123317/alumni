<script setup>
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import QDropDown from "@/Pages/Administrator/Survey/Engine/Dropdown.vue";
import QSingleSelect from "@/Pages/Administrator/Survey/Engine/SingleSelect.vue";
import QMultipleSelect from "@/Pages/Administrator/Survey/Engine/MultipleSelect.vue";
import { ref } from "vue";

defineProps({
    question: Array,
    modelValue: [Number, String, Array],
    choices: Array,
});

defineEmits(["update:modelValue"]);

const myChoice = ref(1);

const newChoice = ref([1, 2]);
</script>
<template>
    <div class="w-full flex">
        <span>{{ question.order + ". " }}</span>
        <div class="ml-1">
            <div class="w-full">
                {{ question.instruction }}
            </div>
            <template v-if="question.setup.dropdown == true">
                <QDropDown
                    :choices="question.setup.choices"
                    :value="modelValue"
                    @change="$emit('update:modelValue', $event.target.value)"
                />
                <!-- <select
                    class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 pl-3 leading-8 transition-colors duration-200 ease-in-out"
                >
                    <template v-for="(choice, i) in question.setup.choices">
                        <option :value="choice.value">
                            {{ choice.label }}
                        </option>
                    </template>
                </select> -->
            </template>
            <template
                v-else-if="
                    question.setup.dropdown == false &&
                    question.setup.multiple_select == true
                "
            >
                <QMultipleSelect
                    :choices="question.setup.choices"
                    v-model="newChoice"
                />
                <!-- <div class="grid grid-cols gap-1 mb-5">
                    <template v-for="(choice, i) in question.setup.choices">
                        <div class="col-span-6">
                            <JetInputLabel>
                                <JetCheckbox class="mr-1" disabled />{{
                                    choice.label
                                }}
                            </JetInputLabel>
                        </div>
                    </template>
                </div> -->
            </template>
            <template v-else>
                <QSingleSelect
                    :ukey="question.order"
                    :choices="question.setup.choices"
                    :value="modelValue"
                    @change="$emit('update:modelValue', $event.target.value)"
                />
                <!-- <div class="grid grid-cols gap-1 mb-5">
                    <template v-for="(choice, i) in question.setup.choices">
                        <div class="col-span-6">
                            <JetInputLabel>
                                <input
                                    type="radio"
                                    disabled
                                    class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                />
                                {{ choice.label }}
                            </JetInputLabel>
                        </div>
                    </template>
                </div> -->
            </template>
        </div>
    </div>
</template>
