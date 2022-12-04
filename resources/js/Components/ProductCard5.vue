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
    }, 1);
});
</script>

<template>
    <Transition name="bounce">
        <div
            v-if="showItem"
            @click="storeProduct.showProduct(product.slug)"
            class="text-sm md:text-lg px-4 2xl:w-1/5 xl:w-1/4  my-4  sm:w-1/3 w-1/2 group flex flex-col justify-between"
        >
            <div class="relative h-2/3 w-full">
                <img
                    alt="Trainer"
                    :src="product.image_url"
                    class="-mt-3 h-auto w-full object-cover group-hover:scale-105 transition-all duration-300"
                />
            </div>

            <div class="flex justify-between items-end h-1/3">
                <h3 class="mt-4 text-gray-700">
                    {{ product.title }}
                </h3>
                <div
                    v-if="product.rate != 0"
                    class="mt-2 -ml-0.5 flex justify-end"
                >
                    <svg
                        class="h-5 w-5 text-yellow-400"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                        />
                    </svg>

                    <p class=" font-bold text-cyan-700 dark:text-white">
                        {{ product.rate }}
                    </p>
                </div>
            </div>
            <div class="mt-2 flex items-center justify-between font-medium">
                <p class="text-yellow-800">
                    {{
                        product.available_colors[0].pivot.price.toLocaleString(
                            "ar-EG"
                        )
                    }}
                    <span class="text-gray-800 ">تومان</span>
                </p>

                <div class="flex gap-1">
                    <span
                        :style="{ backgroundColor: color.en_name }"
                        v-for="color of product.available_colors"
                        :key="color.id"
                        class="block sm:h-3 sm:w-3 w-2 h-2 shadow rounded-full"
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
