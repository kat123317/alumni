<script setup>
import JetInputLabel from "@/Components/InputLabel.vue";
import { computed } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    modelValue: [Object, Number],
    choices: Array,
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
    <div class="grid grid-cols gap-1 mb-5">
        <template v-for="(choice, i) in choices">
            <div class="col-span-6">
                <JetInputLabel>
                    <input
                        v-model="proxyChecked['choice_' + choice.value]"
                        type="checkbox"
                        :disabled="disabled"
                        :true-value="1"
                        :false-value="0"
                        class="rounded w-6 h-6 border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                    />
                   <!-- <span class="ml-2"> {{ choice.label }} </span> -->
                   <span class="ml-2 text-gray-800 text-lg font-lg mr-2 px-2.5 py-0.5 rounded ">{{ choice.label }}</span>
                </JetInputLabel>
            </div>
        </template>
    </div>
</template>
