<script setup>
import JetInputError from "@/Components/InputError.vue";

import Order from "@/Components/Order.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { useStorage } from "@/store/useStorage";
import EmptyCart from "../Store/Partial/EmptyCart.vue";
import { onMounted, onUnmounted, ref, watch } from "vue";
import { useCartStore } from "@/store/Cart.js";
import LoadingModal from "@/Modals/LoadingModal.vue";
import SuccessModal from "@/Modals/SuccessModal.vue";
import Navbar from "@/Components/Navbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const storeCart = useCartStore();

let props = defineProps({
    orders: Object,
    subtotal: Number,
    user_address: Object,
    wallet: Object,
});

let show_loading_modal = ref(false);
let show_success_modal = ref(false);

const form = useForm({
    recipient_name: "",
    address: "",
    mobile: "",
    postal_code: "",
    save_address_as_default: false,
    use_default_address: true,
    card_number: null,
    expirationYear: null,
    expirationMonth: null,
    cvc: null,
    useWallet: true,
});

const pay = () => {
    show_loading_modal.value = true;
    form.post(route("register.order"), {
        onSuccess: () => {
            show_loading_modal.value = false;
            show_success_modal.value = true;
        },
        onError: (e) => {
            show_loading_modal.value = false;
            console.log(e);
        },
    });
};

onMounted(() => {
    storeCart.subtotal = props.subtotal;
});
</script>

<template>
    <Head title="Cart" />

    <Navbar />

    <div class="xl:container mx-auto lg:px-28">
        <div
            v-if="Object.keys(orders).length != 0"
            class="flex flex-col md:flex-row shadow-transparent"
        >
            <div
                id="summary"
                class="w-full xl:w-1/2 px-12 py-8 sm:py-10 bg-stone-50"
            >
                <Order v-for="order of orders" :order="order" :key="order.id" />
                <div>
                    <p
                        class="lg:text-2xl text-xl border-t-2 py-3 font-black leading-9 text-gray-800 dark:text-white"
                    >
                        Summary
                    </p>

                    <div class="my-4">
                        <div class="flex items-center justify-between pt-5">
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                Subtotal
                            </p>
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                {{ storeCart.subtotal }}$
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-5">
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                Tax
                            </p>
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                {{
                                    Math.trunc((9 / 100) * storeCart.subtotal)
                                }}$
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div
                        class="flex items-center pb-6 justify-between lg:pt-5 pt-2"
                    >
                        <p
                            class="text-2xl font-bold leading-normal text-gray-800 dark:text-white"
                        >
                            Total
                        </p>
                        <p
                            class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white"
                        >
                            {{
                                Math.trunc(
                                    storeCart.subtotal +
                                        (9 / 100) * storeCart.subtotal
                                )
                            }}$
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-1/2 px-8 sm:py-4">
                <form @submit.prevent="pay()" class="space-y-4">
                    <div class="mt-5 bg-stone-50 rounded-lg shadow">
                        <div class="flex">
                            <div class="flex-1 py-1 pl-5 overflow-hidden">
                                <i class="bi bi-geo-alt"></i>
                                <h1
                                    class="inline text-lg font-semibold leading-none"
                                >
                                    Address
                                </h1>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <input
                                :disabled="form.use_default_address"
                                v-model="form.recipient_name"
                                type="text"
                                placeholder="recipient name"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                            />

                            <input
                                :disabled="form.use_default_address"
                                v-model="form.address"
                                type="text"
                                placeholder="Address"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                            />
                            <div class="flex">
                                <div class="flex-grow w-1/2 pr-2">
                                    <input
                                        :disabled="form.use_default_address"
                                        type="number"
                                        v-model="form.mobile"
                                        placeholder="mobile"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                                    />
                                </div>
                                <div class="flex-grow">
                                    <input
                                        :disabled="form.use_default_address"
                                        v-model="form.postal_code"
                                        type="number"
                                        placeholder="postal code"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                                    />
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div
                                    v-if="user_address"
                                    class="flex items-center pt-3"
                                >
                                    <input
                                        :disabled="form.use_default_address"
                                        v-model="form.save_address_as_default"
                                        type="checkbox"
                                        class="w-5 h-5 text-stone-700 bg-gray-300 border-none rounded-md focus:ring-transparent"
                                    /><label
                                        for="safeAdress"
                                        class="block ml-2 text-sm text-gray-900"
                                        >Save as default address</label
                                    >
                                </div>
                                <div class="flex items-center pt-3">
                                    <input
                                        v-model="form.use_default_address"
                                        type="checkbox"
                                        class="w-5 h-5 text-stone-700 bg-gray-300 border-none rounded-md "
                                    /><label
                                        for="use_default_address"
                                        class="block ml-2 text-sm text-gray-900"
                                        >Use default address</label
                                    >
                                </div>
                            </div>
                        </div>

                        <div
                            class="ml-5 border-t-2 pt-2 flex justify-between px-2 align-baseline items-center gap-2"
                        >
                            <h1
                                class="inline text-md font-semibold leading-none"
                            >
                                Card details
                            </h1>
                            <div class="flex items-center pt-3">
                                <input
                                    :checked="form.useWallet"
                                    v-model="form.useWallet"
                                    type="checkbox"
                                    class="w-5 h-5 text-stone-700 bg-gray-300 border-none rounded-md focus:ring-transparent"
                                /><label
                                    for="safeAdress"
                                    class="block ml-2 text-sm text-gray-900"
                                    >Use my wallet</label
                                >
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <input
                                :disabled="form.useWallet"
                                v-model="form.card_number"
                                type="number"
                                max="16"
                                min="16"
                                placeholder="card number"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                            />

                            <div class="flex">
                                <div class="flex-grow w-1/4 pr-2">
                                    <input
                                        :disabled="form.useWallet"
                                        type="number"
                                        min="2"
                                        max="2"
                                        v-model="form.expirationMonth"
                                        placeholder="expiry month"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                                    />
                                </div>
                                <div class="flex-grow w-1/4 pr-2">
                                    <input
                                        :disabled="form.useWallet"
                                        v-model="form.expirationYear"
                                        placeholder="expiry year"
                                        type="number"
                                        min="4"
                                        max="4"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                                    />
                                </div>
                                <div class="flex-grow w-1/4 pr-2">
                                    <input
                                        :disabled="form.useWallet"
                                        v-model="form.cvc"
                                        placeholder="CVC"
                                        type="number"
                                        min="4"
                                        max="4"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <PrimaryButton
                            class="text-base self-center leading-none w-2/3 content-center justify-center py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Checkout
                        </PrimaryButton>
                    </div>
                </form>
                <div
                    v-for="error of form.errors"
                    :key="error"
                    class="shadow w-2/3 p-2 flex justify-center rounded-lg"
                >
                    <div
                        class="bg-red-500 animate-pulse inline-block rounded-lg p-1 mr-1"
                    ></div>
                    <p class="p-1">{{ error }}!</p>
                </div>
            </div>
        </div>
        <EmptyCart v-if="Object.keys(orders).length == 0" />

        <LoadingModal v-if="show_loading_modal" />
        <SuccessModal v-if="show_success_modal" />
    </div>
</template>

<style scoped>
input:checked + label {
    border-color: black;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
