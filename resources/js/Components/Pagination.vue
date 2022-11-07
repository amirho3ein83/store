<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    currentPage: Number,
    previousPage: String,
    nextPage: String,
});
</script>

<template>
    <div class="flex bg-gray-300 justify-center items-center p-1 rounded-sm mx-auto w-[200px]">
        <Link :href="previousPage" v-if="currentPage != 1" preserve-scroll> <i
            class="bi bi-chevron-left text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"></i>
        </Link>

        <!-- <a :href="previousPage" v-if="currentPage != 1" rel="no-refresh">
            <i
                
                class="bi bi-chevron-left text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"
            ></i>
        </a> -->
        <Transition mode="out-in">
            <div class="w-12 rounded mx-5 p-1 text-center text-lg self-end text-white font-medium bg-gray-500"
                v-text="currentPage"></div>
        </Transition>
        <Link :href="nextPage" v-if="nextPage != null" preserve-scroll> <i
            class="bi bi-chevron-right text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"></i>
        </Link>

        <!-- <a :href="nextPage"  v-if="nextPage != null" rel="no-refresh">
            <i
               
                class="bi bi-chevron-right text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"
            ></i>
        </a> -->
    </div>
</template>
