<script setup>
defineProps({
  tasks: Object,
});
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
  layout: AdminLayout,
};
</script>
<template>
  <div class="mx-auto w-2/3 bg-[url('./pics/checklist.png')]" style="
                    background-position: 50%;
                    height: 500px;
                ">


</div>

</template>
