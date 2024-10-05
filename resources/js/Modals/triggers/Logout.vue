<script setup>
import LogoutModal from "@/Modals/LogoutModal.vue";
import { ref } from "vue";

let showLogoutModal = ref(false);
</script>
<template>
    <button type="button" @click="showLogoutModal = true"
    class="flex flex-row items-center h-12  rounded-lg text-gray-500 hover:text-gray-200 group"
    >
        <span class="flex items-center justify-center text-lg text-gray-500 group-hover:text-gray-200">
            <i class="bi bi-box-arrow-right text-red-400"></i>
        </span>
        <span class="ml-3">Log out</span>
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
