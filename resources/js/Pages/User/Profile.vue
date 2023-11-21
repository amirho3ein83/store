<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";
import { createToast } from "mosha-vue-toastify";
import Logout from "@/Modals/triggers/Logout.vue";

let props = defineProps({
    user: Object,
    image_url: String,
});

const previewImage = ref(props.image_url);
const imageUrl = ref(null);
const photoInput = ref(null);
const profile_photo = ref(null);

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    mobile: props.user.mobile,
    profile_photo: null,
});

const updateInfo = () => {
    Inertia.post(
        route("user.updateInfo"),
        {
            _method: "put",
            name: form.name,
            email: form.email,
            mobile: form.mobile,
            profile_photo: form.profile_photo,
        },
        {
            preserveScroll: true,
            forceFormData: true,

            onSuccess: (res) => {
                createToast("تغییرات اعمال شد", {
                    type: "info",
                    transition: "bounce",
                    position: "top-left",
                    timeout: 2100,
                    toastBackgroundColor: "#80bacf",
                    showCloseButton: "true",
                    hideProgressBar: "true",
                    swipeClose: "false",
                });
            },
            onFinish: () => {
                console.log("finish");
            },
            onError: (err) => {
                alert(err);
            },
        }
    );
};

const pickFile = (event) => {
    console.log(event);
    if (event.target.files.length == 0) {
        return;
    }
    previewImage.value = event.target.files[0];
    // form.profile_photo = event.target.files[0];
};

watch(previewImage, (previewImage) => {
    let reader = new FileReader();

    reader.readAsDataURL(previewImage);

    reader.addEventListener("load", () => {
        imageUrl.value = reader.result;
    });
});
</script>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

    <!-- <div class="">
                                            <div class="flex justify-between">


                                                <div class="px-2 hidden sm:block text-left">
                                                    <ul>
                                                        <li

                                                            class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">
                                                            Favorites list</li>
                                                        <li
                                                            class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">
                                                            Transition History</li>
                                                        <li
                                                            class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">
                                                            Orders History</li>
                                                        <li
                                                            class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">
                                                            Cart </li>
                                                        <li
                                                            class="mt-5 cursor-pointer border-l-2 border-l-blue-700 px-2 py-2 font-semibold text-blue-700 transition hover:border-l-blue-700 hover:text-blue-700">
                                                            Notifications</li>
                                                        <li
                                                            class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:text-blue-700 ">
                                                            <Logout class="text-start" />
                                    </li>
                                                    </ul>
                                                </div>

                                                <div class="container max-w-md mx-auto xl:max-w-3xl h-full flex  rounded-lg shadow overflow-hidden">
                                                    <div class="relative hidden xl:block xl:w-1/2 h-full">
                                                        <img class="absolute h-auto w-full object-cover"
                                                            src="https://images.unsplash.com/photo-1541233349642-6e425fe6190e" alt="my zomato" />
                                                    </div>
                                                    <div class="w-full xl:w-1/2 p-8">
                                                        <form method="post" action="#" onSubmit="return false">

                                                            <div class="mb-4 mt-6">
                                                                <label class="block text-left text-gray-700 text-sm font-semibold mb-2" htmlFor="email">
                                                                    Name
                                                                </label>
                                                                <input
                                                                    class="text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10"
                                                                    id="name" type="text" placeholder="Your name " />
                                                            </div>
                                                            <div class="mb-4 mt-6">
                                                                <label class="block text-left text-gray-700 text-sm font-semibold mb-2" htmlFor="email">
                                                                    Email
                                                                </label>
                                                                <input
                                                                    class="text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10"
                                                                    id="email" type="text" placeholder="Your email address" />
                                                            </div>
                                                            <div class="mb-6 mt-6">
                                                                <label class="block text-left text-gray-700 text-sm font-semibold mb-2" htmlFor="mobile">
                                                                    Mobile
                                                                </label>
                                                                <input
                                                                    class="text-sm bg-gray-200 appearance-none rounded w-full py-2 px-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline h-10"
                                                                    id="mobile" type="text" placeholder="Your mobile" />
                                                            </div>
                                                            <div class="flex w-full mt-8">
                                                                <button
                                                                    class="w-full bg-gray-800 hover:bg-grey-900 text-white text-sm py-2 px-4 font-semibold rounded focus:outline-none focus:shadow-outline h-10"
                                                                    type="button">
                                                                    apply changes
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->





















    <!-- component -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">


    <section class=" py-1 bg-gray-50">
        <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <h6 class="text-gray-700 text-xl font-bold ">
                        پروفایل من
                    </h6>

                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                    <form>
                        <h6 class="text-gray-400 text-sm mt-3 mb-6 font-bold uppercase">
                            اطلاعات کاربری
                        </h6>
                        <div class="flex justify-between">

                            <div x-data="{photoName: null, photoPreview: null}"
                                class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                                <!-- Photo File Input -->
                                <input type="file" class="hidden" x-ref="photo" x-on:change="
                                                            photoName = $refs.photo.files[0].name;
                                                            const reader = new FileReader();
                                                            reader.onload = (e) => {
                                                                photoPreview = e.target.result;
                                                            };
                                                            reader.readAsDataURL($refs.photo.files[0]);
                                        ">

                                <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                                    عکس پروفایل <span class="text-red-600"> </span>
                                </label>
                                <!-- upload image processor -->
                                <!-- <div>
                                    <span id="ProgressLabel" class="sr-only">Loading</span>

                                    <span role="progressbar" aria-labelledby="ProgressLabel" aria-valuenow="85"
                                        class="block rounded-full bg-gray-200">
                                        <span class="block h-1 rounded-full bg-indigo-600 text-center text-[10px]/4"
                                            style="width: 85%">
                                            <span class="font-bold text-white"> 85% </span>
                                        </span>
                                    </span>
                                </div> -->
                                <div class="text-center">
                                    <!-- Current Profile Photo -->
                                    <div class="mt-2" x-show="! photoPreview">

                                        <img v-if="$page.props.user.avatar_url" class="w-40 h-40 m-auto rounded-full shadow"
                                            :src="$page.props.user.avatar_url" alt="profile">
                                        <img v-else class="w-40 h-40 m-auto rounded-full shadow"
                                            src="https://img.freepik.com/premium-vector/man-avatar-profile-picture-vector-illustration_268834-538.jpg"
                                            alt="profile">
                                    </div>
                                    <!-- New Profile Photo Preview -->
                                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                                        <span class="block w-40 h-40 rounded-full m-auto shadow"
                                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'"
                                            style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                        </span>
                                    </div>
                                    <div class="flex gap-1 justify-center pt-2">


                                        <button
                                            class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md">


                                            Delete
                                        </button>

                                        <button
                                            class="inline-flex items-center px-2 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-medium rounded-md">


                                            Restore
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap ">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-600 text-sm font-bold mb-2"
                                            htmlfor="grid-password">
                                            نام کاربری
                                        </label>
                                        <input type="text"
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-600 text-sm font-bold mb-2"
                                            htmlfor="grid-password">
                                            ایمیل
                                        </label>
                                        <input type="email"
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-600 text-sm font-bold mb-2"
                                            htmlfor="grid-password">
                                            نام
                                        </label>
                                        <input type="text"
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-600 text-sm font-bold mb-2"
                                            htmlfor="grid-password">
                                            نام خانوادگی
                                        </label>
                                        <input type="text"
                                            class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="mt-6 border-b-1 border-gray-300">

                        <h6 class="text-gray-400 text-sm mt-3 mb-6 font-bold uppercase">
                            آدرس
                        </h6>
                        <div class="flex justify-end">


                            <div class="flex flex-col mx-auto w-1/2">



                                <div class=" px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-600 text-sm font-bold mb-2"
                                            htmlfor="grid-password">
                                            کد پستی
                                        </label>
                                        <input type="text"
                                            class="border-0 w-full px-3 py-3 placeholder-gray-300 text-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                                <div class=" px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-600 text-sm font-bold mb-2"
                                            htmlfor="grid-password">
                                            آدرس
                                        </label>

                                        <textarea id="message" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Your message..."></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <button
                            class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                            type="button">
                            اعمال تغییرات
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</template>
