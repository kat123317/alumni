<script setup>
import JetInputLabel from "@/Components/InputLabel.vue";
import { computed } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    modelValue: [Object, Number],
    choices: Array,
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
    <div class="grid grid-cols gap-1 mb-5">
        <template v-for="(choice, i) in choices">
            <div class="col-span-6">
                <JetInputLabel>
                    <input
                        v-model="proxyChecked['choice_' + choice.value]"
                        type="checkbox"
                        :true-value="1"
                        :false-value="0"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                    {{ choice.label }}
                </JetInputLabel>
            </div>
        </template>
    </div>
</template>
