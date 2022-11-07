<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
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
    <button @click="show" class="group block overflow-hidden">
        <img
            src="./amazing-offer.jpg"
            alt="Tee"
            class="h-[350px] w-full object-cover transition-transform duration-300 group-hover:scale-105 sm:h-[250px]"
        />

        <div class="relative pt-4">
            <h3
                class="text-xl text-yellow-600 group-hover:underline group-hover:underline-offset-4"
            >
                {{ product.title }}
            </h3>

            <p class="mt-2">
                <span class="truncate h-24 text-slate-200 mx-2">
                    {{ product.description }}
                </span>

                <span class="tracking-wider text-teal-200">
                    ${{ product.price }}
                </span>
            </p>
        </div>
    </button>
</template>
