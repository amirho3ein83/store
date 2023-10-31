<script setup>
defineProps({
    items: Array,
});
</script>

<template>
    <nav aria-label="Breadcrumb">
        <ol class="flex items-end gap-1 text-sm text-gray-600 ">
            <!-- <li class="hover:opacity-80">
                <a href="/home" class="block transition hover:text-gray-700">
                    <span class="sr-only"> Home </span>

                </a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </li> -->




            <!--
            <span v-for="(item, index) in items" :key="index">
                <Link v-if="item.url" :href="route(`category.list`)" preserve-scroll>
                <p class="block transition hover:text-gray-700"> {{ item.label }} </p>
                </Link>
                <p v-else class="block transition hover:text-gray-700"> {{ item.label }} </p>

                <span class="rtl:rotate-180">
                <svg v-if="index < (items?.length)" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            </span>

 -->



















<!-- 
            <li>

                <Link :href="route(`category.list`)" preserve-scroll>
                <p class="block transition hover:text-gray-700"> All Categories </p>
                </Link>

            </li>

            <li class="rtl:rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </li>

            <li>
                <a href="#" class="block transition hover:text-gray-700"> current category </a>
            </li> -->
        </ol>
    </nav>
</template>
