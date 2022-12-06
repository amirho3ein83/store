<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Product from "@/Components/Product.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import CategoryItem from "@/Components/CategoryItem.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";

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

    <section class="text-gray-600 body-font min-h-screen">
        <div class="container px-5 py-24 mx-auto">
            <h3 class="text-2xl p-5" v-text="category.name"></h3>
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
