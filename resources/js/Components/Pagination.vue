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
    <div class="flex bg-gray-300/25 justify-center items-center p-1 rounded-sm mx-auto w-[300px]">
        <Link :href="previousPage" v-if="currentPage != 1" preserve-scroll> صفحه قبل
        </Link>
        <Transition mode="out-in">
            <div class="w-12 rounded mx-5 p-1 text-center text-lg self-end text-gray-700 font-medium bg-gray-400"
                v-text="currentPage"></div>
        </Transition>
        <Link :href="nextPage" v-if="nextPage != null" preserve-scroll> صفحه بعد
        </Link>
    </div>
</template>
