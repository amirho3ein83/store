<script setup>
import { useCartStore } from "@/store/Cart.js";
import axios from "axios";
import { onBeforeMount, onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

const storeCart = useCartStore();

let props = defineProps({
    order: Object,
});

let qty = ref(props.order.quantity);

let loaded = ref(false);



const calFinalPrice = () => {

    let final_price = props.order.product.price - ((props.order.product.sale_price / 100) * props.order.product.price).toFixed(2)

    // storeCart.addToSubtotal(final_price * qty.value) 

    return final_price * qty.value


};

const addToSubtotal = (num) => {

    // storeCart.subtotal += num

};

const increaseOrder = () => {
    qty.value++;
    storeCart.increaseOrder(props.order.product.id);
};

const decreaseOrder = () => {
    qty.value--;
    storeCart.decreaseOrder(props.order.product.id);
};

const deleteOrder = () => {
    loaded.value = false;
    storeCart.count_cart--;
    storeCart.deleteOrder(props.order.product.id);
};

onMounted(() => {
    loaded.value = true;
    addToSubtotal(22)
});
</script>

<template>
    <Transition name="fade">
        <div v-if="loaded" class="flex items-center hover:bg-gray-100 -mx-8 2 bg-slate-100 rounded-lg my-1 ">
            <!-- <div class="w-30"> -->
            <img class="flex-shrink-0 rounded-lg w-36 h-36 object-cover object-center sm:mb-0" src="./watch.webp"
                alt="">
            <!-- </div> -->
            <div class="flex flex-col justify-between ml-4 flex-grow ">
                <span class="font-bold text-lg">{{ order.product.title }}</span>
                <span class="flex flex-col">
                    <span class="text-yellow-800 text-lg">${{ order.product.sale_price }}</span>
                    <span class="text-red-800 line-through text-xs">${{ order.product.price }}</span>
                </span>
                <button @click="deleteOrder()"
                    class="text-start w-1/2 pt-4 font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</button>
            </div>

            <div class="flex flex-col-reverse xl:flex-row flex-1 justify-center gap-5">
                <div class="inline-flex justify-center gap-1 ">
                    <button @click="increaseOrder()"
                        class="inline-flex h-8 w-8 items-center justify-center text-green-700">
                        <i class="bi bi-plus"></i>
                    </button>

                    <div>
                        <label for="PaginationPage" class="sr-only">Page</label>

                        <input type="number"
                            class="h-8 w-12 rounded  bg-cyan-50 p-0 text-center text-xs font-medium [-moz-appearance:_textfield] [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none"
                            min="1" :value="qty" id="PaginationPage" />
                    </div>

                    <button :disabled="qty == 1" @click="decreaseOrder()"
                        class="inline-flex h-8 w-8 items-center justify-center text-red-600">
                        <i class="bi bi-dash" v-if="qty != 1"></i>
                        <!-- <i class="bi bi-trash3-fill"></i> -->
                    </button>
                </div>
                <div class="flex-col flex px-8">
                    <span class="text-center font-semibold text-md">Total</span>
                    <span class="text-center font-semibold text-fuchsia-900 text-lg">${{ order.product.sale_price * qty
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
