<script setup>
import { managePageStore } from "@/store/ManagePages";

const storePages = managePageStore();

defineProps({
    category: Object,
    path: String,
});
</script>

<template>
    <Link
        :href="route(path, { category: category.slug })"
        preserve-scroll
        class="lg:w-1/5 md:w-1/4 sm:w-1/3 p-4 w-1/2 relative mb-2 cursor-pointer group active:scale-95 transition-all duration-150"
    >
        <img
            alt="Art"
            src="../Pages/Store/Products/pics/category.avif"
            class="brightness-50 hover:brightness-95 transition-all duration-200 h-32 w-full object-cover"
        />
        <span
            class="group-hover:hidden absolute top-1/2 left-1/2 transform uppercase text-xl text-white -translate-x-1/2 -translate-y-1/2"
            >{{ category.name }}</span
        >
    </Link>
</template>
