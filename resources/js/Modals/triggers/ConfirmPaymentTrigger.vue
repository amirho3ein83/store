<script setup>
import ConfirmPaymentModal from "@/Modals/ConfirmPaymentModal.vue";
import { ref } from "vue";

let props = defineProps({
    amount: Number,
    disabled: Boolean,
});

const chargeWallet = () => {
    axios
        .get(route("wallet.charge.request", { amount: props.amount }))
        .then((res) => {
            showModal.value = true;
        })
        .catch((error) => {
            console.log(error);
        });
};

let showModal = ref(false);
</script>
<template>
    <button
        :disabled="disabled"
        @click="chargeWallet()"
        class="w-1/4 self-end rounded bg-green-600 px-1 py-3 text-center text-md font-medium text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-green-500"
    >
        پرداخت
    </button>
    <ConfirmPaymentModal
        v-if="showModal"
        @close="showModal = false"
        :amount="amount"
    />
</template>
