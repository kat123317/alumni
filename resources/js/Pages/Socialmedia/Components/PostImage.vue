<script setup>
defineProps(["posts"]);
</script>

<template>
    <div
        v-if="posts.photo != null"
        class="py-4 mx-auto px-5 bg-gray-50 rounded-lg"
    >
        <div v-if="posts.photo.length > 3" class="grid grid-cols-2">
            <a
                class="flex"
                href="#"
                v-for="(photos, key) in posts.photo"
                :key="key"
            >
                <img
                    class="w-auto m-1 max-h-[30vmin] object-contain"
                    :src="'./images/posts/' + photos"
                />
            </a>
        </div>
        <div v-if="posts.photo.length == 3">
            <div class="grid grid-cols-2">
                <a
                    class="flex"
                    href="#"
                    v-for="(photos, key2) in posts.photo"
                    :key="key2"
                >
                    <img
                        v-if="key2 != 2"
                        class="w-auto max-h-[30vmin] object-contain"
                        :src="'./images/posts/' + photos"
                    />
                </a>
            </div>
            <div class="flex justify-center mx-auto">
                <img
                    class="w-full max-h-[65vmin] object-contain"
                    :src="'./images/posts/' + posts.photo[2]"
                />
            </div>
        </div>
        <div
            v-if="posts.photo.length == 2"
            class="grid grid-cols-2 grid-rows-1 ..."
        >
            <a
                class="flex"
                href="#"
                v-for="(photos, key) in posts.photo"
                :key="key"
            >
                <img
                    class="w-auto object-contain max-w-[40vmin]"
                    :src="'./images/posts/' + photos"
                />
            </a>
        </div>
        <div
            v-if="posts.photo.length == 1"
            class="grid grid-cols-1 grid-rows-1 ..."
        >
            <a
                class="flex"
                href="#"
                v-for="(photos, key) in posts.photo"
                :key="key"
            >
                <img
                    class="w-screen object-contain max-w-[50vmin]"
                    :src="'./images/posts/' + photos"
                />
            </a>
        </div>
    </div>
</template>
