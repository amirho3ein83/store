<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

let showItem = ref(false);

let props = defineProps({
    product: Object,
});

const unlikeProduct = (id) => {
    showItem.value = false;
    storeProduct.unlikeProduct(id);
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
            class="flex lg:w-1/5 md:w-1/4 sm:w-1/3 w-1/2 px-1 flex-col justify-center items-center max-w-sm mx-auto my-2"
        >
            <img
                @click="storeProduct.showProduct(product.slug)"
                :src="product.image_url"
                alt=""
            />
            <div class="bg-white w-full shadow-lg rounded-lg overflow-hidden">
                <div
                    class="py-2 text-center font-bold uppercase tracking-wide text-gray-800"
                >
                    {{ product.title }}
                </div>
                <div
                    class="flex items-center justify-between py-2 px-3 bg-gray-400"
                >
                    <h1 class="text-gray-800 font-bold">
                        {{ product.default_price.toLocaleString("ar-EG") }}
                    </h1>
                    <button
                        @click="unlikeProduct(product.id)"
                        class="text-red-700"
                    >
                        حذف
                    </button>
                </div>
            </div>
        </div>
    </Transition>
</template>
