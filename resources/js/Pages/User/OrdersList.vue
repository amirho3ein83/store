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
    layout: AppLayout,
};
</script>
<template>
    <UserLayout>
        <section class="text-gray-600 body-font">
            <div class="container px-5 mx-auto">
                <!-- <div>
                    <div
                        class="flex flex-wrap -m-4 justify-start"
                        v-if="Object.keys(orders).length != 0 && showItem"
                    >
                        <div
                            v-for="order of orders"
                            :key="order.id"
                            class="flex text-justify items-center p-2 bg-slate-200 rounded-lg my-1 md:w-1/3 sm:w-1/2 w-full"
                        >
                            <img
                                @click="
                                    storeProduct.showProduct(order.product.slug)
                                "
                                class="flex-shrink-0 mr-2 rounded-lg w-36 h-36 object-cover object-center sm:mb-0"
                                :src="order.product.image_url"
                                alt=""
                            />
                            <div
                                class="flex flex-col justify-between ml-4 flex-grow"
                            >
                                <span class="font-bold text-sm">{{
                                    order.product.title
                                }}</span>
                                <span class="flex flex-col">
                                    <span
                                        class="text-yellow-800 text-sm sm:text-lg"
                                        >${{
                                            order.product.default_price
                                        }}</span
                                    >x {{ order.qty }}
                                    <div class="flex gap-2">
                                        <span
                                            :style="{
                                                backgroundColor:
                                                    order.picked_color,
                                            }"
                                            class="block my-1 w-3 h-3 rounded-full"
                                        ></span>
                                        <p class="text-xs text-slate-900 my-1">
                                            size: {{ order.picked_size }}
                                        </p>
                                    </div>
                                    <p class="text-xs text-slate-900 my-1">
                                        date purchased:
                                    </p>

                                    <span class="text-slate-800 text-sm">{{
                                        order.product.created_at
                                    }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex mx-auto justify-center" v-else>
                        <img
                            src="https://cdn.dribbble.com/users/760295/screenshots/4433975/media/03494b209a1511a61868ced337b97931.png?compress=1&resize=400x300"
                            alt=""
                        />
                    </div>
                </div> -->

                <!-- component -->
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
                                            {{ order.billing_total }}5555
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
        </section>
    </UserLayout>
</template>
