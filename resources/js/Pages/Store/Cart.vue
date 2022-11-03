<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Components/Button.vue";
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetCheckbox from "@/Components/Checkbox.vue";
import JetLabel from "@/Components/Label.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
    cart: Object,
    total: Number,
});

const form = useForm({
    recipient_name: "",
    phone: "",
    address: "",
    card_number: null,
    expirationYear: null,
    expirationMonth: null,
    cvc: null,
});

const pay = () => {
    form.post(route("payment"), {
        onFinish: () => console.log("done"),
    });
};
</script>

<template>
    <AppLayout>
        <!-- <div class="absolute bg-black opacity-80 inset-0 z-0"></div> -->
        <div class="inline-flex items-center mt-2">
            <button
                class="bg-white rounded-l border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M20 12H4"
                    />
                </svg>
            </button>
            <div
                class="bg-gray-100 border-t border-b border-gray-100 text-gray-600 hover:bg-gray-100 inline-flex items-center px-4 py-1 select-none"
            >
                2
            </div>
            <button
                class="bg-white rounded-r border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>
            </button>
        </div>
        <div class="bg-gray-200 h-screen">
            <h1 class="sr-only">Checkout</h1>

            <div class="relative mx-auto max-w-screen-2xl">
                <div class="flex justify-evenly bg-gray-200">
                    <div class="pt-2 md:pt-4 flex-1">
                        <div class="mx-auto max-w-lg px-4 lg:px-8">
                            <div class="mt-12">
                                <div class="flow-root">
                                    <ul class="-my-4 divide-y divide-gray-200">
                                        <!-- {{cart}} -->
                                        <li
                                            v-for="item of cart"
                                            class="flex bg-slate-700 rounded-lg px-3 items-center justify-between py-4"
                                        >
                                            <div
                                                class="flex items-start align-baseline"
                                            >
                                                <img
                                                    alt="Trainer"
                                                    src="https://images.unsplash.com/photo-1565299999261-28ba859019bb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                                                    class="h-20 w-20 flex-shrink-0 rounded-lg object-cover"
                                                />
                                                <h1
                                                    class="text-gray-200 text-lg mx-2"
                                                ></h1>
                                                <div class="ml-4">
                                                    <p
                                                        class="text-sm text-gray-200"
                                                    >
                                                        quantity:
                                                        {{ item.quantity }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div>
                                                <p
                                                    class="text-sm text-gray-200"
                                                >
                                                    total:
                                                    <span
                                                        class="text-lg text-red-200"
                                                        >{{
                                                            item.price *
                                                            item.quantity
                                                        }}</span
                                                    >
                                                    $
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-14 md:py-14 overflow-y-auto flex-1">
                        <div class="mx-auto max-w-lg px-4 lg:px-8">
                            <form class="flex flex-col" @submit.prevent="pay()">
                                <div class="mt-1 col-span-6">
                                    <JetLabel
                                        for="recipient_name"
                                        value="Recipient Name"
                                    />
                                    <JetInput
                                        id="recipient_name"
                                        v-model="form.recipient_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <JetInputError
                                        class="mt-1"
                                        :message="form.errors.recipient_name"
                                    />
                                </div>
                                <div class="mt-1 col-span-6">
                                    <JetLabel for="phone" value="phone" />
                                    <JetInput
                                        id="phone"
                                        v-model="form.phone"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <JetInputError
                                        class="mt-1"
                                        :message="form.errors.phone"
                                    />
                                </div>
                                <div class="mt-1">
                                    <JetLabel for="address" value="address" />

                                    <textarea
                                        class="bg-gray-100"
                                        name=""
                                        v-model="form.address"
                                        id=""
                                        cols="39"
                                        rows="3"
                                    ></textarea>
                                </div>
                                <div class="m-3">
                                    <JetLabel
                                        for="saveInfo"
                                        value="save info for next payments"
                                    />

                                    <JetInput
                                        v-model="form.saveInfo"
                                        type="checkbox"
                                        class="mt-1 block"
                                        required
                                    />
                                </div>
                                <div class="w-full">
                                    <JetButton
                                        class="m-4 w-full bg-gray-500"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        pay
                                    </JetButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
