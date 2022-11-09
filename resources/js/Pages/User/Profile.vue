<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import WalletCard from "@/Components/WalletCard.vue";

// const previewImage = ref(null);

let props = defineProps({
    user: Object,
});
</script>

<template>
    <UserLayout>
        <WalletCard :balance="wallet.balance" />

    </UserLayout>
</template>
