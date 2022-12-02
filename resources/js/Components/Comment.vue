<script setup>
defineProps({
    comment: Object,
});
</script>

<template>
    <!-- component -->
    <div class="text-black dark:text-gray-200 py-1 antialiased flex w-[350px]">
        <div>
            <div
                :class="{
                    'border-green-600': comment.suggestion == `yes`,
                    'border-red-600': comment.suggestion == `no`,
                    'border-yellow-600': comment.suggestion == `not_sure`,
                }"
                class="rounded-lg border-r-2 px-4 pt-2 pb-2.5"
            >
                <div class="flex align-baseline">
                    <img
                        class="rounded-full h-8 w-8 mr-2 mt-1"
                        src="https://i.pravatar.cc/60?u="
                    />
                </div>
                <div
                    class="text-sm ml-4 mt-0.5 text-gray-700 dark:text-gray-400"
                >
                    {{ comment.suggestion }}
                </div>
                <div class="text-normal leading-snug md:leading-normal">
                    {{ comment.body }}
                </div>
                <div
                    class="text-sm ml-4 mt-0.5 text-gray-700 dark:text-gray-400"
                >
                    {{ comment.j_created_at }}
                </div>
            </div>
        </div>
    </div>
</template>
