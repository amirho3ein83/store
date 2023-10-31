<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Product from "@/Components/Product.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import CategoryItem from "@/Components/CategoryItem.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";
import Breadcrumb from "@/Components/Breadcrumb.vue";

defineProps({
    category: Object,
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <Head title="Category" />

    <section class="text-gray-600 bg-white body-font min-h-screen">
        <div class="container px-5 py-24 mx-auto">
            <Breadcrumb class="p-5"/>
            <div class="flex flex-wrap -m-4">
                <CategoryItem
                    v-for="subCategory of category.sub_categories"
                    :key="subCategory.id"
                    :category="subCategory"
                    :path="`product-list`"
                />
            </div>
        </div>
    </section>
</template>
