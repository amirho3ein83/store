

<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
const storeProduct = useProductStore();

let showItem = ref(false);

let props = defineProps({
    product: Object,
});

const addToCart = (id) => {
    props.product.is_in_cart = true;
    storeCart.addToCart( props.product.id)
};

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 1);
});
</script>

<template>
    <Transition>
        <div v-if="showItem"
            class="flex lg:w-1/5 md:w-1/4 sm:w-1/3 w-1/2 px-1 flex-col justify-center items-center max-w-sm mx-auto my-2">
            <img @click="storeProduct.showProduct(product.id)" src="./watch.webp" alt="" class="cursor-pointer"/>
            <div class=" bg-gray-100 w-full shadow-lg  overflow-hidden">
                <div class="flex justify-between items-center">
                    <div class="py-2 text-center font-bold uppercase tracking-wide text-gray-800">
                        {{ product.title }}
                    </div>
<div class="flex gap-2">
    <p class="ml-2 text-sm font-bold text-yellow-700 dark:text-white">
                        {{ product.rate }}<i class="bi bi-star-fill text-yellow-500"></i>
                    </p>
                    <p class="text-sm font-medium text-slate-900 underline hover:no-underline dark:text-white">{{
                            product.reviews
                    }}
                        reviews</p>
</div>
                </div>

                <span class="truncate text-xs h-24 text-slate-600 mx-2">
                    {{ product.description }}
                </span>
                <div class="flex items-center justify-between py-2 px-3 bg-gray-400">
                    <h1 class="text-gray-800 font-bold">
                        $<span class="text-yellow-800">{{ product.price }}</span>
                    </h1>
                    <button v-if="product.is_in_cart" @click="storeCart.addToCart(id)" class="bg-[#dbae1a] text-gray-700 px-2 rounded hover:underline">
                        in your cart
                    </button>
                    <button v-else @click="addToCart()" class="bg-gray-800 text-gray-100 px-2 rounded hover:underline">
                        add to cart
                    </button>
                </div>
            </div>
        </div>
    </Transition>
</template>

    <!-- <button @click="storeProduct.showProduct(product.id)" class="lg:w-1/5 md:w-1/3 sm:w-1/2 p-4 w-full group block overflow-hidden">
        <img src="../Pages/Store/Products/pics/sh5.webp" alt="Tee"
            class="h-[350px] w-full object-cover transition-transform duration-300 group-hover:scale-105 sm:h-[250px]" />
        <div class="relative pt-4">

            <h3 class="text-xl text-yellow-500 group-hover:underline group-hover:underline-offset-4">
                {{ product.title }}
            </h3>
            <span class="truncate h-24 text-slate-200 mx-2">
                {{ product.description }}
            </span>
            <p class="text-sm font-medium text-slate-400 underline hover:no-underline dark:text-white">{{
                    product.reviews
            }}
                reviews</p>
            <p class="mt-2">
            <div class="flex justify-between">

                <span class="tracking-wider text-teal-200">
                    ${{ product.price }}
                </span>
                <span class="flex">
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <p class="ml-2 text-sm font-bold text-cyan-500 dark:text-white">
                        {{ product.rate }}
                    </p>
                </span>
            </div>
            </p>
        </div>
    </button> -->
