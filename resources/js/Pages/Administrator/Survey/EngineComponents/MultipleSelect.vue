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
    <div class="grid grid-cols gap-1 mb-5">
        <template v-for="(choice, i) in choices">
            <div class="col-span-6">
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
                        <img
                            :src="
                                '/images/questions/' +
                                choice.img_src +
                                '?rnd=' +
                                r_string
                            "
                            class="h-[20vmin] ml-10"
                        />
                    </template>
                    <span
                        v-else
                        class="ml-2 text-gray-800 text-lg font-lg mr-2 px-2.5 py-0.5 rounded"
                        >{{ choice.label }}</span
                    >
                </div>
                <template v-if="choice.write_in">
                    <QInputText
                        :disabled="proxyChecked['choice_' + choice.value] == 0"
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
