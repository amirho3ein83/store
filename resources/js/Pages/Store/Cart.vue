<script setup>
import JetInputError from "@/Components/InputError.vue";

import OrderItem from "@/Components/OrderItem.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { useStorage } from "@/store/useStorage";
import EmptyCart from "../Store/Partial/EmptyCart.vue";
import { onMounted, onUnmounted, ref, watch } from "vue";
import { useCartStore } from "@/store/Cart.js";
import LoadingModal from "@/Modals/LoadingModal.vue";
import SuccessModal from "@/Modals/SuccessModal.vue";
import Navbar from "@/Components/Navbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ConfirmPaymentTrigger from "@/Modals/triggers/ConfirmPaymentTrigger.vue";
import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";
const storeCart = useCartStore();

let props = defineProps({
    order: Object,
    subtotal: Number,
    userAddress: Object,
    wallet: Object,
});

let show_loading_modal = ref(false);
let show_success_modal = ref(false);
let useWallet = ref(false);

const deliveryCost = 18;

const form = useForm({
    recipient_name: "",
    address: "",
    mobile: "",
    zipcode: "",
    save_address_as_default: false,
    use_default_address: true,
});

const pay = () => {
    show_loading_modal.value = true;
    setTimeout(() => {
        show_loading_modal.value = false;
    }, 8000);
    form.post(route("order.payment.wallet", { order: props.order.id }), {
        onSuccess: () => {
            show_loading_modal.value = false;
            show_success_modal.value = true;
            storeCart.count_cart = 0;
        },
        onError: (e) => {
            show_loading_modal.value = false;
            console.log(e);
        },
    });
};

const showError = (error) => {
    createToast(error, {
        position: "bottom-right",
        transition: "zoom",
        type: "danger",
        toastBackgroundColor: "#fc4242",
        timeout: 2900,
        hideProgressBar: "true",
    });
    form.errors = null;
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
            v-if="order"
            class="flex flex-col md:flex-row md:gap-x-8 shadow-transparent"
        >
            <div
                id="summary"
                class="w-full xl:w-1/2 px-4 py-8 sm:py-10 bg-stone-50"
            >
                <OrderItem
                    v-for="orderItem of order.items"
                    :orderItem="orderItem"
                    :key="orderItem.id"
                />
                <hr />

                <div class="">
                    <p
                        class="lg:text-2xl text-xl py-3 font-black leading-9 text-gray-800 dark:text-white"
                    >
                        خلاصه سبد
                    </p>

                    <div class="my-4">
                        <div class="flex items-center justify-between pt-5">
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                مجموع
                            </p>
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                {{ storeCart.subtotal }} تومان
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-5">
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                مالیات ٪۹
                            </p>
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                {{ Math.trunc((9 / 100) * storeCart.subtotal) }}
                                تومان
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-5">
                            <p
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                هزینه ارسال
                            </p>
                            <p
                                v-if="storeCart.subtotal <= 500000"
                                class="text-base leading-none text-gray-800 dark:text-white"
                            >
                                {{ deliveryCost }} تومان
                            </p>
                            <p
                                v-else
                                class="text-base leading-none text-red-800 dark:text-white"
                            >
                                رایگان
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
                            جمع کل
                        </p>
                        <p
                            class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white"
                        >
                            {{
                                Math.trunc(
                                    storeCart.subtotal +
                                        (9 / 100) * storeCart.subtotal
                                ) + deliveryCost
                            }}
                            تومان
                        </p>
                    </div>

                    <div class="flex w-full shadow-sm rounded-lg py-4">
                        <div
                            class="px-1 py-2 flex justify-between items-center w-full"
                        >
                            <div>
                                ارسال رایگان
                                <span class="text-stone-700 text-sm"
                                    >برای خرید بالای ۵۰۰ هزار تومان</span
                                >
                            </div>
                        </div>
                        <div
                            class="bg-[#8bb9e8] py-1 px-3 rounded-lg flex items-center"
                        >
                            <i class="bi bi-truck"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-1/2 sm:py-10">
                <form @submit.prevent="pay()" class="space-y-4">
                    <div class="mt-5 bg-stone-50 rounded-lg">
                        <div class="flex">
                            <div class="flex-1 py-1 px-5 overflow-hidden">
                                <h1
                                    class="inline text-lg font-semibold leading-none"
                                >
                                    آدرس
                                </h1>
                                <i class="bi bi-geo-alt"></i>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <input
                                :disabled="form.use_default_address"
                                v-model="form.recipient_name"
                                type="text"
                                placeholder="نام گیرنده"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                            />

                            <input
                                :disabled="form.use_default_address"
                                v-model="form.address"
                                type="text"
                                placeholder="نشانی"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                            />
                            <div class="flex">
                                <div class="flex-grow w-1/2 pr-2">
                                    <input
                                        :disabled="form.use_default_address"
                                        type="number"
                                        v-model="form.mobile"
                                        placeholder="موبایل"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                                    />
                                </div>
                                <div class="flex-grow">
                                    <input
                                        :disabled="form.use_default_address"
                                        v-model="form.zipcode"
                                        type="number"
                                        placeholder="کدپستی"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100"
                                    />
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div
                                    v-if="userAddress"
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
                                        >ذخیره به عنوان آدرس پیش فرض</label
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 mb-3 px-5">
                        <div class="flex justify-end">
                            <div class="flex items-center py-3 gap-2">
                                <p>استفاده از آدرس پیش فرض</p>
                                <input
                                    v-model="form.use_default_address"
                                    type="checkbox"
                                    class="w-5 h-5 text-stone-700 bg-gray-300 border-none rounded-md"
                                />
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.text }}
                        </p>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.recipient_name }}
                        </p>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.zipcode }}
                        </p>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.mobile }}
                        </p>
                    </div>
                    <div class="flex justify-between px-5 sm:pb-2 pb-20">
                        <div class="flex justify-between">
                            <div class="flex items-center pt-3">
                                <input
                                    v-model="useWallet"
                                    type="checkbox"
                                    class="w-6 h-6 text-stone-700 bg-gray-300 border-none rounded-md focus:ring-transparent"
                                /><label
                                    for="safeAdress"
                                    class="block ml-2 text-md text-gray-900"
                                    >از کیف پول استفاده کن</label
                                >
                            </div>
                        </div>
                        <button
                            v-if="useWallet"
                            type="submit"
                            :disabled="form.processing"
                            class="w-1/4 self-end rounded bg-[#e3d4a1] px-1 py-3 text-center text-md font-medium text-slate-900 transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-green-500"
                        >
                            پرداخت
                        </button>
                        <ConfirmPaymentTrigger
                            v-else
                            :amount="
                                Math.trunc(
                                    storeCart.subtotal +
                                        (9 / 100) * storeCart.subtotal
                                ) + deliveryCost
                            "
                            :disabled="false"
                            :for="`Order`"
                            :requestPath="`order.payment.request`"
                            :gatewayPath="`order.payment.gateway`"
                        />
                    </div>
                </form>

                <div v-if="form.errors">
                    <div v-for="error of form.errors" :key="error">
                        {{ showError(error) }}
                    </div>
                </div>
            </div>
        </div>
        <EmptyCart v-else />
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
