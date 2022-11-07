<script setup>
import { useCartStore } from "@/store/Cart.js";
import axios from "axios";
import { onMounted, ref } from "vue";

const storeCart = useCartStore();
let props = defineProps({
    order: Object,
});

let qty = ref(props.order.quantity);

let loaded = ref(false);

const increaseOrder = (id) => {
    qty.value++;
    storeCart.increaseOrder(order.product.id);
};

const decreaseOrder = (id) => {
    qty.value--;
    storeCart.decreaseOrder(order.product.id);
};

const deleteOrder = (id) => {
    loaded.value = false;
    storeCart.count_cart--;
    storeCart.deleteOrder(order.product.id);
};

onMounted(() => {
    loaded.value = true;
});
</script>

<template>
    <Transition name="fade">
        <li class="flex py-4" v-if="loaded">
            <div
                class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200"
            >
                <img
                    src="../Pages/Store/Products/pics/sh2.webp"
                    alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt."
                    class="h-full w-full object-cover object-center"
                />
            </div>

            <div class="ml-4 flex flex-1 flex-col">
                <div>
                    <div
                        class="flex justify-between text-base font-medium text-gray-900"
                    >
                        <h3>
                            <a href="#">{{ order.product.title }}</a>
                        </h3>
                        <div>
                            <!-- final price -->
                            <h3 class="text-xl font-bold text-yellow-700">
                                {{
                                    (
                                        (order.product.price -
                                            (
                                                (order.product.discount / 100) *
                                                order.product.price
                                            ).toFixed(2)) *
                                        qty
                                    ).toFixed(2)
                                }}
                            </h3>
                            <!-- discount amount -->
                            <span class="text-red-400">{{
                                -(
                                    (
                                        (order.product.discount / 100) *
                                        order.product.price
                                    ).toFixed(2) * qty
                                ).toFixed(2)
                            }}</span>
                        </div>
                    </div>
                    <p class="">${{ order.product.price }}</p>
                    <p class="text-red-400">-%{{ order.product.discount }}</p>
                </div>
                <div class="flex flex-1 items-end justify-between text-sm">
                    <!-- <p class="text-gray-500">Qty {{ order.quantity }}</p> -->

                    <div class="inline-flex justify-center gap-1">
                        <button
                            @click="increaseOrder(order.product.id)"
                            class="inline-flex h-8 w-8 items-center justify-center text-green-700"
                        >
                            <i class="bi bi-plus"></i>
                        </button>

                        <div>
                            <label for="PaginationPage" class="sr-only"
                                >Page</label
                            >

                            <input
                                type="number"
                                class="h-8 w-12 rounded border border-gray-100 p-0 text-center text-xs font-medium [-moz-appearance:_textfield] [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                                min="1"
                                :value="qty"
                                id="PaginationPage"
                            />
                        </div>

                        <button
                            v-if="qty != 1"
                            @click="decreaseOrder(order.product.id)"
                            class="inline-flex h-8 w-8 items-center justify-center text-red-600"
                        >
                            <i class="bi bi-dash"></i>
                        </button>
                    </div>

                    <div class="flex">
                        <button
                            @click="deleteOrder(order.product.id)"
                            type="button"
                            class="font-medium text-red-600 hover:text-red-500"
                        >
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </li>
    </Transition>
</template>
<style scoped>
.fade-enter-active {
    transition: all 0.3s ease-out;
}

.fade-leave-active {
    transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-enter-from,
.fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
