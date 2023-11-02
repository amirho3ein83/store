<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Product from "@/Components/Product.vue";
import AmazingOffer from "@/Components/AmazingOffer.vue";
import CategoryItem from "@/Components/CategoryItem.vue";
import "vue-horizontal-scroll/dist/vue-horizontal-scroll.css";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import { computed } from 'vue';

const props = defineProps({
    category: Object,
});


const crumbItems = computed(() => {
    return [
        {
            label: "دسته بندی ها",
            url: route(`category.list`),
            disable: false,
        },
        {
            label: props.category.name,
            disable: true,
        },
    ];
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

    <section class="text-gray-600  body-font min-h-screen">
        <div class="lg:container px-5 lg:py-24 mx-auto">
            <Breadcrumb class="p-5" :crumbs="crumbItems" />
            <div class="flex flex-wrap -m-4">
                <CategoryItem v-for="subCategory of category.sub_categories" :key="subCategory.id" :category="subCategory"
                    :parentCategory="category.name" :path="`product-list`" />
            </div>
        </div>
    </section>
</template>
