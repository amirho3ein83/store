<script setup>
import UserSidebar from "@/Components/UserSidebar.vue";
import { useStorage } from "@/store/useStorage";
import { ref } from "vue";

let form_step = useStorage("form_step");
let step = ref(form_step)
</script>

<template>
    <section class="text-gray-600 body-font bg-white" bg-white>
        <div class="container sm:px-5 py-12 mx-auto flex flex-wrap">
            <div class="flex flex-col w-full">
                <div class=" flex  justify-center sm:gap-x-14">
                    <div class="flex relative px-2 flex-col items-center">
                        <div :class="{ 'bg-green-600': step == 1 }"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                            <i class="bi bi-cart-fill"></i>
                        </div>
                        <div class="flex-grow">
                            <h2 class="font-medium title-font text-sm text-purple-900 mb-1">
                                Cart
                            </h2>
                        </div>
                    </div>
                    <div class="flex relative px-2 flex-col items-center">
                        <div :class="{ 'bg-green-600': step == 2 }"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                            <i class="bi bi-geo-alt-fill "></i>
                        </div>
                        <div class="flex-grow">
                            <h2 class="font-medium title-font text-sm text-purple-900 mb-1">
                                Address
                            </h2>
                        </div>
                    </div>
                    <div class="flex relative px-2 flex-col items-center">
                        <div :class="{ 'bg-green-600': step == 3 }"
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500 inline-flex items-center justify-center text-white relative z-10">
                            <i class="bi bi-credit-card-2-back-fill"></i>
                        </div>
                        <div class="flex-grow">
                            <h2 class="font-medium title-font text-sm text-purple-900 mb-1">
                                Parment
                            </h2>
                        </div>
                    </div>

                </div>
                <slot />
            </div>
        </div>
    </section>
</template>
