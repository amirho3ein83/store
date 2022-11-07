<script setup>
import RateModal from "@/Modals/RateModal.vue";
import { ref } from "vue";

defineProps({
    id: Number,
});

let showModal = ref(false);
let stars = ref([]);

const rateProduct = () => {
    showModal.value = false;
    axios.post(route("rate-product"), {
        product_id: id,
        stars: stars.length,
    });
};
</script>
<template>
    <button
        @click="showModal = true"
        class="flex items-center bg-yellow-900 text-white text-sm px-2 py-1 ml-3 rounded-lg"
    >
        rate
    </button>
    <Teleport to="body">
        <RateModal
            v-if="showModal"
            @close="showModal = false"
            @submit="rateProduct"
        />
    </Teleport>
</template>

<style>
.slide-fade-leave-active {
    transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}
</style>
