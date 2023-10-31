<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import CategoryItem from "@/Components/CategoryItem.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import { computed } from 'vue';

defineProps({
    categories: Object,
    breadcrumbItems: Object,
});

const breadcrumbItems = computed(() => {
    return [
        {
        label:"Categories",
        url:route(`category.list`),
    },
        {
        label:"Category",
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

    <section class="text-gray-600 body-font bg-white" bg-white>
        <div class="lg:container px-5 py-24 mx-auto">
            <Breadcrumb class="p-5" :items="breadcrumbItems"/>

            <div class="bg-white dark:text-gray-100 dark:bg-gray-900">
                <div class="lg:container px-5  mx-auto">
                    <div class="flex flex-wrap -m-4">
                        <CategoryItem v-for="category of categories" :key="category.id" :category="category"
                            :path="`subCategories.list`" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
