<script setup>

import Table from "@/Components/Table.vue";
defineProps({
  users:Object
})
</script>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default{
  layout:AdminLayout
}
</script>
<template>
   <Table :users="users.data"/> 
    <!-- pagination -->
    <div v-show="users.data != undefined && users.data != {}">
        <Pagination :nextPage="users.next_page_url" :previousPage="users.prev_page_url"
            :currentPage="users.current_page" />
    </div>
</template>
