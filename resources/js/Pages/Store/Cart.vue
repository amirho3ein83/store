<script setup>
import JetInputError from "@/Components/InputError.vue";

import OrderItem from "@/Components/OrderItem.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { useStorage } from "@/store/useStorage";
import EmptyCart from "../Store/Partial/EmptyCart.vue";
import {
    computed,
    onBeforeMount,
    onMounted,
    onUnmounted,
    ref,
    watch,
} from "vue";
import { useCartStore } from "@/store/Cart.js";
import LoadingModal from "@/Modals/LoadingModal.vue";
import SuccessModal from "@/Modals/SuccessModal.vue";
import Navbar from "@/Components/Navbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ConfirmPaymentTrigger from "@/Modals/triggers/ConfirmPaymentTrigger.vue";
import ConfirmPaymentModal2 from "@/Modals/ConfirmPaymentModal2.vue";
import ConfirmPaymentModal from "@/Modals/ConfirmPaymentModal.vue";
import { createToast } from "mosha-vue-toastify";
import { forEach } from "lodash";
const storeCart = useCartStore();

let props = defineProps({
    order: Object,
    subtotal: Number,
    userAddress: Object,
    walletBalance: Number,
    cartIsEmpty: Boolean,
});

let show_loading_modal = ref(false);
let show_success_modal = ref(false);
let useWallet = ref(false);
let showConfirmModal = ref(false);
let payOnlyWithWallet = ref(false);

const deliveryCost = 18000;

const form = useForm({
    recipient_name: "",
    address: "",
    mobile: "",
    zipcode: "",
    save_address_as_default: false,
    use_default_address: true,
    use_wallet: false,
});


const payWithZarinpal = () => {
    show_loading_modal.value = true;
    setTimeout(() => {
        show_loading_modal.value = false;
    }, 8000);
    form.post(route("order.payment.request", { order: props.order.id, useWallet: useWallet }), {
        onSuccess: () => {
            show_loading_modal.value = false;
            showConfirmModal.value = true;
        },
        onError: (e) => {
            show_loading_modal.value = false;
            console.log(e);
        },
    });
};

const payOnlyUsingWallet = () => {
    show_loading_modal.value = true;
    setTimeout(() => {
        show_loading_modal.value = false;
    }, 8000);
    form.post(route("pay.with.wallet"), {
        onSuccess: () => {
            show_loading_modal.value = false;
            show_success_modal.value = true;
            storeCart.count_cart = 0;
        },
        onError: (e) => {
            show_loading_modal.value = false;
            createToast(e.getMessage(), {
                position: "bottom-right",
                transition: "zoom",
                type: "danger",
                toastBackgroundColor: "#db5151",
                timeout: 2300,
                hideProgressBar: true,
            });
            console.log(e);
        },
    });
};

// watch(useWallet, (checked) => {
// if(checked){
//     // storeCart.decutFromWallet(props.walletBalance)
//     total -= props.walletBalance;

// }else{
//     // storeCart.dontDecutFromWallet(props.walletBalance)
//     total += props.walletBalance;

// }
// });

const showError = (error) => {
    createToast(error, {
        position: "bottom-right",
        transition: "zoom",
        type: "danger",
        toastBackgroundColor: "#db5151",
        timeout: 2300,
        hideProgressBar: true,
    });
    form.errors = {};
};

const onlyNumber = (event) => {
    let keyCode = event.keyCode ? event.keyCode : event.which;
    if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        event.preventDefault();
    }
};

const total = computed(() => {
    if (storeCart.count_cart != 0) {
        return (
            Math.trunc(storeCart.subtotal + (9 / 100) * storeCart.subtotal) +
            deliveryCost
        ).toLocaleString("ar-EG");
    }
});

const orderItemsCount = computed(() => {
    if (storeCart.count_cart != 0) {
        return (
            props.order.items.length
        ).toLocaleString("ar-EG");
    }
});




const finalAmount = computed(() => {
    if (storeCart.count_cart != 0 && useWallet) {
        if (props.walletBalance > Math.trunc(storeCart.subtotal + (9 / 100) * storeCart.subtotal) +
            deliveryCost) {
            payOnlyWithWallet = true
            return (0).toLocaleString("ar-EG");
        }
        return (
            Math.trunc(storeCart.subtotal + (9 / 100) * storeCart.subtotal) +
            deliveryCost - props.walletBalance
        ).toLocaleString("ar-EG");
    } else {
        payOnlyWithWallet = fasle
        return total;
    }


});

const tax = computed(() => {
    if (storeCart.count_cart != 0) {
        return Math.trunc((9 / 100) * storeCart.subtotal).toLocaleString(
            "ar-EG"
        );
    }
});

const subtotal = computed(() => {
    return storeCart.subtotal ? storeCart.subtotal.toLocaleString("ar-EG") : "";
});

onMounted(() => {
    storeCart.subtotal = props.subtotal;
});
</script>

<template>
    <Head title="Cart" />

    <Navbar />
    <div class="xl:container mx-auto lg:px-28 my-10">
        <div v-if="cartIsEmpty == false" class="flex flex-col md:flex-row md:gap-x-8 shadow-transparent">
            <div id="summary" class="w-full xl:w-1/2 px-4 py-8 sm:py-10 bg-stone-50 my-7">
                <OrderItem v-for="orderItem of order.items" :orderItem="orderItem" :key="orderItem.id" />
                <hr />

                <div class="">
                    <div>

                        <div class="flex items-center justify-between pt-5">
                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                {{ orderItemsCount }} کالا
                            </p>
                            <p class="lg:text-xl text-lg py-3 leading-9 text-gray-800 dark:text-white">
                            خلاصه سبد
                        </p>
                        </div>
                    </div>

                    <div class="my-4">
                        <div class="flex items-center justify-between pt-5">
                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                مجموع
                            </p>
                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                {{ subtotal }}
                                تومان
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-5">
                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                مالیات ٪۹
                            </p>
                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                {{ tax }}
                                تومان
                            </p>
                        </div>
                        <div class="flex items-center justify-between pt-5">
                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                هزینه ارسال
                            </p>
                            <p v-if="storeCart.subtotal <= 500000"
                                class="text-base leading-none text-gray-800 dark:text-white">
                                {{ deliveryCost.toLocaleString("ar-EG") }} تومان
                            </p>
                            <p v-else class="text-base leading-none text-red-800 dark:text-white">
                                رایگان
                            </p>
                        </div>
                        <div :class="{ invisible: !useWallet }"
                            class="animate-fade flex items-center justify-between pt-5 ">
                            <p class="text-base leading-none text-gray-800 dark:text-white">
                                کسر از کیف پول
                            </p>
                            <p v-if="Math.trunc(storeCart.subtotal + (9 / 100) * storeCart.subtotal) +
                                deliveryCost
                                >= walletBalance" class="text-base leading-none text-red-800 dark:text-white">
                                {{ walletBalance.toLocaleString("ar-EG") }} - تومان
                            </p>
                            <p v-else class="text-base leading-none text-red-800 dark:text-white">
                                {{ total }} - تومان
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center pb-6 justify-between lg:pt-5 pt-2">
                        <p class="text-lg font-semibold leading-normal text-gray-700 dark:text-white">
                            جمع کل
                        </p>
                        <p class="text-lg font-semibold leading-normal text-right text-gray-700 dark:text-white">
                            {{ total }}
                            تومان
                        </p>
                    </div>
                    <div class="flex items-center pb-6 justify-between lg:pt-5 pt-2">
                        <p class="text-xl font-semibold leading-normal text-gray-700 dark:text-white">
                            مبلغ پرداختی نهایی
                        </p>
                        <p v-if="useWallet"
                            class="text-xl font-semibold leading-normal text-right text-gray-700 dark:text-white">
                            {{ finalAmount }}
                            تومان
                        </p>
                        <p v-else class="text-xl font-semibold leading-normal text-right text-gray-700 dark:text-white">
                            {{ total }}
                            تومان
                        </p>
                    </div>

                    <div class="flex w-full shadow-sm rounded-lg py-4">
                        <div class="px-1 py-2 flex justify-end items-center w-full">
                            <span class="text-stone-700 text-sm"> ارسال رایگان برای خرید بالای ۵۰۰ هزار تومن </span>
                            <i class="bi bi-truck p-3 mt-1"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-1/2 sm:py-10">
                <form @submit.prevent="" class="space-y-4">
                    <div class="mt-5 bg-stone-50 rounded-lg">
                        <div class="flex">
                            <div class="flex-1 py-1 px-5 overflow-hidden">
                                <h1 class="inline text-lg font-semibold leading-none ">
                                    آدرس
                                </h1>
                                <i class="bi bi-geo-alt"></i>

                            </div>
                        </div>
                        <div :class="{
                            'blur-[1.5px]':
                                form.use_default_address == true,
                        }" class="px-5 pb-5">
                            <input autofocus :disabled="form.use_default_address == true" v-model="form.recipient_name"
                                type="text" placeholder="نام گیرنده"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100" />

                            <input :disabled="form.use_default_address == true" v-model="form.address" type="text"
                                placeholder="نشانی"
                                class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100" />
                            <div class="flex">
                                <div class="flex-grow w-1/2 pr-2">
                                    <input :disabled="form.use_default_address == true
                                        " type="text" @keypress="onlyNumber" v-model="form.mobile" placeholder="موبایل"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100" />
                                </div>
                                <div class="flex-grow">
                                    <input :disabled="form.use_default_address == true
                                        " v-model="form.zipcode" type="text" @keypress="onlyNumber"
                                        placeholder="کدپستی"
                                        class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:border-blueGray-500 focus:bg-gray-100 dark:focus:bg-gray-800 focus:outline-none focus:ring-1 ring-offset-current ring-offset-1 ring-gray-100" />
                                </div>
                            </div>
                            <div class="flex justify-between mt-3">
                                <div class="flex items-center pt-3">
                                    <input :disabled="form.use_default_address == true
                                        "  v-model="form.save_address_as_default" type="checkbox"
                                        class="w-5 h-5 text-stone-700 bg-gray-300 border-none rounded-md focus:ring-transparent" />
                                    <p for="safeAdress" class="block ml-2 text-sm text-gray-900">ذخیره به عنوان آدرس پیش
                                        فرض</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="userAddress" class="p-2 mb-3 px-5">
                        <div class="flex justify-end">
                            <div class="flex items-center py-3 gap-2">
                                <p>استفاده از آدرس پیش فرض</p>
                                <input v-model="form.use_default_address" type="checkbox"
                                    class="w-5 h-5 text-stone-700 bg-gray-300 border-none rounded-md" />
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.text }} : نشانی
                        </p>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.recipient_name }} : نام گیرنده
                        </p>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.zipcode }} : کدپستی
                        </p>
                        <p class="text-gray-500 text-sm">
                            {{ userAddress.mobile }} : موبایل
                        </p>
                    </div>
                    <div class="flex justify-between px-5 sm:pb-2 pb-20 align-center">
                        <div class=" justify-between flex flex-col" :class="{
                            'blur-[0.8px]':
                                walletBalance == 0,
                        }">
                            <div class="flex items-center pt-3">
                                <input :disabled="walletBalance == 0" v-model="useWallet" type="checkbox"
                                    class="w-6 h-6 text-stone-700 bg-gray-300 border-none rounded-md focus:ring-transparent" />
                                <p for="safeAdress" class="block ml-2 text-md text-gray-900">از کیف پول کم کن</p>
                            </div>

                            <div class="flex items-center justify-between pt-2">
                                <p class="text-base leading-none text-gray-800 dark:text-white">
                                    {{ walletBalance.toLocaleString("ar-EG") }} تومان
                                </p>
                                <p class="text-base leading-none text-red-800 dark:text-white">
                                    موجودی
                                </p>
                            </div>
                        </div>


                        <button @click="payOnlyUsingWallet" type="submit" v-if="useWallet && walletBalance >= Math.trunc(storeCart.subtotal + (9 / 100) * storeCart.subtotal) +
                            deliveryCost"
                            class="w-1/4 self-end rounded bg-green-600 px-1 py-3 text-center text-md font-medium text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-green-500">
                            پرداخت
                        </button>

                        <button @click="payWithZarinpal" type="submit" v-else
                            class="w-1/4 self-end rounded bg-green-600 px-1 py-3 text-center text-md font-medium text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-green-500">
                            پرداخت
                        </button>

                        <ConfirmPaymentModal v-if="showConfirmModal "
                            @close="showConfirmModal = false"
                            :amount="Math.trunc(storeCart.subtotal + (9 / 100) * storeCart.subtotal) + deliveryCost"
                            :gatewayPath="`order.payment.gateway`" />
                        <!-- <ConfirmPaymentModal2 v-if="showConfirmModal && payOnlyWithWallet" @close="showConfirmModal = false"
                            :amount="Math.trunc(storeCart.subtotal + (9 / 100) * storeCart.subtotal) + deliveryCost"
                            :gatewayPath="`order.payment.gateway`" /> -->
                    </div>
                </form>

                <div v-if="form.errors">
                    <div v-for="error of form.errors" :key="error.id">
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
input:checked+label {
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
