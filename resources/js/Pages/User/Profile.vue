<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import WalletCard from "@/Components/WalletCard.vue";

// const previewImage = ref(null);

let props = defineProps({
    user: Object,
});
</script>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout
}
</script>
<template>
    <UserLayout>
        <!-- <WalletCard :balance="wallet.balance" /> -->
    </UserLayout>
</template>
