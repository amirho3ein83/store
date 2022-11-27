<script setup>
import ConfirmPaymentModal from "@/Modals/ConfirmPaymentModal.vue";
import { ref } from "vue";

let props = defineProps({
    amount: Number,
    requestPath: String,
    gatewayPath: String,
    disabled: Boolean,
    for: String,
});

const submitRequestForPayment = () => {
    if (props.for == "Order") {
        axios
            .post(route(props.requestPath), {
                amount: props.amount,
                amount: props.amount,
            })
            .then((res) => {
                showModal.value = true;
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        axios
            .get(route(props.requestPath, { amount: props.amount }))
            .then((res) => {
                showModal.value = true;
            })
            .catch((error) => {
                console.log(error);
            });
    }
};

let showModal = ref(false);
</script>
<template>
    <button
        type="button"
        :disabled="disabled"
        @click="submitRequestForPayment()"
        class="w-1/4 self-end rounded bg-green-600 px-1 py-3 text-center text-md font-medium text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-green-500"
    >
        پرداخت
    </button>
    <ConfirmPaymentModal
        v-if="showModal"
        @close="showModal = false"
        :amount="amount"
        :gatewayPath="gatewayPath"
    />
</template>
