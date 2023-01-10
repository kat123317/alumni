<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Link :href="'/'">
        <div class="flex">
            <img
                class="h-[10vmin]"
                src="/img/logo.jpg"
                alt="Cmu Logo"
                style="border-radius: 50%"
            />

            <img
                class="h-[10vmin]"
                src="/img/logo.jpg"
                alt="Cmu Logo"
                style="border-radius: 50%"
            />
        </div>
    </Link>
</template>
