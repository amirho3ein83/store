<script setup>
defineProps({
    id: Number,
});
</script>

<template>
    <button @click="$emit('pressed')"
        class="transition ease-in duration-100 font-semibold inbuttonne-flex items-center text-sm  mb-2 md:mb-0 bg-[#ebc931] px-5 py-2 hover:shadow-lg active:bg-slate-500 hover:scale-105 active:scale-100 tracking-wider text-slate-700 rounded-full hover:bg-[#ebc941]">
        <span>Add to cart</span>
    </button>
</template>
