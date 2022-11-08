<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PaymentLayout from "@/Layouts/PaymentLayout.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import Order from "@/Components/Order.vue";
import JetLabel from "@/Components/Label.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

defineProps({
    cart: Object,
    total: Number,
});

let formStep = ref(1);

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
    <AppLayout class="bg-slate-300">
        <!-- <div class="absolute bg-black opacity-80 inset-0 z-0"></div> -->

        <div class="h-screen">

            <div class="flex justify-center gap-12 pt-4 ">
                <div class="flex relative pb-4">

                    <div :class="{ 'bg-green-500': formStep == 1 }"
                        class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                        <i class="bi bi-ticket-detailed"></i>
                    </div>

                </div>

                <div class="flex relative pb-4">

                    <div :class="{ 'bg-green-500': formStep == 2 }"
                        class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                </div>
                <div class="flex relative ">
                    <div :class="{ 'bg-green-500': formStep == 3 }"
                        class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>

                </div>

            </div>

            <section v-if="formStep == 1" class="text-gray-600 body-font ">
                <div class="container px-5 py-4 mx-auto">

                    <div class="flex flex-wrap -m-4 py-4">
                        <Order v-for="order of cart" :order="order" />
                    </div>

                    <button @click="formStep = 2"
                        class="group relative self-end inline-flex items-center overflow-hidden rounded bg-yellow-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-yellow-500">
                        <span class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                            <i class="bi bi-arrow-right"></i>
                        </span>

                        <span class="text-sm font-medium transition-all group-hover:ml-4">
                            continue the purchase proccess
                        </span>
                    </button>
                </div>
            </section>

            <Transition name="fade">
                <div v-if="formStep == 2"
                    class="flex mx-auto m-5  w-full lg:w-1/3 flex-col py-3 bg-gray-500 rounded-lg shadow-xl">
                    <div class=" max-w-lg px-4 ">
                        <div class="flex flex-col">
                            <div>
                                <JetLabel class="text-gray-100" for="recipient_name" value="recipient_name" />
                                <JetInput id="recipient_name" v-model="form.recipient_name" type="text"
                                    class="mt-1 block w-full" required autofocus />
                                <JetInputError class="mt-2" :message="form.errors.recipient_name" />
                            </div>

                            <div>
                                <JetLabel class="text-gray-100" for="mobile" value="mobile" />
                                <JetInput id="mobile" v-model="form.mobile" type="text" class="mt-1 block w-full"
                                    required autofocus />
                                <JetInputError class="mt-2" :message="form.errors.mobile" />
                            </div>
                            <div>
                                <JetLabel class="text-gray-100" for="address" value="address" />
                                <textarea class="bg-gray-100 my-2 p-3" name="" v-model="form.address" id="" cols="39"
                                    rows="3"></textarea>
                                <JetInputError class="mt-2" :message="form.errors.address" />
                            </div>
                            <div class="my-2 flex gap-3">
                                <JetLabel class="text-gray-100" for="saveInfo" value="save address for later " />
                                <JetInput id="mobile" v-model="form.saveInfo" type="checkbox" class="mt-1 w-5 h-5 block"
                                    required autofocus />
                                <JetInputError class="mt-2" :message="form.errors.saveInfo" />
                            </div>

                            <div class="flex justify-end gap-x-2">
                                <button @click="formStep = 1"
                                    class="group relative self-end inline-flex items-center overflow-hidden rounded bg-yellow-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-yellow-500">
                                    <span
                                        class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                        <i class="bi bi-arrow-left"></i>
                                    </span>

                                    <span class="text-sm font-medium transition-all group-hover:ml-4">
                                        previous
                                    </span>
                                </button>
                                <button @click="formStep = 3"
                                    class="group relative self-end inline-flex items-center overflow-hidden rounded bg-yellow-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-yellow-500">
                                    <span
                                        class="absolute left-0 -translate-x-full transition-transform group-hover:translate-x-4">
                                        <i class="bi bi-arrow-right"></i>
                                    </span>

                                    <span class="text-sm font-medium transition-all group-hover:ml-4">
                                        next step
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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

                                    <input
                                    disabled
                                        class="relative w-full rounded-t-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                        type="text" name="card-number" id="card-number" placeholder="Card number" />
                                </div>

                                <div class="flex -space-x-px">
                                    <div class="flex-1">
                                        <label class="sr-only" for="card-expiration-date">
                                            Expiration Date
                                        </label>

                                        <input
                                        disabled
                                            class="relative w-full rounded-bl-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                            type="text" name="card-expiration-date" id="card-expiration-date"
                                            placeholder="MM / YY" />
                                    </div>

                                    <div class="flex-1">
                                        <label class="sr-only" for="card-cvc">CVC</label>

                                        <input
                                        disabled
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
                                        value="credit_card" id="credit_card" class="peer hidden" disabled/>

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
                    </div>
                </div>
            </Transition>
        </div>
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
</style>
