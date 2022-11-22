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
                <div>
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
                </div>
            </div>
        </section>
    </UserLayout>
</template>
