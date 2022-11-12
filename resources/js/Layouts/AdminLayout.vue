<script setup>
import Sidebar from "./Sidebar.vue";
import "bootstrap-icons/font/bootstrap-icons.css";

</script>

<template>
    <div class="flex">
        <Sidebar />
        <div class="flex-1 min-h-screen">
            <slot />
        </div>
    </div>
</template>
