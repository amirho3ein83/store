<script setup>
import { managePageStore } from "@/store/ManagePages";

const storePages = managePageStore();

defineProps({
    category: Object,
});
</script>

<template>
    <div
        @click="storePages.chooseCategory(category.id)"
        class="relative mb-2 cursor-pointer group active:scale-95 transition-all duration-150"
    >
        <img
            alt="Art"
            src="../Pages/Store/Products/pics/category.avif"
            class="brightness-50 hover:brightness-95 transition-all duration-200 h-72 w-full object-cover"
        />
        <span
            class="group-hover:hidden absolute top-1/2 left-1/2 transform uppercase text-2xl text-white -translate-x-1/2 -translate-y-1/2"
            >{{ category.name }}</span
        >
    </div>
</template>
