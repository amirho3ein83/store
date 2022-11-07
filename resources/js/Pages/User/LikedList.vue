<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import ProductCard4 from "@/Components/ProductCard4.vue";

let props = defineProps({
    liked_products: Object,
});
</script>

<template>
    <UserLayout>
        <div class="mt-20 text-center border-b pb-12">
            <div class="grid grid-cols-4 align-baseline content-center justify-center">
                <ProductCard4
                    v-for="product of liked_products"
                    :key="product.id"
                    :product="product"
                />
            </div>
        </div>
    </UserLayout>
</template>
