<script setup>
import AddToCartButton from "@/Components/AddToCartButton.vue";
import InCartButton from "@/Components/InCartButton.vue";
import { onMounted, ref } from "vue";

defineProps({
    product: Object,
});

let showItem = ref(false);

onMounted(() => {
    setTimeout(() => {
        showItem.value = true;
    }, 1);
});
</script>

<template>
    <Transition> 

    <div class="max-w-2xl mx-auto" v-if="showItem">
        <div
            class="bg-white shadow-md rounded-lg max-w-sm dark:bg-gray-800 dark:border-gray-700"
        >
            <a href="#">
                <img
                    class="rounded-t-lg mx-auto"
                    src="data:image/jpeg;base64,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"
                    alt="product image"
                />
            </a>
            <div class="px-5 pb-5">
                <h2 class="text-yellow-900 text-xl">{{ product.title }}</h2>
                    <h3
                        class="h-14 block text-gray-900 font-semibold text-sm tracking-tight dark:text-white"
                    >
                        {{ product.description }}
                    </h3>
                <div class="flex items-center mt-2.5 mb-5 justify-between">
                    <div>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <span
                        class="text-2xl font-bold text-slate-800 dark:text-white"
                        >${{ product.price }}</span
                    >
                </div>
                <div class="w-full">
                    <InCartButton v-if="product.is_in_cart" />
                    <AddToCartButton v-else :id="product.id" />
                </div>
            </div>
        </div>
    </div>
</Transition>
</template>

<style>
.bi-star-fill {
    color: #a0a832;
    font-size: 16px;
}
</style>
