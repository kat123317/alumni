<script setup>
import JetInputLabel from "@/Components/InputLabel.vue";
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

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
});

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
                <JetInputLabel>
                    <input
                        :name="'radio-' + ukey"
                        :value="choice.value"
                        :disabled="disabled"
                        v-model="proxyChecked"
                        type="radio"
                        class="border-gray-300 w-6 h-6  text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                    <span class="ml-2 text-gray-800 text-lg font-lg mr-2 px-2.5 py-0.5 rounded ">{{ choice.label }}</span>
                </JetInputLabel>
            </div>
        </template>
    </div>
</template>
