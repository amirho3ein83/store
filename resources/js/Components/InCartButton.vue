<script setup>
import { useCartStore } from "@/store/Cart.js";
import { Link } from "@inertiajs/inertia-vue3";

const storeCart = useCartStore();
defineProps({
    id: Number,
});
</script>

<template>
    <div class="flex gap-2">

        <Link href="/cart" preserve-scroll>
        <button
            class="w-full rounded-xl bg-cyan-500 px-4 py-2 text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-cyan-500">
            <span class="text-gray-900 bold font-thin text-lg">
                in your cart</span>
        </button>
        </Link>
        <button @click="storeCart.addToCart(id)" type="button"
            class="rounded-xl bg-indigo-400 p-2 duration-200 transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-cyan-500">
            <i class="bi bi-cart-plus-fill text-slate-700"></i>
        </button>
    </div>
</template>
