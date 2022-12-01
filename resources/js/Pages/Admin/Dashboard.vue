<script setup>
let props = defineProps({
    totalSalesToday: String,
    countTodayOrders: String,
});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <section
        class="flex flex-col justify-center antialiased bg-gray-100 text-gray-600 min-h-screen"
    >
        <div class="max-w-3xl mx-auto p-4 sm:px-6 h-full">
            <!-- Chart widget -->
            <div
                class="flex flex-col col-span-full xl:col-span-8 bg-white shadow-lg rounded-sm border border-gray-200"
            >
                <header
                    class="px-5 py-4 border-b border-gray-100 flex items-center justify-end"
                >
                    <h2 class="font-semibold text-gray-800 text-lg">
                        گزارش امروز
                    </h2>
                </header>
                <div class="px-5 py-1">
                    <div class="flex flex-wrap justify-center">
                        <!-- Unique Visitors -->
                        <div class="flex items-center py-2">
                            <div class="mr-5">
                                <div
                                    class="text-3xl font-bold text-gray-800 mr-2"
                                >
                                    {{ countTodayOrders }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    تعداد سفارشات امروز
                                </div>
                            </div>
                            <div
                                class="hidden md:block w-px h-8 bg-gray-200 mr-5"
                                aria-hidden="true"
                            ></div>
                        </div>
                        <!-- Total Pageviews -->
                        <div class="flex items-center py-2">
                            <div class="mr-5">
                                <div
                                    class="text-3xl font-bold text-gray-800 mr-2"
                                >
                                    {{ totalSalesToday }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    میزان فروش امروز
                                </div>
                            </div>
                            <div
                                class="hidden md:block w-px h-8 bg-gray-200 mr-5"
                                aria-hidden="true"
                            ></div>
                        </div>
                    </div>
                </div>
                <!-- Chart built with Chart.js 3 -->
                <div class="flex-grow">
                    <canvas
                        id="analytics-card-01"
                        width="800"
                        height="300"
                    ></canvas>
                </div>
            </div>
        </div>
    </section>
</template>
