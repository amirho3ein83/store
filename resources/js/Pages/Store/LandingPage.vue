<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Hero2 from "@/Components/Hero2.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import Slider from "@/Components/Slider.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";
import CategoryItem from "@/Components/CategoryItem.vue";

defineProps({
    amazing_offers: Object,
    categories: Object,
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <Head title="Store Page" />
    <div
        class="carousel relative container mx-auto"
        style="max-width: 1600px"
    ></div>
    <section class="">
        <div
            class="relative overflow-hidden bg-no-repeat bg-cover min-h-screen"
            style="
                background-position: 50%;
                background-image: url('https://cdn.searchenginejournal.com/wp-content/uploads/2022/07/shopify-store-examples-62d01563935c4-sej-1520x800.png');
                height: 500px;
            "
        >
            <div
                class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
                style="background-color: rgba(0, 0, 0, 0.75)"
            >
                <div class="flex justify-center items-center h-full">
                    <div class="text-center text-white px-6 md:px-12">
                        <h1
                            class="text-5xl md:text-6xl xl:text-7xl font-bold tracking-tight mb-12 text-cyan-400"
                        >
                            your best shopping experience <br /><span
                                class="text-pink-600"
                                >starts here</span
                            >
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <CategoryItem
                        v-for="category of categories"
                        :key="category.id"
                        :category="category"
                    />
                </div>
            </div>
        </section>

        <div class="relative overflow-hidden ">
            <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
                <div
                    class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8"
                >
                    <div class="sm:max-w-lg">
                        <h1
                            class="font text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
                        >
                            Summer styles are finally here
                        </h1>
                        <p class="mt-4 text-xl text-gray-500">
                            This year, our new summer collection will shelter
                            you from the harsh elements of a world that doesn't
                            care if you live or die.
                        </p>
                    </div>
                    <div>
                        <div class="mt-10">
                            <!-- Decorative image grid -->
                            <div
                                aria-hidden="true"
                                class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl"
                            >
                                <div
                                    class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8"
                                >
                                    <div
                                        class="flex items-center space-x-6 lg:space-x-8"
                                    >
                                        <div
                                            class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8"
                                        >
                                            <div
                                                class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100"
                                            >
                                                <img
                                                    src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg"
                                                    alt=""
                                                    class="h-full w-full object-cover object-center"
                                                />
                                            </div>
                                            <div
                                                class="h-64 w-44 overflow-hidden rounded-lg"
                                            >
                                                <img
                                                    src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg"
                                                    alt=""
                                                    class="h-full w-full object-cover object-center"
                                                />
                                            </div>
                                        </div>
                                        <div
                                            class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8"
                                        >
                                            <div
                                                class="h-64 w-44 overflow-hidden rounded-lg"
                                            >
                                                <img
                                                    src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg"
                                                    alt=""
                                                    class="h-full w-full object-cover object-center"
                                                />
                                            </div>
                                            <div
                                                class="h-64 w-44 overflow-hidden rounded-lg"
                                            >
                                                <img
                                                    src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg"
                                                    alt=""
                                                    class="h-full w-full object-cover object-center"
                                                />
                                            </div>
                                            <div
                                                class="h-64 w-44 overflow-hidden rounded-lg"
                                            >
                                                <img
                                                    src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-05.jpg"
                                                    alt=""
                                                    class="h-full w-full object-cover object-center"
                                                />
                                            </div>
                                        </div>
                                        <div
                                            class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8"
                                        >
                                            <div
                                                class="h-64 w-44 overflow-hidden rounded-lg"
                                            >
                                                <img
                                                    src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-06.jpg"
                                                    alt=""
                                                    class="h-full w-full object-cover object-center"
                                                />
                                            </div>
                                            <div
                                                class="h-64 w-44 overflow-hidden rounded-lg"
                                            >
                                                <img
                                                    src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-07.jpg"
                                                    alt=""
                                                    class="h-full w-full object-cover object-center"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a
                                href="#"
                                class="inline-block rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-center font-medium text-white hover:bg-indigo-700"
                                >Shop Collection</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto flex items-center flex-wrap">
            <div class="flex-col flex bg-gray-100 w-full">
                <p
                    class="text-2xl text-center w-full bold bg-gray-900 text-yellow-500 p-3"
                >
                    Amazing offers
                </p>
                <div
                    class="py-2 flex touch-pan-x bg-gray-900 overflow-x-scroll items-center justify-center"
                >
                    <!-- {{amazing_offers}} -->
                    <AmazingOffer
                        v-for="amazing_offer of amazing_offers"
                        :key="amazing_offer.id"
                        :amazing_offer="amazing_offer"
                    />
                </div>
            </div>

            <section class="flex flex-wrap h-full p-2 my-4 justify-center">
                <img
                    class="sm:w-1/3 w-[300px] h-auto sm:p-7 hover:scale-105 duration-200 transition object-cover active:scale-100"
                    src="https://i.pinimg.com/736x/a2/8a/2e/a28a2ec311907cea02fee60b3e26fc1c.jpg"
                    alt="https://www.pngegg.com/en/png-nllal/download"
                />
                <img
                    class="sm:w-1/3 w-[300px] h-auto sm:p-7 hover:scale-105 duration-200 transition object-cover active:scale-100"
                    src="https://i.pinimg.com/originals/5c/cb/8c/5ccb8cf7968659ba21f827a945cf4b22.jpg"
                    alt="https://www.pngegg.com/en/png-epwii/download"
                />
                <img
                    class="sm:w-1/3 w-[300px] h-auto sm:p-7 hover:scale-105 duration-200 transition object-cover active:scale-100"
                    src="https://9thwatchgroup.com/wp-content/uploads/2021/08/9th-Watch-Poster-01-01-scaled.jpg"
                    alt="https://www.pngegg.com/en/png-zquqj/download"
                />
            </section>

            <section class="flex h-full p-1 mx-auto">
                <section class="overflow-hidden text-gray-700">
                    <div class="container px-5 py-2 mx-auto lg:pt-24 lg:px-32">
                        <div class="flex flex-wrap -m-1 md:-m-2">
                            <div class="flex flex-wrap w-1/2">
                                <div class="w-1/2 p-1 md:p-2">
                                    <img
                                        alt="gallery"
                                        class="block object-cover object-center w-full h-full rounded-lg"
                                        src="./Products/pics/sh5.webp"
                                    />
                                </div>
                                <div class="w-1/2 p-1 md:p-2">
                                    <img
                                        alt="gallery"
                                        class="block object-cover object-center w-full h-full rounded-lg"
                                        src="./Products/pics/sh6.webp"
                                    />
                                </div>
                                <div class="w-full p-1 md:p-2">
                                    <img
                                        alt="gallery"
                                        class="block object-cover object-center w-full h-full rounded-lg"
                                        src="./Products/pics/sh7.jpg"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-wrap w-1/2">
                                <div class="w-full p-1 md:p-2">
                                    <img
                                        alt="gallery"
                                        class="block object-cover object-center w-full h-full rounded-lg"
                                        src="./Products/pics/13.webp"
                                    />
                                </div>
                                <div class="w-1/2 p-1 md:p-2">
                                    <img
                                        alt="gallery"
                                        class="block object-cover object-center w-full h-full rounded-lg"
                                        src="./Products/pics/sh9.avif"
                                    />
                                </div>
                                <div class="w-1/2 p-1 md:p-2">
                                    <img
                                        alt="gallery"
                                        class="block object-cover object-center w-full h-full rounded-lg"
                                        src="./Products/pics/sh11.jpeg"
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

                <p class="mt-12 text-xs font-medium uppercase text-gray-400">
                    Offer valid until 24th March, 2021 *
                </p>
            </div>

            <div
                class="absolute bottom-0 left-0 h-80 w-full lg:h-full lg:w-1/3"
            >
                <img
                    alt="Trainer"
                    src="https://i.pinimg.com/550x/e0/6d/bf/e06dbfa4febaea3a3735eba741626771.jpg"
                    class="absolute inset-0 h-full w-full object-cover"
                />
            </div>
        </section>
    </section>
</template>
