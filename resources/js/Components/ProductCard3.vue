<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

defineProps({
    product: Object,
});

</script>

<template>
    <button @click="storeProduct.showProduct(product.id)" class="group block overflow-hidden">
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
    </button>
</template>
