<script setup>
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
defineProps({
    id: Number,
});
</script>

<template>
    <a href="/cart">
        <button
            class="w-full rounded bg-cyan-600 px-4 py-1 text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-cyan-500"
            href="/cart"
        >
            <span class="text-gray-900 bold">see your cart</span>
        </button>
    </a>
</template>
