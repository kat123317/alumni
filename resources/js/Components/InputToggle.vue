<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>
<template>
    <label class="flex items-center cursor-pointer">
        <div class="relative">
            <!-- input -->
            <input v-model="proxyChecked" :value="value" class="btn-toggle" type="checkbox" />
            <!-- line -->
            <div class="w-12 h-7 bg-gray-200 rounded-full shadow-inner"></div>
            <!-- dot -->
            <div class="dot absolute w-6 h-6 bg-white rounded-full shadow left-0.5 top-0.5 transition"></div>
        </div>
        <!-- label -->
        <div class="ml-1 text-gray-600">
            <slot />
        </div>
    </label>  
</template>
<style scoped>
input:checked ~ .dot {
  transform: translateX(80%);
  background-color: rgb(34 197 94);
}

.btn-toggle {
  position: absolute;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border-width: 0;
}
</style>