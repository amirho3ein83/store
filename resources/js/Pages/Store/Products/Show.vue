<script setup>
import AddToCartButton from "@/Components/AddToCartButton.vue";
import ProductCard5 from "@/Components/ProductCard5.vue";
import CommentForm from "@/Pages/Store/Partial/CommentForm.vue";
import Comment from "@/Components/Comment.vue";
import { computed, ref } from "vue";
import { useProductStore } from "@/store/Product.js";
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
const storeProduct = useProductStore();

let props = defineProps({
    similar_products: Object,
    product: Object,
    comments: Object,
});

let picked_color = ref(props.product.available_colors[0]);
let price = ref(props.product.available_colors[0].pivot.price);

let is_liked = ref(props.product.is_liked);

const chooseColor = (color) => {
    picked_color.value = color;
    price.value = color.pivot.price;
};

const likeProduct = (id) => {
    is_liked.value = true;
    storeProduct.likeProduct(id);
};
const unlikeProduct = (id) => {
    is_liked.value = false;
    storeProduct.unlikeProduct(id);
};

const addToCart = () => {
    storeCart.addToCart(props.product.id, picked_color.value.id);
};
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>


<template>
    <!-- component -->
    <section class="text-gray-700 body-font overflow-hidden bg-white ">
        <div class="lg:container px-5 lg:py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">


                <div class="md:w-1/2 mx-md:auto w-full">
                    <div class="relative h-62 w-full mb-3">
                        <div v-if="$page.props.auth" class="absolute flex flex-col top-0 right-0 p-3">
                            <button v-if="is_liked" @click="unlikeProduct(product.id)"
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center pt-1.5">
                                <i class="bi bi-heart-fill text-red-600"></i>
                            </button>

                            <button v-else @click="likeProduct(product.id)"
                                class="transition ease-in duration-75 active:scale-100 hover:scale-105 bg-gray-800 hover:text-purple-500 shadow hover:shadow-md text-gray-500 rounded-full w-9 h-9 text-center pt-1.5">
                                <i class="bi bi-heart text-red-600"></i>
                            </button>
                        </div>

                        <img :src="product.image_url" alt="Just a flower"
                            class="object-contain h-full w-full sm:rounded-2xl" />
                    </div>


                </div>

                <!-- <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="https://www.whitmorerarebooks.com/pictures/medium/2465.jpg"> -->
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"> {{ product.title }}</h1>
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">BRAND NAME</h2>
                    <div class="flex mb-4">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 -translate-y-1 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <span class="p-1">{{ product.rate }}</span>

                            <span class="text-gray-600 ml-3"> {{ product.reviews }} Reviews</span>
                        </span>

                    </div>
                    <p class="leading-relaxed"> </p>
                    <div class="my-4 text-slate-700">
                        <h2 class="text-md p-2 text-left">Description</h2>
                        <p class="text-slate-600  break-words">
                            {{ product.description }}
                        </p>
                    </div>

                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                        <div class="flex ">
                            <span class="mr-3  self-end">Color</span>
                            <div class="w-full ">
                                <div class="flow-root">
                                    <div class="-m-0.5 flex flex-wrap justify-end pt-4 sm:pt-1">
                                        <ul class="flex flex-wrap justify-center items-center space-x-2">
                                            <button v-for="color of product.available_colors" :key="color.id"
                                                @click="chooseColor(color)">
                                                <span :class="{
                                                    'border-slate-500':
                                                        picked_color.en_name ==
                                                        color.en_name,
                                                }"
                                                    class="block p-0.5 border-[0.5px]  rounded-full transition ease-in duration-100">
                                                    <div class="flex gap-1">
                                                        <span :style="{
                                                            backgroundColor:
                                                                color.en_name,
                                                        }" class="block w-6 h-6 rounded-full border"></span>

                                                    </div>
                                                </span>
                                            </button>
                                        </ul>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="flex  justify-between">
                        <h3 class="text-xl text-yellow-800 font-semibold mt-1">
                            {{ price.toLocaleString("ar-EG") }}
                            <span class="text-stone-800">تومان</span>
                        </h3>

                        <div class="flex items-center">
                            <div class="flex space-x-2 text-sm font-medium justify-start">
                                <Link href="/login" v-if="!$page.props.auth"
                                    class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200">
                                First login </Link>
                                <AddToCartButton v-else :id="product.id" @pressed="addToCart()" />
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lg:py-16 flex flex-col justify-center items-center bg-white"
        v-if="Object.keys(product.comments).length != 0">
        <CommentForm :product_id="product.id" />
        <div v-if="$page.props.auth" class="lg:w-1/2 w-full px-4 lg:py-6">
            <div class="flex justify-between items-center space-x-2">

                <h2 class="text-lg p-4 font-bold text-blue-900 dark:text-white">
                    <span class="px-2">{{ (Object.keys(product.comments).length).toLocaleString("ar-EG") }} </span>
                    <span>نظر</span>
                </h2>
                <h2 class="text-lg lg:text-xl p-4 font-bold text-gray-700 dark:text-white">
                    دیدگاه کاربران
                </h2>
            </div>
            <Comment v-for="comment of product.comments" :key="comment.id" :comment="comment" />
        </div>
    </section>
    <!-- <section class="text-gray-600 body-font bg-white">
        <div class="container px-5 py-8 mx-auto">
            <h3 class="text-2xl text-slate-800 py-8 bg-white">محصولات مشابه</h3>
            <div class="flex flex-wrap -m-4 justify-center">
                <ProductCard5
                    v-for="product of similar_products"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </div>
    </section> -->
    <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight py-6 text-gray-800 ">محصولات مشابه </h2>

            <div class="flex flex-wrap  justify-center">
                <ProductCard5 v-for="product of similar_products" :key="product.id" :product="product" />

                <!-- More products... -->
            </div>
        </div>
    </div>
</template>
<style scoped>
i {
    font-size: 22px;
}

.picked-color {
    border-color: v-bind(color);
}
</style>
