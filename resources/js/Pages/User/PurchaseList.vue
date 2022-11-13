<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import ProductCard3 from "@/Components/ProductCard3.vue";

let props = defineProps({
    orders: Object,
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout
}
</script>
<template>
    <UserLayout>



        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap  -m-4 ">

                    <ProductCard3 v-if="Object.keys(orders).length != 0" v-for="product of orders" :key="product.id"
                        :product="product" />
                    <div class="flex justify-center" v-else>
                        <img src="https://cdn.dribbble.com/users/760295/screenshots/4433975/media/03494b209a1511a61868ced337b97931.png?compress=1&resize=400x300"
                            alt="">
                    </div>

                </div>
            </div>
        </section>





    </UserLayout>
</template>
