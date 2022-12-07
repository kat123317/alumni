<script setup>
import { onMounted, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: "PUT",
    name: props.user.name,
    email: props.user.email,
    photo: null,
    motto: props.user.details.motto,
    address: props.user.details.address,
    course_id: props.user.details.course_id,
    civil_status: props.user.details.civil_status,
    current_work: props.user.details.current_work,
    date_of_birth: props.user.details.date_of_birth,
    gender: props.user.details.gender,
    nickname: props.user.details.nickname,
    phone_number: props.user.details.phone_number,
    religion: props.user.details.religion,
    year_graduated: props.user.details.year_graduated,
    region_of_origin: props.user.details.region_of_origin,
    province: props.user.details.province,
    degree_graduated: props.user.details.degree_graduated,
    honors_awards: [],
    professional_examination: props.user.details.professional_examination,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);
const year_graduated = ref("");
const tmp_achievement = ref("");
const fillAchive = ref(false);
onMounted(() => {
    year_graduated.value = function_date();
    function_achievement();
});

const function_achievement = () => {
    for (
        let index = 0;
        index < props.user.details.honors_awards.length;
        index++
    ) {
        form.honors_awards.push(props.user.details.honors_awards[index]);
    }
};

const function_date = (startYear) => {
    var currentYear = new Date().getFullYear(),
        years = [];
    startYear = 1900;
    while (startYear <= currentYear) {
        years.push(startYear++);
    }
    return years;
};

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    Inertia.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const function_add_honors = () => {
    if (tmp_achievement.value == "") {
        fillAchive.value = true;
        setTimeout(() => {
            fillAchive.value = false;
        }, 4000);
    } else {
        form.honors_awards.push(tmp_achievement.value);
        tmp_achievement.value = "";
    }
};

const remove_achievement = (key) => {
    const temp_achievement = ref(form.honors_awards.splice(key, 1));
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title> Profile Information </template>

        <template #description>
            Update your account's profile information.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="col-span-6 sm:col-span-4"
            >
                <h2 class="text-[3vmin]">General Information</h2>
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                />

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img
                        :src="user.profile_photo_url"
                        :alt="user.name"
                        class="rounded-full h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    />
                </div>

                <SecondaryButton
                    class="mt-2 mr-2"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Nickname -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="nickname" value="Nickname" />
                <TextInput
                    id="nickname"
                    v-model="form.nickname"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="nickname"
                />
                <InputError :message="form.errors.motto" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div
                    v-if="
                        $page.props.jetstream.hasEmailVerification &&
                        user.email_verified_at === null
                    "
                >
                    <p class="text-sm mt-2">
                        Your email address is unverified.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-gray-600 hover:text-gray-900"
                            @click.prevent="sendEmailVerification"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div
                        v-show="verificationLinkSent"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        A new verification link has been sent to your email
                        address.
                    </div>
                </div>
            </div>

            <!-- Address -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="address" value="Permanent Address" />
                <TextInput
                    id="address"
                    v-model="form.address"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="motto"
                />
                <InputError :message="form.errors.address" class="mt-2" />
            </div>

            <!-- Phone number -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel
                    for="phone_number"
                    value="Telephone or Contact Number(s)"
                />
                <TextInput
                    id="phone_number"
                    v-model="form.phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="phone_number"
                />
                <InputError :message="form.errors.phone_number" class="mt-2" />
            </div>

            <!-- Civil Status -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="civil_status" value="Civil_status" />
                <select
                    class="mt-1 block w-full"
                    v-model="form.civil_status"
                    autocomplete="civil_status"
                    name="civil_status"
                    id="civil_status"
                >
                    <option value="1">Single</option>
                    <option value="2">Married</option>
                    <option value="3">Annulled</option>
                    <option value="4">Widdowed</option>
                    <option value="5">Single Parent</option>
                </select>
                <InputError :message="form.errors.civil_status" class="mt-2" />
            </div>

            <!-- Gender -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="gender" value="Sex" />
                <select
                    id="gender"
                    v-model="form.gender"
                    class="mt-1 block w-full"
                    autocomplete="gender"
                >
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                <InputError :message="form.errors.gender" class="mt-2" />
            </div>

            <!-- Date of Birth -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="date_of_birth" value="Date_of_birth" />
                <TextInput
                    id="date_of_birth"
                    v-model="form.date_of_birth"
                    type="date"
                    class="mt-1 block w-full"
                    autocomplete="date_of_birth"
                />
                <InputError :message="form.errors.date_of_birth" class="mt-2" />
            </div>

            <!-- Religion -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="religion" value="Religion" />
                <TextInput
                    id="religion"
                    v-model="form.religion"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="religion"
                />
                <InputError :message="form.errors.motto" class="mt-2" />
            </div>

            <!-- Region of Origin -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="region_of_origin" value="Region of Origin" />
                <TextInput
                    id="region_of_origin"
                    v-model="form.region_of_origin"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="region_of_origin"
                />
                <InputError
                    :message="form.errors.region_of_origin"
                    class="mt-2"
                />
            </div>

            <!-- Province -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="province" value="Province" />
                <TextInput
                    id="province"
                    v-model="form.province"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="province"
                />
                <InputError :message="form.errors.province" class="mt-2" />
            </div>

            <!-- Degree Graduated -->
            <div class="col-span-6 sm:col-span-4">
                <h2 class="text-[3vmin]">Educational Background</h2>

                <InputLabel for="degree_graduated" value="Degree Graduated" />
                <select
                    id="degree_graduated"
                    v-model="form.degree_graduated"
                    class="mt-1 block w-full"
                    autocomplete="degree_graduated"
                >
                    <option value="1">Undergraduate</option>
                    <option value="2">Masters</option>
                    <option value="3">Doctors</option>
                    <option value="4">Certification</option>
                </select>
                <InputError
                    :message="form.errors.degree_graduated"
                    class="mt-2"
                />
            </div>

            <!-- Year Graduated -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="year_graduated" value="Year graduated" />
                <select
                    id="year_graduated"
                    v-model="form.year_graduated"
                    class="mt-1 block w-full"
                    autocomplete="year_graduated"
                >
                    <template
                        v-for="(year_graduated, key) in year_graduated"
                        :key="key"
                    >
                        <option :value="year_graduated">
                            {{ year_graduated }}
                        </option>
                    </template>
                </select>
                <InputError
                    :message="form.errors.year_graduated"
                    class="mt-2"
                />
            </div>

            <!-- Honors and Awards Received -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel
                    for="honors_awards"
                    value="Honors and Awards Received"
                />
                <TextInput
                    id="honors_awards"
                    v-model="tmp_achievement"
                    type="text"
                    class="mt-1 mr-2 mb-2 w-3/4"
                />

                <!-- <a
                    @click="function_add_honors()"
                    class="bg-green-500 ... w-1/4 float-right text-center mt-3 rounded-md cursor-pointer"
                    :disabled="form.processing"
                    title="Add"
                >
                    ADD
                </a> -->
                <a
                    class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-yellow-400 uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition cursor-pointer"
                    :class="{ 'opacity-25': form.processing }"
                    @click="function_add_honors()"
                >
                    Add </a
                ><br />
                <template v-for="(honor, key) in form.honors_awards" :key="key">
                    <span class="text-sm ml-3"
                        >{{ key + 1 + ". " + honor }}
                        <!-- <a
                            @click="remove_achievement(key)"
                            class="bg-red-500 ... w-1/4 mt-3 rounded-md"
                            :disabled="form.processing"
                            title="remove"
                        >
                            remove
                        </a> -->
                        <a
                            @click="remove_achievement(key)"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition bg-red-500 cursor-pointer text-white"
                            >remove</a
                        >
                    </span>
                </template>

                <InputError :message="form.errors.honors_awards" class="mt-2" />
                <br />
                <small v-if="fillAchive" class="text-red-500 w-screen"
                    >Please fill Achievements first</small
                >
            </div>

            <!-- Professional Examination Passed -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel
                    for="professional_examination"
                    value="Professional Examination Passed"
                />
                <TextInput
                    id="professional_examination"
                    v-model="form.professional_examination"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="professional_examination"
                />
                <InputError
                    :message="form.errors.professional_examination"
                    class="mt-2"
                />
            </div>

            <!-- Motto -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="motto" value="Motto" />
                <TextInput
                    id="motto"
                    v-model="form.motto"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="motto"
                />
                <InputError :message="form.errors.motto" class="mt-2" />
            </div>

            <!-- Current Work -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="current_work" value="Current_work" />
                <TextInput
                    id="current_work"
                    v-model="form.current_work"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="current_work"
                />
                <InputError :message="form.errors.current_work" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
