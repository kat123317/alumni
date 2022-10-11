<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Yearbook from '@/Pages/Yearbook/Yearbook.vue'
</script>

<template>
    <AppLayout title="Yearbook">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                YB
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Yearbook />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
