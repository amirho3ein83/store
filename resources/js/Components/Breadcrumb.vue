<script setup>

import { managePageStore } from "@/store/ManagePages";

const storePages = managePageStore();

const props = defineProps({
    crumbs: {
        type: Array,
        required: true,
    }
});

const isLast = (index) => {
    return index === props.crumbs.length - 1;

}


</script>



<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 ">
            <li class="inline-flex items-center">
                <a href="/home"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    صفحه اصلی
                </a>
            </li>



            <li v-for="(crumb, ci) in crumbs" :key="ci"
                :class="{ 'disabled': crumb.disable, 'cursor-default': crumb.disable }">
                <div class="flex items-center">
/

                    <a :href="crumb.url" v-if="crumb.url"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-800 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{
                            crumb.label }}</a>
                    <span v-else
                        class="ml-1 text-sm font-medium cursor-default text-gray-500 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{
                            crumb.label }}</span>
                </div>
            </li>

        </ol>
    </nav>
</template>

<style scoped>
.breadcrumb {
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.37rem;
}
</style>
