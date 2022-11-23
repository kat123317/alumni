<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { computed, onMounted, ref, watch } from "vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const modal_expire = ref(false);
const button_expire = ref(false);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const expire_data = useForm({
    code: "",
    new_due: "",
    new_key: "",
});

watch(() => {
    if (
        usePage().props.value.errors.custom ==
        "Sorry! The system has been expired"
    ) {
        button_expire.value = true;
    }
});
// const x = ref(0);
// watch(x.value, (newX) => {
//     console.log(`x is ${newX}`);
// });

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const close_update_modal = () => {
    modal_expire.value = !modal_expire.value;
};

const update_expiry = () => {
    if (expire_data.new_due == "" || expire_data.new_key == "") {
        alert("Empty data, This is not allowed!");
    } else {
        expire_data.post(route("update_expire"), {
            preserveScroll: true,
            onSuccess: () => {
                expire_data.reset();
                alert("Updated the due date :)");
                modal_expire.value = !modal_expire.value;
            },
        });
    }
};
</script>

<template>
    <Head title="Log in" />

    <!-- <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <InputError class="mt-2 mb-4" :message="form.errors.custom" />
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                    autocomplete="current-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900">
                Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard> -->
    <div>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div
                class="flex mt-[10vmin] w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl"
            >
                <div
                    class="hidden bg-cover lg:block lg:w-1/2"
                    style="
                        background-image: url('https://devops.cmu.edu.ph/formlinks/assets/dist/assets/img/backgrounds/main_gate.jpg');
                    "
                ></div>

                <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
                    <div class="flex justify-center mb-2">
                        <AuthenticationCardLogo />
                    </div>
                    <h2
                        class="text-2xl font-semibold text-center text-gray-700 dark:text-white"
                    >
                        ALUMNI PORTAL
                    </h2>

                    <p
                        class="text-xl text-center text-gray-600 dark:text-gray-200"
                    >
                        Welcome back!
                    </p>

                    <div class="mt-4">
                        <label
                            class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200"
                            for="LoggingEmailAddress"
                            >Email Address</label
                        >
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            autofocus
                            class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <div class="flex justify-between">
                            <label
                                class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200"
                                for="loggingPassword"
                                >Password</label
                            >
                            <a
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-xs text-gray-500 dark:text-gray-300 hover:underline"
                                >Forget Password?</a
                            >
                        </div>

                        <input
                            id="password"
                            v-model="form.password"
                            class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300"
                            type="password"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                        <InputError
                            class="mt-2 mb-4"
                            :message="form.errors.custom"
                        />
                    </div>
                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox
                                v-model:checked="form.remember"
                                name="remember"
                            />
                            <span class="ml-2 text-sm text-gray-600"
                                >Remember me</span
                            >
                        </label>
                    </div>
                    <div class="mt-8">
                        <button
                            :disabled="form.processing"
                            class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                        >
                            Login
                        </button>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span
                            class="w-1/5 border-b dark:border-gray-600 md:w-1/4"
                        ></span>

                        <a
                            :href="route('register')"
                            class="text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline"
                            >or sign up</a
                        >

                        <span
                            class="w-1/5 border-b dark:border-gray-600 md:w-1/4"
                        ></span>
                    </div>
                    <div
                        class="flex items-center justify-between mt-4"
                        v-if="button_expire"
                    >
                        <span
                            class="w-1/5 border-b dark:border-gray-600 md:w-1/4"
                        ></span>

                        <a
                            @click="close_update_modal()"
                            class="text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline"
                            >Extend</a
                        >

                        <span
                            class="w-1/5 border-b dark:border-gray-600 md:w-1/4"
                        ></span>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div v-if="modal_expire" class=" ">
        <div
            id="popup-modal"
            tabindex="-1"
            class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
        >
            <div
                class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto"
            >
                <div class="relative bg-white rounded-lg shadow">
                    <div class="p-2 w-full">Enter New</div>

                    <div class="p-2 w-full">
                        <div class="relative">
                            <label
                                for="name"
                                class="leading-7 text-sm text-gray-600"
                                >Secret code</label
                            >
                            <input
                                v-model="expire_data.code"
                                type="password"
                                id="name"
                                name="name"
                                placeholder="Enter email"
                                required
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8"
                            />
                            <span class="text-red-500">{{
                                usePage().props.value.errors.expire_error
                            }}</span>
                        </div>
                        <div class="relative">
                            <label
                                for="name"
                                class="leading-7 text-sm text-gray-600"
                                >New Due</label
                            >
                            <input
                                v-model="expire_data.new_due"
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Enter new due"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8"
                            />
                        </div>
                        <div class="relative">
                            <label
                                for="name"
                                class="leading-7 text-sm text-gray-600"
                                >New Key</label
                            >
                            <input
                                v-model="expire_data.new_key"
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Enter new key"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8"
                            />
                        </div>
                    </div>
                </div>

                <button
                    @click="close_update_modal()"
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
                        Are you sure you want to update expiry?
                    </h3>
                    <button
                        @click="update_expiry()"
                        data-modal-toggle="popup-modal"
                        type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                    >
                        Yes, I'm sure
                    </button>
                    <button
                        @click="close_update_modal()"
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
</template>
