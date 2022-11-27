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
    <!-- <section class="text-gray-600 body-font">
            <div class="container px-5 mx-auto">
{{orders}}
                <div class="container mx-auto min-h-screen p-8 antialiased">
                    <div>
                        <div
                            v-if="Object.keys(orders).length != 0 && showItem"
                            class="bg-gray-100 w-full sm:w-2/3 mx-auto border-gray-500 border rounded-sm text-gray-700 mb-0.5 h-30 flex flex-col gap-3"
                        >
                            <div
                                v-for="order of orders"
                                :key="order.id"
                                class="flex p-3 border-l-8 border-yellow-600 align-baseline"
                            >
                                <div
                                    class="space-y-1 border-r-2 pr-3 self-center"
                                >
                                    <div
                                        class="text-sm leading-5 font-semibold"
                                    >
                                        <span
                                            class="text-xs leading-4 font-normal text-gray-500"
                                        >
                                            Order #</span
                                        >
                                        {{ order.id }}
                                    </div>

                                    <div
                                        class="text-sm leading-5 font-semibold"
                                    >
                                        {{ order.created_at }}
                                    </div>
                                </div>
                                <div class="flex-1 self-center">
                                    <div
                                        class="flex justify-center items-center overflow-hidden"
                                    >
                                        <img
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                        <img
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                            src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                        <img
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                                            alt=""
                                        />
                                        <img
                                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div class="border-x-2 px-6 self-center">
                                    <div>
                                        <h3
                                            v-if="order.status == `pending`"
                                            class="bg-[#edc73e] rounded w-full text-sm text-center text-gray-900 p-2 cursor-pointer transition-all duration-100 ease-linear hover:scale-105 active:bg-gray-600 active:scale-100"
                                        >
                                            pay now
                                        </h3>
                                        <div
                                            v-else
                                            class="my-3 border-gray-200 border-2 bg-gray-300 p-1"
                                        >
                                            {{ order.billing_total }} تومان
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="my-3 mx-2 w-20 flex flex-col gap-y-3"
                                >
                                    <a
                                        v-if="order.status == `pending`"
                                        href="/cart"
                                        class="underline text-slate-600"
                                    >
                                        details
                                    </a>
                                    <a
                                        v-else
                                        :href="
                                            route('order.details', {
                                                id: order.id,
                                            })
                                        "
                                        class="underline text-slate-600"
                                    >
                                        details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    <div class="flex gap-x-6">
        <div class="w-1/2 pl-4 h-full flex flex-col">
            <div
                class="w-full h-full overflow-auto shadow bg-white"
                id="journal-scroll"
            >
                <table class="w-full">
                    <tbody class="">
                        <tr
                            v-for="order of orders"
                            :key="order.id"
                            class="relative transform scale-100 text-sm py-1 border-b-2 border-blue-100 cursor-default"
                        >
                            <td class="pl-5 pr-3 whitespace-no-wrap">
                                <div class="text-gray-400">
                                    {{ order.created_at }}
                                </div>
                            </td>

                            <td class="px-2 py-2">
                                <div class="leading-5 text-gray-500">
                                    {{ order.billing_total }} تومان
                                </div>
                                <div class="leading-5 text-gray-800">
                                    10 : تعداد اقلام
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-1/2">
            <!-- <OrderItem
                    v-for="orderItem of orders[0].items"
                    :orderItem="orderItem"
                    :key="orderItem.id"
                /> -->
            <div
                v-for="orderItem of orders[0].items"
                :orderItem="orderItem"
                :key="orderItem.id"
                class="flex items-center p-2 bg-stone-50 rounded-lg my-1"
            >
                <img
                    @click="storeProduct.showProduct(orderItem.product.slug)"
                    class="flex-shrink-0 cursor-pointer rounded-lg w-20 h-20 object-cover object-center sm:mb-0"
                    :src="orderItem.product.image_url"
                    alt=""
                />
                <div class="flex flex-col justify-between ml-4 flex-grow">
                    <span class="text-sm sm:text-lg text-left">{{
                        orderItem.product.title
                    }}</span>
                    <span class="flex flex-col">
                        <div class="flex gap-x-2">
                            <span
                                :style="{
                                    backgroundColor: orderItem.picked_color,
                                }"
                                class="block my-1 w-3 h-3 rounded-full"
                            ></span>
                            <p class="text-sm text-slate-900 my-1">
                                {{ orderItem.picked_size }} سایز
                            </p>
                        </div>
                    </span>
                </div>

                <div class="flex flex-col-reverse flex-1 justify-center gap-5">
                    <div class="flex-col flex px-8 text-right">
                        <span class="text-yellow-900 text-md text-left"
                            >قیمت ثابت
                            {{ orderItem.product.default_price }} تومان</span
                        >
                        <span class="text-stone-900 text-md text-left"
                            >{{ orderItem.qty }} تعداد
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
