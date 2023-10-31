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
import UserLayout from "@/Layouts/UserLayout.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    layout: UserLayout,
};
</script>
<template>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

    <div class="">
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
                        class="mt-5 cursor-pointer border-l-2 border-l-blue-700 px-2 py-2 font-semibold text-blue-700 transition hover:border-l-blue-700 hover:text-blue-700">
                        Notifications</li>
                    <li
                        class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:text-blue-700 ">
                        <Logout class="text-start" />
</li>
                </ul>
            </div>

            <!-- component -->
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
    </div>
</template>
