<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref, onMounted } from 'vue'
import Navbar from './Components/Navbar.vue';
import PostContent from './Components/PostContent.vue';
import ModalAddContent from './Components/ModalAddContent.vue';



</script>
<template>
    <div>
        <Navbar />
        <PostContent class="mt-[8rem]"  /> 
        <ModalAddContent class="mt-[8rem]" />

    </div>
</template>