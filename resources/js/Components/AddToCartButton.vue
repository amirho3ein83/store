<script setup>
defineProps({
    id: Number,
});
</script>

<template>
    <button @click="$emit('pressed')"
        class="transition ease-in duration-300 inbuttonne-flex items-center text-sm font-medium mb-2 md:mb-0 bg-purple-500 px-5 py-2 hover:shadow-lg tracking-wider text-white rounded-full hover:bg-purple-600">
        <span>Add Cart</span>
    </button>
</template>
