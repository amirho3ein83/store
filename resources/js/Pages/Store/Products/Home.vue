<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Hero2 from "@/Components/Hero2.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import Slider from "@/Components/Slider.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";

defineProps({
    amazing_offers: Object,
});
</script>

<template>
    <Head title="Store Page" />

    <AppLayout class="bg-gray-100">
        <div
            class="carousel relative container mx-auto"
            style="max-width: 1600px"
        ></div>

        <!--     	 

Alternatively if you want to just have a single hero

<section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right" style="max-width:1600px; height: 32rem; background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">

<div class="container mx-auto">

    <div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
        <h1 class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</h1>
        <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">products</a>

    </div>

  </div>

</section>
-->
        <section class="bg-white">
            <!-- <img src="./pics/banner1.webp" alt="" class="w-full" /> -->
            <div class="flex px-16 py-4 bg-slate-50">
                <img
                    src="./pics/hero4.jpg"
                    alt=""
                    class="object-cover w-full"
                />
            </div>
            <div class="mx-auto flex items-center flex-wrap">
                <!-- <div class="flex">
                    <div class="flex flex-col">
                        <div class="flex flex-wrap">
                            <Product
                                v-for="product of products.data"
                                :product="product"
                                :key="product.id"
                            />
                        </div>
                        <Pagination
                            :nextPage="products.next_page_url"
                            :previousPage="products.prev_page_url"
                            :currentPage="products.current_page"
                        />
                    </div>
                </div> -->
                <!-- <HorizontalScroll> -->

                <div class="flex-col flex bg-gray-100 w-full">
                    <p class="text-2xl self-center text-indigo-500 p-3">
                        Amazing offers
                    </p>
                    <div
                        class="flex touch-pan-x overflow-x-scroll items-center justify-center"
                    >
                        <Hero2
                            v-for="amazing_offer of amazing_offers"
                            :key="amazing_offer.product_id"
                            :product="amazing_offer.product"
                            :remaining_time="amazing_offer.remaining_time"
                        />
                    </div>
                </div>

                <section class="flex h-full p-2 my-4">
                    <img
                        class="w-1/3 h-auto p-12 hover:scale-105 duration-200 transition object-cover active:scale-100"
                        src="https://i.pinimg.com/736x/a2/8a/2e/a28a2ec311907cea02fee60b3e26fc1c.jpg"
                        alt="https://www.pngegg.com/en/png-nllal/download"
                    />
                    <img
                        class="w-1/3 h-auto p-12 hover:scale-105 duration-200 transition object-cover active:scale-100"
                        src="https://i.pinimg.com/originals/5c/cb/8c/5ccb8cf7968659ba21f827a945cf4b22.jpg"
                        alt="https://www.pngegg.com/en/png-epwii/download"
                    />
                    <img
                        class="w-1/3 h-auto p-12 hover:scale-105 duration-200 transition object-cover active:scale-100"
                        src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/mens-clothing-sale-portrait-flyer-template-1627835dd392414eb308cf84fde379a1_screen.jpg?ts=1636966283"
                        alt="https://www.pngegg.com/en/png-zquqj/download"
                    />
                </section>

                <section class="flex h-full p-1 mx-auto">
                    <section class="overflow-hidden text-gray-700">
                        <div
                            class="container px-5 py-2 mx-auto lg:pt-24 lg:px-32"
                        >
                            <div class="flex flex-wrap -m-1 md:-m-2">
                                <div class="flex flex-wrap w-1/2">
                                    <div class="w-1/2 p-1 md:p-2">
                                        <img
                                            alt="gallery"
                                            class="block object-cover object-center w-full h-full rounded-lg"
                                            src="./pics/sh5.webp"
                                        />
                                    </div>
                                    <div class="w-1/2 p-1 md:p-2">
                                        <img
                                            alt="gallery"
                                            class="block object-cover object-center w-full h-full rounded-lg"
                                            src="./pics/sh6.webp"
                                        />
                                    </div>
                                    <div class="w-full p-1 md:p-2">
                                        <img
                                            alt="gallery"
                                            class="block object-cover object-center w-full h-full rounded-lg"
                                            src="./pics/sh7.jpg"
                                        />
                                    </div>
                                </div>
                                <div class="flex flex-wrap w-1/2">
                                    <div class="w-full p-1 md:p-2">
                                        <img
                                            alt="gallery"
                                            class="block object-cover object-center w-full h-full rounded-lg"
                                            src="./pics/13.webp"
                                        />
                                    </div>
                                    <div class="w-1/2 p-1 md:p-2">
                                        <img
                                            alt="gallery"
                                            class="block object-cover object-center w-full h-full rounded-lg"
                                            src="./pics/sh9.avif"
                                        />
                                    </div>
                                    <div class="w-1/2 p-1 md:p-2">
                                        <img
                                            alt="gallery"
                                            class="block object-cover object-center w-full h-full rounded-lg"
                                            src="./pics/sh11.jpeg"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>


            </div>

            <section
                class="relative w-5/6 mx-auto overflow-hidden rounded-lg p-10 my-7 80 shadow-2xl lg:pb-0"
            >
                <div class="ml-auto p-8 text-center sm:p-12 lg:w-2/3">
                    <p class="text-sm font-semibold uppercase tracking-widest">
                        Run with the pack
                    </p>

                    <h2 class="mt-6 font-black uppercase">
                        <span class="text-5xl font-black sm:text-6xl"
                            >Get 20% off</span
                        >
                        <span class="mt-2 block text-sm"
                            >On your next order over $50</span
                        >
                    </h2>

                    <a
                        class="mt-8 inline-block w-full bg-black py-4 text-sm font-bold uppercase tracking-widest text-white"
                        href=""
                    >
                        Get Discount
                    </a>

                    <p
                        class="mt-12 text-xs font-medium uppercase text-gray-400"
                    >
                        Offer valid until 24th March, 2021 *
                    </p>
                </div>

                <div
                    class="absolute bottom-0 left-0 h-80 w-full lg:h-full lg:w-1/3"
                >
                    <img
                        alt="Trainer"
                        src="https://images.unsplash.com/photo-1611510338559-2f463335092c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=928&q=80"
                        class="absolute inset-0 h-full w-full object-cover"
                    />
                </div>
            </section>
        </section>
    </AppLayout>
</template>
