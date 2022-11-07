<script setup>
import PaymentLayout from "@/Layouts/PaymentLayout.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
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
        <AppLayout>
        <PaymentLayout>
            <div class="flex  overflow-y-auto w-1/2 py-6 px-4 sm:px-6">
                        <div class="mt-8">
                            <div class="flow-root">
                                <ul
                                    role="list"
                                    class="-my-6 divide-y divide-gray-200"
                                >
                                    <Order v-for="order of cart" :order="order" />

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
                                                class="text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex orders-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40 mr-2 mb-2"
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
        </PaymentLayout>
        </AppLayout>
</template>
