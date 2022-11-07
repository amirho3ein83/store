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
        <div class="mt-20 text-center border-b pb-12">
            <div class="flex align-baseline content-center justify-center">

                <div>
                    <WalletCard :balance="wallet.balance" />
                </div>
            </div>
        </div>
    </UserLayout>
</template>
