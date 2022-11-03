<script setup>
import { onMounted, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useCartStore } from "@/store/Cart.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import Footer from "../Pages/Footer.vue";

const storeCart = useCartStore();

const logout = () => {
    Inertia.post(route("logout"));
};

onMounted(() => {
    storeCart.countCartItems();
});
</script>

<template>
    <body
        class="bg-gray-800 text-gray-600 work-sans leading-normal text-base tracking-normal"
    >
        <!--Nav-->
        <nav id="header" class="w-full z-30 top-0 ">
            <div
                class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3"
            >
                <a href="/" class="text-2xl text-gray-200 cursor-pointer"
                    >Space Store</a
                >
                <div class="flex border-b border-gray-100 text-sm font-medium">
                    <a
                        href=""
                        class="-mb-px border-b border-current p-4 text-yellow-500"
                    >
                        Home
                    </a>

                    <a
                        href=""
                        class="-mb-px border-b border-transparent p-4 text-gray-200 hover:text-yellow-500"
                    >
                        Categories
                    </a>

                    <a
                        href=""
                        class="-mb-px border-b border-transparent p-4 text-gray-200 hover:text-yellow-500"
                    >
                    <i class="bi bi-cart3"></i>
                        cart
                    </a>
                    <a
                        href=""
                        class="-mb-px border-b border-transparent p-4 text-gray-200 hover:text-yellow-500"
                    >
                    <i class="bi bi-person"></i>
                        My profile
                    </a>


                </div>

                <div
                    class="order-2 md:order-3 flex items-center"
                    id="nav-content"
                >
                    <a
                        class="pl-3 relative no-underline text-gray-200 hover:text-gray-400"
                        href="#"
                    >
                        <i class="bi bi-person"></i>
                    </a>

                </div>
            </div>
        </nav>

        <slot />

        <Footer />
    </body>
</template>

<style>
i {
    font-size: 24px;
}
</style>
