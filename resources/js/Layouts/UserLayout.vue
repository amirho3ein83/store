<script setup>
import UserSidebar from "@/Components/UserSidebar.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

import "bootstrap-icons/font/bootstrap-icons.css";
</script>

<template>
    <AppLayout>
        <div class="py-8 px-7 bg-gray-500">
            <div class="p-8 bg-gray-300 shadow mt-4">
                <div class="flex justify-between">
                    <div
                        class="space-x-8 flex justify-between mt-4 md:mt-0 md:justify-center"
                    >
                        <h1 class="text-4xl font-medium text-gray-700">
                            {{ $page.props.user.name }}
                        </h1>
                    </div>
                    <nav
                        class="flex gap-4 align-baseline justify-between order-last md:order-first mt-4 md:mt-0"
                    >
                        <a
                            href="/liked-products"
                            class="flex hover:bg-gray-800 duration-150 transition hover:scale-105 cursor-pointer active:scale-100 items-center py-0 rounded-xl bg-gray-700 px-2"
                        >
                            <i class="bi bi-heart-fill text-red-600"></i>
                            <span class="p-2 text-gray-50">Liked</span>
                        </a>

                        <a
                            href="/user/purchases"
                            class="flex hover:bg-gray-800 duration-150 transition hover:scale-105 cursor-pointer active:scale-100 items-center py-0 rounded-xl bg-gray-700 px-2"
                        >
                            <i class="bi bi-bag text-yellow-500"></i>
                            <span class="p-2 text-gray-50">my purchases</span>
                        </a>
                        <a
                            href="/user/profile/wallet"
                            class="flex hover:bg-gray-800 duration-150 transition hover:scale-105 cursor-pointer active:scale-100 items-center py-0 rounded-xl bg-gray-700 px-2"
                        >
                            <i class="bi bi-wallet text-sky-500"></i>
                            <span class="p-2 text-gray-50">my wallet</span>
                        </a>
                        <a
                            href="/user/profile/address"
                            class="flex hover:bg-gray-800 duration-150 transition hover:scale-105 cursor-pointer active:scale-100 items-center py-0 rounded-xl bg-gray-700 px-2"
                        >
                            <i class="bi bi-wallet text-fuchsia-500"></i>
                            <span class="p-2 text-gray-50">my address</span>
                        </a>
                        <a
                            href="/user/recent-visits"
                            class="flex hover:bg-gray-800 duration-150 transition hover:scale-105 cursor-pointer active:scale-100 items-center py-0 rounded-xl bg-gray-700 px-2"
                        >
                            <i class="bi bi-wallet text-green-500"></i>
                            <span class="p-2 text-gray-50">recent visits</span>
                        </a>

                        <Logout />
                    </nav>
                </div>

                <slot />
                <!-- <div class="mt-20 text-center border-b pb-12">
                    <div
                        class="flex align-baseline content-center justify-center"
                    >
                        <div
                            class="self-center rounded-xl h-1/2 w-[370px] border border-gray-700 bg-gray-800 p-4"
                        >
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-white">
                                        address
                                    </h3>
                                </div>
                            </div>

                            <ul class="mt-4 space-y-2">
                                <li>
                                    <a
                                        href="#"
                                        class="block h-full rounded-lg border border-gray-700 p-4 hover:border-pink-600"
                                    >
                                        <strong class="font-medium text-white"
                                            >recipient :
                                            {{ address.recipient_name }}</strong
                                        >

                                        <p
                                            class="mt-1 text-xs font-medium text-gray-300"
                                        >
                                            {{ address.text }}
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <WalletCard :balance="wallet.balance" />
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </AppLayout>
</template>
