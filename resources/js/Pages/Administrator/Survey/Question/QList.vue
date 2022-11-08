<script setup>
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import QDropDown from "@/Pages/Administrator/Survey/EngineComponents/Dropdown.vue";
import QSingleSelect from "@/Pages/Administrator/Survey/EngineComponents/SingleSelect.vue";
import QMultipleSelect from "@/Pages/Administrator/Survey/EngineComponents/MultipleSelect.vue";
import { ref, computed } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    question: Object,
    choices: Array,
    modelValue: [Object, Number],
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
    <div class="w-full flex">
        <span>{{ question.order + ". " }}</span>
        <div class="ml-1">
            <div class="w-full">
                {{ question.instruction }}
            </div>
            <template v-if="question.setup.dropdown == true">
                <QDropDown
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
                    :choices="question.setup.choices"
                    v-model="proxyChecked"
                />
            </template>
            <template v-else>
                <QSingleSelect
                    :ukey="question.order"
                    :choices="question.setup.choices"
                    v-model:checked="proxyChecked"
                />
            </template>
        </div>
    </div>
</template>
