<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import { onMounted, ref } from "vue";

let showForm = ref(false);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

onMounted(() => {
    setTimeout(() => {
        showForm.value = true;
    }, 50);
});
</script>

<template>
    <Head title="Login" />
    <!-- component -->
    <div
        class="min-h-screen flex items-center justify-center bg-center py-12 bg-gray-500 bg-no-repeat bg-cover relative"
        style="
            background-image: url('https://www.agilitypr.com/wp-content/uploads/2017/08/brand-1.jpg');
        "
    >
        <div class="absolute bg-black opacity-60 inset-0 z-0"></div>

        <div class="grid gap-8 grid-cols-1 px-2">
            <Transition name="slide-fade">
                <div
                    v-if="showForm"
                    class=" max-w-[390px] w-[360px] space-y-8 px-8 py-6 backdrop-blur-3xl bg-white/20 rounded-xl shadow-lg z-10"
                >
                    <form @submit.prevent="submit">
                        <h1 class="text-xl font-bold mb-4 text-orange-300">
                            صفحه ورود
                        </h1>

                        <div>
                            <JetLabel
                                class="text-stone-200"
                                for="email"
                                value="ایمیل یا موبایل"
                            />
                            <JetInput
                                id="email"
                                v-model="form.email"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                            />
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div class="mt-4">
                            <JetLabel
                                class="text-stone-200"
                                for="password"
                                value="کلمه عبور"
                            />
                            <JetInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="current-password"
                            />
                            <JetInputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>
                        <div class="mt-4 flex justify-between">
                            <label class="flex items-center">
                                <JetCheckbox
                                    v-model:checked="form.remember"
                                    class="w-6 h-6"
                                    name="remember"
                                />
                                <span class="ml-2 text-sm text-gray-200"
                                    >مرا به خاطر بسپار</span
                                >
                            </label>
                        </div>

                        <div class="flex w-full mt-8">
                            <JetButton
                                class="m-4 bg-yellow-600"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                لاگین
                            </JetButton>
                        </div>
                        <div class="flex flex-col mt-2">
                            <Link
                                :href="route('password.request')"
                                class="my-1 text-sm text-gray-200 hover:text-gray-300"
                            >
                                رمز عبور خود را فراموش کرده اید؟
                            </Link>
                            <Link
                                :href="route('register')"
                                class="my-1 text-sm text-gray-200 hover:text-gray-300"
                            >
                                هنوز ثبت نام نکرده اید؟
                            </Link>
                        </div>
                    </form>
                </div>
            </Transition>
        </div>
    </div>

    <!-- <div
        class="flex items-center justify-center min-h-screen bg-no-repeat w-full object-cover"
        style="
            background-image: url('https://indian-retailer.s3.ap-south-1.amazonaws.com/s3fs-public/2022-08/cropped-image-woman-inputting-card-information-key-phone-laptop-while-shopping-online-min_0.jpg');
        "
    >
        <Transition name="slide-fade">
            <div
                v-if="showForm"
                class="w-full sm:w-[400px] p-12 mx-auto backdrop-blur-3xl bg-white/20"
            >
                <form @submit.prevent="submit">
                    <h1 class="text-xl font-bold mb-4 text-orange-300">
                        صفحه ورود
                    </h1>

                    <div>
                        <JetLabel
                            class="text-stone-200"
                            for="email"
                            value="ایمیل یا موبایل"
                        />
                        <JetInput
                            id="email"
                            v-model="form.email"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                        <JetInputError
                            class="mt-2"
                            :message="form.errors.email"
                        />
                    </div>

                    <div class="mt-4">
                        <JetLabel
                            class="text-stone-200"
                            for="password"
                            value="کلمه عبور"
                        />
                        <JetInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                        <JetInputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>
                    <div class="mt-4 flex justify-between">
                        <label class="flex items-center">
                            <JetCheckbox
                                v-model:checked="form.remember"
                                class="w-6 h-6"
                                name="remember"
                            />
                            <span class="ml-2 text-sm text-gray-200"
                                >مرا به خاطر بسپار</span
                            >
                        </label>

                        <div class="flex flex-col mt-2">
                            <Link
                                :href="route('password.request')"
                                class="my-1 text-sm text-gray-700 hover:text-gray-300"
                            >
                                رمز عبور خود را فراموش کرده اید؟
                            </Link>
                            <Link
                                :href="route('register')"
                                class="my-1 text-sm text-gray-700 hover:text-gray-300"
                            >
                                هنوز ثبت نام نکرده اید؟
                            </Link>
                        </div>
                    </div>

                    <div class="flex w-full mt-8">
                        <JetButton
                            class="m-4 bg-yellow-600"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            لاگین
                        </JetButton>
                    </div>
                </form>
            </div>
        </Transition>
    </div> -->
    <!-- <div class="flex">
        <div class="w-full h-screen">
            <img
                class="object-cover w-full h-full"
                src="./pics/astronat.jpg"
                alt=""
            />
        </div>
        <Transition name="slide-fade">
            <div
                v-if="showForm"
                class="w-[400px] p-5 absolute top-20 left-24 m-5 backdrop-blur-sm bg-white/20"
            >
                <form @submit.prevent="submit">
                    <h1 class="text-xl font-bold mb-4 text-orange-300">صفحه ورود</h1>

                    <div>
                        <JetLabel class="text-stone-200" for="email" value="ایمیل یا موبایل" />
                        <JetInput
                            id="email"
                            v-model="form.email"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                        <JetInputError
                            class="mt-2"
                            :message="form.errors.email"
                        />
                    </div>

                    <div class="mt-4">
                        <JetLabel class="text-stone-200" for="password" value="کلمه عبور" />
                        <JetInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                        <JetInputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>
                    <div class="mt-4 flex justify-between">
                        <label class="flex items-center">
                            <JetCheckbox
                                v-model:checked="form.remember"
                                class="w-6 h-6"
                                name="remember"
                            />
                            <span class="ml-2 text-sm text-gray-200"
                                >مرا به خاطر بسپار</span
                            >
                        </label>

                        <div class="flex flex-col mt-2">
                            <Link
                                :href="route('password.request')"
                                class="my-1 text-sm text-gray-300 hover:text-gray-50"
                            >
                                رمز عبور خود را فراموش کرده اید؟
                            </Link>
                            <Link
                                :href="route('register')"
                                class="my-1 text-sm text-gray-300 hover:text-gray-50"
                            >
                                هنوز ثبت نام نکرده اید؟
                            </Link>
                        </div>
                    </div>

                    <div class="flex w-full mt-8">
                        <JetButton
                            class="m-4 bg-yellow-600"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            لاگین
                        </JetButton>
                    </div>
                </form>
            </div>
        </Transition>
    </div> -->
</template>
<style scoped>
.slide-fade-leave-active {
    transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
