<script setup>
import { onMounted, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useCartStore } from "@/store/Cart.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import Footer from "../Pages/Footer.vue";
import Navbar from "@/Components/Navbar.vue";
import { managePageStore } from "@/store/ManagePages";
import { Head } from "@inertiajs/inertia-vue3";

const storePages = managePageStore();
const storeCart = useCartStore();

const logout = () => {
    Inertia.post(route("logout"));
};

onMounted(() => {
    storeCart.countOrders();
});
</script>

<template>
    <div
        class="bg-gray-100  work-sans leading-normal text-base tracking-normal"
    >
        <Navbar />

        <slot />

        <Footer />
    </div>
</template>

<style>
i {
    font-size: 24px;
}
/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
