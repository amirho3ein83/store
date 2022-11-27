<script setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";
import { FingerprintSpinner } from "epic-spinners";
defineProps({
    amount: Number,
    gatewayPath: String,
});
let modalOpen = ref(false);
let loadingModal = ref(false);

const showLoadingModal = () => {
    loadingModal.value = true;
};

onMounted(() => {
    setTimeout(() => {
        modalOpen.value = true;
    }, 1);
});
</script>

<template>
    <div
        class="fixed top-0 left-0 flex h-full min-h-screen w-full items-center justify-center bg-black bg-opacity-50 px-4 py-2"
    >
        <Transition name="bounce">
            <div
                class="w-full max-w-[500px] rounded-md bg-white text-center md:py-[30px] md:px-[50px]"
            >
                <template v-if="modalOpen && !loadingModal">
                    <h3 class="text-xl text-gray-800 font-bold sm:text-2xl">
                        مبلغ قابل پرداخت
                    </h3>
                    <span
                        class="bg-primary mx-auto mb-6 inline-block h-1 w-[90px] rounded"
                    ></span>
                    <p
                        class="text-body-color mb-10 text-stone-800 text-xl leading-relaxed"
                    >
                        {{ amount }} تومان
                    </p>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-1/2 px-3">
                            <button
                                @click="$emit('close')"
                                class="block w-full rounded-lg border bg-red-600 border-[#E9EDF9] p-3 text-center text-base font-medium transition hover:border-red-600 hover:bg-red-600 text-white"
                            >
                                کنسل
                            </button>
                        </div>
                        <div class="w-1/2 px-3">
                            <button @click="showLoadingModal()">
                                <a
                                    :href="route(gatewayPath)"
                                    class="block w-full cursor-pointer hover:scale-105 rounded-lg border bg-[#74eb34] border-[#E9EDF9] p-3 text-center text-base font-medium transition text-gray-700"
                                >
                                    انتقال به درگاه پرداخت
                                </a>
                            </button>
                        </div>
                    </div>
                    <span class="text-red-300 font-semibold mt-4 animate-pulse">
                        <i class="bi bi-exclamation-triangle text-red-500"></i>
                        یادت نره فیلتر شکن رو خاموش کنی</span
                    >
                </template>

                <div
                    class="py-4 items-center flex flex-col gap-4"
                    v-else-if="modalOpen && loadingModal"
                >
                    <FingerprintSpinner
                        :animation-duration="1000"
                        :size="64"
                        color="#ff1d5e"
                    />
                    <span class="text-indigo-600">
                        ...درحال انتقال به درگاه پرداخت</span
                    >
                </div>
            </div>
        </Transition>
    </div>
</template>

<style>
.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0.7);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}
</style>
