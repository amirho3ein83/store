<script setup>
defineProps({
    users: Object,
});
</script>

<template>
    <!-- Snippet -->
    <section
        class="flex flex-col pt-12 antialiased justify-start bg-gray-100 text-gray-600 min-h-screen p-4"
    >
        <div class="h-full">
            <!-- Table -->
            <div
                class="w-1/3 mx-auto bg-white shadow-lg rounded-sm border border-gray-200"
            >
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead
                                class="text-sm font-semibold uppercase text-gray-400 bg-gray-50"
                            >
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            نام
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">
                                            ایمیل / موبایل
                                        </div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">
                                            تاریخ پیوست
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr v-for="user of users" :key="user.id">
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            {{ user.name }}
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap text-left">
                                        <span class="">
                                            {{ user.email }}
                                        </span>
                                        <span class="">
                                            {{ user.mobile }}
                                        </span>
                                    </td>

                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center">
                                            {{ user.j_created_at }}
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
</template>
