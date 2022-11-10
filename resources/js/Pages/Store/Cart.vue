<script setup>


import Order from "@/Components/Order.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { useStorage } from "@/store/useStorage";
import EmptyCart from "../Store/Partial/EmptyCart.vue";
import { onUnmounted, ref } from "vue";
import { useCartStore } from "@/store/Cart.js";

const storeCart = useCartStore();
defineProps({
    orders: Object,
    user_address: Object,
});

let form_step = useStorage("form_step", 1);

let step = ref(form_step)
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


onUnmounted(() => {
    localStorage.removeItem("form_step");
})
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout
}
</script>
<template>

    <div v-if="Object.keys(orders).length != 0" class="flex flex-col w-full pt-4">
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

    <div class="container mx-auto lg:px-28">
        <div v-if="Object.keys(orders).length != 0 && step == 1"
            class="flex flex-col md:flex-row bg-gray-200 shadow my-5">
            <div class="w-full xl:w-2/3 overflow-y-auto h-auto  px-8 sm:py-10">




                <Order v-for="order of orders" :order="order" />


                <Link href="/category" class="flex font-semibold text-indigo-600 text-sm mt-4">

                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Continue Shopping
                </Link>
            </div>

            <div id="summary" class="w-full xl:w-1/3 px-8 py-4 sm:py-10 border-t-2">
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
                    <div>
                    <div class="flex w-full items-center  shadow-lg mb-4  bg-yellow-500 p-2 rounded text-white">
                        <div class="w-64">
                            <p class="text-gray-800 text-md">Free delivery </p>
                            <p class="text-gray-900 text-sm">with purchases over $500 dollar </p>
                        </div>
                        <div class="w-12">
                            <i class="bi bi-truck text-slate-900"></i>
                        </div>
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
                    <button @click="step = 2"
                        class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700">Checkout</button>
                </div>


            </div>

        </div>
        <EmptyCart v-if="Object.keys(orders).length == 0" />

        <Transition name="fade">
            <!-- address form -->
            <div v-if="step == 2" class="m-auto max-w-xl">
                <div>

                    <div class="mt-5 bg-gray-400 rounded-lg shadow">


                        <div class="flex">
                            <div class="flex-1 py-5 pl-5 overflow-hidden">

                                <h1 class="inline text-gray-900 text-2xl font-semibold leading-none">Receiver</h1>
                            </div>
                            <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                        </div>
                        <div class="px-5 pb-5 max-w-md mx-auto">
                            <input placeholder="Name"
                                class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"><input
                                placeholder="Address"
                                class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <div class="flex-grow w-full "><input placeholder="Postal code"
                                    class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            </div>
                            <div class="flex-grow"><input placeholder="Mobile"
                                    class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            </div>

                        </div>
                        <div class="flex items-center justify-center mb-6">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox"
                                    class="w-5 h-5 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                                    required>
                            </div>
                            <label for="remember"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-slate-700">save as default
                                address</label>
                        </div>
                        <hr class="mt-4">
                        <div class="flex justify-between p-3">
                            <button @click="step = 1"
                                class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500"
                                href="/download">
                                <span
                                    class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                    <i class="bi bi-arrow-left"></i>

                                </span>

                                <span class="text-sm font-medium transition-all group-hover:ml-4">
                                    previous
                                </span>
                            </button> <button @click="step = 3"
                                class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500"
                                href="/download">
                                <span class="text-sm font-medium transition-all group-hover:mr-4">
                                    next
                                </span>
                                <span
                                    class="absolute right-0 translate-x-full transition-transform group-hover:-translate-x-4">
                                    <i class="bi bi-arrow-right"></i>
                                </span>

                            </button>

                        </div>
                    </div>
                    <div class="my-5 flex flex-col justify-around   cursor-pointer rounded-xl">
                        <!-- use default address button -->
                        <div class="self-center m-2">
                            <button @click="step = 3"
                                class="group relative inline-block overflow-hidden border border-[#b0870b] bg-[#b0870b] px-8 py-3 focus:outline-none focus:ring">
                                <span
                                    class="absolute inset-y-0 left-0 w-[2px] bg-[#bf930f] transition-all group-hover:w-full group-active:bg-[#bf930f]"></span>

                                <span
                                    class="relative text-md bold text-[#000000] transition-colors group-hover:text-white">
                                    use default address
                                </span>
                            </button>
                        </div>
                        <div class="shadow-lg rounded-lg bg-gray-700 mx-auto px-8 p-4 notification-box flex">

                            <div>
                                <h3 class="text-lg pb-2 text-cyan-50">
                                    recipient : {{ user_address.recipient_name }}
                                </h3>
                                <p class="text-sm text-yellow-100  tracking-tight ">
                                    address : {{ user_address.text }}

                                </p>
                                <p class="text-sm text-green-200  tracking-tight ">
                                    postal code : {{ user_address.postal_code }}

                                </p>
                                <p class="text-sm text-green-200  tracking-tight ">
                                    mobile : {{ user_address.mobile }}
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </Transition>

        <Transition name="fade">
            <div v-if="step == 3"
                class="flex mx-auto m-5  w-full lg:w-1/3  flex-col my-20 bg-gray-500 rounded-lg shadow-xl">
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
                                <input type="radio" name="paymentMethod" v-model="form.paymentMethod" value="wallet"
                                    id="wallet" class="peer hidden" checked />

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
                            <button @click="step = 2"
                                class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500"
                                href="/download">
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
    font-size: 24;
}
</style>
