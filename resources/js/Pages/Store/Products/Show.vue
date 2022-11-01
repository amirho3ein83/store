<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AddToCartButton from "@/Components/AddToCartButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    product: Object,
});
</script>
<template>
    <AppLayout>
        <div>
            <div class="relative mx-auto max-w-screen-xl px-4 py-8">
                <div class="grid grid-cols-3 items-start gap-8 md:grid-cols-2">
                    <div class="">
                        <img
                            alt="Les Paul"
                            src="https://images.unsplash.com/photo-1456948927036-ad533e53865c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                            class="aspect-square w-full rounded-xl object-cover"
                        />
                    </div>

                    <div class="sticky top-0">
                        <div class="mt-8 flex justify-between">
                            <div class="max-w-[35ch]">
                                <h1 class="text-2xl font-bold">
                                    {{ product.name }}
                                </h1>
                            </div>

                            <p class="text-lg font-bold">
                                {{ product.price }} $
                            </p>
                        </div>

                        <details class="group relative mt-4">
                            <summary class="block">
                                <div>
                                    <div
                                        class="prose max-w-none group-open:hidden"
                                    >
                                        <p>
                                            {{ product.description }}
                                        </p>
                                    </div>
                                </div>
                            </summary>
                        </details>

                        <form class="mt-8">
                            <fieldset>
                                <legend class="mb-1 text-sm font-medium">
                                    Color
                                </legend>

                                <div class="flow-root">
                                    <div class="-m-0.5 flex flex-wrap">
                                        <label
                                            for="color_tt"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="color"
                                                id="color_tt"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-block rounded-full border px-3 py-1 text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                Texas Tea
                                            </span>
                                        </label>

                                        <label
                                            for="color_fr"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="color"
                                                id="color_fr"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-block rounded-full border px-3 py-1 text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                Fiesta Red
                                            </span>
                                        </label>

                                        <label
                                            for="color_cb"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="color"
                                                id="color_cb"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-block rounded-full border px-3 py-1 text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                Cobalt Blue
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-4">
                                <legend class="mb-1 text-sm font-medium">
                                    Size
                                </legend>

                                <div class="flow-root">
                                    <div class="-m-0.5 flex flex-wrap">
                                        <label
                                            for="size_xs"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="size"
                                                id="size_xs"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-flex h-8 w-8 items-center justify-center rounded-full border text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                XS
                                            </span>
                                        </label>

                                        <label
                                            for="size_s"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="size"
                                                id="size_s"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-flex h-8 w-8 items-center justify-center rounded-full border text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                S
                                            </span>
                                        </label>

                                        <label
                                            for="size_m"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="size"
                                                id="size_m"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-flex h-8 w-8 items-center justify-center rounded-full border text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                M
                                            </span>
                                        </label>

                                        <label
                                            for="size_l"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="size"
                                                id="size_l"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-flex h-8 w-8 items-center justify-center rounded-full border text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                L
                                            </span>
                                        </label>

                                        <label
                                            for="size_xl"
                                            class="cursor-pointer p-0.5"
                                        >
                                            <input
                                                type="radio"
                                                name="size"
                                                id="size_xl"
                                                class="peer sr-only"
                                            />

                                            <span
                                                class="group inline-flex h-8 w-8 items-center justify-center rounded-full border text-xs font-medium peer-checked:bg-black peer-checked:text-white"
                                            >
                                                XL
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="mt-8 flex">
                                <div class="inline-flex justify-center gap-1">
                                    <i class="bi bi-plus"></i>

                                    <div>
                                        <label
                                            for="PaginationPage"
                                            class="sr-only"
                                            >Page</label
                                        >

                                        <input
                                            type="number"
                                            class="h-8 w-12 rounded border border-gray-100 p-0 text-center text-xs font-medium [-moz-appearance:_textfield] [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                                            min="1"
                                            value="2"
                                            id="PaginationPage"
                                        />
                                    </div>

                                    <i class="bi bi-minus"></i>
                                </div>

                                <AddToCartButton :id='product.id'/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
