<script setup>
import WalletCard from "@/Components/WalletCard.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, watch } from "vue";
import { createToast } from "mosha-vue-toastify";

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
    <section
        class="lg:w-4/6 md:w-2/3 w-full sm:flex justify-center mx-auto bg-[#5c5c69] rounded-2xl px-8 py-4 shadow-lg"
    >
        <div class="w-1/2 mx-auto">
            <div class="mt-6 w-fit mx-auto">
                <img
                    v-if="previewImage == null"
                    src="https://as1.ftcdn.net/v2/jpg/02/10/49/86/1000_F_210498655_ywivjjUe6cgyt52n4BxktRgDCfFg8lKx.jpg"
                    class="rounded-full w-36 h-36 object-cover"
                    alt="profile picture"
                    srcset=""
                />
                <img
                    v-else-if="!imageUrl"
                    :src="previewImage"
                    class="rounded-full w-36 h-36 object-cover"
                    alt="profile picture"
                    srcset=""
                />
                <img
                    v-else
                    :src="imageUrl"
                    class="rounded-full w-36 h-36 object-cover"
                    alt="profile picture"
                    srcset=""
                />
            </div>
            <div class="my-5">
                <h2 class="text-white font-bold text-2xl tracking-wide">
                    {{ user.name }}
                </h2>
            </div>
        </div>
        <div>
            <form
                @submit.prevent="updateInfo()"
                class="space-y-4"
                enctype="multipart/form-data"
            >
                <div class="px-5 pb-5">
                    <TextInput
                        @input="form.profile_photo = $event.target.files[0]"
                        id="image"
                        type="file"
                        ref="photoInput"
                        @change="pickFile"
                        class="mt-1 block w-full"
                        accept="image/png, image/jpeg, image/jpg"
                    />
                    <InputError class="mt-2" :message="form.errors.image" />

                    <input
                        v-model="form.name"
                        type="text"
                        placeholder="Name"
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                    />

                    <input
                        v-model="form.email"
                        type="email"
                        placeholder="Email"
                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                    />
                    <div class="flex">
                        <div class="flex-grow w-1/2">
                            <input
                                type="text"
                                v-model="form.mobile"
                                autocomplete
                                placeholder="Mobile"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                            />
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <PrimaryButton
                            class="ml-4 bg-stone-600"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            update
                        </PrimaryButton>
                    </div>
                </div>
                <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                >
                    {{ form.progress.percentage }}%
                </progress>
                <div
                    v-for="error of form.errors"
                    :key="error"
                    class="shadow w-2/3 p-2 flex justify-center rounded-lg"
                >
                    <div
                        class="bg-red-500 animate-pulse inline-block rounded-lg p-1 mr-1"
                    ></div>
                    <p class="p-1 text-stone-50">{{ error }}!</p>
                </div>
            </form>
        </div>
    </section>
</template>
