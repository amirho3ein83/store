<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';

defineProps({
    terms: String,
});
</script>

<template>
    <Head title="Home" />

    <div class=" relative overflow-hidden bg-no-repeat bg-cover min-h-screen " style="
                                                                        background-position: 50%;
                                                                        background-image: url('https://www.getscriptordietryin.com/static/be48fb8239ca916105b998311b20326e/93719/header-laptop.jpg');
                                                                        height: 500px;
                                                                    ">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">

                <div class="hidden lg:flex gap-8">
                    <Link href="/home" preserve-scroll>
                    <p class="text-sm font-sans leading-6 text-gray-50">Home</p>
                    </Link>
                    <Link href="/about" preserve-scroll>
                    <p class="text-sm font-sans leading-6 text-gray-50">About</p>
                    </Link>
                    <Link href="/resume" preserve-scroll>
                    <p class="text-sm font-sans leading-6 text-gray-50">Resume</p>
                    </Link>
                    <Link href="/portfolio" preserve-scroll>
                    <p class="text-sm font-sans leading-6 text-gray-50">Portfolio</p>
                    </Link>
                </div>



                <div class="hidden lg:flex lg:flex-1 lg:justify-end">

                    <p class="text-sm font-sans leading-6 text-gray-200"> <i class="bi bi-phone"></i> +98 09135276034</p>
                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="lg:hidden" role="dialog" aria-modal="true">


                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-50"></div>

            </div>
        </header>

        <section class="overflow-hidden pt-24 pb-24 lg:pt-[290px] lg:pb-[100px] ">
            <div class="w-full lg:w-1/3">
                <div class="text-left  mx-auto flex flex-col items-center py-12 sm:py-24">
                    <div class="w-11/12 sm:w-2/3 lg:flex justify-center items-center flex-col  mb-5 sm:mb-10">
                        <h1
                            class="pb-2 text-2xl border-b-2 sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl  text-gray-200 font-normal leading-7 md:leading-10">
                            Amirhossein
                            <br>
                            <span class="text-gray-200 font-black text-5xl">Shafee Hosseini</span>
                        </h1>
                        <p class="lg:w-10/12 text-gray-300 font-normal text-center text-sm sm:text-lg pt-6">Full Stack
                            Web
                            Developer
                        </p>
                    </div>
                    <div class="flex justify-center items-center gap-4">

                        <Link href="/resume" preserve-scroll>
                        <p
                            class="text-sm font-sans leading-6 text-gray-50 border-2 border-gray-200 rounded-lg px-6 py-2 text-gray-200 cursor-pointer hover:text-gray-200">
                            Resume</p>
                        </Link>

                        <Link href="/portfolio" preserve-scroll>
                        <p
                            class="text-sm font-sans leading-6 border-2 border-gray-200 rounded-lg px-6 py-2 text-gray-200 cursor-pointer hover:text-gray-200">
                            Portfolio</p>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
</div></template>
