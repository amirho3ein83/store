<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="p-2 border-none text-lg focus:border-gray-300 focus:ring focus:ring-gray-500 focus:ring-opacity-50 rounded-md shadow-sm bg-gray-100"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
