<script setup>
defineProps(['question'])
</script>
<template>
    <div class="flex">
        <span>{{question.order+'. '}}</span>
        <span>{{question.instruction}}</span>
    </div>
</template>