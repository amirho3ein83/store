<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AddToCartButton from "@/Components/AddToCartButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";

let props = defineProps({
    product: Object,
});

let show = () => {
    Inertia.get("/products/" + props.product.id);
};
</script>

<template>
    <div class="group block overflow-hidden m:w-1/3 lg:w-1/4 w-1/2 p-2 mb-2">
        <button @click="show">
            <img
                alt="Headphones"
                src="https://images.unsplash.com/photo-1504274066651-8d31a536b11a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                class="h-[300px] w-full object-cover sm:h-[300px]"
            />

            <div class="mt-2 space-y-3">
                <p class="text-lg text-gray-500">{{ product.name }}</p>

                <div class="flex justify-between text-xs">
                    <!-- <h3>{{ product.description }}</h3> -->

                    <p class="text-r">{{ product.price }} $</p>
                    <p class="">{{ product.sale_price }} $</p>
                </div>
            </div>
        </button>
        <AddToCartButton :id="product.id" />
    </div>
</template>
