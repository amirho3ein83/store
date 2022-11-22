<script setup>
</script>

<template>

    <div class="px-8 bg-gray-800 w-[250px] h-screen sticky top-0">
        <h2 class="text-yellow-600 text-center py-3 text-2xl">
            Admin Panel

        </h2>
        <ul class="mt-12">
            <Link :href="'/'"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900">
                <i class="bi bi-house"></i>
                <span class="text-sm ml-2">Home</span>
            </Link>
            <Link :href="'dashboard'"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900">
                <i class="bi bi-kanban"></i>
                <span class="text-sm ml-2">Dashboard</span>
            </Link>
            <Link :href="'/admin/products-list'"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900">
                <i class="bi bi-kanban"></i>
                <span class="text-sm ml-2">Products</span>
            </Link>
            <Link :href="'/admin/users-list'"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900">
                <i class="bi bi-person"></i>
                <span class="text-sm ml-2">Users</span>
            </Link>
            <Link :href="'/admin/criticisms-list'"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900">
                <i class="bi bi-person"></i>
                <span class="text-sm ml-2">criticism</span>
            </Link>

        </ul>

    </div>


</template>
