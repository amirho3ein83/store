<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";
import OrderItem from "@/Components/OrderItem.vue";
import Navbar from "@/Components/Navbar.vue";

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
import UserLayout from "@/Layouts/UserLayout.vue";

export default {
    layout: UserLayout,
};
</script>
<template>

    <section class="text-gray-600 body-font">
        <div class="container mx-auto">
            <div v-for="order of orders" :key="order.id" class="bg-gray-200">
                <div class="flex justify-end gap-x-2 p-3 bg-[#dcdef7]">
                    <div class="pl-5 pr-3 whitespace-no-wrap">
                        <div class="text-gray-700">
                            {{ order.j_created_at }}
                        </div>
                    </div>

                    <div class="leading-5 text-gray-800">
                        {{ order.billing_total }} تومان
                    </div>
                </div>
                <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
                    <div
                        v-for="orderItem of order.items"
                        :key="orderItem.id"
                        class="flex items-center justify-between rounded-md p-2 m-1 bg-slate-50 w-full md:w-5/12"
                    >
                        <img
                            @click="
                                storeProduct.showProduct(orderItem.product.slug)
                            "
                            class="flex-shrink-0 cursor-pointer rounded-lg w-20 h-20 object-cover object-center sm:mb-0"
                            :src="orderItem.product.image_url"
                            alt=""
                        />
                        <div class="flex flex-col justify-center">
                            <div class="flex gap-x-3 justify-between">
                                <span class="text-sm sm:text-md"
                                    >{{ orderItem.product.title }}
                                </span>
                            </div>

                            <div
                                class="flex gap-x-3 justify-between items-center"
                            >
                                <span class="flex gap-x-2 items-center">
                                    <span
                                        :style="{
                                            backgroundColor:
                                                orderItem.color.en_name,
                                        }"
                                        class="block border-2 my-1 w-5 h-5 rounded-full"
                                    ></span>
                                    رنگ
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-end">
                            <span class="text-sm sm:text-md"
                                >{{
                                    orderItem.product_price.toLocaleString(
                                        "ar-EG"
                                    )
                                }}
                                <span class="text-red-500">x</span>
                                {{ orderItem.qty }}
                            </span>
                            <span class="text-yellow-900 text-sm">
                                {{ orderItem.billing_total }}
                                تومان</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
