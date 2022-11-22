<script setup>
import Table from "@/Components/Table.vue";
defineProps({
    criticisms: Object,
});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>

    <section class="antialiased bg-gray-100 text-gray-600 py-6 px-4 min-h-full">
        <div class="flex flex-col justify-center h-full">
            <!-- Table -->
            <div
                class="w-full  mx-auto bg-white shadow-lg rounded-sm border border-gray-200"
            >
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead
                                class="text-xs font-semibold uppercase text-gray-400 bg-stone-200"
                            >
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            Name
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            Email
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            Mobile
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">
                                            -
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr
                                    v-for="criticism of criticisms.data"
                                    :key="criticism.id"
                                >
                                    <td class="p-2 whitespace-nowrap">
                                            <div
                                                class="font-medium text-gray-800"
                                            >
                                                {{ criticism.critic_name }}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ criticism.critic_email }}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ criticism.critic_mobile }}
                                        </div>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-xs truncate text-center">
                                          {{ criticism.desc }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pagination -->
    <!-- <div v-show="criticisms.data != undefined && criticisms.data != {}">
        <Pagination :nextPage="criticisms.next_page_url" :previousPage="criticisms.prev_page_url"
            :currentPage="criticisms.current_page" />
    </div> -->
</template>
