<script setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";
import { FingerprintSpinner } from "epic-spinners";
defineProps({
    amount: String,
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
        class="fixed top-0 left-0 flex h-full min-h-screen w-full items-center justify-center bg-black bg-opacity-50 px-4 py-2">
        <Transition name="bounce">
            <div class="w-full max-w-[500px] rounded-md bg-white text-center md:py-[30px] md:px-[50px]">
                <template v-if="modalOpen && !loadingModal">
                    <h3 class="text-xl text-gray-800 font-bold sm:text-2xl">
                        مبلغ قابل پرداخت
                    </h3>

                    <p class="text-body-color my-6 text-stone-800 text-xl leading-relaxed">
                        {{ amount }} تومان
                    </p>
                    <div class="-mx-3 flex flex-wrap pb-4">
                        <div class="w-1/2 px-3">
                            <button @click="$emit('close')"
                                class="block w-full rounded-lg border bg-red-600 border-[#E9EDF9] p-3 text-center text-base font-medium transition hover:border-red-600 hover:bg-red-600 text-white">
                                کنسل
                            </button>
                        </div>
                        <div class="w-1/2 px-3">
                            <button @click="showLoadingModal()">
                                <a :href="route(gatewayPath)"
                                    class="block w-full cursor-pointer hover:scale-105 rounded-lg border bg-[#74eb34] border-[#E9EDF9] p-3 text-center text-base font-medium transition text-gray-700">
                                    پرداخت با کیف پول
                                </a>
                            </button>
                        </div>
                    </div>
                </template>
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
