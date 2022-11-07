<script setup>
import JetCheckbox from "@/Components/Checkbox.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import { onMounted } from "vue";
const props = defineProps({
    modelValue: Array,
    choices: Array,
});

const emits = defineEmits(["update:modelValue"]);

onMounted(() => {
    /* props.modelValue.forEach((value) => {
        updateValue(value);
    }); */
});

const updateValue = (value) => {
    let values = [...props.modelValue];
    let key = values.indexOf(value);
    if (key == -1) {
        values.push(value);
    } else {
        values.splice(key, 1);
    }
    emits("update:modelValue", values);
};
</script>
<template>
    <div class="grid grid-cols gap-1 mb-5">
        <template v-for="(choice, i) in choices">
            <div class="col-span-6">
                <JetInputLabel>
                    <JetCheckbox
                        class="mr-1"
                        @change="updateValue($event.target.value)"
                        :value="choice.value"
                        :checked="modelValue.includes(choice.value)"
                    />{{ choice.label }}
                </JetInputLabel>
            </div>
        </template>
    </div>
</template>
