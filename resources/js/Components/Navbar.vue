<script setup>
import { useCartStore } from "@/store/Cart.js";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import Dropdown from "@/Components/Dropdown.vue";
import { OrbitSpinner } from "epic-spinners";
import { computed, onMounted } from "vue";

const storeCart = useCartStore();

onMounted(() => {
    if (usePage().props.value.auth) {
        storeCart.countOrders();
    }
});
</script>

<template>
    <nav class="flex justify-between bg-gray-900 text-white w-screen">
        <div
            class="px-5 xl:px-12 py-2 flex w-full items-center justify-between"
        >
            <Link href="/home" preserve-scroll>
                <div class="flex items-center gap-x-1">
                    <OrbitSpinner
                        :animation-duration="3000"
                        :size="40"
                        color="#feffd4"
                    />
                    <h3
                        class="lg:text-4xl text-[#f3f5f0] pl-2 text-3xl font-bold font-heading"
                    >
                        𝓢𝓪𝓹𝓬𝓮 𝓼𝓽𝓸𝓻𝓮
                    </h3>
                </div>
            </Link>
            <!-- Nav Links -->
            <ul
                class="hidden lg:flex px-4 mx-auto text-lg font-heading space-x-12"
            >
                <Link href="/home" preserve-scroll>
                    <p class="hover:text-yellow-400">خانه</p>
                </Link>
                <Link href="/category" preserve-scroll>
                    <p class="hover:text-yellow-400">دسته بندی</p>
                </Link>

                <Link href="/contact-us" preserve-scroll>
                    <p class="hover:text-yellow-400">ارتباط با ما</p>
                </Link>
            </ul>
            <template v-if="$page.props.auth">
                <!-- Header Icons -->
                <div
                    class="hidden lg:flex items-center space-x-5"
                    v-if="$page.props.auth"
                >
                    <Link
                        class="relative flex"
                        href="/user/profile/liked-products"
                        preserve-scroll
                    >
                        <i class="bi bi-heart-fill text-red-500"></i>
                    </Link>

                    <Link class="relative flex" href="/cart" preserve-scroll>
                        <i class="bi bi-cart3 text-gray-50"></i>

                        <div
                            v-if="storeCart.count_cart != 0"
                            class="flex h-5 w-5 absolute -right-2 -top-1 text-center items-center justify-center align-baseline"
                        >
                            <span
                                class="animate-ping absolute flex justify-center h-full w-full rounded-full bg-[#11fa1d] opacity-75"
                            ></span>
                            <span
                                class="relative inline-flex justify-center text-gray-900 text-center w-5 h-5 p-0 m-0 rounded-full bg-[#11fa1d]"
                            >
                                {{ storeCart.count_cart }}
                            </span>
                        </div>
                    </Link>

                    <Link
                        class="relative flex"
                        href="/user/profile"
                        preserve-scroll
                    >
                        <i class="bi bi-person text-2xl"></i>
                    </Link>
                    <Link
                        class="relative flex"
                        :href="route('admin.dashboard')"
                        preserve-scroll
                    >
                        <div
                            v-if="$page.props.admin"
                            class="border-2 border-yellow-600 rounded-lg px-3 py-2 text-yellow-400 cursor-pointer hover:bg-yellow-600 hover:text-yellow-200"
                        >
                            پنل مدیریت
                        </div>
                    </Link>
                </div>
                <div class="lg:hidden items-center space-x-5 flex">
                    <Link class="relative flex" href="/cart" preserve-scroll>
                        <i class="bi bi-cart3 text-gray-50"></i>

                        <div
                            v-if="storeCart.count_cart != 0"
                            class="flex h-5 w-5 absolute -right-2 -top-1 text-center items-center justify-center align-baseline"
                        >
                            <span
                                class="animate-ping absolute flex justify-center h-full w-full rounded-full bg-[#11fa1d] opacity-75"
                            ></span>
                            <span
                                class="relative inline-flex justify-center text-gray-900 text-center w-5 h-5 p-0 m-0 rounded-full bg-[#11fa1d]"
                            >
                                {{ storeCart.count_cart }}
                            </span>
                        </div>
                    </Link>

                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <i class="bi bi-list text-3xl pl-2 sm:text-4xl"></i>
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

                            <Link
                                class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between"
                                href="/user/profile"
                                preserve-scroll
                            >
                                <p>بروفایل</p>
                                <i class="bi bi-person text-2xl"></i>
                            </Link>

                            <Link
                                class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between"
                                href="/home"
                                preserve-scroll
                            >
                                <p>خانه</p>
                                <i class="bi bi-house text-2xl"></i>
                            </Link>

                            <Link
                                class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between"
                                href="/category"
                                preserve-scroll
                            >
                                <p>دسته بندی</p>
                                <i class="bi bi-diagram-3 text-2xl"></i>
                            </Link>

                            <Link
                                class="relative flex px-4 align-baseline py-2 text-lg w-full justify-between"
                                href="/contact-us"
                                preserve-scroll
                            >
                                <p>ارتباط با ما</p>
                                <i class="bi bi-envelope-paper text-2xl"></i>
                            </Link>
                        </template>
                    </Dropdown>
                </div>
            </template>

            <div class="flex" v-else>
                <Link
                    :href="'/login'"
                    class=" text-gray-100 px-3 duration-100 hover:scale-110"
                >
                    لاگین
                </Link>
                <Link
                    :href="'/register'"
                    class=" text-gray-100 px-3 duration-100 hover:scale-110"
                >
                    ثبت نام
                </Link>
            </div>
        </div>
    </nav>
</template>
<style>
i {
    font-size: 26px;
}
</style>
