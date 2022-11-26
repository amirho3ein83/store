<script setup>
import LogoutModal from "@/Modals/LogoutModal.vue";
import { ref } from "vue";

let showLogoutModal = ref(false);
</script>
<template>
    <button
        @click="showLogoutModal = true"
        class="hover:scale-105 duration-150 ease-out text-red-500 hover:text-red-600"
    >
        <i class="bi bi-box-arrow-right"></i>
    </button>
    <Teleport to="body">
        <LogoutModal v-if="showLogoutModal" @close="showLogoutModal = false" />
    </Teleport>
</template>
<style>
.slide-fade-leave-active {
    transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}
</style>
