<script setup>
import Sidebar from "@/Components/Sidebar.vue";
</script>

<template>
    <div class="flex">
        <Sidebar />
        <div class="flex-1">
            <slot />
        </div>
    </div>
</template>
