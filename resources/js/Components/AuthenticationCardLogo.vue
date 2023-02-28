<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Link :href="'/'">
        <div class="flex">
            <div>
                <img
                    class="h-[5vmin]"
                    src="/img/logo.jpg"
                    alt="Cmu Logo"
                    style="border-radius: 50%"
                />
            </div>
            <div>
                <img
                class="h-[8vmin] mt-[-14px]"
                src="/img/CMUAI.png"
                alt="Cmu Logo"
                style="border-radius: 50%;"
            />
            </div>
        </div>
    </Link>
</template>
