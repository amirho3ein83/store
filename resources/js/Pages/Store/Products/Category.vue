<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Product from "@/Components/Product.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import CategoryItem from "@/Components/CategoryItem.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";

defineProps({
    products: Object,
    categories: Object,
});
</script>

<template>

    <Head title="Store Page" />

    <AppLayout>
        <div class="carousel relative container mx-auto" style="max-width: 1600px"></div>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <CategoryItem v-for="category of categories" :key="category.id" :category="category" />

                </div>
            </div>
        </section>
    </AppLayout>
</template>
