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
    <nav aria-label="Page navigation example">
        <ul class="list-style-none flex">
            <li>

                <Link :href="previousPage" v-if="currentPage != 1" preserve-scroll> صفحه قبل
                <span
                    class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white">Previous</span>
                </Link>
            </li>
            <!-- <li>
                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                    href="#">1</a>
            </li>
            <li aria-current="page">
                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                    href="#">2</a>
            </li>
            <li>
                <a class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                    href="#">3</a>
            </li> -->
            <Transition mode="out-in">
            <div class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                v-text="currentPage"></div>
        </Transition>
            <li>

                <Link :href="nextPage" v-if="nextPage != null" preserve-scroll> صفحه بعد
                <span
                    class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white">Next</span>

                </Link>
            </li>
        </ul>
    </nav>
</template>
