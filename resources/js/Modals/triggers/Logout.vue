<script setup>
import LogoutModal from "@/Modals/LogoutModal.vue";
import { ref } from "vue";

let showLogoutModal = ref(false);
</script>
<template>

    <button type="button"
    @click="showLogoutModal = true"
        class="duration-150 ease-out flex gap-2 text-red-500 hover:text-red-600  border-gray-200  font-medium  text-md  text-center  items-center ">
        <i class="bi bi-box-arrow-right translate-y-1"></i>
        <p class="text-gray-700">Log out</p>
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
