<script setup>
import QDropDown from "@/Pages/Administrator/Survey/EngineComponents/Dropdown.vue";
import QSingleSelect from "@/Pages/Administrator/Survey/EngineComponents/SingleSelect.vue";
import QMultipleSelect from "@/Pages/Administrator/Survey/EngineComponents/MultipleSelect.vue";
import QInputText from "@/Pages/Administrator/Survey/EngineComponents/InputText.vue";
import { computed, ref } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    question: Object,
    modelValue: [Object, Number, String],
    disabled: {
        type: Boolean,
        default: false,
    },
});

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
    <div>
        <div
            class="max-w-7xl slide-in-top bg-white mb-6 overflow-hidden rounded-lg shadow-lg"
        >
            <div class="px-4 py-2">
                <h1
                    v-html="question.instruction"
                    class="text-2xl text-focus-in text-green-900 font-bold text-black uppercase"
                ></h1>
            </div>

            <div class="ml-8">
                <template v-if="question.setup.dropdown == true">
                    <QDropDown
                        :disabled="disabled"
                        :choices="question.setup.choices"
                        v-model.number="proxyChecked"
                    />
                </template>
                <template
                    v-else-if="
                        question.setup.dropdown == false &&
                        question.setup.multiple_select == true
                    "
                >
                    <QMultipleSelect
                        :disabled="disabled"
                        :choices="question.setup.choices"
                        :qid="question.id"
                        :image="question.setup.image"
                        v-model="proxyChecked"
                    />
                </template>
                <template v-else-if="question.setup.input == true">
                    <QInputText
                        :placeholder="question.setup.input_label"
                        :disabled="disabled"
                        :value="modelValue"
                        @input="$emit('update:modelValue', $event.target.value)"
                    />
                </template>
                <template v-else>
                    <QSingleSelect
                        :disabled="disabled"
                        :ukey="question.order"
                        :qid="question.id"
                        :choices="question.setup.choices"
                        :image="question.setup.image"
                        v-model:checked="proxyChecked"
                    />
                </template>
            </div>

            <div
                class="flex items-center mt-2 justify-end px-4 py-2 bg-gradient-to-r from-green-900"
            >
                <button
                    disabled
                    class="px-2 text-pop-up-top py-1 text-xs font-semibold text-white uppercase transition-colors duration-300 transform bg-orange-600 rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none color-change-2x"
                >
                    Question {{ question.order }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.text-focus-in {
    -webkit-animation: text-focus-in 1s cubic-bezier(0.55, 0.085, 0.68, 0.53)
        both;
    animation: text-focus-in 1s cubic-bezier(0.55, 0.085, 0.68, 0.53) both;
}

@-webkit-keyframes text-focus-in {
    0% {
        -webkit-filter: blur(12px);
        filter: blur(12px);
        opacity: 0;
    }
    100% {
        -webkit-filter: blur(0px);
        filter: blur(0px);
        opacity: 1;
    }
}
@keyframes text-focus-in {
    0% {
        -webkit-filter: blur(12px);
        filter: blur(12px);
        opacity: 0;
    }
    100% {
        -webkit-filter: blur(0px);
        filter: blur(0px);
        opacity: 1;
    }
}

.slide-in-top {
    -webkit-animation: slide-in-top 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)
        both;
    animation: slide-in-top 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

@-webkit-keyframes slide-in-top {
    0% {
        -webkit-transform: translateY(-1000px);
        transform: translateY(-1000px);
        opacity: 0;
    }
    100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        opacity: 1;
    }
}
@keyframes slide-in-top {
    0% {
        -webkit-transform: translateY(-1000px);
        transform: translateY(-1000px);
        opacity: 0;
    }
    100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        opacity: 1;
    }
}

.color-change-2x {
    -webkit-animation: color-change-2x 5s linear infinite alternate both;
    animation: color-change-2x 5s linear infinite alternate both;
}

@-webkit-keyframes color-change-2x {
    0% {
        background: darkgreen;
    }
    100% {
        background: orange;
    }
}
@keyframes color-change-2x {
    0% {
        background: orange;
    }
    100% {
        background: darkgreen;
    }
}
</style>
