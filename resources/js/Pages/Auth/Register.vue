<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    date_of_birth:'',
    religion:'',
    civil_status:'',
    gender:'',
    college:'',
    course:'',
    adress:'',
    phone_number:'',
    current_work:'',
    year_graduated:'',
    motto:'',
    nickname:'',

});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-[80rem] mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div class="grid grid-cols-6 gap-4">
                        <div class="mt-4 col-span-3">
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="password_confirmation" value="Confirm Password" />
                            <TextInput
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="date_of_birth" value="Date of Birth" />
                            <TextInput
                                id="date_of_birth"
                                v-model="form.date_of_birth"
                                type="date"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.date_of_birth" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="religion" value="Religion" />
                            <TextInput
                                id="religion"
                                v-model="form.religion"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.religion" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="civil_status" value="Civil Status" />
                            <select
                                id="civil_status"
                                v-model="form.civil_status"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                            >
                                <option value="1">Single</option>
                                <option value="2">Married</option>
                                <option value="3">Annulled</option>
                                <option value="4">Widowed</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.civil_status" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="gender" value="Gender" />
                            <select
                                id="gender"
                                v-model="form.gender"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                            >
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.gender" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="college" value="College" />
                            <select
                                id="college"
                                v-model="form.college"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                            >
                                <option value="1">College of Engineering</option>
                                <option value="1">College of Agriculture</option>
                                <option value="1">College of Arts and Sciences</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.college_error" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="course" value="Course" />
                            <select
                                id="course"
                                v-model="form.course"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                            >
                                <option value="1">Batchelor of Science in Information Technology</option>
                                <option value="1">Batchelor of Science in Civil Engineering</option>
                                <option value="1">Batchelor of Science in Mechanichal Engineering</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.course" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="address" value="Address" />
                            <TextInput
                                id="address"
                                v-model="form.address"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="phone_number" value="Phone / Mobile #" />
                            <TextInput
                                id="phone_number"
                                v-model="form.phone_number"
                                type="number"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.phone_number" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="current_work" value="Current work" />
                            <TextInput
                                id="current_work"
                                v-model="form.current_work"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.current_work" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="year_graduated" value="Year Graduated" />
                            <TextInput
                                id="year_graduated"
                                v-model="form.year_graduated"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.year_graduated" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="motto" value="Motto" />
                            <TextInput
                                id="motto"
                                v-model="form.motto"
                                type="text"
                                class="mt-1 block w-full border break-word"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.motto" />
                        </div>

                        <div class="mt-4 col-span-3">
                            <InputLabel for="nickname" value="Nickname" />
                            <TextInput
                                id="nickname"
                                v-model="form.nickname"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.nickname" />
                        </div>

                </div>
                
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                            <div class="ml-2">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Already registered?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
    <!-- <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        
    </AuthenticationCard> -->
</template>
