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
                <div
                    class="self-center rounded-xl h-1/2 w-[370px] border border-gray-700 bg-gray-800 p-4"
                >
                    <div class="flex items-center">
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-white">
                                address
                            </h3>
                        </div>
                    </div>

                    <ul class="mt-4 space-y-2">
                        <li>
                            <a
                                href="#"
                                class="block h-full rounded-lg border border-gray-700 p-4 hover:border-pink-600"
                            >
                                <strong class="font-medium text-white"
                                    >recipient :
                                    {{ address.recipient_name }}</strong
                                >

                                <p
                                    class="mt-1 text-xs font-medium text-gray-300"
                                >
                                    {{ address.text }}
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
