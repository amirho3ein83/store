<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import CartItem from "@/Components/CartItem.vue";
import JetLabel from "@/Components/Label.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

defineProps({
    cart: Object,
    total: Number,
});

let loaded = ref(false);

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

onMounted(() => {
    loaded.value = true;
});
</script>

<template>
    <Transition>
        <AppLayout>
            <!-- <div class="absolute bg-black opacity-80 inset-0 z-0"></div> -->

            <div class="flex justify-evenly">
                <div
                    class="flex m-5 h-full flex-col overflow-y-scroll bg-gray-300 shadow-xl w-1/3"
                >
                    <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                        <div class="mt-8">
                            <div class="flow-root">
                                <ul
                                    role="list"
                                    class="-my-6 divide-y divide-gray-200"
                                >
                                    <CartItem
                                        v-for="item of cart"
                                        :item="item"
                                    />

                                    <div class="py-6 px-4 sm:px-6">
                                        <div
                                            class="flex justify-between text-base font-medium text-gray-900"
                                        >
                                            <p>Subtotal</p>
                                            <p>${{ total }}</p>
                                        </div>
                                        <p class="mt-0.5 text-sm text-gray-500">
                                            Shipping and taxes calculated at
                                            checkout.
                                        </p>

                                        <div
                                            class="mt-6 flex justify-center text-center text-sm text-gray-500"
                                        >
                                            <a
                                                href="/category"
                                                type="button"
                                                class="text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40 mr-2 mb-2"
                                            >
                                                <i class="bi bi-cart mx-1"></i>
                                                Continue Shopping
                                            </a>
                                        </div>
                                    </div>
                                    <!-- More products... -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- form deatails -->
                <Transition name="fade">
                    <div
                        v-if="loaded"
                        class="flex m-5 h-full flex-col py-3 bg-gray-300 shadow-xl"
                    >
                        <div class="mx-auto max-w-lg px-4 lg:px-8">
                            <form class="flex flex-col">
                                <div>
                                    <JetLabel
                                        for="recipient_name"
                                        value="recipient_name"
                                    />
                                    <JetInput
                                        id="recipient_name"
                                        v-model="form.recipient_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autofocus
                                    />
                                    <JetInputError
                                        class="mt-2"
                                        :message="form.errors.recipient_name"
                                    />
                                </div>

                                <div>
                                    <JetLabel for="mobile" value="mobile" />
                                    <JetInput
                                        id="mobile"
                                        v-model="form.mobile"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autofocus
                                    />
                                    <JetInputError
                                        class="mt-2"
                                        :message="form.errors.mobile"
                                    />
                                </div>
                                <div>
                                    <JetLabel for="address" value="address" />
                                    <textarea
                                        class="bg-gray-100 my-2 p-3"
                                        name=""
                                        v-model="form.address"
                                        id=""
                                        cols="39"
                                        rows="3"
                                    ></textarea>
                                    <JetInputError
                                        class="mt-2"
                                        :message="form.errors.address"
                                    />
                                </div>
                                <div class="my-2 flex gap-3">
                                    <JetLabel
                                        for="saveInfo"
                                        value="save address for later "
                                    />
                                    <JetInput
                                        id="mobile"
                                        v-model="form.saveInfo"
                                        type="checkbox"
                                        class="mt-1 w-5 h-5 block"
                                        required
                                        autofocus
                                    />
                                    <JetInputError
                                        class="mt-2"
                                        :message="form.errors.saveInfo"
                                    />
                                </div>
                                <fieldset
                                    class="col-span-6 border-t border-gray-200 my-1"
                                >
                                    <legend
                                        class="mb-1 block text-sm text-gray-600"
                                    >
                                        Card Details
                                    </legend>

                                    <div
                                        class="-space-y-px rounded-lg bg-white shadow-sm"
                                    >
                                        <div>
                                            <label
                                                class="sr-only"
                                                for="card-number"
                                                >Card Number</label
                                            >

                                            <input
                                                class="relative w-full rounded-t-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                                type="text"
                                                name="card-number"
                                                id="card-number"
                                                placeholder="Card number"
                                            />
                                        </div>

                                        <div class="flex -space-x-px">
                                            <div class="flex-1">
                                                <label
                                                    class="sr-only"
                                                    for="card-expiration-date"
                                                >
                                                    Expiration Date
                                                </label>

                                                <input
                                                    class="relative w-full rounded-bl-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                                    type="text"
                                                    name="card-expiration-date"
                                                    id="card-expiration-date"
                                                    placeholder="MM / YY"
                                                />
                                            </div>

                                            <div class="flex-1">
                                                <label
                                                    class="sr-only"
                                                    for="card-cvc"
                                                    >CVC</label
                                                >

                                                <input
                                                    class="relative w-full rounded-br-lg border-gray-200 p-2.5 text-sm placeholder-gray-500 focus:z-10"
                                                    type="text"
                                                    name="card-cvc"
                                                    id="card-cvc"
                                                    placeholder="CVC"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="flex justify-center py-4 gap-3">

                                    <div>
                                        <input
                                            type="radio"
                                            name="paymentMethod"
                                            v-model="form.paymentMethod"
                                            value="wallet"
                                            id="wallet"
                                            class="peer hidden"
                                            checked
                                        />

                                        <label
                                            for="wallet"
                                            class="block cursor-pointer rounded-lg border border-gray-400 p-4 text-sm font-medium shadow-sm hover:border-gray-200  peer-checked:bg-gray-400 peer-checked:ring-1 peer-checked:ring-gray-50"
                                        >
                                            <p class="text-gray-700">
                                                use my wallet
                                            </p>

                                        </label>
                                    </div>

                                    <div>
                                        <input
                                            type="radio"
                                            name="paymentMethod"
                                            v-model="form.paymentMethod"
                                            value="credit_card"
                                            id="credit_card"
                                            class="peer hidden"
                                        />

                                        <label
                                            for="credit_card"
                                            class="block cursor-pointer rounded-lg border border-gray-400 p-4 text-sm font-medium shadow-sm hover:border-gray-200  peer-checked:bg-gray-400 peer-checked:ring-1 peer-checked:ring-gray-50"
                                        >
                                            <p class="text-gray-700">
                                               credit card
                                            </p>


                                        </label>
                                    </div>
                                </div>

                                <div class="mx-auto">
                                    <button
                                        id="button"
                                        type="submit"
                                        class="bg-green-600 shadow-xl hover:bg-green-700 text-lg text-white font-bold rounded-full p-3 my-2 w-48"
                                    >
                                        Pay
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </Transition>
            </div>
        </AppLayout>
    </Transition>
</template>
