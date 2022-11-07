<script setup>
import UserSidebar from "@/Components/UserSidebar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

import "bootstrap-icons/font/bootstrap-icons.css";
</script>

<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-wrap">
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/4 md:w-1/3 md:pr-10 md:py-6">
                    <div class="flex relative pb-12">
                        <div
                            class="h-full w-10 absolute inset-0 flex items-center justify-center"
                        >
                            <div
                                class="h-full w-1 bg-gray-200 pointer-events-none"
                            ></div>
                        </div>
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10"
                        >
                            <i class="bi bi-ticket-detailed"></i>
                        </div>
                        <div class="flex-grow pl-4">
                            <h2
                                class="font-medium title-font text-lg text-gray-900 mb-1 tracking-wider"
                            >
                                get details
                            </h2>
                        </div>
                    </div>
                    <div class="flex relative pb-12">
                        <div
                            class="h-full w-10 absolute inset-0 flex items-center justify-center"
                        >
                            <div
                                class="h-full w-1 bg-gray-200 pointer-events-none"
                            ></div>
                        </div>
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10"
                        >
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="flex-grow pl-4">
                            <h2
                                class="font-medium title-font text-lg text-gray-900 mb-1 tracking-wider"
                            >
                                get address
                            </h2>
                        </div>
                    </div>
                    <div class="flex relative">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10"
                        >
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="flex-grow pl-4">
                            <h2
                                class="font-medium title-font text-lg text-gray-900 mb-1 tracking-wider"
                            >
                                FINISH
                            </h2>
                        </div>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </section>
</template>
