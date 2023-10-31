<script setup>
import { useCartStore } from "@/store/Cart.js";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import Dropdown from "@/Components/Dropdown.vue";
import { OrbitSpinner } from "epic-spinners";
import { computed, onMounted } from "vue";

const storeCart = useCartStore();

const props = defineProps({
    dark:Boolean,
    snipperColor:String,
});

onMounted(() => {
    if (usePage().props.value.auth) {
        storeCart.countOrders();
    }
});
</script>

<template>
                <nav class="flex items-center justify-between px-6 py-4 lg:px-8" aria-label="Global" >

                    <div class="flex lg:flex-1">

                        <div class="flex items-center space-x-4 ">
                            <Link href="/home" preserve-scroll>
                            <OrbitSpinner :animation-duration="3000" :size="40" :color="snipperColor" />

                            </Link>
                            <div class="font-medium dark:text-white">
                                <p    class="text-slate-100 text-lg" :class="{ '!text-gray-700': dark }">Space Store</p>

                            </div>
                        </div>
                    </div>
                    <div class="flex lg:hidden">
                        <button type="button"
                            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden lg:flex lg:gap-x-12">
                        <Link href="/home" preserve-scroll>
                        <p class="text-md font-semibold leading-6 text-gray-200">Home</p>
                        </Link>
                        <Link :href="route(`category.list`)" preserve-scroll>
                        <p class="text-md font-semibold leading-6 text-gray-200">Categories</p>
                        </Link>
                        <Link href="/contact-us" preserve-scroll>
                        <p class="text-md font-semibold leading-6 text-gray-200">Contact us</p>
                        </Link>

                    </div>

                    <div v-if="$page.props.auth" class="hidden lg:flex lg:flex-1 lg:justify-end">


                        <Link :href="route('user.profile')" class="text-gray-100 px-3 duration-100 hover:opacity-80">

                        <div class="flex items-center space-x-4">
                            <img class="w-10 h-10 rounded-full"
                                src="https://img.freepik.com/premium-vector/man-avatar-profile-picture-vector-illustration_268834-538.jpg"
                                alt="profile">
                            <div class="font-medium dark:text-white">
                                <p class="text-slate-50">{{ $page.props.user.name }}</p>
                            </div>
                        </div>
                        </Link>
                    </div>

                    <div v-else class="hidden lg:flex lg:flex-1 lg:justify-end">
                        <Link href="/login" class="text-gray-100 px-3 duration-100 hover:scale-110">

                        <p class="text-md font-semibold leading-6 text-gray-200">sign in</p>
                        </Link>
                        <Link href="/register" class="text-gray-100 px-3 duration-100 hover:scale-110">

                        <p class="text-md font-semibold leading-6 text-gray-200">sign up</p>
                        </Link>
                    </div>
                </nav>
</template>
<style>
i {
    font-size: 26px;
}
</style>
