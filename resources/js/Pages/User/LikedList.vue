<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import ProductCard4 from "@/Components/ProductCard4.vue";

let props = defineProps({
    liked_products: Object,
});
</script>

<template>
    <UserLayout>
        <ProductCard4
                    v-for="product of liked_products"
                    :key="product.id"
                    :product="product"
                />
    </UserLayout>
</template>
