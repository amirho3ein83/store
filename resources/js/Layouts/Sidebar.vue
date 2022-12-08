<script setup></script>

<template>
    <div class="px-8 bg-gray-800 w-[250px] h-screen sticky top-0">
        <h2 class="text-yellow-600 text-center py-3 text-2xl">پنل ادمین</h2>
        <ul class="mt-12">
            <Link
                :href="'/'"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-house"></i>
                <span class="text-md ml-2">خانه</span>
            </Link>
            <Link
                :href="route('admin.dashboard')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-kanban"></i>
                <span class="text-md ml-2">داشبورد</span>
            </Link>
            <Link
                :href="route('admin.products.list')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-kanban"></i>
                <span class="text-md ml-2">محصولات</span>
            </Link>
            <Link
                :href="route('admin.orders.list')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-kanban"></i>
                <span class="text-md ml-2">سفارشات</span>
            </Link>
            <Link
                :href="route('admin.clients.list')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-person"></i>
                <span class="text-md ml-2">مشتریان</span>
            </Link>
            <Link
                :href="route('admin.criticisms.list')"
                class="flex justify-start items-center cursor-pointer text-gray-300 focus:outline-none focus:ring-2 py-2 px-3 mb-5 focus:bg-gray-900"
            >
                <i class="bi bi-person"></i>
                <span class="text-md ml-2">انتقادات</span>
            </Link>
        </ul>
    </div>
</template>
