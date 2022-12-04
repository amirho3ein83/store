<script setup>
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { createToast } from "mosha-vue-toastify";

const form = useForm({
    name: "",
    email: "",
    mobile: "",
    desc: "",
});

defineProps({
    messsage: String,
});

const showError = (error) => {
    createToast(error, {
        position: "bottom-right",
        transition: "zoom",
        type: "danger",
        toastBackgroundColor: "#fc4242",
        timeout: 2900,
        hideProgressBar: "true",
    });
    form.errors = null;
};
const sendReport = () => {
    form.post(route("contact.us.report"), {
        onSuccess: () => {
            createToast("با تشکر از نظرسنجی شما", {
                type: "info",
                transition: "bounce",
                position: "top-left",
                timeout: 2100,
                toastBackgroundColor: "#80bacf",
                showCloseButton: "true",
                hideProgressBar: "true",
                swipeClose: "false",
            });
            form.reset();
        },
        onError: (error) => {
            createToast(error, {
                type: "info",
                transition: "bounce",
                position: "top-right",
                timeout: 2100,
                toastBackgroundColor: "#ed2715",
                showCloseButton: "true",
                hideProgressBar: "true",
                swipeClose: "false",
            });
        },
    });
};
</script>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    layout: AppLayout,
};
</script>

<template>
    <section class="bg-gray-800 w-full px-2 sm:px-20 py-10">
        <div class="-mx-4 flex flex-wrap lg:justify-between">
            <div class="w-full px-4 lg:w-1/2 xl:w-5/12">
                <div
                    class="relative rounded-lg bg-gray-500 p-8 shadow-lg sm:p-8"
                >
                    <form @submit.prevent="sendReport">
                        <div>
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                placeholder="نام"
                                class="mt-4 block w-full"
                                required
                            />
                        </div>
                        <div>
                            <TextInput
                                id="mobile"
                                v-model="form.mobile"
                                type="text"
                                placeholder="موبایل"
                                class="mt-4 block w-full"
                                required
                            />
                        </div>
                        <div class="mb-5">
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="text"
                                placeholder="ایمیل"
                                class="mt-4 block w-full"
                                required
                            />
                        </div>

                        <div class="mb-6">
                            <textarea
                                v-model="form.desc"
                                rows="6"
                                placeholder="انتقاد "
                                class="text-body-color border-[f0f0f0] focus:border-primary w-full resize-none rounded border py-3 px-[14px] text-base outline-none focus-visible:shadow-none"
                            ></textarea>
                        </div>
                        <div class="flex text-lg justify-end mt-4">
                            <button
                                class="ml-4 bg-gray-600 p-2 hover:bg-gray-400 rounded-lg"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                ثبت نظر
                            </button>
                        </div>
                    </form>
                </div>
                <div v-if="form.errors">
                    <div v-for="error of form.errors" :key="error">
                        {{ showError(error) }}
                    </div>
                </div>
            </div>
            <div class="w-full px-4 lg:w-1/2 xl:w-6/12">
                <div class="mb-12 max-w-[570px] lg:mb-0">
                    <h2
                        class="text-gray-100 mb-6 text-[32px] font-bold uppercase sm:text-[40px] lg:text-[36px] xl:text-[40px]"
                    >
                        ارتباط با ما
                    </h2>
                    <p
                        class="text-gray-100 text-body-color mb-9 text-base leading-relaxed"
                    >
                        برای جلب رضایت مشترکین خود برای آن ها طرح های تشویقی نیز
                        ارائه کرده است . مشترکین با فعال سازی این طرح ها می
                        توانند ، خدمات “ایرانسل” را با قیمتی مقرون به صرفه
                        استفاده کنند . البته در صورت فعال ‌سازی هر یک از طرح‌
                        های تخفیفی ایرانسل اعم از پیشنهاد های تشویقی ، طرح‌ های
                        همکاری می کند و برنامه های کاربردی را در اختیار مشترکین
                        خود ارائه کرده است .
                    </p>
                    <div class="mb-8 flex w-full">
                        <i class="bi bi-buildings-fill"></i>
                        <div class="w-full">
                            <h4 class="text-gray-100 mb-1 text-xl font-bold">
                                موقعیت ما
                            </h4>
                            <p class="text-gray-100 text-body-color text-base">
                                تهران، تهران، بزرگراه قاسم سلیمانی، شرق به
                                غرب،پلاک۵۴۹
                            </p>
                        </div>
                    </div>
                    <div class="mb-8 flex w-full">
                        <i class="bi bi-telephone-forward-fill"></i>
                        <div class="w-full">
                            <h4 class="text-gray-100 mb-1 text-xl font-bold">
                                راه های ارتباط با ما
                            </h4>
                            <p
                                class="py-2 text-gray-100 text-body-color text-base"
                            >
                                (+62)81 414 257 9980
                            </p>
                            <p class="text-gray-100 text-body-color text-base">
                                info@yourdomain.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
i {
    font-size: 28px;
    color: azure;
}
</style>
