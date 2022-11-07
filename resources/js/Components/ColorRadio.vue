<script setup>
import { onMounted } from "vue";

defineProps({
    bg: String,
    border: String,
    chosen: Boolean,
});
</script>

<template>
    <button @click="$emit('selected')">
        <span
            :class="{border : chosen}"
            class="block p-1 border-2 border-gray-900 rounded-full transition ease-in duration-200"
        >
            <span :class="bg" class="block ball w-3 h-3 rounded-full"></span>
        </span>
    </button>
</template>

<!-- <style scoped>
.ball {
    background-color: yellow;
}

.add-border {
    border-color: v-bind(color);
}
</style> -->
