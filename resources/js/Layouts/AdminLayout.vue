<script setup>
import { usePage, Link } from "@inertiajs/inertia-vue3";

defineProps({
    alertOn: {
        type: Boolean,
        default: false,
    },
    alertOnUpdate: {
        type: Boolean,
        default: false,
    },
    alertOnDelete: {
        type: Boolean,
        default: false,
    },
    alertOnError: {
        type: Boolean,
        default: false,
    },
    alertOnMessage: {
        type: String,
        default: "",
    },
});
</script>
<template>
    <div class="bg-cmu">
        <header class="text-gray-600 body-font bg-green-700">
            <div
                class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center"
            >
                <a
                    class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0"
                >
                    <svg
                        class="w-6 h-6 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                        ></path>
                    </svg>
                    <span class="ml-3 text-white text-xl">ADMINISTRATOR</span>
                </a>
                <nav
                    class="md:ml-auto flex flex-wrap items-center text-base justify-center"
                >
                    <button class="mr-5 text-white hover:text-gray-200">
                        <Link :href="route('administrator.announcement')">
                            Announcements
                        </Link>
                    </button>
                    <button class="mr-5 text-white hover:text-gray-200">
                        <Link :href="route('administrator.yearbook')">
                            Year Book
                        </Link>
                    </button>
                    <button class="mr-5 text-white hover:text-gray-200">
                        <Link :href="route('administrator.alumni')">
                            Alumni
                        </Link>
                    </button>
                    <button
                        v-if="usePage().props.value.user.user_type == 'admin'"
                        class="mr-5 text-white hover:text-gray-200"
                    >
                        <Link :href="route('administrator.user_management')">
                            User Management
                        </Link>
                    </button>
                    <button class="mr-5 text-white hover:text-gray-200">
                        <Link :href="route('administrator.department')">
                            College
                        </Link>
                    </button>
                    <button class="mr-5 text-white hover:text-gray-200">
                        <Link :href="route('administrator.course')">
                            Program
                        </Link>
                    </button>
                    <button class="mr-5 text-white hover:text-gray-200">
                        <Link :href="route('administrator.survey')">
                            Survey
                        </Link>
                    </button>
                    <button class="mr-5 text-white hover:text-gray-200">
                        <Link :href="route('administrator.event')">
                            Events
                        </Link>
                    </button>
                    <button class="mr-8 text-white hover:text-gray-200">
                        <Link :href="route('administrator.notification')">
                            Incoming Requests
                            <span
                                class="w-10 h-4 ml-[-16px] mt-[-16px] text-[1.5vmin] absolute custom_notification_count"
                            >
                                <p
                                    class="bg-orange-600 rounded-lg"
                                    v-if="
                                        usePage().props.value.notifications.data
                                            .length != 0
                                    "
                                >
                                    {{
                                        usePage().props.value.notifications.data
                                            .length
                                    }}
                                </p>
                            </span>
                        </Link>
                    </button>
                </nav>
                <a
                    :href="route('dashboard')"
                    class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0"
                    >Back to home
                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        class="w-4 h-4 ml-1"
                        viewBox="0 0 24 24"
                    >
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </header>
        <section class="text-gray-600 body-font relative">
            <div
                v-if="alertOn"
                class="bg-green-100 alertanim text-center py-4 lg:px-4"
            >
                <div
                    class="p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span
                        class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                        >Success</span
                    >
                    <span class="font-semibold mr-2 text-left flex-auto">{{
                        alertOnMessage
                    }}</span>
                    <svg
                        class="fill-current opacity-75 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                        />
                    </svg>
                </div>
            </div>
            <div
                v-if="alertOnUpdate"
                class="bg-blue-100 alertanim text-center py-4 lg:px-4"
            >
                <div
                    class="p-2 bg-blue-800 items-center text-blue-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span
                        class="flex rounded-full bg-blue-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                        >Success</span
                    >
                    <span class="font-semibold mr-2 text-left flex-auto">{{
                        alertOnMessage
                    }}</span>
                    <svg
                        class="fill-current opacity-75 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                        />
                    </svg>
                </div>
            </div>
            <div
                v-if="alertOnDelete"
                class="bg-red-100 alertanim text-center py-4 lg:px-4"
            >
                <div
                    class="p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span
                        class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                        >Success</span
                    >
                    <span class="font-semibold mr-2 text-left flex-auto">{{
                        alertOnMessage
                    }}</span>
                    <svg
                        class="fill-current opacity-75 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                        />
                    </svg>
                </div>
            </div>
            <div
                v-if="alertOnError"
                class="bg-gray-100 text-center py-4 lg:px-4"
            >
                <div
                    class="p-2 bg-gray-800 items-center text-gray-100 alertanim leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert"
                >
                    <span
                        class="flex rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold mr-3"
                        >Notice</span
                    >
                    <span class="font-semibold mr-2 text-left flex-auto">{{
                        alertOnMessage
                    }}</span>
                    <svg
                        class="fill-current opacity-75 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
                        />
                    </svg>
                </div>
            </div>
            <slot />
        </section>
    </div>
</template>

<style scoped>
.bg-cmu {
}
.bg-cmu::after {
    content: "";
    background: url("https://th.bing.com/th/id/R.f2794a18807eeceb02baa5f575b09553?rik=XGySs8XRrUO18w&riu=http%3a%2f%2fumap.org%2fwp-content%2fuploads%2f2018%2f09%2fCMU_LOGO_2015_transparent_1-300x300.png&ehk=wMcHjqqG%2bIHf4L1fwHJZnx914Lm01VQTU8oalYWhSDk%3d&risl=&pid=ImgRaw&r=0")
        no-repeat center center;
    background-size: cover;
    opacity: 0.02;
    top: 0;
    left: 23%;
    bottom: 0;
    right: 0;
    position: absolute;
    z-index: -1;
    /* -webkit-filter: grayscale(1); 
      filter: grayscale(1); */
}

@media only screen and (max-width: 600px) {
    .custom_notification_count {
        font-size: 2.5vmin;
        width: 1.5rem;
        height: 1rem;
        margin-top: -6px;
        margin-left: 0px;
    }
}
</style>
