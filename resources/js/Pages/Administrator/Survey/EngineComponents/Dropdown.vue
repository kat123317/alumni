<script setup>
defineProps({
    modelValue: Number,
    choices: Array,
});

defineEmits(["update:modelValue"]);
</script>
<template>
    <select
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="bg-gray-100 bg-opacity-50  max-w-[40vmin] rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 pl-3 leading-8 transition-colors duration-200 ease-in-out"
    >
        <option value="0" disabled>Select Choice</option>
        <template v-for="(choice, i) in choices">
            <option class="word-break max-w-[40vmin]" :value="choice.value">
                {{ choice.label }}
            </option>
        </template>
    </select>
</template>
