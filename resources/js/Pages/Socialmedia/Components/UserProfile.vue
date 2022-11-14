<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, onMounted, computed } from "vue";
import NoPostsYet from "./emptypost.vue";
import PostImage from "@/Pages/Socialmedia/Components/PostImageProfile.vue";

import moment from "moment";

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

const date_conversion2 = (value) => {
    if (value) {
        return moment(value).format("h:mm:ss");
    }
};

const status = (value) => {
    var status = "";
    if (value == 1) {
        status = "Single";
    } else if (value == 2) {
        status = "Married";
    } else if (value == 3) {
        status = "Annulled";
    } else if (value == 4) {
        status = "Divorce";
    }
    return status;
};
</script>

<template>
    <AppLayout title="UserProfile">
        <!-- component -->

        <div
            style="
                background: url('https://www.cmu.edu.ph/wp-content/uploads/2022/05/1new-cmubanner-1045x218-1.jpg');
                background-repeat: no-repeat;
                background-size: contain;
            "
            class="bg-gray-800 font-sans pt-[30vmin] lg:pt-0 lg:h-[50vmin] w-full flex flex-row justify-center items-center"
        >
            <div
                class="card w-96 mx-auto bg-white rounded-lg shadow-xl hover:shadow"
            >
                <img
                    class="w-32 mx-auto rounded-full -mt-20 border-8 border-white"
                    :src="
                        usePage().props.value.user_profile[0].profile_photo_url
                    "
                    alt=""
                />
                <div class="text-center mt-2 text-3xl font-medium">
                    {{ usePage().props.value.user_profile[0].name }}({{
                        usePage().props.value.user_profile[0].details.nickname
                    }})
                </div>
                <div class="text-center mt-2 font-light text-sm">
                    {{
                        status(
                            usePage().props.value.user_profile[0].details
                                .civil_status
                        )
                    }}
                </div>
                <div class="flex px-6 text-center mt-2 font-light text-md">
                    <svg
                        version="1.1"
                        id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px"
                        y="0px"
                        viewBox="0 0 489.736 489.736"
                        style="
                            enable-background: new 0 0 489.736 489.736;
                            width: 25px;
                        "
                        xml:space="preserve"
                    >
                        <path
                            d="M394.739,213.175h-0.1c-0.4-9-8.8-24.3-28.1-18.8l-141.8,55.2l-141.8-55.1c-18.6-5.6-28.1,7.8-28.1,18.7v117.8
				c0,53.2,35.4,95.9,78.2,95.9h183.5c42.7,0,77.1-43.8,78.2-96.9V213.175z M354.039,329.975h-0.1c0,30.2-17.7,55.2-37.5,55.2
				h-183.4c-20.8,0-37.5-25-37.5-55.2v-86.5l123,46.9c4.2,2.1,9.4,2.1,14.6,0l120.9-46.9V329.975z"
                        />
                        <path
                            d="M484.239,456.075l-25.6-31.4c0.3-1,0.5-2,0.6-3v-311.7c0-17-22.1-23.2-24-24l-203.2-84.4c-5.2-2.1-10.4-2.1-15.6,0
				l-203.3,84.5c-20.8,11-11.8,33.7,0,37.5l203.3,84.4c5.8,2,11.1,2.3,15.6,0l185.5-77.1v289.4l-29.2,35.8
				c-7.3,9.4-5.2,21.9,3.1,29.2c9.4,7.3,21.9,5.2,29.2-3.1l16.7-19.8l16.7,19.8c5,6.8,16.7,10.1,27.1,3.1
				C490.539,477.975,491.539,464.375,484.239,456.075z M223.639,167.375l-150.1-62.6l151.1-62.5l149.1,62.5L223.639,167.375z"
                        />
                    </svg>

                    {{ usePage().props.value.user_profile[0].college.name }} -
                    {{ usePage().props.value.user_profile[0].course.name }}
                </div>
                <div class="flex px-6 text-center font-normal text-md">
                    <svg
                        version="1.1"
                        id="Capa_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px"
                        y="0px"
                        viewBox="0 0 512 512"
                        style="enable-background: new 0 0 512 512; width: 30px"
                        xml:space="preserve"
                    >
                        <path
                            d="M411.779,192.47c-4.166,1.472-6.35,6.043-4.877,10.208C412.939,219.763,416,237.703,416,256c0,88.225-71.776,160-160,160
		S96,344.225,96,256S167.776,96,256,96c37.952,0,74.749,13.522,103.612,38.076c3.365,2.861,8.414,2.455,11.277-0.91
		s2.456-8.414-0.91-11.277C338.226,94.876,297.747,80,256,80c-97.047,0-176,78.953-176,176s78.953,176,176,176s176-78.953,176-176
		c0-20.118-3.369-39.852-10.012-58.652C420.516,193.182,415.946,190.997,411.779,192.47z"
                        />
                        <path
                            d="M392.307,172.166c1.512,2.453,4.133,3.804,6.818,3.804c1.432,0,2.881-0.385,4.19-1.19
		c3.761-2.318,4.931-7.247,2.612-11.008c-3.55-5.76-7.478-11.377-11.673-16.695c-2.737-3.47-7.767-4.063-11.236-1.325
		c-3.469,2.736-4.062,7.767-1.326,11.235C385.508,161.822,389.079,166.93,392.307,172.166z"
                        />
                        <path
                            d="M480,208h-13.393c-5.399-23.848-14.705-46.326-27.734-66.991l9.46-9.46c12.477-12.477,12.477-32.777,0-45.255
		l-22.627-22.628c-12.476-12.474-32.778-12.475-45.255,0l-9.46,9.461C350.327,60.098,327.849,50.792,304,45.393V32
		c0-17.645-14.355-32-32-32h-32c-17.645,0-32,14.355-32,32v13.393c-23.849,5.4-46.327,14.705-66.991,27.734l-9.46-9.461
		c-12.476-12.474-32.778-12.475-45.255,0L63.667,86.295c-12.477,12.477-12.477,32.777,0,45.255l9.46,9.459
		C60.098,161.675,50.792,184.153,45.393,208H32c-17.645,0-32,14.355-32,32v32c0,17.645,14.355,32,32,32h13.393
		c5.399,23.848,14.705,46.325,27.734,66.99l-9.46,9.461c-12.477,12.477-12.477,32.777,0,45.255l22.627,22.628
		c12.476,12.475,32.777,12.478,45.255-0.001l9.46-9.461c20.665,13.03,43.142,22.336,66.99,27.734V480c0,17.645,14.355,32,32,32h32
		c17.645,0,32-14.355,32-32v-13.394c23.847-5.398,46.325-14.704,66.99-27.733l9.46,9.461c12.476,12.475,32.778,12.477,45.255,0
		l22.627-22.629c12.477-12.477,12.477-32.777,0-45.255l-9.46-9.459c13.029-20.665,22.335-43.143,27.734-66.991H480
		c17.645,0,32-14.355,32-32v-32C512,222.355,497.645,208,480,208z M496,272c0,8.822-7.178,16-16,16h-19.883
		c-3.828,0-7.12,2.712-7.852,6.47c-5.127,26.313-15.313,50.913-30.272,73.12c-2.139,3.175-1.729,7.42,0.978,10.127l14.048,14.048
		c6.238,6.238,6.238,16.389,0,22.627l-22.627,22.628c-6.239,6.238-16.389,6.238-22.628,0l-14.048-14.049
		c-2.706-2.706-6.953-3.116-10.126-0.978c-22.209,14.96-46.81,25.145-73.12,30.271c-3.758,0.732-6.47,4.024-6.47,7.853V480
		c0,8.822-7.178,16-16,16h-32c-8.822,0-16-7.178-16-16v-19.884c0-3.828-2.712-7.12-6.47-7.853
		c-26.311-5.126-50.912-15.312-73.119-30.271c-1.361-0.917-2.918-1.365-4.467-1.365c-2.064,0-4.113,0.797-5.66,2.344l-14.048,14.049
		c-6.239,6.238-16.389,6.238-22.628,0l-22.627-22.628c-6.238-6.238-6.238-16.389,0-22.627l14.049-14.049
		c2.707-2.707,3.117-6.952,0.978-10.127c-14.959-22.207-25.145-46.808-30.272-73.119c-0.732-3.758-4.024-6.47-7.852-6.47H32
		c-8.822,0-16-7.178-16-16v-32c0-8.822,7.178-16,16-16h19.883c3.828,0,7.12-2.712,7.852-6.47
		c5.127-26.311,15.312-50.911,30.272-73.12c2.139-3.175,1.728-7.42-0.979-10.127l-14.048-14.048c-6.238-6.238-6.238-16.389,0-22.627
		L97.608,74.98c6.239-6.237,16.389-6.239,22.628,0l14.048,14.049c2.707,2.706,6.952,3.117,10.126,0.978
		c22.205-14.959,46.806-25.144,73.12-30.271c3.757-0.732,6.47-4.024,6.47-7.853V32c0-8.822,7.178-16,16-16h32
		c8.822,0,16,7.178,16,16v19.883c0,3.828,2.712,7.12,6.47,7.853c26.313,5.128,50.914,15.313,73.12,30.271
		c3.174,2.139,7.419,1.729,10.126-0.978l14.048-14.049c6.239-6.237,16.389-6.239,22.628,0l22.627,22.628
		c6.238,6.238,6.238,16.389,0,22.627l-14.048,14.048c-2.707,2.707-3.117,6.952-0.978,10.127
		c14.96,22.207,25.145,46.809,30.271,73.12c0.732,3.758,4.024,6.47,7.853,6.47H480c8.822,0,16,7.178,16,16V272z"
                        />
                        <path
                            d="M210.858,294.883l-29.809,7.741c-0.049,0.013-0.099,0.026-0.148,0.04C161.927,307.98,152,326.581,152,342.208v8.641
		c0,9.457,8.277,17.151,18.452,17.151l85.418-0.009c0.062,0.001,0.121,0.009,0.183,0.009s0.122-0.008,0.184-0.009l85.419-0.009
		c10.174,0,18.451-7.694,18.451-17.151v-8.641c0-15.628-9.927-34.229-28.901-39.544c-0.049-0.014-0.098-0.027-0.147-0.04
		l-29.808-7.741c-2.527-0.744-4.524-2.053-4.955-2.736l-0.02-16.214c0.025-0.03,0.051-0.057,0.076-0.086
		c10.221-12.217,15.85-28.045,15.85-44.57v-12.076c10.197-33.218,3.011-62.02-0.677-70.402c-0.012-0.028-0.028-0.053-0.041-0.081
		c-0.071-0.157-0.15-0.309-0.23-0.459c-0.046-0.087-0.09-0.175-0.14-0.26c-0.077-0.133-0.162-0.26-0.246-0.388
		c-0.064-0.098-0.127-0.197-0.195-0.291c-0.073-0.101-0.153-0.196-0.23-0.293c-0.088-0.111-0.176-0.223-0.269-0.328
		c-0.066-0.075-0.138-0.144-0.207-0.215c-0.112-0.117-0.223-0.233-0.341-0.342c-0.065-0.06-0.135-0.115-0.201-0.172
		c-0.127-0.11-0.254-0.22-0.388-0.321c-0.077-0.059-0.158-0.111-0.237-0.166c-0.128-0.09-0.255-0.181-0.388-0.263
		c-0.103-0.064-0.211-0.12-0.317-0.179c-0.114-0.063-0.226-0.13-0.343-0.188c-0.132-0.065-0.268-0.122-0.404-0.18
		c-0.097-0.042-0.193-0.087-0.292-0.125c-0.148-0.057-0.301-0.104-0.453-0.152c-0.092-0.029-0.183-0.062-0.276-0.088
		c-0.148-0.041-0.298-0.071-0.449-0.104c-0.105-0.022-0.208-0.048-0.314-0.066c-0.132-0.022-0.266-0.037-0.399-0.053
		c-0.131-0.016-0.261-0.034-0.393-0.043c-0.109-0.008-0.218-0.008-0.328-0.011c-0.161-0.005-0.321-0.009-0.483-0.004
		c-0.089,0.002-0.179,0.011-0.268,0.017c-0.18,0.011-0.361,0.026-0.541,0.05c-0.027,0.003-0.054,0.003-0.081,0.007
		c-7.709,1.103-17.114-1.15-27.07-3.533c-17.611-4.218-37.474-8.962-54.875,3.584c-16.826,1.446-28.756,15.586-28.756,34.698
		c0,13.898,6.449,38.721,7.927,44.229v6.681c0,17.249,5.969,33.193,15.538,45.087l-0.022,17.32
		C215.382,292.83,213.385,294.139,210.858,294.883z M216.296,227.007c0-7.952,3.365-19.58,5.88-26.936
		c36.247,0.832,63.597,9.537,74.026,13.396v4.44c0,0.024,0,0.049,0,0.073v13.276c0,14.103-5.303,27.023-13.576,35.964
		c-0.022,0.022-0.042,0.045-0.063,0.067c-7.112,7.656-16.405,12.379-26.42,12.379c-21.227,0-39.846-23.331-39.846-49.928V227.007z
		 M231.816,288.827c7.4,4.362,15.669,6.84,24.326,6.84c8.498,0,16.699-2.2,24.15-6.364l0.004,2.932c0,3.967,1.43,7.293,3.65,10.013
		l-27.858,16.442l-27.743-16.646c2.115-2.677,3.467-5.927,3.467-9.781L231.816,288.827z M170.451,352
		c-1.634,0-2.451-0.932-2.451-1.151v-8.641c0-9.578,5.891-20.926,17.152-24.119l27.103-7.038l35.799,21.479v19.461L170.451,352z
		 M344.107,342.189v8.641c0,0.22-0.817,1.151-2.452,1.151l-77.602,0.008v-19.422l36.279-21.412l26.626,6.915
		C338.218,321.265,344.107,332.611,344.107,342.189z M223.992,160c0.025,0,0.049-0.003,0.074-0.004
		c0.239-0.002,0.477-0.013,0.715-0.036c0.078-0.007,0.153-0.022,0.23-0.032c0.183-0.023,0.365-0.047,0.547-0.083
		c0.098-0.019,0.193-0.046,0.29-0.07c0.157-0.037,0.313-0.073,0.469-0.12c0.106-0.032,0.208-0.072,0.313-0.109
		c0.142-0.049,0.283-0.097,0.423-0.155c0.111-0.046,0.217-0.1,0.325-0.15c0.128-0.06,0.256-0.117,0.381-0.184
		c0.122-0.065,0.238-0.139,0.355-0.21c0.105-0.063,0.213-0.123,0.316-0.192c0.149-0.1,0.29-0.209,0.432-0.318
		c0.063-0.049,0.13-0.091,0.192-0.142c11.771-9.619,27.047-5.959,43.221-2.089c8.705,2.085,17.645,4.22,26.325,4.252
		c2.086,7.707,4.137,21.364,1.934,37.631c-13.021-4.743-43.573-13.99-83.926-13.99c-0.017,0-0.034,0.002-0.051,0.002
		c-0.197,0.001-0.393,0.014-0.589,0.03c-0.074,0.006-0.15,0.008-0.224,0.016c-0.166,0.018-0.33,0.047-0.494,0.075
		c-0.102,0.018-0.205,0.031-0.305,0.052c-0.121,0.026-0.239,0.061-0.358,0.092c-0.137,0.036-0.275,0.068-0.41,0.11
		c-0.078,0.025-0.154,0.058-0.231,0.085c-0.167,0.059-0.335,0.117-0.497,0.187c-0.061,0.026-0.12,0.059-0.18,0.087
		c-0.171,0.079-0.342,0.158-0.506,0.248c-0.094,0.051-0.183,0.111-0.274,0.167c-0.125,0.075-0.252,0.147-0.372,0.229
		c-0.152,0.103-0.297,0.217-0.442,0.331c-0.054,0.042-0.111,0.08-0.163,0.124c-0.169,0.139-0.33,0.289-0.487,0.443
		c-0.025,0.024-0.053,0.047-0.078,0.072c-0.142,0.142-0.275,0.294-0.407,0.448c-0.037,0.043-0.078,0.083-0.114,0.127
		c-0.102,0.124-0.195,0.256-0.29,0.388c-0.061,0.083-0.125,0.164-0.182,0.25c-0.066,0.1-0.125,0.205-0.187,0.308
		c-0.077,0.127-0.156,0.254-0.226,0.387c-0.042,0.079-0.078,0.163-0.117,0.244c-0.052,0.105-0.106,0.209-0.153,0.318
		c-0.553-3.774-0.901-7.241-0.901-9.988C208.369,170.144,212.46,160,223.992,160z"
                        />
                    </svg>
                    &nbsp;
                    {{
                        usePage().props.value.user_profile[0].details
                            .current_work
                    }}
                </div>
                <div class="flex px-6 text-center mt-2 font-light text-md">
                    <svg
                        version="1.1"
                        id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px"
                        y="0px"
                        viewBox="0 0 32 32"
                        style="enable-background: new 0 0 32 32; width: 30px"
                        xml:space="preserve"
                    >
                        <line
                            style="
                                fill: none;
                                stroke: #000000;
                                stroke-width: 2;
                                stroke-miterlimit: 10;
                            "
                            x1="4"
                            y1="22.583"
                            x2="9.417"
                            y2="28"
                        />
                        <polyline
                            style="
                                fill: none;
                                stroke: #000000;
                                stroke-width: 2;
                                stroke-miterlimit: 10;
                            "
                            points="22,4 28,4 28,10 "
                        />
                        <line
                            style="
                                fill: none;
                                stroke: #000000;
                                stroke-width: 2;
                                stroke-miterlimit: 10;
                            "
                            x1="28"
                            y1="4"
                            x2="22.232"
                            y2="9.768"
                        />
                        <line
                            style="
                                fill: none;
                                stroke: #000000;
                                stroke-width: 2;
                                stroke-miterlimit: 10;
                            "
                            x1="4"
                            y1="28"
                            x2="9.454"
                            y2="22.546"
                        />
                        <path
                            d="M15.86,11.255c-0.114,0.087-0.232,0.167-0.334,0.27c-0.433,0.433-0.723,0.964-0.883,1.538
	c1.09,0.14,2.102,0.612,2.892,1.402C18.479,15.409,19,16.665,19,18s-0.521,2.591-1.465,3.536S15.335,23,14,23
	s-2.591-0.52-3.535-1.464S9,19.335,9,18c0-0.865,0.239-1.686,0.65-2.421C9.553,15.063,9.5,14.536,9.5,14
	c0-0.498,0.05-0.987,0.133-1.467c-0.201,0.162-0.397,0.332-0.582,0.517C7.729,14.373,7,16.13,7,18s0.729,3.627,2.051,4.95
	S12.13,25,14,25s3.627-0.728,4.949-2.05S21,19.87,21,18s-0.729-3.627-2.051-4.95C18.078,12.179,17.016,11.572,15.86,11.255z"
                        />
                        <path
                            d="M22.949,9.05C21.627,7.728,19.87,7,18,7s-3.627,0.728-4.949,2.05S11,12.13,11,14s0.729,3.627,2.051,4.95
	c0.871,0.871,1.933,1.478,3.089,1.795c0.114-0.087,0.232-0.167,0.334-0.27c0.433-0.433,0.723-0.964,0.883-1.538
	c-1.09-0.14-2.102-0.612-2.892-1.402C13.521,16.591,13,15.335,13,14s0.521-2.591,1.465-3.536S16.665,9,18,9s2.591,0.52,3.535,1.464
	S23,12.665,23,14c0,0.865-0.239,1.686-0.65,2.421c0.096,0.516,0.15,1.043,0.15,1.579c0,0.498-0.05,0.987-0.133,1.467
	c0.201-0.162,0.397-0.332,0.582-0.517C24.271,17.627,25,15.87,25,14S24.271,10.373,22.949,9.05z"
                        />
                    </svg>

                    {{
                        usePage().props.value.user_profile[0].details.gender ==
                        1
                            ? "Male"
                            : "Female"
                    }}
                </div>
                <div class="flex px-6 text-center mt-2 font-light text-md">
                    <svg
                        viewBox="0 0 100 100"
                        xmlns="http://www.w3.org/2000/svg"
                        style="width: 30px"
                    >
                        <path
                            d="M49,18.92A23.74,23.74,0,0,0,25.27,42.77c0,16.48,17,31.59,22.23,35.59a2.45,2.45,0,0,0,3.12,0c5.24-4.12,22.1-19.11,22.1-35.59A23.74,23.74,0,0,0,49,18.92Zm0,33.71a10,10,0,1,1,10-10A10,10,0,0,1,49,52.63Z"
                        />
                    </svg>

                    {{ usePage().props.value.user_profile[0].details.address }}
                </div>
                <div class="flex px-6 text-center mt-2 font-light text-md">
                    <svg
                        version="1.1"
                        id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px"
                        y="0px"
                        viewBox="0 0 512 512"
                        style="enable-background: new 0 0 512 512; width: 25px"
                        xml:space="preserve"
                    >
                        <path
                            d="M256,85.27c18.825,0,34.133-15.309,34.133-34.133c0-16.563-23.142-43.196-27.785-48.367c-3.234-3.61-9.463-3.61-12.698,0
				c-4.642,5.171-27.785,31.804-27.785,48.367C221.867,69.962,237.175,85.27,256,85.27z M256,21.68
				c9.054,11.315,17.067,24.021,17.067,29.457c0,9.412-7.654,17.067-17.067,17.067c-9.412,0-17.067-7.654-17.067-17.067
				C238.933,45.701,246.946,32.995,256,21.68z"
                        />
                        <path
                            d="M213.333,119.404h85.333c4.719,0,8.533-3.823,8.533-8.533s-3.814-8.533-8.533-8.533h-85.333
				c-4.719,0-8.533,3.823-8.533,8.533S208.614,119.404,213.333,119.404z"
                        />
                        <path
                            d="M102.4,218.698v62.839c0,4.71,3.814,8.533,8.533,8.533s8.533-3.823,8.533-8.533v-59.733
				c10.138,0,18.748-7.125,27.87-14.677c11.008-9.122,23.484-19.456,40.397-19.456s29.389,10.334,40.397,19.456
				c9.122,7.552,17.732,14.677,27.87,14.677c10.138,0,18.748-7.125,27.87-14.677c11.008-9.122,23.484-19.456,40.397-19.456
				c16.913,0,29.389,10.334,40.397,19.456c9.122,7.552,17.732,14.677,27.87,14.677v59.733c0,4.71,3.814,8.533,8.533,8.533
				c4.719,0,8.533-3.823,8.533-8.533v-62.839c19.652-7.219,34.133-26.3,34.133-48.094c0-19.456-14.677-34.133-34.133-34.133H102.4
				c-19.456,0-34.133,14.677-34.133,34.133C68.267,192.398,82.748,211.478,102.4,218.698z M102.4,153.537h307.2
				c10.052,0,17.067,7.014,17.067,17.067c0,18.5-15.633,34.133-34.133,34.133c-3.994,0-10.59-5.47-16.973-10.752
				c-11.913-9.873-28.228-23.381-51.294-23.381c-23.066,0-39.381,13.508-51.294,23.381c-6.383,5.282-12.979,10.752-16.973,10.752
				s-10.59-5.47-16.973-10.752c-11.913-9.873-28.228-23.381-51.294-23.381s-39.381,13.508-51.294,23.381
				c-6.383,5.282-12.979,10.752-16.973,10.752c-18.5,0-34.133-15.633-34.133-34.133C85.333,160.552,92.348,153.537,102.4,153.537z"
                        />
                        <path
                            d="M503.467,494.87H8.533c-4.719,0-8.533,3.823-8.533,8.533s3.814,8.533,8.533,8.533h494.933
				c4.719,0,8.533-3.823,8.533-8.533S508.186,494.87,503.467,494.87z"
                        />
                        <path
                            d="M34.133,389.364v79.906c0,4.71,3.814,8.533,8.533,8.533s8.533-3.823,8.533-8.533v-76.8
				c10.138,0,18.748-7.125,27.87-14.677c11.008-9.122,23.484-19.456,40.397-19.456s29.389,10.334,40.397,19.456
				c9.122,7.552,17.732,14.677,27.87,14.677c10.138,0,18.748-7.125,27.87-14.677c11.008-9.122,23.484-19.456,40.397-19.456
				s29.389,10.334,40.397,19.456c9.122,7.552,17.732,14.677,27.87,14.677c10.138,0,18.748-7.125,27.87-14.677
				c11.008-9.122,23.484-19.456,40.397-19.456c16.913,0,29.389,10.334,40.397,19.456c9.122,7.552,17.732,14.677,27.87,14.677v76.8
				c0,4.71,3.814,8.533,8.533,8.533s8.533-3.823,8.533-8.533v-79.906c19.652-7.219,34.133-26.3,34.133-48.094
				c0-19.456-14.677-34.133-34.133-34.133H34.133C14.677,307.137,0,321.814,0,341.27C0,363.065,14.481,382.145,34.133,389.364z
				 M34.133,324.204h443.733c10.052,0,17.067,7.014,17.067,17.067c0,18.5-15.633,34.133-34.133,34.133
				c-3.994,0-10.59-5.47-16.973-10.752c-11.912-9.873-28.228-23.381-51.294-23.381c-23.066,0-39.381,13.508-51.294,23.381
				c-6.383,5.282-12.979,10.752-16.973,10.752s-10.59-5.47-16.973-10.752c-11.913-9.873-28.228-23.381-51.294-23.381
				c-23.066,0-39.381,13.508-51.294,23.381c-6.383,5.282-12.979,10.752-16.973,10.752s-10.59-5.47-16.973-10.752
				c-11.913-9.873-28.228-23.381-51.294-23.381s-39.381,13.508-51.294,23.381c-6.383,5.282-12.979,10.752-16.973,10.752
				c-18.5,0-34.133-15.633-34.133-34.133C17.067,331.218,24.081,324.204,34.133,324.204z"
                        />
                    </svg>

                    {{
                        only_date_conversion(
                            usePage().props.value.user_profile[0].details
                                .date_of_birth
                        )
                    }}
                </div>
                <div class="flex px-6 text-center mt-2 font-light text-md">
                    <svg
                        version="1.2"
                        baseProfile="tiny"
                        id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px"
                        y="0px"
                        viewBox="0 0 256 256"
                        xml:space="preserve"
                        style="width: 25px"
                    >
                        <path
                            d="M60.2,3.4c-18.1,0-32.9,14.8-32.9,32.9c0,0-0.4,182.3-0.4,183.8c0,17.7,14.1,32.1,31.6,32.8v0.1h170.1v-9.2
	c-13.1,0-23.7-10.6-23.7-23.7s10.6-23.7,23.7-23.7v-0.2V3.4H60.2z M109.7,67.1h27.5V39.7h18.3v27.5h27.5v18.3h-27.5v64.1h-18.3V85.4
	h-27.5V67.1z M63.9,21.4h9.2v155.6h-9.2V21.4z M195.7,220c0,9.3,4,17.7,10.2,23.7H59.8C46.7,243.8,36,233.1,36,220
	c0-12.4,9.7-22.6,21.9-23.5l148.3-0.3C199.8,202.2,195.7,210.6,195.7,220z"
                        />
                    </svg>

                    {{ usePage().props.value.user_profile[0].details.religion }}
                </div>
                <div class="px-6 text-center mt-2 font-light text-sm">
                    <p>
                        {{
                            usePage().props.value.user_profile[0].details.motto
                        }}
                    </p>
                </div>
                <hr class="mt-8" />
                <div class="flex p-4">
                    <div class="w-full text-center">
                        <span class="font-bold">
                            {{
                                usePage().props.value.user_profile[0].posts
                                    .length
                            }}</span
                        >
                        Posts
                    </div>
                </div>
            </div>
        </div>
        <h2 class="flex flex-row flex-nowrap items-center my-8">
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
            <span
                class="flex-none block mx-4 px-4 py-2.5 text-xs leading-none font-medium uppercase bg-green-700 rounded-lg text-white"
            >
                Your Posts
            </span>
            <span
                class="flex-grow block border-t border-green-700"
                aria-hidden="true"
                role="presentation"
            ></span>
        </h2>
        <NoPostsYet v-if="usePage().props.value.user_profile[0].length == 0" />
        <div
            class="w-full px-2 lg:px-[25vmin] grid grid-cols-1 lg:grid-cols-1 gap-3"
        >
            <article
                v-for="(posts, key) in usePage().props.value.user_profile[0]
                    .posts"
                :key="key"
                class="mb-4 w-full break-inside p-6 rounded-xl bg-white"
            >
                <div class="flex pb-6 items-center justify-between">
                    <div class="flex">
                        <a class="inline-block mr-4" href="#">
                            <img
                                class="rounded-full max-w-none w-12 h-12"
                                :src="posts.user.profile_photo_url"
                            />
                        </a>
                        <div class="flex flex-col">
                            <div>
                                <a class="inline-block text-lg font-bold">
                                    {{ posts.user.name }}</a
                                >
                            </div>
                            <div class="text-slate-500">
                                {{ date_conversion(posts.created_at) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="py-4">
                        <div class="flex justify-between gap-1 mb-1">
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-tl-lg"
                                    src="https://images.pexels.com/photos/92866/pexels-photo-92866.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full"
                                    src="https://images.pexels.com/photos/247929/pexels-photo-247929.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-tr-lg"
                                    src="https://images.pexels.com/photos/631522/pexels-photo-631522.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                        </div>
                        <div class="flex justify-between gap-1">
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-bl-lg"
                                    src="https://images.pexels.com/photos/1429748/pexels-photo-1429748.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                            <a class="flex" href="#">
                                <img class="max-w-full rounded-br-lg"
                                    src="https://images.pexels.com/photos/69020/pexels-photo-69020.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                            </a>
                        </div>
                    </div> -->
                <p class="">
                    {{ posts.content }}
                </p>
                <PostImage :posts="posts" />
                <!-- <div v-if="posts.photo != null" class="py-4 mx-auto">
                    <div v-if="posts.photo.length > 3" class="grid grid-cols-2">
                        <a
                            :href="'./../../images/posts/' + photos"
                            target="_blank"
                            class="flex"
                            v-for="(photos, key) in posts.photo"
                            :key="key"
                        >
                            <img
                                class="w-auto m-1 max-h-[55vmin] hover:bg-gray-200 hover:scale-100 object-contain"
                                :src="'./../../images/posts/' + photos"
                            />
                        </a>
                    </div>
                    <div v-if="posts.photo.length == 3">
                        <div class="grid grid-cols-2">
                            <a
                                class="flex"
                                href="#"
                                v-for="(photos, key2) in posts.photo"
                                :key="key2"
                            >
                                <img
                                    v-if="key2 != 2"
                                    :href="'./../../images/posts/' + photos"
                                    target="_blank"
                                    class="w-auto max-h-[55vmin] hover:bg-gray-200 object-contain"
                                    :src="'./../../images/posts/' + photos"
                                />
                            </a>
                        </div>
                        <div class="flex justify-center mx-auto">
                            <img
                                class="w-full max-h-[100vmin] hover:bg-gray-200 object-contain"
                                :href="'./../../images/posts/' + photos"
                                target="_blank"
                                :src="'./../../images/posts/' + posts.photo[2]"
                            />
                        </div>
                    </div>
                    <div
                        v-if="posts.photo.length == 2"
                        class="grid grid-cols-2 grid-rows-1 ..."
                    >
                        <a
                            class="flex"
                            :href="'./../../images/posts/' + photos"
                            target="_blank"
                            v-for="(photos, key) in posts.photo"
                            :key="key"
                        >
                            <img
                                class="w-auto object-contain hover:bg-gray-200 max-w-[40vmin]"
                                :src="'./../../images/posts/' + photos"
                            />
                        </a>
                    </div>
                    <div
                        v-if="posts.photo.length == 1"
                        class="grid grid-cols-1 grid-rows-1 ..."
                    >
                        <a
                            class="flex"
                            :href="'./../../images/posts/' + photos"
                            target="_blank"
                            v-for="(photos, key) in posts.photo"
                            :key="key"
                        >
                            <img
                                class="w-auto object-contain hover:bg-gray-200 max-w-[100vmin]"
                                :src="'./../../images/posts/' + photos"
                            />
                        </a>
                    </div>
                </div> -->
                <!-- <div class="py-4">
                        <a class="inline-flex items-center" href="#">
                            <span class="mr-2">
                                <svg class="fill-rose-600 dark:fill-rose-400" style="width: 24px; height: 24px"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z">
                                    </path>
                                </svg>
                            </span>
                            <span class="text-lg font-bold">34</span>
                        </a>
                    </div> -->
                <h2 class="mt-4 border-t font-bold">Comments</h2>

                <div class="w-full rounded-lg mx-4 md:mx-auto">
                    <div
                        v-for="(commentsData, key2) in posts.comments.slice(
                            0,
                            3
                        )"
                        :key="key2"
                        class="flex items-start px-4 py-6"
                    >
                        <img
                            class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                            :src="commentsData.user.profile_photo_url"
                            alt="avatar"
                        />
                        <div class="">
                            <div class="flex items-center justify-between">
                                <h2
                                    class="text-lg font-semibold text-gray-900 -mt-1"
                                >
                                    {{ commentsData.user.name }}
                                </h2>
                                <small class="ml-2 text-sm text-gray-700">{{
                                    date_conversion(commentsData.created_at)
                                }}</small>
                            </div>
                            <p class="text-gray-700">
                                <small>
                                    Updated
                                    {{
                                        date_conversion(commentsData.updated_at)
                                    }}
                                </small>
                            </p>
                            <p class="mt-3 text-gray-700 text-sm">
                                {{ commentsData.content }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <small
                        v-if="
                            posts.comments != null && posts.comments.length > 3
                        "
                        class="text-center w-fullmy-2 font-bold text-gray-800"
                        >{{
                            posts.comments.length -
                            posts.comments.slice(0, 3).length
                        }}
                        more comments
                    </small>
                </div>
                <!-- Comments content -->
                <div class="pt-6 flex items-end">
                    <div class="w-full">
                        <a
                            :href="route('socialmedia.comments', [posts.id])"
                            class="py-3 px-4 w-full block bg-slate-100 text-center rounded-lg font-medium hover:bg-slate-200 transition ease-in-out delay-75"
                            >Show more comments
                            <kbd
                                class="px-2 py-1.5 text-xs font-semibold text-white bg-green-800 border border-green-200 rounded-lg"
                                >{{ posts.comments.length }}</kbd
                            ></a
                        >
                    </div>
                </div>
            </article>
        </div>
    </AppLayout>
</template>

<style></style>
