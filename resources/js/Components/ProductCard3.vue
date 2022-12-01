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
    <Transition>
        <div
            v-if="showItem"
            @click="storeProduct.showProduct(product.slug)"
            class="block px-4 lg:w-1/6 my-2 md:w-1/4 sm:w-1/3 w-1/2"
        >
            <img
                alt="image"
                :src="product.image_url"
                class="w-full h-full object-cover"
            />
            <div class="mt-2 space-y-3">
                <div class="flex justify-between text-sm truncate">
                    <h3>{{ product.title }}</h3>

                    <p
                        class="ml-2 text-sm font-bold text-yellow-700 dark:text-white"
                    >
                        {{ product.rate
                        }}<i class="bi bi-star-fill text-yellow-500"></i>
                    </p>
                </div>
                <div class="flex justify-between text-xs">
                    <div class="flex gap-1">
                        <span
                            :style="{ backgroundColor: color.name }"
                            v-for="color of product.available_colors"
                            :key="color.id"
                            class="block h-3 w-3 shadow rounded-full"
                        >
                        </span>
                    </div>
                    <p class="text-yellow-800">${{ product.default_price.toLocaleString("ar-EG") }}</p>
                </div>
            </div>
        </div>
    </Transition>
</template>
