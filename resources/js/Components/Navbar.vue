<script setup>
import { useCartStore } from "@/store/Cart.js";
import { Link } from "@inertiajs/inertia-vue3";
import Dropdown from "@/Components/Dropdown.vue";

const storeCart = useCartStore();
</script>

<template>


    <div class="flex flex-wrap place-items-center">
        <section class="relative mx-auto">
            <!-- navbar -->
            <nav class="flex justify-between bg-gray-900 text-white w-screen">
                <div class="px-5 xl:px-12 py-2 flex w-full items-center justify-between">
                    <Link href="/home" preserve-scroll>
                    <h3 class="lg:text-3xl text-xl font-bold font-heading">
                        <i class="bi bi-slack text-yellow-500"></i> Space
                        Store
                    </h3>
                    </Link>
                    <!-- Nav Links -->
                    <ul class="hidden lg:flex px-4 mx-auto font-semibold font-heading space-x-12">
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
                    <template v-if="$page.props.auth">
                        <!-- Header Icons -->
                        <div class="hidden lg:flex items-center space-x-5" v-if="$page.props.auth">
                            <Link class="relative flex" href="/user/profile/liked-products" preserve-scroll>
                            <i class="bi bi-heart-fill text-red-500"></i>
                            </Link>

                            <Link class="relative flex" href="/cart" preserve-scroll>
                            <i class="bi bi-cart3 text-gray-50"></i>

                            <span v-if="storeCart.count_cart != 0"
                                class="absolute -right-1 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm leading-tight text-center">
                                {{ storeCart.count_cart }}
                            </span>
                            </Link>

                            <Link class="relative flex" href="/user/profile" preserve-scroll>
                            <i class="bi bi-person text-2xl"></i>
                            </Link>
                            <Link class="relative flex" href="/admin/dashboard" preserve-scroll>
                                <div
                            v-if="$page.props.admin"
                                class="border-2 border-yellow-600 rounded-lg px-3 py-2 text-yellow-400 cursor-pointer hover:bg-yellow-600 hover:text-yellow-200">
                                Admin Panel
                            </div>                            </Link>
    
                        </div>
                        <div class=" lg:hidden items-center space-x-5 flex">

                            <!-- 
                        <Link class="relative flex" href="/cart" preserve-scroll>
                        <i class="bi bi-cart3 text-gray-50"></i>

                        <span v-if="storeCart.count_cart != 0"
                            class="absolute -right-1 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm leading-tight text-center">
                            {{ storeCart.count_cart }}
                        </span>
                        </Link> -->

                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <i class="bi bi-list text-lg sm:text-4xl"></i>
                                    <!-- <i
                            class="mr-5 bi bi-burger  text-gray-200"
                        ></i> -->
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <!-- <div
                                        class="block px-4 py-2 text-xs text-gray-400"
                                    >
                                        Manage Account
                                    </div> -->


                                    <Link class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between "
                                        href="/user/profile" preserve-scroll>
                                    <p>Profile</p>
                                    <i class="bi bi-person text-2xl"></i>
                                    </Link>

                                    <Link class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between "
                                        href="/home" preserve-scroll>
                                    <p>Home</p>
                                    <i class="bi bi-house text-2xl"></i>
                                    </Link>

                                    <Link class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between "
                                        href="/category" preserve-scroll>
                                    <p>Catagory</p>
                                    <i class="bi bi-diagram-3 text-2xl"></i>
                                    </Link>

                                    <Link class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between "
                                        href="/contact-us" preserve-scroll>
                                    <p>Contact us </p>
                                    <i class="bi bi-envelope-paper text-2xl"></i>
                                    </Link>

                                </template>
                            </Dropdown>
                        </div>
                    </template>

                    <div class="flex" v-else>
                        <Link :href="'/login'" class="underline text-cyan-400 px-2 hover:brightness-50">
                        Login
                        </Link>
                        <Link :href="'/register'" class="underline text-green-400 px-2 hover:brightness-50">
                        Sign up
                        </Link>
                    </div>
                </div>
            </nav>
        </section>
    </div>
</template>
