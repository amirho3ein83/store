<script setup>
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { createToast } from "mosha-vue-toastify";
import JetInputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

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
        onError: (error) => {},
    });
};
</script>


<template>
    <section class="bg-gray-800 w-full px-2 sm:px-20 py-10">
        <div class="-mx-4 flex flex-wrap lg:justify-between">
            <div class="w-full px-4 lg:w-1/2 xl:w-5/12">
                <div
                    class="relative rounded-lg bg-gray-500 p-8 shadow-lg sm:p-8 text-sm sm:text-lg"
                >
                    <form @submit.prevent="sendReport">
                        <div>
                            <label for="name" class="block text-grey-100 ">
                                نام شما
                            </label>
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class=" block w-full"
                                required
                            />
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.mobile"
                            />
                        </div>
                        <div>
                            <label for="mobile" class="block text-grey-100 ">
                                مویابل
                            </label>
                            <TextInput
                                id="mobile"
                                v-model="form.mobile"
                                type="text"
                                class=" block w-full"
                                required
                            />
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.mobile"
                            />
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block text-grey-100 ">
                                ایمیل
                            </label>
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="text"
                                class=" block w-full"
                                required
                            />
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div class="mb-6">
                            <label for="desc" class="block text-grey-100 ">
                                توضیحات
                            </label>
                            <div
                                class="py-2 text-right px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
                            >
                                <textarea
                                    oninvalid="this.setCustomValidity('این فیلد لازمه')"
                                    oninput="setCustomValidity('')"
                                    id="desc"
                                    rows="6"
                                    v-model="form.desc"
                                    class="px-0 text-right w-full text-sm text-gray-800 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                    required
                                ></textarea>
                            </div>
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.desc"
                            />
                        </div>
                        <div class="flex text-lg justify-end ">
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
            </div>
            <div class="w-full px-4 lg:w-1/2 xl:w-6/12">
                <div class="mb-12 max-w-[570px] lg:mb-0">
                    <h2
                        class="text-gray-100 mb-6 text-[32px] uppercase sm:text-[40px] lg:text-[36px] xl:text-[40px]"
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
                            <h4 class="text-gray-100 mb-1 text-xl">
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
                            <h4 class="text-gray-100 mb-1 text-xl">
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
