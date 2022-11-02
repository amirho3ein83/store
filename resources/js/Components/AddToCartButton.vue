<script setup>
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
defineProps({
    id: Number,
});
</script>

<template>
    <button
        class="inline-block rounded bg-yellow-600 px-8 py-2 text-sm font-medium text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-yellow-500"
        @click="storeCart.addToCart(id)"
    >
        add to cart
    </button>
</template>
