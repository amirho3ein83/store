<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
defineProps({
    id: Number,
});
</script>

<template>
    <div class="flex gap-2">

        <Link href="/cart" preserve-scroll>
        <button
            class="transition ease-in duration-300 inbuttonne-flex items-center text-sm font-medium mb-2 md:mb-0 bg-[#e8a238] px-5 py-2 hover:shadow-lg tracking-wider text-slate-800 rounded-full hover:bg-[#c98e34]">
            <span>see in your cart</span>
        </button>
        </Link>
        <button @click="$emit('addanother')">
            <i
                class="bi bi-cart-plus-fill active:text-cyan-500 text-[25px] text-slate-600 duration-200 transition hover:scale-125 hover:shadow-xl"></i>
        </button>
    </div>
</template>
