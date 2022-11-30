<script setup>
import Pagination from "@/Components/Pagination.vue";

let props = defineProps({
    orders: Object,
});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <div
        class="container w-2/3 mx-auto bg-gray-50 min-h-screen p-8 antialiased"
    >
        <div>
            <div
                v-for="order of orders.data"
                :key="order.id"
                class="bg-gray-100 mx-auto border-gray-500 border rounded-sm text-gray-700 mb-0.5 h-30"
            >
                <div
                    :class="
                        order.payment_status == 'pending'
                            ? 'border-yellow-600'
                            : 'border-green-600'
                    "
                    class="flex p-3 ${order.payment_status == 'pending'} ? border-l-8"
                >
                    <div class="space-y-1 text-center border-r-2 pr-3 w-1/6">
                        <div class="text-sm leading-5 font-semibold">
                            {{ order.id }}
                            <span
                                class="text-xs leading-4 font-normal text-gray-500"
                            >
                                شناسه سفارش #</span
                            >
                        </div>
                        <div class="text-sm leading-5 font-semibold">
                            {{ order.created_at }}
                        </div>
                        <div class="text-sm leading-5 font-semibold">
                            تومان
                            <span class="text-yellow-800">
                                {{ order.billing_total }}
                            </span>

                            <span
                                class="text-xs leading-4 font-normal text-gray-500"
                            >
                                مبلغ پرداخت شده
                            </span>
                        </div>
                    </div>
                    <div class="w-2/6 text-sm px-2 border-r-2">
                        <span>مشخصات خریدار</span>
                        <div class="text-base leading-6 font-normal">
                            {{ order.buyer.name }} نام
                        </div>
                        <div class="text-sm leading-4 font-normal">
                            {{ order.buyer.mobile }}
                        </div>
                        <div class="text-sm leading-4 font-normal">
                            {{ order.buyer.email }}
                        </div>
                    </div>
                    <div class="w-2/6 text-sm px-2 border-r-2">
                        <span> جزییات تراکنش</span>
                        <div
                            v-if="order.transaction"
                            class="ml-3 space-y-1 pr-3"
                        >
                            <div class="text-base leading-6 font-normal">
                                {{ order.transaction.transaction_id }}
                                <span
                                    class="text-xs leading-4 font-normal text-gray-500"
                                >
                                    شناسه تراکنش #</span
                                >
                            </div>
                            <div class="text-base leading-6 font-normal">
                                {{ order.transaction.reference_id }}
                                <span
                                    class="text-xs leading-4 font-normal text-gray-500"
                                >
                                    شناسه مرجع #</span
                                >
                            </div>
                        </div>
                        <div
                            v-else-if="order.payment_status == 'paid'"
                            class="ml-3 space-y-1 pr-3"
                        >
                            <div class="text-base leading-6 font-normal">
                                پرداخت با کیف پول
                            </div>
                        </div>
                    </div>
                    <div class="w-2/6 text-sm px-2 border-r-2">
                        <span> آدرس مقصد</span>
                        <div v-if="order.address" class="ml-3 space-y-1 pr-3">
                            <div class="text-base leading-6 font-normal">
                                {{ order.address.recipient_name }} گیرنده
                            </div>
                            <div class="text-sm leading-4 font-normal">
                                نشانی: {{ order.address.text }}
                            </div>
                        </div>
                    </div>
                    <div class="w-1/6 flex justify-center">
                        <span
                            v-if="order.payment_status == 'pending'"
                            class="inline-flex items-center m-3 p-1 bg-yellow-200 text-sm rounded-sm text-yellow-700"
                        >
                            <span> در انتظار پرداخت</span>
                        </span>
                        <span
                            v-else
                            class="inline-flex items-center m-3 p-1 bg-green-200 text-sm rounded-sm text-green-600"
                        >
                            <span> پرداخت شده</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pagination -->
    <div v-show="orders.data != undefined && orders.data != {}">
        <Pagination
            :nextPage="orders.next_page_url"
            :previousPage="orders.prev_page_url"
            :currentPage="orders.current_page"
        />
    </div>
</template>
<style scoped>
.table {
    border-spacing: 0 15px;
}

i {
    font-size: 20px;
}

.table tr {
    border-radius: 20px;
}

tr td:nth-child(n + 5),
tr th:nth-child(n + 5) {
    border-radius: 0 0.625rem 0.625rem 0;
}

tr td:nth-child(1),
tr th:nth-child(1) {
    border-radius: 0.625rem 0 0 0.625rem;
}
</style>
