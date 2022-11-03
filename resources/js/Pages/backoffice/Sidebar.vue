<script>
let icon1 = document.getElementById("icon1");
let menu1 = document.getElementById("menu1");
const showMenu1 = (flag) => {
    if (flag) {
        icon1.classList.toggle("rotate-180");
        menu1.classList.toggle("hidden");
    }
};
let icon2 = document.getElementById("icon2");

const showMenu2 = (flag) => {
    if (flag) {
        icon2.classList.toggle("rotate-180");
    }
};
let icon3 = document.getElementById("icon3");

const showMenu3 = (flag) => {
    if (flag) {
        icon3.classList.toggle("rotate-180");
    }
};

let Main = document.getElementById("Main");
let open = document.getElementById("open");
let close = document.getElementById("close");

const showNav = (flag) => {
    if (flag) {
        Main.classList.toggle("-translate-x-full");
        Main.classList.toggle("translate-x-0");
        open.classList.toggle("hidden");
        close.classList.toggle("hidden");
    }
};
</script>
<template>
    <div
        id="Main"
        class="h-screen sticky overflow-y-auto overflow-x-hidden top-0 xl:rounded-r transform xl:translate-x-0 ease-in-out transition duration-500 flex justify-start items-start w-full sm:w-64 bg-gray-900 flex-col"
    >
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

        <div class="hidden xl:flex justify-start p-6 items-center space-x-3">
            <p class="text-2xl leading-6 text-white">Admin Panel</p>
        </div>
        <a
            href="{{route(products.list)}}"
            class="flex justify-center items-center my-1 space-x-6 focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-800 text-gray-100 px-3 py-3 w-full"
        >
            <p class="text-base leading-4">Products</p>
        </a>
        <a
            href="/backoffice/brands"
            class="flex justify-center items-center my-1 space-x-6 focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-800 text-gray-100 px-3 py-3 w-full"
        >
            <p class="text-base leading-4">Brands</p>
        </a>
        <a
            href="/backoffice/payments"
            class="flex justify-center items-center my-1 space-x-6 focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-800 text-gray-100 px-3 py-3 w-full"
        >
            <p class="text-base leading-4">Payments</p>
        </a>
        <a
            href="/backoffice/payments"
            class="flex justify-center items-center my-1 space-x-6 focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-800 text-gray-100 px-3 py-3 w-full"
        >
            <p class="text-base leading-4">Users</p>
        </a>
    </div>
</template>
