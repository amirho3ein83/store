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
    <div class="flex bg-gray-300 justify-center items-center p-3">
        <a :href="previousPage" rel="no-refresh">
            <i
            v-if="currentPage != 1"
                class="bi bi-chevron-left text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"
            >previous</i>
        </a>
        <Transition mode="out-in">
            <div
                class="w-12 rounded mx-5 p-1 text-center text-lg self-end text-white font-medium bg-gray-500"
                v-text="currentPage"
            ></div
        ></Transition>

        <a :href="nextPage" rel="no-refresh">
            <i
            v-if="nextPage != null"
                class="bi bi-chevron-right text-xl bg-c-orange text-gray-900 hover:bg-gray-500 transition-all duration-1 ease-out hover:text-white px-2 py-1 rounded"
            >next</i>
        </a>
    </div>
</template>
