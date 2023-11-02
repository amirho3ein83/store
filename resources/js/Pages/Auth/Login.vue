<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import ErrorAlert from "@/Components/ErrorAlert.vue";
import JetLabel from "@/Components/Label.vue";
import { onMounted, ref } from "vue";
import { OrbitSpinner } from "epic-spinners";
import SignUpBtn from "@/Components/SignUpBtn.vue";

let showForm = ref(false);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form
        .transform((data) => ({
            ...data,
            remember: form.remember ? "on" : "",
        }))
        .post(route("login"), {
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

    <div id="page-container"
        class="flex flex-col  mx-auto w-full min-h-screen min-w-[320px] bg-gray-100 dark:text-gray-100 dark:bg-gray-900">
        <main id="page-content" class="flex flex-auto flex-col max-w-full">
            <div
                class="min-h-screen flex items-center justify-center relative overflow-hidden max-w-10xl mx-auto p-4 lg:p-8 w-full">
                <section class="py-6 w-full max-w-xl">
                    <header class="mb-10 text-center">
                        <h1 class="text-2xl font-bold inline-flex items-center mb-2 space-x-2">
                            <OrbitSpinner :animation-duration="3000" :size="40" color="#2c2e3b" />
                            <span>Login</span>
                        </h1>

                    </header>

                    <div
                        class="flex flex-col rounded-lg shadow-sm bg-white overflow-hidden dark:text-gray-100 dark:bg-gray-800">
                        <div class="p-5 text-left md:px-16 md:py-12 grow">
                            <form @submit.prevent="submit">

                                <div class="space-y-1 py-2">
                                    <label for="email" class="text-sm  font-medium">Email or mobile</label>
                                    <input v-model="form.email"  type="text" id="email" name="email"
                                        placeholder="Enter your email or mobile"
                                        class="w-full block border placeholder-gray-500 px-5 py-3 leading-6 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-blue-500 dark:placeholder-gray-400">
                                </div>

                                <ErrorAlert v-if="form.errors.email" :message="`Email or Mobile is not valid`"/>

                                <div class="space-y-1 py-2">
                                    <label for="password" class="text-sm font-medium">Password</label>
                                    <input v-model="form.password"  type="password" id="password"
                                        name="password" placeholder="Enter your password"
                                        class="w-full block border placeholder-gray-500 px-5 py-3 leading-6 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-blue-500 dark:placeholder-gray-400">
                                </div>
                                <div v-if="form.errors.password"
                                    class="p-3 mb-3 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    Password is not valid
                                </div>

                                <div>
                                    <div class=" pt-3 flex items-center justify-between space-x-2 mb-5">
                                        <label class="flex items-center">
                                            <input v-model="form.remember"  type="checkbox"
                                                id="remember_me" name="remember_me"
                                                class="border border-gray-200 rounded h-4 w-4 text-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:ring-offset-gray-900 dark:focus:border-blue-500 dark:checked:bg-blue-500 dark:checked:border-transparent">
                                            <span class="text-sm ml-2">Remember me</span>
                                        </label>
                                        <a href="javascript:void(0)"
                                            class="text-sm font-medium inline-block text-blue-600 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-300">Forgot
                                            Password?</a>
                                    </div>
                                    <SignUpBtn :title="`Sign in`" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing" />

                                    <div class="flex items-center my-5">
                                        <span aria-hidden="true"
                                            class="grow bg-gray-100 rounded h-0.5 dark:bg-gray-700/75"></span>
                                        <span
                                            class="text-sm font-medium text-gray-800 bg-gray-100 rounded-full px-3 py-1 dark:bg-gray-700 dark:text-gray-200">or
                                            sign in with</span>
                                        <span aria-hidden="true"
                                            class="grow bg-gray-100 rounded h-0.5 dark:bg-gray-700/75"></span>
                                    </div>

                                    <div class=" flex justify-center ">
                                        <button type="button"
                                            class="inline-flex justify-center w-1/2 items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-white text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-sm focus:ring focus:ring-gray-300 focus:ring-opacity-25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600 dark:focus:ring-opacity-40 dark:active:border-gray-700">
                                            <img src="/icons8-google.svg" class="w-8 h-8" alt="">

                                            <span>Google</span>
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-3 md:px-16 grow text-sm text-center bg-gray-50 dark:bg-gray-700/50">
                            Don't have an account?


                            <Link href="/register" class="text-gray-100 px-3 ">
                            <span
                                class=" text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Sign
                                up</span>
                            </Link>
                        </div>
                    </div>

                </section>
            </div>
        </main>
    </div>
</template>
<!-- <style scoped>
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
</style> -->
