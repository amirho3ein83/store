<script setup>
import { managePageStore } from "@/store/ManagePages";

const storePages = managePageStore();

defineProps({
    category: Object,
    path: String,
});
</script>

<template>
    <Link :href="route(path, { category: category.slug })" 
        class="lg:w-1/5 md:w-1/4 sm:w-1/3 p-4 w-1/2 relative mb-2 cursor-pointer group active:scale-95 transition-all duration-150">
    <div class="sm:col-span-2 md:col-span-1 block group relative transition ease-out active:opacity-75 overflow-hidden">
        <img src="https://cdn.tailkit.com/media/placeholders/photo-gUPiTDBdRe4-700x700.jpg" alt="Product Image"
            class="transform transition ease-out group-hover:scale-110">
        <div class="absolute inset-0 bg-black bg-opacity-25 transition ease-out group-hover:bg-opacity-0"></div>
        <div class="p-4 flex items-center justify-center absolute inset-0">
            <div
                class="py-3 px-4 bg-white bg-opacity-95 rounded-3xl text-sm font-semibold uppercase tracking-wide transition ease-out group-hover:text-white group-hover:bg-stone-600 dark:bg-gray-900/90 dark:border-gray-800">
                {{ category.name }}
            </div>
        </div>
    </div>
    </Link>
</template>
