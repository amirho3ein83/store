<script setup>
import { useCartStore } from "@/store/Cart.js";
import { onMounted, onUnmounted, ref, toRef } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

const storeCart = useCartStore();

let props = defineProps({
    orderItem: Object,
});

let qty = ref(props.orderItem.qty);

let loaded = ref(false);

const increaseOrderItem = () => {
    qty.value++;
    storeCart.increaseOrderItem(
        props.orderItem.product.id,
        props.orderItem.product_price
    );
};

const decreaseOrderItem = () => {
    qty.value--;
    storeCart.decreaseOrderItem(
        props.orderItem.product.id,
        props.orderItem.product_price
    );
};

const deleteOrderItem = () => {
    loaded.value = false;
    storeCart.count_cart--;
    storeCart.deleteOrderItem(
        props.orderItem.id,
        props.orderItem.product_price,
        props.orderItem.qty
    );
    if (storeCart.count_cart == 0) {
        location.reload()
    }
};

onMounted(() => {
    loaded.value = true;
});
</script>

<template>
    <Transition name="fade">
        <div v-if="loaded" class="flex items-center p-2 bg-stone-50 rounded-lg my-1">
            <!-- <div class="w-30"> -->
            <img @click="storeProduct.showProduct(orderItem.product.slug)"
                class="flex-shrink-0 rounded-lg w-28 h-28 object-cover object-center sm:mb-0"
                :src="orderItem.product.image_url" alt="" />
            <!-- </div> -->
            <div class="flex flex-col justify-between ml-4 flex-grow">
                <span class="text-sm sm:text-lg text-left">{{
                    orderItem.product.title
                }}</span>
                <span class="flex flex-col">
                    <span class="text-yellow-900 text-md text-left">{{
                        orderItem.product_price.toLocaleString("ar-EG")
                    }}
                        تومان</span>
                    <div class="flex gap-x-2 ">
                        <span :style="{
                                    backgroundColor: orderItem.color.en_name,
                                }" class="block my-1 border-2 w-5 h-5 rounded-full"></span>
                    </div>
                </span>
                <button @click="deleteOrderItem()"
                    class="text-start pt-2 w-1/4 font-semibold hover:text-red-500 text-gray-500 text-sm">
                    حذف
                </button>
            </div>

            <div class="flex flex-col-reverse flex-1 justify-center gap-5">
                <div class="inline-flex justify-center gap-1">
                    <button :disabled="qty == 10" @click="increaseOrderItem()"
                        class="inline-flex h-8 w-8 items-center justify-center text-green-700">
                        <i class="bi bi-plus" v-if="qty != 10"></i>
                    </button>

                    <div>
                        <div class="inline-flex h-8 w-8 items-center justify-center" min="1">
                            {{ qty.toLocaleString("ar-EG") }}
                        </div>
                    </div>

                    <button :disabled="qty == 1" @click="decreaseOrderItem()"
                        class="inline-flex h-8 w-8 items-center justify-center text-red-600">
                        <i class="bi bi-dash" v-if="qty != 1"></i>
                    </button>
                </div>
                <div class="flex-col flex px-8">
                    <span class="text-center text-stone-800 text-sm">{{
                        (orderItem.product_price * qty).toLocaleString(
                            "ar-EG"
                        )
                    }}
                        تومان</span>
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
