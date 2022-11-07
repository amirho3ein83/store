<script setup>
defineProps({
    size: String,
    chosen: Boolean,
});
</script>

<template>
    <button @click="$emit('selected')">
        <span
            :class="{ 'text-yellow-900 bg-slate-100': chosen }"
            class="mx-1 p-2 py-1 rounded-full w-4 h-4 bg-gray-700"
            >{{ size }}</span
        >
    </button>
</template>
