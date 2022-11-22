<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
const storeProduct = useProductStore();

let showItem = ref(false);

let props = defineProps({
    product: Object,
});

const addToCart = () => {
    storeCart.addToCart(props.product.id);
};

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 10);
});
</script>

<template>
    <Transition name="bounce">
        <div
            v-if="showItem"
            @click="storeProduct.showProduct(product.slug)"
            class="block px-4 lg:w-1/5 my-2 md:w-1/4 sm:w-1/3 w-1/2 group"
        >
            <!-- <div class="flex justify-center">
                <strong
                    class="relative h-6 bg-black px-4 text-xs uppercase leading-6 text-white"
                >
                    New
                </strong>
            </div> -->

            <img
                alt="Trainer"
                :src="product.image_url"
                class="-mt-3 h-auto w-full object-cover group-hover:scale-105 transition-all duration-300"
            />

            <h3 class="mt-4 text-sm text-gray-700">
                {{ product.title }}
            </h3>

            <div class="mt-4 flex items-center justify-between font-medium">
                <p class="text-yellow-800">${{ product.default_price }}</p>

                <div class="flex gap-1">
                    <span
                        :style="{ backgroundColor: color.name }"
                        v-for="color of product.available_colors"
                        :key="color.id"
                        class="block h-3 w-3 shadow rounded-full"
                    >
                    </span>
                </div>
            </div>
        </div>
    </Transition>
</template>
<style scoped>
.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0.95);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}
</style>
