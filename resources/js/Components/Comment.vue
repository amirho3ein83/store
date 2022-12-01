<script setup>
defineProps({
  comment: Object
})
</script>

<template>
  <!-- component -->
  <div class=" text-black dark:text-gray-200 py-1 antialiased flex w-[350px]">
    <div>
      <div class="bg-gray-400 dark:bg-gray-700 rounded px-4 pt-2 pb-2.5">
        <div class="flex align-baseline ">
          <img class="rounded-full h-8 w-8 mr-2 mt-1 " src="https://i.pravatar.cc/60?u=" />
          <span class="font-semibold text-sm leading-relaxed">{{comment.author}}</span>
        </div>
        <div class="text-normal leading-snug md:leading-normal">{{ comment.body }}</div>
        <div class="text-sm ml-4 mt-0.5 text-gray-700 dark:text-gray-400">{{ comment.j_created_at }}</div>
      </div>
    </div>
  </div>
</template>
