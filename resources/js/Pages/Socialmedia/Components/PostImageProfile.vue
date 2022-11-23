<script setup>
defineProps(["posts"]);
</script>

<template>
    <div
        v-if="posts.photo != null"
        class="py-4 mx-auto px-5 bg-gray-50 rounded-lg"
    >
        <div v-if="posts.photo.length == 4">
            <div class="flex justify-center">
                <a
                    class="flex"
                    :href="route('socialmedia.comments', [posts.id])"
                    v-for="(photos, key2) in posts.photo"
                    :key="key2"
                >
                    <img
                        v-if="key2 <= 1"
                        class="w-screen max-h-[40vmin] max-w-[40vmin] object-contain"
                        :src="'./../../images/posts/' + photos"
                    />
                </a>
            </div>
            <div class="flex justify-center mx-auto">
                <a
                    class="flex"
                    :href="route('socialmedia.comments', [posts.id])"
                    v-for="(photos, key2) in posts.photo"
                    :key="key2"
                >
                    <img
                        v-if="key2 > 1"
                        class="w-screen max-h-[40vmin] max-w-[40vmin] object-contain"
                        :src="'./../../images/posts/' + photos"
                    />
                </a>
            </div>
            <!-- <a
                class="flex"
                :href="
                                            route('socialmedia.comments', [
                                                posts.id,
                                            ])
                                        "
                v-for="(photos, key) in posts.photo"
                :key="key"
            >
                <img
                    class="w-auto m-1 max-h-[30vmin] object-contain"
                    :src="'./../../images/posts/' + photos"
                />
            </a> -->
        </div>
        <div v-if="posts.photo.length == 3">
            <div class="flex justify-center">
                <a
                    class="flex"
                    :href="route('socialmedia.comments', [posts.id])"
                    v-for="(photos, key2) in posts.photo"
                    :key="key2"
                >
                    <img
                        v-if="key2 != 2"
                        class="w-screen max-h-[40vmin] max-w-[40vmin] object-contain"
                        :src="'./../../images/posts/' + photos"
                    />
                </a>
            </div>
            <div class="flex justify-center mx-auto">
                <img
                    class="w-full max-h-[40vmin] object-contain"
                    :src="'./../../images/posts/' + posts.photo[2]"
                />
            </div>
        </div>
        <div v-if="posts.photo.length == 2">
            <div class="flex justify-center">
                <a
                    class="flex"
                    :href="route('socialmedia.comments', [posts.id])"
                    v-for="(photos, key) in posts.photo"
                    :key="key"
                >
                    <img
                        class="w-screen object-contain max-h-[40vmin] max-w-[40vmin]"
                        :src="'./../../images/posts/' + photos"
                    />
                </a>
            </div>
        </div>
        <div v-if="posts.photo.length == 1">
            <div class="flex justify-center">
                <a
                    class="flex"
                    :href="route('socialmedia.comments', [posts.id])"
                    v-for="(photos, key) in posts.photo"
                    :key="key"
                >
                    <img
                        class="w-screen object-contain max-h-[50vmin] max-w-[50vmin]"
                        :src="'./../../images/posts/' + photos"
                    />
                </a>
            </div>
        </div>
    </div>
</template>
