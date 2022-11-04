<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Product from "@/Components/Product.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import CategoryItem from "@/Components/CategoryItem.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";

defineProps({
    products: Object,
    categories: Object,
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
            <!-- <img src="./pics/banner1.webp" alt="" class="w-full" /> -->
            <!-- <Slider /> -->
            <div class="mx-auto flex items-center flex-wrap">
                <!-- categories -->

                <section class="grid grid-cols-5 gap-4 p-20">
                    <CategoryItem
                        v-for="category of categories"
                        :key="category.id"
                        :category="category"
                    />
                </section>

                <!-- <div class="flex">
                    <div class="flex flex-col">
                        <div class="flex">
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

                <!-- <div class="flex-col flex bg-gray-100 w-full">
                    <p class="text-2xl self-center text-indigo-500 p-3">
                        Amazing offers
                    </p>
                    <div
                        class="flex touch-pan-x overflow-x-auto items-center justify-center"
                    >
                        <Hero2
                            v-for="amazing_offer of amazing_offers"
                            :key="amazing_offer.product_id"
                            :product="amazing_offer.product"
                            :remaining_time="amazing_offer.remaining_time"
                        />
                    </div>
                </div> -->

            </div>
        </section>
    </AppLayout>
</template>
