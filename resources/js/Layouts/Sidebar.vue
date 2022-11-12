<script setup></script>

<template>

    <div class="px-8 bg-gray-800 w-[250px] h-screen sticky top-0">
        <h2 class="text-yellow-600 text-center py-3 text-2xl">
            Admin Panel

        </h2>
        <ul class="mt-12">
            <li class="flex w-full justify-between text-gray-300 cursor-pointer items-center mb-6">
                <Link :href="'dashboard'" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                        <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                        <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                    </svg>
                    <span class="text-sm ml-2">Dashboard</span>
                </Link>

            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6">
                <Link :href="'products-list'" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <path
                            d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1">
                        </path>
                    </svg>
                    <span class="text-sm ml-2">Products</span>
                </Link>

            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6">
                <Link :href="`/admin/users-list`" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-compass" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <polyline points="8 16 10 10 16 8 14 14 8 16"></polyline>
                        <circle cx="12" cy="12" r="9"></circle>
                    </svg>
                    <span class="text-sm ml-2">Users</span>
                </Link>
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6">
                <Link :href="``" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code" width="20"
                        height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <polyline points="7 8 3 12 7 16"></polyline>
                        <polyline points="17 8 21 12 17 16"></polyline>
                        <line x1="14" y1="4" x2="10" y2="20"></line>
                    </svg>
                    <span class="text-sm ml-2">Deliverables</span>
                </Link>
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6">
                <Link :href="``" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"></path>
                        <path
                            d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1">
                        </path>
                    </svg>
                    <span class="text-sm ml-2">Invoices</span>
                </Link>
                <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">25
                </div>
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center mb-6">
                <Link :href="``" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-stack" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="12 4 4 8 12 12 20 8 12 4" />
                        <polyline points="4 12 12 16 20 12" />
                        <polyline points="4 16 12 20 20 16" />
                    </svg>
                    <span class="text-sm ml-2">Inventory</span>
                </Link>
            </li>
            <li class="flex w-full justify-between text-gray-400 hover:text-gray-300 cursor-pointer items-center">
                <Link :href="``" class="flex items-center focus:outline-none focus:ring-2 focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="18"
                        height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <span class="text-sm ml-2">Settings</span>
                </Link>
            </li>
        </ul>

    </div>


</template>
