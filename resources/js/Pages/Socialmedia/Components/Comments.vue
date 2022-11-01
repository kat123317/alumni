<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";

import moment from "moment";

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("MMMM Do YYYY, h:mm:ss a");
    }
};

const date_conversion_from_now = (value) => {
    if (value) {
        return moment(value).fromNow();
    }
};
const option_view = ref(true);

onMounted(() => {});

const comment_data = useForm({
    comment: "",
    post_id: usePage().props.value.post[0].id,
});

const function_comment = () => {
    if (comment_data.comment == "") {
        alert("System will not allow empty comment, Thank you");
    } else {
        comment_data.post(route("socialmedia.add_comment"), {
            preserveScroll: true,
            onSuccess: () => {
                comment_data.reset();
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Comments">
        <div class="bg-gray-200">
            <div
                class="container flex items-center px-6 py-4 mx-auto overflow-y-auto whitespace-nowrap"
            >
                <a href="#" class="text-gray-600 dark:text-gray-200">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                        />
                    </svg>
                </a>

                <span
                    class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </span>

                <a
                    href="#"
                    class="flex items-center text-gray-600 -px-2 hover:underline"
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
                            d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"
                        />
                    </svg>

                    <span class="mx-2">Comments</span>
                </a>
            </div>
        </div>
        <section class="flex justify-center mt-10">
            <article
                class="mb-4 max-w-7xl break-insider w-full p-6 rounded-xl bg-white flex flex-col bg-clip-border"
                v-for="(post, key) in usePage().props.value.post"
                :key="key"
            >
                <div>
                    <a class="text-lg font-bold float-right relative" href="#"
                        >Edit</a
                    >
                </div>
                <div class="flex pb-6 items-cente justify-between">
                    <div class="flex">
                        <a class="inline-block mr-4" href="#">
                            <img
                                class="rounded-full max-w-none w-12 h-12"
                                :src="post.user.profile_photo_url"
                            />
                        </a>
                        <div class="flex flex-col">
                            <div>
                                <a
                                    class="inline-block text-lg font-bold"
                                    href="#"
                                    >{{ post.user.name }}</a
                                >
                            </div>
                            <div class="text-slate-500">
                                {{ date_conversion(post.created_at) }}
                            </div>
                            <div class="text-slate-500">
                                {{ date_conversion_from_now(post.created_at) }}
                            </div>
                        </div>
                    </div>
                </div>
                <p class="">
                    {{ post.content }}
                </p>
                <div class="py-4">
                    <div
                        class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 ..."
                    >
                        <a
                            v-for="(photos, key) in post.photo"
                            :key="key"
                            class="flex"
                            href="#"
                        >
                            <img class="w-auto" :src="photos" />
                        </a>
                    </div>
                </div>

                <div class="py-4">
                    <a class="inline-flex items-center" href="#">
                        <span class="mr-2">
                            <svg
                                class="fill-rose-600"
                                style="width: 24px; height: 24px"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z"
                                ></path>
                            </svg>
                        </span>
                        <span class="text-lg font-bold">34</span>
                    </a>
                </div>
                <div class="relative">
                    <input
                        v-model="comment_data.comment"
                        class="pt-2 pb-2 pl-3 w-full h-11 bg-slate-100 rounded-lg placeholder:text-slate-600 font-medium pr-20"
                        type="text"
                        placeholder="Write a comment"
                        required
                    />
                    <button
                        class="flex absolute right-3 top-2/4 -mt-3 items-center"
                        @click="function_comment()"
                    >
                        <svg
                            class="mr-2"
                            style="width: 26px; height: 26px"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="currentColor"
                                d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z"
                            ></path>
                        </svg>
                        <svg
                            class="fill-blue-500"
                            style="width: 24px; height: 24px"
                            viewBox="0 0 24 24"
                        >
                            <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
                        </svg>
                    </button>
                </div>

                <div v-for="(comments, key) in post.comments" :key="key">
                    <div class="pt-6">
                        <div class="media flex pb-4">
                            <a class="inline-block mr-4" href="#">
                                <img
                                    class="rounded-full max-w-none w-12 h-12"
                                    :src="comments.user.profile_photo_url"
                                />
                            </a>
                            <div class="media-body">
                                <div>
                                    <a
                                        class="inline-block text-base font-bold mr-2"
                                        href="#"
                                        >{{ comments.user.name }}</a
                                    >
                                    <span class="text-slate-500">{{
                                        date_conversion_from_now(
                                            comments.created_at
                                        )
                                    }}</span>
                                    <button
                                        v-if="
                                            comments.user.id ==
                                            usePage().props.value.user.id
                                        "
                                        class="inline-block ml-6"
                                    >
                                        <svg
                                            version="1.1"
                                            id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            x="0px"
                                            y="0px"
                                            width="20px"
                                            height="20px"
                                            viewBox="0 0 420.827 420.827"
                                            style="
                                                enable-background: new 0 0
                                                    420.827 420.827;
                                            "
                                            xml:space="preserve"
                                        >
                                            <path
                                                d="M210.29,0C156,0,104.43,20.693,65.077,58.269C25.859,95.715,2.794,146.022,0.134,199.921
			c-0.135,2.734,0.857,5.404,2.744,7.388c1.889,1.983,4.507,3.105,7.244,3.105h45.211c5.275,0,9.644-4.098,9.979-9.362
			c4.871-76.214,68.553-135.914,144.979-135.914c80.105,0,145.275,65.171,145.275,145.276c0,80.105-65.17,145.276-145.275,145.276
			c-18.109,0-35.772-3.287-52.501-9.771l17.366-15.425c2.686-2.354,3.912-5.964,3.217-9.468c-0.696-3.506-3.209-6.371-6.592-7.521
			l-113-32.552c-3.387-1.149-7.122-0.407-9.81,1.948c-2.686,2.354-3.913,5.963-3.218,9.467L69.71,403.157
			c0.696,3.505,3.209,6.372,6.591,7.521c3.383,1.147,7.122,0.408,9.81-1.946l18.599-16.298
			c31.946,18.574,68.456,28.394,105.581,28.394c116.021,0,210.414-94.392,210.414-210.414C420.705,94.391,326.312,0,210.29,0z"
                                            />
                                            <path
                                                d="M195.112,237.9h118.5c2.757,0,5-2.242,5-5v-30c0-2.757-2.243-5-5-5h-83.5v-91c0-2.757-2.243-5-5-5h-30
			c-2.757,0-5,2.243-5,5v126C190.112,235.658,192.355,237.9,195.112,237.9z"
                                            />
                                        </svg>
                                    </button>
                                    <button
                                        v-if="
                                            comments.user.id ==
                                            usePage().props.value.user.id
                                        "
                                        class="inline-block ml-2"
                                    >
                                        <svg
                                            version="1.1"
                                            id="Capa_1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            x="0px"
                                            y="0px"
                                            width="20px"
                                            height="20px"
                                            viewBox="0 0 482.428 482.429"
                                            style="
                                                enable-background: new 0 0
                                                    482.428 482.429;
                                            "
                                            xml:space="preserve"
                                        >
                                            <path
                                                d="M381.163,57.799h-75.094C302.323,25.316,274.686,0,241.214,0c-33.471,0-61.104,25.315-64.85,57.799h-75.098
			c-30.39,0-55.111,24.728-55.111,55.117v2.828c0,23.223,14.46,43.1,34.83,51.199v260.369c0,30.39,24.724,55.117,55.112,55.117
			h210.236c30.389,0,55.111-24.729,55.111-55.117V166.944c20.369-8.1,34.83-27.977,34.83-51.199v-2.828
			C436.274,82.527,411.551,57.799,381.163,57.799z M241.214,26.139c19.037,0,34.927,13.645,38.443,31.66h-76.879
			C206.293,39.783,222.184,26.139,241.214,26.139z M375.305,427.312c0,15.978-13,28.979-28.973,28.979H136.096
			c-15.973,0-28.973-13.002-28.973-28.979V170.861h268.182V427.312z M410.135,115.744c0,15.978-13,28.979-28.973,28.979H101.266
			c-15.973,0-28.973-13.001-28.973-28.979v-2.828c0-15.978,13-28.979,28.973-28.979h279.897c15.973,0,28.973,13.001,28.973,28.979
			V115.744z"
                                            />
                                            <path
                                                d="M171.144,422.863c7.218,0,13.069-5.853,13.069-13.068V262.641c0-7.216-5.852-13.07-13.069-13.07
			c-7.217,0-13.069,5.854-13.069,13.07v147.154C158.074,417.012,163.926,422.863,171.144,422.863z"
                                            />
                                            <path
                                                d="M241.214,422.863c7.218,0,13.07-5.853,13.07-13.068V262.641c0-7.216-5.854-13.07-13.07-13.07
			c-7.217,0-13.069,5.854-13.069,13.07v147.154C228.145,417.012,233.996,422.863,241.214,422.863z"
                                            />
                                            <path
                                                d="M311.284,422.863c7.217,0,13.068-5.853,13.068-13.068V262.641c0-7.216-5.852-13.07-13.068-13.07
			c-7.219,0-13.07,5.854-13.07,13.07v147.154C298.213,417.012,304.067,422.863,311.284,422.863z"
                                            />
                                        </svg>
                                    </button>
                                </div>
                                <p>
                                    {{ comments.content }}
                                </p>
                                <div class="mt-2 flex items-center">
                                    <a
                                        class="inline-flex items-center py-2 mr-3"
                                        href="#"
                                    >
                                        <span class="mr-2">
                                            <svg
                                                class="fill-rose-600"
                                                style="
                                                    width: 22px;
                                                    height: 22px;
                                                "
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    d="M12.1 18.55L12 18.65L11.89 18.55C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5C9.04 5 10.54 6 11.07 7.36H12.93C13.46 6 14.96 5 16.5 5C18.5 5 20 6.5 20 8.5C20 11.39 16.86 14.24 12.1 18.55M16.5 3C14.76 3 13.09 3.81 12 5.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5C2 12.27 5.4 15.36 10.55 20.03L12 21.35L13.45 20.03C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3Z"
                                                ></path>
                                            </svg>
                                        </span>
                                        <span class="text-base font-bold"
                                            >0</span
                                        >
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </AppLayout>
</template>
