<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import CategoryItem from "@/Components/CategoryItem.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import { computed } from 'vue';

defineProps({
    categories: Object,
    crumbItems: Object,
});

const crumbItems = computed(() => {
    return [
        {
            label: "دسته بندی ها",
            url: null,
            disable: true,
        }
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

    <section class="text-gray-600 body-font bg-white" bg-white>
        <div class="lg:container px-5  mx-auto">
            <Breadcrumb class="p-5" :crumbs="crumbItems" />


            <div class="flex flex-wrap -m-4">
                <CategoryItem v-for="category of categories" :key="category.id" :category="category"
                    :path="`subCategories.list`" />
            </div>
        </div>
    </section>
</template>
