<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { computed, onMounted, ref, reactive } from "vue";
import moment from "moment";
import {
    regions,
    provinces,
    cities,
    barangays,
} from "select-philippines-address";
//https://github.com/isaacdarcilla/select-philippines-address

const props = defineProps(["colleges", "courses"]);

const form = useForm({
    fname: "",
    mname: "",
    lname: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
    date_of_birth: "",
    religion: "",
    civil_status: "",
    gender: "",
    college_id: "",
    course_id: "",
    address: "",
    phone_number: "",
    telephone_number: "",
    current_work: "",
    year_graduated: "",
    honors_awards: [],
    motto: "",
    nickname: "",
    region_of_origin: "",
    province: "",
    degree_graduated: "",
    professional_examination: "",
    photos:[]
});

const year_graduated = ref("");
const tmp_achievement = ref("");

const aggreement = ref(false);
const fillAchive = ref(false);

const alertOn = ref(false)

const post_images = ref([]);

const address = reactive({
    region: '',
    province: '',
    city: '',
    barangay: ''
})

const list_address = reactive({
    regions: [],
    provinces: [],
    cities: [],
    barangays: []
})

onMounted(() => {
    year_graduated.value = function_date();
    regions().then((region) => list_address.regions = region);
});

const function_date = (startYear) => {
    var currentYear = new Date().getFullYear(),
        years = [];
    startYear = 1900;
    while (startYear <= currentYear) {
        years.push(startYear++);
    }
    return years;
};

const shown_courses = computed(() => {
    let tmp_college = props.colleges.find((col) => col.id == form.college_id);
    if (tmp_college == null) {
        return [];
    } else {
        return tmp_college.courses;
    }
});

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

const function_aggree = () => {
    aggreement.value = !aggreement.value
}

const submit = () => {
    form.post(route("register_user"), {
        onSuccess: () => {
            alertOn.value = true;
        },
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

const confirm_button = () => {
    alertOn.value = false;
    window.location.href = route('welcome');
}

const listProvinces = () => {
    address.province = '';
    provinces(address.region).then((province) => list_address.provinces = province);
    listCities()
    fillAddress()
    form.region_of_origin = list_address.regions.find(region => region.region_code == address.region)?.region_name;
}

const listCities = () => {
    address.city = '';
    cities(address.province).then((cities) => list_address.cities = cities);
    listBarangay()
    fillAddress()
    form.province = list_address.provinces.find(province => province.province_code == address.province)?.province_name;
}

const listBarangay = () => {
    address.barangay = '';
    barangays(address.city).then((barangays) => list_address.barangays = barangays);
    fillAddress()
}

const fillAddress = () => {
    let region = list_address.regions.find(region => region.region_code == address.region)?.region_name;
    let province = list_address.provinces.find(province => province.province_code == address.province)?.province_name;
    let city = list_address.cities.find(city => city.city_code == address.city)?.city_name;
    let barangay = list_address.barangays.find(barangay => barangay.brgy_code == address.barangay)?.brgy_name;
    form.address = region +
        (province != undefined ? (', ' + province) : '') +
        (city != undefined ? (', ' + city) : '') +
        (barangay != undefined ? (', ' + barangay) : '')
}


const openFile = () => {
    let hidden = document.getElementById("post_image");
    hidden.click();
    hidden.onchange = (e) => {
        if (post_images.value.length + e.target.files.length > 3) {
            alert("Only 3 images can be selected");
            return;
        } else {
            for (let index = 0; index < e.target.files.length; index++) {
                post_images.value.push(
                    window.URL.createObjectURL(e.target.files[index])
                );
                form.photos.push(e.target.files[index]);
            }
        }
    };
};

const remove_image = (key) => {
    post_images.value.splice(key, 1);
    form.photos.splice(key, 1);
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-2/3 grid grid-cols-4 gap-4">
            <AuthenticationCardLogo />
        </div>

        <div class="w-full sm:max-w-[80rem] mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <div v-if="alertOn" id="defaultModal" tabindex="-1" aria-hidden="true"
                class="fixed ml-[30%] mt-60 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-lg border">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <span
                                class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                            <span class="font-semibold mr-2 text-left flex-auto">You are now successfully registered</span>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <p class="text-base leading-relaxed text-gray-500">
                                {{ usePage().props.value.message_notification??'' }}
                            </p>
                        </div>
                        <!-- Modal footer -->
                        <div @click="confirm_button()"
                            class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button data-modal-hide="defaultModal" type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
            <form @submit.prevent="submit">
                <h1 class="text-center text-[2.5vmin] font-bold">REGISTRATION</h1>
                <div class="grid grid-cols-12 gap-4">
                    
                    <div class="mt-4 col-span-3 text-[2vmin]">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                            <InputLabel for="fname" value="First Name" />
                        </div>
                        <TextInput id="fname" v-model="form.fname" type="text" class="mt-1 block w-full" required autofocus
                            autocomplete="fname" />
                        <InputError class="mt-2" :message="form.errors.fname" />
                    </div>

                    <div class="mt-4 col-span-3 text-[2vmin]">
                        <InputLabel for="mname" value="Middle Name" />
                        <TextInput id="mname" v-model="form.mname" type="text" class="mt-3 block w-full" autofocus
                            autocomplete="mname" />
                    </div>

                    <div class="mt-4 col-span-3 text-[2vmin]">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                            <InputLabel for="lname" value="Last Name" />
                        </div>
                        <TextInput id="lname" v-model="form.lname" type="text" class="mt-1 block w-full" required autofocus
                            autocomplete="lname" />
                        <InputError class="mt-2" :message="form.errors.lname" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="email" value="Email" />
                        </div>
                        <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="password" value="Password" />
                        </div>
                        <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                            autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        </div>
                        <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                            class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="region" value="Region" />
                        </div>
                        <select v-model="address.region" @change="listProvinces()"
                            class="mt-1 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>Select Region</option>
                            <template v-for="region in list_address.regions">
                                <option :value="region.region_code">{{ region.region_name }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="province" value="Province" />
                        </div>
                        <select v-model="address.province" @change="listCities()"
                            class="mt-1 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>Select Province</option>
                            <template v-for="province in list_address.provinces">
                                <option :value="province.province_code">{{ province.province_name }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="city" value="City" />
                        </div>
                        <select v-model="address.city" @change="listBarangay()"
                            class="mt-1 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>Select City</option>
                            <template v-for="city in list_address.cities">
                                <option :value="city.city_code">{{ city.city_name }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="barangay" value="Barangay" />
                        </div>
                        <select v-model="address.barangay" @change="fillAddress()"
                            class="mt-1 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>Select Barangay</option>
                            <template v-for="barangay in list_address.barangays">
                                <option :value="barangay.brgy_code">{{ barangay.brgy_name }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="mt-4 col-span-12 hidden">
                        <InputLabel for="address" value="Permanent Address:" />
                        <TextInput id="address" readonly v-model="form.address" type="text" class="mt-3 block w-full"
                            required />
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="phone_number" value="Mobile Number:" />
                        <TextInput id="phone_number" v-model.number="form.phone_number" type="text"
                            class="mt-3 block w-full"  />
                        <InputError class="mt-2" :message="form.errors.phone_number" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="telephone_number" value="Telephone Number:" />
                        <TextInput id="telephone_number" v-model.number="form.telephone_number" type="text"
                            class="mt-3 block w-full"  />
                        <InputError class="mt-2" :message="form.errors.telephone_number" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="civil_status" value="Civil Status" />
                        <select id="civil_status" v-model="form.civil_status"
                            class="mt-1 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="1">Single</option>
                            <option value="2">Married</option>
                            <option value="3">Annulled</option>
                            <option value="4">Widow or Widower</option>
                            <option value="5">Single Parent</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.civil_status" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="gender" value="Sex" />
                        <select id="gender" v-model="form.gender"
                            class="mt-1 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Prefer not to say</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.gender" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="date_of_birth" value="Date of Birth" />
                        <TextInput id="date_of_birth" v-model="form.date_of_birth" type="date" class="mt-1 block w-full"
                             />
                        <InputError class="mt-2" :message="form.errors.date_of_birth" />
                    </div>

                    <div class="mt-4 col-span-3 hidden">
                        <InputLabel for="region_of_origin" value="Region of Origin" />
                        <TextInput id="region_of_origin" v-model="form.region_of_origin" type="text"
                            class="mt-1 block w-full" required />
                        <InputError class="mt-2" :message="form.errors.region_of_origin" />
                    </div>

                    <div class="mt-4 col-span-3 hidden">
                        <InputLabel for="province" value="Province" />
                        <TextInput id="province" v-model="form.province" type="text" class="mt-1 block w-full" required />
                        <InputError class="mt-2" :message="form.errors.province" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="religion" value="Religion" />
                        <TextInput id="religion" v-model="form.religion" type="text" class="mt-1 block w-full"  />
                        <InputError class="mt-2" :message="form.errors.religion" />
                    </div>
                </div>
                <h1 class="text-center text-[2.5vmin] mt-6 font-bold">
                    EDUCATIONAL BACKGROUND
                </h1>

                <div class="grid grid-cols-6 gap-4">
                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="degree_graduated" value="Degree Graduated" />
                        </div>
                        <select id="degree_graduated" v-model="form.degree_graduated"
                            class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>
                                Select Degree Graduated
                            </option>
                            <option value="1">Bachelor's degree</option>
                            <option value="2">Masters</option>
                            <option value="3">Doctors</option>
                            <option value="4">Certification</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.degree_graduated" />
                    </div>
                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="college_id" value="College" />
                        </div>
                        <select id="college_id" v-model="form.college_id"
                            class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>Select College</option>
                            <template v-for="college in colleges">
                                <option :value="college.id">
                                    {{ college.name }}
                                </option>
                            </template>
                        </select>
                        <InputError class="mt-2" :message="form.errors.college_id" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="course_id" value="Program" />
                        </div>
                        <select id="course_id" v-model="form.course_id"
                            class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>Select Program</option>
                            <template v-for="course in shown_courses">
                                <option :value="course.id">
                                    {{ course.name }}
                                </option>
                            </template>
                        </select>
                        <InputError class="mt-2" :message="form.errors.course_id" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1">*</p>
                        <InputLabel for="year_graduated" value="Year Graduated" />
                        </div>
                        <select id="year_graduated" v-model="form.year_graduated"
                            class="border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" disabled>
                                Select Year Graduated
                            </option>

                            <template v-for="(year_graduated, key) in year_graduated" :key="key">
                                <option :value="year_graduated">
                                    {{ year_graduated }}
                                </option>
                            </template>
                        </select>
                        <InputError class="mt-2" :message="form.errors.year_graduated" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <div class="block">
                            <InputLabel for="honors_awards" value="Honors and Awards Received" />
                            <TextInput id="honors_awards" v-model="tmp_achievement" type="text"
                                class="mt-1 mr-2 mb-2 w-3/4" />
                            <a @click="function_add_honors()" title="Add"
                                class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-yellow-400 uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition cursor-pointer">
                                ADD
                            </a>
                        </div>
                        <template v-for="(honor, key) in form.honors_awards" :key="key">
                            <span class="text-sm  ml-3">{{ key + 1 + ". " + honor }}
                                <a @click="remove_achievement(key)" title="remove"
                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition bg-red-500 cursor-pointer text-white">
                                    remove
                                </a>


                            </span>
                        </template>

                        <InputError class="mt-2" :message="form.errors.honors_awards" />
                        <br>
                        <small v-if="fillAchive" class="text-red-500 w-screen">Please fill Achievements first</small>
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="professional_examination" value="Professional Examination Passed" />
                        <TextInput id="professional_examination" v-model="form.professional_examination" type="text"
                            class="mt-1 block w-full"  />
                        <InputError class="mt-2" :message="form.errors.professional_examination" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="current_work" value="Current work" />
                        <TextInput id="current_work" v-model="form.current_work" type="text" class="mt-1 block w-full"
                             />
                        <InputError class="mt-2" :message="form.errors.current_work" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="motto" value="Motto" />
                        <TextInput id="motto" v-model="form.motto" type="text" class="mt-1 block w-full border break-word"
                             />
                        <InputError class="mt-2" :message="form.errors.motto" />
                    </div>

                    <div class="mt-4 col-span-3">
                        <InputLabel for="nickname" value="Nickname" />
                        <TextInput id="nickname" v-model="form.nickname" type="text" class="mt-1 block w-full"  />
                        <InputError class="mt-2" :message="form.errors.nickname" />
                    </div>
                    <div class="col-span-3">
                        <div class="flex">
                            <p class="text-red-600 mr-1 mt-6">*</p>
                            <InputLabel class="mt-6" for="nickname" value="Upload ID for verification" />
                        </div>
                        <div class="w-full h-10 flex justify-between ">
                            <div class="flex">
                                <a @click="openFile()" class="flex h-full items-center cursor-pointer">
                                    <svg class="h-12 text-green-500 stroke-current" xmlns="http://www.w3.org/2000/svg"
                                        width="27" height="27" viewBox="0 0 24 24" fill="none" stroke="#b0b0b0"
                                        stroke-width="2" stroke-linecap="square" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <path d="M20.4 14.5L16 10 4 20" />
                                    </svg>
                                    <span class="text-xs lg:text-md mx-2 font-semibold text-gray-500">Upload Photo for verification
                                    </span>
                                </a>
                            </div>
                            <input id="post_image" type="file" class="hidden" accept="image/png, image/gif, image/jpeg"
                                multiple />
                        </div>
                        <InputError class="mt-2" :message="form.errors.photos" />
                        <div v-if="post_images != null" class="grid mt-2 grid-cols-1 lg:grid-cols-4">
                            <div v-for="(image, key) in post_images" :key="key">
                                <div class="w-auto mt-2 mx-auto z-30">
                                    <div class="shadow-lg bg-white p-3">
                                        <img class="w-full max-h-[40vmin] object-cover" :src="image" />
                                        <ul class="mt-3 flex justify-end flex-wrap">
                                            <li>
                                                <button @click="
                                                    remove_image(key)
                                                    " class="flex text-gray-400 hover:text-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
                    </div>
                </div>
                <div class="text-center mt-6 mb-6">
                    <p><strong>PRIVACY NOTICE CMU</strong></p>
                    <p>
                        CMU is committed in complying the mandates of National
                        Privacy Commission and implementing the Rules and
                        Regulations of Data Privacy Act of 2012. Personal
                        information being collected through this attendance
                        sheet will be used to monitor attendance of the
                        participants for the following specified purpose/s:
                    </p>
                    <p>
                    <p> 1.Alumni Directory</p>
                    <p>2.CMUAAI ID</p>
                    </p>
                    <p>
                        I hereby declare that the information given in this application is true and correct to the best of
                        my knowledge and belief. In case any information given in this application proves to be false or
                        incorrect, I shall be responsible for the consequences
                    </p>
                    <p class="mt-10">
                        <input @click="function_aggree()" type="checkbox" id="" name="" value=""> I agree
                    </p>

                </div>

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                            <div class="ml-2">
                                I agree to the
                                <a target="_blank" :href="route('terms.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a>
                                and
                                <a target="_blank" :href="route('policy.show')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                    </Link>

                    <PrimaryButton v-if="aggreement == true" class="ml-4" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
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
