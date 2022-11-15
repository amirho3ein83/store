

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

const addToCart = () => {
    props.product.is_in_cart = true;
    storeCart.addToCart(props.product.id)
};

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 1);
});
</script>

<template>
    {{product}}
    <Transition>
        <!-- <div v-if="showItem"
            class="flex  lg:w-1/5 md:w-1/4 sm:w-1/3 w-1/2 px-1 flex-col justify-center items-center max-w-sm mx-auto my-2">
            <img @click="storeProduct.showProduct(product.id)" src="./watch.webp" alt="" class="cursor-pointer" />
            <div class=" bg-gray-100 w-full shadow-lg  overflow-hidden">
                <div class="flex justify-between items-center">
                    <div class="py-2 text-center font-bold   text-gray-800">
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
                    <Link v-if="product.is_in_cart && $page.props.auth" :href="'/cart'"
                        class="bg-[#dbae1a] text-gray-700 px-2 rounded hover:underline">
                        in your cart
                    </Link>
                    <button v-else-if="$page.props.auth" @click="addToCart()" class="bg-gray-800 text-gray-100 px-2 rounded hover:underline">
                        add to cart
                    </button>
                </div>
            </div>
        </div> -->

        <a @click="storeProduct.showProduct(product.id)" class="block  lg:w-1/5 md:w-1/4 sm:w-1/3 w-1/2 ">
            <img alt="Headphones" src="./watch.webp" class="w-full object-cover" />

            <div class="mt-2 space-y-3">
                <div class="flex justify-between items-center">
                    <div class="py-2 text-center font-bold   text-gray-800">
                        {{ product.title }}
                    </div>
                    <div class="flex gap-2">
                        <p class="ml-2 text-sm font-bold text-yellow-700 dark:text-white">
                            {{ product.rate }}<i class="bi bi-star-fill text-yellow-500"></i>
                        </p>

                    </div>
                </div>


                <div class="flex justify-between text-xs">
                    <div class="flex gap-1">
                        <span class="block h-4 w-4 rounded-full bg-yellow-600"> </span>
                        <span class="block h-4 w-4 rounded-full bg-yellow-600"> </span>
                        <span class="block h-4 w-4 rounded-full bg-yellow-600"> </span>
                        <span class="block h-4 w-4 rounded-full bg-yellow-600"> </span>
                    </div>
                    <p>$299</p>
                </div>
            </div>
        </a>

    </Transition>
</template>

