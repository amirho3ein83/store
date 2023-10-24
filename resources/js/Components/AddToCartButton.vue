<script setup>
defineProps({
    id: Number,
});
</script>

<template>
    <button
        @click="$emit('pressed')"
        class="transition ease-in duration-100 font-semibold inbuttonne-flex items-center text-sm mb-2 md:mb-0 bg-[#21c22e] px-5 py-2 hover:shadow-lg active:bg-slate-100 hover:scale-105 active:scale-100 tracking-wider text-slate-50 rounded-full hover:bg-[#ebc941]"
    >
        <span> افزودن به سبد خرید </span>
    </button>
</template>
