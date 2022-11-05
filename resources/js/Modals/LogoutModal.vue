<script setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";

const logout = () => {
    Inertia.post(route("logout"));
};

let showModal = ref(false);

onMounted(() => {
    setTimeout(() => {
        showModal.value = true;
    }, 50);
});
</script>
<template>
    <Transition name="slide-fade">
        <div
            v-if="showModal"
            class="bg-slate-900 z-50 w-full h-full overflow-auto bg-opacity-60 flex justify-center items-center absolute top-0 right-0 bottom-0 left-0"
        >
            <div class="bg-white px-16 py-14 reletive rounded-md text-center">
                <h1 class="text-xl mb-4 font-bold text-slate-500">
                    Do you want logout?
                </h1>
                <button
                    @click="$emit('close')"
                    class="hover:bg-red-500 bg-red-400 px-4 py-2 rounded-md text-md text-white"
                >
                    Cancle
                </button>
                <button
                    @click="logout"
                    class="hover:bg-gray-600 bg-gray-500 px-7 py-2 ml-2 rounded-md text-md text-white font-semibold"
                >
                    Yes
                </button>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.slide-fade-leave-active {
    transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}

</style>
