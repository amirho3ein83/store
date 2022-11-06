<script setup>
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
</script>

<template>
    <!-- component -->
    <!-- follow me on twitter @asad_codes -->

    <div class="flex flex-wrap place-items-center">
        <section class="relative mx-auto">
            <!-- navbar -->
            <nav class="flex justify-between bg-gray-900 text-white w-screen">
                <div class="px-5 xl:px-12 py-4 flex w-full items-center">
                    <a class="text-3xl font-bold font-heading" href="home">
                        <!-- <img class="h-9" src="logo.png" alt="logo"> -->
                        <i class="bi bi-slack text-yellow-500"></i> Space Store
                    </a>
                    <!-- Nav Links -->
                    <ul
                        class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12"
                    >
                        <li>
                            <a class="hover:text-yellow-400" href="home"
                                >Home</a
                            >
                        </li>
                        <li>
                            <a class="hover:text-yellow-400" href="/category"
                                >Catagory</a
                            >
                        </li>

                        <li>
                            <a class="hover:text-yellow-400" href="/contact-us"
                                >Contact Us</a
                            >
                        </li>
                    </ul>
                    <!-- Header Icons -->
                    <div class="hidden xl:flex items-center space-x-5">
                        <a class="hover:text-gray-200" href="#">
                            <i class="bi bi-heart-fill text-red-500"></i>
                        </a>

                        <li
                            class="font-sans block mt-4 lg:inline-block lg:mt-0 lg:ml-6 align-middle text-black hover:text-gray-700"
                        >
                            <a href="/cart" role="button" class="relative flex">
                                <i class="bi bi-cart3 text-gray-50"></i>

                                <span
                                    class="absolute -right-1 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm leading-tight text-center"
                                    >{{ storeCart.count_cart }}
                                </span>
                            </a>
                        </li>
                        <!-- Sign In / Register      -->
                        <a
                            class="flex items-center hover:text-gray-200"
                            href="/user/profile"
                        >
                            <i class="bi bi-person text-2xl"></i>
                        </a>
                    </div>
                </div>
                <!-- Responsive navbar -->
                <a class="xl:hidden flex mr-6 items-center" href="#">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 hover:text-gray-200"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                        />
                    </svg>
                    <span class="flex absolute -mt-5 ml-4">
                        <span
                            class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"
                        ></span>
                        <span
                            class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"
                        >
                        </span>
                    </span>
                </a>
                <a class="navbar-burger self-center mr-12 xl:hidden" href="#">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 hover:text-gray-200"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </a>
            </nav>
        </section>
    </div>
</template>
