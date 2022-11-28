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
    <div class="mx-auto">
        <div
            class="w-full md:w-1/2 xl:w-2/3 pl-4 h-full flex flex-col mx-auto py-0"
        >
            <div
                class="w-full h-full overflow-auto bg-[#edeef0] py-0 rounded-xl"
                id="journal-scroll"
            >
                <div
                    v-for="order of orders"
                    :key="order.id"
                    class="relative my-3 transform scale-100 text-sm py-1 cursor-default"
                >
                    <h1>{{ orders[0].address }}</h1>
                    <div class="flex justify-end gap-x-2 p-3 bg-[#d5d6e3]">
                        <div class="pl-5 pr-3 whitespace-no-wrap">
                            <div class="text-gray-400">
                                {{ order.created_at }}
                            </div>
                        </div>

                        <div class="leading-5 text-gray-500">
                            {{ order.billing_total }} تومان
                        </div>
                        <div class="leading-5 text-gray-800">
                            10 : تعداد اقلام
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div
                            v-for="orderItem of order.items"
                            :orderItem="orderItem"
                            :key="orderItem.id"
                            class="flex items-center border p-2 bg-stone-50 rounded-lg my-1 w-1/2"
                        >
                            <img
                                @click="
                                    storeProduct.showProduct(
                                        orderItem.product.slug
                                    )
                                "
                                class="flex-shrink-0 cursor-pointer rounded-lg w-20 h-20 object-cover object-center sm:mb-0"
                                :src="orderItem.product.image_url"
                                alt=""
                            />
                            <div
                                class="flex flex-col justify-between ml-4 flex-grow"
                            >
                                <div class="flex gap-x-3 justify-between">
                                    <span class="text-sm sm:text-md"
                                        >{{ orderItem.product.title }}
                                    </span>
                                </div>

                                <div
                                    class="flex gap-x-3 justify-between align-baseline"
                                >
                                    <span class="flex gap-x-2">
                                        <span
                                            :style="{
                                                backgroundColor:
                                                    orderItem.picked_color,
                                            }"
                                            class="block my-1 w-3 h-3 rounded-full"
                                        ></span>
                                        رنگ
                                    </span>
                                    <span
                                        class="text-sm text-slate-900 my-1 self-center"
                                    >
                                        {{ orderItem.picked_size }} سایز
                                    </span>
                                </div>
                                <div class="flex gap-x-3 justify-between">
                                    <span class="text-sm sm:text-md"
                                        >{{ orderItem.product.default_price }}
                                        <span class="text-red-500">x</span>
                                        {{ orderItem.qty }}
                                    </span>
                                </div>
                                <div class="flex gap-x-3 justify-end py-1">
                                    <span class="text-yellow-900 text-sm">
                                        {{ orderItem.billing_total }}
                                        تومان</span
                                    >جمع کل
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
