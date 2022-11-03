<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { managePageStore } from "@/store/ManagePages";

const storePages = managePageStore();
const props = defineProps({
    page: String,
    icon: String,
    active: Boolean,
    disabled: Boolean,
});

const classes = computed(() => {
    return props.active
    ? "-mb-px border-b border-current p-4 text-yellow-500"
    : "-mb-px border-b border-transparent p-4 text-gray-200 hover:text-yellow-500"
});
</script>

<template>
<div class="relative">
    <button
     @click="storePages.setPage(props.page)"
     :disabled="props.disabled"
      :class="classes">
        <i :class="[icon]"></i>
    </button>
    <slot />
</div>

</template>
<style scoped>
i {
    font-size: 22px;
}
</style>
