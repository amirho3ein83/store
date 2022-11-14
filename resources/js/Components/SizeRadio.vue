<script setup>
defineProps({
    size: String,
    chosen: Boolean,
});
</script>

<template>
    <button @click="$emit('selected')">
        <span
            :class="{ 'bg-slate-700 text-yellow-100 ': chosen }"
            class="mx-1 p-2 py-1 rounded-full w-4 h-4 bg-gray-100"
            >{{ size }}</span
        >
    </button>
</template>
