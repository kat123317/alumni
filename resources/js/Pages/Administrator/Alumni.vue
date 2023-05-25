<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed, ref, provide, inject, watch } from "vue";
import moment from "moment";
import { findProp } from "@vue/compiler-core";
import Pagination from "./components/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

// const trigger = inject("trigger");

const modal_update = ref(false);
const modal_delete = ref(false);
const upload_modal = ref(false);
const alertOn = ref(false);
const alertOnUpdate = ref(false);
const alertOnDelete = ref(false);
const alertOnError = ref(false);

const onAlert = (data) => {
    if (data == "Success") {
        alertOn.value = true;
    } else if (data == "Update") {
        alertOnUpdate.value = true;
    } else if (data == "Delete") {
        alertOnDelete.value = true;
    } else {
        alertOnError.value = true;
    }

    setTimeout(() => {
        if (data == "Success") {
            alertOn.value = false;
        } else if (data == "Update") {
            alertOnUpdate.value = false;
        } else if (data == "Delete") {
            alertOnDelete.value = false;
        } else {
            alertOnError.value = false;
        }
    }, 4000);
};

const date_conversion = (value) => {
    if (value) {
        return moment(value).format("YYYY");
    }
};

const image_name = ref("");
const tmp_achievement = ref("");
const form_alumni = useForm({
    firstname: "",
    middlename: "",
    lastname: "",
    suffix: "",
    details: {
        achievements: [],
        moto: "",
        profile_picture: "",
    },
    yearbook_id: null,
    college_id: null,
    course_id: null,
    profile_data: null,
});

const search_data = useForm({
    search: usePage().props.value.search ? usePage().props.value.search : "",
});

const courses = computed(() => {
    if (form_alumni.college_id == null) {
        return [];
    } else {
        return usePage().props.value.colleges.find(
            (c) => c.id == form_alumni.college_id
        ).courses;
    }
});

const update_courses = computed(() => {
    if (form_alumni_update.college_id == null) {
        return [];
    } else {
        return usePage().props.value.colleges.find(
            (c) => c.id == form_alumni_update.college_id
        ).courses;
    }
});

const openFile = () => {
    let hidden = document.getElementById("alumni-hidden-input");
    hidden.click();
    hidden.onchange = (e) => {
        let file = e.target.files[0];
        image_name.value = file.name;
        form_alumni.profile_data = file;
    };
};

const addAlumni = () => {
    if (
        form_alumni.yearbook_id == null ||
        form_alumni.firstname == "" ||
        form_alumni.lastname == "" ||
        form_alumni.details.moto == "" ||
        form_alumni.college_id == null ||
        form_alumni.course_id == null
    ) {
        onAlert("Please fill out all fields");
    } else {
        form_alumni.post(route("graduates.store"), {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Success");
                form_alumni.reset();
                image_name.value = "";
            },
        });
    }
};

const addAchievement = () => {
    if (tmp_achievement.value == "") {
        onAlert("Please fill out all fields");
    } else {
        form_alumni.details.achievements.push(tmp_achievement.value);
        tmp_achievement.value = "";
    }
};

const remove_achievement = (key) => {
    const temp_achievement = ref(
        form_alumni.details.achievements.splice(key, 1)
    );
};

const form_alumni_update = useForm({
    id: "",
    firstname: "",
    middlename: "",
    lastname: "",
    suffix: "",
    details: {
        achievements: [],
        moto: "",
        profile_picture: "",
    },
    yearbook_id: null,
    college_id: null,
    course_id: null,
    profile_data: null,
});

const open_update_modal = (
    id,
    firstname,
    middle,
    lastname,
    suffix,
    yearbook_id,
    details,
    college_id,
    course_id
) => {
    form_alumni_update.id = id;
    form_alumni_update.firstname = firstname;
    form_alumni_update.middlename = middle;
    form_alumni_update.lastname = lastname;
    form_alumni_update.suffix = suffix;
    form_alumni_update.yearbook_id = yearbook_id;
    form_alumni_update.details = details;
    form_alumni_update.course_id = course_id;
    form_alumni_update.college_id = college_id;

    image_name.value = details.profile_picture;

    modal_update.value = !modal_update.value;
};

const graduate_selected = ref(false);
const open_delete_modal = (graduate) => {
    graduate_selected.value = graduate;
    modal_delete.value = ! modal_delete.value
}

const close_update_modal = () => {
    image_name.value = "";
    modal_update.value = !modal_update.value;
};
const close_delete_modal = () => {
    modal_delete.value = !modal_delete.value;
};

const open_upload_modal = () => {
    upload_modal.value = !upload_modal.value;
};
const close_upload_modal = () => {
    ready_to_upload.value = [];
    multiple_images.multiple_images = [];
    upload_modal.value = !upload_modal.value;
};

const addAchievementUpdate = () => {
    if (tmp_achievement.value == "") {
        onAlert("Please fill out all fields");
    } else {
        form_alumni_update.details.achievements.push(tmp_achievement.value);
        tmp_achievement.value = "";
    }
};
const remove_achievement_update = (key) => {
    form_alumni_update.details.achievements.splice(key, 1);
};

const openFileUpdate = () => {
    let hidden = document.getElementById("alumni-hidden-input_update");
    hidden.click();
    hidden.onchange = (e) => {
        let file = e.target.files[0];
        image_name.value = file.name;
        form_alumni_update.profile_data = file;
    };
};

const function_search_alumni = () => {
    search_data.get(route("administrator.alumni"), {
        preserveScroll: true,
        onSuccess: () => { },
    });
};

const function_update_alumni = (id) => {
    form_alumni_update.post(
        route("graduates.update", { id: form_alumni_update.id }),
        {
            preserveScroll: true,
            onSuccess: () => {
                onAlert("Update");
                form_alumni_update.reset();
                image_name.value = "";
                close_update_modal();
            },
        }
    );
};

const function_delete_alumni = () => {
    Inertia.delete(
        route("graduates.delete", graduate_selected.value),
        {
            preserveScroll: true,
            onSuccess: () => {
                close_delete_modal();
            },
        }
    );
};

// provide("alumni_search_key", search_data.alumni_search_key);

const button_excel = useForm({
    upload: "Upload Excel",
    import: "Import Excel",
});

const excel_import = useForm({
    excel_file: "",
});
const excel_import_file = () => {
    let excel_file_import = document.getElementById("excel_import_file");
    excel_file_import.click();
    excel_file_import.onchange = (e) => {
        let file = e.target.files[0];
        excel_import.excel_file = file;
        button_excel.import = "Excel is ready to upload";
    };
};
const import_excel = () => {
    if (excel_import.excel_file != "") {
        button_excel.upload = "Please wait...";
        excel_import.post(route("graduates.import_excel"), {
            preserveScroll: true,
            onSuccess: () => {
                button_excel.reset();
                excel_import.reset();
                onAlert("Success");
            },
        });
    } else {
        onAlert("onError");
    }
};

const ready_to_upload = ref([]);
const multiple_images = useForm({
    multiple_images: [],
});
const upload_multiple_images = () => {
    let hidden = document.getElementById("upload_multiple_images");
    hidden.click();
    hidden.onchange = (e) => {
        for (let index = 0; index < e.target.files.length; index++) {
            ready_to_upload.value.push(
                window.URL.createObjectURL(e.target.files[index])
            );
            multiple_images.multiple_images.push(e.target.files[index]);
        }
    };
};

const upload_multiple_images_save = () => {
    if (multiple_images.multiple_images.length != 0) {
        multiple_images.post(route("graduates.upload_multiple_images"), {
            preserveScroll: true,
            onSuccess: () => {
                close_upload_modal();
                ready_to_upload.value = [];
                multiple_images.reset();
                multiple_images.multiple_images = [];
                onAlert("Success");
            },
        });
    } else {
        onAlert("onError");
    }
};

const remove_image = (key) => {
    ready_to_upload.value.splice(key, 1);
    multiple_images.multiple_images.splice(key, 1);
};
</script>
<template>
    <AdminLayout>
        <section class="text-gray-600 body-font relative">
            <div v-if="alertOn" class="bg-green-100 alertanim text-center py-4 lg:px-4">
                <div class="p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                    <span class="font-semibold mr-2 text-left flex-auto">Alum Successfully added</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                    </svg>
                </div>
            </div>
            <div v-if="alertOnUpdate" class="bg-blue-100 alertanim text-center py-4 lg:px-4">
                <div class="p-2 bg-blue-800 items-center text-blue-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span class="flex rounded-full bg-blue-500 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                    <span class="font-semibold mr-2 text-left flex-auto">Alum Successfully updated</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                    </svg>
                </div>
            </div>
            <div v-if="alertOnDelete" class="bg-red-100 alertanim text-center py-4 lg:px-4">
                <div class="p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Success</span>
                    <span class="font-semibold mr-2 text-left flex-auto">Alum Successfully deleted</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                    </svg>
                </div>
            </div>
            <div v-if="alertOnError" class="bg-gray-100 text-center py-4 lg:px-4">
                <div class="p-2 bg-gray-800 items-center text-gray-100 alertanim leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span class="flex rounded-full bg-gray-500 uppercase px-2 py-1 text-xs font-bold mr-3">Notice</span>
                    <span class="font-semibold mr-2 text-left flex-auto">Fill Empty fields</span>
                    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                    </svg>
                </div>
            </div>
            <div class="container mt-2 p-2 shadow border rounded-lg mx-auto">
                <div class="float-right mt-2">
                    <input type="file" name="file" class="form-control hidden" id="excel_import_file" />
                    <a @click="excel_import_file()"
                        class="mb-2 mr-2 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-md cursor-pointer">
                        {{ button_excel.import }}
                    </a>
                    <a @click="import_excel()"
                        class="mb-2 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-md cursor-pointer">
                        {{ button_excel.upload }}
                    </a>
                </div>
                <!-- <div class="float-right mr-2 mt-2">
                    <input id="upload_multiple_images" type="file" class="hidden" accept="image/png, image/gif, image/jpeg"
                        multiple />
                    <a @click="open_upload_modal()"
                        class="mb-2 mr-2 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-md cursor-pointer">
                        Import Images
                    </a> -->
                    <!-- <a
                            @click="upload_multiple_images_save()"
                            class="mb-2 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-md cursor-pointer"
                        >
                            Upload Images
                        </a> -->
                <!-- </div> -->
                <div class="flex flex-col text-center w-full mt-2">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 mt-2">
                        Add Alum
                    </h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                        Add Alum Here
                    </p>
                </div>
                <div class="mx-auto">
                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">School Year</label>
                                <select v-model="form_alumni.yearbook_id"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-nonefocus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option :value="null" disabled>
                                        Select School Year
                                    </option>
                                    <template v-for="(yearbook, key) in $page.props
                                        .yearbooks" :key="key">
                                        <option :value="yearbook.id">
                                            {{
                                                date_conversion(
                                                    yearbook.schoolyear_from
                                                ) +
                                                " to " +
                                                date_conversion(
                                                    yearbook.schoolyear_to
                                                )
                                            }}
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">First Name</label>
                                <input v-model="form_alumni.firstname" type="text" id="name" name="name"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Middle Name</label>
                                <input v-model="form_alumni.middlename" type="text" id="name" name="name"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Last Name</label>
                                <input v-model="form_alumni.lastname" type="text" id="name" name="name"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">Suffix (Optional)</label>
                                <input v-model="form_alumni.suffix" type="email" id="email" name="email"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                            </div>
                        </div>
                        <!-- <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="image" class="leading-7 text-sm text-gray-600">Image</label>
                                <input v-model="image_name" type="text" id="image" name="image" readonly
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <input id="alumni-hidden-input" type="file" class="hidden"
                                    accept="image/png, image/gif, image/jpeg" />
                                <div class="mt-8">
                                    <button @click="openFile"
                                        class="rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                                        Select Image
                                    </button>
                                </div>
                            </div>
                        </div> -->
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">Add Achievement</label>
                                <div class="flex items-center">
                                    <div class="relative w-full">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg class="w-6 h-6 text-green-900" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input v-model="tmp_achievement" type="text" id="simple-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5"
                                            placeholder="Achievement" required />
                                    </div>
                                    <button @click="addAchievement()" type="button"
                                        class="p-2.5 ml-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        <span class="sr-only">Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <h2 class="mb-2 text-lg font-semibold text-gray-900">
                                    Achievements
                                </h2>
                                <ul class="space-y-1 max-w-md list-disc list-inside">
                                    <template v-for="(achivement, key) in form_alumni
                                        .details.achievements" :key="key">
                                        <li>
                                            {{ achivement }}
                                            <button type="button" @click="remove_achievement(key)"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                Remove
                                            </button>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">College</label>
                                <select v-model="form_alumni.college_id" id="underline_select"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option :value="null" disabled>
                                        Select College
                                    </option>
                                    <template v-for="(college, key) in $page.props
                                        .colleges" :key="key">
                                        <option :value="college.id">
                                            {{ college.name }}
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">Course</label>
                                <select v-model="form_alumni.course_id" id="underline_select"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option :value="null" disabled>
                                        Select Course
                                    </option>
                                    <template v-for="(course, key) in courses" :key="key">
                                        <option :value="course.id">
                                            {{ course.name }}
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="message" class="leading-7 text-sm text-gray-600">Motto</label>
                                <textarea v-model="form_alumni.details.moto" id="message" name="message"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <button @click="addAlumni()"
                                class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                                Submit
                            </button>
                        </div>
                        <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center"></div>
                    </div>
                </div>
                <nav class="mb-10 flex justify-end" aria-label="Page navigation example">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input v-model="search_data.search" type="search" id="default-search"
                            class="block p-4 pl-10 w-[80vmin] lg:w-[50vmin] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Search " required />
                        <button @click="function_search_alumni()" type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                            Search
                        </button>
                    </div>
                </nav>
                <div class="overflow-x-auto shadow-lg rounded-lg relative">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-green-500">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Alumni name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Scool Year Graduated
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Achievements
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    College and course
                                </th>
                                <th scope="col" class="py-3 px-6">Motto</th>
                                <th scope="col" class="py-3 px-6">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b" v-for="(graduate, index) in usePage().props
                                .value.graduates.data" :key="index">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900">
                                    <div class="pl-3">
                                        <img class="w-20 h-20 rounded-full" :src="
                                            '/images/graduates/' +
                                            graduate.details.profile_picture
                                        " alt="" />
                                        <div class="text-base font-semibold">
                                            <span>{{ graduate.firstname }}
                                            </span>
                                            &nbsp;
                                            <span v-if="
                                                graduate.middlename != null
                                            ">{{ graduate.middlename }}
                                            </span>
                                            &nbsp;
                                            <span>{{ graduate.lastname }}
                                            </span>
                                            &nbsp;
                                            <span v-if="graduate.suffix == null"></span>
                                            <span v-else>{{
                                                graduate.suffix
                                            }}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="py-4 px-6">
                                    <div class="text-base font-semibold">
                                        {{ graduate.yearbook.schoolyear_from }}
                                        to
                                        {{ graduate.yearbook.schoolyear_to }}
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span v-for="(
                                                achievements, achievement_key
                                            ) in graduate.details.achievements" :key="achievement_key">
                                        <em class="mb-3 font-normal text-gray-700">{{ achievements }}</em><br />
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500">
                                        College of
                                        {{ graduate.course.college.name }}
                                    </div>
                                    <div class="font-normal text-gray-500">
                                        {{ graduate.course.abbreviation }} -
                                        {{ graduate.course.name }}
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500">
                                        {{ graduate.details.moto }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 flex mt-[25%]">
                                    <button @click="
                                        open_update_modal(
                                            graduate.id,
                                            graduate.firstname,
                                            graduate.middlename,
                                            graduate.lastname,
                                            graduate.suffix,
                                            graduate.yearbook.id,
                                            graduate.details,
                                            graduate.course.college.id,
                                            graduate.course.id
                                        )
                                    "
                                        class="flex items-center justify-center w-full px-2 py-1 text-white transition-colors duration-300 transform bg-blue-600 rounded-md focus:outline-none sm:w-auto sm:mx-1 hover:bg-blue-500 focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                        <span class="mx-1"> Edit </span>
                                    </button>

                                    <button @click="
                                        open_delete_modal(
                                            graduate
                                        )
                                    "
                                        class="flex items-center justify-center w-full px-2 py-1 text-white transition-colors duration-300 transform bg-red-600 rounded-md focus:outline-none sm:w-auto sm:mx-1 hover:bg-red-500 focus:bg-red-500 focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                        <span class="mx-1"> Delete </span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="px-4 w-100 py-3 flex items-center justify-center border-gray-200 sm:px-6">
                        <Pagination v-bind:links="$page.props.graduates.links" :search="search_data.search" />
                    </div>
                </div>

                <div v-if="modal_update" class=" ">
                    <div id="popup-modal" tabindex="-1"
                        class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="email" class="leading-7 text-sm text-gray-600">School Year</label>
                                        <select v-model="
                                            form_alumni_update.yearbook_id
                                        "
                                            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-nonefocus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                            <option :value="null" disabled>
                                                Select School Year
                                            </option>
                                            <template v-for="(yearbook, key) in $page
                                                .props.yearbooks.data" :key="key">
                                                <option :value="yearbook.id">
                                                    {{
                                                        date_conversion(
                                                            yearbook.schoolyear_from
                                                        ) +
                                                        " to " +
                                                        date_conversion(
                                                            yearbook.schoolyear_to
                                                        )
                                                    }}
                                                </option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">First Name</label>
                                        <input v-model="
                                            form_alumni_update.firstname
                                        " type="text" id="name" name="name"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">Middle Name</label>
                                        <input v-model="
                                            form_alumni_update.middlename
                                        " type="text" id="name" name="name"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">Last Name</label>
                                        <input v-model="
                                            form_alumni_update.lastname
                                        " type="text" id="name" name="name"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="email" class="leading-7 text-sm text-gray-600">Suffix (Optional)</label>
                                        <input v-model="form_alumni_update.suffix" type="email" id="email" name="email"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="image" class="leading-7 text-sm text-gray-600">Image</label>
                                        <input v-model="image_name" type="text" id="image" name="image" readonly
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <input id="alumni-hidden-input_update" type="file" class="hidden"
                                            accept="image/png, image/gif, image/jpeg" />
                                        <button @click="openFileUpdate"
                                            class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                                            Select Image
                                        </button>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="email" class="leading-7 text-sm text-gray-600">Add Achievement</label>
                                        <div class="flex items-center">
                                            <div class="relative w-full">
                                                <div
                                                    class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                    <svg class="w-6 h-6 text-green-900" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <input v-model="tmp_achievement" type="text" id="simple-search"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5"
                                                    placeholder="Achievement" required />
                                            </div>
                                            <button @click="addAchievementUpdate()" type="button"
                                                class="p-2.5 ml-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                <span class="sr-only">Add</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <h2 class="mb-2 text-lg font-semibold text-gray-900">
                                            Achievements
                                        </h2>
                                        <ul class="space-y-1 max-w-md list-disc list-inside">
                                            <template v-for="(
                                                        achivement, key
                                                    ) in form_alumni_update.details
                                                        .achievements" :key="key">
                                                <li>
                                                    {{ achivement }}
                                                    <button type="button" @click="
                                                        remove_achievement_update(
                                                            key
                                                        )
                                                    "
                                                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                        Remove
                                                    </button>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">College</label>
                                        <select v-model="
                                            form_alumni_update.college_id
                                        " id="underline_select"
                                            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                            <option :value="null" disabled>
                                                Select College
                                            </option>
                                            <template v-for="(college, key) in $page
                                                .props.colleges" :key="key">
                                                <option :value="college.id">
                                                    {{ college.name }}
                                                </option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="email" class="leading-7 text-sm text-gray-600">Course</label>
                                        <select v-model="
                                            form_alumni_update.course_id
                                        " id="underline_select"
                                            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                            <option :value="null" disabled>
                                                Select Course
                                            </option>
                                            <template v-for="(
                                                        course, key
                                                    ) in update_courses" :key="key">
                                                <option :value="course.id">
                                                    {{ course.name }}
                                                </option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Motto</label>
                                        <textarea v-model="
                                            form_alumni_update.details.moto
                                        " id="message" name="message"
                                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                    </div>
                                </div>
                                <button @click="close_update_modal()" type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                    data-modal-toggle="popup-modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                                        Are you sure you want to update this
                                        Alumni?
                                    </h3>
                                    <button @click="function_update_alumni()" data-modal-toggle="popup-modal" type="button"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button @click="close_update_modal()" data-modal-toggle="popup-modal" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                        No, cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="modal_delete" class=" ">
                    <div id="popup-modal" tabindex="-1"
                        class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow">
                             
                                
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                                        Are you sure you want to delete this
                                        Alumni?
                                        Doing this, data will not be recover
                                    </h3>
                                    <button @click="function_delete_alumni()" data-modal-toggle="popup-modal" type="button"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button @click="close_delete_modal()" data-modal-toggle="popup-modal" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                        No, cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="upload_modal" class=" ">
                    <div tabindex="-1"
                        class="overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full animate mt-10 max-w-[80%] h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow">
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <a @click="upload_multiple_images()"
                                            class="mb-2 mr-2 text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-md cursor-pointer">
                                            Import Images
                                        </a>
                                    </div>
                                </div>
                                <div class="h-[60vmin] overflow-auto">
                                    <div v-if="ready_to_upload != null" class="grid mt-2 grid-cols-1 lg:grid-cols-4">
                                        <div v-for="(
                                                    image, key
                                                ) in ready_to_upload" :key="key">
                                            <div class="w-auto mt-2 mx-auto lg:max-w-[20vmin] z-30">
                                                <div class="shadow-lg bg-white p-3">
                                                    <img class="w-full max-h-[40vmin] object-cover" :src="image" />
                                                    <ul class="mt-3 flex justify-end flex-wrap">
                                                        <li>
                                                            <button @click="
                                                                remove_image(
                                                                    key
                                                                )
                                                            " class="flex text-gray-400 hover:text-gray-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
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

                                <button @click="close_upload_modal()" type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                    data-modal-toggle="popup-modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                                        Are you sure you want to upload these
                                        images?
                                    </h3>
                                    <button @click="upload_multiple_images_save()" data-modal-toggle="popup-modal"
                                        type="button"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button @click="close_upload_modal()" data-modal-toggle="popup-modal" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                        No, cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>
<style>
.animate {
    animation: myAnim 0.5s ease 0s 1 normal forwards;
}

.alertanim {
    animation: Bounce 0.5s ease 0s 1 normal forwards;
}

@keyframes myAnim {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes Bounce {
    0% {
        animation-timing-function: ease-in;
        opacity: 0;
        transform: translateY(-250px);
    }

    38% {
        animation-timing-function: ease-out;
        opacity: 1;
        transform: translateY(0);
    }

    55% {
        animation-timing-function: ease-in;
        transform: translateY(-65px);
    }

    72% {
        animation-timing-function: ease-out;
        transform: translateY(0);
    }

    81% {
        animation-timing-function: ease-in;
        transform: translateY(-28px);
    }

    90% {
        animation-timing-function: ease-out;
        transform: translateY(0);
    }

    95% {
        animation-timing-function: ease-in;
        transform: translateY(-8px);
    }

    100% {
        animation-timing-function: ease-out;
        transform: translateY(0);
    }
}
</style>
