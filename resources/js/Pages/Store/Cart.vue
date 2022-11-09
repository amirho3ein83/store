<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PaymentLayout from "@/Layouts/PaymentLayout.vue";

import Order from "@/Components/Order.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { useCartStore } from "@/store/Cart.js";
import { useStorage } from "@/store/useStorage";
import EmptyCart from "../Store/Partial/EmptyCart.vue";
import AddressForm from "../Store/Partial/AddressForm.vue";

const storeCart = useCartStore();
defineProps({
    orders: Object,
});

let form_step = useStorage("form_step", 1);

const form = useForm({
    recipient_name: "",
    mobile: "",
    address: "",
    card_number: null,
    expirationYear: null,
    expirationMonth: null,
    cvc: null,
    saveInfo: null,
    paymentMethod: null,
});

const pay = () => {
    form.post(route("payment"), {
        onFinish: () => console.log("done"),
    });
};
</script>

<template>
    <AppLayout>
        <!-- <PaymentLayout> -->

            <div v-if="Object.keys(orders).length != 0  && formStep == 1" class="container mx-auto lg:px-28">
                <div class="flex flex-col md:flex-row bg-gray-200 shadow my-5">
                    <div class="w-full xl:w-2/3 overflow-y-auto h-auto  px-10 py-10">


                        <section class="text-gray-600 body-font">
        <div class="container sm:px-5 py-12 mx-auto flex flex-wrap">
            <div class="flex flex-col w-full">
                <div class=" flex  justify-center sm:gap-x-14">
                    <div class="flex relative px-2 flex-col items-center">
                        <div :class="{ 'bg-green-600': step == 1 }"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                            <i class="bi bi-cart-fill"></i>
                        </div>
                        <div class="flex-grow">
                            <h2 class="font-medium title-font text-sm text-purple-900 mb-1">
                                Cart
                            </h2>
                        </div>
                    </div>
                    <div class="flex relative px-2 flex-col items-center">
                        <div :class="{ 'bg-green-600': step == 2 }"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="flex-grow">
                            <h2 class="font-medium title-font text-sm text-purple-900 mb-1">
                                Address
                            </h2>
                        </div>
                    </div>
                    <div class="flex relative px-2 flex-col items-center">
                        <div :class="{ 'bg-green-600': step == 3 }"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                            <i class="bi bi-credit-card-2-back-fill"></i>
                        </div>
                        <div class="flex-grow">
                            <h2 class="font-medium title-font text-sm text-purple-900 mb-1">
                                Parment
                            </h2>
                        </div>
                    </div>

                </div>
                <slot />
            </div>
        </div>
    </section>

                        <Order v-for="order of orders" :order="order" />


                        <Link href="/category" class="flex font-semibold text-indigo-600 text-sm mt-4">

                        <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                            <path
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                        </svg>
                        Continue Shopping
                        </Link>
                    </div>

                    <div id="summary" class="w-full xl:w-1/3 px-8 md:py-20">
                        <div>
                            <p class="lg:text-4xl text-3xl font-black leading-9 text-gray-800 dark:text-white">Summary
                            </p>

                            <div class="my-8">
                                <div class="flex items-center justify-between pt-5">
                                    <p class="text-base leading-none text-gray-800 dark:text-white">Shipping estimate
                                    </p>
                                    <p class="text-base leading-none text-gray-800 dark:text-white">%14</p>
                                </div>
                                <div class="flex items-center justify-between pt-5">
                                    <p class="text-base leading-none text-gray-800 dark:text-white">Delivery cost</p>
                                    <p class="text-base leading-none text-gray-800 dark:text-white">$12</p>
                                </div>
                                <div class="flex items-center justify-between pt-5">
                                    <p class="text-base leading-none text-gray-800 dark:text-white">Tax </p>
                                    <p class="text-base leading-none text-gray-800 dark:text-white">%9</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center pb-6 justify-between lg:pt-5 pt-2">
                                <p class="text-2xl leading-normal text-gray-800 dark:text-white">Total</p>
                                <p class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white">
                                    ,240
                                </p>
                            </div>
                            <button onclick="form_step = 2"
                                class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700">Checkout</button>
                        </div>
                    </div>

                </div>













                <Transition name="fade">
                    <!-- <div v-if="formStep == 2" -->
                    <AddressForm />
                </Transition>

                <Transition name="fade">
                    <div v-if="formStep == 3"
                        class="flex mx-auto m-5  w-full lg:w-1/3  flex-col py-3 bg-gray-500 rounded-lg shadow-xl">
                        <div class=" max-w-lg px-4 ">
                            <fieldset class="col-span-6 border-t border-gray-200 my-1 py-2">
                                <legend class="mb-1 block text-sm text-gray-100 py-5">
                                    Card Details
                                </legend>

                                <div class="-space-y-px rounded-lg bg-white shadow-sm ">
                                    <div>
                                        <label class="sr-only" for="card-number">Card Number</label>

                                        <input disabled
                                            class="relative w-full rounded-t-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                            type="text" name="card-number" id="card-number" placeholder="Card number" />
                                    </div>

                                    <div class="flex -space-x-px">
                                        <div class="flex-1">
                                            <label class="sr-only" for="card-expiration-date">
                                                Expiration Date
                                            </label>

                                            <input disabled
                                                class="relative w-full rounded-bl-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                                type="text" name="card-expiration-date" id="card-expiration-date"
                                                placeholder="MM / YY" />
                                        </div>

                                        <div class="flex-1">
                                            <label class="sr-only" for="card-cvc">CVC</label>

                                            <input disabled
                                                class="relative w-full rounded-br-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                                type="text" name="card-cvc" id="card-cvc" placeholder="CVC" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center py-8 gap-3">
                                    <div>
                                        <input type="radio" name="paymentMethod" v-model="form.paymentMethod"
                                            value="wallet" id="wallet" class="peer hidden" checked />

                                        <label for="wallet"
                                            class="block cursor-pointer rounded-lg border border-gray-400 p-4 text-sm font-medium shadow-sm hover:border-gray-200 peer-checked:bg-gray-400 peer-checked:ring-1 peer-checked:ring-gray-50">
                                            <p class="text-gray-700">
                                                use my wallet
                                            </p>
                                        </label>
                                    </div>

                                    <div>
                                        <input type="radio" name="paymentMethod" v-model="form.paymentMethod"
                                            value="credit_card" id="credit_card" class="peer hidden" disabled />

                                        <label for="credit_card"
                                            class="block cursor-pointer rounded-lg border border-gray-400 p-4 text-sm font-medium shadow-sm hover:border-gray-200 peer-checked:bg-gray-400 peer-checked:ring-1 peer-checked:ring-gray-50">
                                            <p class="text-gray-700">
                                                credit card
                                            </p>
                                        </label>
                                    </div>
                                </div>

                                <div class="mx-auto flex justify-between">
                                    <button @click="formStep = 2"
                                        class="group relative self-end inline-flex items-center overflow-hidden rounded bg-yellow-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-yellow-500">
                                        <span
                                            class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                            <i class="bi bi-arrow-left"></i>
                                        </span>

                                        <span class="text-sm font-medium transition-all group-hover:ml-4">
                                            previous
                                        </span>
                                    </button>
                                    <button @click="pay"
                                        class="bg-green-600 shadow-xl hover:scale-105 text-lg text-white font-bold rounded-sm p-2  w-36">
                                        Pay
                                    </button>

                                </div>
                            </fieldset>
                            <div>

                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </Transition>
























            </div>
            <EmptyCart v-else />
        <!-- </PaymentLayout> -->
    </AppLayout>
</template>

<style scoped>
.fade-enter-active {
    transition: all 0.3s ease-out;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

i {
    font-size: 30px;
}
</style>
