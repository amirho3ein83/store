<script setup>
import { onMounted, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useCartStore } from "@/store/Cart.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import Footer from "../Pages/Footer.vue";
import NavItem from "@/Components/NavItem.vue";
import { managePageStore } from "@/store/ManagePages";

const storePages = managePageStore();
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
        <nav id="header" class="w-full z-30 top-0">
            <div
                class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3"
            >
                <!-- <a href="/" class="text-2xl text-gray-200 cursor-pointer"
                    >Space Store</a
                > -->
                <div class="p-1">
                    <button
                        type="button"
                        class="rounded-lg flex max-w-sm w-full bg-gradient-to-r from-yellow-700 via-yellow-800 to-yellow-700 hover:from-yellow-600 hover:via-yellow-700 hover:to-yellow-800 focus:outline-none text-white text-2xl uppercase font-bold shadow-md mx-auto"
                    >
                        <div class="col-span-2 pt-1.5 p-2">Space Store</div>
                    </button>
                </div>
                <div class="flex border-b border-gray-100 text-sm font-medium">

                    <NavItem
                        :disabled="storePages.currentPage == 'Home'"
                        :page="`Home`"
                        :icon="`bi bi-house`"
                        :active="storePages.currentPage == 'Home'"
                    />
                    <NavItem
                        :disabled="storePages.currentPage == 'Cart'"
                        :page="`Cart`"
                        :icon="`bi bi-cart3`"
                        :active="storePages.currentPage == 'Cart'"
                    />
                    <a
                        href=""
                        class="-mb-px border-b border-transparent p-4 text-gray-200 hover:text-yellow-500"
                    >
                        Categories
                    </a>


                    <NavItem
                        :disabled="storePages.currentPage == 'Profile'"
                        :page="`Profile`"
                        :icon="`bi bi-person`"
                        :active="storePages.currentPage == 'Profile'"
                    />
                </div>

                <div
                    class="order-2 md:order-3 flex items-center"
                    id="nav-content"
                >

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
