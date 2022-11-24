<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./emptypost.vue";
import PostImage from "@/Pages/Socialmedia/Components/PostImageProfile.vue";

import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};

const only_date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY");
    }
};

const date_conversion2 = (value) => {
    if (value) {
        return moment(value).format("h:mm:ss");
    }
};

const status = (value) => {
    var status = "";
    if (value == 1) {
        status = "Single";
    } else if (value == 2) {
        status = "Married";
    } else if (value == 3) {
        status = "Annulled";
    } else if (value == 4) {
        status = "Divorce";
    }
    return status;
};
</script>

<template>
    <AppLayout title="UserProfile">
        <!-- component -->
        <div
            class="flex slide-in-blurred-top color-change-2x p-10 flex-col mt-5 items-center justify-center w-full mx-auto"
        >
            <div
                class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg"
            >
                <img
                    class="object-cover object-top w-full h-56"
                    :src="
                        usePage().props.value.user_profile[0].profile_photo_url
                    "
                    alt="avatar"
                />

                <div class="flex items-center px-6 py-3 bg-gray-900">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            class="text-white"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                        />
                    </svg>

                    <h1 class="mx-3 text-lg font-semibold text-white">
                        {{ usePage().props.value.user_profile[0].college.name }}
                        -
                        {{ usePage().props.value.user_profile[0].course.name }}
                    </h1>
                </div>

                <div class="px-6 py-4">
                    <h1 class="text-xl font-semibold text-gray-800">
                        {{ usePage().props.value.user_profile[0].name }}({{
                            usePage().props.value.user_profile[0].details
                                .nickname
                        }})
                    </h1>

                    <p class="py-2 text-gray-700">
                        {{
                            usePage().props.value.user_profile[0].details.motto
                        }}.
                    </p>

                    <div class="flex items-center mt-4 text-gray-700">
                        <svg
                            aria-label="suitcase icon"
                            class="w-6 h-6 fill-current"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M14 11H10V13H14V11Z" />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M7 5V4C7 2.89545 7.89539 2 9 2H15C16.1046 2 17 2.89545 17 4V5H20C21.6569 5 23 6.34314 23 8V18C23 19.6569 21.6569 21 20 21H4C2.34314 21 1 19.6569 1 18V8C1 6.34314 2.34314 5 4 5H7ZM9 4H15V5H9V4ZM4 7C3.44775 7 3 7.44769 3 8V14H21V8C21 7.44769 20.5522 7 20 7H4ZM3 18V16H21V18C21 18.5523 20.5522 19 20 19H4C3.44775 19 3 18.5523 3 18Z"
                            />
                        </svg>

                        <h1 class="px-2 text-sm">
                            {{
                                usePage().props.value.user_profile[0].details
                                    .current_work
                            }}
                        </h1>
                    </div>

                    <div class="flex items-center mt-4 text-gray-700">
                        <svg
                            aria-label="location pin icon"
                            class="w-6 h-6 fill-current"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.063 10.063 6.27214 12.2721 6.27214C14.4813 6.27214 16.2721 8.063 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16757 11.1676 8.27214 12.2721 8.27214C13.3767 8.27214 14.2721 9.16757 14.2721 10.2721Z"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.3941 5.48178 3.79418C8.90918 0.194258 14.6059 0.0543983 18.2059 3.48179C21.8058 6.90919 21.9457 12.606 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.9732 6.93028 5.17326C9.59603 2.37332 14.0268 2.26454 16.8268 4.93029C19.6267 7.59604 19.7355 12.0269 17.0698 14.8268Z"
                            />
                        </svg>

                        <h1 class="px-2 text-sm">
                            {{
                                usePage().props.value.user_profile[0].details
                                    .address
                            }}
                        </h1>
                    </div>

                    <div class="flex items-center mt-4 text-gray-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                            />
                        </svg>

                        <h1 class="px-2 text-sm">
                            {{
                                usePage().props.value.user_profile[0].details
                                    .gender == 1
                                    ? "Male"
                                    : "Female"
                            }}
                        </h1>
                    </div>

                    <div class="flex items-center mt-4 text-gray-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"
                            />
                        </svg>

                        <h1 class="px-2 text-sm">
                            {{
                                only_date_conversion(
                                    usePage().props.value.user_profile[0]
                                        .details.date_of_birth
                                )
                            }}
                        </h1>
                    </div>
                    <div class="flex items-center mt-4 text-gray-700">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                            />
                        </svg>

                        <h1 class="px-2 text-sm">
                            {{
                                usePage().props.value.user_profile[0].details
                                    .religion
                            }}
                        </h1>
                    </div>
                </div>
                <div class="flex p-4">
                    <div class="w-full text-center">
                        <span class="font-bold">
                            {{
                                usePage().props.value.user_profile[0].posts
                                    .length
                            }}</span
                        >
                        Posts
                    </div>
                </div>
            </div>
        </div>

        <h2 class="flex flex-row flex-nowrap items-center my-8">
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
            <span
                class="flex-none block mx-4 px-4 py-2.5 text-xs leading-none font-medium uppercase bg-green-700 rounded-lg text-white"
            >
                Posts
            </span>
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
        </h2>
        <NoPostsYet v-if="usePage().props.value.user_profile[0].length == 0" />
        <div
            class="w-full px-2 lg:px-[25vmin] grid grid-cols-1 lg:grid-cols-1 gap-3"
        >
            <article
                v-for="(posts, key) in usePage().props.value.user_profile[0]
                    .posts"
                :key="key"
                class="mb-4 w-full break-inside p-6 rounded-xl bg-white"
            >
                <div class="flex pb-6 items-center justify-between">
                    <div class="flex">
                        <a class="inline-block mr-4" href="#">
                            <img
                                class="rounded-full max-w-none w-12 h-12"
                                :src="posts.user.profile_photo_url"
                            />
                        </a>
                        <div class="flex flex-col">
                            <div>
                                <a class="inline-block text-lg font-bold">
                                    {{ posts.user.name }}</a
                                >
                            </div>
                            <div class="text-slate-500">
                                {{ date_conversion(posts.created_at) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="py-4">
                        <div class="flex justify-between gap-1 mb-1">
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-tl-lg"
                                    src="https://images.pexels.com/photos/92866/pexels-photo-92866.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full"
                                    src="https://images.pexels.com/photos/247929/pexels-photo-247929.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-tr-lg"
                                    src="https://images.pexels.com/photos/631522/pexels-photo-631522.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                        </div>
                        <div class="flex justify-between gap-1">
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-bl-lg"
                                    src="https://images.pexels.com/photos/1429748/pexels-photo-1429748.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-br-lg"
                                    src="https://images.pexels.com/photos/69020/pexels-photo-69020.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                        </div>
                    </div> -->
                <!-- <p class="">
                    {{ posts.content }}
                </p> -->
                <div v-html="posts.content"></div>
                <PostImage :posts="posts" />
                <!-- <div v-if="posts.photo != null" class="py-4 mx-auto">
                    <div v-if="posts.photo.length > 3" class="grid grid-cols-2">
                        <a
                            :href="'./../../images/posts/' + photos"
                            target="_blank"
                            class="flex"
                            v-for="(photos, key) in posts.photo"
                            :key="key"
                        >
                            <img
                                class="w-auto m-1 max-h-[55vmin] hover:bg-gray-200 hover:scale-100 object-contain"
                                :src="'./../../images/posts/' + photos"
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
                                    :href="'./../../images/posts/' + photos"
                                    target="_blank"
                                    class="w-auto max-h-[55vmin] hover:bg-gray-200 object-contain"
                                    :src="'./../../images/posts/' + photos"
                                />
                            </a>
                        </div>
                        <div class="flex justify-center mx-auto">
                            <img
                                class="w-full max-h-[100vmin] hover:bg-gray-200 object-contain"
                                :href="'./../../images/posts/' + photos"
                                target="_blank"
                                :src="'./../../images/posts/' + posts.photo[2]"
                            />
                        </div>
                    </div>
                    <div
                        v-if="posts.photo.length == 2"
                        class="grid grid-cols-2 grid-rows-1 ..."
                    >
                        <a
                            class="flex"
                            :href="'./../../images/posts/' + photos"
                            target="_blank"
                            v-for="(photos, key) in posts.photo"
                            :key="key"
                        >
                            <img
                                class="w-auto object-contain hover:bg-gray-200 max-w-[40vmin]"
                                :src="'./../../images/posts/' + photos"
                            />
                        </a>
                    </div>
                    <div
                        v-if="posts.photo.length == 1"
                        class="grid grid-cols-1 grid-rows-1 ..."
                    >
                        <a
                            class="flex"
                            :href="'./../../images/posts/' + photos"
                            target="_blank"
                            v-for="(photos, key) in posts.photo"
                            :key="key"
                        >
                            <img
                                class="w-auto object-contain hover:bg-gray-200 max-w-[100vmin]"
                                :src="'./../../images/posts/' + photos"
                            />
                        </a>
                    </div>
                </div> -->
                <!-- <div class="py-4">
                        <a class="inline-flex items-center" href="#">
                            <span class="mr-2">
                                <svg class="fill-rose-600 dark:fill-rose-400" style="width: 24px; height: 24px"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z">
                                    </path>
                                </svg>
                            </span>
                            <span class="text-lg font-bold">34</span>
                        </a>
                    </div> -->
                <h2 class="mt-4 border-t font-bold">Comments</h2>

                <div class="w-full rounded-lg mx-4 md:mx-auto">
                    <div
                        v-for="(commentsData, key2) in posts.comments.slice(
                            0,
                            3
                        )"
                        :key="key2"
                        class="flex items-start px-4 py-6"
                    >
                        <img
                            class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                            :src="commentsData.user.profile_photo_url"
                            alt="avatar"
                        />
                        <div class="">
                            <div class="flex items-center justify-between">
                                <h2
                                    class="text-lg font-semibold text-gray-900 -mt-1"
                                >
                                    {{ commentsData.user.name }}
                                </h2>
                                <small class="ml-2 text-sm text-gray-700">{{
                                    date_conversion(commentsData.created_at)
                                }}</small>
                            </div>
                            <p class="text-gray-700">
                                <small>
                                    Updated
                                    {{
                                        date_conversion(commentsData.updated_at)
                                    }}
                                </small>
                            </p>
                            <small v-html="commentsData.content" >
                         
                            </small>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <small
                        v-if="
                            posts.comments != null && posts.comments.length > 3
                        "
                        class="text-center w-fullmy-2 font-bold text-gray-800"
                        >{{
                            posts.comments.length -
                            posts.comments.slice(0, 3).length
                        }}
                        more comments
                    </small>
                </div>
                <!-- Comments content -->
                <div class="pt-6 flex items-end">
                    <div class="w-full">
                        <a
                            :href="route('socialmedia.comments', [posts.id])"
                            class="py-3 px-4 w-full block bg-slate-100 text-center rounded-lg font-medium hover:bg-slate-200 transition ease-in-out delay-75"
                            >Show more comments
                            <kbd
                                class="px-2 py-1.5 text-xs font-semibold text-white bg-green-800 border border-green-200 rounded-lg"
                                >{{ posts.comments.length }}</kbd
                            ></a
                        >
                    </div>
                </div>
            </article>
        </div>
    </AppLayout>
</template>

<style>
.slide-in-blurred-top {
    -webkit-animation: slide-in-blurred-top 0.6s cubic-bezier(0.23, 1, 0.32, 1)
        both;
    animation: slide-in-blurred-top 0.6s cubic-bezier(0.23, 1, 0.32, 1) both;
}
@-webkit-keyframes slide-in-blurred-top {
    0% {
        -webkit-transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
        transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        -webkit-filter: blur(40px);
        filter: blur(40px);
        opacity: 0;
    }
    100% {
        -webkit-transform: translateY(0) scaleY(1) scaleX(1);
        transform: translateY(0) scaleY(1) scaleX(1);
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
        -webkit-filter: blur(0);
        filter: blur(0);
        opacity: 1;
    }
}
@keyframes slide-in-blurred-top {
    0% {
        -webkit-transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
        transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
        -webkit-transform-origin: 50% 0%;
        transform-origin: 50% 0%;
        -webkit-filter: blur(40px);
        filter: blur(40px);
        opacity: 0;
    }
    100% {
        -webkit-transform: translateY(0) scaleY(1) scaleX(1);
        transform: translateY(0) scaleY(1) scaleX(1);
        -webkit-transform-origin: 50% 50%;
        transform-origin: 50% 50%;
        -webkit-filter: blur(0);
        filter: blur(0);
        opacity: 1;
    }
}

.color-change-2x {
    -webkit-animation: color-change-2x 15s linear infinite alternate both;
    animation: color-change-2x 15s linear infinite alternate both;
}
@-webkit-keyframes color-change-2x {
    0% {
        background: url("https://i.ibb.co/nBKwccJ/289477558-4864993176937968-3609150892766849862-n.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    100% {
        background-repeat: no-repeat;
        background: url("https://i.ibb.co/ZmpB7y3/306558599-5084267358343881-7154566250070857023-n.jpg");
        background-size: cover;
    }
}
@keyframes color-change-2x {
    0% {
        background: url("https://i.ibb.co/nBKwccJ/289477558-4864993176937968-3609150892766849862-n.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    100% {
        background-repeat: no-repeat;
        background: url("https://i.ibb.co/ZmpB7y3/306558599-5084267358343881-7154566250070857023-n.jpg");
        background-size: cover;
    }
}
</style>
