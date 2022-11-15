<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
     class="w-full  text-gray-900 bg-c-orange border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-xl hover:text-white hover:border-transparent transition ease-in duration-100 transform "
>
        <slot />
    </button>
</template>
