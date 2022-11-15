<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();
let showItem = ref(false);

let props = defineProps({
    orders: Object,
});


onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 1);
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
            <div class="container px-5  mx-auto">
                <div class="flex flex-wrap  -m-4 justify-start">

                    <!-- <ProductCard3 v-if="Object.keys(orders).length != 0" v-for="product of orders" :key="product.id"
                        :product="product" />
                    <div class="flex justify-center" v-else>
                        <img src="https://cdn.dribbble.com/users/760295/screenshots/4433975/media/03494b209a1511a61868ced337b97931.png?compress=1&resize=400x300"
                            alt="">
                    </div> -->

                    <!-- <div v-if="Object.keys(orders).length != 0 && showItem" v-for="order of orders" :key="order.id"
                                class="flex  lg:w-1/5 md:w-1/4 sm:w-1/3 w-1/2 px-1 flex-col justify-center items-center max-w-sm mx-auto my-2">
                                <img @click="storeProduct.showProduct(order.product.id)" :src="order.product.image_url" alt=""
                                    class="cursor-pointer" />
                                <div class=" bg-gray-100 w-full shadow-lg  overflow-hidden">
                                    <div class="flex justify-between items-center">
                                        <div class="py-2 px-3 items-center align-baseline text-center font-bold   text-gray-800">
                                            {{ order.product.title }}
                                        </div>
                                        <div class="flex gap-2">
                                            <p class="ml-2 text-sm font-bold text-yellow-700 dark:text-white">
                                                {{ order.product.rate }}<i class="bi bi-star-fill text-yellow-500"></i>
                                            </p>
                                            <p
                                                class="text-sm font-medium text-slate-900 underline hover:no-underline dark:text-white">
                                                {{
                                                        order.product.reviews
                                                }}
                                                reviews</p>
                                        </div>
                                    </div>

                                    <span class="truncate text-xs h-24 text-slate-600 mx-2">
                                        {{ order.product.description }}
                                    </span>
                                    <div class="flex items-center justify-between py-2 px-3 bg-gray-400">
                                        <h1 class="text-gray-800 font-bold">
                                            $<span class="text-yellow-800">{{ order.product.price }}</span>
                                        </h1>
                                        <Link v-if="order.product.is_in_cart && $page.props.auth" :href="'/cart'"
                                            class="bg-[#dbae1a] text-gray-700 px-2 rounded hover:underline">
                                        in your cart
                                        </Link>

                                    </div>
                                </div>
                            </div> -->


                    <div v-if="Object.keys(orders).length != 0 && showItem" v-for="order of orders" :key="order.id"
                        class="flex text-justify items-center p-2  bg-slate-200 rounded-lg my-1 md:w-1/3  sm:w-1/2 w-full">
                        <!-- <div class="w-30"> -->
                        <img @click="storeProduct.showProduct(order.product.id)"
                            class="flex-shrink-0 mr-2 rounded-lg w-36 h-36 object-cover object-center sm:mb-0"
                            :src="order.product.image_url" alt="">
                        <!-- </div> -->
                        <div class="flex flex-col justify-between ml-4 flex-grow ">
                            <span class="font-bold text-sm sm:text-lg">{{ order.product.title }}</span>
                            <span class="flex flex-col">
                                <span class="text-yellow-800 text-sm sm:text-lg">${{ order.product.sale_price }}</span>
                                <span :style="{ backgroundColor: order.picked_color }"
                                    class="block my-1 w-3 h-3 rounded-full"></span>
                                <p class="text-xs text-slate-900  my-1">
                                    size: {{ order.picked_size }}
                                </p>
                                <p class="text-xs text-slate-900  my-1">
                                    date purchased:
                                </p>

                                <span class="text-slate-800 text-sm">{{ order.product.created_at }}</span>
                            </span>

                        </div>


                    </div>
                </div>
            </div>
        </section>





    </UserLayout>
</template>
