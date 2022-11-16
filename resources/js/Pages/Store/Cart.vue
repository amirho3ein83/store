<script setup>


import Order from "@/Components/Order.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { useStorage } from "@/store/useStorage";
import EmptyCart from "../Store/Partial/EmptyCart.vue";
import { onMounted, onUnmounted, ref, watch } from "vue";
import { useCartStore } from "@/store/Cart.js";
import LoadingModal from "@/Modals/LoadingModal.vue";
import SuccessModal from "@/Modals/SuccessModal.vue";
import Navbar from "@/Components/Navbar.vue";

const storeCart = useCartStore();

let props = defineProps({
    orders: Object,
    subtotal: Number,
    user_address: Object,
    wallet: Object,
});

let form_step = useStorage("form_step", 1);

let show_loading_modal = ref(false)
let show_success_modal = ref(false)

let step = ref(form_step)

const form = useForm({
    recipient_name: "",
    address: "",
    mobile: "",
    postal_code: "",
    save_address: 0,
    card_number: null,
    expirationYear: null,
    expirationMonth: null,
    cvc: null,
    paymentMethod: 'wallet',
});

const pay = () => {
    show_loading_modal.value = true
    form.post(route("register.order"), {
        onSuccess: () => {
            show_loading_modal.value = false
            show_success_modal.value = true
        },
        onError: (e) => {
            show_loading_modal.value = false
            console.log(e);
        }
    });
};

onMounted(() => {
    storeCart.subtotal = props.subtotal
}
)

onUnmounted(() => {
    localStorage.removeItem("form_step");
})
</script>

<template>

    <Head title="Cart" />

    <Navbar v-if="step == 1" />
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
            class="flex  flex-col md:flex-row  shadow-transparent my-1">
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

            <div id="summary" class="w-full xl:w-1/3 px-8 py-4 sm:py-10 ">
                <div>

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
                    <p class="lg:text-4xl text-3xl font-black leading-9 text-gray-800 dark:text-white">Summary
                    </p>
                    <div class="my-8">

                        <div class="flex items-center justify-between pt-5">
                            <p class="text-base leading-none text-gray-800 dark:text-white">Subtotal</p>
                            <p class="text-base leading-none text-gray-800 dark:text-white">{{storeCart.subtotal}}</p>
                        </div>
                        <div class="flex items-center justify-between pt-5">
                            <p class="text-base leading-none text-gray-800 dark:text-white">Tax </p>
                            <p class="text-base leading-none text-gray-800 dark:text-white">{{Math.trunc(9 / 100 * storeCart.subtotal)}}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center pb-6 justify-between lg:pt-5 pt-2">
                        <p class="text-2xl font-bold leading-normal text-gray-800 dark:text-white">Total</p>
                        <p class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white">
                            {{ Math.trunc(storeCart.subtotal + (9 / 100 * storeCart.subtotal)) }}$
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



                        <div class="px-5 pt-3 pb-5 max-w-md mx-auto">
                            <input placeholder="Name" v-model="form.recipient_name"
                                class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-gray-200 dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input v-model="form.address" placeholder="Address"
                                class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-gray-200 dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <div class="flex-grow w-full ">


                                <input placeholder="Postal code" v-model="form.postal_code"
                                    class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-gray-200 dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            </div>
                            <div class="flex-grow">
                                <input placeholder="Mobile" v-model="form.mobile"
                                    class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-gray-200 dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            </div>

                        </div>
                        <!-- <div class="flex items-center justify-center mb-6">
                            <div class="flex items-center h-5">
                                <input  type="checkbox" v-model="form.save_address"
                                    class="w-5 h-5 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                                    required>
                            </div>
                            <label for="remember"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-slate-700">save as default
                                address</label>
                        </div> -->

                        <!-- Component Start -->
                        <div class="flex justify-center gap-2 w-full max-w-screen-sm">
                            <div>
                                <input v-model="form.save_address" value="1" class="hidden" id="radio_1" type="radio"
                                    name="radio" disabled>
                                <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer" for="radio_1">
                                    <span class="text-xs font-semibold uppercase">save for later</span>

                                </label>
                            </div>
                            <div>
                                <input v-if="user_address != null" v-model="form.save_address" value="0" class="hidden"
                                    id="radio_2" type="radio" name="radio" checked>
                                <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer" for="radio_2">
                                    <span class="text-xs font-semibold uppercase">use default address</span>

                                </label>
                            </div>

                        </div>

                        <hr class="mt-4">
                        <div class="flex justify-between p-3">
                            <button @click="step = 1"
                                class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500">
                                <span
                                    class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                    <i class="bi bi-arrow-left"></i>

                                </span>

                                <span class="text-sm font-medium transition-all group-hover:ml-4">
                                    previous
                                </span>
                            </button> <button @click="step = 3"
                                class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500">
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
                        <template v-if="user_address != null">
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
                        </template>


                    </div>
                </div>
            </div>


        </Transition>

        <Transition name="fade">

            <div class=" mx-auto w-full m-auto  max-w-md self-center" v-if="step == 3">
                <div class="credit-card w-full sm:w-auto shadow-lg mx-auto rounded-xl my-12 bg-gray-400 ">
                    <header class="flex items-center px-2">

                        <p class="text-xl py-4 font-semibold text-gray-700 text-center">disbursement amount</p>
                        <p class="text-xl py-4 font-semibold text-yellow-700 text-center ml-3"> {{ subtotal }}$</p>

                    </header>
                    <main class="mt-4 p-4">
                        <div class="">

                            <div class="my-3">
                                <input type="text"
                                    class="block w-full text-2xl px-5 py-2 border rounded-lg bg-gray-200 shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                                    placeholder="Card number" v-model="form.card_number" maxlength="16" />
                            </div>
                            <div class="my-3 flex flex-col">
                                <div class="mb-2">
                                    <label for="" class="text-gray-700">Expired</label>
                                </div>
                                <div class="flex  gap-2">
                                    <select name="" id=""
                                        class="form-select appearance-none block w-full px-5 py-2 border rounded-lg bg-gray-200 shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                                        v-model="form.expirationMonth">
                                        <option value="" selected disabled>MM</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select name="" id=""
                                        class="form-select appearance-none block w-full px-5 py-2 border rounded-lg bg-gray-200 shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                                        v-model="form.expirationYear">
                                        <option value="" selected disabled>YY</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                    </select>
                                    <input type="text"
                                        class="block w-full col-span-2 px-5 py-2 border rounded-lg bg-gray-200 shadow-lg placeholder-gray-400 text-gray-700 focus:ring focus:outline-none"
                                        placeholder="cvc" maxlength="4" v-model="form.cvc" />
                                </div>


                                <div class="flex justify-center mt-5 gap-2 w-full max-w-screen-sm">
                                    <div>
                                        <input v-model="form.paymentMethod" value="wallet" class="hidden" id="radio_1"
                                            type="radio" name="radio" checked>
                                        <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer"
                                            for="radio_1">
                                            <span class="text-sm text-yellow-800 font-semibold uppercase"> my wallet
                                                {{ wallet.balance }}$</span>

                                        </label>
                                    </div>
                                    <div>
                                        <input v-if="user_address != null" v-model="form.paymentMethod"
                                            value="credit_card" class="hidden" id="radio_2" type="radio" name="radio"
                                            disabled>
                                        <label class="flex flex-col p-4 border-2 border-gray-400 cursor-pointer"
                                            for="radio_2">
                                            <span class="text-sm font-semibold uppercase"> credit card</span>

                                        </label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </main>
                    <footer class="p-2 flex justify-between">
                        <button @click="step = 2"
                            class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500">
                            <span
                                class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                <i class="bi bi-arrow-left"></i>

                            </span>

                            <span class="text-sm font-medium transition-all group-hover:ml-4">
                                previous
                            </span>
                        </button>
                        <button @click="pay"
                            class="inline-block rounded bg-[#6fe60e] px-8 py-3 text-sm font-medium text-slate-700 transition hover:scale-105 hover:shadow-xl ">
                            Pay now
                        </button>
                    </footer>
                </div>
            </div>
        </Transition>

        <LoadingModal v-if="show_loading_modal" />
        <SuccessModal v-if="show_success_modal" />
    </div>
</template>

<style scoped>
input:checked+label {
    border-color: black;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

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
