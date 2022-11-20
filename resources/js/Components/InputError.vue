<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-800 animate-pulse">
            {{ message }}
        </p>
    </div>
</template>
