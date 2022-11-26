<script setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";

defineProps({
    price: String,
});
let modalOpen = ref(false);

onMounted(() => {
    setTimeout(() => {
        modalOpen.value = true;
    }, 20);
});
</script>

<template>
    <Transition name="slide-fade">
        <div
            v-if="modalOpen"
            class="fixed top-0 left-0 flex h-full min-h-screen w-full items-center justify-center bg-black bg-opacity-50 px-4 py-2"
        >
            <div
                class="w-full max-w-[500px] rounded-md bg-white text-center md:py-[30px] md:px-[50px]"
            >
                <h3 class="pb-2 text-xl text-gray-800 font-bold sm:text-2xl">
                    مبلغ قابل پرداخت
                </h3>
                <span
                    class="bg-primary mx-auto mb-6 inline-block h-1 w-[90px] rounded"
                ></span>
                <p class="text-body-color mb-10 text-stone-800 text-xl leading-relaxed">
                    {{ price }} تومان
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
                        <a
                            class="block w-full cursor-pointer hover:scale-105 rounded-lg border bg-[#74eb34] border-[#E9EDF9] p-3 text-center text-base font-medium transition text-gray-700"
                        >
                            ادامه فرآیند پرداخت
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>
