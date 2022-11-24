<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import PostImage from "@/Pages/Socialmedia/Components/PostImage.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./Socialmedia/Components/emptypost.vue";
import moment from "moment";
import EmojiPicker from "vue3-emoji-picker";

// import css
import "../../../node_modules/vue3-emoji-picker/dist/style.css";

// Alert Function
const postAlert = ref("");
const notificationTrigger = ref(false);
const post_images = ref([]);
const emojioverlay = ref(false);
const emojioverlay2 = ref(false);

const searchUser = ref("")
const SearchType = ref('posts')

const userSearched = ref([])

const errorAlert = (data) => {
    if (data) {
        postAlert.value = data;
        setTimeout(() => {
            postAlert.value = "";
        }, 3000);
    }
};

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

const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};

const option_view = ref(true);

onMounted(() => {
   
});

const post_data = useForm({
    content: "",
    photos: [],
});

const open_notif_data = useForm({
    id: "",
    is_read: 1,
    notif_type: "",
});

const search_data = useForm({
    search_text: usePage().props.value.search_text,
});

const function_add_post = () => {

    // let postEditor = document.getElementById(postEditor).value.replace(/\r\n|\r|\n/g,"<br />")


    // post_data.content.replace(/\r\n|\r|\n/g,"<br />")
    if (post_data.content == "") {
        errorAlert("System will not allow empty post, Sorry");
    } else {
        post_data.post(route("socialmedia.store"), {
            preserveScroll: true,
            onSuccess: () => {
                post_data.reset();
                post_images.value = [];
                post_data.photos = [];

                errorAlert("Your content has been posted");
            },
        });
    }
};

const function_open_notif = (id, notif_id, notif_type) => {
    open_notif_data.id = id;
    open_notif_data.notif_type = notif_type;
    open_notif_data.post(route("socialmedia.open_notif", [notif_id]), {
        preserveScroll: true,
        onSuccess: () => {
            open_notif_data.reset();
        },
    });
};

const like_data = useForm({
    post_id: null,
    post_owner: null,
});
const function_like_post = (post_id, post_owner, is_like) => {
    // let post = usePage().props.value.posts[index];
    // let pkey = post.details.like.indexOf(usePage().props.value.user.id);
    like_data.post_id = post_id;
    like_data.post_owner = post_owner;
    if (is_like) {
        like_data.post(route("socialmedia.unlike_post", [post_id]), {
            preserveScroll: true,
            onSuccess: () => {
                like_data.reset();
            },
        });
    } else {
        like_data.post(route("socialmedia.like_post", [post_id]), {
            preserveScroll: true,
            onSuccess: () => {
                like_data.reset();
            },
        });
    }
};

const commentsSliced = computed((data) => {
    // for arrays
    return data.slice(0, 3);

    // for objects/proxies such as reactive, refs, other computed
    // return yourObject.value.slice(0,5)
});

const function_search = () => {
    search_data.get(route("dashboard"), {
        preserveScroll: true,
        onSuccess: () => { },
    });
};

const openFile = () => {
    let hidden = document.getElementById("post_image");
    hidden.click();
    hidden.onchange = (e) => {
        if (post_images.value.length + e.target.files.length > 4) {
            errorAlert("Only 4 images can be selected");
            return;
        } else {
            for (let index = 0; index < e.target.files.length; index++) {
                post_images.value.push(
                    window.URL.createObjectURL(e.target.files[index])
                );
                post_data.photos.push(e.target.files[index]);
            }
        }
    };
};

const remove_image = (key) => {
    post_images.value.splice(key, 1);
    post_data.photos.splice(key, 1);
};

function onSelectEmoji(emoji) {
    console.log(emoji);
    // let quill = document.getElementById('postEditor').firstChild.innerHTML 

    post_data.content != null
        ? (post_data.content = post_data.content + emoji.i)
        : (post_data.content + emoji.i);


}

function onSelectEmojiSearch(emoji) {
    console.log(emoji);

    search_data.search_text != null
        ? (search_data.search_text = search_data.search_text + emoji.i)
        : (search_data.search_text = emoji.i);
}
</script>

<template>
    <AppLayout title="Dashboard">
        <section>
            <div v-if="postAlert" class="p-4 mb-4 border border-blue-300 rounded-lg bg-blue-50" role="alert">
                <div class="flex justify-center items-center">
                    <svg aria-hidden="true" class="w-5 h-5 mr-2 text-blue-900" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Notification</span>
                    <h3 class="text-lg font-medium text-blue-900">
                        Notification
                    </h3>
                </div>
                <div class="mt-2 text-center mb-4 text-sm text-blue-900">
                    {{ postAlert }}
                </div>
                <div class="flex justify-center">
                    <button type="button" @click="postAlert = ''"
                        class="text-blue-900 bg-transparent border border-blue-900 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
                        data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                        Dismiss
                    </button>
                </div>
            </div>

            <div class="bg-gray-100">
                <div class="container mx-auto my-5 p-5">
                    <div class="md:flex md:-mx-2">
                        <!-- Left Side -->
                        <div class="lg:block w-full md:w-5/12 md:mx-2">
                            <!-- Profile Card -->
                            <div class="bg-white p-3 border-t-4 border-green-400">
                                <div class="image overflow-hidden">
                                    <img class="h-auto rounded-lg w-full mx-auto" :src="
                                        usePage().props.value.user
                                            .profile_photo_url
                                    " alt="" />
                                </div>
                                <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">
                                    <a :href="
                                        route('socialmedia.user_profile', [
                                            usePage().props.value.user.id,
                                        ])
                                    ">
                                        {{ usePage().props.value.user.name }}({{
                                                usePage().props.value.user.details
                                                    .nickname
                                        }})
                                    </a>
                                </h1>
                                <h3 class="text-gray-600 font-lg text-semibold leading-6">
                                    {{
                                            usePage().props.value.user.details
                                                .current_work
                                    }}
                                </h3>
                                <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">
                                    <i>
                                        {{
                                                usePage().props.value.user.details
                                                    .motto
                                        }}
                                    </i>
                                </p>
                                <ul
                                    class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                    <li class="flex p-2 items-center py-3">
                                        <span>Status</span>
                                        <span class="ml-auto"><span
                                                class="bg-green-500 py-1 px-2 rounded text-white text-sm">{{
                                                        usePage().props.value.user
                                                            .is_active == 1
                                                            ? "Active"
                                                            : "Deactivated"
                                                }}</span></span>
                                    </li>
                                    <li @click="
                                        notificationTrigger =
                                        !notificationTrigger
                                    "
                                        class="flex hover:bg-blue-800 hover:text-white p-2 cursor-pointer rounded items-center py-3">
                                        <span>Notifications</span>
                                        <span class="ml-auto"><span
                                                class="bg-blue-500 animate-pulse py-1 px-2 rounded-full text-white text-sm">{{
                                                        usePage().props.value
                                                            .user_notification
                                                            .length
                                                }}</span></span>
                                    </li>

                                    <div v-if="notificationTrigger"
                                        class="z-20 relative w-full max-w-sm bg-white rounded divide-y divide-gray-100 shadow"
                                        aria-labelledby="dropdownNotificationButton" data-popper-reference-hidden=""
                                        data-popper-escaped="" data-popper-placement="bottom">
                                        <div class="block py-2 px-4 font-medium text-center text-gray-700 bg-gray-50">
                                            Notifications
                                        </div>
                                        <div
                                            class="divide-y max-h-[70vmin] lg:max-h-[20vmin] overflow-hidden overflow-y-auto divide-gray-100">
                                            <a @click="
                                                function_open_notif(
                                                    user_notification
                                                        .details.post_id,
                                                    user_notification.id,
                                                    user_notification.notification_type
                                                )
                                            " v-for="(
                                                    user_notification, key
                                                ) in usePage().props.value
                                                .user_notification" :key="key"
                                                class="flex py-3 px-4 hover:bg-gray-100">
                                                <div class="flex-shrink-0">
                                                    <img class="w-11 h-11 rounded-full" :src="
                                                        user_notification
                                                            .user
                                                            .profile_photo_url
                                                    " alt="Jese image" />
                                                </div>
                                                <div class="pl-3 w-full">
                                                    <div class="text-gray-500 text-sm mb-1.5">
                                                        New message from
                                                        <span class="font-semibold text-gray-900">{{
                                                                user_notification
                                                                    .user.name
                                                        }}</span>: "{{
        user_notification.title
}}"
                                                        <p>
                                                            {{
                                                                    user_notification.content
                                                            }}
                                                        </p>
                                                    </div>
                                                    <div class="text-xs text-blue-600">
                                                        {{
                                                                date_conversion_from_now(
                                                                    user_notification.created_at
                                                                )
                                                        }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a href="#"
                                            class="block py-2 text-sm font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100">
                                            <div class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                                </svg>

                                                Hide Notification
                                            </div>
                                        </a>
                                    </div>

                                    <li class="flex p-2 items-center py-3">
                                        <span>Member since</span>
                                        <span class="ml-auto">{{
                                                only_date_conversion(
                                                    usePage().props.value.user
                                                        .created_at
                                                )
                                        }}</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Dropdown menu -->

                            <!-- End of profile card -->
                            <div class="my-4"></div>
                            <!-- Friends card -->
                            <!-- <div class="bg-white mb-5 p-3 hover:shadow">
                                <div
                                    class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8"
                                >
                                    <span class="text-green-500">
                                        <svg
                                            class="h-5 fill-current"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                            />
                                        </svg>
                                    </span>
                                    <span>Online</span>
                                </div>
                                <div class="grid mb-25 grid-cols-3">
                                    <div class="text-center my-2">
                                        <img
                                            class="h-16 w-16 rounded-full mx-auto"
                                            src="https://cdn.australianageingagenda.com.au/wp-content/uploads/2015/06/28085920/Phil-Beckett-2-e1435107243361.jpg"
                                            alt=""
                                        />
                                        <a href="#" class="text-main-color"
                                            >Kojstantin</a
                                        >
                                    </div>
                                    <div class="text-center my-2">
                                        <img
                                            class="h-16 w-16 rounded-full mx-auto"
                                            src="https://avatars2.githubusercontent.com/u/24622175?s=60&amp;v=4"
                                            alt=""
                                        />
                                        <a href="#" class="text-main-color"
                                            >James</a
                                        >
                                    </div>

                                    <div class="text-center my-2">
                                        <img
                                            class="h-16 w-16 rounded-full mx-auto"
                                            src="https://bucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com/public/images/f04b52da-12f2-449f-b90c-5e4d5e2b1469_361x361.png"
                                            alt=""
                                        />
                                        <a href="#" class="text-main-color"
                                            >Casey</a
                                        >
                                    </div>
                                </div>
                            </div> -->
                            <!-- End of friends card -->
                        </div>
                        <!-- Right Side -->
                        <div class="w-full">
                            <!-- Profile tab -->
                            <!-- About Section -->

                            <div class="flex items-center mx-auto max-w-lg lg:max-w-[60vmin] mb-5">
                                <label for="voice-search" class="sr-only">Search</label>
                                <div class="relative w-full ">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input v-if="SearchType == 'posts'" @click="emojioverlay2 = false"
                                        v-model="search_data.search_text" type="text" id="voice-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                        placeholder="Search" required />
                                    <input v-if="SearchType == 'users'" @click="emojioverlay2 = false"
                                        v-model="searchUser" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                        placeholder="Search User" required />

                                    <div v-if="SearchType == 'users' && searchUser != ''"
                                        class=" absolute z-10 w-60 bg-white rounded shadow ">


                                        <ul class="overflow-y-auto py-1 h-48 text-gray-700 "
                                            aria-labelledby="dropdownUsersButton">
                                            <li v-for="(drpUser, index) in usePage().props.value.users" :key="index">
                                                <a v-if="drpUser.name.toLowerCase().includes(searchUser.toLowerCase())" :href="
                                                        route(
                                                            'socialmedia.user_profile',
                                                            [drpUser.id]
                                                        )
                                                    "
                                                    class="flex items-center py-2 px-4 hover:bg-gray-100  ">
                                                    <img class="mr-2 w-6 h-6 rounded-full"
                                                        :src="drpUser.profile_photo_url"
                                                        alt="Jese image">
                                                    {{drpUser.name}}
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="flex justify-center">

                                            <small>Results</small>
                                        </div>
                                        <a @click="searchUser = ''"
                                            class="flex items-center p-3 text-sm font-medium text-blue-600 bg-gray-50 border-t border-gray-200  hover:bg-gray-100  hover:underline">

                                            clear search
                                        </a>
                                    </div>

                                    <button v-if="SearchType == 'posts'" type="button"
                                        @click="emojioverlay2 = !emojioverlay2"
                                        class="flex absolute inset-y-0 right-0 items-center pr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" class="text-yellow-600" stroke-linejoin="round"
                                                d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                                        </svg>
                                    </button>
                                </div>
                                <select id="countries" v-model="SearchType"
                                    class="bg-gray-50 ml-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-25 p-2.5">
                                    <option selected value='posts' disabled> Filter</option>
                                    <option value='posts'>Posts</option>
                                    <option value='users'>User Profile</option>
                                </select>
                                <button v-if="SearchType == 'posts'" @click="function_search()"
                                    class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                    <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>Search
                                </button>
                            </div>

                            <div v-if="emojioverlay" class="z-20 slide-in-elliptic-top-fwd bg-red-200 flex justify-end">
                                <div class="absolute mt-16 mr-8">
                                    <EmojiPicker :native="false" @select="onSelectEmoji" />
                                    <button type="button" @click="emojioverlay = !emojioverlay"
                                        class="float-right w-full text-white mt-1 bg-red-500 border border-gray-300 focus:outline-none hover:bg-red-900 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                                        Close
                                    </button>
                                </div>
                            </div>
                            <div class="bg-white p-3 shadow-sm rounded-lg">
                                <div class="w-full h-16 flex items-center flex justify-between px-5">
                                    <a :href="
                                        route('socialmedia.user_profile', [
                                            usePage().props.value.user.id,
                                        ])
                                    ">
                                        <img class="rounded-full w-10 h-10 mr-3" :src="
                                            usePage().props.value.user
                                                .profile_photo_url
                                        " alt="" />
                                    </a>

                                    <div class="flex w-full items-center">
                                        <label for="voice-search" class="sr-only">Search</label>
                                      
                                        <div class="relative w-full mt-10">

                                    
                                            <!-- <textarea v-model="post_data.content" id="postEditor"
                                                class=" bg-gray-50 max-h-sm border border-gray-300 overflow-hidden text-gray-900 text-sm rounded-lg border-t-1 border-gray-500 focus:ring-blue-500 focus:border-blue-500 block w-full relative  p-2.5"
                                                contentType="html">

                                            </textarea> -->
                                            <QuillEditor v-model:content="post_data.content" theme="snow" toolbar="minimal"   id="postEditor" :content="post_data?.content"  contentType="html"></QuillEditor>
                                            <!-- <button type="button" @click="
                                                emojioverlay = !emojioverlay
                                            " class="flex absolute inset-y-0 right-0 items-center pr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" class="text-yellow-600"
                                                        stroke-linejoin="round"
                                                        d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                                                </svg>
                                            </button> -->
                                        </div>
                                    </div>
                                </div>
                                <div v-if="emojioverlay2 && SearchType == 'posts'" class="flex justify-end">
                                    <div class="absolute slide-in-elliptic-top-fwd mt-ne10 z-200 z-12 lg:mr-52 ">
                                        <EmojiPicker class="z-20" :native="false" @select="onSelectEmojiSearch" />
                                        <button type="button" @click="
                                            emojioverlay2 = !emojioverlay2
                                        "
                                            class="float-right w-full text-white mt-1 bg-red-500 border border-gray-300 focus:outline-none hover:bg-red-900 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                                            Close
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full h-10 flex justify-between mt-12 px-3 md:px-10 lg:px-24 xl:px-5">
                                    <div class="flex">
                                        <button @click="openFile()" class="flex h-full items-center">
                                            <svg class="h-12 text-green-500 stroke-current"
                                                xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                                viewBox="0 0 24 24" fill="none" stroke="#b0b0b0" stroke-width="2"
                                                stroke-linecap="square" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <path d="M20.4 14.5L16 10 4 20" />
                                            </svg>
                                            <span class="text-xs lg:text-md mx-2 font-semibold text-gray-500">Upload
                                                Photo
                                            </span>
                                        </button>
                                    </div>
                                    <input id="post_image" type="file" class="hidden"
                                        accept="image/png, image/gif, image/jpeg" multiple />

                                    <!-- <template v-for="image in post_images">
                                        <img class="h-auto" :src="image" />
                                    </template> -->

                                    <button @click="function_add_post()" type="button"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                        Post
                                        <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div v-if="post_images != null" class="grid mt-2 grid-cols-1 lg:grid-cols-4">
                                <div v-for="(image, key) in post_images" :key="key">
                                    <div class="w-auto mt-2 mx-auto lg:max-w-[20vmin] z-30">
                                        <div class="shadow-lg bg-white p-3">
                                            <img class="w-full max-h-[40vmin] object-cover" :src="image" />
                                            <ul class="mt-3 flex justify-end flex-wrap">
                                                <li>
                                                    <button @click="
                                                        remove_image(key)
                                                    " class="flex text-gray-400 hover:text-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path class="text-red-500" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                        <span class="text-red-500">Remove</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <NoPostsYet v-if="usePage().props.value.posts.length == 0" />
                            <div class="my-4"></div>

                            <article v-for="(posts, key) in usePage().props.value
                            .posts" :key="key"
                                class="mb-4 break-insider w-full p-6 rounded-xl bg-white flex flex-col bg-clip-border">
                                <div class="flex pb-6 items-center justify-between">
                                    <div class="flex">
                                        <a class="inline-block mr-4" :href="
                                            route(
                                                'socialmedia.user_profile',
                                                [posts.user.id]
                                            )
                                        ">
                                            <img class="rounded-full max-w-none w-12 h-12" :src="
                                                posts.user.profile_photo_url
                                            " />
                                        </a>
                                        <div class="flex flex-col">
                                            <div>
                                                <a class="inline-block text-lg font-bold" :href="
                                                    route(
                                                        'socialmedia.user_profile',
                                                        [posts.user.id]
                                                    )
                                                ">{{ posts.user.name }}</a>
                                            </div>
                                            <div class="text-slate-500">
                                                {{
                                                        date_conversion(
                                                            posts.created_at
                                                        )
                                                }}
                                            </div>
                                            <div class="text-slate-500">
                                                {{
                                                        date_conversion_from_now(
                                                            posts.created_at
                                                        )
                                                }}
                                                <!-- if the content is liked -->
                                                <kbd v-if="
                                                    posts.details.like
                                                        .map(
                                                            (res) => res.id
                                                        )
                                                        .includes(
                                                            usePage().props
                                                                .value.user
                                                                .id
                                                        )
                                                "
                                                    class="px-2 ml-2 py-1.5 text-xs font-semibold text-white bg-blue-700 border border-gray-200 rounded-lg">Liked</kbd>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="white-space: pre;" v-html="posts.content"></div>
                                <PostImage :posts="posts" />

                                <div class="py-4">
                                    <div @click="
                                        function_like_post(
                                            posts.id,
                                            posts.user.id,
                                            posts.details.like
                                                .map((res) => res.id)
                                                .includes(
                                                    usePage().props.value
                                                        .user.id
                                                )
                                        )
                                    " class="inline-flex items-center">
                                        <button type="button" :class="
                                            !posts.details.like
                                                .map((res) => res.id)
                                                .includes(
                                                    usePage().props.value
                                                        .user.id
                                                )
                                                ? 'text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2'
                                                : 'text-white border border-blue-700 bg-blue-800 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2'
                                        " :title="
    posts.details.like.map(
        (res) => res.name
    )
">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                            </svg>

                                            <span class="ml-1 font-bold">{{
                                                    posts.details.like.length
                                            }}</span>
                                        </button>
                                    </div>
                                </div>
                                <h2 class="mt-4 border-t font-bold">
                                    Comments
                                </h2>
                                <div class="w-full rounded-lg mx-4 md:mx-auto">
                                    <div v-for="(
                                            commentsData, key2
                                        ) in posts.comments_custom.slice(0, 3)" :key="key2"
                                        class="flex items-start px-4 py-6">
                                        <img class="w-12 h-12 rounded-full object-cover mr-4 shadow" :src="
                                            commentsData.user
                                                .profile_photo_url
                                        " alt="avatar" />
                                        <div class="">
                                            <div class="flex items-center justify-between">
                                                <h2 class="text-lg font-semibold text-gray-900 -mt-1">
                                                    {{ commentsData.user.name }}
                                                </h2>
                                                <small class="ml-2 text-sm text-gray-700">{{
                                                        date_conversion(
                                                            commentsData.created_at
                                                        )
                                                }}</small>
                                            </div>
                                            <p class="text-gray-700">
                                                <small>
                                                    Updated
                                                    {{
                                                            date_conversion(
                                                                commentsData.updated_at
                                                            )
                                                    }}
                                                </small>
                                            </p>
                                            <!-- <p class="mt-3 text-gray-700 text-sm">
                                                {{ commentsData.content }}
                                            </p> -->
                                            <small v-html="commentsData.content"></small>
                                        </div>
                                    </div>
                                </div>
                                <small v-if="
                                    posts.comments_custom != null &&
                                    posts.comments_custom.length > 3
                                " class="text-center my-2 font-bold text-gray-800">{{
        posts.comments_custom.length -
        posts.comments_custom.slice(0, 3).length
}}
                                    more comments
                                </small>
                                <div class="w-full">
                                    <a :href="
                                        route('socialmedia.comments', [
                                            posts.id,
                                        ])
                                    "
                                        class="py-3 px-4 w-full block bg-slate-100 text-center rounded-lg font-medium hover:bg-slate-200 transition ease-in-out delay-75">Show
                                        more comments</a>
                                </div>
                            </article>
                            <div class="flex justify-center">
                                <small>End of Posts</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style>
/* width */
::-webkit-scrollbar {
    width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.mt-ne10 {
    margin-top: -6rem;
}

.ql-toolbar.ql-snow {
    border: 0px solid #d1d5db;
    box-sizing: border-box;
    font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
    padding: 8px;
    
}

.ql-editor{
    max-height:5vmin!important;
   
}
.slide-in-elliptic-top-fwd {
    -webkit-animation: slide-in-elliptic-top-fwd 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    animation: slide-in-elliptic-top-fwd 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

@-webkit-keyframes slide-in-elliptic-top-fwd {
    0% {
        -webkit-transform: translateY(-600px) rotateX(-30deg) scale(0);
        transform: translateY(-600px) rotateX(-30deg) scale(0);
        -webkit-transform-origin: 50% 100%;
        transform-origin: 50% 100%;
        opacity: 0;
    }

    100% {
        -webkit-transform: translateY(0) rotateX(0) scale(1);
        transform: translateY(0) rotateX(0) scale(1);
        -webkit-transform-origin: 50% 1400px;
        transform-origin: 50% 1400px;
        opacity: 1;
    }
}

@keyframes slide-in-elliptic-top-fwd {
    0% {
        -webkit-transform: translateY(-600px) rotateX(-30deg) scale(0);
        transform: translateY(-600px) rotateX(-30deg) scale(0);
        -webkit-transform-origin: 50% 100%;
        transform-origin: 50% 100%;
        opacity: 0;
    }

    100% {
        -webkit-transform: translateY(0) rotateX(0) scale(1);
        transform: translateY(0) rotateX(0) scale(1);
        -webkit-transform-origin: 50% 1400px;
        transform-origin: 50% 1400px;
        opacity: 1;
    }
}

@media only screen and (max-width: 768px) {
    .mt-nmobile {
        margin-top: -60vmin !important;
    }
}
</style>
