<script setup>
import VueCountdown from "@chenfengyuan/vue-countdown";
import { ref } from "vue";
import { useProductStore } from "@/store/Product.js";

const storeProduct = useProductStore();

const props = defineProps({
    amazing_offer: Object,
});

// let product = ref(props.amazing_offer.product)
</script>

<template>
    <Transition>
        <div @click="storeProduct.showProduct(amazing_offer.product.id)" class="p-2 flex justify-center items-center">
            <div class="flex flex-col justify-between w-56 sm:w-72 h-72  bg-center text-gray-800 shadow-md overflow-hidden cursor-pointer"
                style="
                    background-image: url('https://cdn2.vectorstock.com/i/1000x1000/05/26/amazing-deals-golden-label-offers-badge-vector-19610526.jpg');
                ">
                <div class="flex justify-between items-center ml-4 pr-8">
                    <div
                        class="bg-red-600 w-12 h-12 shadow flex flex-col-reverse p-2 text-center font-bold text-white rounded-b-full">

                        {{ amazing_offer.discount }}%
                    </div>
                </div>
                <div class="bg-gray-100 bg-opacity-95 shadow-md rounded-r-xl p-2 flex flex-col mr-4 mb-4">
                    <div class="flex justify-between">
                        <h3 class="text-xl font-bold">
                            {{ product.title }}
                        </h3>

                        <div class="flex align-baseline gap-x-1">
                            <p class="text-red-400 line-through">{{
                                    product.sale_price
                            }}</p>
                            <h3 class="text-xl font-bold pb-2 text-yellow-600">
                                {{
                                        product.price
                                }}
                            </h3>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-xs">
                            <VueCountdown :time="amazing_offer.remaining_time * 1000"
                                v-slot="{ days, hours, minutes, seconds }">
                                <span class="text-red-700">
                                    {{ days }}:{{ hours }}:{{ minutes }}:{{
        seconds
                                    }}
                                </span>
                            </VueCountdown>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>
