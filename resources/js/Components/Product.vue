<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

let props = defineProps({
    product: Object,
});

let show = () => {
    Inertia.get("/products/" + props.product.id);
};
</script>

<template>


    <!-- component -->
    <div
        class="flex flex-col justify-center items-center max-w-sm mx-auto my-8 px-3"
    >
        <div
            style="
                background-image: url(https://images.unsplash.com/photo-1539185441755-769473a23570?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1951&q=80;
            "
            class="bg-gray-300 h-64 w-full rounded-lg shadow-md bg-cover bg-center"
        ></div>
        <div
            class="w-56 md:w-64 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden"
        >
            <div
                class="py-2 text-center font-bold uppercase tracking-wide text-gray-800"
            >
                Nike Revolt
            </div>
            <div
                class="flex items-center justify-between py-2 px-3 bg-gray-400"
            >
                <h1 class="text-gray-800 font-bold">$129</h1>
                <button
                    class="bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase hover:bg-gray-700"
                >
                    Add to cart
                </button>
            </div>
        </div>
    </div>
</template>
