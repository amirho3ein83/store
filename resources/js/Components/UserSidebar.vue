<script setup>
import Logout from "../Pages/Logout.vue";
</script>

<template>
    <div
        class="h-full  py-8  lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900"
    >
        <a
            class="text-3xl text-yellow-50 my-5 font-bold font-heading"
            href="/home"
        >
            <!-- <img class="h-9" src="logo.png" alt="logo"> -->
            <i class="bi bi-slack text-yellow-500"></i> Space Store
        </a>


        <div
            class="text-left py-7 text-lg mt-2 w-4/5 mx-auto text-gray-200 font-bold"
            id="submenu"
        >
            <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">
                My Profile
            </h1>
            <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">
                My Cart
            </h1>
            <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">
                My Wallet
            </h1>
            <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">
                My purchases
            </h1>
            <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">
                Liked
            </h1>
            <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">
                previos purchases
            </h1>
        </div>
        <div class="flex justify-start ml-7 ">

            <Logout class="text-start"/>
        </div>
    </div>
</template>
