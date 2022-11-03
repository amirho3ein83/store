<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Hero2 from "@/Components/Hero2.vue";
import Pagination from "@/Components/Pagination.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import HorizontalScroll from "vue-horizontal-scroll";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";
defineProps({
    products: Object,
});
</script>

<template>
    <Head title="Store Page" />

    <AppLayout>
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
            <img src="./banner1.webp" alt="" class="w-full" />
            <div
                class="container mx-auto flex items-center flex-wrap pt-4 pb-12"
            >
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
                <div
                    class="flex-col flex bg-indigo-100 w-full "
                >
                    <p class="text-2xl text-indigo-500 p-3">
                        Amazing offers
                    </p>
                    <div class="flex   flex-wrap items-center justify-center">
                        <Hero2 />
                        <Hero2 />
                        <Hero2 />
                        <Hero2 />
                    </div>
                </div>
                <!-- component -->
                <!-- commerce slide cards -->
                <div style="background-color: #fff8f4" class="h-full">
                    <div class="container mx-auto lg:px-20">
                        <div class="flex h-full pb-40">
                            <div class="mx-3">
                                <div
                                    class="py-10 pb-3 mt-5 h-4/6 relative bg-purple-100 group hover:bg-purple-200 cursor-pointer transition ease-out duration-300"
                                >
                                    <div>
                                        <img
                                            src="https://i.ibb.co/FzkhpcD/pngegg.png"
                                            alt="https://www.pngegg.com/en/png-nllal/download"
                                        />
                                    </div>
                                    <div class="px-7 mt-20">
                                        <h1
                                            class="text-3xl font-bold group-hover:text-purple-300 transition ease-out duration-300"
                                        >
                                            01.
                                        </h1>
                                        <h2 class="text-1xl mt-4 font-bold">
                                            Roof light lamp
                                        </h2>
                                        <p
                                            class="mt-2 opacity-60 group-hover:opacity-70"
                                        >
                                            Diverse collection of roof lights of
                                            quality
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-3">
                                <div
                                    class="py-10 pb-3 mt-5 h-4/6 relative bg-indigo-100 group hover:bg-indigo-200 cursor-pointer transition ease-out duration-300"
                                >
                                    <div>
                                        <img
                                            src="https://i.ibb.co/MgnH44p/pngegg-2.png"
                                            alt="https://www.pngegg.com/en/png-epwii/download"
                                        />
                                    </div>
                                    <div class="px-7 mt-20">
                                        <h1
                                            class="text-3xl font-bold group-hover:text-indigo-300 transition ease-out duration-300"
                                        >
                                            02.
                                        </h1>
                                        <h2 class="text-1xl mt-4 font-bold">
                                            Lounge Chair
                                        </h2>
                                        <p
                                            class="mt-2 opacity-60 group-hover:opacity-70"
                                        >
                                            Comfortable collection of perfect
                                            lounge chairs
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-3">
                                <div
                                    class="py-10 pb-3 mt-5 h-4/6 relative bg-indigo-100 group hover:bg-indigo-200 cursor-pointer transition ease-out duration-300"
                                >
                                    <div>
                                        <img
                                            src="https://i.ibb.co/JB4GWMJ/pngegg-1.png"
                                            alt="https://www.pngegg.com/en/png-zquqj/download"
                                        />
                                    </div>
                                    <div class="px-7 mt-20">
                                        <h1
                                            class="text-3xl font-bold group-hover:text-indigo-300 transition ease-out duration-300"
                                        >
                                            02.
                                        </h1>
                                        <h2 class="text-1xl mt-4 font-bold">
                                            Lounge Chair
                                        </h2>
                                        <p
                                            class="mt-2 opacity-60 group-hover:opacity-70"
                                        >
                                            Comfortable collection of perfect
                                            lounge chairs
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <!-- https://dribbble.com/shots/15103214/attachments/6835973?mode=media -->
                <!-- </HorizontalScroll> -->

                <!-- /////////// -->
                <!-- component -->
                <div class="py-6">
                    <div
                        class="flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden"
                    >
                        <div
                            class="w-1/3 bg-cover"
                            style="
                                background-image: url('https://images.unsplash.com/photo-1494726161322-5360d4d0eeae?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80');
                            "
                        ></div>
                        <div class="w-2/3 p-4">
                            <h1 class="text-gray-900 font-bold text-2xl">
                                Backpack
                            </h1>
                            <p class="mt-2 text-gray-600 text-sm">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit In odit exercitationem fuga id
                                nam quia
                            </p>
                            <div class="flex item-center mt-2">
                                <svg
                                    class="w-5 h-5 fill-current text-gray-700"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"
                                    />
                                </svg>
                                <svg
                                    class="w-5 h-5 fill-current text-gray-700"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"
                                    />
                                </svg>
                                <svg
                                    class="w-5 h-5 fill-current text-gray-700"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"
                                    />
                                </svg>
                                <svg
                                    class="w-5 h-5 fill-current text-gray-500"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"
                                    />
                                </svg>
                                <svg
                                    class="w-5 h-5 fill-current text-gray-500"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"
                                    />
                                </svg>
                            </div>
                            <div class="flex item-center justify-between mt-3">
                                <h1 class="text-gray-700 font-bold text-xl">
                                    $220
                                </h1>
                                <button
                                    class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded"
                                >
                                    Add to Card
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
