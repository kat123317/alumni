<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import moment from "moment";

const open_convo_data = useForm({
    user1: null,
    user2: null,
});

const message_data = useForm({
    conversation_id: null,
    content: "",
    user_id_2: null,
});

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

const function_open_messages = (id) => {
    open_convo_data.user1 = usePage().props.value.user.id;
    open_convo_data.user2 = id;
    open_convo_data.get(route("socialmedia.messaging"), {
        preserveScroll: true,
        onSuccess: () => {
            open_convo_data.reset();
        },
    });
};

const function_send_message = (id) => {
    try {
        message_data.conversation_id = usePage().props.value.conversation[0].id;
        message_data.post(route("socialmedia.send_message"), {
            preserveScroll: true,
            onSuccess: () => {
                message_data.reset();
            },
        });
    } catch {
        message_data.user_id_2 = id;
        message_data.post(route("socialmedia.send_message"), {
            preserveScroll: true,
            onSuccess: () => {
                message_data.reset();
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Messenger">
        <div>
            <div class="container mx-auto">
                <div class="mx-2 block lg:hidden">
                    <h1 class="text-center my-4 text-gray-800 font-bold">
                        Hey!
                    </h1>
                    <label
                        for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only"
                        >Search</label
                    >
                    <div class="relative">
                        <div
                            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-5 h-5 text-gray-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                ></path>
                            </svg>
                        </div>
                        <input
                            type="search"
                            id="default-search"
                            class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 da"
                            placeholder="Search user"
                            required
                        />
                        <button
                            type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
                        >
                            Search
                        </button>
                    </div>
                    <div
                        id="dropdownUsers"
                        class="z-10 w-full mt-2 bg-white rounded shadow"
                    >
                        <ul
                            class="overflow-y-auto py-1 h-48 text-gray-700"
                            aria-labelledby="dropdownUsersButton"
                        >
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Jese Leos
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Robert Gough
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Bonnie Green
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Leslie Livingston
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Michael Gough
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Joseph Mcfall
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Roberta Casas
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="flex items-center py-2 px-4 hover:bg-gray-100"
                                >
                                    <img
                                        class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-4.jpg"
                                        alt="Jese image"
                                    />
                                    Neil Sims
                                </a>
                            </li>
                        </ul>
                        <a
                            href="#"
                            class="flex items-center p-3 text-sm font-medium text-green-600 bg-gray-50 border-t border-gray-200 hover:bg-gray-100 dark:bg-gray-700"
                        >
                            <svg
                                class="mr-1 w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"
                                ></path>
                            </svg>
                            Online
                        </a>
                    </div>
                </div>
                <div class="py-6 px-2">
                    <div
                        class="flex border border-grey h-[150vmin] lg:h-[80vmin] rounded shadow-lg"
                    >
                        <!-- Left -->
                        <div class="w-1/3 hidden lg:block border flex flex-col">
                            <!-- Header -->
                            <div
                                class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center"
                            >
                                <div>
                                    <img
                                        class="w-10 h-10 rounded-full"
                                        :src="
                                            usePage().props.value.user
                                                .profile_photo_url
                                        "
                                    />
                                </div>

                                <div class="flex">
                                    <div>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#727A7E"
                                                d="M12 20.664a9.163 9.163 0 0 1-6.521-2.702.977.977 0 0 1 1.381-1.381 7.269 7.269 0 0 0 10.024.244.977.977 0 0 1 1.313 1.445A9.192 9.192 0 0 1 12 20.664zm7.965-6.112a.977.977 0 0 1-.944-1.229 7.26 7.26 0 0 0-4.8-8.804.977.977 0 0 1 .594-1.86 9.212 9.212 0 0 1 6.092 11.169.976.976 0 0 1-.942.724zm-16.025-.39a.977.977 0 0 1-.953-.769 9.21 9.21 0 0 1 6.626-10.86.975.975 0 1 1 .52 1.882l-.015.004a7.259 7.259 0 0 0-5.223 8.558.978.978 0 0 1-.955 1.185z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                opacity=".55"
                                                fill="#263238"
                                                d="M19.005 3.175H4.674C3.642 3.175 3 3.789 3 4.821V21.02l3.544-3.514h12.461c1.033 0 2.064-1.06 2.064-2.093V4.821c-.001-1.032-1.032-1.646-2.064-1.646zm-4.989 9.869H7.041V11.1h6.975v1.944zm3-4H7.041V7.1h9.975v1.944z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".6"
                                                d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Search -->
                            <div class="py-2 px-2 bg-grey-lightest">
                                <input
                                    type="text"
                                    class="w-full px-2 py-2 text-sm"
                                    placeholder="Search or start new chat"
                                />
                            </div>

                            <!-- Contacts -->
                            <div
                                class="bg-grey-lighter w-[100vmin] flex-1 overflow-auto"
                                v-for="(users, key) in usePage().props.value
                                    .users"
                                :key="key"
                            >
                                <div
                                    @click="function_open_messages(users.id)"
                                    class="bg-white px-3 flex items-center hover:bg-grey-lighter cursor-pointer"
                                >
                                    <div>
                                        <img
                                            class="h-12 w-12 rounded-full"
                                            :src="users.profile_photo_url"
                                        />
                                    </div>
                                    <div
                                        class="ml-4 flex-1 border-b border-grey-lighter py-4"
                                    >
                                        <div
                                            class="flex items-bottom justify-between"
                                        >
                                            <p class="text-grey-darkest">
                                                {{ users.name }}
                                            </p>
                                            <p
                                                class="text-xs text-grey-darkest"
                                            >
                                                {{
                                                    date_conversion_from_now(
                                                        users.created_at
                                                    )
                                                }}
                                            </p>
                                        </div>
                                        <p class="text-grey-dark mt-1 text-sm">
                                            I'll be back
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right -->
                        <div
                            v-if="
                                usePage().props.value.conversation.length == 0
                            "
                            class="w-full border flex flex-col"
                        >
                            <!-- Header -->
                            <div
                                class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center"
                            >
                                <div class="flex">
                                    <div>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".5"
                                                d="M15.9 14.3H15l-.3-.3c1-1.1 1.6-2.7 1.6-4.3 0-3.7-3-6.7-6.7-6.7S3 6 3 9.7s3 6.7 6.7 6.7c1.6 0 3.2-.6 4.3-1.6l.3.3v.8l5.1 5.1 1.5-1.5-5-5.2zm-6.2 0c-2.6 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6 4.6 2.1 4.6 4.6-2 4.6-4.6 4.6z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".5"
                                                d="M1.816 15.556v.002c0 1.502.584 2.912 1.646 3.972s2.472 1.647 3.974 1.647a5.58 5.58 0 0 0 3.972-1.645l9.547-9.548c.769-.768 1.147-1.767 1.058-2.817-.079-.968-.548-1.927-1.319-2.698-1.594-1.592-4.068-1.711-5.517-.262l-7.916 7.915c-.881.881-.792 2.25.214 3.261.959.958 2.423 1.053 3.263.215l5.511-5.512c.28-.28.267-.722.053-.936l-.244-.244c-.191-.191-.567-.349-.957.04l-5.506 5.506c-.18.18-.635.127-.976-.214-.098-.097-.576-.613-.213-.973l7.915-7.917c.818-.817 2.267-.699 3.23.262.5.501.802 1.1.849 1.685.051.573-.156 1.111-.589 1.543l-9.547 9.549a3.97 3.97 0 0 1-2.829 1.171 3.975 3.975 0 0 1-2.83-1.173 3.973 3.973 0 0 1-1.172-2.828c0-1.071.415-2.076 1.172-2.83l7.209-7.211c.157-.157.264-.579.028-.814L11.5 4.36a.572.572 0 0 0-.834.018l-7.205 7.207a5.577 5.577 0 0 0-1.645 3.971z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".6"
                                                d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div
                                class="flex-1 overflow-auto"
                                style="background-color: #dad3cc"
                            >
                                <div class="py-2 px-3">
                                    <div class="flex justify-center mb-2">
                                        <div class="rounded py-2 px-4">
                                            <p class="text-sm uppercase">
                                                {{
                                                    only_date_conversion(
                                                        new Date()
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex justify-center mb-4">
                                        <div
                                            class="rounded py-2 px-4"
                                            style="background-color: #fcf4cb"
                                        >
                                            <p class="text-xs">
                                                Messages to this chat and calls
                                                are now secured with end-to-end
                                                encryption.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input -->
                            <div
                                class="bg-grey-lighter px-4 py-4 flex items-center"
                            >
                                <div>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        width="24"
                                        height="24"
                                    >
                                        <path
                                            opacity=".45"
                                            fill="#263238"
                                            d="M9.153 11.603c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962zm-3.204 1.362c-.026-.307-.131 5.218 6.063 5.551 6.066-.25 6.066-5.551 6.066-5.551-6.078 1.416-12.129 0-12.129 0zm11.363 1.108s-.669 1.959-5.051 1.959c-3.505 0-5.388-1.164-5.607-1.959 0 0 5.912 1.055 10.658 0zM11.804 1.011C5.609 1.011.978 6.033.978 12.228s4.826 10.761 11.021 10.761S23.02 18.423 23.02 12.228c.001-6.195-5.021-11.217-11.216-11.217zM12 21.354c-5.273 0-9.381-3.886-9.381-9.159s3.942-9.548 9.215-9.548 9.548 4.275 9.548 9.548c-.001 5.272-4.109 9.159-9.382 9.159zm3.108-9.751c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962z"
                                        ></path>
                                    </svg>
                                </div>
                                <div class="flex-1 mx-4">
                                    <input
                                        class="w-full border rounded px-2 py-2"
                                        type="text"
                                        disabled
                                    />
                                </div>
                                <div>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        width="24"
                                        height="24"
                                    >
                                        <path
                                            fill="#263238"
                                            fill-opacity=".45"
                                            d="M11.999 14.942c2.001 0 3.531-1.53 3.531-3.531V4.35c0-2.001-1.53-3.531-3.531-3.531S8.469 2.35 8.469 4.35v7.061c0 2.001 1.53 3.531 3.53 3.531zm6.238-3.53c0 3.531-2.942 6.002-6.237 6.002s-6.237-2.471-6.237-6.002H3.761c0 4.001 3.178 7.297 7.061 7.885v3.884h2.354v-3.884c3.884-.588 7.061-3.884 7.061-7.885h-2z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div
                            v-else-if="usePage().props.value.conversation.name"
                            class="w-full border flex flex-col"
                        >
                            <!-- Header -->
                            <div
                                class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center"
                            >
                                <div class="flex items-center">
                                    <div>
                                        <img
                                            class="w-10 h-10 rounded-full"
                                            :src="
                                                usePage().props.value
                                                    .user_selected
                                                    .profile_photo_url
                                            "
                                        />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-grey-darkest">
                                            {{
                                                usePage().props.value
                                                    .user_selected.name
                                            }}
                                        </p>
                                        <p
                                            class="text-grey-darker text-xs mt-1"
                                        >
                                            Online
                                        </p>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".5"
                                                d="M15.9 14.3H15l-.3-.3c1-1.1 1.6-2.7 1.6-4.3 0-3.7-3-6.7-6.7-6.7S3 6 3 9.7s3 6.7 6.7 6.7c1.6 0 3.2-.6 4.3-1.6l.3.3v.8l5.1 5.1 1.5-1.5-5-5.2zm-6.2 0c-2.6 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6 4.6 2.1 4.6 4.6-2 4.6-4.6 4.6z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".5"
                                                d="M1.816 15.556v.002c0 1.502.584 2.912 1.646 3.972s2.472 1.647 3.974 1.647a5.58 5.58 0 0 0 3.972-1.645l9.547-9.548c.769-.768 1.147-1.767 1.058-2.817-.079-.968-.548-1.927-1.319-2.698-1.594-1.592-4.068-1.711-5.517-.262l-7.916 7.915c-.881.881-.792 2.25.214 3.261.959.958 2.423 1.053 3.263.215l5.511-5.512c.28-.28.267-.722.053-.936l-.244-.244c-.191-.191-.567-.349-.957.04l-5.506 5.506c-.18.18-.635.127-.976-.214-.098-.097-.576-.613-.213-.973l7.915-7.917c.818-.817 2.267-.699 3.23.262.5.501.802 1.1.849 1.685.051.573-.156 1.111-.589 1.543l-9.547 9.549a3.97 3.97 0 0 1-2.829 1.171 3.975 3.975 0 0 1-2.83-1.173 3.973 3.973 0 0 1-1.172-2.828c0-1.071.415-2.076 1.172-2.83l7.209-7.211c.157-.157.264-.579.028-.814L11.5 4.36a.572.572 0 0 0-.834.018l-7.205 7.207a5.577 5.577 0 0 0-1.645 3.971z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".6"
                                                d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div
                                class="flex-1 overflow-auto"
                                style="background-color: #dad3cc"
                            >
                                <div class="py-2 px-3">
                                    <div class="flex justify-center mb-2">
                                        <div class="rounded py-2 px-4">
                                            <p class="text-sm uppercase">
                                                February 20, 2018
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex justify-center mb-4">
                                        <div
                                            class="rounded py-2 px-4"
                                            style="background-color: #fcf4cb"
                                        >
                                            <p class="text-xs">
                                                Messages to this chat and calls
                                                are now secured with end-to-end
                                                encryption.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input -->
                            <div
                                class="bg-grey-lighter px-4 py-4 flex items-center"
                            >
                                <div>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        width="24"
                                        height="24"
                                    >
                                        <path
                                            opacity=".45"
                                            fill="#263238"
                                            d="M9.153 11.603c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962zm-3.204 1.362c-.026-.307-.131 5.218 6.063 5.551 6.066-.25 6.066-5.551 6.066-5.551-6.078 1.416-12.129 0-12.129 0zm11.363 1.108s-.669 1.959-5.051 1.959c-3.505 0-5.388-1.164-5.607-1.959 0 0 5.912 1.055 10.658 0zM11.804 1.011C5.609 1.011.978 6.033.978 12.228s4.826 10.761 11.021 10.761S23.02 18.423 23.02 12.228c.001-6.195-5.021-11.217-11.216-11.217zM12 21.354c-5.273 0-9.381-3.886-9.381-9.159s3.942-9.548 9.215-9.548 9.548 4.275 9.548 9.548c-.001 5.272-4.109 9.159-9.382 9.159zm3.108-9.751c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962z"
                                        ></path>
                                    </svg>
                                </div>
                                <div class="flex-1 mx-4">
                                    <input
                                        v-model="message_data.content"
                                        class="w-full border rounded px-2 py-2"
                                        type="text"
                                    />
                                </div>
                                <div>
                                    <a
                                        @click="
                                            function_send_message(
                                                usePage().props.value
                                                    .user_selected.id
                                            )
                                        "
                                        href="#"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".45"
                                                d="M11.999 14.942c2.001 0 3.531-1.53 3.531-3.531V4.35c0-2.001-1.53-3.531-3.531-3.531S8.469 2.35 8.469 4.35v7.061c0 2.001 1.53 3.531 3.53 3.531zm6.238-3.53c0 3.531-2.942 6.002-6.237 6.002s-6.237-2.471-6.237-6.002H3.761c0 4.001 3.178 7.297 7.061 7.885v3.884h2.354v-3.884c3.884-.588 7.061-3.884 7.061-7.885h-2z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div v-else class="w-full border flex flex-col">
                            <!-- Header -->
                            <div
                                class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center"
                            >
                                <div class="flex items-center">
                                    <div>
                                        <img
                                            class="w-10 h-10 rounded-full"
                                            :src="
                                                usePage().props.value
                                                    .user_selected
                                                    .profile_photo_url
                                            "
                                        />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-grey-darkest">
                                            {{
                                                usePage().props.value
                                                    .user_selected.name
                                            }}
                                        </p>
                                        <p
                                            class="text-grey-darker text-xs mt-1"
                                        >
                                            Online
                                        </p>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".5"
                                                d="M15.9 14.3H15l-.3-.3c1-1.1 1.6-2.7 1.6-4.3 0-3.7-3-6.7-6.7-6.7S3 6 3 9.7s3 6.7 6.7 6.7c1.6 0 3.2-.6 4.3-1.6l.3.3v.8l5.1 5.1 1.5-1.5-5-5.2zm-6.2 0c-2.6 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6 4.6 2.1 4.6 4.6-2 4.6-4.6 4.6z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".5"
                                                d="M1.816 15.556v.002c0 1.502.584 2.912 1.646 3.972s2.472 1.647 3.974 1.647a5.58 5.58 0 0 0 3.972-1.645l9.547-9.548c.769-.768 1.147-1.767 1.058-2.817-.079-.968-.548-1.927-1.319-2.698-1.594-1.592-4.068-1.711-5.517-.262l-7.916 7.915c-.881.881-.792 2.25.214 3.261.959.958 2.423 1.053 3.263.215l5.511-5.512c.28-.28.267-.722.053-.936l-.244-.244c-.191-.191-.567-.349-.957.04l-5.506 5.506c-.18.18-.635.127-.976-.214-.098-.097-.576-.613-.213-.973l7.915-7.917c.818-.817 2.267-.699 3.23.262.5.501.802 1.1.849 1.685.051.573-.156 1.111-.589 1.543l-9.547 9.549a3.97 3.97 0 0 1-2.829 1.171 3.975 3.975 0 0 1-2.83-1.173 3.973 3.973 0 0 1-1.172-2.828c0-1.071.415-2.076 1.172-2.83l7.209-7.211c.157-.157.264-.579.028-.814L11.5 4.36a.572.572 0 0 0-.834.018l-7.205 7.207a5.577 5.577 0 0 0-1.645 3.971z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".6"
                                                d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div
                                class="flex-1 overflow-auto"
                                style="background-color: #dad3cc"
                            >
                                <div class="py-2 px-3">
                                    <div class="flex justify-center mb-2">
                                        <div class="rounded py-2 px-4">
                                            <p class="text-sm uppercase">
                                                February 20, 2018
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex justify-center mb-4">
                                        <div
                                            class="rounded py-2 px-4"
                                            style="background-color: #fcf4cb"
                                        >
                                            <p class="text-xs">
                                                Messages to this chat and calls
                                                are now secured with end-to-end
                                                encryption. Tap for more info.
                                            </p>
                                        </div>
                                    </div>
                                    <template
                                        v-for="(messages, key) in usePage()
                                            .props.value.conversation[0]
                                            .messages"
                                        :key="key"
                                    >
                                        <div
                                            class="flex mb-2"
                                            :class="
                                                messages.user_id ==
                                                usePage().props.value.user.id
                                                    ? 'justify-end'
                                                    : ''
                                            "
                                        >
                                            <div
                                                class="rounded py-2 px-3"
                                                style="
                                                    background-color: #f2f2f2;
                                                "
                                            >
                                                <p class="text-sm text-teal">
                                                    {{
                                                        messages.user.name ==
                                                        usePage().props.value
                                                            .user.name
                                                            ? "You"
                                                            : messages.user.name
                                                    }}
                                                </p>
                                                <p class="text-sm mt-1">
                                                    {{ messages.content }}
                                                </p>
                                                <p
                                                    class="text-right text-xs text-grey-dark mt-1"
                                                >
                                                    {{
                                                        date_conversion_from_now(
                                                            messages.created_at
                                                        )
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Input -->
                            <div
                                class="bg-grey-lighter px-4 py-4 flex items-center"
                            >
                                <div>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        width="24"
                                        height="24"
                                    >
                                        <path
                                            opacity=".45"
                                            fill="#263238"
                                            d="M9.153 11.603c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962zm-3.204 1.362c-.026-.307-.131 5.218 6.063 5.551 6.066-.25 6.066-5.551 6.066-5.551-6.078 1.416-12.129 0-12.129 0zm11.363 1.108s-.669 1.959-5.051 1.959c-3.505 0-5.388-1.164-5.607-1.959 0 0 5.912 1.055 10.658 0zM11.804 1.011C5.609 1.011.978 6.033.978 12.228s4.826 10.761 11.021 10.761S23.02 18.423 23.02 12.228c.001-6.195-5.021-11.217-11.216-11.217zM12 21.354c-5.273 0-9.381-3.886-9.381-9.159s3.942-9.548 9.215-9.548 9.548 4.275 9.548 9.548c-.001 5.272-4.109 9.159-9.382 9.159zm3.108-9.751c.795 0 1.439-.879 1.439-1.962s-.644-1.962-1.439-1.962-1.439.879-1.439 1.962.644 1.962 1.439 1.962z"
                                        ></path>
                                    </svg>
                                </div>
                                <div class="flex-1 mx-4">
                                    <input
                                        v-model="message_data.content"
                                        class="w-full border rounded px-2 py-2"
                                        type="text"
                                    />
                                </div>
                                <div>
                                    <a
                                        @click="function_send_message()"
                                        href="#"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            width="24"
                                            height="24"
                                        >
                                            <path
                                                fill="#263238"
                                                fill-opacity=".45"
                                                d="M11.999 14.942c2.001 0 3.531-1.53 3.531-3.531V4.35c0-2.001-1.53-3.531-3.531-3.531S8.469 2.35 8.469 4.35v7.061c0 2.001 1.53 3.531 3.53 3.531zm6.238-3.53c0 3.531-2.942 6.002-6.237 6.002s-6.237-2.471-6.237-6.002H3.761c0 4.001 3.178 7.297 7.061 7.885v3.884h2.354v-3.884c3.884-.588 7.061-3.884 7.061-7.885h-2z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
