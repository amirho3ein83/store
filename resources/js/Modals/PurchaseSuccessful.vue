<script setup>
import { onMounted, ref } from "vue";

let showModal = ref(false);

onMounted(() => {
    setTimeout(() => {
        showModal.value = true;
    }, 50);
});
</script>
<template>
    <Transition name="bounce">
        <section v-if="showModal" class="rounded-3xl shadow-2xl">
            <div class="p-8 text-center sm:p-12">
                <p
                    class="text-sm font-semibold uppercase tracking-widest text-pink-500"
                >
                    Your order is on the way
                </p>

                <h2 class="mt-6 text-3xl font-bold">
                    Thanks for your purchase, we're getting it ready!
                </h2>

                <a
                    class="mt-8 inline-block w-full rounded-full bg-pink-600 py-4 text-sm font-bold text-white shadow-xl"
                    href=""
                >
                    Track Order
                </a>
            </div>
        </section>
    </Transition>
</template>

<style scoped>
.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.25);
    }
    100% {
        transform: scale(1);
    }
}
</style>
