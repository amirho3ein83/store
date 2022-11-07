<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout>
        <!-- Container for demo purpose -->
        <div class="flex justify-center gap-4">
            <div class="container my-8 px-6 mx-auto w-1/3 bg-gray-700 py-8">
                <!-- Section: Design Block -->
                <section class="mb-32 text-center text-gray-800">
                    <div class="max-w-[700px] mx-auto px-3 lg:px-6">
                        <h2 class="text-3xl font-bold mb-12 my text-white py-8">
                            Contact us
                        </h2>
                        <form>
                            <div class="form-group mb-6">
                                <input
                                    type="text"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="exampleInput7"
                                    placeholder="Name"
                                />
                            </div>
                            <div class="form-group mb-6">
                                <input
                                    type="email"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="exampleInput8"
                                    placeholder="Email address"
                                />
                            </div>
                            <div class="form-group mb-6">
                                <textarea
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="exampleFormControlTextarea13"
                                    rows="3"
                                    placeholder="Message"
                                ></textarea>
                            </div>

                            <button
                                type="submit"
                                class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                            >
                                Send
                            </button>
                        </form>
                    </div>
                </section>
            </div>
            <div class="container my-8 px-6 mx-auto w-1/3 bg-gray-700 py-8">
                    <div class="flex flex-col justify-center content-center align-baseline">
                        <div
                            class="mb-12 grow-0 shrink-0 basis-auto w-full lg:w-6/12 px-3 lg:px-6"
                        >
                            <div class="flex">

                                <div class="grow ml-6">
                                    <p class="font-bold mb-1">
                                        Technical support
                                    </p>
                                    <p class="text-gray-500">
                                        support@example.com
                                    </p>
                                    <p class="text-gray-500">+1 234-567-89</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="mb-12 grow-0 shrink-0 basis-auto w-full lg:w-6/12 px-3 lg:px-6"
                        >
                            <div class="flex">
             
                                <div class="grow ml-6">
                                    <p class="font-bold mb-1">
                                        Sales questions
                                    </p>
                                    <p class="text-gray-500">
                                        sales@example.com
                                    </p>
                                    <p class="text-gray-500">+1 234-567-89</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="mb-12 grow-0 shrink-0 basis-auto w-full lg:w-6/12 px-3 lg:px-6"
                        >
                            <div class="flex align-start">

                                <div class="grow ml-6">
                                    <p class="font-bold mb-1">Press</p>
                                    <p class="text-gray-500">
                                        press@example.com
                                    </p>
                                    <p class="text-gray-500">+1 234-567-89</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="mb-12 grow-0 shrink-0 basis-auto w-full lg:w-6/12 px-3 lg:px-6"
                        >
                            <div class="flex align-start">

                                <div class="grow ml-6">
                                    <p class="font-bold mb-1">Bug report</p>
                                    <p class="text-gray-500">
                                        bugs@example.com
                                    </p>
                                    <p class="text-gray-500">+1 234-567-89</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </AppLayout>
</template>
