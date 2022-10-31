<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Product from "@/Components/Product.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Store Page" />

    <body
        class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal"
    >
        <!--Nav-->
        <nav id="header" class="w-full z-30 top-0 py-1">
            <div
                class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3"
            >
                <label for="menu-toggle" class="cursor-pointer md:hidden block">
                    <svg
                        class="fill-current text-gray-900"
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                    >
                        <title>menu</title>
                        <path
                            d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                        ></path>
                    </svg>
                </label>
                <input class="hidden" type="checkbox" id="menu-toggle" />

                <div
                    class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1"
                    id="menu"
                >
                    <nav>
                        <ul
                            class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0"
                        >
                            <li>
                                <a
                                    class="inline-block no-underline hover:text-black hover:underline py-2 px-4"
                                    href="#"
                                    >Shop</a
                                >
                            </li>
                            <li>
                                <a
                                    class="inline-block no-underline hover:text-black hover:underline py-2 px-4"
                                    href="#"
                                    >About</a
                                >
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="order-1 md:order-2">
                    <a
                        class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl"
                        href="#"
                    >
                        <svg
                            class="fill-current text-gray-800 mr-2"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z"
                            />
                        </svg>
                        NORDICS
                    </a>
                </div>

                <div
                    class="order-2 md:order-3 flex items-center"
                    id="nav-content"
                >
                    <a
                        class="inline-block no-underline hover:text-black"
                        href="#"
                    >
                        <svg
                            class="fill-current hover:text-black"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <circle fill="none" cx="12" cy="7" r="3" />
                            <path
                                d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z"
                            />
                        </svg>
                    </a>

                    <a
                        class="pl-3 inline-block no-underline hover:text-black"
                        href="#"
                    >
                        <svg
                            class="fill-current hover:text-black"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z"
                            />
                            <circle cx="10.5" cy="18.5" r="1.5" />
                            <circle cx="17.5" cy="18.5" r="1.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </nav>

        <div
            class="carousel relative container mx-auto"
            style="max-width: 1600px"
        >

        </div>

        <!--     	 

Alternatively if you want to just have a single hero

<section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right" style="max-width:1600px; height: 32rem; background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">

<div class="container mx-auto">

    <div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
        <h1 class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</h1>
        <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">products</a>

    </div>

  </div>

</section>
-->

        <section class="bg-white py-8">
            <div
                class="container mx-auto flex items-center flex-wrap pt-4 pb-12"
            >
                <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                    <div
                        class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3"
                    >
                        <a
                            class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl"
                            href="#"
                        >
                            Store
                        </a>

                        <div class="flex items-center" id="store-nav-content">
                            <a
                                class="pl-3 inline-block no-underline hover:text-black"
                                href="#"
                            >
                                <svg
                                    class="fill-current hover:text-black"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z"
                                    />
                                </svg>
                            </a>

                            <a
                                class="pl-3 inline-block no-underline hover:text-black"
                                href="#"
                            >
                                <svg
                                    class="fill-current hover:text-black"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </nav>

                        <!-- llllllllllllllllllll -->
        <form class="border-t border-gray-200 lg:border-t-0">
            <fieldset>
                <legend
                    class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium"
                >
                    Type
                </legend>

                <div class="space-y-2 px-5 py-6">
                    <div class="flex items-center">
                        <input
                            id="toy"
                            type="checkbox"
                            name="type[toy]"
                            class="h-5 w-5 rounded border-gray-300"
                        />

                        <label for="toy" class="ml-3 text-sm font-medium">
                            Toy
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="game"
                            type="checkbox"
                            name="type[game]"
                            class="h-5 w-5 rounded border-gray-300"
                        />

                        <label for="game" class="ml-3 text-sm font-medium">
                            Game
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="outdoor"
                            type="checkbox"
                            name="type[outdoor]"
                            class="h-5 w-5 rounded border-gray-300"
                        />

                        <label for="outdoor" class="ml-3 text-sm font-medium">
                            Outdoor
                        </label>
                    </div>

                    <div class="pt-2">
                        <button
                            type="button"
                            class="text-xs text-gray-500 underline"
                        >
                            Reset Type
                        </button>
                    </div>
                </div>
            </fieldset>

            <div>
                <fieldset>
                    <legend
                        class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium"
                    >
                        Age
                    </legend>

                    <div class="space-y-2 px-5 py-6">
                        <div class="flex items-center">
                            <input
                                id="3+"
                                type="checkbox"
                                name="age[3+]"
                                class="h-5 w-5 rounded border-gray-300"
                            />

                            <label for="3+" class="ml-3 text-sm font-medium">
                                3+
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input
                                id="8+"
                                type="checkbox"
                                name="age[8+]"
                                class="h-5 w-5 rounded border-gray-300"
                            />

                            <label for="8+" class="ml-3 text-sm font-medium">
                                8+
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input
                                id="12+"
                                type="checkbox"
                                name="age[12+]"
                                class="h-5 w-5 rounded border-gray-300"
                            />

                            <label for="12+" class="ml-3 text-sm font-medium">
                                12+
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input
                                id="16+"
                                type="checkbox"
                                name="age[16+]"
                                class="h-5 w-5 rounded border-gray-300"
                            />

                            <label for="16+" class="ml-3 text-sm font-medium">
                                16+
                            </label>
                        </div>

                        <div class="pt-2">
                            <button
                                type="button"
                                class="text-xs text-gray-500 underline"
                            >
                                Reset Age
                            </button>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div
                class="flex justify-between border-t border-gray-200 px-5 py-3"
            >
                <button
                    name="reset"
                    type="button"
                    class="rounded text-xs font-medium text-gray-600 underline"
                >
                    Reset All
                </button>

                <button
                    name="commit"
                    type="button"
                    class="rounded bg-green-600 px-5 py-3 text-xs font-medium text-white"
                >
                    Apply Filters
                </button>
            </div>
        </form>
        <!-- llllllllllllllllllll -->
                <!-- <Product/> -->

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img
                            class="hover:grow hover:shadow-lg"
                            src="https://images.unsplash.com/photo-1508423134147-addf71308178?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80"
                        />
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">Product Name</p>
                            <svg
                                class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"
                                />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">£9.99</p>
                    </a>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img
                            class="hover:grow hover:shadow-lg"
                            src="https://images.unsplash.com/photo-1449247709967-d4461a6a6103?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80"
                        />
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">Product Name</p>
                            <svg
                                class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"
                                />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">£9.99</p>
                    </a>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img
                            class="hover:grow hover:shadow-lg"
                            src="https://images.unsplash.com/reserve/LJIZlzHgQ7WPSh5KVTCB_Typewriter.jpg?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80"
                        />
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">Product Name</p>
                            <svg
                                class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"
                                />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">£9.99</p>
                    </a>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img
                            class="hover:grow hover:shadow-lg"
                            src="https://images.unsplash.com/photo-1467949576168-6ce8e2df4e13?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80"
                        />
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">Product Name</p>
                            <svg
                                class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"
                                />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">£9.99</p>
                    </a>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img
                            class="hover:grow hover:shadow-lg"
                            src="https://images.unsplash.com/photo-1544787219-7f47ccb76574?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80"
                        />
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">Product Name</p>
                            <svg
                                class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"
                                />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">£9.99</p>
                    </a>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img
                            class="hover:grow hover:shadow-lg"
                            src="https://images.unsplash.com/photo-1550837368-6594235de85c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80"
                        />
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">Product Name</p>
                            <svg
                                class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"
                                />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">£9.99</p>
                    </a>
                </div>

                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="#">
                        <img
                            class="hover:grow hover:shadow-lg"
                            src="https://images.unsplash.com/photo-1551431009-a802eeec77b1?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&h=400&q=80"
                        />
                        <div class="pt-3 flex items-center justify-between">
                            <p class="">Product Name</p>
                            <svg
                                class="h-6 w-6 fill-current text-gray-500 hover:text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z"
                                />
                            </svg>
                        </div>
                        <p class="pt-1 text-gray-900">£9.99</p>
                    </a>
                </div>
            </div>
        </section>
    </body>
</template>
