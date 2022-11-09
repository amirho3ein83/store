<script setup>
import { useCartStore } from "@/store/Cart.js";
import { Link } from "@inertiajs/inertia-vue3";

const storeCart = useCartStore();
</script>

<template>
    <!-- component -->
    <!-- follow me on twitter @asad_codes -->

    <div class="flex flex-wrap place-items-center">
        <section class="relative mx-auto">
            <!-- navbar -->
            <nav class="flex justify-between bg-gray-900 text-white w-screen">
                <div class="px-5 xl:px-12 py-4 flex w-full items-center justify-between">
                    <Link href="/home" preserve-scroll>
                        <h3 class="text-3xl font-bold font-heading">
                            <i class="bi bi-slack text-yellow-500"></i> Space
                            Store
                        </h3>
                    </Link>
                    <!-- Nav Links -->
                    <ul
                        class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12"
                    >
                        <Link href="/home" preserve-scroll>
                            <p class="hover:text-yellow-400">Home</p>
                        </Link>
                        <Link href="/category" preserve-scroll>
                            <p class="hover:text-yellow-400">Catagory</p>
                        </Link>
                        <Link href="/contact-us" preserve-scroll>
                            <p class="hover:text-yellow-400">Contact Us</p>
                        </Link>
                    </ul>
                    <!-- Header Icons -->
                    <div class="flex items-center space-x-5">
                        <Link
                            class="relative flex"
                            href="/user/profile/liked-products"
                            preserve-scroll
                        >
                            <i class="bi bi-heart-fill text-red-500"></i>
                        </Link>
                        <Link
                            class="relative flex"
                            href="/cart"
                            preserve-scroll
                        >
                            <i class="bi bi-cart3 text-gray-50"></i>

                            <span
                                v-if="storeCart.count_cart != 0"
                                class="absolute -right-1 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm leading-tight text-center"
                            >
                                {{ storeCart.count_cart }}
                            </span>
                        </Link>

                        <Link
                            class="relative flex"
                            href="/user/profile"
                            preserve-scroll
                        >
                            <i class="bi bi-person text-2xl"></i>
                        </Link>
                    </div>
                </div>

            </nav>
        </section>
    </div>
</template>
