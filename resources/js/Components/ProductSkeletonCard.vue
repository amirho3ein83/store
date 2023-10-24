<script setup>
import { onMounted, ref } from "vue";
import { useProductStore } from "@/store/Product.js";
import { useCartStore } from "@/store/Cart.js";

// const storeCart = useCartStore();
// const storeProduct = useProductStore();

// let showItem = ref(false);

// let props = defineProps({
//     product: Object,
// });

// const addToCart = () => {
//     storeCart.addToCart(props.product.id);
// };

// onMounted(() => {
//     setTimeout(() => {
//         showItem.value = true;
//     }, 1);
// });
</script>

<template>
    <div role="status"
        class="text-sm md:text-lg px-4 2xl:w-1/5 xl:w-1/4 my-4 sm:w-1/3 w-1/2 group flex flex-col justify-between">
        <div class="flex items-center justify-center h-68 mb-4 bg-gray-300 rounded dark:bg-gray-700">
            <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 16 20">
                <path
                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
            </svg>
        </div>
        <div class="flex justify-between items-end h-1/3">
            <h3 class="mt-4 text-gray-700">
                dfgdfgdfgdfgdf
            </h3>
            <div class="mt-2 -ml-0.5 flex justify-end">
                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>

                <p class="font-bold text-cyan-700 dark:text-white">
                    hdfgdfgdfgdfg </p>
            </div>
        </div>
        <div class="mt-2 flex items-center justify-between font-medium">
            <p class="text-yellow-800">
                fdgdfgdfg
                <span class="text-gray-800">dfgdfgdf</span>
            </p>


        </div>
        <!-- <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
        <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div> -->
    </div>
</template>
