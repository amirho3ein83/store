<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import WalletCard from "@/Components/WalletCard.vue";
import UserSidebar from "@/Components/UserSidebar.vue";
import { ref } from "vue";
import { add } from "lodash";

// const previewImage = ref(null);

let props = defineProps({
    user: Object,
    address: Object,
    wallet: Object,
});
</script>

<template>
    <UserLayout>
        <WalletCard :balance="wallet.balance" />

    </UserLayout>
</template>
