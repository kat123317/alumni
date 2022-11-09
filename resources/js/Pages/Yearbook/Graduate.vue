<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import GraduateList from '@/Pages/Yearbook/GraduateList.vue';

const props = defineProps(['graduates', 'courses', 'colleges']);
</script>

<template>
    <AppLayout title="Yearbook">
        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <GraduateList />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
