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
                <h1 class="text-2xl">Space Store</h1>

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
                        href="/cart"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            fill="currentColor"
                            class="bi bi-cart3"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </nav>

        <div
            class="carousel relative container mx-auto"
            style="max-width: 1600px"
        ></div>

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
                <div class="flex">
                    <form class="border-t border-gray-200 lg:border-t-0 w-1/4 bg-gray-200">
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

                                    <label
                                        for="toy"
                                        class="ml-3 text-sm font-medium"
                                    >
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

                                    <label
                                        for="game"
                                        class="ml-3 text-sm font-medium"
                                    >
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

                                    <label
                                        for="outdoor"
                                        class="ml-3 text-sm font-medium"
                                    >
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

                                        <label
                                            for="3+"
                                            class="ml-3 text-sm font-medium"
                                        >
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

                                        <label
                                            for="8+"
                                            class="ml-3 text-sm font-medium"
                                        >
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

                                        <label
                                            for="12+"
                                            class="ml-3 text-sm font-medium"
                                        >
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

                                        <label
                                            for="16+"
                                            class="ml-3 text-sm font-medium"
                                        >
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
                    <div class="flex flex-wrap">
                        <Product />
                        <Product />
                        <Product />
                        <Product />
                        <Product />
                        <Product />
                        <Product />
                        <Product />
                    </div>
                </div>
            </div>
        </section>
    </body>
</template>
