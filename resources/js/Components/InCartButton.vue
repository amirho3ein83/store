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
            class="transition ease-in duration-300 inbuttonne-flex items-center text-sm font-medium mb-2 md:mb-0 bg-purple-500 px-5 py-2 hover:shadow-lg tracking-wider text-white rounded-full hover:bg-purple-600">
            <span>see in your cart</span>
        </button>
        </Link>
        <button @click="$emit('addanother')">
            <i
                class="bi bi-cart-plus-fill active:text-cyan-500 text-[25px] text-slate-200 duration-200 transition hover:scale-125 hover:shadow-xl"></i>
        </button>
    </div>
</template>
