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
            class="flex flex-col justify-center items-center max-w-sm mx-auto my-8"
        >
            <img @click="storeProduct.showProduct(product.id)" src="./amazing-offer.jpg" alt="" />
            <div
                class="w-56 md:w-64 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden"
            >
                <div
                    class="py-2 text-center font-bold uppercase tracking-wide text-gray-800"
                >
                    {{ product.title }}
                </div>
                <div
                    class="flex items-center justify-between py-2 px-3 bg-gray-400"
                >
                    <h1 class="text-gray-800 font-bold">
                        $ {{ product.price }}
                    </h1>
                    <button
                        @click="unlikeProduct(product.id)"
                        class="text-red-600"
                    >
                        remove
                    </button>
                </div>
            </div>
        </div>
    </Transition>
</template>
