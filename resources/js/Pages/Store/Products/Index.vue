<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Product from "@/Components/Product.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <Head title="Store Page" />


<AppLayout>
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
    </AppLayout>
</template>
