<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Hero2 from "@/Components/Hero2.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import Slider from "@/Components/Slider.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";

defineProps({
    amazing_offers: Object,
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default{
  layout:AppLayout
}
</script>
<template>
    <Head title="Store Page" />
        <div
            class="carousel relative container mx-auto"
            style="max-width: 1600px"
        ></div>
        <section class="bg-white">
            <div class="relative overflow-hidden bg-no-repeat bg-cover" style="
      background-position: 50%;
      background-image: url('https://www.grandhotelgardone.it/images/slide/shopping/slides_shopping.jpg');
      height: 500px;
    ">
                <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
                    style="background-color: rgba(0, 0, 0, 0.75)">
                    <div class="flex justify-center items-center h-full">
                        <div class="text-center text-white px-6 md:px-12">
                            <h1 class="text-5xl md:text-6xl xl:text-7xl font-bold tracking-tight mb-12 text-cyan-400">
                                your best shopping experience <br /><span class="text-pink-600">starts here</span>
                            </h1>
                        </div>
                    </div>
                </div>
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
                    <p class="text-2xl text-center w-full bold bg-gray-900 text-yellow-500 p-3">
                        Amazing offers
                    </p>
                    <div
                        class="py-2 flex touch-pan-x overflow-x-scroll items-center justify-center"
                    >
                        <Hero2
                            v-for="amazing_offer of amazing_offers"
                            :key="amazing_offer.product_id"
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
                        src="https://i.pinimg.com/550x/e0/6d/bf/e06dbfa4febaea3a3735eba741626771.jpg"
                        class="absolute inset-0 h-full w-full object-cover"
                    />
                </div>
            </section>
        </section>
</template>
