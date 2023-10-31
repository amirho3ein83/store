<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import SignUpBtn from "@/Components/SignUpBtn.vue";
import ErrorAlert from "@/Components/ErrorAlert.vue";

import { OrbitSpinner } from "epic-spinners";


const form = useForm({
    mobile: "",
    password: "",
    password_confirmation: "",
    // terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
        onError:(e)=>{
            console.log(e)
        }
    });
};


</script>

<template>
    <Head title="Register" />

    <div id="page-container"
        class="flex flex-col  mx-auto w-full min-h-screen min-w-[320px] bg-gray-100 dark:text-gray-100 dark:bg-gray-900">
        <main id="page-content" class="flex flex-auto flex-col max-w-full">
            <div
                class="min-h-screen flex items-center justify-center relative overflow-hidden max-w-10xl mx-auto p-4 lg:p-8 w-full">
                <section class="py-6 w-full max-w-xl">
                    <header class="mb-10 text-center">
                        <h1 class="text-2xl font-bold inline-flex items-center mb-2 space-x-2">
                            <OrbitSpinner :animation-duration="3000" :size="40" color="#2c2e3b" />
                            <span>Register</span>
                        </h1>

                    </header>

                    <div
                        class="flex flex-col rounded-lg shadow-sm bg-white overflow-hidden dark:text-gray-100 dark:bg-gray-800">
                        <div class="p-5 text-left md:px-16 md:py-12 grow">
                            <form @submit.prevent="submit">

                                <div class="space-y-1 py-2">
                                    <label for="mobile" class="text-sm  font-medium">Email or Mobile</label>
                                    <input v-model="form.mobile" type="text" id="mobile" name="mobile"
                                        placeholder="Enter your email or Mobile"
                                        class="w-full block border placeholder-gray-500 px-5 py-3 leading-6 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-blue-500 dark:placeholder-gray-400">
                                </div>

                                <ErrorAlert v-if="form.errors.mobile" :message="`Email or Mobile is not valid`"/>

                                <div class="space-y-1 py-2">
                                    <label for="password" class="text-sm font-medium">Password</label>
                                    <input v-model="form.password" type="password" id="password" name="password"  autocomplete="on"
                                        placeholder="Enter your password"
                                        class="w-full block border placeholder-gray-500 px-5 py-3 leading-6 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-blue-500 dark:placeholder-gray-400">
                                </div>

                                <ErrorAlert v-if="form.errors.password" :message="`password is not valid`"/>

                                <div class="space-y-1 py-2">
                                    <label for="password_confirmation" class="text-sm font-medium">Confirm Password</label>
                                    <input v-model="form.password_confirmation" type="password" id="password_confirmation"
                                        name="password_confirmation" autocomplete="on" placeholder="confirm your password"
                                        class="w-full block border placeholder-gray-500 px-5 py-3 leading-6 rounded-lg border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:focus:border-blue-500 dark:placeholder-gray-400">
                                </div>

                                <ErrorAlert v-if="form.errors.password == `validation.confirmed`" :message="`Confirm Password is not valid`"/>

                                <div class="pt-4">

                                    <SignUpBtn :title="`Sign up`" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing" />

                                    <div class="flex items-center my-5">
                                        <span aria-hidden="true"
                                            class="grow bg-gray-100 rounded h-0.5 dark:bg-gray-700/75"></span>
                                        <span
                                            class="text-sm font-medium text-gray-800 bg-gray-100 rounded-full px-3 py-1 dark:bg-gray-700 dark:text-gray-200">or
                                            sign up with</span>
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
                            Already have an account?


                            <Link href="/login" class="text-gray-100 px-3 duration-100 hover:scale-110">
                            <span
                                class="font-medium text-blue-600 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-300">Sign
                                in</span>
                            </Link>
                        </div>
                    </div>

                </section>
            </div>
        </main>
    </div></template>
