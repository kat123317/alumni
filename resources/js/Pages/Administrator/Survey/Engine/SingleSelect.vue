<script setup>
import JetInputLabel from "@/Components/InputLabel.vue";

defineProps({
    modelValue: String,
    choices: Array,
    ukey: [String, Number],
});

defineEmits(["update:modelValue"]);
</script>
<template>
    <div class="grid grid-cols gap-1 mb-5">
        <template v-for="(choice, i) in choices">
            <div class="col-span-6">
                <JetInputLabel>
                    <input
                        :name="'radio-' + ukey"
                        :value="choice.value"
                        @change="
                            $emit('update:modelValue', $event.target.value)
                        "
                        type="radio"
                        class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    />
                    {{ choice.label }}
                </JetInputLabel>
            </div>
        </template>
    </div>
</template>
