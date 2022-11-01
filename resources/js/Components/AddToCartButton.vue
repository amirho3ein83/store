<script setup>
defineProps({
id:Number
});
const addToCart = (id) => {
    alert( id);
    // axios.get(route('password.confirmation')).then(response => {
    //     if (response.data.confirmed) {
    //         emit('confirmed');
    //     } else {
    //         confirmingPassword.value = true;

    //         setTimeout(() => passwordInput.value.focus(), 250);
    //     }
    // });
};
</script>

<template>
    <button
        class="inline-block rounded bg-yellow-600 px-8 py-2 text-sm font-medium text-white transition hover:scale-105 hover:shadow-xl focus:outline-none focus:ring active:bg-yellow-500"
        @click="addToCart(id)"
    >
        add to cart
    </button>
</template>
