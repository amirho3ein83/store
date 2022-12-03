<script setup>
defineProps({
    comment: Object,
});
</script>

<template>
    <article
        class="p-6 mb-6 w-full text-base bg-white rounded-lg dark:bg-gray-900"
    >
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p
                    class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"
                >
                    <img
                        v-if="comment.author.image_url != null"
                        class="mr-2 w-6 h-6 rounded-full"
                        :src="comment.author.image_url"
                        alt="Michael Gough"
                    />
                    <img
                        v-else
                        class="mr-2 w-6 h-6 rounded-full"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRao_0xQcdcOVK9S6UuSGjkQGy4j2uPsZ0Uug&usqp=CAU"
                        alt="Michael Gough"
                    />{{ comment.author.name }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span v-text="comment.j_created_at"></span>
                </p>
            </div>
        </div>
        <p v-text="comment.body" class="text-gray-500 dark:text-gray-400"></p>
        <div
            class="flex items-center mt-4 font-light text-xs text-red-500 space-x-4"
            v-if="comment.suggestion == 'no'"
        >
            <i class="bi bi-hand-thumbs-down-fill px-2"></i>
            این محصول رو پیشنهاد نمیکنم
        </div>
        <div
            class="flex items-center mt-4 font-light text-xs text-green-600 space-x-4"
            v-if="comment.suggestion == 'yes'"
        >
            <i class="bi bi-hand-thumbs-up-fill px-2"></i> این محصول رو پیشنهاد
            میکنم
        </div>
    </article>
</template>
<style scoped>
i {
    font-size: 20px;
}
</style>
