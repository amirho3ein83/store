<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import CategoryItem from "@/Components/CategoryItem.vue";

defineProps({
    categories: Object,
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


    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                <CategoryItem
                    v-for="category of categories"
                    :key="category.id"
                    :category="category"
                    :path="`subCategories.list`"
                />
            </div>
        </div>
    </section>
</template>
