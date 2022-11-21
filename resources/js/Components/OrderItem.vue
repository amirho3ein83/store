<script setup>
import { useCartStore } from "@/store/Cart.js";
import { onMounted, onUnmounted, ref, toRef } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

const storeCart = useCartStore();

let props = defineProps({
    order: Object,
});

let qty = ref(props.order.qty);

let loaded = ref(false);


const increaseOrder = () => {
    qty.value++;
    storeCart.increaseOrder(
        props.order.product.id,
        props.order.product.sale_price);
};

const decreaseOrder = () => {
    qty.value--;
    storeCart.decreaseOrder(
        props.order.product.id,
        props.order.product.sale_price);
};

const deleteOrder = () => {
    loaded.value = false;
    storeCart.count_cart--;
    storeCart.deleteOrder(
        props.order.product.id,
        props.order.product.sale_price,
        props.order.qty);
};

onMounted(() => {
    loaded.value = true;
});
</script>

<template>
    <Transition name="fade">
        <div v-if="loaded" class="flex items-center p-2 bg-stone-50 rounded-lg my-1 ">
            <!-- <div class="w-30"> -->
            <img @click="storeProduct.showProduct(order.product.slug)"
                class="flex-shrink-0 rounded-lg w-24 h-24 object-cover object-center sm:mb-0"
                :src="order.product.image_url" alt="">
            <!-- </div> -->
            <div class="flex flex-col justify-between ml-4 flex-grow ">
                <span class="text-xs sm:text-sm">{{ order.product.title }}</span>
                <span class="flex flex-col">
                    <span class="text-yellow-900 text-sm">${{ order.product.sale_price }}</span>
                    <div class="flex gap-x-2">
                        <span :style="{ backgroundColor: order.picked_color }"
                            class="block my-1 w-3 h-3 rounded-full"></span>
                        <p class="text-xs text-slate-900  my-1">
                            {{ order.picked_size }}
                        </p>
                    </div>
                </span>
                <button @click="deleteOrder()"
                    class="text-start w-1/2 pt-2 font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</button>
            </div>

            <div class="flex flex-col-reverse  flex-1 justify-center gap-5">
                <div class="inline-flex justify-center gap-1 ">
                    <button :disabled="qty == 10" @click="increaseOrder()"
                        class="inline-flex h-8 w-8 items-center justify-center text-green-700">
                        <i class="bi bi-plus" v-if="qty != 10"></i>
                    </button>

                    <div>
                        <div 
                            class=" inline-flex h-8 w-8 items-center justify-center"
                            min="1">{{ qty }}</div>
                    </div>

                    <button :disabled="qty == 1" @click="decreaseOrder()"
                        class="inline-flex h-8 w-8 items-center justify-center text-red-600">
                        <i class="bi bi-dash" v-if="qty != 1"></i>
                        <!-- <i class="bi bi-trash3-fill"></i> -->
                    </button>
                </div>
                <div class="flex-col flex px-8">
                    <span class="text-center font-semibold text-sm">Total</span>
                    <span class="text-center font-semibold text-stone-800 text-sm">${{ order.product.sale_price * qty
                    }}</span>
                </div>


            </div>
        </div>
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
