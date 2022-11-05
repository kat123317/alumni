<script setup>
</script>
<template>
    <div class="grid grid-cols-6 gap-1 px-2 mt-2">
        <template v-for="(question, index) in $page.props.survey.questions">
            <div class="col-span-6">
                <div class="flex">
                    <span>{{question.order+'. '}}</span>
                    <span>{{question.instruction}}</span>
                </div>
            </div>
        </template>
    </div>
</template>