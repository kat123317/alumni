<script setup>
import JetInputLabel from "@/Components/InputLabel.vue";
import QInputText from "@/Pages/Administrator/Survey/EngineComponents/InputText.vue";
import { computed, inject } from "vue";
import helpers from "@/helpers.js";

const { random_str } = helpers();

const emit = defineEmits(["update:checked"]);

const r_string = random_str(2);

const props = defineProps({
    checked: {
        type: [Number],
        default: 0,
    },
    value: {
        type: String,
        default: null,
    },
    choices: Array,
    ukey: [String, Number],
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
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>
<template>
    <div class="grid grid-cols gap-1 mb-5">
        <template v-for="(choice, i) in choices">
            <div class="col-span-6">
                <JetInputLabel class="inline-block">
                    <input
                        :name="'radio-' + ukey"
                        :value="choice.value"
                        :disabled="disabled"
                        v-model="proxyChecked"
                        type="radio"
                        class="border-gray-300 w-6 h-6 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
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
                            class="h-[5vmin]"
                        />
                    </template>
                    <span
                        v-else
                        class="ml-2 text-gray-800 text-lg font-lg mr-2 px-2.5 py-0.5 rounded"
                        >{{ choice.label }}</span
                    >
                </JetInputLabel>
                <template v-if="choice.write_in">
                    <QInputText
                        :disabled="checked != choice.value"
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
