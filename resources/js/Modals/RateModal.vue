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
        <div
            v-if="showModal"
            class="z-50 w-full h-full overflow-auto bg-opacity-60 flex justify-center items-center absolute top-0 right-0 bottom-0 left-0"
        >
            <button
                class="px-8 py-3 mb-1 mr-1 font-bold text-indigo-600 uppercase transition-all duration-300 ease-in-out bg-transparent border border-indigo-600 border-solid rounded-md outline-none hover:bg-indigo-600 hover:text-white active:bg-indigo-600 focus:outline-none"
                type="button"
                @click="open = true"
            >
                Rate me !
            </button>

            <div
                class="absolute max-w-sm p-4 overflow-x-auto bg-white rounded-lg shadow-lg"
                @click="open = false"
                role="dialog"
                aria-modal="true"
                aria-labelledby="modal-headline"
            >
                <div class="mt-2 text-center">
                    <h3
                        class="text-xl font-semibold leading-6 text-indigo-600"
                        id="modal-headline"
                    >
                        Rate your experience
                    </h3>
                    <div class="mt-2">
                        <p class="px-3 text-sm leading-5 text-gray-600">
                            We would love to know what you think of our service!
                            Please take a moment to rate us.
                        </p>
                    </div>
                    <div
                        class="flex flex-wrap items-center justify-center mt-2"
                    >
                        <div class="rating">
                            <input
                                type="checkbox"
                                name="rating-2"
                                v-model="stars"
                                class="mask mask-star-2 bg-orange-400"
                            />
                            <input
                                type="checkbox"
                                name="rating-2"
                                v-model="stars"
                                class="mask mask-star-2 bg-orange-400"
                                checked
                            />
                            <input
                                type="checkbox"
                                name="rating-2"
                                v-model="stars"
                                class="mask mask-star-2 bg-orange-400"
                            />
                            <input
                                type="checkbox"
                                name="rating-2"
                                v-model="stars"
                                class="mask mask-star-2 bg-orange-400"
                            />
                            <input
                                type="checkbox"
                                name="rating-2"
                                v-model="stars"
                                class="mask mask-star-2 bg-orange-400"
                            />
                        </div>
                        <!-- <i class="bi bi-star-fill text-yellow-500 px-2"></i>
                    <i class="bi bi-star px-2"></i>
                    <i class="bi bi-star px-2"></i>
                    <i class="bi bi-star px-2"></i>
                    <i class="bi bi-star px-2"></i> -->
                    </div>
                </div>
                <div
                    class="px-4 py-3 sm:px-6 sm:flex sm:justify-center sm:flex-row-reverse"
                >
                    <span
                        class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                    >
                        <button
                            type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo sm:text-sm sm:leading-5"
                            @click="$emit('submit')"
                        >
                            Submit Rating
                        </button>
                    </span>
                    <span
                        class="flex w-full mt-3 rounded-md shadow-sm sm:mt-0 sm:w-auto"
                    >
                        <button
                            type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-600 transition duration-150 ease-in-out bg-white border border-gray-600 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-indigo-600 focus:shadow-outline-indigo sm:text-sm sm:leading-5"
                            @click="$emit('close')"
                        >
                            No, Thanks
                        </button>
                    </span>
                </div>
            </div>
        </div>
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
