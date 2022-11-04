<script setup>
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
defineProps({
    id: Number,
});
</script>

<template>
    <button
        class="w-full rounded bg-yellow-600 px-4 py-1  text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-yellow-500"
        @click="storeCart.addToCart(id)"
    >
       <span class="text-gray-900 bold"> add to cart</span>
    </button>
</template>
