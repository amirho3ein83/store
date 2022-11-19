<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import ProductCard4 from "@/Components/ProductCard4.vue";

let props = defineProps({
    liked_products: Object,
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
};
</script>
<template>
    <UserLayout>
        <section class="text-gray-600 body-font">
            <div class="flex flex-wrap -m-4">
                <template v-if="Object.keys(liked_products).length != 0">
                    <ProductCard4
                        v-for="product of liked_products"
                        :key="product.id"
                        :product="product"
                    />
                </template>
                <div class="flex mx-auto justify-center" v-else>
                    <img
                        src="https://cdn.dribbble.com/users/760295/screenshots/4433975/media/03494b209a1511a61868ced337b97931.png?compress=1&resize=400x300"
                        alt=""
                    />
                </div>
            </div>
        </section>
    </UserLayout>
</template>
