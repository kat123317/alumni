<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./Socialmedia/Components/emptypost.vue";
import modalCreateJob from "./JobsComponents/ModalCreate.vue";
import modalViewJob from "./JobsComponents/modalView.vue";
import DynamicAlert from "./GlobalComponents/DynamicAlert.vue";
import moment from "moment";

//Delete data
const modal_delete_post = ref(false);
//update data
const modal_update_post = ref(false);

// Alert Function
const postAlert = ref("");
const titleModal = ref(false);
const showJob = ref(false);
const notificationTrigger = ref(false);

// Dynamic Trigger
const alertTrigger = ref(false);
const configDataq = ref({
    title: "",
    desc: "",
    color: "",
    txtcolor: "",
});
const globalAlertTrigger = (title, desc, color, txtcolor, timer) => {
    alertTrigger.value = false;
    configDataq.value.title = title;
    configDataq.value.desc = desc;
    configDataq.value.color = color;
    configDataq.value.txtcolor = txtcolor;
    console.log(configDataq.value);
    alertTrigger.value = true;
    setTimeout(() => {
        alertTrigger.value = false;
    }, timer);
};
// End of Dynamic Trigger

const errorAlert = (data) => {
    if (data) {
        postAlert.value = data;
        setTimeout(() => {
            postAlert.value = "";
        }, 3000);
    }
};

const datatoView = ref("");

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

onMounted(() => {});

const open_notif_data = useForm({
    id: "",
    is_read: 1,
});

const function_open_notif = (id, notif_id) => {
    open_notif_data.id = id;
    open_notif_data.post(route("socialmedia.open_notif", [notif_id]), {
        preserveScroll: true,
        onSuccess: () => {
            open_notif_data.reset();
        },
    });
};

const showData = (data) => {
    datatoView.value = data;
    showJob.value = !showJob.value;
};

const delete_modal_data = useForm({
    id: "",
});

const update_modal_data = useForm({
    id: "",
    job_title: "",
    job_description: "",
    job_email: "",
    job_salary: "",
    job_company: "",
});

const search_data = useForm({
    search_text: usePage().props.value.search_text,
});

const function_open_delete_post_modal = (id) => {
    delete_modal_data.id = id;
    modal_delete_post.value = !modal_delete_post.value;
};

const function_delete_post = () => {
    delete_modal_data.delete(
        route("socialmedia.delete_job_post", [delete_modal_data.id]),
        {
            preserveScroll: true,
            onSuccess: () => {
                modal_delete_post.value = !modal_delete_post.value;
            },
        }
    );
};

const function_open_update_modal = (post) => {
    update_modal_data.id = post.id;
    update_modal_data.job_title = post.job_title;
    update_modal_data.job_description = post.job_description;
    update_modal_data.job_email = post.job_email;
    update_modal_data.job_salary = post.job_salary;
    update_modal_data.job_company = post.job_company;
    modal_update_post.value = !modal_update_post.value;
};

const function_close_update_modal = () => {
    update_modal_data.reset;
    modal_update_post.value = !modal_update_post.value;
};

const function_update_post = () => {
    if (
        update_modal_data.job_title == "" ||
        update_modal_data.job_description == "" ||
        update_modal_data.job_email == "" ||
        update_modal_data.job_salary == "" ||
        update_modal_data.job_company == ""
    ) {
        errorAlert("System will not allow empty posts");
    } else {
        update_modal_data.post(
            route("socialmedia.update_job_post", [update_modal_data.id]),
            {
                preserveScroll: true,
                onSuccess: () => {
                    update_modal_data.reset();
                    modal_update_post.value = !modal_update_post.value;
                },
            }
        );
    }
};

const function_search = () => {
    search_data.get(route("job_posts"), {
        preserveScroll: true,
        onSuccess: () => {},
    });
};
</script>

<template>
    <AppLayout title="Job Posts">
        <DynamicAlert
            :showHideAlert="alertTrigger"
            :dynamicAlertConfig="configDataq"
        />
        <modalViewJob
            :jobData="datatoView"
            @closeModalView="showJob = false"
            :showHideView="showJob"
        />
        <modalCreateJob
            :showHide="titleModal"
            @closeModal="titleModal = false"
            @sumbitData="alert(sumbitData)"
        />
        <section>
            <div
                v-if="postAlert"
                class="p-4 mb-4 border border-blue-300 rounded-lg bg-blue-50"
                role="alert"
            >
                <div class="flex justify-center items-center">
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5 mr-2 text-blue-900"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"
                        ></path>
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
                    <button
                        type="button"
                        @click="postAlert = ''"
                        class="text-blue-900 bg-transparent border border-blue-900 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
                        data-dismiss-target="#alert-additional-content-1"
                        aria-label="Close"
                    >
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
                            <div
                                class="bg-white p-3 border-t-4 border-green-400"
                            >
                                <div class="image overflow-hidden">
                                    <img
                                        class="h-auto rounded-lg w-full mx-auto"
                                        :src="
                                            usePage().props.value.user
                                                .profile_photo_url
                                        "
                                        alt=""
                                    />
                                </div>
                                <h1
                                    class="text-gray-900 font-bold text-xl leading-8 my-1"
                                >
                                    <a
                                        :href="
                                            route('socialmedia.user_profile', [
                                                usePage().props.value.user.id,
                                            ])
                                        "
                                    >
                                        {{ usePage().props.value.user.name }}({{
                                            usePage().props.value.user.details
                                                .nickname
                                        }})
                                    </a>
                                </h1>
                                <h3
                                    class="text-gray-600 font-lg text-semibold leading-6"
                                >
                                    {{
                                        usePage().props.value.user.details
                                            .current_work
                                    }}
                                </h3>
                                <p
                                    class="text-sm text-gray-500 hover:text-gray-600 leading-6"
                                >
                                    <i>
                                        {{
                                            usePage().props.value.user.details
                                                .motto
                                        }}
                                    </i>
                                </p>
                                <ul
                                    class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
                                >
                                    <li class="flex p-2 items-center py-3">
                                        <span>Status</span>
                                        <span class="ml-auto"
                                            ><span
                                                class="bg-green-500 py-1 px-2 rounded text-white text-sm"
                                                >{{
                                                    usePage().props.value.user
                                                        .is_active == 1
                                                        ? "Active"
                                                        : "Deactivated"
                                                }}</span
                                            ></span
                                        >
                                    </li>
                                    <li
                                        @click="
                                            notificationTrigger =
                                                !notificationTrigger
                                        "
                                        class="flex hover:bg-blue-800 hover:text-white p-2 cursor-pointer rounded items-center py-3"
                                    >
                                        <span>Notifications</span>
                                        <span class="ml-auto"
                                            ><span
                                                class="bg-blue-500 animate-pulse py-1 px-2 rounded-full text-white text-sm"
                                                >{{
                                                    usePage().props.value
                                                        .user_notification
                                                        .length
                                                }}</span
                                            ></span
                                        >
                                    </li>

                                    <div
                                        v-if="notificationTrigger"
                                        class="z-20 relative w-full max-w-sm bg-white rounded divide-y divide-gray-100 shadow"
                                        aria-labelledby="dropdownNotificationButton"
                                        data-popper-reference-hidden=""
                                        data-popper-escaped=""
                                        data-popper-placement="bottom"
                                    >
                                        <div
                                            class="block py-2 px-4 font-medium text-center text-gray-700 bg-gray-50"
                                        >
                                            Notifications
                                        </div>
                                        <div
                                            class="divide-y max-h-[70vmin] lg:max-h-[20vmin] overflow-hidden overflow-y-auto divide-gray-100"
                                        >
                                            <a
                                                @click="
                                                    function_open_notif(
                                                        user_notification
                                                            .details.post_id,
                                                        user_notification.id
                                                    )
                                                "
                                                v-for="(
                                                    user_notification, key
                                                ) in usePage().props.value
                                                    .user_notification"
                                                :key="key"
                                                class="flex py-3 px-4 hover:bg-gray-100"
                                            >
                                                <div class="flex-shrink-0">
                                                    <img
                                                        class="w-11 h-11 rounded-full"
                                                        :src="
                                                            user_notification
                                                                .user
                                                                .profile_photo_url
                                                        "
                                                        alt="Jese image"
                                                    />
                                                </div>
                                                <div class="pl-3 w-full">
                                                    <div
                                                        class="text-gray-500 text-sm mb-1.5"
                                                    >
                                                        New message from
                                                        <span
                                                            class="font-semibold text-gray-900"
                                                            >{{
                                                                user_notification
                                                                    .user.name
                                                            }}</span
                                                        >: "{{
                                                            user_notification.title
                                                        }}"
                                                        <p>
                                                            {{
                                                                user_notification.content
                                                            }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="text-xs text-blue-600"
                                                    >
                                                        {{
                                                            date_conversion_from_now(
                                                                user_notification.created_at
                                                            )
                                                        }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a
                                            href="#"
                                            class="block py-2 text-sm font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100"
                                        >
                                            <div
                                                class="inline-flex items-center"
                                            >
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
                                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                                                    />
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
                            <section
                                class="flex flex-col mx-auto overflow-hidden bg-white rounded-lg shadow-lg md:flex-row md:h-48"
                            >
                                <div
                                    class="md:flex md:items-center md:justify-center md:w-1/2 md:bg-gray-700"
                                >
                                    <div class="px-6 py-6 md:px-8 md:py-0">
                                        <h2
                                            class="text-lg font-bold text-gray-700 md:text-gray-100"
                                        >
                                            Post and look for
                                            <span
                                                class="text-blue-600 md:text-blue-300"
                                                >Jobs</span
                                            >
                                            that fits your skills
                                        </h2>

                                        <p
                                            class="mt-2 text-sm text-gray-600 md:text-gray-400"
                                        >
                                            A wise man will make more
                                            opportunities than he finds.” –
                                            Francis Bacon
                                        </p>
                                        <label class="block mt-3" for="email">
                                            <input
                                                v-model="
                                                    search_data.search_text
                                                "
                                                type="text"
                                                name="searchJob"
                                                id="searchJob"
                                                placeholder="Search Job"
                                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                            />
                                        </label>
                                        <button
                                            @click="function_search()"
                                            type="button"
                                            class="text-white bg-green-700 mt-2 float-right hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                        >
                                            Search
                                        </button>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-center pb-6 md:py-0 md:w-1/2"
                                >
                                    <button
                                        type="button"
                                        @click="titleModal = true"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2 inline-flex items-center"
                                    >
                                        Create/Post a Job
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 ml-2 h-5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </section>
                            <!-- End of about section -->
                            <NoPostsYet
                                v-if="usePage().props.value.posts.length == 0"
                            />
                            <div class="my-4"></div>
                            <div
                                v-for="(posts, key) in usePage().props.value
                                    .posts"
                                :key="key"
                                class="bounce-in-top mt-5 px-8 py-4 bg-white rounded-lg shadow-md"
                            >
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-sm font-light text-gray-600"
                                        >{{
                                            only_date_conversion(
                                                posts.created_at
                                            )
                                        }}</span
                                    >
                                    <a
                                        class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500"
                                        tabindex="0"
                                        role="button"
                                        >{{ posts.job_company }}</a
                                    >
                                </div>

                                <div class="mt-2">
                                    <a
                                        href="#"
                                        class="text-2xl font-bold text-gray-700 hover:text-gray-600 hover:underline"
                                        tabindex="0"
                                        role="link"
                                        >{{ posts.job_title }}</a
                                    >
                                    <div
                                        v-html="posts.job_description"
                                        class="mt-2 text-gray-600"
                                    ></div>
                                </div>

                                <div
                                    class="flex items-center justify-between mt-4"
                                >
                                    <a
                                        @click="showData(posts)"
                                        class="text-blue-600 cursor-pointer hover:underline"
                                        tabindex="0"
                                        role="link"
                                        >Show more</a
                                    >

                                    <div class="flex items-center">
                                        <img
                                            class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block"
                                            :src="posts.user.profile_photo_url"
                                            alt="avatar"
                                        />
                                        <a
                                            class="font-bold text-gray-700 cursor-pointer"
                                            tabindex="0"
                                            role="link"
                                            >{{ posts.user.name }}</a
                                        >
                                        <div class="flex justify-end">
                                            <button
                                                @click="
                                                    function_open_update_modal(
                                                        posts
                                                    )
                                                "
                                                v-if="
                                                    posts.user.id ==
                                                    usePage().props.value.user
                                                        .id
                                                "
                                                class="text-lg flex font-bold float-right relative"
                                                href="#"
                                                title="Update your post"
                                            >
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
                                                        class="text-blue-800"
                                                        stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                    />
                                                </svg>
                                            </button>

                                            <button
                                                @click="
                                                    function_open_delete_post_modal(
                                                        posts.id
                                                    )
                                                "
                                                v-if="
                                                    posts.user.id ==
                                                    usePage().props.value.user
                                                        .id
                                                "
                                                class="text-lg font-bold float-right relative flex mr-4"
                                                title="Delete your post"
                                            >
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
                                                        class="text-red-500"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mt-5 justify-center">
                                <small>End of Posts</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="modal_update_post" class=" ">
                <div
                    id="popup-modal"
                    tabindex="-1"
                    class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                >
                    <div
                        class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto"
                    >
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label class="block mt-3" for="title">
                                        <input
                                            type="text"
                                            name="title"
                                            id="title"
                                            placeholder="Job Title"
                                            v-model="
                                                update_modal_data.job_title
                                            "
                                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                        />
                                    </label>

                                    <label class="block mt-3" for="Description">
                                        <textarea
                                            type="Description"
                                            name="Description"
                                            id="Description"
                                            v-model="
                                                update_modal_data.job_description
                                            "
                                            placeholder="Job Description"
                                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                        ></textarea>
                                    </label>

                                    <label class="block mt-3" for="contact">
                                        <input
                                            type="text"
                                            name="contact"
                                            id="contact"
                                            placeholder="Contact Email"
                                            v-model="
                                                update_modal_data.job_email
                                            "
                                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                        />
                                        <small class="text-red-500">{{
                                            usePage().props.value.errors
                                                .job_email
                                        }}</small>
                                    </label>

                                    <label class="block mt-3" for="Salary">
                                        <input
                                            type="text"
                                            name="Salary"
                                            id="Salary"
                                            placeholder="Salary"
                                            v-model="
                                                update_modal_data.job_salary
                                            "
                                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                        />
                                    </label>

                                    <label class="block mt-3" for="Company">
                                        <input
                                            type="text"
                                            name="Company"
                                            id="Company"
                                            placeholder="Company"
                                            v-model="
                                                update_modal_data.job_company
                                            "
                                            class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                                        />
                                    </label>
                                </div>
                            </div>
                            <button
                                @click="function_close_update_modal()"
                                type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="popup-modal"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <h3
                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                >
                                    Are you sure you want to update your
                                    comment?
                                </h3>
                                <button
                                    @click="function_update_post()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_close_update_modal()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                >
                                    No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="modal_delete_post">
                <div
                    id="popup-modal"
                    tabindex="-1"
                    class="overflow-y-auto flex justify-center backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                >
                    <div
                        class="relative p-4 animate w-full max-w-md h-full mt-[20vmin] transition ease-in-out md:h-auto"
                    >
                        <div class="relative bg-white rounded-lg shadow">
                            <button
                                @click="function_open_delete_post_modal()"
                                type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="popup-modal"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg
                                    aria-hidden="true"
                                    class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    ></path>
                                </svg>
                                <h3
                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                                >
                                    Are you sure you want to delete this post?
                                </h3>
                                <button
                                    @click="function_delete_post()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                >
                                    Yes, I'm sure
                                </button>
                                <button
                                    @click="function_open_delete_post_modal()"
                                    data-modal-toggle="popup-modal"
                                    type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                >
                                    No, cancel
                                </button>
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

.bounce-in-top {
    -webkit-animation: bounce-in-top 1.1s both;
    animation: bounce-in-top 1.1s both;
}

@-webkit-keyframes bounce-in-top {
    0% {
        -webkit-transform: translateY(-500px);
        transform: translateY(-500px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
        opacity: 0;
    }

    38% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
        opacity: 1;
    }

    55% {
        -webkit-transform: translateY(-65px);
        transform: translateY(-65px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
    }

    72% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }

    81% {
        -webkit-transform: translateY(-28px);
        transform: translateY(-28px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
    }

    90% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }

    95% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
    }

    100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
}

@keyframes bounce-in-top {
    0% {
        -webkit-transform: translateY(-500px);
        transform: translateY(-500px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
        opacity: 0;
    }

    38% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
        opacity: 1;
    }

    55% {
        -webkit-transform: translateY(-65px);
        transform: translateY(-65px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
    }

    72% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }

    81% {
        -webkit-transform: translateY(-28px);
        transform: translateY(-28px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
    }

    90% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }

    95% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
        -webkit-animation-timing-function: ease-in;
        animation-timing-function: ease-in;
    }

    100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
        -webkit-animation-timing-function: ease-out;
        animation-timing-function: ease-out;
    }
}
</style>
