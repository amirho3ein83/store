<script setup>
import JetInput from "@/Components/Input.vue";
import JetInputError from "@/Components/InputError.vue";
import JetLabel from "@/Components/Label.vue";
import ConfirmPaymentTrigger from "@/Modals/triggers/ConfirmPaymentTrigger.vue";
import ConfirmPaymentModal from "@/Modals/ConfirmPaymentModal.vue";
import { ref } from "vue";

let props = defineProps({
    balance: Number,
});

let balance = ref(props.balance);
let amount = ref(50000);
let showNotif = ref(false);
</script>

<template>
    <div class="mx-auto w-full flex justify-center ">
        <div class="flex flex-col w-full   max-w-xl items-center">
            <!-- card -->
            <div
                class="bg-gradient-to-tl w-full sm:w-3/4  from-gray-900 to-gray-800 text-white h-72  p-6 rounded-xl shadow-md"
            >
                <div class="h-full flex flex-col justify-between">
                    <div class="flex items-start justify-between space-x-4">
                        <div class="text-xl font-semibold tracking-tigh">
                            {{ $page.props.user.name }}
                        </div>

                        <div
                            class="inline-flex flex-col items-center justify-center"
                        >
                            <svg
                                class="h-8 w-8"
                                width="24"
                                height="24"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M2 15V9C2 5.68629 4.68629 3 8 3H16C19.3137 3 22 5.68629 22 9V15C22 18.3137 19.3137 21 16 21H8C4.68629 21 2 18.3137 2 15Z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                ></path>
                                <path
                                    d="M13 15.5V12.7M15.8571 12.7C16.5714 12.7 18 12.7 18 10.6C18 8.5 16.5714 8.5 15.8571 8.5L13 8.5V12.7M15.8571 12.7C14.7143 12.7 13.4762 12.7 13 12.7M15.8571 12.7L18 15.5"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                                <path
                                    d="M11 8.5L8 15.5L5 8.5"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <div class="text-xl font-semibold">
                            {{ props.balance.toLocaleString("ar-EG") }} تومان
                        </div>
                        <div class="text-xl font-semibold tracking-tight">
                            موجودی
                        </div>
                    </div>
                    <div
                        class="mt-4 py-2 flex border-t border-gray-400 justify-between align-baseline"
                    >
                        <div>
                            <input
                                v-model="amount"
                                type="number"
                                class="mt-1 block w-full text-gray-800"
                                required
                                min="1000"
                                placeholder="   میزان افزایش"
                            />
                        </div>

                        <ConfirmPaymentTrigger
                            :requestPath="`wallet.charge.request`"
                            :gatewayPath="`wallet.payment.gateway`"
                            :amount="amount"
                            :for="`Wallet`"
                            :disabled="amount == 0"
                        />
                    </div>
                </div>
            </div>
            <Transition>
                <div
                    v-if="showNotif"
                    id="toast-default "
                    class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-gray-900 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                    role="alert"
                >
                    <div class="ml-3 text-sm font-normal text-green-500">
                        Wallet Charged Successfully
                    </div>
                    <button
                        type="button"
                        class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-collapse-toggle="toast-default"
                        aria-label="Close"
                    >
                        <span class="sr-only">Close</span>
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                </div>
            </Transition>
        </div>
    </div>
</template>
