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
                :href="route('socialmedia.comments', [posts.id])"
                v-for="(photos, key) in posts.photo"
                :key="key"
            >
                <img
                    class="w-auto scale-in-top m-1 max-h-[30vmin] object-contain"
                    :src="'./images/posts/' + photos"
                />
            </a>
        </div>
        <div v-if="posts.photo.length == 3">
            <div class="grid grid-cols-2 mt-2">
                <a
                    class="flex justify-center"
                    :href="route('socialmedia.comments', [posts.id])"
                    v-for="(photos, key2) in posts.photo"
                    :key="key2"
                >
                    <img
                        v-if="key2 != 2"
                        class="w-auto scale-in-top max-h-[30vmin] object-contain"
                        :src="'./images/posts/' + photos"
                    />
                </a>
            </div>
            <div class="flex justify-center mx-auto mt-2">
                <img
                    class="w-full scale-in-top max-h-[65vmin] object-contain"
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
                :href="route('socialmedia.comments', [posts.id])"
                v-for="(photos, key) in posts.photo"
                :key="key"
            >
                <img
                    class="w-auto scale-in-top object-contain max-w-[40vmin]"
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
                :href="route('socialmedia.comments', [posts.id])"
                v-for="(photos, key) in posts.photo"
                :key="key"
            >
                <img
                    class="w-screen scale-in-top object-contain max-w-[50vmin]"
                    :src="'./images/posts/' + photos"
                />
            </a>
        </div>
    </div>
</template>

<style scoped>
.scale-in-top {
    -webkit-animation: scale-in-top 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)
        both;
    animation: scale-in-top 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}
@-webkit-keyframes scale-in-top {
    0% {
        -webkit-transform: scale(0);
        transform: scale(0);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        opacity: 1;
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        opacity: 1;
    }
}
@keyframes scale-in-top {
    0% {
        -webkit-transform: scale(0);
        transform: scale(0);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        opacity: 1;
    }
    100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        opacity: 1;
    }
}
</style>
