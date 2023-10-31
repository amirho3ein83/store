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
    <table class="w-[450px]">
        <thead>
            <tr>
                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                >
                    Name
                </th>

                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                >
                    email
                </th>
                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                >
                    description
                </th>
                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                >
                    description
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="user of users" :key="user.id">
                <td
                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img
                                class="h-10 w-10 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt=""
                            />
                        </div>

                        <div class="ml-4">
                            <div
                                class="text-sm leading-5 font-medium text-gray-900"
                            >
                                {{ user.name }}
                            </div>
                            <div class="text-sm leading-5 text-gray-500">
                                {{ user.email }}
                            </div>
                        </div>
                    </div>
                </td>

                <td
                    v-if="Object.keys(user.roles).length != 0"
                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
                >
                    <span v-for="role of user.roles" :key="role.id">{{
                        role.name
                    }}</span>
                </td>
                <td
                    v-else
                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
                >
                    <span>user</span>
                </td>
                <td
                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
                >
                    <span>{{ user.j_created_at }}</span>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- pagination -->
    <div v-show="criticisms.data != undefined && criticisms.data != {}">
        <Pagination
            :nextPage="criticisms.next_page_url"
            :previousPage="criticisms.prev_page_url"
            :currentPage="criticisms.current_page"
        />
    </div>
</template>
