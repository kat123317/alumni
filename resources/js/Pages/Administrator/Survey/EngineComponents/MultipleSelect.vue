<script setup>
import JetInputLabel from "@/Components/InputLabel.vue";
import QInputText from "@/Pages/Administrator/Survey/EngineComponents/InputText.vue";
import { computed, inject } from "vue";
import helpers from "@/helpers.js";

const { random_str } = helpers();

const emit = defineEmits(["update:modelValue"]);

const r_string = random_str(2);
const props = defineProps({
    modelValue: [Object, Number],
    choices: Array,
    disabled: {
        type: Boolean,
        default: false,
    },
    image: Boolean,
    qid: Number,
});

const my_choices = inject("my_choices");

const proxyChecked = computed({
    get() {
        return props.modelValue;
    },

    set(val) {
        emit("update:modelValue", val);
    },
});
</script>
<template>
    <div class="grid grid-cols-9 gap-1 mb-5">
        <template v-for="(choice, i) in choices">
            <div class="sm:col-span-4 col-span-9">
                <div class="flex">
                    <input
                        v-model="proxyChecked['choice_' + choice.value]"
                        type="checkbox"
                        :disabled="disabled"
                        :true-value="1"
                        :false-value="0"
                        class="rounded w-6 h-6 border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                    />

                    <template
                        v-if="
                            image == true &&
                            choice.img_src != null &&
                            choice.img_src != ''
                        "
                    >
                        <div>
                            <div>
                                <p
                                    class="text-green-800 break-words w-[40vmin] ml-5 mt-n1 text-2xl"
                                >
                                    {{ choice.label }}
                                </p>
                            </div>
                            <div class="w-screen">
                                <img
                                    :src="
                                        '/images/questions/' +
                                        choice.img_src +
                                        '?rnd=' +
                                        r_string
                                    "
                                    class="w-[30vmin] bg-white-200 border-solid border-2 border-gray-500 rounded-md"
                                    :class="image == true ? 'mt-5 mb-10' : ''"
                                />
                            </div>
                        </div>
                    </template>
                    <span
                        v-else
                        class="ml-2 break-words w-[40vmin] text-gray-800 text-lg font-lg mr-2 px-2.5 py-0.5 rounded"
                        >{{ choice.label }}</span
                    >
                </div>
                <template v-if="choice.write_in">
                    <QInputText class="ml-6"
                        :disabled="
                            proxyChecked['choice_' + choice.value] == 0 ||
                            disabled == true
                        "
                        v-model="
                            my_choices.answers['write_in_' + qid][
                                'write_' + choice.value
                            ]
                        "
                    />
                </template>
            </div>
        </template>
    </div>
</template>
