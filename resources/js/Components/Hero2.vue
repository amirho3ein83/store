<script setup>
import VueCountdown from "@chenfengyuan/vue-countdown";

defineProps({
    product: Object,
    remaining_time: String,
});
</script>

<template>
    <Transition>
        <!-- <div
            class="flex flex-col justify-center items-center max-w-sm mx-auto my-8"
        >
            <span class="absolute t-0 r-0 bg-red-600">%10</span>
            <div
                style="
                    background-image: url(https://images.unsplash.com/photo-1539185441755-769473a23570?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1951&q=80;;;;;;;;;;;;;;;;;;
                "
                class="bg-gray-300 h-64 w-full rounded-lg shadow-md bg-cover bg-center"
            ></div>
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
                    <VueCountdown
                        :time="remaining_time * 1000"
                        v-slot="{ days, hours, minutes, seconds }"
                    >
                        <span class="text-red-700">
                            {{ days }}:{{ hours }}:{{ minutes }}:{{ seconds }}
                        </span>
                    </VueCountdown>
                </div>
            </div>
        </div> -->
        <!-- component -->
        <div class="p-2 flex justify-center items-center">
            <div
                class="flex flex-col justify-between w-56 sm:w-72 h-72 bg-white bg-center text-gray-800 shadow-md overflow-hidden cursor-pointer"
                style="
                    background-image: url('https://st2.depositphotos.com/1000375/9917/v/950/depositphotos_99171422-stock-illustration-gift-coupon-discount-card-template.jpg');
                "
            >
            <!-- <img src="../Pages/Store/Products/pics/amazing-offer.jpg" class="" alt=""> -->
                <div class="flex justify-between items-center ml-4 pr-8">
                    <div
                        class="bg-red-600 w-12 h-12 shadow flex flex-col-reverse p-2 text-center font-bold text-white rounded-b-full"
                    >
                        {{ product.discount }}%
                    </div>
                </div>
                <div
                    class="bg-gray-100 bg-opacity-95 shadow-md rounded-r-xl p-2 flex flex-col mr-4 mb-4"
                >
                    <div class="flex justify-between">
                        <h3 class="text-xl font-bold ">
                            {{ product.title }}
                        </h3>
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold pb-2 line-through">
                                {{ product.price }} $
                            </h3>
                            <span class="text-indigo-500">{{
                             -   (
                                    (product.discount / 100) *
                                    product.price
                                ).toFixed(2)
                            }}</span>
                        </div>
                        <h3 class="text-xl font-bold pb-2 text-yellow-700">
                            {{
                                product.price -
                                (
                                    (product.discount / 100) *
                                    product.price
                                ).toFixed(2)
                            }}
                        </h3>
                    </div>
                    <p class="truncate text-gray-500 text-sm">
                        {{ product.description }}
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-xs">
                            <VueCountdown
                                :time="remaining_time * 1000"
                                v-slot="{ days, hours, minutes, seconds }"
                            >
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
